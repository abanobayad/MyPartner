@extends('Admin.layout')

@section('content')


    <div class="row">

        <div class="row">
            <div class="col-12">
                <form action="{{ route('searchUserPosts', $user->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-10 col-md-8 mb-2">
                            <input type="text" name="q" class="form-control" placeholder="Search User Posts" required>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <input type="submit" value="Search" class="btn btn-secondary form-control text-white">
                        </div>
                    </div>
                </form>
            </div>
        </div>

            <div class="ml-3 m-auto">

                <h4 class="mb-0 mt-0" style="text-transform: capitalize;">{{ $user->name }}</h4>
                <div class="table-responsive">
                    <div class="p-2 mt-2  d-flex justify-content-between rounded text stats">

                        <div class="image">
                            @if ($user->profile->image == null)
                            <img class="img-lg rounded-circle"
                            src="{{ asset('uploads/Users/u.png')}}" alt="user_image">
                            @else
                            <img class="img-lg rounded-circle"
                            src="{{ asset('uploads/Users') . '/' . $user->profile->image }}" alt="user_image">
                            @endif

                        </div>
                        <div class="d-flex flex-column"> <span class="articles">Posts</span> <span
                                class="number1 text-center">{{ count($user->posts) }}</span>
                        </div>

                        <div class="d-flex flex-column"> <span class="articles">Canceled Requests</span> <span
                            class="number1 text-primary text-center">{{ $user->cancelRequests->count() }}</span>
                        </div>

                        <div class="d-flex flex-column"> <span class="rating">Rating</span> <span
                                class="number3 text-center @if ($rate->count() == 0) text-danger @endif">
                                {{ $total_rate }}
                            </span> </div>
                    </div>
                </div>

                    <div class="row m-auto">
                        <div class="col-lg-3 col-sm-6">
                            <a class="btn btn-sm btn-outline-dark w-100 m-2" href="{{route('admin.report.getall' , $user->id)}}">Reports</a>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <a href="{{ route('admin.contact.get', $user->id) }}"
                                class="btn btn-sm btn-outline-dark w-100 m-2">Contacts Details</a>

                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <a href="{{ route('admin.rate.get', $user->id) }}"
                                class="btn btn-sm btn-outline-dark w-100 m-2">Rate Details</a>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <a href="{{ route('ban-detailes', $user->id) }}"
                                class="btn btn-sm btn-outline-danger w-100 m-2">Ban</a>

                        </div>
                    </div>

        </div>
        <hr class="mb-2">
        <div class="m-auto mb-2 text-center col-4 rounded alert-secondary">{{ $user->profile->bio }}</div>
        <hr class="mb-2">
        {{-- Start Posts --}}

        {{-- Chech Acc Has Posts Or not --}}

        @if (session()->has('message'))
            <div class="alert alert-success  mb-2 mt-3 col-12 m-auto text-center " style="text-align: center">
                {{ session()->get('message') }}
            </div>
        @endif

        @if (session()->has('errors'))
            <div class="alert alert-warning  mb-2 mt-3 col-12 m-auto " style="text-align: center">
                <ul class=" alert alert-danger list-unstyled mb-2 mt-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="row">
        @include('Admin.user.profile.posts')
    </div>

@endsection
