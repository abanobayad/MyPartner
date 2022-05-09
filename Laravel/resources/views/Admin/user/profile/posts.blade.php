{{-- Check Group Has Posts Or not --}}
<link rel="stylesheet" href="{{asset('css/editProfile.css')}}">
@if ($posts->count() == 0)
    <div class=" m-auto col-lg-6 col-md-12 alert alert-danger text-center d-flex justify-content-center">There Is No Posts Yet in
        "{{ $user->name }}" Account!! </div>
@else
{{--
    <div class="col-10 content m-auto">
        <h6>Number of Posts: {{ $posts->count() }}
            <hr>
        </h6>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-3 4 mb-4">
                    <div class="card bg-light h-100">
                        {{-- <a href="{{route('groupView' , $post->id)}}">
                        <img src="{{ asset('uploads/Posts') . '/' . $post->image }}" alt="{{ $post->title }}"
                            class="card-img-top">
                        {{-- </a>
                        <div class="card-body">
                            <h4 class="card-title">{{ $post->title }}</h4>
                            <p class="card-text">{{ $post->description }}</p>
                            <p style="display: inline">Needed Partners:
                                <label class="badge bg-dark"> {{ $post->needed_persons }}</label>
                            </p>
                            <hr>
                            Price: <label class="badge bg-warning">{{ $post->price }}</label>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $posts->appends(request()->input())->links() }}
        </div>
    </div>
--}}


    <div class="container blog-page">
        <div class="row clearfix">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-12">
                    <div class="card single_post">
                        <div class="header">
                            @if($post->status == 'pending')
                            <h2><strong>Pending</strong> Post <i class="mdi mdi-clock"></i> </h2>
                            @elseif($post->status == 'reject')
                            <h2 class="text-danger"><strong>Rejected</strong> Post
                                <i class="mdi mdi-close-circle-outline"></i>

                            </h2>
                            @elseif($post->status == 'accept')
                            <h2 class="text-success"><strong>Accepted</strong> Post
                                <i class="mdi mdi-check-circle-outline"></i>

                            </h2>
                            @endif
                        </div>
                        <div class="body">
                            <h3 class="m-t-0 m-b-5"><a href="{{route('admin.post.show' , $post->id)}}">{{$post->title}}</a></h3>
                            <ul class="meta">
                                <li><a href=""><i class="mdi mdi-account col-blue"></i>Posted By: {{$post->user->name}}</a></li>
                                <br>
                                <li><a href=""><i class="mdi mdi-comment-text col-blue"></i>Comments: {{count($post->comments)}} </a></li>
                                <li><a href=""><i class="mdi mdi-home col-blue"></i>Group: {{$post->group->name}} </a></li>
                                {{-- <li><a href=""><i class="mdi mdi-comment-text col-blue"></i>>Needed Partners: {{ $post->needed_persons }} </a></li> --}}
                                {{-- <li><a href=""><i class="mdi mdi-comment-text col-blue"></i>Price: {{ $post->price }} </a></li> --}}

                               <br> <li><a ><i class="mdi mdi-label col-blue"></i>Tags:</a></li>
                                @foreach ($post->group->tags  as $tag )
                                <li><a href=""><i class="mdi col-amber"></i>{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="body">
                            <div class="img-post m-b-15">
                                <img  src="{{ asset('uploads/Posts') . '/' . $post->image }}" alt="{{ $post->title }}">
                                {{-- <div class="social_share">
                                    <button class="btn btn-primary btn-icon btn-icon-mini btn-round"><i class="mdi mdi-facebook"></i></button>
                                    <button class="btn btn-primary btn-icon btn-icon-mini btn-round"><i class="mdi mdi-twitter"></i></button>
                                    <button class="btn btn-primary btn-icon btn-icon-mini btn-round"><i class="mdi mdi-instagram"></i></button>
                                </div> --}}
                            </div>
                            {{-- <p>{{$post->content}}</p> --}}
                            <a href="{{route('admin.post.show' , $post->id)}}" title="read more" class="btn btn-round btn-sm btn-secondary">Read More <i class="mdi mdi-more"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
                      <div class="d-flex justify-content-center">
            {{ $posts->appends(request()->input())->links() }}
        </div>
        </div>
    </div>
@endif
