@extends('Admin.layout')

@section('content')
    <h4>Posts</h4>

    <div class="row">
        <div class="col-lg-8 col-sm-4 mb-1">
            <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="text-center pb-2 " style="float:right; ">
                <form action="{{ route('admin.post.index') }}" method="POST" class="pb-2">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <select name="status" class="form-control text-center " style="font-size: 14px">
                                <option value="all">All Posts</option>
                                <option value="yes" @if ($selected_reps == 'yes') selected @endif>
                                        Visible</option>
                                <option value="no" @if ($selected_reps == 'no') selected @endif>
                                            Invisible</option>
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
                        <th scope="col">Post Title</th>
                        <th scope="col">Post Owner</th>
                        <th scope="col">At</th>
                        <th scope="col">Visible</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableData">
                    {{-- Start Fetch Data --}}
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>
                            <a href="{{route('admin.user.show' , $post->user_id)}}" style="text-decoration: none">
                            {{ $post->user->name }}
                            </a>
                        </td>
                        <td>
                            <strong>
                                {{ $post->updated_at->diffForHumans() }}
                                <i class="mdi mdi-timer"></i>
                            </strong>
                        </td>
                            <td><strong class="
                                @if ($post->visible == 'yes')
                                    text-success
                                @else
                                    text-dark
                                @endif
                                "> {{ $post->visible }} </strong>
                            </td>
                            <td>
                                <a href="{{ route('admin.post.show', $post->id) }}"
                                    class="btn btn-sm btn-dark text-white">Show Details</a>
                            </td>
                        </tr>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        {{ $posts->appends(request()->input())->links() }}
                    </div>
                    {{-- End Fetch Data --}}
                </tbody>
            </table>
        </div>

    </div>
@endsection
