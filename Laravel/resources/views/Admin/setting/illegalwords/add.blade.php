@extends('Admin.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form role="form" class="form repeater-default" action="{{ route('admin.word.doCreate') }}" method="POST">
                @csrf
                <div id="myRepeatingFields" >
                    <div class="entry input-group  col-lg-12">
                        <div class="row col-6 m-auto">
                            <div class="col-6 form-group">
                                <label class="control-label" for="ourField">Word</label>
                                <input class="form-control" name="word[]" type="text" placeholder="Enter Word" required />
                            </div>
                            <div class="col-2  form-group d-flex align-items-center pt-2">
                                <span class="input-group-btn pt-3">
                                    <button type="button" class=" btn-success btn-sm btn-add">
                                        <i class="mdi mdi-plus sm" aria-hidden="true"></i>
                                    </button>
                                </span>
                        </div>
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
