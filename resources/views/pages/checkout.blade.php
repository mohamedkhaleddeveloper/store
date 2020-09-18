@if($lang == 'ar')
@include('pages.inc.ar.head')
@include('pages.inc.ar.header')

<div id="cart_items" class="col-md-12 mt-5 mb-5">
		<div class="container">
                
			<h3 class="register-req">
				<p>املئ الاستمارة من فضلك</p>
			</h3><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-md-10 clearfix mb-5 mt-2">
						<div class="bill-to">
							<p>الشحن لــ</p>
							<div class="form-one">
								<form action="{{url('/save-shiping-details')}}" method="post">
								{{ csrf_field() }}
								<div class="form-group">
									<input type="email" class="form-control" name="shipping_email" placeholder="البريد الالكتروني*" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_First_name" placeholder="الاسم الاول*" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_last_name" placeholder="الاسم الاخير*" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_address" placeholder="العنوان*" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_mobile_number" placeholder="رقم التليفون المحمول*" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="shipping_city" placeholder="الحي*" required>
								</div>
                                    <input type="submit" class="btn btn-outline-light bg-standerd float-right" placeholder="City *" value="أرسل">
								</form>
							</div>
							
						</div>
					</div>			
				</div>
			</div>

			
		</div>
</div> <!--/#cart_items-->

@include('pages.inc.ar.footer')
@else
@include('pages.inc.en.head')
@include('pages.inc.en.header')

<div id="cart_items" class="col-md-12 mt-5 mb-3">
		<div class="container">
                
			<h3 class="register-req">
				<p>pleas fill up This form</p>
			</h3><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-md-10 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{url('/save-shiping-details')}}" method="post">
								{{ csrf_field() }}
								<div class="form-group">
									<input type="email" class="form-control" name="shipping_email" placeholder="E_mail">
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_First_name" placeholder="First Name *">
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_last_name" placeholder="Last Name *">
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_address" placeholder="Address *">
								</div>
								<div class="form-group">
									<input type="text" class="form-control"  name="shipping_mobile_number" placeholder="Mobile Number *">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="shipping_city" placeholder="City *">
								</div>
                                    <input type="submit" class="btn btn-outline-light bg-standerd float-right" placeholder="City *" value="Done">
								</form>
							</div>
							
						</div>
					</div>			
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				
			</div>
			
		</div>
</div> <!--/#cart_items-->

@include('pages.inc.en.footer')
@endif