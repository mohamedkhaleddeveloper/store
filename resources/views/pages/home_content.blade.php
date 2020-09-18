@if($lang == 'ar')
@include('pages.inc.ar.head')
@include('pages.inc.ar.header')
<section class="slider container">
	<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
	@foreach($all_slider_info as $key=>$v_slider)
      <li data-target="#carouselExampleCaptions" data-slide-to="{{$v_slider->sider_id}}" 
	  class= <?php if($key == 0){echo 'active';}?>></li>
	  @endforeach
    </ol>
	<div class="carousel-inner">
	@foreach($all_slider_info as $key=>$v_slider)
   
      <div class="carousel-item <?php if($key == 0){echo 'active';}?>">
        <img src="{{URL::to($v_slider->slider_image)}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>{{$v_slider->slider_name_arabic}}</h5>
          <p>{{$v_slider->slider_description_arabic}}</p>
        </div>
      </div>
	  @endforeach
      
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</section>

<div class="col-md-12 mt-5 mb-5 row">
	@foreach($all_product_info as $key=>$v_product)
		<div class="col-md-3  text-center row">
			<img src="{{URL::to($v_product->products_image1)}}" alt="{{$v_product->products_name}}" class="img-fulid">
			<div class="col-md-12 text-center">
			<h5 class="card-title">{{$v_product->products_name_arabic}}</h5>
			<p class="card-text">{{$v_product->products_short_description_arabic}}</p>
			<a href="{{URL::to('/view_product/'.$v_product->products_id)}}"  class="btn btn-outline-light bg-standerd"><i class="fas fa-cart-plus"></i>اضف لسلة</a>
			</div>
		</div>
	@endforeach
</div>
@include('pages.inc.ar.footer')
@else

@include('pages.inc.en.head')
@include('pages.inc.en.header')
<section class="slider container">
	<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
	@foreach($all_slider_info as $key=>$v_slider)
      <li data-target="#carouselExampleCaptions" data-slide-to="{{$v_slider->sider_id}}" 
	  class= <?php if($key == 0){echo 'active';}?>></li>
	  @endforeach
    </ol>
	<div class="carousel-inner">
	@foreach($all_slider_info as $key=>$v_slider)
   
      <div class="carousel-item <?php if($key == 0){echo 'active';}?>">
        <img src="{{URL::to($v_slider->slider_image)}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>{{$v_slider->slider_name}}</h5>
          <p>{{$v_slider->slider_description}}</p>
        </div>
      </div>
	  @endforeach
      
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</section>

<div class="col-md-12 mt-5 mb-5 row">
	@foreach($all_product_info as $key=>$v_product)
		<div class="col-md-3  text-center row">
			<img src="{{URL::to($v_product->products_image1)}}" alt="{{$v_product->products_name}}" class="img-fulid">
			<div class="col-md-12 text-center">
			<h5 class="card-title">{{$v_product->products_name}}</h5>
			<p class="card-text">{{$v_product->products_short_description}}</p>
			<a href="{{URL::to('/view_product/'.$v_product->products_id.'/en')}}" class="btn btn-outline-light bg-standerd"><i class="fas fa-cart-plus"></i> Add to Cart</a>
			</div>
		</div>
	@endforeach
</div>
@include('pages.inc.en.footer')
@endif


