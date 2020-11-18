<?php

namespace Modules\HR\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\HR\Http\Requests\AttendanceRequest;

use Modules\HR\Entities\Attendance;

use DB;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $year = $request->year;
        $month = $request->month < 10 ? '0' . $request->month : $request->month;
        $day = $request->day < 10 ? '0' . $request->day : $request->day;
        $type = $request->type;

        $array_with_counts = [];
        $array_with_counts['overtime AS overtimes'] = function ($q) {
            $q->select(DB::raw("SUM(overtime) as overtimes"));
        };

        $query = Attendance::with('user')->orderBy('created_at');


        if ($user_id != '') {
            $query->where('user_id', $user_id);
        }
        if ($year != '' && $year != null) {
            $query->where('year', $year);
        }
        if ($request->month != '' && $request->month != null) {
            $query->where('month', $month);
        }
        if ($request->day != '' && $request->day != null) {
            $query->where('day', $day);
        }
        // dd($query->toSql());
        $data = $query->get();


        $total_hours = 0;
        if ($type === 'month' && $month != null && $user_id != null) {
            foreach ($data as $attendance) {
                if ($attendance->absent != 1 && $attendance->check_out != null && $attendance->check_in != null) {
                    $check_in = strtotime($attendance->check_in);
                    $check_out = strtotime($attendance->check_out);
                    if ($check_out > $check_in) {
                        $hours = abs($check_out - $check_in) / (60 * 60);
                        $total_hours += $hours;
                    }
                }
            }
        }

        return resHandel([
            'attendance' => $data,
            'total_overtime' => $query->sum('overtime'),
            'total_permissions' => $query->sum('permission_time'),
            'total_absent' => $query->where('absent', 1)->count(),
            'total_hours' => $total_hours
        ]);
    }


    public function store(AttendanceRequest $request)
    {
        $formData = $request->validated();
        $created_at = array_key_exists('created_at', $formData) && $formData['created_at'] == null ? date('Y-m-d H:i:s') : $formData['created_at'];
        $formData['year'] = date('Y', strtotime($created_at));
        $formData['month'] = date('m', strtotime($created_at));
        $formData['day'] = date('d', strtotime($created_at));
        $formData['created_at'] = $created_at;
        $attendance = Attendance::create($formData);
        return resHandel();
    }


    public function show($id)
    {
        $attendance = Attendance::find($id);
        return resHandel(['attendance' => $attendance]);
    }


    public function update(AttendanceRequest $request, $id)
    {
        $formData = $request->validated();
        $created_at = array_key_exists('created_at', $formData) && $formData['created_at'] == null ? date('Y-m-d H:i:s') : $formData['created_at'];
        $formData['year'] = date('Y', strtotime($created_at));
        $formData['month'] = date('m', strtotime($created_at));
        $formData['day'] = date('d', strtotime($created_at));
        $formData['created_at'] = $created_at;
        $attendance = Attendance::find($id);
        $attendance->update($formData);
        return resHandel();
    }

    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();
        return resHandel();
    }
}
