@extends('Admin.layout')

@section('content')

    <h4 style="display: inline-block">Groups</h4>
    <a class="btn btn-sm btn-primary" style="float: right" href="{{route('admin.group.create')}}">Add New</a></div>

<div class="table-responsive">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($groups as $group)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$group->name}}</td>
          <td>{{$group->category->name}}</td>
          <td>
            <a  href="{{route('admin.group.edit' , $group->id)}}" class="btn btn-sm btn-dark text-white">Edit</a>
            <a  href="{{route('admin.group.delete' , $group->id)}}" class="btn btn-sm btn-danger text-white">Delete</a>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>



@endsection
