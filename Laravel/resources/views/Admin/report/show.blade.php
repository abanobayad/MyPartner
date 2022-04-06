@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
    <div class="card" >
        <div class="card-body">
            <div class="form-group">
                <h4 for="exampleFormControlInput1">Reporter name : {{  $report->user->name }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1"> post title : {{  $report->post->title }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1"> post owner : {{$report->post->user->name}}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1">reason  : {{  $report->reason }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1">feedbakc  : {{  $report->feedback }}</h4>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">created at : {{  $report->created_at->diffForhumans() }}</h3>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">updated at : {{  $report->updated_at->diffForhumans() }}</h3>
            </div>

            <div class="btn-group col-10 mx-auto">
                <a href="{{route('admin.report.approve' ,[$report->post_id ,$report->user_id ])}}" > <button type="button"  class="btn btn-success btn-lg">Approve </button> </a> {{-- delete post--}}
                <a href="{{route('admin.report.reject' , [$report->post_id ,$report->user_id ])}}" > <button type="button"  class="btn btn-danger btn-lg">Reject </button> </a>{{-- delete report--}}
            </div>
        </div>
    </div>
</div>




@endsection
