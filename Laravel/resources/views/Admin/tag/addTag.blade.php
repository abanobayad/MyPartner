@extends('Admin.layout')

@section('content')




{{-- <form method="POST" action="{{ route('admin.tag.doCreate') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id }}">

        @include('Admin.inc.errors')
        <h6 class="mb-3">Tags / Add New Tag</h6>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter Tag Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Upload Tag Image</label>
            <input name="image" type="file" class="form-control">
        </div>
        <button style="float:right" type="submit" class="btn btn-secondary">Add</button>
    </form> --}}




    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="{{ route('admin.tag.doCreate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id }}">
                <div id="myRepeatingFields" >
                    <div class="entry input-group  col-lg-12 col-xs-3">
                        <div class="row justify-content-between">
                            <div class="col-md-4 col-sm-12 form-group">
                                <label class="control-label" for="ourField">Tag Name</label>
                                <input class="form-control" name="name[]" type="text" placeholder="Enter Name" required  />
                                @error('name')<span class="text-danger">{{$message}}</span>@enderror

                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="exampleInputEmail1" class="form-label ">Select Group Category</label>
                                <select name="category_id[]" class="alert-dark mx-2" >
                                    @foreach ($categories as $category)
                                    <option class="btn btn-outline-dark" name="category[]" value="{{$category->id}}" > {{$category->name}} </option>
                                    @endforeach
                                </select>
                                @error('category_id')<span class="text-danger">{{$message}}</span>@enderror

                            </div>

                            <div class="col-md-3 col-sm-12 form-group">
                                <label class="control-label" for="ourField">Image</label>
                                <input class="form-control" name="image[]" type="file"  accept="image/png, image/jpg, image/jpeg" required />
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="col-md-3 col-sm-12 form-group d-flex align-items-center pt-2">
                                <span class="input-group-btn ">
                                    <button type="button" class=" btn-success btn-sm btn-add">
                                        <i class="mdi mdi-plus sm" ></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Done" class="btn btn-dark sm text-light">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
