<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="{{ route('admin.home') }}">
                <img src="{{ asset('images/logo/P.svg') }}" alt="logo"
                    style="width: 100%; height: 100%; object-fit: cover;" />
                {{-- <i class="mdi mdi-account-search"><span class="text-dark">My</span>Partner</i> --}}
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin.home') }}">
                {{-- <i>MyPartner</i> --}}
                <img src="{{ asset('images/logo/B.png') }}" style="width: 100%; height: 100%; object-fit: cover;"
                    alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Good Morning, <span
                        class="text-black fw-bold">{{ auth()->guard('admin')->user()->name }}
                    </span></h1>
                <h3 class="welcome-sub-text">Your performance summary this week </h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">

            {{-- Select Box Start --}}
            {{-- <li class="nav-item dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown"
                            href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="messageDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">Select Category</p>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Bootstrap Bundle
                                    </p>
                                    <p class="fw-light small-text mb-0">This is a Bundle featuring 16 unique dashboards
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Angular Bundle</p>
                                    <p class="fw-light small-text mb-0">Everything you’ll ever need for your Angular
                                        projects
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">VUE Bundle</p>
                                    <p class="fw-light small-text mb-0">Bundle of 6 Premium Vue Admin Dashboard</p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">React Bundle</p>
                                    <p class="fw-light small-text mb-0">Bundle of 8 Premium React Admin Dashboard</p>
                                </div>
                            </a>
                        </div>
                    </li> --}}
            {{-- <li class="nav-item dropdown d-none d-lg-block">

                        <img class="img" style="d-block ; width:30%; height:50%; object-fit:cover;float:right"
                            src="{{ asset('images/logo/P.svg') }}" alt="Logo">
                    </li> --}}
            {{-- Select Box End --}}

            {{-- Search Icon Start --}}
            <li class="nav-item d-none d-lg-block">
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>
            {{-- Search Icon End --}}


            {{-- Try --}}
            <li class="nav-item dropdown">

                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="icon-bell icon-lg"></i>
                    <span id="noti_count">
                        @if (auth()->guard('admin')->user()->unreadNotifications->count() > 0)
                            <span class="count "></span>
                            <span class=" badge badge-danger text-warning"
                                id="noti_count">{{ auth()->guard('admin')->user()->unreadNotifications->count() }}
                            </span>
                        @else
                            <span class=" badge badge-dark text-dark ">
                                {{ auth()->guard('admin')->user()->unreadNotifications->count() }}

                            </span>
                        @endif
                    </span>

                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0 " style="width: 400px;"
                    style="overflow-y: auto;" aria-labelledby="notificationDropdown">
                    <a href="{{ route('markAllRead') }}" class="dropdown-item py-2 border-bottom">
                        <div class="row">
                            <div class="col-8">
                                <p class="mb-0 font-weight-medium float-left">
                                    You have
                                    <span id="noti_countt">
                                        {{ auth()->guard('admin')->user()->unreadNotifications->count() }}
                                    </span>
                                    new notifications
                                </p>
                            </div>
                            <div class="col-4" style="float: right">
                                <span class="badge badge-pill badge-primary  text-primary ">Mark all</span>
                            </div>
                        </div>
                    </a>
                    <div id="noti_content">
                        @foreach (auth()->guard('admin')->user()->unreadNotifications->sortByDesc('updated_at')->take(3)
    as $notification)
                            <a class="dropdown-item  preview-item py-3"
                                href="{{ route('markRead', $notification->id) }}">
                                <div class="preview-item-content">
                                    <h6 class="preview-subject fw-normal text-dark mb-1">

                                        {{-- <div class="preview-thumbnail">
                                            @if ($notification->type == 'App\Notifications\MakeContact')
                                                <i class="mdi mdi-phone-incoming m-auto text-success"></i>
                                            @elseif ($notification->type == 'App\Notifications\AdminPostReported')
                                                <i class="mdi mdi-alert m-auto text-danger"></i>
                                            @elseif ($notification->type == 'App\Notifications\PostAdded')
                                                <i class="mdi mdi-flag m-auto text-primary"></i>
                                            @endif
                                        </div> --}}

                                        <div class="preview-item-content flex-grow py-2 col-md-12">
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
                                                        <i
                                                            class="mdi mdi-alert-circle-outline px-5 mx-3 text-danger"></i>
                                                    @elseif ($notification->type == 'App\Notifications\PostAdded')
                                                        <i class="mdi mdi-flag px-5 mx-4  text-primary"></i>
                                                    @endif
                                                    {{-- End Icon Cond --}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <p class="fw-light small-text mb-0">
                                                    {{ $notification->data['data']['body'] }} </p>
                                            </div>
                                        </div>
                                    </h6>
                                    <p class="fw-light small-text mb-0">
                                        {{ $notification->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                        {{-- @foreach (auth()->guard('admin')->user()->unreadNotifications->sortByDesc('updated_at')->take(3) as $notification)
                            <a class="dropdown-item preview-item py-3"
                                href="{{ route('markRead', $notification->id) }}">
                                <div class="preview-thumbnail">
                                    @if ($notification->type == 'App\Notifications\MakeContact')
                                        <i class="mdi mdi-phone-incoming m-auto text-success"></i>
                                    @elseif ($notification->type == 'App\Notifications\AdminPostReported')
                                        <i class="mdi mdi-alert m-auto text-danger"></i>
                                    @elseif ($notification->type == 'App\Notifications\PostAdded')
                                        <i class="mdi mdi-flag m-auto text-primary"></i>
                                    @endif
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject fw-normal text-dark mb-1">
                                        {{ $notification->data['data']['title'] }}</h6>
                                    <p class="fw-bold small-text mb-0"> {{ $notification->data['data']['body'] }}
                                    </p>
                                    <p class="fw-light small-text mb-0">
                                        {{ $notification->updated_at->diffForHumans() }} </p>
                                </div>
                            </a>
                        @endforeach --}}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('showAll') }}" class="dropdown-item py-3 border-bottom">
                                <span class=" m-auto   text-muted ">Show All</span>
                            </a>
                        </div>
                    </div>
                </div>
            </li>

            {{-- End Try --}}
            {{-- Notiy Comented --}}
            {{-- {{-- Notifications Start
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="countDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('images') }}/faces/face10.jpg" alt="image"
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('images') }}/faces/face12.jpg" alt="image"
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('images') }}/faces/face1.jpg" alt="image"
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins
                                    </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                {{-- Notifications End --}}

            {{-- Admin Account Start --}}
            <li class="nav-item dropdown  d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle"
                        src="{{ asset('uploads/Admins') .'/' .auth()->guard('admin')->user()->image }}"
                        alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center ">
                        <img class="img-md rounded-circle"
                            src="{{ asset('uploads/Admins') .'/' .auth()->guard('admin')->user()->image }}"
                            alt="Profile image" width="60px" height="60px">
                        <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->guard('admin')->user()->name }}
                        </p>
                        <p class="fw-light text-muted mb-0">{{ auth()->guard('admin')->user()->email }}</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 m-auto">
                            <a class="dropdown-item " href="{{ route('admin.edit') }}"><i
                                    class="dropdown-item-icon mdi mdi-lead-pencil text-primary me-2"></i>Edit
                                Account</a>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign
                                Out</a>
                        </div>
                    </div>

                </div>
            </li>
            {{-- Admin Account End --}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas p-0 m-0" id="sidebar">
    <ul class="nav">

        {{-- SideBar --}}

        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- Cats --}}
        <li class="nav-item nav-category">Categories</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#categories" aria-expanded="false"
                aria-controls="categories">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Categories Actions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="categories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.cat.create') }}">Add
                            Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.cat.index') }}">Edit
                            Category</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.cat.index') }}">Delete Category</a></li>
                </ul>
            </div>
        </li>

        {{-- Tags --}}
        <li class="nav-item nav-category">TAGS</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tags" aria-expanded="false"
                aria-controls="tags">
                <i class="menu-icon mdi mdi-tag-multiple"></i>
                <span class="menu-title">TAG Actions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tags">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.tag.create') }}">Add
                            Tag</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.tag.index') }}">Edit
                            Tag</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.tag.index') }}">Delete Tag</a></li>
                </ul>
            </div>
        </li>

        {{-- Groups --}}
        <li class="nav-item nav-category">Groups</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#groups" aria-expanded="false"
                aria-controls="groups">
                <i class="menu-icon mdi mdi-microsoft"></i>
                <span class="menu-title">Groups Actions</span>
                <i class="menu-arrow"></i>
            </a>


            <div class="collapse" id="groups">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.group.create1') }}">Add Group</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.group.index') }}">Edit Group</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.group.index') }}">Delete Group</a></li>
                </ul>
            </div>
        </li>

        {{-- Posts --}}
        <li class="nav-item nav-category">Posts</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#posts" aria-expanded="false"
                aria-controls="posts">
                <i class="menu-icon mdi mdi-cards-outline"></i>
                <span class="menu-title">Posts Actions</span>
                <i class="menu-arrow"></i>
            </a>


            <div class="collapse" id="posts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.post.index') }}">Show Posts</a></li>
                </ul>
            </div>
        </li>


        {{-- Contacts --}}
        <li class="nav-item nav-category">Contacts</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#contact" aria-expanded="false"
                aria-controls="contact">
                <i class="menu-icon mdi mdi mdi-voice"></i>
                <span class="menu-title">Contacts Actions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="contact">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.contact.index') }}">All Contacts </a></li>
                </ul>
            </div>
        </li>


        {{-- Rates --}}
        <li class="nav-item nav-category">Rates</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#rates" aria-expanded="false"
                aria-controls="rates">
                <i class="menu-icon mdi mdi mdi-star-half"></i>
                <span class="menu-title">Rates Actions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="rates">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.rate.index') }}">All Rates </a></li>

                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.rate.low') }}">low
                            Rates </a></li>
                </ul>
            </div>
        </li>

        {{-- reports --}}
        <li class="nav-item nav-category">Reports</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false"
                aria-controls="reports">
                <i class="menu-icon mdi mdi mdi-alert-outline"></i>
                <span class="menu-title">Reports Actions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.report.index') }}">All reports</a></li>

                </ul>
            </div>
        </li>

        {{-- Users --}}
        <li class="nav-item nav-category">Users</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false"
                aria-controls="users">
                <i class="menu-icon mdi mdi-account"></i>
                <span class="menu-title">Users Actions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.user.index') }}">Show Users</a></li>

                </ul>
            </div>
        </li>


        {{-- Setting --}}
        <li class="nav-item nav-category">Setting</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#Setting" aria-expanded="false"
                aria-controls="Setting">
                <i class="menu-icon mdi mdi-settings"></i>
                <span class="menu-title">Setting Actions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Setting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.word.index') }}">Illegal Words</a></li>
                    <li class="nav-item"> <a class="nav-link"
                                href="{{ route('admin.edit') }}">Account Info</a></li>

                </ul>
            </div>
        </li>

</nav>
<!-- partial -->



