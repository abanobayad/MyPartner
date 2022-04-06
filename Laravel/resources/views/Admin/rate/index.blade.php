@extends('Admin.layout')

@section('content')

    <h4 style="display: inline-block">Rates</h4>

<div class="table-responsive">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Sender name</th>
        <th scope="col">Receiver name</th>
        <th scope="col">Rate value</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($rates as $rate)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td> {{$rate->sender->name}} </td>
          <td>{{$rate->receiver->name}}</td>
          <td>{{$rate->rate_value}}</td>

          <td>
            <a  href="{{route('admin.rate.show' , $rate->id)}}" class="btn btn-sm btn-dark text-white">Show Details</a>
            <a  href="{{route('admin.rate.delete' , $rate->id)}}" class="btn btn-sm btn-danger text-white">Delete</a>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>



@endsection
