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
                    <th scope="col">No. of related tags</th>
                    <th scope="col">No. of related groups</th>
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
                        <td class=" fw-bold {{$cat->tags->count() == 0 ? 'text-danger' : 'text-success'}}">{{ $cat->tags->count() }}</td>
                        <td class=" fw-bold {{$cat->tags->count() == 0 ? 'text-danger' : 'text-success'}}">{{ $cat->groups->count() }}</td>
                        <td>{{ $cat->admin->name }}</td>

                        @if ($cat->image == null)
                            <td>
                                <div>No Image for This Category</div>
                            </td>
                        @else
                            <td>
                                <img style="object-fit: cover" src="{{ asset('uploads/Categories') . '/' . $cat->image }}">
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('admin.cat.edit', $cat->id) }}" class="btn-lg text-dark"><i
                                class="menu-icon mdi mdi-border-color"></i></a>
                        <a href="{{ route('admin.cat.delete', $cat->id) }}" class="btn-lg text-danger"><i
                                class="menu-icon mdi mdi-delete-sweep"></i></a>
                        <a href="{{ route('admin.cat.show', $cat->id) }}" class="btn-lg text-primary"><i
                                    class="menu-icon mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                {{-- End Fetch Data --}}
                <div class="d-flex justify-content-center">
                    {{ $cats->appends(request()->input())->links() }}
                </div>
            </tbody>
        </table>
    </div>
@endsection
