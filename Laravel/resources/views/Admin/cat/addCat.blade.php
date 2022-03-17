@extends('Admin.layout')

@section('content')

<a  class="btn btn-sm btn-primary mb-5" style="float: right" href="{{route('admin.cat.index')}}">Back</a>
<form method="POST" action="{{route('admin.cat.doCreate')}}" enctype="multipart/form-data" >
    @csrf
    @include('Admin.inc.errors')
    <h6 class="mb-3">Categories / Add New Category</h6>
    <div class="mb-3">
        <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id}}">
      <label  class="form-label">Enter Category Name</label>
      <input type="text" name="name" class="form-control" value="{{old('name')}}">
    </div>

    <div class="mb-3">
        <label  class="form-label">Upload Category Image</label>
        <input type="file"class="form-control"  name="image">
    </div>


    <button style="float:right" type="submit" class="btn btn-primary">Add</button>
  </form>

@endsection
