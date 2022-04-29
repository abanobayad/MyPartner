@extends('Admin.layout')

@section('content')
    <a class="btn btn-sm btn-secondary mb-5" style="float: right" href="{{ route('admin.cat.index') }}">Back</a>
    <form method="POST" action="{{ route('admin.cat.doCreate') }}" enctype="multipart/form-data">
        @csrf
        @include('Admin.inc.errors')
        <h6 class="mb-3">Categories / Add New Category</h6>
        <div class="mb-3">
            <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id }}">
            <label class="form-label">Enter Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Category Image</label>
            <input type="file" class="form-control" name="image">
        </div>


        <button style="float:right" type="submit" class="btn btn-secondary">Add</button>
    </form>







    <div class="row">
        <div class="col-12">
            <form class="form repeater-default" method="POST" action="{{ route('admin.cat.doCreate2') }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id }}">
                <div data-repeater-list="group_a">
                    <div data-repeater-item>
                        <div class="row justify-content-between">
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="Name">Name </label>
                                <input type="text" class="form-control" name="name[]" required placeholder="Enter Name of Category">
                            </div>

                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="Image">Image </label>
                                <input type="file" class="form-control" name="image[]" >
                            </div>


                            {{-- Delete Button --}}
                            <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                <button class="btn btn-danger" data-repeater-delete type="button"> <i
                                        class="mdi mdi-x"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col p-0">
                        <button class="btn btn-primary" data-repeater-create type="button"><i class="mdi mdi-plus"></i>
                            Add
                        </button>
                    </div>

                    <div class="col p-0">
                        <button class="btn btn-success"  type="submit"><i class="mdi mdi-account"></i>
                          Done
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
