<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Socialite;

class SocialController extends Controller
{
     //Login With Google

     public function redirectToGoogle()
     {
         return Socialite::driver('google')->redirect();
     }
 
 
     public function handleGoogleCallback()
     {
         try {
     
             $user = Socialite::driver('google')->stateless()->user();
             // dd($user);
             $finduser = Employee::where('google_id', $user->id)->first();

             $sessPhoto = EmployeeDetails::where('employeeId',$finduser->id)->pluck('profilePhoto')->first();
      
             if($finduser){
      
                Session::put('email',$user->email);
                Session::put('pp', $sessPhoto);
                Session::put('fullName', $finduser->fullName);
     
                 return redirect()->route('EmployeeDashboard');
      
             }else{

                $nEmp = new Employee();
                $nEmp->email = $user->email;
                $nEmp->fullName = $user->name;
                $nEmp->google_id = $user->id;
                $nEmp->typeStatus = 1;
                $nEmp->activeStatus = 1;
                $nEmp->password = Hash::make('12345');

                $nEmp->save();

                $nEmpD = new EmployeeDetails();
                $nEmpD->employeeId = $nEmp->id;
                $nEmpD->save();
                
                Session::put('email',$nEmp->email);
                 
      
                 return redirect()->route('EmployeeDashboard');
             }
     
         } catch (Exception $e) {
             dd($e->getMessage());
         }
     }
 
 
}
