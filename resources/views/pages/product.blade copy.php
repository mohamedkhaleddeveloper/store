@if($lang == 'ar')
@include('pages.inc.ar.head')
@include('pages.inc.ar.header')


<div class="col-md-12 mt-5 mb-5 row">
	<div class="col-md-9">
	<div class="col-md-12 row">
	@foreach($all_product_info as $key=>$v_product)
	<div class="col-md-4  text-center row">
		<img src="{{URL::to($v_product->products_image1)}}" alt="{{$v_product->products_name}}" class="img-fulid">
		<div class="col-md-12 text-center">
		<h5 class="card-title">{{$v_product->products_name_arabic}}</h5>
		<p class="card-text">{{$v_product->products_short_description_arabic}}</p>
		<a href="product.html" class="btn btn-outline-light bg-standerd"><i class="fas fa-cart-plus"></i> أضف لسلتك</a>
		</div>
  </div>
  @endforeach


	</div>
	</div>
	<div class="col-md-3  row text-center">
		<img src="{{asset('frontend/newstyle/img/product/adv.jpg')}}" alt="..." class="img-fulid">
	</div>
</div>


@include('pages.inc.ar.footer')
@else

@include('pages.inc.en.head')
@include('pages.inc.en.header')


<div class="col-md-12 mt-5 mb-5 row">
	<div class="col-md-9">
	<div class="col-md-12 row">
	@foreach($all_product_info as $key=>$v_product)
	<div class="col-md-4  text-center row">
		<img src="{{URL::to($v_product->products_image1)}}" alt="{{$v_product->products_name}}" class="img-fulid">
		<div class="col-md-12 text-center">
		<h5 class="card-title">{{$v_product->products_name}}</h5>
		<p class="card-text">{{$v_product->products_short_description}}</p>
		<a href="product.html" class="btn btn-outline-light bg-standerd"><i class="fas fa-cart-plus"></i> Add to Cart</a>
		</div>
  </div>
  @endforeach


	</div>
	</div>
	<div class="col-md-3  row text-center">
		<img src="{{asset('frontend/newstyle/img/product/adv.jpg')}}" alt="..." class="img-fulid">
	</div>
</div>



@include('pages.inc.en.footer')
@endif


