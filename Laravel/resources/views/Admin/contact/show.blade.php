@extends('Admin.layout')

@section('content')

<div class="container" style="padding-top: 2%">
        @if(count($contacts) < 1)
            <div class="alert alert-danger" role="alert">
                there in no contacts from this user
                        </div>
        @else
            @foreach ($contacts as $contact)

            <div class="card bg-light col-lg-6  col-md-12 m-auto mt-0">
                <div class="card-body">
                    <div class="form-group">
                        <h4 for="exampleFormControlInput1"> Contacter Name :
                            <a href="{{ route('admin.user.show', $contact->user->id) }}" style="text-decoration: none">
                                {{ $contact->user->name }}
                            </a>
                        </h4>
                    </div>


                    <div class="form-group">
                        <h5 for="exampleFormControlInput1">Subject : {{ $contact->subject }}</h5>
                    </div>

                    <div class="form-group">
                        <h5 for="exampleFormControlInput1">Content : {{ $contact->content }}</h5>
                    </div>

                    <div class="form-group">
                        <h5 for="exampleFormControlInput1">Reason : {{ $contact->reason }}</h5>
                    </div>



                    <div class="form-group">
                        <h6 for="exampleFormControlInput1">Created at : {{ $contact->created_at->diffForhumans() }}</h6>
                    </div>

                    <div class="form-group  mx-auto">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('admin.contact.replay', $contact->id) }}" method="post">
                                    @csrf
                                    <label  >Enter Contact Replay</label>
                                    @if ($contact->reason == "Create New Group")
                                                <select name="content" class="form-control w-50 bg-dark text-light h-100 m-auto text-center" >
                                                    <option  value="Already Group Exits">Already Group Exists</option>
                                                    <option value="We Are going to create it , thanks for your help us be better">Group Not Exist</option>
                                                </select>
                                            @elseif ($contact->reason == 'Create New Category')
                                            <select name="content" class="form-control w-50 bg-dark text-light h-100 m-auto text-center" >
                                                <option value="Already Category Exists">Already Category Exists</option>
                                                    <option value="We Are going to create it , thanks for your help us be better">Category Not Exist</option>
                                                </select>
                                            @else
                                            <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
                                            @error('content')<span class="text-danger">{{$message}}</span>@enderror
                                    @endif


                                    <input type="submit" class="btn btn-sm btn-dark mt-3 text-light" style="float: right" value="Replay">
                                </form>

                            </div>
                        </div>
                    </div>


                </div>
            </div>


            @endforeach
        @endif


</div>









@endsection
