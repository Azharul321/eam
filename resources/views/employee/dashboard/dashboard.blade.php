@extends('employee.app')

@section('content')
<div class="card mt-3">
    <div class="row">
        <div class="d-inline m-1 col"><a href="{{route('inTime')}}" style="height: 200px;font-size: 40px;" class="btn btn-block {{$isAttend ? 'disabled btn-success':'btn-primary'}}" onclick="return confirm('Are you sure to In?');">In Time : {{$isAttend?$isAttend->inTime:''}}</a></div>
        <div class="d-inline m-1 col"><a href="{{route('outTime')}}"  style="height: 200px;font-size: 40px;" class="btn   btn-block {{$isOut ? 'btn-warning':'disabled btn-dark'}}" onclick="return confirm('Are you sure to Out?');">Out Time: {{$isAttend?$isAttend->outTime:''}}</a></div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline">Attendance History of last 30 days </h5>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Date</th>
                            <th>In time</th>
                            <th>Out time</th>
                            <th>Late</th>
                            <td>Total works</td>
                            
                        </tr>
                        @foreach ($last30 as $item)
                            <tr>
                                <td>{{$item->date}}</td>
                                <td>{{$item->inTime}}</td>
                                <td>{{$item->outTime}}</td>
                                <td>{{$item->late}}</td>
                                <td>{{$item->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection