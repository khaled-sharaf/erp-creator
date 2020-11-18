<?php

namespace Modules\ProjectManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\ProjectManagement\Http\Requests\ProjectRequestCreate;
use Modules\ProjectManagement\Http\Requests\ProjectRequestUpdate;
use Modules\ProjectManagement\Entities\Project;

use App\User;
use DB;
use PDF;
use File;
use Image;
use Carbon\Carbon;

use App\Mail\SendMultiMails;
use Mail;

class ProjectController extends Controller
{

    private $relation_with_index = ['contract', 'contract.lead', 'designer', 'marketer', 'advertiser', 'createdByUser'];
    private $relation_with_profile = [];
    private $relation_with_sum_payments = [];

    public function __construct()
    {

        $this->relation_with_sum_payments['services AS profit_ads'] = function ($q) {
            $q->where('profit_method', 0)->select(DB::raw("SUM(amount) as profit_ads"));
        };
        $this->relation_with_index['contract'] = function ($query) {
            $query->withCount(
                [
                    'services as ads_amount' => function($q) {
                        $q->where('profit_method', 0)->select(DB::raw("SUM(amount) as ads_amount"));
                    }
                ]
            );
        };
        $relations_profile = ['platforms', 'platforms.originalPlatform'];
        $relations_profile['contract.payments'] = function ($q) {
            $q->where('profit_method', 0);
        };

        $this->relation_with_profile = array_merge($this->relation_with_index, $relations_profile);
    }




    public function index(Request $request)
    {
        $sortBy = $request->sortBy;
        $length = $request->length;
        $dir = $request->dir;
        $draw = $request->draw;
        $searchValue = $request->search;
        $searchColumnSelected = $request->searchColumnSelected;
        $searchColumns = array_slice($request->searchColumns, 1);
        $trashed = $request->trashed;
        $created_by = $request->created_by;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Project::select('*')
            ->with($this->relation_with_index)
            ->orderBy($sortBy, $dir);

        // permoission admin
        if (!auth()->user()->can('admin-projects-management')) {
            $query->where(function ($q) {
                $q->where('designer_id', auth()->id())
                    ->orWhere('marketer_id', auth()->id())
                    ->orWhere('advertiser_id', auth()->id());
            });
        }

        // handel lead_contracts trashed and not trashed
        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
        }

        if ($created_by != '') {
            $query->where('created_by', $created_by);
        }


        if ($from_date != '') {
            $query->where('created_at', '>=', $from_date);
        }
        if ($to_date != '') {
            $query->where('created_at', '<=', $to_date);
        }

