@extends('Admin.layout')

@section('content')

<form method="POST" action="{{route('admin.group.doCreate')}}" enctype="multipart/form-data" >
    @csrf
    @include('Admin.inc.errors')

    <h6 class="mb-3">Groups / Add New Group</h6>
    <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id}}">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Enter Group Name</label>
      <input type="text" name="name" class="form-control" value="{{old('name')}}">
      @error('name')<span class="text-danger">Group Name is required</span>@enderror
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Enter Group Description</label>
        <input type="text" name="description" class="form-control" value="{{old('description')}}">
        @error('description')<span class="text-danger">{{$message}}</span>@enderror

      </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label ">Select Group Category</label>
        <select name="category_id" class="alert-dark mx-2">
            <option value=""class="form-control ">Please Select Category</option>
            @foreach ($categories as $category)
            <option class="btn btn-outline-dark" value="{{$category->id}}" > {{$category->name}} </option>
            @endforeach
        </select>
        @error('category_id')<span class="text-danger">{{$message}}</span>@enderror

    </div>


    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Upload Group Image</label>
        <input type="file" alt="Group-image" class="form-control"  name="image">
        @error('image')<span class="text-danger">{{$message}}</span>@enderror

    </div>


    <div class="mb-3 alert-dark px-3">
        <label for="exampleInputEmail1" class="form-label">Select Group Tags</label>
        <div class="pb-3">
            @foreach ($tags as $tag)
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" name="tag[]" class="form-check-input" value="{{$tag->id}}" }}> {{$tag->name}}
                </label>
            </div>
        @endforeach
        </div>
        @error('tag[]')<span class="text-danger">{{$message}}</span>@enderror

      </div>

    <button style="float:right" type="submit" class="btn btn-sm btn-outline-secondary">Add</button>
  </form>

@endsection
