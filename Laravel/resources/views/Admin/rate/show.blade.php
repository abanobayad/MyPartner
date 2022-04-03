@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
    <div class="card" >
        <div class="card-body">
            <div class="form-group">
                <h4 for="exampleFormControlInput1">Sender name : {{  $rate->sender->name }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1"> receiver name : {{  $rate->receiver->name }}</h4>
            </div>

            <div class="form-group">
                <h4 for="exampleFormControlInput1">rate value  : {{  $rate->rate_value }}</h4>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">created at : {{  $rate->created_at->diffForhumans() }}</h3>
            </div>

            <div class="form-group">
                <h3 for="exampleFormControlInput1">updated at : {{  $rate->updated_at->diffForhumans() }}</h3>
            </div>
        </div>
    </div>
</div>




@endsection
