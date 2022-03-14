@extends('Admin.layout')

@section('content')

<a  class="btn btn-sm btn-primary mb-5" style="float: right" href="{{route('admin.cat.index')}}">Back</a>
<form method="POST" action="{{route('admin.cat.doEdit')}}" >
    @csrf
    @include('Admin.inc.errors')
    <h4>Edit / {{$cat->name}} </h4>
    <div class="mb-3">
        <input type="hidden" name="id" value=" {{$cat->id}}">
      <label for="exampleInputEmail1" class="form-label">Enter Category Name</label>
      <input type="text" name="name" class="form-control" value="{{$cat->name}}">
    </div>
    <button  type="submit" class="btn btn-primary">Edit</button>
  </form>


@endsection
