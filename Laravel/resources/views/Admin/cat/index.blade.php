@extends('Admin.layout')

@section('content')
    <div class=" d-felx justify-content-between mb-2">
        <h4 style="display: inline-block">Categories</h4>
        <a class="btn btn-sm btn-secondary" style="float: right" href="{{ route('admin.cat.create') }}">Add New</a>
    </div>


    <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
     <br>
    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="tableData">
                {{-- Start Fetch Data --}}
                @foreach ($cats as $cat)
                    {{-- {{dd($cat->admin)}} --}}
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->admin->name }}</td>

                        @if ($cat->image == null)
                            <td>
                                <div>No Image for This Category</div>
                            </td>
                        @else
                            <td>
                                <img src="{{ asset('uploads/Categories') . '/' . $cat->image }}">
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('admin.cat.edit', $cat->id) }}"
                                class="btn btn-sm btn-dark text-white">Edit</a>
                            <a href="{{ route('admin.cat.delete', $cat->id) }}"
                                class="btn btn-sm btn-danger text-white ">Delete</a>
                        </td>
                    </tr>
                @endforeach
                {{-- End Fetch Data --}}
            </tbody>
        </table>
    </div>
@endsection
