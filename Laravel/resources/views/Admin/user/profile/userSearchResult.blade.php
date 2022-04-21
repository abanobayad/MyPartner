@extends('Admin.layout')

@section('content')
    <div class="row ">

        <h2>Search Result</h2>

            @if ($status == 'fail')
                <div class="alert alert-warning  mb-2 mt-3 col-12 m-auto " style="text-align: center">
                    {{ $message }}
                </div>
            @else



        <div class="col-12 content">
                    <h6>Number of Results: {{ $filteredPosts->count() }} posts
                <hr>
                    </h6>
                    <div class="row">
                        @foreach($filteredPosts as $post)
                            <div class="col-3 4 mb-4">
                                <div class="card bg-light h-100">
                                    <a href="{{route('admin.post.show' , $post->id)}}">
                                        <img src="{{asset('uploads/Posts').'/'. $post->image}}" alt="{{$post->title}}" class="card-img-top">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $post->title }}</h4>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <p style="display: inline">Needed Partners:
                                            <label class="badge bg-dark"> {{ $post->needed_persons }}</label>
                                        </p>
                                        <hr>
                                        Price:  <label class="badge bg-warning">{{ $post->price }}</label>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $filteredPosts->appends(request()->input())->links() }}
                    </div>
        </div>


        </div>
        @endif
    </div>

@endsection
