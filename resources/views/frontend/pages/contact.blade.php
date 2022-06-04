@extends('frontend.layouts.master')

@section('content')
<div id="contact-page" class="container mt-4">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li><a class="mt-0" href="{{ route('index') }}">Home</a></li>
		  <li class="active">Contact</li>
		</ol>
	</div>
    	<div class="bg">
	    	<div class="row mb-4">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    		
					<div class="mapouter"><div class="gmap_canvas"><iframe width="1080" height="394" id="gmap_canvas" src="https://maps.google.com/maps?q=cp%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com">https://www.whatismyip-address.com/</a></div><style>.mapouter{position:relative;text-align:right;height:394px;width:1080px;}.gmap_canvas {overflow:hidden;background:none!important;height:394px;width:1080px;}</style></div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" action="{{ route('contact.store') }}" class="contact-form row" name="contact-form" method="post">@csrf
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>C.P. Bangladesh Co., Ltd.</p>
							<p>Holding 36 Ward No:7 Chandra</p>
							<p>Kaliyakoir Gazipur Bangladesh</p>
							<p>Mobile: 0179667688</p>
							<p>Fax: 1-22-33-333</p>
							<p>Email: info@cpbangladesh.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link" href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->

@endsection