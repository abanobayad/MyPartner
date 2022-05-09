@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12  m-auto">
            <div class="row">
                <div class=" col-12 m-auto">
                    <div class="card m-auto">
                        <div class="card-body">

                            <h4 class="fw-bold text-muted mb-3">
                                <i class="mdi mdi-chart-pie"></i>
                                {{ $category->name }}</h4>

                            <img class="card-img-top img-lg" style="height: 100%"
                                src="{{ asset('uploads/Categories' . '/' . $category->image) }}">
                            <h6 class="card-text mt-4">Number of related tags : <span
                                    class="text-success fw-bold">{{ $category->tags->count() }}</span></h6>
                            <h6 class="card-text">Number of related groups : <span
                                    class="text-primary fw-bold">{{ $category->groups->count() }}</span></h6>
                            <a href="{{ route('admin.cat.edit', $category->id) }}" style="float: right"
                                class="d-flex btn btn-sm btn-outline-dark">Edit</a>

                        </div>
                    </div>
                </div>
            </div>
            @if ($category->groups->count() != 0)
                <div class="row ">
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
                                    @foreach ($category->groups as $group)
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
            @endif
            @if ($category->tags->count() != 0)
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <h5 class="card-title">
                                <span>
                                    <i class="mdi mdi-tag text-success"> Related Tags :</i>
                                </span>
                            </h5>
                            {{-- Fetch tags --}}
                            @foreach ($category->tags as $tag)
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

    </div>
    </div>
@endsection
