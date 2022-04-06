@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
        @if(count($rates) < 1)
            <div class="alert alert-danger" role="alert">
                No one's rated this user before
                        </div>
        @else
        <div class="alert alert-secondary" role="alert">
            <h6 for="exampleFormControlInput1">number of reviews : {{ $collection['number_of_reviews']}}</h6>
            <h6 for="exampleFormControlInput1">total reviews percentage : {{ $collection['total_reviews_percentage']}}</h6>


        </div>
            @foreach ($rates as $rate)
            <div class="container p-5 my-5 border" >

                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">Sender name : {{  $rate->sender->name }}</h6>
                    </div>
                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">receiver name : {{  $rate->receiver->name }}</h6>
                    </div>

                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">rate value  : {{  $rate->rate_value }}</h6>
                    </div>

                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">created at : {{  $rate->created_at->diffForhumans() }}</h6>
                    </div>

                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">updated at : {{  $rate->updated_at->diffForhumans() }}</h6>
                    </div>

                    <div class="btn-group col-10 mx-auto">
                        <button type="button" class="btn btn-primary btn-lg">send msg to {{  $rate->receiver->name  }} </button>
                        <button type="button" class="btn btn-primary btn-lg">view {{  $rate->receiver->name  }} profile </button>
                        <a href="{{route('ban-detailes' , $rate->receiver->id)}}" > <button type="button" class="btn btn-primary btn-lg">ban {{  $rate->receiver->name  }} </button> </a>
                        <a href="{{route('admin.rate.delete' , $rate->id)}}" > <button type="button"  class="btn btn-primary btn-lg">Delete </button> </a>

                    </div>

                 </div>

            @endforeach
        @endif


</div>
@endsection

