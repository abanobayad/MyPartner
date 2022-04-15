@extends('Admin.layout')

@section('content')



    <div class="row m-auto">

        <h2>Search Result</h2>
        <div class="col-6 m-auto">
            @if ($status == 'fail')
                <div class="alert alert-warning  mb-2 mt-3 col-12 m-auto " style="text-align: center">
                    {{ $message }}
                </div>
            @else
                <h6>Number of Results: {{ $filteredPosts->count() }} posts</h6>

                <div class="alert alert-primary m-auto">

                    <div class="col-12 m-auto  my-2" style="display: block">
                        @foreach ($filteredPosts as $post)
                            <div class="alert-dark my-auto col-12 p-3  my-2  m-auto" style="display: block">
                                <div class="card  h-100 alert-secondary p-3 " style="display: block">
                                    <div class="card-head " style="display: block">
                                        <div class=" p-1 ">
                                            Post By : {{ $post->user->name }}
                                            @if (Auth::id() == $post->user_id)
                                                <div class="col-4">
                                                    <p class="badge bg-success"> Your Post</p>
                                                </div>
                                            @endif
                                        </div>
                                        <hr>
                                        <a href="#">
                                            <img src="{{ $post->image }}" class="card-img-top">
                                        </a>
                                        <hr>
                                        <div class="pt-2">
                                            <h2 class="card-title">{{ $post->title }}</h2>
                                            <label class="card-text ">{{ $post->content }}</label>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <br> Needed Persons: <label for="post-needed_persons"
                                            class="card-text text-dark badge bg-light">{{ $post->needed_persons }}
                                            Person(s)</label>
                                        <br> Price: <label for="post-price"
                                            class="card-text badge bg-dark">{{ $post->price }} $</label>
                                    </div>

                                </div>



                                <div class=" alert card m-2 alert-success ">
                                    <div class="">
                                        <hr class="mt-5">
                                        <h6>Comments</h6>

                                        @if ($post->comments->count() == 0)
                                            <div class="alert alert-success text-center">There is no comments on this post
                                            </div>
                                        @else
                                            <div class="alert alert-success ">
                                                @foreach ($post->comments as $comment)
                                                    <label>
                                                        <a href="{{ route('showGuest', $comment->user->id) }}">
                                                            {{ $comment->user->name }}</a>
                                                        : {{ $comment->content }}
                                                    </label>
                                                    <br>
                                                    <label>at: {{ $comment->updated_at }}</label>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                </div>


                            </div>
                    </div>
            @endforeach

        </div>

    </div>
    @endif
    </div>
    </div>







@endsection
