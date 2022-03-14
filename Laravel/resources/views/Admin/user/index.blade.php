@extends('Admin.layout')

@section('content')
<div class=" d-felx justify-content-between mb-2">
    <h4 style="display: inline-block">Users</h4>
    <a class="btn btn-sm btn-primary" style="float: right" href="{{route('admin.user.create')}}">Add New</a>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">E-mail</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($cats as $cat)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$cat->name}}</td>
          <td>{{$cat->email}}</td>
          <td>
            <a  href="{{route('admin.user.edit' , $cat->id)}}" class="btn btn-sm btn-dark text-white">Edit</a>
            <a  href="{{route('admin.user.delete' , $cat->id)}}" class="btn btn-sm btn-danger text-white">Delete</a>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>




@endsection
