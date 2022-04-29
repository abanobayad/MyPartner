@include('Admin.inc.header')
@include('sweetalert::alert')

<div class="main-panel">
    <div class="content-wrapper ">
      <div class="row ">
        <div class="col-sm-12">
          <div class="home-tab">
<div class="tab-content tab-content-basic">

@yield('content')
</div></div></div></div></div></div>


@include('Admin.inc.footer')
