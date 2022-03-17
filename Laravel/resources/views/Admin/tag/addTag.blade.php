@extends('Admin.layout')

@section('content')

<a  class="btn btn-sm btn-secondary mb-5" style="float: right" href="{{route('admin.tag.index')}}">Back</a>
<form method="POST" action="{{route('admin.tag.doCreate')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id}}">

    @include('Admin.inc.errors')
    <h6 class="mb-3">Tags / Add New Tag</h6>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Enter Tag Name</label>
      <input type="text" name="name" class="form-control" value="{{old('name')}}">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Upload Tag Image</label>
        <input name="image" type="file" class="form-control"  >
    </div>
    <button style="float:right" type="submit" class="btn btn-secondary">Add</button>
  </form>

@endsection
