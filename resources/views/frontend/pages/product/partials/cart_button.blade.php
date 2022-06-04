<form  class="form-inline" action="{{ route('cart.store')}}" method="post">
	@csrf
	<input type="hidden" name="product_id" value="{{$product->id}}">

	@if(Auth::user())
		<button type="button" class="btn btn-success btn-block" onclick="addToCart({{$product->id}})" ><i class="fa fa-plus"></i>Add to Cart</button>
	@else
	 	<a  class="btn btn-success btn-block" href="{{ route('login') }}" ><i class="fa fa-plus"></i>Add to Cart</a>
	 @endif
</form>