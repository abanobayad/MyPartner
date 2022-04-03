@extends('Admin.layout')

@section('content')

    <h4 style="display: inline-block">reports</h4>

<div class="table-responsive">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">user name</th>
        <th scope="col">post title</th>
        <th scope="col">reason</th>
        <th scope="col">feedback</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($reports as $report)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td> {{$report->user->name}} </td>
          <td>{{$report->post->title}}</td>
          <td>{{$report->reason}}</td>
          <td>{{$report->feedback}}</td>


          <td>
            <a  href="{{route('admin.report.show' , $report->id)}}" class="btn btn-sm btn-dark text-white">Show Details</a>
            <a  href="{{route('admin.report.delete' , $report->id)}}" class="btn btn-sm btn-danger text-white">Delete</a>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>



@endsection
