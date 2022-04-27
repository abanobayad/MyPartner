@extends('Admin.layout')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="text-center ">
                <div class="col-lg-4 mx-auto">
                    <i class="mdi mdi-account-multiple d-block align-self-center  text-dark" style="font-size: 30px">My<span
                            style="color: darkblue">Partner</span> </i>
                    <span>Find Your Partner</span>
                </div>
            </div>
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
                                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab"
                                    aria-selected="false">More</a>
                            </li>
                        </ul>
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
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="statistics-title">Total Groups</p>
                                            <h3 class="rate-percentage">{{ $data['groups_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>


                                        <div>
                                            <p class="statistics-title">Total Categories</p>
                                            <h3 class="rate-percentage">{{ $data['categories_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>

                                        <div>
                                            <p class="statistics-title">Total Tags</p>
                                            <h3 class="rate-percentage">{{ $data['tags_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>


                                        <div>
                                            <p class="statistics-title">Total Users</p>
                                            <h3 class="rate-percentage">{{ $data['users_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="tab-pane fade show active" id="catss" role="tabpanel" aria-labelledby="catss">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="statistics-title">Total Groups</p>
                                            <h3 class="rate-percentage">{{ $data['groups_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>


                                        <div>
                                            <p class="statistics-title">Total Categories</p>
                                            <h3 class="rate-percentage">{{ $data['categories_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>

                                        <div>
                                            <p class="statistics-title">Total Tags</p>
                                            <h3 class="rate-percentage">{{ $data['tags_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>


                                        <div>
                                            <p class="statistics-title">Total Users</p>
                                            <h3 class="rate-percentage">{{ $data['users_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade show active" id="groupss" role="tabpanel" aria-labelledby="groupss">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="statistics-title">Total Groups</p>
                                            <h3 class="rate-percentage">{{ $data['groups_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>


                                        <div>
                                            <p class="statistics-title">Total Categories</p>
                                            <h3 class="rate-percentage">{{ $data['categories_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>

                                        <div>
                                            <p class="statistics-title">Total Tags</p>
                                            <h3 class="rate-percentage">{{ $data['tags_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>


                                        <div>
                                            <p class="statistics-title">Total Users</p>
                                            <h3 class="rate-percentage">{{ $data['users_count'] }}</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-group"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
