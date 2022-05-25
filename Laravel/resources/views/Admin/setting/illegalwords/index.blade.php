@extends('Admin.layout')

@section('content')
    <div class=" d-felx justify-content-between mb-2">
        <h4 style="display: inline-block">Illegal Words</h4>
        <a class="btn btn-sm btn-secondary" style="float: right" href="{{ route('admin.word.create') }}">Add New</a>
    </div>


    <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
    <br>
    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Word</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="tableData">
                {{-- Start Fetch Data --}}
                @foreach ($words as $word)
                    {{-- {{dd($word->admin)}} --}}
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $word->word }}</td>
                        <td>
                            <a href="{{ route('admin.word.edit', $word->id) }}" class="btn-lg text-dark"><i
                                class="menu-icon mdi mdi-border-color"></i></a>
                        <a href="{{ route('admin.word.delete', $word->id) }}" class="btn-lg text-danger"><i
                                class="menu-icon mdi mdi-delete-sweep"></i></a>
                        </td>
                    </tr>
                @endforeach
                {{-- End Fetch Data --}}
                <div class="d-flex justify-content-center">
                    {{ $words->appends(request()->input())->links() }}
                </div>
            </tbody>
        </table>
    </div>
@endsection
