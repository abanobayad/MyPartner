@extends('Admin.layout')

@section('content')
    <h4 style="display: inline-block">Groups</h4>
    <a class="btn btn-sm btn-secondary" style="float: right" href="{{ route('admin.group.create1') }}">Add New</a></div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <input class="form-control opacity-50 " id="myInput" type="text" placeholder="Search Table">
                <br>
                <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        {{-- Start Fetch Data --}}
                        @foreach ($groups as $group)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->category->name }}</td>

                                @if ($group->image == null)
                                    <td>
                                        <div>No Image for This Category</div>
                                    </td>
                                @else
                                    <td>
                                        <img style="object-fit: cover" src="{{ asset('uploads/Groups') . '/' . $group->image }}"
                                            alt="{{ $group->name }}">
                                    </td>
                                @endif


                                <td>
                                    <a href="{{ route('admin.group.edit', $group->id) }}" class="btn-lg text-dark"><i
                                            class="menu-icon mdi mdi-border-color"></i></a>
                                    <a href="{{ route('admin.group.delete', $group->id) }}" class="btn-lg text-danger"><i
                                            class="menu-icon mdi mdi-delete-sweep"></i></a>
                                    <a href="{{ route('admin.group.show', $group->id) }}" class="btn-lg text-primary"><i
                                            class="menu-icon mdi mdi-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- End Fetch Data --}}
                        <div class="d-flex justify-content-center">
                            {{ $groups->appends(request()->input())->links() }}
                        </div>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
