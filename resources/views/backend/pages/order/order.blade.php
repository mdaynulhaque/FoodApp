@extends('backend.layouts.master')

@section('content')
<div class="container">
	<h2 class="text-center">Order Details</h2>
	<h3 class="bg-info p-2">Order Id: {{ $order->id }}
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Aboumt: {{ $order->amount }}</h3>
	@foreach($cart as $c)
	<div class="card card-body">
	
	<div class="row">
		
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6 text-right">
					<h5> Name:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->order->name }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5> Email:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->user->email }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5> District:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->user->district->name }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5> Thana:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->user->thana->name }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5> Phone:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->user->phone_no }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5>Shipping Address:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->order->shipping_address }}
				</div>
			</div>
			
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6 text-right">
					<h5> Product Name:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->product->title }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5>Category:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->product->category->name }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5>Quantity:</h5>
				</div>
				<div class="col-md-6">
					<span class="badge badge-info">{{ $c->product_quantity }}</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5>Payment By:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->order->payment->name }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5>Transaction_id:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->order->transaction_id }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<h5>User Message:</h5>
				</div>
				<div class="col-md-6">
					{{ $c->order->message }}
				</div>
			</div>
		</div>

		
	</div>

	</div>
	@endforeach
</div>

@endsection