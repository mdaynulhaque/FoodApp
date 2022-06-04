@extends('frontend.layouts.master')

@section('content')
<div class="container" >
	<div class="row">
		<div class="col-md-3 text-center " >
		  <div class="card card-body bg-light">
		  	<img src="{{asset(''.$user->avatar)}}" style="margin-left: 22% ;border-radius:100px; margin-bottom: 20px;margin-top: 20px;" height="120" width="120"  alt="Images">
            <div>
                 <h3>{{ Auth::user()->first_name ." ". Auth::user()->last_name }}</h3>
                 <i class="fa fa-circle text-success"></i> Online 
            </div>
		  	<div class="list-group mt-5">
			 	<a href="{{route('user.dashboard')}}" class="list-group-item {{Route::is('user.dashboard') ? 'active' :''}}" >Dashboard</a>
			 	<a href="{{route('user.profile')}}" class="list-group-item  {{Route::is('user.profile') ? 'active' :''}}" >Update Profile</a>
                <a href="{{route('user.order.history')}}" class="list-group-item  {{Route::is('user.order.history') ? 'active' :''}}" >Order History</a>
                <a href="{{route('carts')}}" class="list-group-item {{Route::is('carts') ? 'active' :''}}" >Cart</a>
			 

			 </div>
		  </div>
		</div>
		<div class="col-md-9 bg-light">
		  <div class="card ">
		  	<div class="card-header">
		 	<h2>{{$user->first_name}} {{$user->last_name}}`s profile information</h2><hr>
			 </div>
			 
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First_name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control " name="first_name"  required autocomplete="first_name" autofocus value="{{$user->first_name}}">

                               
                            </div>
                        </div>
                      <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last_name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{$user->last_name}}" required autocomplete="last_name" autofocus>

                              
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required autocomplete="email">

                               
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone_No') }}</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="phone_no" class="form-control " name="phone_no" value="{{$user->phone_no}}" required autocomplete="phone_no">

                               
                            </div>
                        </div>
                       
                         <div class="form-group row">
                            <label for="street_address" class="col-md-4 col-form-label text-md-right">{{ __('Street Address') }}</label>

                            <div class="col-md-6">
                                <input id="street_address" type="street_address" class="form-control " name="street_address" value="{{$user->street_address}}" required autocomplete="street_address">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                              
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('User Image') }}</label>

                            <div class="col-md-6">
                                <input  type="file" class="form-control" name="image" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-bottom: 20%">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

		  </div>
		</div>
	</div>
</div>


@endsection