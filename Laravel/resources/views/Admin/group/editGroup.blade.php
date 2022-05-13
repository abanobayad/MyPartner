@extends('Admin.layout')

@section('content')

<div class="row">
    <div class="container">
        <form method="POST" action="{{route('admin.group.doEdit')}}" enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id}}">

            @include('Admin.inc.errors')
            <h4>Edit / {{$group->name}} </h4>
            <div class="mb-3">
                <input type="hidden" name="id" value=" {{$group->id}}">
              <label  class="form-label">Enter Group Name</label>
              <input type="text" name="name" class="form-control" value="{{$group->name}}">
            </div>

            <div class="mb-3">
                <label  class="form-label">Enter Group Description</label>
                <input type="text" name="description" class="form-control" value="{{$group->description}}">
              </div>

              <div class="mb-3">
                <label  class="form-label">Group Image</label>
                <div class="col-4  mb-5">
                    <img  style="object-fit:cover" src="{{asset('uploads/Groups').'/'.$group->image}}" alt="{{$group->name}}" class="mb-3" style="width: 200px ; height: 150px;">
                    <div style="float: right"><input class="form-control"  type="file" name="image"></div>
                </div>
              </div>

            <div class="mb-3">
                <label  class="form-label">Select Group Category</label>
                <select name="category_id" class="alert-dark">
                    @foreach ($categories as $category)
                    <option class="btn btn-outline-dark" value="{{$category->id}}"
                        @if ($category->id == $group->category->id)
                        selected
                        @endif
                        > {{$category->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label  class="form-label">Select Group Tags</label>
                <div class="pb-3">
                    @foreach ($tags as $tag)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="tag[]" class="form-check-input" value="{{$tag->id}}"  {{in_array($tag->name , $tags_array) ? 'checked' : '' }}> {{$tag->name}}
                        </label>
                    </div>
                @endforeach
                </div>
              </div>
            <button  type="submit" class="btn btn-secondary">Edit</button>
          </form>
    </div>
</div>
@endsection
