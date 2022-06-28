@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12  m-auto">
            <div class="row">
                <div class=" col-12 m-auto">
                    <div class="card m-auto">
                        <div class="card-body ">
                            <h4 class="fw-bold text-muted mb-3">
                                <i class="mdi mdi-group"></i>
                                {{ $group->name }}</h4>
                                        <img class="card-img-top img-lg m-auto" style="height: 100% ;object-fit:cover"
                                            src="{{ asset('uploads/Groups' . '/' . $group->image) }}">
                            <h6 class="card-text mt-4">Category :
                                <a href="{{ route('admin.cat.show', $group->category->id) }}"
                                    style="text-decoration: none">
                                    <span class="text-primary fw-bold">{{ $group->category->name }}</span>
                                </a>
                            </h6>
                            <h6 class="card-text">Number of related tags : <span
                                    class="text-success fw-bold">{{ $group->tags->count() }}</span></h6>
                            <a href="{{ route('admin.group.edit', $group->id) }}" style="float: right"
                                class="d-flex btn btn-sm btn-outline-dark">Edit
                            </a>

                            <a href="{{ route('admin.group.posts.show', $group->id) }}" style="float: right"
                                class="d-flex btn btn-sm btn-outline-success">Show Group Posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @if ($group->tags->count() != 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="card-title">
                                        <span>
                                            <i class="mdi mdi-tag text-success"> Related Tags :</i>
                                        </span>
                                    </h5>
                                    {{-- Fetch tags --}}
                                    @foreach ($group->tags as $tag)
                                        <div class="col-lg-4 col-xs-6 mb-2">
                                            <div class="card h-70 my-0 ">
                                                <div class="card-body my-0">
                                                    <a href="{{ route('admin.tag.show', $tag->id) }}"
                                                        style="text-decoration: none">
                                                        <p class="card-text text-success ">{{ $tag->name }}</p>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- End Card --}}

        </div>
    </div>
@endsection
