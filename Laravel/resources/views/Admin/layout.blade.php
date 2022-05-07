@include('Admin.inc.header')
@include('sweetalert::alert')

<div class="main-panel">
    <div class="content-wrapper ">
      <div class="row ">
        <div class="col-sm-12">
          <div class="home-tab">
<div class="tab-content tab-content-basic">

    <div class="row">
        <div class="col-2 text-center">
            @if (Route::current()->methods[0] == 'GET')
            <a  class="btn btn-primary text-white me-0" href="{{ (url()->previous()) }}">
                <i class="mdi mdi-arrow-left-bold-hexagon-outline"></i>
                Back</a>
            @else
            <a class="btn btn-primary text-white me-0 " href="{{ route('admin.home') }}">
                <i class="mdi mdi-arrow-left-bold-hexagon-outline"></i>
                Back</a>
            @endif
        </div>
    </div>



@yield('content')
</div></div></div></div></div></div>


@include('Admin.inc.footer')
