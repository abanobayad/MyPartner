@extends('Admin.layout')

@section('content')
    <h4 style="display: inline-block">Contacts</h4>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User name</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td> {{ $contact->user->name }} </td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->reason }}</td>

                        <td>
                            <a href="{{ route('admin.contact.show', $contact->id) }}"
                                class="btn btn-sm btn-dark text-white">Show Details</a>
                            <a href="{{ route('admin.contact.delete', $contact->id) }}"
                                class="btn btn-sm btn-danger text-white">Delete</a>
                        </td>
                    </tr>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $contacts->appends(request()->input())->links() }}
                </div>
            </tbody>
        </table>
    </div>
@endsection
