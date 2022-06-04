  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('common/bootstrap-4.4.1/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
  <script src="{{ asset('frontend/js/price-range.js')}}"></script>
  <script src="{{ asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
  <script src="{{ asset('frontend/js/main.js')}}"></script>
 
 <script src="{{ asset('common/sweet-alert-2/sw-alert.js') }}" type="text/javascript"></script>



     {{-- Toastar Alert --}}
     <script type="text/javascript">

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


     
  </script>

<script type="text/javascript">
	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	function addToCart(product_id) {
		$.post("{{ route('cart.store')}}",
		{
			product_id:product_id
		})
		.done(function(data){
			data=JSON.parse(data);
			if (data.status=='success') {
				  Toast.fire({
				  	  position: 'top',
			          icon: 'success',
			          title: 'Item added successfully !!<br> To Items: '+data.totalItems+' To checkouts ,<a href="{{route('carts')}}" style="padding:3px; text-decoration:none; color:green;">go to checkouts Page</a>'
			        });
				$('#totalItems').html(data.totalItems);
			}
		});
	}
</script>