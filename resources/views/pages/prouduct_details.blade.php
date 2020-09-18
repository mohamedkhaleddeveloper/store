@if($lang == 'ar')
@include('pages.inc.ar.head')
@include('pages.inc.ar.header')



<div class="container mt-5">
	<div class=" col-md-12 mt-5  mb-4 row">
		<div class="col-md-6  text-center">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
	  <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{URL::to($product_by_details->products_image1)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" >
      </div>
      <div class="carousel-item">
        <img src="{{URL::to($product_by_details->products_image2)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{URL::to($product_by_details->products_image3)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
	  <div class="carousel-item">
        <img src="{{URL::to($product_by_details->products_image4)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">قبل</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">بعد</span>
    </a>
  </div>
		</div>
		<div class="col-md-6">
			<div class="col-md-12 text-center">
			
			<div class="col-md-12 col-6 mt-5 text-center">
			<h5 class="card-title mt-5">{{$product_by_details->products_name_arabic}}</h5>
			<h2 class="card-title mt-5">{{$product_by_details->products_price}} EGP</h2>
				
				<form action="{{url('/add-to-cart')}}" method="post">
					<label>الكمية :</label>
					<div class="col-md-12 row">
										{{ csrf_field() }}
										<input type="hidden" name="lang" value="ar"/>
										<input type="hidden" name="products_id" value="{{$product_by_details->products_id}}"/>
										<div class="col-md-6">
										<input type="number" class="form-control" name="qty" value="1" min="0" max="100" step="0"/>
										</div>
										<div class="col-md-6">
										<button type="submit" class="form-control btn btn-outline-light bg-standerd"><i class="fa fa-shopping-cart"></i> أضف لسلتك </button>
										</div>
						</div>
									</form>
			
			
									</div></div>
		</div>
		<div class="col-md-12 row mt-5 mb-5">
		<nav class="col-md-12">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
		<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-brand" aria-selected="false">Brand</a>

		</div>
		</nav>
		<div class="tab-content col-md-12" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-details-tab">{{$product_by_details->products_short_description_arabic}}</div>
		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-brand-tab">>{{$product_by_details->brand_description_arabic}}</div>
		</div>
		</div>
			
	</div>
</div>

@include('pages.inc.ar.footer')
@else

@include('pages.inc.en.head')
@include('pages.inc.en.header')



<div class="container mt-5">
	<div class=" col-md-12 mt-5  mb-4 row">
		<div class="col-md-6  text-center">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
	  <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{URL::to($product_by_details->products_image1)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" >
      </div>
      <div class="carousel-item">
        <img src="{{URL::to($product_by_details->products_image2)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{URL::to($product_by_details->products_image3)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
	  <div class="carousel-item">
        <img src="{{URL::to($product_by_details->products_image4)}}" alt="{{$product_by_details->products_name}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Prev</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
		</div>
		<div class="col-md-6">
			<div class="col-md-12 text-center">
			
			<div class="col-md-12 col-6 mt-5 text-center">
			<h5 class="card-title mt-5">{{$product_by_details->products_name}}</h5>
			<h2 class="card-title mt-5">{{$product_by_details->products_price}} EGP</h2>
					<form action="{{url('/add-to-cart')}}" method="post">
					<label>Quantity:</label>
					<div class="col-md-12 row">
										{{ csrf_field() }}
										<input type="hidden" name="lang" value="en"/>
										<input type="hidden" name="products_id" value="{{$product_by_details->products_id}}"/>
										<div class="col-md-6">
										<input type="number" class="form-control" name="qty" value="1"  min="0" max="100"/>
										</div>
										<div class="col-md-6">
										<button type="submit" class="form-control btn btn-outline-light bg-standerd"><i class="fa fa-shopping-cart"></i> Add to Cart </button>
										</div>
									</form>
						
					</div>
				</div>
			</div>
			
			</div>
		</div>
		<div class="col-md-12 row mt-5 mb-5">
		<nav class="col-md-12">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
		<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-brand" aria-selected="false">Brand</a>

		</div>
		</nav>
		<div class="tab-content col-md-12" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-details-tab">{{$product_by_details->products_short_description}}</div>
		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-brand-tab">>{{$product_by_details->brand_description}}</div>
		</div>
		</div>
			
	</div>
</div>

@include('pages.inc.en.footer')
@endif