<!DOCTYPE html>
<html lang="en" class="loading">
  <!-- BEGIN : Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Food Delivery</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @include('admins.layouts.icon') --}}
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/feather/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
 
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/modified.app.css') }}">
   
  <!-- END : Head-->

  <!-- BEGIN : Body-->
  <body data-col="1-column" class=" 1-column  blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!--Login Page Starts-->
          <section id="login">
            <div class="container-fluid">
              <div class="row full-height-vh m-0">
                <div class="col-12 d-flex align-items-center justify-content-center">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body login-img">
                        <div class="row m-0">
                          
                          <div class="col-lg-6 d-lg-block d-none py-2 text-center align-middle">
                            <img src="{{ asset('app-assets/img/gallery/login.png') }}" alt="" class="img-fluid mt-5" width="400" height="230">
                          </div>
                          
                             <div class="col-lg-6 col-md-12 bg-white px-4 pt-3">
                              @include('frontend.partials.message')

                            <h4 class="mb-2 card-title">Login</h4>
                            <p class="card-text mb-3">
                              Welcome back, please login to your account.
                            </p>
                              <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="email" class="form-control mb-3" placeholder="Username" name="email" />
                            <input type="password" name="password" class="form-control mb-1" placeholder="Password" />
                            <div class="d-flex justify-content-between mt-2">
                              <div class="remember-me">
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                  <input type="checkbox" id="customCheckboxInline1" name="customCheckboxInline1" class="custom-control-input" />
                                  <label class="custom-control-label" for="customCheckboxInline1">
                                    Remember Me
                                  </label>
                                </div>
                              </div>
                              <div class="forgot-password-option">
                                <a href="forgot-password-page.html" class="text-decoration-none text-primary">Forgot Password
                                ?</a>
                              </div>
                            </div>
                            <div class="fg-actions d-flex justify-content-between">
                              <div class="login-btn">
                                <button class="btn btn-outline-primary">
                                <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
                                </button>
                              </div>
                              <div class="recover-pass">
                                <button type="submit" class="btn btn-primary">Login </button>
                              </div>
                            </div>
                            <hr class="m-0">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!--Login Page Ends-->
        </div>
      </div>
      <!-- END : End Main Content-->
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
 
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/core/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/core/bootstrap.min.js') }}" type="text/javascript"></script>

  <!-- END PAGE LEVEL JS-->
</body>
<!-- END : Body-->
</html>



