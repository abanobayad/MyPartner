@extends('Admin.layout')

@section('content')

    <h4 style="display: inline-block">Low Rates </h4>

<div class="table-responsive">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">user name</th>
        <th scope="col">Totol rate value</th>
        <th scope="col">Totol number of rates</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
       @foreach ($data as $d)
                <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>
                    <a href="{{ route('admin.user.show',$d['id']) }}" style="text-decoration: none">
                        {{$d['name']}}
                    </a>
                </td>
                <td>{{$d['avg']}}</td>
                <td>{{$d['number']}}</td>
                <td>
                    <a  href="{{route('admin.rate.get' , $d['id'])}}" class="btn btn-sm btn-dark text-white">Show all rates</a>
                  </td>
                </tr>
        @endforeach
    </tbody>
  </table>
</div>



@endsection
