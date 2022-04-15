{{-- Check Group Has Posts Or not --}}

@if ($posts->count() == 0)
    <div class=" m-auto col-6 alert alert-danger d-flex justify-content-center">There Is No Posts Yet in
        {{ $user->name }} Account!!</div>
@else
<div class="row">
    <div class="col-12">
        <div class="col-12 m-auto" style="display: block">
            @foreach ($posts as $post)
                <div class=" my-auto col-8 p-3  m-auto" style="display: block">
                    <div class="card  h-100  p-3 " style="display: block">
                        <div class="card-head" style="display: block">
                            <div class=" p-1 ">
                                Post By :
                                <a href="{{ route('admin.user.show', $post->user_id) }}">{{ $post->user->name }}</a>
                            </div>
                            <hr>
                            <a href="{{ route('showPost', $post->id) }}" >
                                <img src="{{ asset('uploads/Posts') . '/' . $post->image }}" class="card-img-top ">
                            </a>
                            <hr>
                            <div class="pt-2">
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <label class="card-text ">{{ $post->content }}</label>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <br> Needed Persons: <label for="post-needed_persons"
                                class="card-text badge bg-success">{{ $post->needed_persons }} Person(s)</label>
                            <br> Price: <label for="post-price" class="card-text badge bg-danger">{{ $post->price }}
                                $</label>

                        </div>
                        {{-- Comments --}}
                        {{-- <div class="card-body">
                            <div class=" alert card m-2 alert-success ">
                                <div class="">
                                    <hr class="mt-5">
                                    <h6>Comments</h6>

                                    @if ($post->comments->count() == 0)
                                        <div class="alert alert-success text-center">There is no comments on this post</div>
                                    @else
                                        <div class="alert alert-success ">
                                            @foreach ($post->comments as $comment)
                                                <label>
                                                    <a href="{{ route('admin.user.show', $comment->user->id) }}">
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
                        </div> --}}
                        {{-- End Comments --}}
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>

</div>
</div>

@endif
