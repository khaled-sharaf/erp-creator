<?php

namespace App\Http\Controllers\Admin\CRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CRM\MeetingRequest;
use App\Models\Calendar\Calendar;
use App\Models\CRM\Meeting;
use App\Models\CRM\Lead;

class MeetingController extends Controller
{
    private $relation_with = [
        'parentMeeting',
        'nextMeetings',
        'createdByUser',
        'lead',
        'lead.user',
    ];

    public function __construct()
    {
        $this->relation_with['nextMeetings'] = function ($q) {
            $q->orderBy('id', 'desc');
        };
    }



    public function meetings_select()
    {
        $meetings = Meeting::orderBy('id', 'desc')->get();
        return response($meetings);
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
        $status = $request->status;
        $created_by = $request->created_by;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Meeting::select('*')
            ->onlyParents()
            ->with($this->relation_with)
            ->whereHas('lead', function ($q) {
                $q->whereNull('deleted_at')
                  ->where('type', '!=', '0');
                // permoission admin
                if (!auth()->user()->can('admin-crm')) {
                    $q->where('assign_to', auth()->id());
                }
            })
            ->orderBy($sortBy, $dir);


        // handel meetings trashed and not trashed
        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
        }

        if ($created_by != '') {
            $query->where('created_by', $created_by);
        }

        if ($status === 'none') {
            $query->whereNull('status');
        } else {
            if ($status != '') {
                $query->where('status', $status);
            }
        }

        if ($status == '') {
            $query->where(function ($q) {
                $q->where('status', '!=', 'done')
                  ->orWhereNull('status');
            });
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
                        if ($column == 'lead_name') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('name', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'lead_phone') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('phone', 'like', '%' . $searchValue . '%');
                            });
                        } else {
                            $query->orWhere($column, 'like', '%' . $searchValue . '%');
                        }
                    }
                });
            } else {
                $query->where(function($query) use ($searchValue, $searchColumnSelected) {
                    foreach($searchColumnSelected as $column) {
                        if ($column == 'lead_name') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('name', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'lead_phone') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('phone', 'like', '%' . $searchValue . '%');
                            });
                        } else {
                            $query->orWhere($column, 'like', '%' . $searchValue . '%');
                        }
                    }
                });
            }
        }
        $meetings = $query->paginate($length);
        return response(['data' => $meetings, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(MeetingRequest $request)
    {
        $formData = $request->validated();
        $leadId = null;
        if ($formData['lead_id'] === null) {
            $lead = Lead::create([
                'name' => $formData['lead_name'],
                'phone' => $formData['lead_phone'],
                'created_by' => auth()->id(),
                'assign_to' => auth()->id(),
                'company_logo' => Lead::DEFAULT_IMAGE,
                'type' => '1'
            ]);
            $leadId = $lead->id;
        } else {
            $leadId = $formData['lead_id'];
            $lead = Lead::find($leadId);
            $lead->type = $lead->type == 0 ? 1 : $lead->type;
            $lead->save();
        }
        $parent_meeting_id = NULL;
        if (array_key_exists('meeting_id', $formData)) {
            $parent_meeting_id = $formData['meeting_id'];
            $parent_meeting = Meeting::find($parent_meeting_id);
            $parent_meeting->status = 'next_meeting';
            $parent_meeting->save();
        }
        $meeting = [
            'created_by' => auth()->id(),
            'lead_id' => $leadId,
            'date' => $formData['date'],
            'address' => $formData['address'],
            'meeting_id' => $parent_meeting_id
        ];
        $meetingCreated = Meeting::create($meeting);

        /* !!!: Calendar */
        // if($meetingCreated){
        //   $meetingInfo = Meeting::where('address', $meeting['address'])
        //     ->where('lead_id', $meeting['lead_id'])->first();

        //   $calendar = new Calendar();

        //   $get_meeting_date = $meetingInfo->date;
        //   $format_meeting_date = date('H:i a', strtotime($get_meeting_date)); // hh-ii am/pm Formation

        //   $calendar->event_name = "Meeting at: ". $format_meeting_date . " in " . $meetingInfo->address;
        //   $calendar->model_id = $meetingInfo->id;
        //   $calendar->model_type = "CRM\Meeting";

        //   $meeting_start_date = $meetingInfo->date;
        //   $start_date = date('Y-m-d', strtotime($meeting_start_date)); // YYYY-mm-dd Formation

        //   $calendar->start_date = $start_date;
        //   $calendar->end_date = $start_date;

        //   $calendar->save();
        // }
        /* !!!: Calendar */

        return response(['message' => 'Meeting has been created.', 'id' => $meetingCreated->id]);
    }



    public function show($id)
    {
        $meeting = Meeting::with($this->relation_with)
        ->whereHas('lead', function ($q) {
            $q->whereNull('deleted_at')
            ->where('type', '!=', '0');
            // permoission admin
            if (!auth()->user()->can('admin-crm')) {
                $q->where('assign_to', auth()->id());
            }
        })
        ->find($id);
        return response(['meeting' => $meeting]);
    }



    public function update(MeetingRequest $request, $id)
    {
        $formData = $request->validated();
        $meeting = Meeting::find($id);

        // $calendar = Calendar::where('model_id', $meeting->id)->first();

        $meeting->update($formData);
        /* !!!: Calendar */

          // $get_meeting_date = $meeting->date;
          // $format_meeting_date = date('H:i a', strtotime($get_meeting_date)); // hh-ii am/pm Formation

          // $calendar->event_name = "Meeting at: ". $format_meeting_date . " in " . $meeting->address;

          // $meeting_start_date = $meeting->date;
          // $start_date = date('Y-m-d', strtotime($meeting_start_date)); // YYYY-mm-dd Formation

          // $calendar->start_date = $start_date;
          // $calendar->end_date = $start_date;

          // $calendar->update();
        /* !!!: Calendar */

        return response(['message' => 'Meeting has been updated.']);
    }



    public function change_status(Request $request, $id)
    {
        $meeting = Meeting::find($id);
        $meeting->status = $request->status;
        $meeting->note = $request->note;
        $meeting->save();
        return response(['message' => 'Meeting status has been updated.']);
    }



    public function destroy($id)
    {
        $meeting = Meeting::withTrashed()->where('id', $id)->first();
        // $calendar = Calendar::withTrashed()->where('model_id', $meeting->id)->first();

        if ($meeting->trashed()) {
            $meeting->forceDelete();
            // $calendar->forceDelete();
        } else {
            $meeting->delete();
            // $calendar->delete();
        }
        return response(['status' => true]);
    }


    public function restoreMeeting($id)
    {
        $meeting_deleted = Meeting::onlyTrashed()->where('id', $id)->first();
        /* !!!: Calendar */
        // $calendar_deleted = Calendar::onlyTrashed()
        //       ->where('model_id', $meeting_deleted->id)->first();

        // $calendar_deleted->restore();
        /* !!!: Calendar */
        $meeting_deleted->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;
        if ($action == 'delete') {
            Meeting::destroy($ids);
        } else if ($action == 'force_delete') {
            $meetings = Meeting::onlyTrashed()->whereIn('id', $ids)->get();
            Meeting::onlyTrashed()->whereIn('id', $ids)->forceDelete();
        } else if ($action == 'restore') {
            Meeting::onlyTrashed()->whereIn('id', $ids)->restore();
        }
        return response(['status' => true]);
    }
}
