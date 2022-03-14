@if(session()->has('message'))
    <div class="alert alert-success  mb-2 mt-3 col-6 m-auto " style="text-align: center">
        {{ session()->get('message') }}
    </div>
    <br>
@endif
