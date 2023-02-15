<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Show login page

    public function loginPage() 
    {
		$checEmp = Employee::where('email', session()->get('email'))->first();
		$checAdm = User::where('email', session()->get('email'))->first();
		if($checEmp){
			return redirect()->route('EmployeeDashboard');
		}
		elseif($checAdm ){
			return redirect()->route('AdminDashboard');
		}
        return view('auth.login');
    }

    //Login
    public function login(Request $request){

		//validate request

		$request->validate([
			'email'=>'required|email',
			'password'=>'required|min:5|max:12'

		]);

		$empInfo = Employee::where('email', $request->email)->first();
        $adminInfo = User::where('email', $request->email)->first();

		if(!$empInfo && !$adminInfo){
			return back()->with('fail','We do not recogonise your email address');
		}else{
			//check admin or admin
            if($adminInfo){
                if(Hash::check($request->password, $adminInfo->password)){
                    $request->session()->put('email', $adminInfo->email);
                    return redirect()->route('AdminDashboard');
    
                }else{
                    return back()->with('fail','Incorrect password');
                }
            }else{
                
			if(Hash::check($request->password, $empInfo->password)){
				$sessPhoto = EmployeeDetails::where('employeeId',$empInfo->id)->pluck('profilePhoto')->first();
				$request->session()->put('pp', $sessPhoto);
				$request->session()->put('fullName', $empInfo->fullName);
				$request->session()->put('email', $empInfo->email);
				return redirect()->route('EmployeeDashboard');

			}else{
				return back()->with('fail','Incorrect password');
			}
            }
            

		}
	}

    //Log out

    public function logout(){
		if(session()->has('email')){
			session()->pull('email');
			session()->flush();
			return redirect()->route('loginPage');
		}
	}
}