        if ($searchValue) {
            if (in_array('all', $searchColumnSelected)) {
                $query->where(function($query) use ($searchValue, $searchColumns) {
                    foreach($searchColumns as $column) {
                        if ($column == 'lead_id') {
                            $query->orWhereHas('contract.lead', function($q) use ($searchValue) {
                                $q->where('name', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'lead_phone') {
                            $query->orWhereHas('contract.lead', function($q) use ($searchValue) {
                                $q->where('phone', 'like', '%' . $searchValue . '%')
                                    ->orWhere('whatsapp_phone', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'company_name') {
                            $query->orWhereHas('contract.lead', function($q) use ($searchValue) {
                                $q->where('company_name', 'like', '%' . $searchValue . '%');
                            });
                        } else {
                            $query->orWhere($column, 'like', '%' . $searchValue . '%');
                        }
                    }
                });
            } else {
                $query->where(function($query) use ($searchValue, $searchColumnSelected) {
                    foreach($searchColumnSelected as $column) {
                        if ($column == 'lead_id') {
                            $query->orWhereHas('contract.lead', function($q) use ($searchValue) {
                                $q->where('name', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'lead_phone') {
                            $query->orWhereHas('contract.lead', function($q) use ($searchValue) {
                                $q->where('phone', 'like', '%' . $searchValue . '%')
                                    ->orWhere('whatsapp_phone', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'company_name') {
                            $query->orWhereHas('contract.lead', function($q) use ($searchValue) {
                                $q->where('company_name', 'like', '%' . $searchValue . '%');
                            });
                        } else {
                            $query->orWhere($column, 'like', '%' . $searchValue . '%');
                        }
                    }
                });
            }
        }
        $projects = $query->paginate($length);
        return response(['data' => $projects, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }


    public function store(Request $request)
    {
        $data = [
            'created_by' => auth()->id(),
            'lead_contract_id' => $request->lead_contract_id
        ];
        $project = Project::create($data);
        Project::createDir($project->id);
        return resHandel();
    }




    public function show($id)
    {
        $project = Project::with($this->relation_with_profile);
        if (!auth()->user()->can('admin-projects-management')) {
            $project->where(function ($query) {
                $query->where('designer_id', auth()->id())
                    ->orWhere('marketer_id', auth()->id())
                    ->orWhere('advertiser_id', auth()->id());
            });
        }
        $project = $project->find($id);
        if ($project != null) {

            
            $projectArray = $project->toArray();

            // change designer deadline
            $projectArray['designer_deadline_days'] = $project->designer_deadline != null ? floor($project->designer_deadline / 24) : '';
            $projectArray['designer_deadline_hours'] = $project->designer_deadline != null ? ($project->designer_deadline % 24) : '';

            // change marketer deadline
            $projectArray['marketer_deadline_days'] = $project->marketer_deadline != null ? floor($project->marketer_deadline / 24) : '';
            $projectArray['marketer_deadline_hours'] = $project->marketer_deadline != null ? ($project->marketer_deadline % 24) : '';

            // change advertiser deadline
            $projectArray['advertiser_deadline_days'] = $project->advertiser_deadline != null ? floor($project->advertiser_deadline / 24) : '';
            $projectArray['advertiser_deadline_hours'] = $project->advertiser_deadline != null ? ($project->advertiser_deadline % 24) : '';

            // change addresses
            $projectArray['addresses'] = $project->addresses != null ? json_decode($project->addresses) : [['address' => '']];

            // change phone_numbers
            $projectArray['phone_numbers'] = $project->phone_numbers != null ? json_decode($project->phone_numbers) : [['number' => '']];

            // change websites
            $projectArray['websites'] = $project->websites != null ? json_decode($project->websites) : [['url' => '']];

            // change emails
            $projectArray['emails'] = $project->emails != null ? json_decode($project->emails) : [['email' => '']];

            // change colors_favorite
            $projectArray['colors_favorite'] = $project->colors_favorite != null ? json_decode($project->colors_favorite) : [['color' => '']];

            // change gallery
            if ($project->gallery != null) {
                $projectArray = convert_str_to_array($projectArray, 'gallery');
            } else {
                $projectArray['gallery'] = [];
            }

            // change platforms
            if ($project->platforms->count() > 0) {
                $newPlatforms = [];
                foreach ($projectArray['platforms'] as $platform) {
                    $newPlatform = $platform;
                    $newPlatform['auth'] = $newPlatform['auth'] != null ? json_decode($newPlatform['auth']) : ['username' => '', 'password' => ''];
                    $newPlatforms[] = $newPlatform;
                }
                $projectArray['platforms'] = $newPlatforms;
            }

            // change posts_type
            $projectArray['posts_type'] = $project->posts_type != null ? json_decode($project->posts_type) : ['single' => '', 'grouped' => '', 'cover_post' => ''];

            // change competitors_links
            $projectArray['competitors_links'] = $project->competitors_links != null ? json_decode($project->competitors_links) : [['url' => '', 'note' => '']];

            // change targeted_places
            $projectArray['targeted_places'] = $project->targeted_places != null ? json_decode($project->targeted_places) : [['place' => '']];

            // change targeted_gender
            $projectArray['targeted_gender'] = $project->targeted_gender != null ? json_decode($project->targeted_gender) : ['male' => true, 'female' => true];

            // change targeted_age
            $projectArray['targeted_age'] = $project->targeted_age != null ? json_decode($project->targeted_age) : ['min' => 13, 'max' => 65];
            return response(['project' => $projectArray]);
        }
        return response(['project' => null]);
    }




    // public function update(Request $request, $id)
    public function update(ProjectRequestUpdate $request, $id)
    {
        $formData = $request->validated();
        $project = Project::find($id);
        Project::createDir($project->id);
        $newProject = array_except($formData, [
            'designer_deadline_days',
            'designer_deadline_hours',
            'marketer_deadline_days',
            'marketer_deadline_hours',
            'advertiser_deadline_days',
            'advertiser_deadline_hours',
            'platforms'
        ]);
        $newProject['designer_deadline'] = ($formData['designer_deadline_days'] * 24) + $formData['designer_deadline_hours'];
        $newProject['marketer_deadline'] = ($formData['marketer_deadline_days'] * 24) + $formData['marketer_deadline_hours'];
        $newProject['advertiser_deadline'] = ($formData['advertiser_deadline_days'] * 24) + $formData['advertiser_deadline_hours'];

        $newProject['phone_numbers'] = json_encode($formData['phone_numbers']);
        $newProject['addresses'] = json_encode($formData['addresses']);
        $newProject['websites'] = json_encode($formData['websites']);
        $newProject['emails'] = json_encode($formData['emails']);
        $newProject['colors_favorite'] = json_encode($formData['colors_favorite']);

        $newProject['posts_type'] = json_encode($formData['posts_type']);
        $newProject['competitors_links'] = json_encode($formData['competitors_links']);
        $newProject['targeted_places'] = json_encode($formData['targeted_places']);
        $newProject['targeted_gender'] = json_encode($formData['targeted_gender']);
        $newProject['targeted_age'] = json_encode($formData['targeted_age']);


        // handel logo
        if (strpos($newProject['logo_src'], 'data:') === 0) {
            $logoNewName =  uniqid('logo-src-') . $request->logo_ext;
            $logoPath = Project::DIRECTORY_MODEL . '/project-' . $project->id . '/' . Project::DIRECTORY_SRC . '/' . $logoNewName;
            if (uploadFileBase64(public_path($logoPath), $newProject['logo_src'])) {
                $newProject['logo_src'] = $logoPath;
            }
        }
        /****************************************************************************/

        // handel gallery
        // delete images in array [gallery deleted by user]
         if (count($request->deletedGallery) > 0) {
            foreach ($request->deletedGallery as $image) {
                if (file_exists(public_path($image['value']))) {
                    unlink(public_path($image['value']));
                }
            }
         }

        /*================================================*/
        // save new and old images
         $gallery = collect($newProject['gallery']);
         $gallery_new = $gallery->filter(function ($value) {
            return !key_exists('id', $value);
         });
         $gallery_old = $gallery->filter(function ($value) {
            return key_exists('id', $value);
         });

        /*================================================*/
        $gallery_saved = [];
        // save new image if exists new image
        if ($gallery_new->count() > 0) {
            foreach ($gallery_new as $image) {
                $get_ext = explode(';', explode('/', $image['value'])[1])[0];
                $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
                $imageNewName =  uniqid('image-material-') . '.' . $ext;
                $directory = Project::DIRECTORY_MODEL . '/project-' . $project->id . '/' . Project::DIRECTORY_IMAGE . '/';
                $imagePath =  $directory . $imageNewName;
                if (is_dir(public_path($directory))) {
                    Image::make($image['value'])->save(public_path($imagePath));
                    $gallery_saved[] = $imagePath;
                }
            }
        }
        /*================================================*/
        if ($gallery_old->count() > 0) {
            foreach ($gallery_old as $image) {
                $gallery_saved[] = $image['value'];
            }
        }
        if (count($gallery_saved) > 0) {
            $newProject['gallery'] = implode(',', $gallery_saved);
        } else {
            $newProject['gallery'] = null;
        }
        /****************************************************************************/

        $project->update($newProject);

        // delete platforms has deleted
        /***************************************************/
        $platforms = $formData['platforms'];
        $deletedPlatforms = $request->deletedPlatforms;
        if (count($deletedPlatforms) > 0) {
            $project->platforms()->whereIn('id', $deletedPlatforms)->delete();
        }
        for ($x = 0; $x < count($platforms); $x++) {
            $platforms[$x]['auth'] = json_encode($platforms[$x]['auth']);
            $platforms[$x] = array_except($platforms[$x], ['original_platform']);
            $project->platforms()->updateOrCreate(
                [
                    'id' => key_exists('id', $platforms[$x]) ? $platforms[$x]['id'] : 0
                ],
                $platforms[$x]
            );
        }
        /***************************************************/

        return response(['message' => 'Project has been updated.']);
    }




    // public function activate(ProjectRequestCreate $request, $id)
    public function activate(Request $request, $id)
    {
        $type = $request->type;
        $columnActivate = $type . '_activated_at';
        $project = Project::find($id);
        $project->update([
            $columnActivate => Carbon::now()
        ]);
        return resHandel();
    }

    public function destroy($id)
    {
        $project = Project::withTrashed()->where('id', $id)->first();
        if ($project->trashed()) {
            $project->forceDelete();
            File::deleteDirectory(public_path(Project::DIRECTORY_MODEL . '/project-' . $id));
        } else {
            $project->delete();
        }
        return response(['status' => true]);
    }


    public function restoreProject($id)
    {
        $project_deleted = Project::onlyTrashed()->where('id', $id)->first();
        $project_deleted->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Project::destroy($ids);
        } else if ($action == 'force_delete') {
            $projects = Project::onlyTrashed()->select('id')->whereIn('id', $ids)->get();
            foreach ($projects as $project) {
                $project->forceDelete();
                File::deleteDirectory(public_path(Project::DIRECTORY_MODEL . '/project-' . $project->id));
            }
        } else if ($action == 'restore') {
            Project::onlyTrashed()->whereIn('id', $ids)->restore();
        }

        return response(['status' => true]);
    }

}
