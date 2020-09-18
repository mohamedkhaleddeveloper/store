@if($lang == 'ar')
@include('pages.inc.ar.head')
@include('pages.inc.ar.header')

<div class="col-md-12 mt-5 mb-5 text-center">
	<div class="row">
		<div class="col-md-6 mt-5 mb-5">
			<h1>شكرا تم تفعيل طلبك بنجاح</h1>
		</div>
		<div class="col-md-2">
			<h2 class="or">و</h2>
		</div>
		<div class="col-md-4 mt-5 mb-5">
				<h2>سنتواصل مع قريبا جدا</h2>
		</div>
	</div>
</div>
			
			
	

	@include('pages.inc.ar.footer')
@else
@include('pages.inc.en.head')
@include('pages.inc.en.header')


<div class="col-md-12 mt-5 mb-5 text-center">
	<div class="row">
		<div class="col-md-6 mt-5 mb-5">
			<h1>Thanks For Order</h1>
		</div>
		<div class="col-md-2">
			<h2 class="or">و</h2>
		</div>
		<div class="col-md-4 mt-5 mb-5">
				<h2>We will Contact As Soon as Possibble</h2>
		</div>
	</div>
</div>
	
@include('pages.inc.en.footer')
@endif