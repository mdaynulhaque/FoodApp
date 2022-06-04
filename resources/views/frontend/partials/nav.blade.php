<header id="header" class=""><!--header-->
<div class="header_top "><!--header_top-->
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="contactinfo">
        <ul class="nav nav-pills">
          <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-phone"></i>&nbsp; #+8801781093576</a></li>
          <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i>&nbsp; aynul086@gmail.com</a></li>
        </ul>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="social-icons pull-right">
        <ul class="nav">
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        </ul>
      </div>
    </div> <div class="col-sm-4">
      <div class="social-icons pull-right">
        <ul class="nav navbar-nav">
           <li style="margin-top: 2px;">
          <form class="form-inline my-lg-0" method="get" action="{{ route('search')}}">
            <div class="input-group ">
              <input type="text" class="form-control form-control-sm" placeholder="Search here" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </li>        
      </ul>
      </div>
    </div>
  </div>
</div>
</div><!--/header_top-->


{{-- nav --}}
<nav class="navbar navbar-light  navbar-expand-md p-3 pb-0   bg-light"  uk-sticky="top:100; animation; uk-animation-slide-top; botttom:sticky-on-scroll-up">
  <div class="container">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarnav">
      <span class="navbar-toggler-icon text-dark"></span>
    </button>

    <div id="navbarnav" class="mainmenu pull-left collapse navbar-collapse ">
     <ul class="nav navbar-nav ml-auto">
          <li><a href="" class="active">Home</a></li>
          <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
          <ul role="menu" class="sub-menu">
            <li><a href="{{ route('checkouts') }}"><i class="fa fa-arrow-right"></i> Checkout</a></li>
            <li><a href="{{route('carts')}}"><i class="fa fa-arrow-right"></i> Cart</a></li>
          </ul>
        </li>

      <li><a href="{{route('products')}}">Products</a></li>
      <li><a href="{{route('carts')}}"></i>Carts <span class="badge badge-danger" id="totalItems">   {{App\Models\Cart::totalItems()}}</span></a></li>
      <li><a href="{{route('contact')}}">Contact</a></li>
      @if(Auth::user())
              <li class="nav-item dropdown"><a href="#">
                 @if(!empty(Auth::user()->avatar)) 
                <img src="{{ asset(Auth::user()->avatar) }}" height="40" width="40" style="border-radius: 40px; margin-top: -7px;" alt=""><i class="fa fa-angle-down">
                @else
                     <img src="{{ asset('images/users/avatar.png') }}" height="40" width="40" style="border-radius: 40px; margin-top: -7px;" alt=""><i class="fa fa-angle-down">
                @endif
                </i></a>
                <ul role="menu" class="sub-menu">
                    <li><a href="{{ route('user.dashboard') }}"><i class="fa fa-arrow-right"></i> User Dashboard</a></li>
                    <li><a href="{{ route('user.order.history') }}"><i class="fa fa-arrow-right"></i> Order History</a></li>
                    <li><a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-arrow-right"></i> Logout</a></li>
                    
                  </ul>
              </li>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf</form>
          @else
            <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
          @endif
    </ul>
      
    </div>
  </div>
</nav>
<hr class="bg-light mb-0 mt-0" style="height: 2px;">

