@extends('Admin.layout')

@section('content')
<div class=" d-felx justify-content-between mb-2">
    <h4 style="display: inline-block">Users</h4>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">E-mail</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>
            <a  href="{{route('ban-detailes', $user->id)}}" class="btn btn-sm btn-dark text-white">Ban Details</a>
            <a  href="{{route('admin.contact.get', $user->id)}}"  class="btn btn-info">Contacts Details</a>
            <a  href="{{route('admin.rate.get', $user->id)}}" class="btn btn-secondary">Rate Details</a>

          </td>
        </tr>
        @endforeach
    </tbody>
  </table>




@endsection
