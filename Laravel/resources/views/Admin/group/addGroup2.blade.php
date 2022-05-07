@extends('Admin.layout')

@section('content')

    <form method="POST" action="{{ route('admin.group.doCreate') }}" enctype="multipart/form-data">
        @csrf
        @include('Admin.inc.errors')


        <h6 class="mb-3">Groups / Add New Group</h6>


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label ">Selected Category
                <div class="badge bg-success">
                    {{ $category->name }}
                </div>
            </label>
        </div>

        <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id }}">
        <input type="hidden" name="category_id" value="{{$category->id}}">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter Group Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')<span class="text-danger">Group Name is required</span>@enderror

        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter Group Description</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
            @error('description')<span class="text-danger">{{$message}}</span>@enderror

        </div>




        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Upload Group Image</label>
            <input type="file" accept="image/png, image/jpg, image/jpeg" alt="Group-image" class="form-control" name="image">
            @error('image')<span class="text-danger">{{$message}}</span>@enderror

        </div>


        <div class="mb-3 alert-dark px-3">
            <label for="exampleInputEmail1" class="form-label">Select Group Tags</label>
            <div class="pb-3">
                @foreach ($tags as $tag)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="tag[]" class="form-check-input" value="{{$tag->id}}" {{session()->has('search_tag') && in_array($tag->id , session()->get('search_tag')) ? 'checked' : '' }}>
                            {{ $tag->name }}
                        </label>

                    </div>
                @endforeach
                @error('tag')<span class="text-danger">{{$message}}</span>@enderror

            </div>
        </div>

        <button style="float:right" type="submit" class="btn btn-sm btn-outline-secondary">Add</button>
    </form>
@endsection
