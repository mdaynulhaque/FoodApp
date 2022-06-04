@extends('frontend.layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3  text-center">
		  <div class="card card-body bg-light">
		  	<img src="{{asset($user->avatar)}}" height="120" width="120"  style="margin-left: 22% ;border-radius:100px; margin-bottom: 20px;margin-top: 20px;" alt="Images">
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
		<div class="col-md-9">
		  <div class="card">
		  	<div class="card-header">
		 	<h2>{{$user->first_name}} {{$user->last_name}}`s ordered history </h2><br>
			 </div>
			 <div class="card-body">
			 	<h2 class="text-center">Order History</h2><hr>
			 	<table class="table table-hover table-striped display text-center" id="my">
	  			<thead class="bg-dark text-light">
	  			 <tr>
	  			 	
	  			 	<th>Order_id</th>
	  			 	<th>Price</th>
	  			 	<th>paid</th>
	  			 	<th>Complete</th>
	  			 	<th>Ordered</th>
	  			 	<th>Order Cancel</th>
	  			 	
	  			 </tr>
	  			</thead>
	  			<tbody>
	  				@foreach($orders as $order)
	  				 <tr>
	  				 	<td>CPFOI_{{$order->id}}</td>
	  				 	<td>{{$order->amount}} /-Taka</td>
	  				 	@if($order->is_paid)
	  				 	  <td><p>Paid</p></td>
	  				 	 @else
	  				 	 <td><p class=" text-danger">Unpaid</p></td>
	  				 	@endif
	  				 	@if($order->is_completed)
	  				 	  <td><p >Cpmpleted</p></td>
	  				 	 @else
	  				 	 <td><p class="text-danger">Uncomplete</p></td>
	  				 	@endif
	  				 	@if($order->is_seen_by_admin)
	  				 	  <td><p >Seen</p></td>
	  				 	 @else
	  				 	 <td><p class="text-danger">Unseen</p></td>
	  				 	@endif
	  				 	@if($order->is_cancel)
	  				 	  <td><p class="text-danger">Cancel</p></td>
	  				 	 @else
	  				 	 <td><p class="text-success">NotCancel</p></td>
	  				 	@endif

	  				 </tr>
	  				@endforeach
	  			</tbody>
	  			
	  		</table>
	<div class="pagination mt-5">
				{{$orders->Links()}}
			</div>
			 </div>
		  </div>
		</div>

	</div>
</div>
@endsection