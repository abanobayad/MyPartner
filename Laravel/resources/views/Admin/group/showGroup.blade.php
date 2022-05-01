@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-8 m-auto">
            <div class="row">
                <div class=" col-12 m-auto">
                    <div class="card m-auto">
                        <div class="card-body">
                            <img class="card-img-top img-lg" style="height: 300px"
                                src="{{ asset('uploads/Groups' . '/' . $group->image) }}">
                            <h5 class="card-title">{{ $group->name }}</h5>
                            <h6 class="card-text">Category :
                                <a href="{{ route('admin.cat.show', $group->category->id) }}"
                                    style="text-decoration: none">
                                    <span class="text-primary fw-bold">{{ $group->category->name }}</span>
                                </a>
                            </h6>
                            <h6 class="card-text">Number of related tags : <span
                                    class="text-success fw-bold">{{ $group->tags->count() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($group->tags->count() != 0)
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
