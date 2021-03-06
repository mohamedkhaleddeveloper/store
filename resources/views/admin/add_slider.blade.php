@extends('admin_layout')
@section('admin_content')


<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="{{URL::to('/dashboard')}}">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">ADD Slider</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>ADD Slider</h2>
                    </div>
                    <p class="alert-success">
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo $message;
                                Session::put('message', null);
                            } 
                        ?>
										</p>
										<p class="alert-danger">
                        <?php
                            $error = Session::get('error');
                            if($error){
                                echo $error;
                                Session::put('error', null);
                            } 
                        ?>
                    </p>
					<div class="box-content">
						<form class="form-horizontal" method="POST" action="{{url('/save-slider')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
						  <fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Slider Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="slider_name" />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="date01">Product Name Arabice</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="slider_name_arabic" />
							  </div>
							</div>
							
							   
							<div class="control-group hidden-phone">
								<label class="control-label" for="textarea2">Slider Description</label>
								<div class="controls">
									<textarea class="cleditor" name="slider_description" rows="3"></textarea>
								</div>
							</div>
							

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Slider Description Arabic</label>
							  <div class="controls">
								<textarea class="cleditor" name="slider_description_arabic" rows="3"></textarea>
								</div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Slider Link Product</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="slider_link" />
								</div>
							</div>

						

							<div class="control-group">
							  <label class="control-label" for="date01">image</label>
							  <div class="controls">
								<input type="file" class="input-xlarge " name="slider_image" />
							  </div>
							</div>

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">ADD Slider</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection