
@if($lang == 'ar')
@include('pages.inc.ar.head')
@include('pages.inc.ar.header')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumb">
				<ol class="breadcrumb">
				  <li><a href="#">الرئيسية</a></li>
				  <li class="active pl-5">كارت المشتريات</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
					$content=Cart::content();
				
					if(Cart::count() == 0){
							
					?>
					<h1 class="text-center">لا يوجد كارت مشتريات</h1>
								</section> <!--/#cart_items-->
								</div>
		</div>
							
					<?php }else { ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">صورة الصنف</td>
							<td class="description">اسم الصنف</td>
							<td class="price">السعر</td>
							<td class="quantity">الكميه</td>
							<td class="">الاجمالي</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?PHP foreach($content as $v_content){ ?>
						<tr>
							<td class="cart_product">
							
								<a href=""><img src="{{URL::to($v_content->options->image)}}" width="150" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="{{$v_content->id}}">{{$v_content->options->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{$v_content->price}} جنيها مصريا</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{url('/update-cart')}}" method="post">
									<div class="col-md-12 row">
									{{ csrf_field() }}
									<div class="col-md-6">
										<input type="number" class="form-control"  value="{{$v_content->qty}}" name="qty"  min="0" max="100"/>
										</div>
										<div class="col-md-6">
										<input type="hidden" name="lang" value="ar"/>
										<input type="hidden" name="rowId" value="{{$v_content->rowId}}" />
										<input  type="submit" name="submit" class="btn btn btn-outline-light bg-standerd" value="تحديث" />
										</div>
										
										</div>	
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$v_content->subtotal}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?PHP } ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>ماذا تود بعد ذلك</h3>
				<p>اختر ما بين عروضنا افضل الخصومات</p>
			</div>
			<div class="row">
	
				<div class="col-md-12">
					<div class="total_area">
						<ul>
							<li>اجمال الكارت <span>{{$v_content->subtotal}}</span></li>
							<li>الضرائب  <span>{{$v_content->tax}}2</span></li>
							<li>الكارت <span>مجاني</span></li>
							<li>الاجمالي <span>{{$v_content->total}}</span></li>
						</ul>
						
						<div class=" text-right">
							<a class="btn btn-outline-light bg-standerd update" href="">تحديث</a>

							<?php
									$customer_id = Session::get('customer_id');  
									if($customer_id != null){
								?>
								<a class="btn btn-outline-light bg-standerd check_out" href="{{URL::to('/checkout')}}">تابع عملية الشراء</a>
								<?php }else{?>
									<a class="btn btn-outline-light bg-standerd check_out" href="{{URL::to('/login-check')}}">تابع عملية الشراء</a>
								<?php } ?>
								</div>
								</div>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<?php } ?>

@include('pages.inc.ar.footer')
@else
@include('pages.inc.en.head')
@include('pages.inc.en.header')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
					$content=Cart::content();
				
					if(Cart::count() == 0){
							
					?>
					<h1 class="text-center">No New Carts</h1>
								</section> <!--/#cart_items-->
								</div>
		</div>
							
					<?php }else { ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Product Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?PHP foreach($content as $v_content){ ?>
						<tr>
							<td class="cart_product">
							
								<a href=""><img src="{{URL::to($v_content->options->image)}}" width="150" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="{{$v_content->id}}">{{$v_content->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{$v_content->price}} EGP</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{url('/update-cart')}}" method="post">
									<div class="col-md-12 row">
									{{ csrf_field() }}
									<div class="col-md-6">
										<input type="number" class="form-control"  value="{{$v_content->qty}}" name="qty"  min="0" max="100"/>
										</div>
										<div class="col-md-6">
										<input type="hidden" name="lang" value="en"/>
										<input type="hidden" name="rowId" value="{{$v_content->rowId}}" />
										<input  type="submit" name="submit" class="btn btn btn-outline-light bg-standerd" value="update" />
										</div>
										
										</div>	
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$v_content->subtotal}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId.'/en')}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?PHP } ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
	
				<div class="col-md-12">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{$v_content->subtotal}}</span></li>
							<li>Eco Tax <span>{{$v_content->tax}}2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{$v_content->total}}</span></li>
						</ul>
						
						<div class=" text-right">
							<a class="btn btn-outline-light bg-standerd update" href="">Update</a>

							<?php
									$customer_id = Session::get('customer_id');  
									if($customer_id != null){
								?>
								<a class="btn btn-outline-light bg-standerd check_out" href="{{URL::to('/checkout/en')}}">Check Out</a>
								<?php }else{?>
									<a class="btn btn-outline-light bg-standerd check_out" href="{{URL::to('/login-check/en')}}">Check Out</a>
								<?php } ?>
								</div>
								</div>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<?php } ?>

	@include('pages.inc.en.footer')
	@endif