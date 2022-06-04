@extends('frontend.layouts.master')

@section('content')
<div class="container" id="cart_items">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li><a class="mt-0" href="{{ route('index') }}">Home</a></li>
		  <li class="active">Shopping Cart</li>
		</ol>
	</div>

	<div class="row">
		<div class="col-md-3">
			@include('frontend.partials.left-side')
		</div>
		<div class="col-md-9">
			@if(App\Models\Cart::totalItems() > 0)
			<div class="table-responsive cart_info">
				<table class="table table-condensed" id="cart-table">
					<thead >
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
					 	 $total_price=0;
					 	@endphp
						@foreach(App\Models\Cart::totalCarts() as $cart)
						<tr>
							<td class="cart_product">
								<a href="{{route('product.show',$cart->product->title)}}"><img class="img" src="{{asset($cart->product->image)}}" alt="" height="70" width="70"></a>
							</td>
							<td class="cart_description">
								<h4><a href="{{route('product.show',$cart->product->title)}}"> {{$cart->product->title}}</a></h4>
								<p style="margin-top: 2px;">Web ID:000{{ $cart->product->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{$cart->product->price}} /-</p>
							</td>
							<td class="cart_quantity">
								<button class="minus cart_quantity_up" id="{{ $cart->id }}" style="display: inline-block; margin-right: -5px;"> - </button>
								<div class="cart_quantity_button" style="display: inline-block;">
									
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->product_quantity  }}" autocomplete="off" size="2" readonly="">
									<button class="plus cart_quantity_down" style=" margin-left: -2px;" id="{{ $cart->id }}"> + </button>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									@php
								  	$total_price+=$cart->product->price * $cart->product_quantity;
								  	@endphp
								  	{{$cart->product->price * $cart->product_quantity}} /-
								</p>
							</td>
							<td class="cart_delete">
								<button id="{{ $cart->id }}"class="delete cart_quantity_delete" href=""><i class="fa fa-times" style="color:red"></i></button>
							</td>
						</tr>
						
						@endforeach
					</tbody>
				</table>
			</div>
			

			<div class="row">
				<div class="col-sm-6">
					{{-- <div class="total_area">

					</div> --}}
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<div class="card card-body bg-light">
							<ul>
							<li>Cart Sub Total <span>{{ $total_price }} /-</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{ $total_price }} /-</span></li>
						</ul>
							<a class="btn  update d-inline-block" href="{{route('products')}}">Continue Shopping <i class="fa fa-arrow-circle-o-right"></i></a>
							<a class="btn  update d-inline-block" href="{{route('checkouts')}}">Checkout <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
			</div>

			@else
				<h2 class="display-4 alert alert-info">There is no Cart please Add your Products</h2>
				<a class="btn btn-info" href="{{route('products')}}" style="margin-bottom: 10%">Continue Shopping....</a>
			@endif
		</div>
	</div>
</div>

@endsection





@section('script')

<script>
	 // delete data start from  here
    $(document).on('click', '.delete', function(){

    let id = $(this).attr('id');

    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {

        console.log(id)

                $.ajax({
                url: "cart/delete/"+id,
                method: 'get',
                success:function(response){
                    //console.log(response);
                    if(response = 'ok'){

                        //Sweet alert
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your file has been deleted',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        location.reload();
                    }else{
                        console.log(response);
                    }


                },
                error:function(response){
                    console.log(response);
                }
            });

            }
        })

    });
    //delete end here



// Increment data start from  here

 $(document).on('click', '.plus', function(){
  id = $(this).attr('id');
  $.ajax({
  url:"cart/plus/"+id,
   success:function(data)
   {
    // toastr
       Toast.fire({
          icon: 'success',
          title: 'Cart Added successfully'
        });
      location.reload();
   }
  })
 });
// increment end here


$(document).on('click', '.minus', function(){
  id = $(this).attr('id');
  $.ajax({
  url:"cart/minus/"+id,
   success:function(data)
   {
   	if(data.error){
   		 Toast.fire({
          icon: 'error',
          title: 'Cart Subtruct Not Possible'
        });
   	}else{
    // toastr
	       Toast.fire({
	          icon: 'success',
	          title: 'Cart Subtruct successfully'
	        });
  		 }
      location.reload();
   }
  })
 });



</script>
@endsection