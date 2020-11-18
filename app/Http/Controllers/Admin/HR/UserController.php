<?php

namespace App\Http\Controllers\Admin\HR;
use App\Http\Controllers\Controller;

use App\Http\Requests\HR\UserRequest;
use Illuminate\Http\Request;

use App\User;
use App\Models\HR\JobTitle;

use App\Mail\SendMultiMails;
use Image;
use File;
use Mail;


class UserController extends Controller
{

    public function users_select()
    {
        $users = User::orderBy('id', 'desc')->with('jobTitle')->get();
        return response($users);
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
        $active = $request->active;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = User::select('*')->with('jobTitle')->orderBy($sortBy, $dir);

        // handel users trashed and not trashed
        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
        }
        // handel users active and not active
        if ($active != '') {
            $query->where('active', $active);
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
                        $query->orWhere($column, 'like', '%' . $searchValue . '%');
                    }
                });
            } else {
                $query->where(function($query) use ($searchValue, $searchColumnSelected) {
                    foreach($searchColumnSelected as $column) {
                        $query->orWhere($column, 'like', '%' . $searchValue . '%');
                    }
                });
            }
        }
        $users = $query->paginate($length);
        return response(['data' => $users, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(UserRequest $request)
    {
        $userData = $request->validated();
        $userDataSaving = array_except($userData, 'documents');
        $userDataSaving['department_id'] = $userDataSaving['job_title_id'] != null ? JobTitle::select('department_id')->where('id', $userDataSaving['job_title_id'])->first()->department_id : null;
        $userDataSaving['password'] = bcrypt($userDataSaving['password']);
        $userDataSaving['photo'] = User::saveImage($userDataSaving['photo']);
        $userCreated = User::create($userDataSaving);
        User::createDir($userCreated->id);

        // handel documents
        /*================================================*/
        $documentsDB = null;
        if (count($userData['documents']) > 0) {
            $documents_saved = [];
            foreach ($userData['documents'] as $image) {
                $get_ext = explode(';', explode('/', $image['value'])[1])[0];
                $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
                $imageNewName =  uniqid('document-') . '.' . $ext;
                $directory = User::DIRECTORY_MODEL . '/employee-' . $userCreated->id . '/' . User::DIRECTORY_DOCUMENTS . '/';
                $imagePath =  $directory . $imageNewName;
                if (is_dir(public_path($directory))) {
                    Image::make($image['value'])->save(public_path($imagePath));
                    $documents_saved[] = $imagePath;
                }
            }
            $documentsDB = implode(',', $documents_saved);
        }
        $userCreated->update(['documents' => $documentsDB]);
        /*================================================*/

        // send welcome email
        $userData['id'] = $userCreated->id;
        Mail::to($userData['email'])
            ->cc(config('mail.cc'))
            ->send(new SendMultiMails('emails.send.welcome_user', 'Welcome ' . $userData['name'], $userData));
        /*================================================*/

        return response(['message' => 'User has been created.', 'id' => $userCreated->id]);
    }


    public function show($id)
    {
        $user = User::with('jobTitle', 'jobTitle.department')->find($id);
        $userArray = $user->toArray();
        // change documents
        if ($user->documents != null) {
            $userArray = convert_str_to_array($userArray, 'documents');
        } else {
            $userArray['documents'] = [];
        }
        return response(['user' => $userArray]);
    }



    public function update(UserRequest $request, $id)
    {
        $userData = $request->validated();
        $user = User::find($id);
        User::createDir($user->id);

        $userData['department_id'] = $userData['job_title_id'] != null ? JobTitle::select('department_id')->where('id', $userData['job_title_id'])->first()->department_id : null;
        if (array_has($userData, 'password') && $userData['password'] != '') {
            $userData['password'] = bcrypt($userData['password']);
        } else {
            $userData['password'] = $user->password;
        }

        if (strpos($userData['photo'], 'data:image/') === 0) {
            $userData['photo'] = User::saveImage($userData['photo'], $user);
        } else if ($userData['photo'] == User::DEFAULT_IMAGE && ($user->photo != User::DEFAULT_IMAGE && $user->photo != null)) {
            deleteImage(public_path($user->photo));
        }

        // handel documents
        // delete images in array [documents deleted by user]
         if (count($request->deletedDocuments) > 0) {
            foreach ($request->deletedDocuments as $image) {
                if (file_exists(public_path($image['value']))) {
                    unlink(public_path($image['value']));
                }
            }
         }

        /*================================================*/
        // save new and old images
         $documents = collect($userData['documents']);
         $documents_new = $documents->filter(function ($value) {
            return !key_exists('id', $value);
         });
         $documents_old = $documents->filter(function ($value) {
            return key_exists('id', $value);
         });

        /*================================================*/
        $documents_saved = [];
        // save new image if exists new image
        if ($documents_new->count() > 0) {
            foreach ($documents_new as $image) {
                $get_ext = explode(';', explode('/', $image['value'])[1])[0];
                $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
                $imageNewName =  uniqid('document-') . '.' . $ext;
                $directory = User::DIRECTORY_MODEL . '/employee-' . $user->id . '/' . User::DIRECTORY_DOCUMENTS . '/';
                $imagePath =  $directory . $imageNewName;
                if (is_dir(public_path($directory))) {
                    Image::make($image['value'])->save(public_path($imagePath));
                    $documents_saved[] = $imagePath;
                }
            }
        }
        /*================================================*/
        if ($documents_old->count() > 0) {
            foreach ($documents_old as $image) {
                $documents_saved[] = $image['value'];
            }
        }
        if (count($documents_saved) > 0) {
            $userData['documents'] = implode(',', $documents_saved);
        } else {
            $userData['documents'] = null;
        }
        /****************************************************************************/

        $user->update($userData);

        return response(['message' => 'User has been updated.']);
    }



    public function destroy($id)
    {
        if ($id != 1) {
            $user = User::withTrashed()->where('id', $id)->first();

            if ($user->trashed()) {
                // delete photo if exists
                deleteImageModel($user, 'photo', User::DEFAULT_IMAGE);
                $user->forceDelete();
                File::deleteDirectory(public_path(User::DIRECTORY_MODEL . '/employee-' . $id));
            } else {
                $user->delete();
            }
            return response(['status' => true]);
        } else {
            return response(['error' => 'This user can\'t delete it.'], 403);
        }
    }


    public function restoreUser($id)
    {
        $user_deleted = User::onlyTrashed()->where('id', $id)->first();

        $user_deleted->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if (in_array('1', $ids)) {
            return response(['error' => 'This user can\'t delete it.'], 403);
        }
        if ($action == 'delete') {
            User::destroy($ids);
        } else if ($action == 'force_delete') {
            $users = User::onlyTrashed()->select('photo', 'id')->whereIn('id', $ids)->get();
            foreach ($users as $user) {
                deleteImageModel($user, 'photo', User::DEFAULT_IMAGE);
                $user->forceDelete();
                File::deleteDirectory(public_path(User::DIRECTORY_MODEL . '/employee-' . $user->id));
            }
        } else if ($action == 'restore') {
            User::onlyTrashed()->whereIn('id', $ids)->restore();
        }

        return response(['status' => true]);
    }

}
