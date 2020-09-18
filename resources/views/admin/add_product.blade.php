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
					<a href="#">ADD Product</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>ADD Product</h2>
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
						<form class="form-horizontal" method="POST" action="{{url('/save-product')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
						  <fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="product_name" />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="date01">Product Name Arabice</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="product_name_arabic" />
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError3">Product Category</label>
								<div class="controls">
								<select id="selectError3" name="category_id">
									<option value=0 selected>Select Category</option>
									<?php
										$all_published_category= DB::table('tbl_category')
										->where('publication_status',1)
										->get();
										foreach($all_published_category as $v_category){
									?>
										<option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
									<?php } ?>	
								</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError3">Manufacture name</label>
								<div class="controls">
								<select id="selectError3"  name="manufacture_id">
								<option value=0 selected>Select Manufacture</option>
								<?php
								$all_published_manufacture= DB::table('manufacture')
								->where('publication_status',1)
								->get();
								foreach($all_published_manufacture as $v_manufacture){
								?>
									<option id="category_id" value="{{$v_manufacture->manufacture_id}}">{{$v_manufacture->manufacture_name}}</option>
								<?php } ?>
								</select>
								</div>
							</div>          
							<div class="control-group hidden-phone">
								<label class="control-label" for="textarea2">Product Short Description</label>
								<div class="controls">
									<textarea class="cleditor" name="product_short_description" rows="3"></textarea>
								</div>
							</div>
							<div class="control-group hidden-phone">
								<label class="control-label" for="textarea2">Product Short Description Arabic</label>
								<div class="controls">
									<textarea class="cleditor" name="product_short_description_arabic" rows="3"></textarea>
								</div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Long Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_long_description" rows="3"></textarea>
								</div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Long Description Arabic</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_long_description_arabic" rows="3"></textarea>
								</div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="product_price" />
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">image</label>
							  <div class="controls">
								<input type="file" class="input-xlarge " name="product_image" />
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Product size</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="product_size" />
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Color</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="product_color" />
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Puplication  status</label>
							  <div class="controls">
								<input type="checkbox"  name="publication_status" value="1"/>
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">ADD Product</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection