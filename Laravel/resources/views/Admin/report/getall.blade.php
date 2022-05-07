@extends('Admin.layout')

@section('content')


    <div class="row">
        <div class="col-12">
            <h6 class="text-muted mb-2">{{ $user->name }} send
                <span class="text-dark">
                    {{ $SentReports->count() }}
                </span>
                reports:
            </h6>
        </div>


        {{-- Card Sample
        <div class="col-12">
            @foreach ($SentReports as $report)
                <div class="card  card-body bg-light col-lg-6  col-md-12 m-auto mt-0 mb-1 p-2">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <p for="exampleFormControlInput1">Post Title :
                                        <a href="{{ route('admin.post.show', $report->post->id) }}">
                                            {{ $report->post->title }}
                                        </a>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p for="exampleFormControlInput1"> Post Owner :
                                        <a href="{{ route('admin.user.show', $report->post->user->id) }}">
                                            {{ $report->post->user->name }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <p for="exampleFormControlInput1">Reason : {{ $report->reason }}</p>
                                </div>
                                <div class="form-group">
                                    <p for="exampleFormControlInput1">Updated at :
                                        {{ $report->updated_at->diffForhumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.report.show', [$report->post_id, $report->user_id]) }}">
                                    <button type="button" class="btn btn-dark btn-sm text-light">View Details </button> </a>
                            </div>
                        </div>
                </div>
            @endforeach
        </div> --}}

        <div class="col-lg-12  mb-1">
            <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
        </div>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Post Owner</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableData">
                    {{-- Start Fetch Data --}}
                    @foreach ($SentReports as $report)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('admin.post.show', $report->post->id) }} " style="text-decoration: none">
                                    {{ $report->post->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.user.show', $report->post->user->id) }} "
                                    style="text-decoration: none">
                                    {{ $report->post->user->name }}
                                </a>
                            </td>
                            <td>{{ $report->reason }}</td>
                            <td>
                                <a href="{{ route('admin.report.show', [$report->post_id, $report->user_id]) }}"
                                    class="btn btn-sm btn-dark text-white">Show Details</a>
                                <a href="{{ route('admin.report.reject', [$report->post_id, $report->user_id]) }}"
                                    class="btn btn-sm btn-danger text-white">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    {{-- End Fetch Data --}}
                </tbody>
            </table>
        </div>


    </div>
@endsection
