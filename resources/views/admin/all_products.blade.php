@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Categories</a></li>
            </ul>
            <p class="alert-success">
            <?php
                $message = Session::get('message');
                if($message){
                    echo $message;
                    Session::put('message', null);
                } 
            ?>
            </p>
			<div class="row-fluid sortable ">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Categories</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content table-responsive">
						<table class="table table-striped table-bordered bootstrap-datatable datatable table-responsive">
						  <thead>
							  <tr>
								  <th>Product ID</th>
								  <th>Product Name</th>
								  <th>Product name Arabice</th>
								  <th>Image Product</th>
								  <th>Product Price</th>
								  <th>category Name</th>
								  <th>manufacture Name</th>
                                  <th>status</th>
                                  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                              @foreach($all_product_info as $v_product)
							<tr>
								<td>{{$v_product->products_id}}</td>
								<td class="center">{{$v_product->products_name}}</td>
                                <td class="center">{{$v_product->products_name_arabic}}</td>
								<td class="center"><img src="{{$v_product->products_image}}" width="150" /></td>
								<td class="center">{{$v_product->products_price}}</td>
								<td class="center">{{$v_product->category_name}}</td>
								<td class="center">{{$v_product->manufacture_name}}</td>
								<td class="center">
                                    @if($v_product->publication_status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-danger">Un Active</span>
                                    @endif
									
								</td>
								<td class="center">
									
                                @if($v_product->publication_status == 1)
									<a class="btn btn-danger" href="{{URL::to('/unactive_product/'.$v_product->products_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
                                    </a>
                                @else
									<a class="btn btn-success" href="{{URL::to('/active_product/'.$v_product->products_id)}}">
										<i class="halflings-icon white  thumbs-up"></i>  
                                    </a>
                                @endif
                                    <a class="btn btn-info" href="{{URL::to('/edit-product/'.$v_product->products_id)}}">
										<i class="halflings-icon white edit"></i>  
                                    </a>
									<a class="btn btn-danger" href="{{URL::to('/delete-product/'.$v_product->products_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
                            @endforeach
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection