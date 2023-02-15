@extends('admin.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-inline">Employee list</h5> <a href="{{route('EmployeeCreatePage')}}" class="btn btn-success" style="float: right; margin-top: -15px;">Add new employe</a>
                    @if ($message2 = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message2 }}</strong>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <td>Actions</td>
                                
                            </tr>
                            @foreach ($empList as $item)
                                <tr>
                                    <td>{{$item->fullName}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->fullName}}</td>
                                    <td>
                                        <a href="{{route('employeeAttendance',$item->id)}}" class="btn btn-success btn-sm">Attendance</a>
                                        <a href="{{route('employeeDetails',$item->id)}}" class="btn btn-info btn-sm">details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection
