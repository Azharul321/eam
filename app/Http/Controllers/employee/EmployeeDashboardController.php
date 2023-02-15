<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
     //view Dashboard
     public function EmployeeDashboard()
     {
         $currentEmp = Employee::where('email', session()->get('email'))->first();
         $today = Carbon::now()->format('Y-m-d');
         $isAttend = EmployeeAttendance::where('employeeId', $currentEmp->id)->where('email', $currentEmp->email)->where('date',  $today)->first();
         $isOut = EmployeeAttendance::where('employeeId', $currentEmp->id)->where('email', $currentEmp->email)->where('date',  $today)->where('outTime', null)->first();

         $last30 =  EmployeeAttendance::where('email',session()->get('email'))->latest()->take(30)->get();
         return view('employee.dashboard.dashboard', compact('isAttend','isOut','last30'));
     }

}
