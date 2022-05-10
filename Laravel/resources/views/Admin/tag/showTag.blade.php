@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12  m-auto">
            <div class="row">
                <div class=" col-12 m-auto">
                    <div class="card m-auto">
                        <div class="card-body">
                            <h4 class="fw-bold text-muted mb-3">
                                <i class="mdi mdi-tag"></i>
                                {{ $tag->name }}</h4>

                            <img class="card-img-top img-lg" style="height: 100%"
                                src="{{ asset('uploads/Tags' . '/' . $tag->image) }}">
                            <h6 class="card-text mt-4">Category :
                                <a href="{{ route('admin.cat.show', $tag->category->id) }}" style="text-decoration: none">
                                    <span class="text-primary fw-bold">{{ $tag->category->name }}</span>
                                </a>
                            </h6>
                            <h6 class="card-text">Number of related groups : <span
                                    class="text-success fw-bold">{{ $tag->groups->count() }}</span></h6>
                            <a href="{{ route('admin.tag.edit', $tag->id) }}" style="float: right"
                                class="d-flex btn btn-sm btn-outline-dark">Edit</a>

                        </div>
                    </div>
                </div>
            </div>

            @if ($tag->groups->count() != 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="card-title">
                                        <span>
                                            <i class="mdi mdi-group text-dark"> Related Groups :</i>
                                        </span>
                                    </h5>
                                    {{-- Fetch Groups --}}
                                    @foreach ($tag->groups as $group)
                                        <div class="col-lg-4 col-xs-6 mb-2">
                                            <div class="card h-70 my-0 ">
                                                <div class="card-body">
                                                    <a href="{{ route('admin.group.show', $group->id) }}"
                                                        style="text-decoration: none">
                                                        {{-- <h5 class="card-title">{{ $group->name }}</h5> --}}
                                                        <p class="card-text text-dark">{{ $group->name }}</p>
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

        </div>
    </div>
@endsection
