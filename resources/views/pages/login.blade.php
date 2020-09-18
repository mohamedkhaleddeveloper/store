@if($lang == 'ar')
@include('pages.inc.ar.head')
@include('pages.inc.ar.header')


<div class="col-md-12 mt-5 mb-5">
	<div class="row mt-5 ">
		<div class="col-md-5 ">
			<div class="col-md-10 col-sm-offset-1 mt-3">
				<div class="login-form"><!--login form-->
					<h3 class="mb-5 mt-5">تسجيل دخول</h3>
					<form action="{{url('/customer-login')}}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">البريد الالكتروني</label>
							<input type="hidden" name="lang" value="ar"/>
							<input id="exampleInputEmail1"  class="form-control" type="email" placeholder="البريد الالكتروني" name="customer_email" required="" />
							<small id="emailHelp" class="form-text text-muted">لا تعطي اي شخص البريد الالكتروني الخاص بك</small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمه المرور " name="password">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-outline-light bg-standerd float-right">دخول</button>
						</div>
					</form>
				</div><!--/login form-->
			</div>
		</div>
		<div class="col-md-2 mt-5  mt-5">
			<h2 class="or">أو</h2>
		</div>
		<div class="col-md-5 ">
			<div class="col-md-10 col-sm-offset-1 pt-5 mt-2 mb-4">
					<div class="signup-form"><!--sign up form-->
						<h3 class="mb-5  mt-5">New User Signup!</h3>
						<form action="{{url('/customer-registration')}}" method="post">
                        {{ csrf_field() }}
						<div class="form-group">
							<input id="exampleInputEmail1"  class="form-control" type="text" placeholder="الاسم بالكامل"  name="customer_name"  required="" />
							<small id="emailHelp" class="form-text text-muted">لا تعطي اي شخص البريد الالكتروني الخاص بك</small>
						</div>
						<div class="form-group">
							<input id="exampleInputEmail1"  class="form-control" type="email" placeholder="البريد الألكتروني" name="customer_email" required="" />
						</div>
						<div class="form-group">
							<input id="exampleInputEmail1"  class="form-control" type="text" placeholder="رقم التليفون المحمول" name="mobile_number" required="" />
						</div>
						<div class="form-group">
							<input id="exampleInputEmail1"  class="form-control" type="text" placeholder="كلمه المرور" name="password" required="" />					
						</div>
							<button type="submit" class="btn btn-outline-light bg-standerd float-right">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
				</div>
                </div>
		</div>
	</div>
</div><!--/form-->
@include('pages.inc.ar.footer')
@else
@include('pages.inc.en.head')
@include('pages.inc.en.header')

<div class="col-md-12 mt-5 mb-5">
	<div class="row mt-5 ">
		<div class="col-md-5 ">
			<div class="col-md-10 col-sm-offset-1 mt-3">
				<div class="login-form"><!--login form-->
					<h3 class="mb-5 mt-5">Login to your account</h3>
					<form action="{{url('/customer-login')}}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<input type="hidden" name="lang" value="en"/>
							<input id="exampleInputEmail1"  class="form-control" type="email" placeholder="Email Address" name="customer_email" required="" />
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-outline-light bg-standerd float-right">Login</button>
						</div>
					</form>
				</div><!--/login form-->
			</div>
		</div>
		<div class="col-md-2 mt-5  mt-5">
			<h2 class="or">OR</h2>
		</div>
		<div class="col-md-5 ">
			<div class="col-md-10 col-sm-offset-1 pt-5 mt-2 mb-4">
					<div class="signup-form"><!--sign up form-->
						<h3 class="mb-5  mt-5">New User Signup!</h3>
						<form action="{{url('/customer-registration')}}" method="post">
                        {{ csrf_field() }}
						<div class="form-group">
							<input type="hidden" name="lang" value="en"/>
							<input id="exampleInputEmail1"  class="form-control" type="text" placeholder="Full Name"  name="customer_name"  required="" />
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<input id="exampleInputEmail1"  class="form-control" type="email" placeholder="Email Address" name="customer_email" required="" />
						</div>
						<div class="form-group">
							<input id="exampleInputEmail1"  class="form-control" type="text" placeholder="Mobile Number" name="mobile_number" required="" />
						</div>
						<div class="form-group">
							<input id="exampleInputEmail1"  class="form-control" type="text" placeholder="Password" name="password" required="" />					
						</div>
							<button type="submit" class="btn btn-outline-light bg-standerd float-right">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
				</div>
                </div>
		</div>
	</div>
</div><!--/form-->
@include('pages.inc.en.footer')
@endif