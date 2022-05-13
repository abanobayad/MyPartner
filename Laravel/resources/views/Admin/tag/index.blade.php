@extends('Admin.layout')

@section('content')
    <div class=" d-felx justify-content-between mb-2">
        <h4 style="display: inline-block">Tags</h4>
        <a class="btn btn-sm btn-secondary" style="float: right" href="{{ route('admin.tag.create') }}">Add New</a>
    </div>

    <input class="form-control opacity-50 " id="myInput" type="text" placeholder="Search Table">
    <br>
    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Created by</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="tableData">
                {{-- Start Fetch Data --}}
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->category->name }}</td>
                        <td>{{ $tag->admin->name }}</td>
                        @if ($tag->image == null)
                            <td>
                                <div>No Image for This Category</div>
                            </td>
                        @else
                            <td>
                                <img style="object-fit: cover" src="{{ asset('uploads/Tags') . '/' . $tag->image }}">
                            </td>
                        @endif
                        <td>

                            <a href="{{ route('admin.tag.edit', $tag->id) }}" class="btn-lg text-dark"><i
                                    class="menu-icon mdi mdi-border-color"></i></a>
                            <a href="{{ route('admin.tag.delete', $tag->id) }}" class="btn-lg text-danger"><i
                                    class="menu-icon mdi mdi-delete-sweep"></i></a>
                            <a href="{{ route('admin.tag.show', $tag->id) }}" class="btn-lg text-primary"><i
                                    class="menu-icon mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                {{-- End Fetch Data --}}
                <div class="d-flex justify-content-center">
                    {{ $tags->appends(request()->input())->links() }}
                </div>
            </tbody>
        </table>
    </div>
@endsection
