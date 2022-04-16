@extends('Admin.layout')

@section('content')
<div class=" d-felx justify-content-between mb-2">
    <h4 style="display: inline-block">Users</h4>
</div>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
        <br>
        <table class="table text-center">
          <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody id="tableData">
              {{-- Start Fetch Data --}}
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                {{-- class="btn-lg text-dark"><i class="menu-icon mdi mdi-border-color"></i></a>
                class="btn-lg text-danger"><i class="menu-icon mdi mdi-delete-sweep"></i></a> --}}
                <td><a  href="{{route('admin.user.show', $user->id)}}" class="btn btn-sm  btn-outline-dark">Show Profile <i class="menu-icon mdi mdi-account-circle"></i></a></td>
            </tr>
        @endforeach
            {{-- End Fetch Data --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>


@endsection
