@extends('Admin.layout')

@section('content')

<a  class="btn btn-sm btn-secondary mb-5" style="float: right" href="{{route('admin.tag.index')}}">Back</a>
<form method="POST" action="{{route('admin.tag.doEdit')}}" enctype="multipart/form-data" >
    @csrf
    <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id}}">

    @include('Admin.inc.errors')
    <h4>Edit / {{$tag->name}} </h4>
    <div class="mb-3">
        <input type="hidden" name="id" value=" {{$tag->id}}">
      <label for="exampleInputEmail1" class="form-label">Enter Tag Name</label>
      <input type="text" name="name" class="form-control" value="{{$tag->name}}">
    </div>
    <div class="mb-3">
        <label  class="form-label">Tag Current Image</label>
        <div class="col-4  mb-5">
            <img src="{{asset('uploads/Categories').'/'.$tag->image}}" alt="{{$tag->name}}" class="mb-3 col-12">
            <div style="float: right"><input class="form-control"  type="file" name="image" value="{{$tag->name}}"></div>
        </div>
</div>
    <button  type="submit" class="btn btn-secondary">Edit</button>
  </form>


@endsection
