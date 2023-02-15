@extends('admin.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-inline">Attendance History of </h5>
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
                                <td>Toal works</td>
                                
                            </tr>
                            @foreach ($empAttendance as $item)
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
