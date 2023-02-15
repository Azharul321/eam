@extends('admin.app')

@section('content')
<style>
    .azhar {
        width: auto;
        max-height: 100px;
        overflow: auto;
        text-align: justify;
        white-space: pre-wrap;
    
    }
</style>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-inline">Messages</h5>
                    @if ($message2 = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message2 }}</strong>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>To Name</th>
                                <th>To Email</th>
                                <th>Message</th>
                                <td>Actions</td>
                            </tr>
                            @foreach ($messages as $key => $item)
                                <tr>
                                    <td>{{$key++}}</td>
                                    <td><a href="{{route('employeeDetails',$item->employee->id)}}">{{$item->employee->fullName}}</a></td>
                                    <td><a href="{{route('employeeDetails',$item->employee->id)}}">{{$item->employee->email}}</a></td>
                                    <td> <div class="azhar">{{$item->message}}</div></td>
                                    <td>
                                        <a onclick="return confirm('Are you sure you want to delete this Message?');" href="{{route('deleteMessage', $item->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <nav aria-label="...">
                    @if ($messages->lastPage() > 1)
                        <ul class="pagination justify-content-center">
                            <li class="page-item {{ $messages->currentPage() == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $messages->url($messages->currentPage() - 1) }}"
                                    tabindex="-1">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $messages->lastPage(); $i++)
                                <li class="page-item {{ $messages->currentPage() == $i ? 'active' : '' }}"><a
                                        class="page-link" href=" {{ $messages->url($i) }}">{{ $i }}</a></li>
                            @endfor

                            <li
                                class="page-item {{ $messages->currentPage() == $messages->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $messages->url($messages->currentPage() + 1) }}">Next</a>
                            </li>
                        </ul>
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endsection
