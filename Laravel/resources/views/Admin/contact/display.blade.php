@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
    <div class="container p-5 my-5 border" >

        <div class="form-group">
            <h4 for="exampleFormControlInput1">subject : {{  $contact->subject }}</h4>
        </div>

        <div class="form-group">
            <h6 for="exampleFormControlInput1"> content : {{  $contact->content }}</h6>
        </div>

        <div class="form-group">
            <h6 for="exampleFormControlInput1">user name : {{  $contact->user->name }}</h6>
        </div>

        <div class="form-group">
            <h6 for="exampleFormControlInput1">created at : {{  $contact->created_at->diffForhumans() }}</h6>
        </div>

        <div class="form-group">
            <h6 for="exampleFormControlInput1">updated at : {{  $contact->updated_at->diffForhumans() }}</h6>
        </div>

        <div class="btn-group col-6 mx-auto">
            <button type="button" class="btn btn-primary btn-lg">send msg to {{  $contact->user->name }} </button>
            <button type="button" class="btn btn-primary btn-lg">view {{  $contact->user->name }} profile </button>
            <button type="button" class="btn btn-primary btn-lg">create </button>
            <a href="{{route('admin.contact.delete' , $contact->id)}}" > <button type="button"  class="btn btn-primary btn-lg">Delete </button> </a>
        </div>
    </div>
</div>




@endsection
