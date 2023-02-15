@extends('employee.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-4">
            <div class="card profile-card-2">
                <div class="card-img-block">
                    @if ($profile->details->covar)
                    <img class="img-fluid" src="{{asset('img/profile').'/'.$profile->email.'/'.$profile->details->covar}}" alt="Card image cap" id="image_preview" />
                    @else
                    <img class="img-fluid" src="https://via.placeholder.com/800x500" id="image_preview" alt="Card image cap" />
                    @endif
                    
                </div>
                <div class="card-body pt-5">
                    @if ($profile->details->covar)
                    <img src="{{asset('img/profile').'/'.$profile->email.'/'.$profile->details->profilePhoto}}" id="icon_preview" alt="profile-image" class="profile" /> 
                    @else
                    <img src="https://via.placeholder.com/110x110" alt="profile-image" id="icon_preview" class="profile" />   
                    @endif
                   
                    <h5 class="card-title mt-2">{{$profile->fullName}}</h5>
                    <p class="card-text">
                        {{$profile->details->bio}}.
                    </p>
                    <div class="icon-block">
                        <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                        <a href="javascript:void();">
                            <i class="fa fa-twitter bg-twitter text-white"></i></a>
                        <a href="javascript:void();">
                            <i class="fa fa-google-plus bg-google-plus text-white"></i></a>
                    </div>
                </div>

                <p>under development</p>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                        <li class="nav-item">
                            <a href="javascript:void();" data-target="#profile" data-toggle="pill"
                                class="nav-link active"><i class="icon-user"></i>
                                <span class="hidden-xs">Profile</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i
                                    class="icon-envelope-open"></i>
                                <span class="hidden-xs">Messages</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i
                                    class="icon-note"></i>
                                <span class="hidden-xs">Edit</span></a>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="profile">
                            <h5 class="mb-3">Employee Profile</h5>
                            <h4>more feture uner development</h4>
                            <!--/row-->
                        </div>
                        <div class="tab-pane" id="messages">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>

                                        @foreach ($profile->messages as $item)
                                        <tr>
                                            <td>
                                                <span class="float-right font-weight-bold">{{ $item->created_at->diffForHumans() }}</span>
                                                {{ $item->message}}
                                            </td>
                                        </tr> 
                                        @endforeach
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="edit">
                            <form action="{{route('profileUpdate')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Full name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="fullName" type="text" value="{{ $profile->fullName }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">User name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="username" value="{{ $profile->username }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="email" value="{{ $profile->email }}" disabled/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Change profile</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="profilePhoto" id="icon" type="file" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Change Cover</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="covar" id="image" type="file" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="website" type="url" value="{{$profile->website}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Bio</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="bio" type="text" value="{{$profile->details->bio}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="address" value=""
                                            placeholder="Street" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">DOB</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="date" name="dob" value="{{$profile->dob}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="password" type="password" value="12345" />
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="Cancel" />
                                        <input type="submit" class="btn btn-primary" value="Save Changes" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
