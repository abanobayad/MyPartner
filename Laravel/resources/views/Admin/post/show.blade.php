@extends('Admin.layout')

@section('content')


        <div class="card bg-light col-lg-6  col-md-12 m-auto mt-0">
            <div class="card-body">
                <div class="form-group">
                    <h4 for="exampleFormControlInput1"> Post Title :
                        <a href="{{ route('admin.user.show', $post->user->id) }}">
                            {{ $post->user->name }}
                        </a>
                    </h4>
                </div>

                <div class="form-group">
                    <h4 for="exampleFormControlInput1">Post Title :
                        <a href="{{ route('admin.post.show', $post->post->id) }}">
                            {{ $post->post->title }}
                        </a>
                    </h4>
                </div>

                <div class="form-group">
                    <h4 for="exampleFormControlInput1"> Post Owner :
                        <a href="{{ route('admin.user.show', $post->post->user->id) }}">
                            {{ $post->post->user->name }}
                        </a>
                    </h4>
                </div>

                <div class="form-group">
                    <h5 for="exampleFormControlInput1">Reason : {{ $post->reason }}</h5>
                </div>

                <div class="form-group">
                    <h5 for="exampleFormControlInput1">Feedback : {{ $post->feedback }}</h5>
                </div>

                <div class="form-group">
                    <h6 for="exampleFormControlInput1">Created at : {{ $post->created_at->diffForhumans() }}</h6>
                </div>

                <div class="form-group">
                    <h6 for="exampleFormControlInput1">Updated at : {{ $post->updated_at->diffForhumans() }}</h6>
                </div>

                <div class="btn-group  mx-auto">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('admin.report.approve', [$post->post_id, $post->user_id]) }}"> <button
                                    type="button" class="btn btn-sm btn-success btn-lg">Approve </button> </a>
                            {{-- delete post --}}
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.report.reject', [$post->post_id, $post->user_id]) }}"> <button
                                    type="button" class="btn btn-sm btn-danger btn-lg">Reject </button>
                            </a>{{-- delete report --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
