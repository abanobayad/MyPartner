@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
        @if(count($contact) < 1)
            <div class="alert alert-danger" role="alert">
                there in no contacts from this user
                        </div>
        @else
            @foreach ($contact as $c)
            <div class="container p-5 my-5 border" >

                    <div class="form-group">
                    <h4 for="exampleFormControlInput1">subject : {{  $c->subject }}</h4>
                    </div>
                    <div class="form-group">
                        <h6 for="exampleFormControlInput1"> content : {{  $c->content }}</h6>
                    </div>

                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">user name : {{  $c->user->name }}</h6>
                    </div>

                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">created at : {{  $c->created_at->diffForhumans() }}</h6>
                    </div>

                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">updated at : {{  $c->updated_at->diffForhumans() }}</h6>
                    </div>

                    <div class="btn-group col-6 mx-auto">
                        <button type="button" class="btn btn-primary btn-lg">send msg to {{  $c->user->name }} </button>
                        <button type="button" class="btn btn-primary btn-lg">view {{  $c->user->name }} profile </button>
                        <button type="button" class="btn btn-primary btn-lg">create </button>
                        <a href="{{route('admin.contact.delete' , $c->id)}}" > <button type="button"  class="btn btn-primary btn-lg">Delete </button> </a>

                    </div>

                 </div>

            @endforeach
        @endif


</div>




@endsection
