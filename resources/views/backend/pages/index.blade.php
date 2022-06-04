@extends('backend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="card card-body">
        <h3>Welcome to your Admin Panel</h3>
        <p><a href="http://mobarok.me/" class="btn btn-primary btn-lg" target="_blank">Visit Main Site</a></p>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="https://mobarok.me/" target="_blank"></a>. All rights reserved.</span>
      </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
@endsection
