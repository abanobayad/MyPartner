@extends('Admin.layout')

@section('content')

<div class="row">
    @if (count($rates) < 1)
        <div class="alert alert-danger" role="alert">

            No one rate for {{$user->name}}
        </div>
    @else
    <div class="col-6 m-auto">
        <div class="card p-2 mb-2 bg-transparent" role="alert">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-muted">
                        Rate Details of {{$user->name}}
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
            <h6 for="exampleFormControlInput1">number of reviews : {{ $collection['number_of_reviews'] }}</h6>
                </div>
                <div class="col-6">
                    <h6 for="exampleFormControlInput1">total reviews percentage :
                        {{ $collection['total_reviews_percentage'] }}
                    </h6>
                </div>
            </div>

        </div>
    </div>
</div>
    <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
    <br>
    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Rate Value</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="tableData">
                {{-- Start Fetch Data --}}
                @foreach ($rates as $rate)
                    {{-- {{dd($cat->admin)}} --}}
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td> {{ $rate->sender->name }} </td>
                        <td>{{ $rate->receiver->name }}</td>
                        <td>{{ $rate->rate_value }}</td>

                        <td>
                            <a href="{{ route('admin.rate.show', [$rate->sender_id, $rate->receiver_id]) }}"
                                class="btn btn-sm btn-dark text-white">Show
                                Details</a>
                            <a href="{{ route('admin.rate.delete', [$rate->sender_id, $rate->receiver_id]) }}"
                                class="btn btn-sm btn-danger text-white">Delete</a>
                        </td>
                    </tr>
                @endforeach
                {{-- End Fetch Data --}}
            </tbody>
        </table>
    </div>
    @endif

@endsection
