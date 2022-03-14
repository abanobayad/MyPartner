@extends('Admin.layout')

@section('content')

<a  class="btn btn-sm btn-primary mb-5" style="float: right" href="{{route('admin.tag.index')}}">Back</a>
<form method="POST" action="{{route('admin.tag.doCreate')}}" >
    @csrf
    @include('Admin.inc.errors')
    <h6 class="mb-3">Tags / Add New Tag</h6>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Enter Tag Name</label>
      <input type="text" name="name" class="form-control">
    </div>
    <button style="float:right" type="submit" class="btn btn-primary">Add</button>
  </form>

@endsection
