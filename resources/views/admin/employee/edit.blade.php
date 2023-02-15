@extends('admin.app')


@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit {{ $empD->fullName ? $empD->fullName : $empD->email }}'s data</div>
                    <hr />
                    <form action="{{ route('employeeUpdate', $empD->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group ">
                            <label for="fullName">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="fullName" class="form-control" id="fullName"
                                placeholder="Enter Full Name" value="{{ old('fullName', $empD->fullName) }}" />
                            <span class="text-danger">
                                @error('fullName')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="row">
                            <div class="form-group col ">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter Email" value="{{ old('email') }}" />
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col">
                                <label for="password">password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter password Number" value="{{ old('password') }}" />
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col">
                                <label for="typeStatus">Type Status</label>
                                <select class="form-control" name="typeStatus" id="typeStatus">
                                    <option value="1">Full-time</option>
                                    <option value="2">Part-time</option>
                                    <option value="3">Probation</option>
                                    <option value="4">Trainees</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="activeStatus">Active Status</label>
                                <select class="form-control" name="activeStatus" id="activeStatus">
                                    <option value="1">Active</option>
                                    <option value="2">Paused</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <input type="text" name="bio" class="form-control" id="bio"
                                placeholder="Bio" value="{{ old('bio') }}" />
                            <span class="text-danger">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="image">Profile Photo</label>
                                <input type="file" name="profilePhoto" class="form-control" id="image" />
                                <span class="text-danger">
                                    @error('profilePhoto')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col">
                                <img id="image_preview"
                                    src="{{ $empD->details->profilePhoto ? asset('img/profile') . '/' . $empD->email . '/' . $empD->details->profilePhoto : 'https://via.placeholder.com/110x110' }}"
                                    alt="preview image" style="hight:100px; width:100px">
                            </div>
                            <div class="form-group col">
                                <label for="icon">Covar Photo</label>
                                <input type="file" name="covar" class="form-control" id="icon" />
                                <span class="text-danger">
                                    @error('covar')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col">
                                <img id="icon_preview"
                                    src="{{ $empD->details->covar ? asset('img/profile') . '/' . $empD->email . '/' . $empD->details->covar : 'https://via.placeholder.com/800x500' }}"
                                    alt="preview image" style="hight:100px; width:100px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" placeholder="Enter a valid Address">{{ old('address', $empD->address) }}</textarea>
                            <span class="text-danger">
                                @error('details')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="username"> User name</label>
                                <input type="text" name="username" class="form-control" id="username"
                                    placeholder="Enter  User name" value="{{ old('username', $empD->username) }}" />
                            </div>
                            <div class="form-group col">
                                <label for="dob">DOB</label>
                                <input type="date" name="dob" class="form-control" id="dob"
                                    placeholder="Enter Meta Keys" value="{{ old('dob', $empD->details->dob) }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="startDate">Join Date</label>
                            <input type="date" name="startDate" class="form-control" id="startDate"
                                placeholder="Join Date"
                                value="{{ old('startDate', $empD->details->startDate) }}" />
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="designation"> Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation"
                                    placeholder="Enter Designation" value="{{ old('designation', $empD->details->designation) }}" />
                            </div>
                            <div class="form-group col">
                                <label for="phone"> Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    placeholder="Enter  phone"
                                    value="{{ old('phone', $empD->phone) }}" />
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <button type="submit" class="btn btn-light px-5">
                                <i class="icon-lock"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
