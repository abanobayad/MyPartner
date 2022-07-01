@extends('Admin.layout')

@section('content')
    <h4>Reports</h4>

    <div class="row">
        <div class="col-lg-8 col-sm-4 mb-1">
            <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="text-center pb-2 " style="float:right; ">
                <form action="{{ route('admin.report.index') }}" method="POST" class="pb-2">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <select name="handled" class="form-control text-center " style="font-size: 14px">
                                <option value="all">All Reports</option>
                                <option value="yes" @if ($selected_reps == 'yes') selected @endif>
                                    Handled Reports</option>
                                <option value="no" @if ($selected_reps == 'no') selected @endif>
                                    Not Handled Reports</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn form-control mb-2">Show</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Post Owner</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">is handled </th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableData">
                    {{-- Start Fetch Data --}}
                    @foreach ($reports as $report)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('admin.user.show',$report->user->id) }}" style="text-decoration: none">
                                    {{ $report->user->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.post.show',$report->post->id) }}" style="text-decoration: none">
                                    {{ $report->post->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.user.show',$report->post->user_id) }}" style="text-decoration: none">
                                    {{ $report->post->user->name }}
                                </a>
                            </td>
                            <td>{{ $report->reason }}</td>
                            <td>{{ $report->feedback }}</td>
                            <td>{{ $report->is_handled }}</td>
                            <td>
                                <a href="{{ route('admin.report.show', [$report->post_id, $report->user_id]) }}"
                                    class="btn btn-sm btn-dark text-white">Show Details</a>
                            </td>
                        </tr>
                    @endforeach
                    {{-- End Fetch Data --}}
                    <div class="d-flex justify-content-center">
                        {{ $reports->appends(request()->input())->links() }}
                    </div>
                </tbody>
            </table>
        </div>

    </div>
@endsection
