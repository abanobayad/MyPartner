@extends('Admin.layout')


@section('content')

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link text-danger active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Unreaded
         <span class=" text-muted" style="font-size: 11px">
             {{ $uestUnreadNotifi->count()}}
        </span>
      </button>
      <button class="nav-link text-primary" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
          Readed
          <span class=" text-muted" style="font-size: 11px">
            {{ $uestReadNotifi->count()}}
       </span>
      </button>
      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">All
        <span class=" text-muted" style="font-size: 11px">
          {{ $uestAllNotifi->count()}}
      </button>
    </div>
  </nav>
  <div class="tab-content mt-2" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            {{-- Start Fetch --}}
            <div class="row">
                <div class="m-auto col-lg-6 col-md-12">
                    @foreach ($uestUnreadNotifi as $notification)
                        <div class="card  mb-3" style="overflow-y: auto;">
                            <div class="card-body" style="overflow-y: auto;">
                                <a class="dropdown-item  " href="{{ route('markRead', $notification->id) }}">
                                    <h5 class="card-title" style="text-overflow: clip;">
                                        <div class="row mb-1">
                                            <div class="col-8">
                                                <span class="preview-subject ellipsis font-weight-medium text-dark" >
                                                    {{ $notification->data['data']['title'] }}</span>
                                            </div>
                                            <div class="col-4 ">
                                                {{-- Icon Cond --}}
                                                @if ($notification->type == 'App\Notifications\MakeContact')
                                                    <i class="mdi mdi-phone-incoming px-5 mx-3  text-success"></i>
                                                @elseif ($notification->type == 'App\Notifications\AdminPostReported')
                                                    <i class="mdi mdi-alert-circle-outline px-5 mx-3 text-danger"></i>
                                                @endif
                                                {{-- End Icon Cond --}}
                                            </div>
                                        </div>
                                    </h5>
                                    <p class="card-text" style="text-overflow: clip;">
                                        <div class="row">
                                            <p class="fw-light small-text mb-0">
                                                {{ $notification->data['data']['body'] }} </p>
                                        </div>
                                    </p>
                                    <p class="card-text">
                                        <p class="fw-light small-text mb-0">
                                            {{ $notification->updated_at->diffForHumans() }}
                                        </p>
                                    </p>

                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- End Fetch --}}
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            {{-- Start Fetch --}}
            <div class="row">
                <div class="m-auto col-lg-6 col-md-12">
                    @foreach ($uestReadNotifi as $notification)
                        <div class="card mb-3" style="overflow-y: auto;">
                            <div class="card-body">
                                <a class="dropdown-item  " href="{{ route('markRead', $notification->id) }}">
                                    <h5 class="card-title">
                                        <div class="row mb-1">
                                            <div class="col-8">
                                                <span class="preview-subject ellipsis font-weight-medium text-dark">
                                                    {{ $notification->data['data']['title'] }}</span>
                                            </div>
                                            <div class="col-4 ">
                                                {{-- Icon Cond --}}
                                                @if ($notification->type == 'App\Notifications\MakeContact')
                                                    <i class="mdi mdi-phone-incoming px-5 mx-3  text-success"></i>
                                                @elseif ($notification->type == 'App\Notifications\AdminPostReported')
                                                    <i class="mdi mdi-alert-circle-outline px-5 mx-3 text-danger"></i>
                                                @endif
                                                {{-- End Icon Cond --}}
                                            </div>
                                        </div>
                                    </h5>
                                    <p class="card-text">
                                        <div class="row">
                                            <p class="fw-light small-text mb-0">
                                                {{ $notification->data['data']['body'] }} </p>
                                        </div>
                                    </p>
                                    <p class="card-text">
                                        <p class="fw-light small-text mb-0">
                                            {{ $notification->updated_at->diffForHumans() }}
                                        </p>
                                    </p>

                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- End Fetch --}}
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            {{-- Start Fetch --}}
            <div class="row">
                <div class="m-auto col-lg-6 col-md-12">
                    @foreach ($uestAllNotifi as $notification)
                        <div class="card mb-3" style="overflow-y: auto;">
                            <div class="card-body">
                                <a class="dropdown-item  " href="{{ route('markRead', $notification->id) }}">
                                    <h5 class="card-title">
                                        <div class="row mb-1">
                                            <div class="col-lg-8 col-md-10">
                                                <span class="preview-subject ellipsis font-weight-medium text-dark">
                                                    {{ $notification->data['data']['title'] }}</span>
                                            </div>
                                            <div class="col-lg-4  col-md-2">
                                                {{-- Icon Cond --}}
                                                @if ($notification->type == 'App\Notifications\MakeContact')
                                                    <i class="mdi mdi-phone-incoming px-5 mx-3  text-success"></i>
                                                @elseif ($notification->type == 'App\Notifications\AdminPostReported')
                                                    <i class="mdi mdi-alert-circle-outline px-1 mx-3 text-danger"></i>
                                                @endif
                                                {{-- End Icon Cond --}}
                                            </div>
                                        </div>
                                    </h5>
                                    <p class="card-text">
                                        <div class="row">
                                            <p class="fw-light small-text mb-0">
                                                {{ $notification->data['data']['body'] }} </p>
                                        </div>
                                    </p>
                                    <p class="card-text">
                                        <p class="fw-light small-text mb-0">
                                            {{ $notification->updated_at->diffForHumans() }}
                                        </p>
                                    </p>

                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- End Fetch --}}
    </div>
  </div>



@endsection
