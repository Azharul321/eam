<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //view Dashboard
    public function AdminDashboard()
    {
        $totalEmp = Employee::count();
        $totalMsg = Message::count();
        $inTi = Carbon::now()->format('Y-m-d');
        $todayEmp = EmployeeAttendance::where('date',$inTi)->get();
        $emps = $todayEmp->count();
        return view('admin.dashboard.dashboard', compact('totalEmp','totalMsg', 'emps'));
    }

    //Send message

    public function sendMessage($id)
    {
        $msg = new Message();
        $msg->employeeId = $id;
        $msg->message = request('message');
        if($msg->save()){

            notify()->success("The Message was sent successfully", "Success", "bottomRight");
            return back();
        }
        notify()->error("The Message was not sent ", "Error", "bottomRight");
        return back();
    }

    //see message 
    public function seeMessage()
    {
       $messages = Message::with('employee')->paginate(10);

       return view('admin.employee.messages', compact('messages'));
    }

    //delete message
    public function deleteMessage($id)
    {
        $find = Message::where('id', $id);
        if($find->delete()){

            notify()->success("The Message was deleted successfully", "Success", "bottomRight");
            return back();
        }
        notify()->error("The Message was no deleted", "Error", "bottomRight");
        return back();
    }
}
