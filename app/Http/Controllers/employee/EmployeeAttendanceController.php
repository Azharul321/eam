<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    //in time

    public function inTime()
    {
        //Get Session Employee


        $sessionEm = Employee::where('email', session()->get('email'))->first();

        $today = Carbon::now()->format('Y-m-d');

        $check = EmployeeAttendance::where('email', $sessionEm->email)->where('employeeId', $sessionEm->id)->where('date', $today)->first();

        //late calculate
        $sTime = '10:00:00';
        $iTime = Carbon::now()->format('H:i:s');
        $t1 = strtotime($sTime);
        $t2 = strtotime($iTime);

        $lTime = gmdate('H:i:s', $t2 - $t1);

        $chance = date('H', strtotime($lTime));

        if (!$check && $chance < 10) {
            $inTi = new EmployeeAttendance();
            $inTi->employeeId = $sessionEm->id;
            $inTi->email = $sessionEm->email;
            $inTi->date = Carbon::now()->format('Y-m-d');
            $inTi->late =  $lTime;
            $inTi->inTime = Carbon::now()->format('H:i:s');
            if ($inTi->save()) {
                notify()->success("Have A good day!!", "Success", "bottomRight");
                return back();
            }
            notify("Quick notification2");
            notify()->error("Unauthorize access!!!!", "Error", "bottomRight");
            return back()->with('msg2', 'Unauthorize access!!');
        }
        notify("Quick notification3");
        notify()->info("Allready attended", "Info", "bottomRight");
        return back()->with('msg3', 'Allready attended');
    }

    //in time

    public function outTime()
    {
        //Get Session Employee

        $sessionEm1 = Employee::where('email', session()->get('email'))->first();

        $today = Carbon::now()->format('Y-m-d');
        $check1 = EmployeeAttendance::where('email', $sessionEm1->email)->where('employeeId', $sessionEm1->id)->where('date', $today)->first();

        //Total calculate
        $iTime = $check1->inTime;
        $ouTime = Carbon::now()->format('H:i:s');
        $t1 = strtotime($iTime);
        $t2 = strtotime($ouTime);

        $lTime1 = gmdate('H:i:s', $t2 - $t1);
        $chance1 = date('H', strtotime($lTime1));

        if ($check1 && $chance1 < 15) {

            $check1->outTime = Carbon::now()->format('H:i:s');
            $check1->total = $lTime1;

            if ($check1->update()) {
                notify()->success("Bye Bye! See you again!", "Success", "bottomRight");
                return back()->with('msg', 'Bye Bye! See you again!');
            }
            notify()->error("Unauthorize access!!!!", "Error", "bottomRight");
            return back()->with('msg2', 'Unauthorize access!!');
        }
        notify()->info("In time not found!!", "Info", "bottomRight");
        return back()->with('msg3', 'In time not found!!');
    }

    // See employee attendance from admin
    public function employeeAttendance($id)
    {
        $empAttendance = EmployeeAttendance::where('employeeId', $id)->get();

        return view('admin.employee.attendance', compact('empAttendance'));
    }
}
