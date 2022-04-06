@extends('Admin.layout')

@section('content')

    <h4 style="display: inline-block">reports</h4>

    <select name="gender" id="handled" style="float: right;width:250px">
        <option value="report">All reports</option>
        <option value="yes" @if (old('report') == "yes") {{ 'selected' }} @endif>handled reports</option>
        <option value="no" @if (old('report') == "no") {{ 'selected' }} @endif>not handled reports</option>
    </select>

<div class="table-responsive">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">user name</th>
        <th scope="col">post title</th>
        <th scope="col">post owner</th>
        <th scope="col">reason</th>
        <th scope="col">feedback</th>
        <th scope="col">is handled </th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($reports as $report)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td> {{$report->user->name}} </td>
          <td>{{$report->post->title}}</td>
          <td>{{$report->post->user->name}}</td>
          <td>{{$report->reason}}</td>
          <td>{{$report->feedback}}</td>
          <td>{{$report->is_handled}}</td>


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
