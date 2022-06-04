
<h2 class="title text-center">Features Items</h2>
<div class="row">
@foreach($products as $product)

	<div class="col-sm-4">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				<img src="{{asset($product->image)}}" height="150" alt="CP-Group" />
				<h2>Taka- {{$product->price}} /-</h2>
				<a href="{{route('product.show',$product->id)}}"><h4>{{$product->title}}</h4></a>
				@include('frontend.pages.product.partials.cart_button')
				
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
</div>


<div class="continer">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="pagination mt-5">
				{{$products->Links()}}
			</div>
		</div>
	</div>
</div>