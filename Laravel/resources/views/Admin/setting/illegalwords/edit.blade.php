@extends('Admin.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form role="form" class="form repeater-default" action="{{ route('admin.word.doEdit') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$word->id}}">
                    <div class="entry input-group  col-lg-12">
                        <div class="row col-6 m-auto">
                            <div class="col-6 form-group">
                                <label class="control-label" for="ourField">Word</label>
                                <input class="form-control" name="word" type="text" placeholder="Enter Word" value="{{$word->word}}" required />
                            </div>
                    </div>
                </div>

                <div class="row  col-8"  style="float: right">
                    <div class="col-6">
                        <input type="submit" value="Done" class="btn btn-dark sm text-light">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
