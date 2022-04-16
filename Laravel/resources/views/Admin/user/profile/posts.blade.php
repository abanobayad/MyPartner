{{-- Check Group Has Posts Or not --}}

@if ($posts->count() == 0)
    <div class=" m-auto col-6 alert alert-danger d-flex justify-content-center">There Is No Posts Yet in
        {{ $user->name }} Account!!</div>
@else

<div class="col-10 content m-auto">
    <h6>Number of Posts: {{ $posts->count() }}
<hr>
    </h6>
    <div class="row">
        @foreach($posts as $post)
            <div class="col-3 4 mb-4">
                <div class="card bg-light h-100">
                    {{-- <a href="{{route('groupView' , $post->id)}}"> --}}
                        <img src="{{asset('uploads/Posts').'/'. $post->image}}" alt="{{$post->title}}" class="card-img-top">
                    {{-- </a> --}}
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
        {{ $posts->appends(request()->input())->links() }}
    </div>
</div>


@endif
