@extends('Admin.layout')

@section('content')
    <h4>{{$post->title}} Requests</h4>

    <div class="row">
        <div class="col-lg-8 col-sm-4 mb-1">
            <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="text-center pb-2 " style="float:right; ">
                <form action="{{ route('admin.post.requests.show' , $post->id) }}" method="POST" class="pb-2">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <select name="status" class="form-control text-center " style="font-size: 14px">
                                <option value="all">All Requests</option>
                                <option value="pending" @if ($selected_reps == 'pending') selected @endif>
                                    Pending</option>
                                <option value="Acc" @if ($selected_reps == 'Acc') selected @endif>
                                    Accepted</option>
                                <option value="Rej" @if ($selected_reps == 'Rej') selected @endif>
                                        Rejected</option>
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
                        <th scope="col">Requester Name</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="tableData">
                    {{-- Start Fetch Data --}}
                    @foreach ($requests as $request)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td> {{ $request->requester->name }} </td>
                            <td>
                                @if( $request->status == "pending")
                                <button type="button" class="btn btn-primary" > {{ $request->status }}</button>
                            @elseif($request->status == "accept")
                                <button type="button" class="btn btn-success" > {{ $request->status }}</button>
                            @else
                                <button type="button" class="btn btn-danger" > {{ $request->status }}</button>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    {{-- End Fetch Data --}}
                    <div class="d-flex justify-content-center">
                        {{ $requests->appends(request()->input())->links() }}
                    </div>
                </tbody>
            </table>
        </div>

    </div>
@endsection
