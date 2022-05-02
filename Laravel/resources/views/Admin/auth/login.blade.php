<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Dashboard</title>


      <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/back.png')}}" />


    <title>MyPartner - Dashboard Login</title>
</head>
<body>
    <div class="container-scroller text-center">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo text-center">
                    @include('Admin.inc.errors')
                    </div>
                  <div class="brand-logo text-center mb-0">
                    <div class="image mb-0">
                        <img class="img" style="d-block ; width:100%; height:100%; object-fit:cover;"
                            src="{{ asset('images/logo/P.svg') }}" alt="Logo">
                    </div>
                    {{-- <i class="mdi mdi-account-multiple">MyPartner</i>
                    <br>
                    <span>Find Your Partner</span> --}}

                  </div>
                  <h4>Hello! let's get started</h4>
                  <h6 class="fw-light">Sign in to continue.</h6>
                  <form class="pt-3" action="{{route('admin.dologin')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Username">
                              @error('email')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-lg"  name="password" id="exampleInputPassword1" placeholder="Password">
                      @error('password')<span class="text-danger">{{$message}}</span>@enderror

                    </div>
                    <div class="mt-3">
                      <input type="submit" class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn" value="SIGN IN" >
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
