@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-8 m-auto">
            <div class="row">
                <div class=" col-12 m-auto">
                    <div class="card m-auto">
                        <div class="card-body">
                            <img class="card-img-top img-lg" style="height: 300px"
                                src="{{ asset('uploads/Tags' . '/' . $tag->image) }}">
                            <h5 class="card-title">{{ $tag->name }}</h5>
                            <h6 class="card-text">Category :
                                <a href="{{ route('admin.cat.show', $tag->category->id) }}" style="text-decoration: none">
                                    <span class="text-primary fw-bold">{{ $tag->category->name }}</span>
                                </a>
                            </h6>
                            <h6 class="card-text">Number of related groups : <span
                                    class="text-success fw-bold">{{ $tag->groups->count() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            @if ($tag->groups->count() != 0)
                                <div class="row">
                                    <h5 class="card-title">
                                        <span>
                                            <i class="mdi mdi-group text-dark"> Related Groups :</i>
                                        </span>
                                    </h5>
                                    {{-- Fetch Groups --}}
                                    @foreach ($tag->groups as $group)
                                        <div class="col-lg-4 col-xs-6 mb-2">
                                            <div class="card h-100 ">
                                                <div class="card-body">
                                                    <a href="{{ route('admin.group.show', $group->id) }}"
                                                        style="text-decoration: none">
                                                        <h5 class="card-title">{{ $group->name }}</h5>
                                                        <p class="card-text text-dark">{{ $group->description }}</p>
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
