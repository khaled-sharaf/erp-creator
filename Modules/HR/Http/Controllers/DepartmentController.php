<?php

namespace Modules\HR\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Modules\HR\Http\Requests\DepartmentRequest;

use Modules\HR\Entities\Department;
use Modules\HR\Entities\JobTitle;

class DepartmentController extends Controller
{

    public function departments_select()
    {
        $departments = Department::with('jobTitles')->orderBy('id', 'desc')->get();
        return response($departments);
    }

    public function departments_with_users_select(Request $request)
    {
        $departments = Department::with('users');

        if($request->has('name'))
        {
            $departments->where('name',$request['name']);
        }

        $departments=$departments->orderBy('id', 'desc')->get();
        
        return response($departments);
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
        $query = Department::select('*')->orderBy($sortBy, $dir);

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
        $departments = $query->paginate($length);
        return response(['data' => $departments, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }


    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        $departmentCreated = Department::create(['name' => $data['name']]);
        $jobTitles = collect($data['job_titles'])->filter(function ($jobTitle) {
            return $jobTitle['name'] != null;
        })->toArray();
        $departmentCreated->jobTitles()->createMany($jobTitles);
        return response(['message' => 'The department has been created.']);
    }


    public function show($id)
    {
        $department = Department::with('jobTitles')->find($id);
        return response(['department' => $department]);
    }



    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::find($id);
        $data = $request->validated();
        $department->name = $data['name'];
        $department->save();
        /***************************************************/

        // delete job titles has deleted
        if (count($request->deletedJobTitles) > 0) {
            $department->jobTitles()->whereIn('id', $request->deletedJobTitles)->delete();
        }
        /***************************************************/
        $jobTitles = collect($data['job_titles'])->filter(function ($jobTitle) {
            return $jobTitle['name'] != null;
        })->toArray();

        if (count($jobTitles) > 0) {
            for ($x = 0; $x < count($jobTitles); $x++) {
                $department->jobTitles()->updateOrCreate(
                    [
                        'id' => key_exists('id', $jobTitles[$x]) ? $jobTitles[$x]['id'] : 0
                    ],
                    $jobTitles[$x]
                );
            }
        }
        /***************************************************/
        return response(['message' => 'The department has been updated.']);
    }



    public function destroy($id)
    {
        Department::destroy($id);
        JobTitle::where('department_id', $id)->delete();
        return response(['status' => true]);
    }



    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        Department::destroy($ids);
        JobTitle::whereIn('department_id', $ids)->delete();
        return response(['status' => true]);
    }
}
