<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    {{-- Start --}}


    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors') }}/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('vendors') }}/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('vendors') }}/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('vendors') }}/typicons/typicons.css">
    <link rel="stylesheet" href="{{ asset('vendors') }}/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{ asset('vendors') }}/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors') }}/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('js') }}/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css') }}/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

    {{-- End --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>MyPartner Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script> --}}
    @yield('css')
</head>

<body>
 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">

        @include('Admin.inc.nav')





