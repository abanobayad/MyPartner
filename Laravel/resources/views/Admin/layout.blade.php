@include('Admin.inc.header')
@include('sweetalert::alert')

<div class="main-panel">
    <div class="content-wrapper ">
      <div class="row ">
        <div class="col-sm-12">
          <div class="home-tab">
<div class="tab-content tab-content-basic">

    @if (Route::current()->methods[0] == 'GET')
    <a class="btn btn-sm btn-primary " href="{{ url()->previous() }}">Back</a>
    @else
    <a class="btn btn-sm btn-primary " href="{{ route('admin.home') }}">Back</a>
    @endif



@yield('content')
</div></div></div></div></div></div>


@include('Admin.inc.footer')
