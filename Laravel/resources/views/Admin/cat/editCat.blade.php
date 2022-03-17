@extends('Admin.layout')

@section('content')

<a  class="btn btn-sm btn-primary mb-5" style="float: right" href="{{route('admin.cat.index')}}">Back</a>
<form method="POST" action="{{route('admin.cat.doEdit')}}" enctype="multipart/form-data" >
    @csrf
    @include('Admin.inc.errors')
    <h4>Edit / {{$cat->name}} </h4>
    <div class="mb-3">
        <input type="hidden" name="id" value=" {{$cat->id}}">
        <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id}}">
      <label for="exampleInputEmail1" class="form-label">Enter Category Name</label>
      <input type="text" name="name" class="form-control" value="{{$cat->name}}">
    </div>

    <div class="mb-3">
            <label  class="form-label">Category Current Image</label>
            <div class="col-4  mb-5">
                <img src="{{asset('uploads/Categories').'/'.$cat->image}}" alt="{{$cat->name}}" class="mb-3 col-12">
                <div style="float: right"><input class="form-control"  type="file" name="image" value="{{$cat->name}}"></div>
            </div>
    </div>

    <button  type="submit" class="btn btn-primary">Edit</button>
  </form>


@endsection
