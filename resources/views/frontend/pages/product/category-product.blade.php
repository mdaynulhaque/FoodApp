@extends('frontend.layouts.master')

@section('content')
<div class="container mt-5">
	<div class="row bg-light">
		<div class="col-md-3">
			@include('Frontend.partials.left-side')
		</div>
	<div class="col-md-9">
			<div class="widget">
				<h3>Category Search Products </h3><hr>
				<div class="row">
					@if(count($products)>0)
					@foreach($products as $product)

					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset($product->image)}}" height="150" alt="CP-Group" />
									<h2>Taka- {{$product->price}} /-</h2>
									<p>{{$product->title}}</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<h2>Taka- {{$product->price}} /-</h2>
										<a href="{{route('product.show',$product->id)}}"><p>{{$product->title}}</p></a>
										@include('frontend.pages.product.partials.cart_button')
										
									</div>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="{{route('product.show',$product->id)}}"><i class="fa fa-plus-square"></i>View Details</a></li>
								</ul>
							</div>
						</div>
						</div>
					@endforeach
					@else
					<h2 class="display-4 text-danger text-center">Not Found Any Product</h2>
					@endif
				</div>
				<div class="pagination" style="margin-bottom: 10%">
					{{$products->Links()}}
				</div>
			</div>
	</div>
  </div>
</div>



@endsection