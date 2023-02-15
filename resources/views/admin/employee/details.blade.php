@extends('admin.app')

@section('content')
    <style>
        .azhar {
            width: auto;
            max-height: 300px;
            overflow: auto;
            text-align: justify;
            white-space: pre-wrap;

        }
    </style>
    
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body pt-5">
                        @if ($empD->details->profilePhoto)
                            <img src="{{ asset('img/profile') . '/' . $empD->email . '/' . $empD->details->profilePhoto }}"
                                alt="profile-image" class="profile" style="height: 110; width:110px" />
                        @else
                            <img src="https://via.placeholder.com/110x110" style="height: 110px; width: 110px;" alt="profile-image"
                                class="profile" />
                        @endif
        
                        <h5 class="card-title mt-2">{{ $empD->fullName }}</h5>
                        <p class="card-text">
                            {{ $empD->details->bio }}
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Actions</th>
                                <td>
                                    <a href="{{ route('employeeEdit', $empD->id) }}" class="btn btn-info">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete this item?');"
                                        href="{{ route('employeeDelete', $empD->id) }}" class="btn btn-danger">Delete</a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                            Send Message
                                          </button>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">This Details Under development</th>
                              
                            </tr>
                            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Button trigger modal -->
 
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <form action="{{route('sendMessage',$empD->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="message">Message:</label>
                  <textarea name="message" class="form-control bg-info" id="message" cols="30" rows="10" required></textarea>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection
