@extends('Admin.layout')

@section('content')

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
        <label for="exampleInputEmail1" class="form-label ">Select Group Category</label>
        <select name="category_id" class="alert-dark mx-2">
            <option value="{{$tag->category->id}}">{{$tag->category->name}}</option>
            @foreach ($categories as $category)
            <option class="btn btn-outline-dark" value="{{$category->id}}" > {{$category->name}} </option>
            @endforeach
        </select>
        @error('category_id')<span class="text-danger">{{$message}}</span>@enderror

    </div>

    <div class="mb-3">
        <label  class="form-label">Tag Current Image</label>
        <div class="col-4  mb-5">
            <img src="{{asset('uploads/Tags').'/'.$tag->image}}" alt="{{$tag->name}}" class="mb-3 col-12">
            <div style="float: right"><input class="form-control"  type="file" accept="image/png, image/jpg, image/jpeg" name="image" value="{{$tag->name}}"></div>
        </div>
</div>
    <button  type="submit" class="btn btn-secondary">Edit</button>
  </form>


@endsection
