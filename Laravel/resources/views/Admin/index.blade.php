@extends('Admin.layout')


@section('content')
    <div class="row m-auto">
        <div class="col-6 m-auto">

            <div class="image mb-0 m-auto">
                <img class="img m-auto" style="width:100%; height:100%; object-fit:cover; margin:auto"
                    src="{{ asset('images/logo/P.svg') }}" alt="Logo">
            </div>

            {{-- <div class="text-center ">

                <div class="col-lg-4 mx-auto">
                    <i class="mdi mdi-account-multiple d-block align-self-center  text-dark" style="font-size: 30px">My<span
                            style="color: darkblue">Partner</span> </i>
                    <span>Find Your Partner</span>
                </div>
            </div> --}}
        </div>
    </div>


    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview"
                                    role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#catss" role="tab"
                                    aria-selected="false">Categorires</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#groupss" role="tab"
                                    aria-selected="false">Groups</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#postss" role="tab"
                                    aria-selected="false">Posts</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#tagss" role="tab"
                                    aria-selected="false">Tags</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#reportss" role="tab"
                                    aria-selected="false">Reports</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#contactss" role="tab"
                                    aria-selected="false">Contacts</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#userss" role="tab"
                                    aria-selected="false">Users</a>
                            </li>
                        </ul>
                        {{-- Buttons --}}
                        <div>
                            <div class="btn-wrapper">
                                <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                                    Share</a>
                                <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                                <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i>
                                    Export</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">
                        {{-- OverView --}}
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">

                                        <div>
                                            <a href="{{ route('admin.cat.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Categories</p>
                                                <h3 class="rate-percentage">{{ $data['categories_count'] }}</h3>
                                                <p class="text-danger d-flex"><i class="mdi mdi-chart-pie"></i></p>
                                            </a>
                                        </div>

                                        <div>
                                            <a href="{{ route('admin.tag.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Tags</p>
                                                <h3 class="rate-percentage">{{ $data['tags_count'] }}</h3>
                                                <p class="text-danger d-flex"><i class="mdi mdi-tag-outline"></i></p>
                                            </a>
                                        </div>

                                        <div>
                                            <a href="{{ route('admin.group.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Groups</p>
                                                <h3 class="rate-percentage">{{ $data['groups_count'] }}</h3>
                                                <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                            </a>
                                        </div>



                                        <div>
                                            <a href="{{ route('admin.post.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Posts</p>
                                                <h3 class="rate-percentage">{{ $data['posts_count'] }}</h3>
                                                <p class="text-danger d-flex"><i class="mdi mdi mdi-cards-outline"></i></p>
                                            </a>
                                        </div>


                                        <div>
                                            <a href="{{ route('admin.report.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Reports</p>
                                                <h3 class="rate-percentage">{{ $data['reports_count'] }}</h3>
                                                <p class="text-danger d-flex"><i
                                                        class="mdi mdi-comment-question-outline"></i></p>
                                            </a>
                                        </div>

                                        <div>
                                            <a href="{{ route('admin.contact.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Contacts</p>
                                                <h3 class="rate-percentage">{{ $data['contacts_count'] }}</h3>
                                                <p class="text-danger d-flex"><i class="mdi mdi-star-outline"></i></p>
                                            </a>
                                        </div>



                                        <div>
                                            <a href="{{ route('admin.user.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Users</p>
                                                <h3 class="rate-percentage">{{ $data['users_count'] }}</h3>
                                                <p class="text-danger d-flex"><i class="mdi mdi-account-outline"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>



                        {{-- Categories --}}
                        <div class="tab-pane fade show " id="catss" role="tabpanel" aria-labelledby="catss">
                            <h4 class="text-muted pb-1">Categories</h4>
                            <div class="row">
                                <div class="col-lg-3 m-auto text-center col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div class="card card-body bg-light ">
                                            <a href="{{ route('admin.cat.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Categories</p>
                                            </a>
                                            <h3 class="rate-percentage">{{ $data['categories_count'] }}</h3>
                                            <p class="text-success text-center pt-2"><i class="mdi mdi-chart-pie"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                {{-- Details --}}
                                <h5 class="text-muted pb-1">Latest Categories</h5>
                                @foreach ($data['categories'] as $cat)
                                    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                        <div class="card bg-success card-rounded pb-2">
                                            <div class="card-body pb-0">
                                                <a href="{{ route('admin.cat.show', $cat->id) }}"
                                                    style="text-decoration: none">
                                                    <h4 class="card-title card-title-dash text-white mb-4">
                                                        {{ $cat->name }}
                                                        <i class="mdi mdi-chart-pie"></i>
                                                    </h4>
                                                </a>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="status-summary-ight-white mb-1">
                                                            {{ $cat->created_at->diffForHumans() }}
                                                        </p>
                                                        <p class="status-summary-ight-white mb-1 d-inline">Number of Groups
                                                            :</p>
                                                        <h2 class="text-light d-inline mb-2 ">
                                                            {{ $cat->groups->count() }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <hr>
                        </div>


                        {{-- Tags --}}
                        <div class="tab-pane fade show " id="tagss" role="tabpanel" aria-labelledby="tagss">
                            <h4 class="text-muted pb-1">Tags</h4>
                            <div class="row">
                                <div class="col-lg-3 m-auto text-center col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div class="card card-body bg-light ">
                                            <a href="{{ route('admin.tag.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Tags</p>
                                            </a>
                                            <h3 class="rate-percentage">{{ $data['tags_count'] }}</h3>
                                            <p class="text-dark text-center pt-2"><i class="mdi mdi-tag"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                {{-- Details --}}
                                <h5 class="text-muted pb-1">Latest Tags</h5>
                                @foreach ($data['tags'] as $tag)
                                    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                        <div class="card bg-dark card-rounded pb-2">
                                            <div class="card-body pb-0">
                                                <a href="{{ route('admin.tag.show', $tag->id) }}"
                                                    style="text-decoration: none">
                                                    <h4 class="card-title card-title-dash text-white mb-4">
                                                        {{ $tag->name }}
                                                        <i class="mdi mdi-chart-pie"></i>
                                                    </h4>
                                                </a>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="status-summary-ight-white mb-1">
                                                            {{ $tag->created_at->diffForHumans() }}
                                                        </p>
                                                        <p class="status-summary-ight-white mb-1 d-inline">Number of Groups
                                                            with this tag :</p>
                                                        <h2 class="text-light d-inline mb-2 ">
                                                            {{ $tag->groups->count() }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <hr>
                        </div>



                        {{-- Groups --}}
                        <div class="tab-pane fade show " id="groupss" role="tabpanel" aria-labelledby="groupss">
                            <h4 class="text-muted pb-1">Groups</h4>
                            <div class="row">
                                <div class="col-lg-3 m-auto text-center col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div class="card card-body bg-light ">

                                            <a href="{{ route('admin.group.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Groups</p>
                                            </a>
                                            <h3 class="rate-percentage">{{ $data['groups_count'] }}</h3>
                                            <p class="text-info text-center pt-2"><i class="mdi mdi-group"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Details --}}
                                <h5 class="text-muted pb-1">Latest Group</h5>
                                @foreach ($data['groups'] as $group)
                                    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                        <div class="card bg-primary card-rounded pb-2">
                                            <div class="card-body pb-0">
                                                <a href="{{ route('admin.group.show', $group->id) }}"
                                                    style="text-decoration: none">
                                                    <h4 class="card-title card-title-dash text-white mb-4">
                                                        {{ $group->name }}
                                                        <i class="mdi mdi-group"></i>
                                                    </h4>
                                                </a>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="status-summary-ight-white mb-1">
                                                            {{ $group->created_at->diffForHumans() }}
                                                        </p>
                                                        <p class="status-summary-ight-white mb-1 d-inline">Number of Posts
                                                            :</p>
                                                        <h2 class="text-info d-inline mb-2 ">
                                                            {{ $group->posts->count() }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <hr>
                        </div>



                        {{-- Posts --}}
                        <div class="tab-pane fade show " id="postss" role="tabpanel" aria-labelledby="postss">
                            <h4 class="text-muted pb-1">Posts</h4>
                            <div class="row">
                                <div class="col-lg-3 m-auto text-center col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div class="card card-body bg-light ">
                                            <a href="{{ route('admin.tag.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Posts</p>
                                            </a>
                                            <h3 class="rate-percentage">{{ $data['posts_count'] }}</h3>
                                            <p class="text-dark text-center pt-2"><i class="mdi mdi-cards"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                {{-- Details --}}
                                <h5 class="text-muted pb-1">Latest Posts</h5>
                                @foreach ($data['posts'] as $post)
                                    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                        <div class="card bg-dark card-rounded pb-2">
                                            <div class="card-body pb-0">
                                                <a href="{{ route('admin.post.show', $post->id) }}"
                                                    style="text-decoration: none">
                                                    <h4 class="card-title card-title-dash text-white mb-2">
                                                        {{ $post->title }}
                                                        <i class="mdi mdi-cards-outline"></i>
                                                    </h4>
                                                </a>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="status-summary-ight-white mb-1 d-inline">
                                                            By:
                                                        </p>
                                                        <p class=" d-inline mb-2 ">
                                                            <a href="{{ route('admin.user.show', $post->user->id) }}" style="text-decoration: none" class="text-light">
                                                                {{ $post->user->name }} <i class="mdi mdi-account-outline"></i>
                                                            </a>
                                                        </p>
                                                        <br>
                                                        {{-- Group det --}}
                                                        <p class="status-summary-ight-white mb-1 d-inline">Group
                                                            :</p>
                                                        <p class=" d-inline mb-2 ">
                                                            <a href="{{ route('admin.group.show', $post->group->id) }}" style="text-decoration: none" class="text-light">
                                                                {{ $post->group->name }} <i class="mdi mdi-group"></i>
                                                            </a>
                                                        </p>
                                                        <p class="status-summary-ight-white mb-1">
                                                            {{ $post->created_at->diffForHumans() }}
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <hr>
                        </div>


                        {{-- Reports --}}
                        <div class="tab-pane fade show " id="reportss" role="tabpanel" aria-labelledby="reportss">
                            <h4 class="text-muted pb-1">Reports</h4>
                            <div class="row">
                                <div class="col-lg-3 m-auto text-center col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div class="card card-body bg-light ">
                                            <a href="{{ route('admin.report.index') }}" style="text-decoration: none">
                                                <p class="statistics-title">Total Reports</p>
                                            </a>
                                            <h3 class="rate-percentage">{{ $data['reports_count'] }}</h3>
                                            <p class="text-warning text-center pt-2"><i
                                                    class="mdi  mdi-comment-question-outline"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Details --}}
                                {{-- 1- All Reports --}}
                                <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                    <div class="card bg-primary card-rounded pb-2">
                                        <div class="card-body pb-0">
                                            <a href="{{ route('admin.report.index') }}" style="text-decoration: none">
                                                <h4 class="card-title card-title-dash text-white mb-4">All Reports
                                                    <i class="mdi  mdi-comment-question-outline"></i>
                                                </h4>
                                            </a>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="status-summary-ight-white mb-1 d-inline">Number of Reports:
                                                    </p>
                                                    <h2 class="text-info text-center d-inline mb-2 ">
                                                        {{ $data['reports_count'] }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- 2- Non Handled --}}
                                <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                    <div class="card bg-danger card-rounded pb-2">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">Not Handled
                                                <i class="mdi  mdi-comment-question-outline"></i>
                                            </h4>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="status-summary-ight-white mb-1 d-inline">Number of Reports:
                                                    </p>
                                                    <h2 class="text-light d-inline mb-2 ">
                                                        {{ $data['not_h_reports']->count() }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- 3- Non Handled --}}
                                <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                    <div class="card bg-success card-rounded pb-2">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">Handled
                                                <i class="mdi  mdi-comment-question-outline"></i>
                                            </h4>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="status-summary-ight-white mb-1 d-inline">Number of Reports:
                                                    </p>
                                                    <h2 class="text-light d-inline mb-2 ">
                                                        {{ $data['h_reports']->count() }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                        </div>


                        {{-- Contact --}}
                        <div class="tab-pane fade show " id="contactss" role="tabpanel" aria-labelledby="contactss">
                            <h4 class="text-muted pb-1">Contacts</h4>
                            <div class="row">
                                <div class="col-lg-3 m-auto text-center col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div class="card card-body bg-light ">
                                            <p class="statistics-title">
                                                <a href="{{ route('admin.contact.index') }}"
                                                    style="text-decoration: none">
                                                    Total Contacts
                                                </a>
                                            </p>
                                            <h3 class="rate-percentage">{{ $data['contacts_count'] }}</h3>
                                            <p class="text-warning text-center pt-2"><i class="mdi mdi-phone"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Details --}}
                                <h5 class="text-muted pb-1">Latest Contacts</h5>
                                @foreach ($data['contacts'] as $contact)
                                    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                        <div class="card bg-warning card-rounded pb-2">
                                            <div class="card-body pb-0">
                                                <h4 class="card-title card-title-dash text-white mb-4">
                                                    <a href="{{ route('admin.user.show', $contact->user->id) }}"
                                                        style="text-decoration: none">
                                                        {{ $contact->user->name }}
                                                    </a>
                                                    <i class="mdi mdi-phone"></i>
                                                </h4>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="status-summary-ight-white mb-1">
                                                            {{ $contact->created_at->diffForHumans() }}
                                                        </p>
                                                        <a href="{{ route('admin.contact.show', $contact->id) }}"
                                                            style="text-decoration: none">
                                                            <p class="status-summary-ight-white mb-1 d-inline">Subject of
                                                                Contact: </p>
                                                            <p class="text-dark d-inline mb-2 "> {{ $contact->subject }}
                                                            </p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <hr>
                        </div>


                        {{-- Users --}}
                        <div class="tab-pane fade show " id="userss" role="tabpanel" aria-labelledby="userss">
                            <h4 class="text-muted pb-1">Users</h4>
                            <div class="row">
                                <div class="col-lg-3 m-auto text-center col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div class="card card-body bg-light ">
                                            <p class="statistics-title">
                                                <a href="{{ route('admin.user.index') }}" style="text-decoration: none">
                                                    Total Users
                                                </a>
                                            </p>
                                            <h3 class="rate-percentage">{{ $data['users_count'] }}</h3>
                                            <p class="text-info text-center pt-2"><i class="mdi mdi-account"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Details --}}
                                <h5 class="text-muted pb-1">Latest Users</h5>
                                @foreach ($data['users'] as $user)
                                    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                        <div class="card bg-info card-rounded pb-2">
                                            <div class="card-body pb-0">
                                                <h4 class="card-title card-title-dash text-white mb-4">
                                                    <a href="{{ route('admin.user.show', $user->id) }}"
                                                        style="text-decoration: none">
                                                        {{ $user->name }}
                                                    </a>
                                                    <i class="mdi mdi-account"></i>
                                                </h4>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="status-summary-ight-white mb-1">
                                                            {{ $user->updated_at->diffForHumans() }}
                                                        </p>
                                                        <p class="status-summary-ight-white mb-1 d-inline">Number of Posts
                                                            :</p>
                                                        <h2 class="text-primary d-inline mb-2 ">
                                                            {{ $user->posts->count() }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
