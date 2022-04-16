@extends('Admin.layout')

@section('content')


    <div class="row">
        <div class=" col-12 d-flex justify-content-center">
            <div class="col-10">

                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('searchUserPosts', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" name="q" class="form-control"
                                                placeholder="Search User Posts" required>
                                        </div>
                                        <div class="col-2">
                                            <input type="submit" value="Search" class="btn btn-secondary form-control text-white"
                                                style="float: right ; display: inline;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <div class="d-flex align-items-center">
                    <div class="ml-3 w-100">

                        <h4 class="mb-0 mt-0" style="text-transform: capitalize;">{{ $user->name }}</h4>

                        <div class="p-2 mt-2  d-flex justify-content-between rounded text stats">

                                <div class="image">
                                    <img class="img-lg rounded-circle"
                                        src="{{ asset('uploads/Users') . '/' . $user->profile->image }}" alt="user_image">
                                </div>
                            <div class="d-flex flex-column"> <span class="articles">Posts</span> <span
                                    class="number1">{{ count($user->posts) }}</span> </div>
                            <div class="d-flex flex-column"> <span class="followers">Connections</span> <span
                                    class="number2">--</span> </div>
                            <div class="d-flex flex-column"> <span class="rating">Rating</span> <span
                                    class="number3">
                                    {{ $total_rate }}
                                </span> </div>
                        </div>
                        <div class="button mt-2 d-flex flex-row align-items-center">
                            <button class="btn btn-sm btn-outline-dark w-100 m-2">Reports</button>
                            <button class="btn btn-sm btn-outline-success w-100 m-2">Send Message</button>
                            <a href="{{route('ban-detailes', $user->id)}}" class="btn btn-sm btn-outline-danger w-100 m-2">Ban</a>
                        </div>
                    </div>

                </div>
                <hr class="mb-2">
                <div class="m-auto text-center col-4 rounded alert-secondary">{{ $user->profile->bio }}</div>
                <hr class="mb-2">
                {{-- Start Posts --}}

                {{-- Chech Group Has Posts Or not --}}

                @if (session()->has('message'))
                    <div class="alert alert-success  mb-2 mt-3 col-12 m-auto " style="text-align: center">
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

        </div>
    </div>
    <div class="row">
    @include('Admin.user.profile.posts')
    </div>

    @endsection
