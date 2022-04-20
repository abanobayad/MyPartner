@extends('Admin.layout')

@section('content')
    <div class="card p-3 col-lg-6 col-md-12  m-auto bg-light">
        @include('Admin.inc.errors')
        @include('Admin.inc.message')
        <div class="mb-3">
            Ban details of user <h4>{{ $user->name }}</h4>
            <i class="fas fa-font-awesome-flag">Email: {{ $user->email }} </i>
        </div>

        <div class="mb-3 actions">
            <div class="card p-2 ">
                <ul style="list-style-type: none;">
                    <p class="text-danger">Hint: Enter
                        <span style="font-size: 16px ; font-weight: 100; color:darkblue">'0'</span>
                        for BAN Permanently!
                    </p>
                    @if ($user->banned_till == null)
                        <li>
                            <form action="{{ route('ban') }}" method="POST" class="form col-12 ">
                                @csrf
                                <input type="submit" class=" my-1 btn btn-sm  btn-outline-danger" min="0" value="Ban">
                                <input type="number" name="time" style="background-color: transparent ; border: none"
                                    placeholder="Enter Duration of Ban">
                                <input type="hidden" value="{{ $user->id }}" name='user_id'>
                            </form>
                        </li>
                    @endif
                    <div class="dropdown-divider"></div>
                    <li>
                        <form action="{{ route('ban.check') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name='user_id'>
                            <input type="submit" value="Check User Status" class="btn btn-sm btn-outline-dark">
                        </form>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <form action="{{ route('unban') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name='user_id'>
                            <input type="submit" value="Revoke" class="btn btn-sm btn-outline-success">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
