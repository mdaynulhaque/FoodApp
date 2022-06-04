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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-light"><h3>Restaurant Registration Here</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Restaurant Name</label>

                            <div class="col-md-6">
                                <input id="res_name" type="text" class="form-control " name="res_name"  required autocomplete="res_name" autofocus placeholder="Restaurant Name">

                              
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Bussiness E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email"  required autocomplete="email" placeholder="email address">

                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">Phone_No</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="number" class="form-control " name="phone_no" required autocomplete="phone_no" placeholder="Phone number">

                                
                            </div>
                        </div>
                    
                         <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">website URL</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control" name="website" required autocomplete="website" placeholder="website url">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="password">

                            
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">District</label>

                            <div class="col-md-6">
                                <select class="form-control form-control-sm" name="district_id" 
                                    required="required" id="district_id">
                                    <option>Select District </option>
                                    @foreach($districts as $dis)
                                    <option value="{{ $dis->id }}">{{ $dis->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Thana</label>

                            <div class="col-md-6">
                                <select class="form-control form-control-sm" name="thana_id" 
                                    required="required" id="thana_id">
                                    <option>Select Thana </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="street_address" class="col-md-4 col-form-label text-md-right">Restaurant Address</label>

                            <div class="col-md-6">
                                <textarea id="street_address"  class="form-control" name="street_address" required autocomplete="street_address" placeholder="Full  Address"></textarea>

                                
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-bottom: 20%">
                                   Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="{{ asset('app-assets/vendors/js/core/jquery-3.2.1.min.js') }}" type="text/javascript"></script>

<script>
  
$('#district_id').change(function(){
  var district_id=$('#district_id').val();

  var opt=  "";

  $.get("http://127.0.0.1:8000/register/thana/"+district_id,function(data){

    var data=JSON.parse(data);
    data.forEach(function(data){
        opt+='<option value="'+data.id+'">'+data.name+'</option>';
    });

     $('#thana_id').html(opt);

  });

});

</script>

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

