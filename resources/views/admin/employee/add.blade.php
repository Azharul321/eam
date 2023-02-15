@extends('admin.app')


@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Create new employee</div>
                    <hr />
                    <form action="{{route('EmployeeCreate')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group ">
                            <label for="fullName">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="fullName" class="form-control" id="fullName" placeholder="Enter Full Name" value="{{ old('fullName') }}" />
                            <span class="text-danger">@error('fullName'){{ $message }}@enderror</span>
                        </div>
                        <div class="row">
                            <div class="form-group col ">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email') }}" />
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group col">
                                <label for="password">password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password Number" value="{{ old('password') }}" />
                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
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
                            <button type="submit" class="btn btn-light px-5">
                                <i class="icon-lock"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
