@extends('Admin.layout')

@section('content')
    <h4 style="display: inline-block">Rates</h4>

    <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
    <br>
   <div class="table-responsive">
       <table class="table text-center">
           <thead>
               <tr>
                <th scope="col">#</th>
                <th scope="col">Sender Name</th>
                <th scope="col">Receiver Name</th>
                <th scope="col">Rate Value</th>
                <th scope="col">Actions</th>
               </tr>
           </thead>
           <tbody id="tableData">
               {{-- Start Fetch Data --}}
               @foreach ($rates as $rate)
                   {{-- {{dd($cat->admin)}} --}}
                   <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td> {{ $rate->sender->name }} </td>
                    <td>{{ $rate->receiver->name }}</td>
                    <td>{{ $rate->rate_value }}</td>

                    <td>
                        <a href="{{ route('admin.rate.show', $rate->id) }}" class="btn btn-sm btn-dark text-white">Show
                            Details</a>
                        <a href="{{ route('admin.rate.delete', $rate->id) }}"
                            class="btn btn-sm btn-danger text-white">Delete</a>
                    </td>
                </tr>
            @endforeach
               {{-- End Fetch Data --}}
           </tbody>
       </table>
   </div>

@endsection
