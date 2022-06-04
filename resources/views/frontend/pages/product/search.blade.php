@extends('Frontend.layouts.master')

@section('content')

<section>
	<!-- strt side bar -->
<div class="container margin-top">
	<div class="row">
		<div class="col-md-4">
			@include('Frontend.partials.left-side')

		</div>
		<!-- end side bar -->
		<div class="col-md-8">
			<div class="widget">
				<h3>Search Products For <span class="badge badge-success">  {{$search}}</span></h3>
				@include('Frontend.pages.product.partials.all_products')
			</div>
		</div>
	</div>
</div>

</section>

@endsection