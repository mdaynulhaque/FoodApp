@extends('frontend.layouts.master')

@section('content')
<div class="container">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li class=""><a class="mt-0" href="{{ route('index') }}">Home</a></li>
		  <li class="active">Check out</li>
		</ol>
	</div><!--/breadcrums-->

	
	
	{{-- cart part --}}
	<h2 class="mb-2 animated  bounce delay-1s">Payment & Review Cart</h2>
	<div class="row"  id="cart_items">
		<div class="col-md-12">
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
								<p style="margin-top: 2px;">Web ID:{{ $cart->product->id}}</p>
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


				<hr>
				<div class="card-body">
					<div class="row">
						<div class="col-md-8">
							<a class="btn btn-info update " href="{{route('products')}}">Continue Shopping <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
						<div class="col-md-4 float-right">
							<table class="table table-bordered table-hover float-right">
								<tr>
									<td>Cart Sub Total </td><td>{{ $total_price }} /-</td>
								</tr>
								<tr>
									<td>Shipping Cost </td><td><span>Free</span> /-</td>
								</tr>
								<tr>
									<td>Net Total </td><td>{{ $total_price }} /-</td>
								</tr>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>

		
	</div>

</div>


 {{-- Billing address --}}
<div class="container">
<form class="" action="{{route('checkout.store')}}" method="post">@csrf	
<div class="row">
	<div class="col-md-4">
		<div class="card card-body height bg-light">
			<h4>Billing Address</h4>
			<input type="hidden" name="amount" value="{{$total_price + App\Models\Setting::first()->shipping_cost}}">
			<div class="form-group">
				<input type="text" name="name" class="form-control form-control-sm" value="{{Auth::check() ? Auth::user()->first_name.' '.Auth::user()->last_name : ''}}" required placeholder="Enter Your Full Name">
			</div>
			<div class="form-group">
				<input type="text" name="email" class="form-control form-control-sm" value="{{Auth::check() ? Auth::user()->email : ''}}" required placeholder="Email Address">
			</div>
			<div class="form-group">
			  	<input type="text" name="phone_no" class="form-control form-control-sm" value="{{Auth::check() ? Auth::user()->phone_no : ''}}" required placeholder="Mobile Number">
			</div>
			<div class="form-group">
			  	<input type="text" name="shipping_address" class="form-control form-control-sm" value="{{Auth::check() ? Auth::user()->shipping_address : ''}}" required placeholder="Enter Shipping Address">
			</div>	
		</div>
	</div>



	<div class="col-md-4">
		<div class="card card-body height">
			<h4>Message Box</h4>
			<div class="form-group row">
			
			  
			  	<textarea class="form-control" style="border:none;" name="message" rows="10" placeholder="Write about Address Details and message something " required=""></textarea>
			  
			</div>	
		</div>
	</div>

	<div class="col-md-4">
		<div class="card card-body height bg-light">
			<h4>Payment </h4>
				<div class="form-group ">

                    <div class="">
                       <select class="form-control form-control-sm" name="payment_method_id" required id="Payment_method">
                       		<option value="">Select Payment_method</option>
                       		@foreach($payments as $payment)
							<option value="{{$payment->short_name}}">{{$payment->name}}</option>
                       		@endforeach
                       </select>
		          @foreach($payments as $payment)
		                              	
		            @if($payment->short_name == "cash_in")
		              <div id="Payment_{{$payment->short_name}}" class="hidden alert alert-success mt-2 animated lightSpeedIn delay-.5s">
		                 <h3>For cash_in so Nothing </h3>
		                              			<br>
		               	<small>You will get this in 2 or 3 days</small>
		              </div>
		          @else
		             <div class="row animated">
		             	<div class="col ">
		             		 <div id="Payment_{{$payment->short_name}}" class="hidden alert alert-success mt-2 animated lightSpeedIn delay-.5s">
			                <h3>{{$payment->name}} Payment</h3>
			                <p>
			              	<strong>{{$payment->name}} No: {{$payment->no}}</strong></p>
			           		<div class="">
			                   Please send your money  and input TID 
			                </div>
			                  
		                 </div>
		             	</div>
		             </div>
		          @endif
		                              	
		         @endforeach
		          <input type="text" name="tid" id="tid"class="form-control hidden animated lightSpeedIn delay-.5s" placeholder="enter Transection ID">
		        </div>
		       </div>
			</div>
	</div>

</div>
<div class="form-group row mt-3 mb-3">
  <div class="col-md-4 m-auto">
  	<button type="submit" class="btn btn-success btn-block">Order Now <i class="fa fa-arrow-circle-o-right"></i></button>
  </div>
</div>
</form>

		@else
		<h2 class="display-4 alert alert-info ">There is no Cart please Add your Products</h2>
			<a class="btn btn-info" href="{{route('products')}}" style="margin-bottom: 10%">Continue Shopping....</a>
	    @endif
	</div>
</div>


@endsection

@section('script')
<script type="text/javascript">
					$("#Payment_method").change(function(){
		$payment=$("#Payment_method").val();
		if ($payment=='cash_in') {
			$("#Payment_cash_in").removeClass('hidden');
			$("#Payment_bkash").addClass('hidden');
			$("#Payment_roket").addClass('hidden');
			$("#tid").addClass('hidden');
		}
		else if($payment=='bkash'){
			$("#Payment_bkash").removeClass('hidden');
			$("#tid").removeClass('hidden');
			$("#Payment_cash_in").addClass('hidden');
			$("#Payment_roket").addClass('hidden');
			$("#tid").removeClass('hidden');
			
		}
		else if($payment=='roket'){
			$("#Payment_roket").removeClass('hidden');
			$("#Payment_cash_in").addClass('hidden');
			$("#Payment_bkash").addClass('hidden');
			$("#tid").removeClass('hidden');

		}

	});
</script>

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
   	}
   	else{
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