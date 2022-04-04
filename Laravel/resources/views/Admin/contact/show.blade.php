@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
    <div class="card" >
        <div class="card-body">
            <div class="form-group">
                <h1 for="exampleFormControlInput1">subject : {{  $contact->subject }}</h1>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1"> content : {{  $contact->content }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1">user name : {{  $contact->user->name }}</h4>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">created at : {{  $contact->created_at->diffForhumans() }}</h3>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">updated at : {{  $contact->updated_at->diffForhumans() }}</h3>
            </div>
        </div>
    </div>
</div>




@endsection
