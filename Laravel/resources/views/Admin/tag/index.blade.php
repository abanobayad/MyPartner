@extends('Admin.layout')

@section('content')
<div class=" d-felx justify-content-between mb-2">
    <h4 style="display: inline-block">Tags</h4>
    <a class="btn btn-sm btn-secondary" style="float: right" href="{{route('admin.tag.create')}}">Add New</a>
</div>
<table class="table " >
    <thead>
      <tr   >
        <th  scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Created by</th>
        <th scope="col">Image</th>
        <th  scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$tag->name}}</td>
          <td>{{$tag->admin->name}}</td>
          @if ($tag->image == null)
          <td>  <div>No Image for This Category</div></td>
          @else
                <td>
                    <img src="{{asset('uploads/Tags').'/'.$tag->image}}" >
                </td>
          @endif
          <td>
            <a  href="{{route('admin.tag.edit' , $tag->id)}}" class="btn btn-sm btn-dark text-white">Edit</a>
            <a  href="{{route('admin.tag.delete' , $tag->id)}}" class="btn btn-sm btn-danger text-white">Delete</a>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>




@endsection
