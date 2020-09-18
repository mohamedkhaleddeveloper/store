<body>
  <header>
		<section class="bg-standerd container-fulid">
		<div class="row mx-auto">
			<div class="col-md-3 col-3">
				<div class="logo ">
					<img src="{{asset('frontend/newstyle/img/header/logo.png')}}"class="img-fluid"/>
				</div>
			</div>
			<div class="strip  col-md-4 col-6">
				<div class="input-group">
					<input type="text" class="form-control radius" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
					<div class="input-group-append">
						<button class="btn btn-outline-light radius" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</div>
			<div class="col-md-5  col-3 socailtools float-right">
				<ul>
        <li><a href="#"><i class="fab fa-facebook-square fa-2x"></i></a></li>
					<li><a href="#"><i class="fab fa-instagram fa-2x"></i></a></li>
					<li><a href="#"><i class="fas fa-envelope-square fa-2x"></i></a></li>
					<li><a href="/en">EN</a></li>
            <?php
              $customer_id = Session::get('customer_id');
              $shipping_id = Session::get('shipping_id');    
              if($customer_id != null && $shipping_id == null){
              ?>
                <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> الدفع</a></li>
              <?php }elseif($customer_id != null && $shipping_id != null){?>
                <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> الدفع</a></li>
              <?php }else{?>
                <li><a href="{{URL::to('/login-check')}}"><i class="fa fa-crosshairs"></i> الدفع</a></li>
              <?php } ?>
            
            <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> كارت</a></li>
            <?php
              $customer_id = Session::get('customer_id');  
              if($customer_id != null){
            ?>
								<li><a href="{{URL::to('/customer-logout')}}"><i class="fa fa-lock"></i> تسجيل خروج</a></li>
								<?php }else{?>
									<li><a href="{{URL::to('/login-check')}}"><i class="fa fa-lock"></i> تسجيل دخول</a></li>
								<?php } ?>
				
				</ul>
			</div>
		</div>
		</section>
  </header>
  <nav class="navbar navbar-expand-lg navbar-light bg-nav">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">الرئيسية <span class="sr-only">(current)</span></a>
      </li>
      @foreach($all_catgeory_info as $key=>$v_category)
      @if($v_category->category_parent == 0)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$v_category->category_name_arabic}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($all_catgeory_info as $key=>$v_subcategory)
                @if($v_subcategory->category_parent == $v_category->category_id)
                <a class="dropdown-item" href="/{{$v_subcategory->category_id}}/{{$v_subcategory->category_name_arabic}}">{{$v_subcategory->category_name_arabic}}</a>
                @endif
                @endforeach
            </div>
        </li>
      @endif
      @endforeach
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                الماركات
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($all_brand_info as $key=>$v_brand)
                <a class="dropdown-item" href="/{{$v_brand->brand_id}}/{{$v_brand->brand_name_arabic}}">{{$v_brand->brand_name_arabic}}</a>
                @endforeach
            </div>
        </li>
	  <li class="nav-item">
        <a class="nav-link" href="#">اتصل بنا</a>
      </li>
    </ul>
  
  </div>
</nav>
