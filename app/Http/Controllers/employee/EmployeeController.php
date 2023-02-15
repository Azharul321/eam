<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //Get Create page
    public function EmployeeCreatePage()
    {
        return view('admin.employee.add');
    }

    //Add Employee

    public function EmployeeCreate(Request $req)
    {
        //validation
        $validate = Validator::make($req->all(), [
            'fullName' => 'required',
            'email' => 'required|email|unique:employees',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        $emp = new Employee();
        $emp->fullName = $req->fullName;
        $emp->email = $req->email;
        $emp->password = Hash::make($req->password);
        $emp->typeStatus = $req->typeStatus;
        $emp->activeStatus = $req->activeStatus;
        $emp->save();

        // create record in details table

        $empD = new EmployeeDetails();
        $empD->employeeId = $emp->id;
        $empD->save();

        return "Added";
    }

    //Employee list in admin pannel

    public function EmployeeList()
    {
        $empList = Employee::all();

        return view('admin.employee.list', compact('empList'));
    }

    //Employee profile

    public function EmployeeProfile()
    {
        $profile = Employee::with('details', 'messages')->where('email', session()->get('email'))->first();
        // dd( $profile );
        return view('employee.profile.profile', compact('profile'));
    }


    //Employee profile update by employee
    // profile Update

    function profileUpdate(Request $request)
    {

        //validation
        $validate = Validator::make($request->all(), [


            'fullName' => 'required',
            'website' => 'nullable|url',
            'password' => 'required|min:5|max:12',
            'profilePhoto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'covar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',



        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }


        $profile = Employee::where('email', session()->get('email'))->first();

        $profile->fullName = $request->fullName;

        $profile->password = Hash::make($request->password);

        $profile->update();

        //update on Details table

        $profileDetail = EmployeeDetails::where('employeeId', $profile->id)->first();
        $profileDetail->website = $request->website;
        $profileDetail->address = $request->address;
        $profileDetail->bio = $request->bio;
        $profileDetail->username = $request->username;
        $profileDetail->dob = $request->dob;
        $profileDetail->gender = $request->gender;
        $profileDetail->startDate = $request->startDate;
        $profileDetail->designation = $request->designation;
        $profileDetail->phone = $request->phone;


        $ImageName_02 = $profile->profilePhoto;


        //profilePhoto
        if ($request->profilePhoto) {
            $profilePhotoName = rand(11111, 99999) . '.' . $request->profilePhoto->getClientOriginalExtension();
            $profileDetail->profilePhoto = $profilePhotoName;
        }


        $covarName = $profile->covar;
        if ($request->covar) {
            $covar_01 = rand(11111, 99999) . '.' . $request->covar->getClientOriginalExtension();
            $profileDetail->covar = $covar_01;
        }

        $profileDetail->update();


        if ($profile->update() && $profileDetail->update()) {


            //oG image

            if ($request->hasFile('profilePhoto')) {
                $request->profilePhoto->move(public_path('img/profile/' . $profile->email . '/'), $profilePhotoName);

                $imagePath2 = public_path('img/profile/' . $profile->email . '/' . $ImageName_02);
                if (File::exists($imagePath2)) {
                    File::delete($imagePath2);
                }
            }

            //covar

            if ($request->hasFile('covar')) {
                $request->covar->move(public_path('img/profile/' . $profile->email . '/'), $covar_01);

                $imagePath3 = public_path('img/profile/' . $profile->email . '/' . $covarName);
                if (File::exists($imagePath3)) {
                    File::delete($imagePath3);
                }
            }

            notify()->success("Data sucessfully updated", "Success", "bottomRight");
            return redirect()->back();
        }
        notify()->error("Something went wrong, Please check properly", "Error", "bottomRight");
        return back()->with('fail', '');
    }

    // See Employee details in Admin page
    public function employeeDetails($id)
    {
        $empD = Employee::with('details')->where('id', $id)->first();

        return view('admin.employee.details', compact('empD'));
    }

    // get Employee Edit in Admin page
    public function employeeEdit($id)
    {
        $empD = Employee::with('details')->where('id', $id)->first();

        return view('admin.employee.edit', compact('empD'));
    }

    // Update Employee details in Admin page
    public function employeeUpdate(Request $request, $id)
    {
        //validation
        $validate = Validator::make($request->all(), [


            'fullName' => 'required',
            'website' => 'nullable|url',
            'password' => 'required|min:5|max:12',
            'profilePhoto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'covar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',



        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }


        $profile = Employee::where('id', $id)->first();

        $profile->fullName = $request->fullName;

        $profile->password = Hash::make($request->password);

        $profile->update();

        //update on Details table

        $profileDetail = EmployeeDetails::where('employeeId', $profile->id)->first();
        $profileDetail->website = $request->website;
        $profileDetail->address = $request->address;
        $profileDetail->bio = $request->bio;
        $profileDetail->username = $request->username;
        $profileDetail->dob = $request->dob;
        $profileDetail->gender = $request->gender;
        $profileDetail->startDate = $request->startDate;
        $profileDetail->designation = $request->designation;
        $profileDetail->phone = $request->phone;

        $ImageName_02 = $profile->profilePhoto;


        //profilePhoto
        if ($request->profilePhoto) {
            $profilePhotoName = rand(11111, 99999) . '.' . $request->profilePhoto->getClientOriginalExtension();
            $profileDetail->profilePhoto = $profilePhotoName;
        }


        $covarName = $profile->covar;
        if ($request->covar) {
            $covar_01 = rand(11111, 99999) . '.' . $request->covar->getClientOriginalExtension();
            $profileDetail->covar = $covar_01;
        }
        $profileDetail->update();

        if ($profile->update() && $profileDetail->update()) {


            //oG image

            if ($request->hasFile('profilePhoto')) {
                $request->profilePhoto->move(public_path('img/profile/' . $profile->email . '/'), $profilePhotoName);

                $imagePath2 = public_path('img/profile/' . $profile->email . '/' . $ImageName_02);
                if (File::exists($imagePath2)) {
                    File::delete($imagePath2);
                }
            }

            //covar

            if ($request->hasFile('covar')) {
                $request->covar->move(public_path('img/profile/' . $profile->email . '/'), $covar_01);

                $imagePath3 = public_path('img/profile/' . $profile->email . '/' . $covarName);
                if (File::exists($imagePath3)) {
                    File::delete($imagePath3);
                }
            }

            notify()->success("Data sucessfully updated", "Success", "bottomRight");
            return redirect()->route('employeeDetails', $profile->id);
        }
        notify()->error("Something went wrong, Please check properly", "Error", "bottomRight");
        return back()->with('fail', '');
    }

    // Delete Employee details in Admin page
    public function employeeDelete($id)
    {
    }
}
