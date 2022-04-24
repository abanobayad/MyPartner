@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
    <div class="container p-5 my-5 border" >
            <div class="form-group">
                <h6 for="exampleFormControlInput1">Sender name : {{  $rate->sender->name }}</h6>
            </div>

            <div class="form-group">
                <h6 for="exampleFormControlInput1"> receiver name : {{  $rate->receiver->name }}</h6>
            </div>

            <div class="form-group">
                <h6 for="exampleFormControlInput1">rate value  : {{  $rate->rate_value }}</h6>
            </div>

            <div class="form-group">
                <h6 for="exampleFormControlInput1">feedback : {{  $rate->feedback }}</h6>
            </div>

            <div class="form-group">
                <h6 for="exampleFormControlInput1">created at : {{  $rate->created_at->diffForhumans() }}</h6>
            </div>

            <div class="form-group">
                <h6 for="exampleFormControlInput1">updated at : {{  $rate->updated_at->diffForhumans() }}</h6>
            </div>

            <div class="btn-group col-10 mx-auto">
                <button type="button" class="btn btn-primary btn-lg">send msg to {{  $rate->receiver->name }} </button>
                <button type="button" class="btn btn-primary btn-lg">view {{  $rate->receiver->name }} profile </button>
                <button type="button" class="btn btn-primary btn-lg">create </button>
                <a href="{{route('admin.rate.delete' , [$rate->sender_id , $rate->receiver_id])}}" > <button type="button"  class="btn btn-primary btn-lg">Delete </button> </a>
            </div>

    </div>
</div>




@endsection
