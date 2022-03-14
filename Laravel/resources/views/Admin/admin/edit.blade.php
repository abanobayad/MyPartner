@extends('Admin.layout')


@section('content')


<div class="col-md-6 grid-margin stretch-card m-auto">
    <div class="card">
      <div class="card-body">
          @include('Admin.inc.errors')
          @include('Admin.inc.message')
        <h4 class="card-title">Edit</h4>
        <p class="card-description">
            Edit Your Information
        </p>
        <form class="forms-sample" method="POST" action="{{route('do-editAdmin')}}" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">Name</label>
            <input type="text" name="name" class="form-control"  value="{{$admin->name}}" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" value="{{$admin->email}}"  placeholder="Email">
          </div>
          <div class="form-group">
          <label for="exampleInputEmail1">Change Your Image</label>
          <input type="file" class="form-control"  name="image" placeholder="Email">
        </div>
        <div class="card p-2 mb-3">
            <p class="card-description">
                Change Your password
            </p>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="New Password">
              </div>
              <div class="form-group">
                <label for="exampleInputConfirmPassword1">Confirm Password</label>
                <input type="password" class="form-control"  name="password_confirmation" placeholder="Confirm Password">
              </div>
        </div>
          <button type="submit" class="btn btn-primary me-2">Edit</button>
        </form>
      </div>
    </div>
  </div>





@endsection
