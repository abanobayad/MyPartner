@extends('Admin.layout')

@section('content')
<h6 class="mb-3">Groups / Add New Group / Select Group Category</h6>

<div class="row">
    <div class="col-md-12">
        <input class="form-control opacity-50 " id="myInput" type="text" placeholder="Search Table">
        <br>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Select</th>
                </tr>
            </thead>
            <tbody id="tableData">
                {{-- Start Fetch Data --}}
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('admin.group.doCreate1', $category->id) }}" class="btn btn-sm btn-dark text-light">Select</a>
                        </td>
                    </tr>
                @endforeach
                {{-- End Fetch Data --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
