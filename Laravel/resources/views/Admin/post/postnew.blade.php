@extends('Admin.layout')

<link rel="stylesheet" href="{{ asset('css/post.css') }}">


@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1" style="text-transform: capitalize">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2"><i class="mdi mdi-av-timer"></i>
                            {{ $post->created_at->diffForhumans() }}</div>
                        <div class="text-muted fst-italic mb-2"><i class="mdi mdi-account col-blue"></i> Posted By:
                            <a href="{{ route('admin.user.show', $post->user->id) }}" style="text-decoration: none;">
                                {{ $post->user->name }}</a>
                        </div>
                        <div class="text-muted fst-italic mb-2"><i class="mdi mdi-comment-text col-blue"></i> Comments:
                            {{ count($post->comments) }}</div>
                        <!-- Post categories-->
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">Group:
                            {{ $post->group->name }}</a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded"
                            src="{{ asset('uploads/Posts' . '/' . $post->image) }}" alt="{{ $post->title }}" /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mt-2 card p-3" style="text-transform: capitalize">
                            {{ $post->content }}
                        </p>
                    </section>
                </article>

                <div class="row mt-0">
                    <div class="col-lg-6 col-md-0"></div>
                    <div class="col-lg-6 col-md-12">
                        @if($post->status == 'pending')

                            <div class="btn-group col-6" style="float: right">
                                <div class="row " >
                                    <div class="col-6">
                                        <a href="{{ route('admin.post.approve', $post->id) }}"> <button
                                                type="button" class="btn btn-sm btn-success btn-lg">Approve </button> </a>
                                        {{-- make post visible and send notifi --}}
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('admin.post.reject',$post->id) }}"> <button
                                                type="button" class="btn btn-sm btn-danger btn-lg">Reject </button>
                                        </a>{{-- make post non visible  and send notifi--}}
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        @if ($post->comments->count() != 0)
                            <!-- Comments section-->
                            <section class="mb-5 ">
                                <div class="card bg-light">
                                    <div class="text-muted fst-italic p-2">Comments</div>
                                    <hr style="width: 15%">
                                    <div class="card-body">
                                        <!-- Comment with nested comments-->
                                        {{-- Start Comment --}}
                                        @foreach ($post->comments as $comment)
                                            <div class="d-flex mb-4 ">
                                                <!-- Parent comment-->
                                                <div class="flex-shrink-0 image">
                                                    <img class="rounded-circle img-sm"
                                                        src="{{ asset('uploads/Users') . '/' . $comment->user->profile->image }}"
                                                        alt="{{ $comment->user->name }} Photo" />
                                                </div>
                                                <div class="ms-3">
                                                    <div class="fw-bold"><a
                                                            href="{{ route('admin.user.show', $comment->user->id) }}"
                                                            style="text-decoration: none;">{{ $comment->user->name }}</a></div>
                                                    {{ $comment->content }}

                                                    @if ($comment->image != null)
                                                    <!-- Preview image figure-->
                                                    <figure class="mb-4"><img class="img-fluid rounded"
                                                        src="{{ asset('uploads/Comments' . '/' . $comment->image) }}" alt="comment image" /></figure>
                                                    @endif

                                                    <div class="text-muted fst-italic mb-2">
                                                        {{ $comment->created_at->diffForhumans() }}</div>
                                                    <hr>
                                                    <!-- Child comment 1-->
                                                    {{-- Start Reply --}}
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0">
                                                                <img class="rounded-circle img-sm"
                                                                    src="{{ asset('uploads/Users') . '/' . $reply->user->profile->image }}"
                                                                    alt="{{ $reply->user->name }} Photo" />
                                                            </div>
                                                            <div class="ms-1">
                                                                <div class="fw-bold"><a
                                                                        href="{{ route('admin.user.show', $reply->user->id) }}"
                                                                        style="text-decoration: none;">{{ $reply->user->name }}</a>
                                                                </div>
                                                                {{ $reply->content }}

                                                                @if ($reply->image != null)
                                                                    <!-- Preview image figure-->
                                                                    <figure class="mb-4"><img class="img-fluid rounded"
                                                                        src="{{ asset('uploads/Replies' . '/' . $reply->image) }}" alt="reply image" /></figure>
                                                                @endif


                                                                <div class="text-muted fst-italic mb-2">
                                                                    {{ $reply->created_at->diffForhumans() }}</div>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- End Reply --}}

                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach

                                        {{-- End Comment --}}
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>
                </div>


            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Tags</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-unstyled mb-0">
                                    <div class="row">
                                    @foreach ($post->group->tags as $tag)
                                            <div class="col-6">
                                                <li><a class="text-success fw-bold" href="{{ route('admin.tag.show', $tag->id) }}" style="text-decoration: none">{{ $tag->name }}</a></li>
                                            </div>
                                            @endforeach
                                        </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
