@extends('frontend.layouts.master')
@section('content')
<div class="container mt-5">
	<div class="row">
		<div class="col-md-3">
			@include('frontend.partials.left-side')
		</div>
		<div class="col-sm-9">
			<div class="product-details"><!--product-details-->
			<div class="row">
				<div class="col-sm-5">
					<div class="view-product">
						<img src="{{asset($product->image)}}" alt="CP-Group" />
					</div>
					<div id="mycarousel" class="carousel slide" data-ride="carousel">
						
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<ol class="carousel-indicators">
								<li data-slide-to="0" data-target="#mycarousel" class="active"></li>
								<li data-slide-to="1" data-target="#mycarousel" ></li>
								<li data-slide-to="2" data-target="#mycarousel" ></li>
							</ol>

							<div class="carousel-item active">
								<a href=""><img src="{{asset($product->image)}}" height="100" width="100" alt=""></a>
								<a href=""><img src="{{asset($product->image2)}}" height="100" width="100" alt=""></a>
								<a href=""><img src="{{asset($product->image3)}}" height="100" width="100" alt=""></a>
							</div>
							<div class="carousel-item">
								<a href=""><img src="{{asset($product->image)}}" height="100" width="100" alt=""></a>
								<a href=""><img src="{{asset($product->image2)}}" height="100" width="100" alt=""></a>
								<a href=""><img src="{{asset($product->image3)}}" height="100" width="100" alt=""></a>
							</div>
							<div class="carousel-item">
								<a href=""><img src="{{asset($product->image)}}" height="100" width="100" alt=""></a>
								<a href=""><img src="{{asset($product->image2)}}" height="100" width="100" alt=""></a>
								<a href=""><img src="{{asset($product->image3)}}" height="100" width="100" alt=""></a>
							</div>
							
						</div>
						<!-- Controls -->
						<a href="#mycarousel" class="carousel-control-prev" data-slide="prev">
							<span class=""><i class="fa fa-angle-left text-dark" style="font-size: 40px; font-weight: bold;"></i></span>
						</a>
						<a href="#mycarousel" class="carousel-control-next" data-slide="next">
							<span ><i class="fa fa-angle-right text-dark" style="font-size: 40px; font-weight: bold;"></i></span>
						</a>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="product-information"><!--/product-information-->
					<h2>Product Name: {{$product->title}}</h2>
					<p>Product ID: {{$product->id}}</p>
					<img src="images/product-details/rating.png" alt="" />
					<span>
						<span>Price: {{$product->price}} TK</span> @include('frontend.pages.product.partials.cart_button')
					</span>
					<p><b>Availability:</b> <span class="badge badge-info">
						{{$product->quantity < 1 ? 'No Item Available' : $product->quantity.' Item is Stock'}}
					</span></p>
					<p><b>Condition:</b> Good</p>
					<p><b>Description:</b>{{$product->description}}</p>
					
					</div><!--/product-information-->
				</div>
			</div>
			</div><!--/product-details-->
			
		</div>
		</div><!--/category-tab-->
		
	</div>
	{{-- 		<div class="col-md-4">
		<div class="card">
			<div id="slider-carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#slider-carousel" data-slide-to="1"></li>
					<li data-target="#slider-carousel" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<img class="img img-center" src="{{asset($product->image)}}" alt="{{$product->title}}"  style=" width: 362px;margin-left: -50px; height: 300px;">
					</div>
					<div class="item ">
						<img class="" src="{{asset($product->image2)}}" alt="{{$product->title}}" style="width: 362px;margin-left: -50px; height: 300px;">
					</div>
					<div class="item ">
						<img class="" src="{{asset($product->image3)}}" alt="{{$product->title}}" style="width: 362px;margin-left: -50px;height: 300px;">
					</div>
					
				</div>
				<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div>
		
		<h3 class="text-center bg-danger text-light p-3">{{$product->title}} </h3>
	</div>
	<div class="col-md-5">
		<div class="widget">
			<h3>{{$product->title}} </h3>
			<h3>{{$product->price}} /-Taka</h3>
			<span class="badge badge-info">
				{{$product->quantity < 1 ? 'No Item Available' : $product->quantity.' Item is Stock'}}
			</span>
			<hr>
			<div class="description">
				<p class="lead">{{$product->description}}</p>
			</div>
			
		</div>
	</div> --}}
	@endsection