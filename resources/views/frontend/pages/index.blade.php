
@extends('frontend.layouts.master')

@section('content')
<div id="loader"></div>
@include('Frontend.partials.slider')

<div class="container mt-5">
	<div class="row">
		<div class="col-md-3">
			<div class="left-sidebar">
				@include('frontend.partials.left-side')
			</div>
		</div>
		<div class="col-md-9">
			@include('frontend.pages.product.partials.all_products')
		</div>
  </div>
</div>



@endsection
<script type="text/javascript">
	var loader;
	function load(opacity){
		if (opacity <= 0) {
			displayContent();
		}
		else{
			loader.style.opacity=opacity;
			window.setTimeout(function(){
				load(opacity - 0.05)
			},100);
		}
	} 
	function displayContent(){
		loader.style.display='none';
		document.getElementById('content').style.display='block';
	}
	document.addEventListener("DOMContentLoaded",function(){
		loader=document.getElementById('loader');
		load(1);
	})
</script>