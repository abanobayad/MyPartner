@extends('Admin.layout')

@section('content')

<h4 style="display: inline-block">Reports</h4>
<div class="text-center pb-2 " style="float:right; width: 300px">
    <form action="{{route('admin.report.index')}}" method="POST"  class="pb-2">
        @csrf
        <div class="row">
        <div class="col-8">
            <select name="handled" class="form-control mb-2 text-center">
                <option value="all">All Reports</option>
                <option value="yes" @if($selected_reps == 'yes') selected @endif>
                    Handled Reports</option>
                <option value="no"  @if($selected_reps == 'no') selected @endif >
                    Not Handled Reports</option>

                {{-- <option value="yes"@if(old('handled') == "yes") {{ 'selected' }} @endif>Handled Reports</option>
                <option value="no" @if(old('handled') == "no") {{ 'selected' }} @endif>Not Handled Reports</option> --}}
            </select>
        </div>
        <div class="col-4" >
        <button type="submit" class="btn form-control mb-2">Show</button>
        </div>
    </div>
</form>
</div>

<br>
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
            <a  href="{{route('admin.report.show' , [$report->post_id ,$report->user_id ])}}" class="btn btn-sm btn-dark text-white">Show Details</a>
            <a  href="{{route('admin.report.delete',[$report->post_id ,$report->user_id])}}" class="btn btn-sm btn-danger text-white">Delete</a>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>



@endsection