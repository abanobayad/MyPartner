@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
    <div class="card" >
        <div class="card-body">
            <div class="form-group">
                <h4 for="exampleFormControlInput1">user name : {{  $report->user->name }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1"> post title : {{  $report->post->title }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1">reason  : {{  $report->reason }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1">feedbakc  : {{  $report->feedbakc }}</h4>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">created at : {{  $report->created_at->diffForhumans() }}</h3>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">updated at : {{  $report->updated_at->diffForhumans() }}</h3>
            </div>
        </div>
    </div>
</div>




@endsection
