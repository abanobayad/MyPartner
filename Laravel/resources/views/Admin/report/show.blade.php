@extends('Admin.layout')

@section('content')

<div class="container ">
    <div class="card col-6 m-auto" >
        <div class="card-body">
            <div class="form-group">
                <h4 for="exampleFormControlInput1">  Reporter name :
                    <a href="{{route('admin.user.show' ,$report->user->id )}}">
                      {{  $report->user->name }}
                    </a>
                </h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1">Post Title : {{  $report->post->title }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1"> Post Owner :
                    <a href="{{route('admin.user.show' ,$report->user->id )}}">
                        {{$report->post->user->name}}
                    </a>
                </h4>
            </div>

            <div class="form-group">
                <h5 for="exampleFormControlInput1">Reason  : {{  $report->reason }}</h5>
            </div>

            <div class="form-group">
                <h5 for="exampleFormControlInput1">Feedback  : {{  $report->feedback }}</h5>
            </div>

            <div class="form-group">
                <h6 for="exampleFormControlInput1">Created at : {{  $report->created_at->diffForhumans() }}</h6>
            </div>

            <div class="form-group">
                <h6 for="exampleFormControlInput1">Updated at : {{  $report->updated_at->diffForhumans() }}</h6>
            </div>

            <div class="btn-group  mx-auto" style="float: right">
                <a href="{{route('admin.report.approve' ,[$report->post_id ,$report->user_id ])}}" > <button type="button"  class="btn btn-sm btn-success btn-lg">Approve </button> </a> {{-- delete post--}}
                <a href="{{route('admin.report.reject' , [$report->post_id ,$report->user_id ])}}" > <button type="button"  class="btn btn-sm btn-danger btn-lg">Reject </button> </a>{{-- delete report--}}
            </div>
        </div>
    </div>
</div>




@endsection
