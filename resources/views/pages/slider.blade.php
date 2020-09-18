	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
						<?php
								$all_published_slider= DB::table('tbl_slider')
								->get();
								foreach($all_published_slider as $key => $v_slider){
							?>
							
							<li data-target="#slider-carousel" data-slide-to="<?php echo $key.'"'; if( $key ==0){echo 'class="active"';} ?>></li>
							<?php } ?>
							
						</ol>
						
						<div class="carousel-inner">
							<?php
								$all_published_slider= DB::table('tbl_slider')
								->get();
								foreach($all_published_slider as $key => $v_slider){
							?>
							<div class="item <?php if($key == 0){echo 'active';}?>">
								<div class="col-sm-6">
									<h1><span>Al</span>Sahar Store</h1>
									<h2>{{$v_slider->slider_name}}</h2>
									<p>{{$v_slider->slider_description}}</p>
									<a href="{{$v_slider->slider_link}}" class="btn btn-default get">Get it now</a>
								</div>
								<div class="col-sm-6">
									<img src="{{URL::to($v_slider->slider_image)}}" class="girl img-responsive" alt="" />
									<!--<img src="{{asset('frontend/images/home/pricing.png')}}"  class="pricing" alt="" />-->
								</div>
								
							</div>
							<?php } ?>
								
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->