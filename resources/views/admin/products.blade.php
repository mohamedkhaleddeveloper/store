@if($lang == "ar")
@include('admin.inc.ar.head')
@include('admin.inc.ar.header')
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>

    <div class="app-content">
      <div class="content-wrapper pad0">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">متجر الأزهري</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                  </li>
                  <li class="breadcrumb-item active">الأصناف
                  </li>
                </ol>
              </div>
            </div>
          </div>
          
        </div>
        <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">الصنف</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
					<div class="col-md-12">
						<button class="btn btn-dark btn-lg mt-2 mb- float-right addtion-products" >إضافه</button>
					</div>
                </div>
				<!--------------------------------------------- table --------------------------------------------------->
                <div class="card-content collapse show" id="products-table">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration" id="tabledatap">
                            <thead>
                                <tr>
									<th>#</th>
                                    <th>الاسم</th>
                                    <th>العمليات</th>
									<th>الصور</th>
                                </tr>
                            </thead>
                            <tbody>
							@foreach($all_products_info as $key=>$v_products)
                                <tr id="{{$v_products->products_id}}">
								<td>{{$key+1}}</td>
                                    <td>{{$v_products->products_name_arabic}}</td>
                                    <td>
										<span>
										@if ($v_products->products_publication == 1)
											<a class="btn btn-green btn-sm  mr-1 mb-1 white mg active-products" active-id="{{$v_products->products_id}}"
											data-link="{{URL::to('/active_products/'.$v_products->products_id)}}">
												<i class="icon-like"></i></i>
											</a>
										@else
											<a class="btn btn-danger btn-sm  mr-1 mb-1 white mg active-products" active-id="{{$v_products->products_id}}"
											data-link="{{URL::to('/active_products/'.$v_products->products_id)}}">
												<i class="icon-dislike"></i></i>
											</a>
										@endif
											<a class="btn btn-info btn-sm mr-1 mb-1 edite-products-btn" data-link="{{URL::to('/edit-products/'.$v_products->products_id)}}">
											<i class="icon-pencil"></i>
											</a>
											<a class="btn btn-danger btn-sm mr-1 mb-1 remove-products-btn" data-link="{{URL::to('/delete-products/'.$v_products->products_id)}}" 
											data-name="{{$v_products->products_name_arabic}}" data-id="{{$v_products->products_id}}">
											<i class="icon-trash"></i>
											</a>
										</span>
									</td>
									<td class="center">
										<img src="/{{$v_products->products_image1}}" width="50"/>
										<img src="/{{$v_products->products_image2}}" width="50"/>
										<img src="/{{$v_products->products_image3}}" width="50"/>
										<img src="/{{$v_products->products_image4}}" width="50"/>
									</td>
                                </tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
				<!------------------------------------------ end table ----------------------------------------------->
				
				<!------------------------------------------ Addtion products ---------------------------------------->
					<div class="card-content collapse show hide addtion-products-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right addtion-products-close"><i class="icon-close"></i></button>
							<h1> إضافه صنف جديد</h1>
						</div>
						<div id="error_msg"></div>
						<form class="form" id="add-products" action="{{url('/save-product')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">الاسم باللغه العربيه </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="ar">
											<input type="text" id="eventInput1" class="form-control" name="product_name_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput2">الأسم باللغه الانجليزيه</label>
											<input type="text" id="eventInput2" class="form-control" name="product_name">
										</div>
										<div class="form-group">
											<select id="category_id" class="form-control" name="category_parent"  data-link="{{URL::to('/getsubcategory/')}}">
												<option value="0">المجموعه الرئيسية</option>
												@foreach($all_category_info as $v_category){	
												<option value="{{$v_category->category_id}}">{{$v_category->category_name_arabic}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group" id="subcategory"></div>

										<div class="form-group">
											<select class="form-control" name="company_id">
												<option value="0">اختر  المورد</option>
												@foreach($all_company_info as $v_company){	
												<option value="{{$v_company->company_id}}">{{$v_company->company_name_arabic}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<select class="form-control" name="brand_id">
												<option value="0">اختر  الماركة</option>
												@foreach($all_brand_info as $v_brand){	
												<option value="{{$v_brand->brand_id}}">{{$v_brand->brand_name_arabic}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="eventInput3">وصف قصير  باللغه العربيه</label>
											<textarea class="form-control" name="product_short_description_arabic"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput4">وصف قصير باللغه الانجليزيه</label>
											<textarea class="form-control" name="product_short_description"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput3">وصف طويل  باللغه العربيه</label>
											<textarea  class="form-control" name="product_long_description_arabic"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput4">وصف طويل باللغه الانجليزيه</label>
											<textarea class="form-control" name="product_long_description"></textarea>
										</div>

										<div class="form-group">
											<label>سعر المنتج</label>
											<input type="text" class="form-control " name="product_price" />
										</div>

										<div class="form-group">
											<label>سعر المنتج بالجمله</label>
											<input type="text" class="form-control " name="product_priceg" />
										</div>

										<div class="form-group">
											<label>صور المنتج</label>
											<div class="col-md-12 row">
												<input type="file" class="form-control col-md-3 mr-1" name="product_image1" />
												<input type="file" class="form-control col-md-3 mr-1" name="product_image2" />
												<input type="file" class="form-control col-md-3 mr-1" name="product_image3" />
												<input type="file" class="form-control col-md-2 mr-1" name="product_image4" />
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-actions right">
								<button type="submit" class="btn btn-dark" id="save">
									<i class="fa fa-check-square-o"></i> أضف
								</button>
								<button type="reset" class="btn btn-danger mr-1">
									<i class="ft-x"></i> إالغاء
								</button>
							</div>
						</form>	

					</div>
				</div>
				<!------------------------------------------ end Addtion Category ------------------------------------>
				
				
				<!------------------------------------------ Edite Category ---------------------------------------->
					<div class="card-content collapse show hide edite-products-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right edite-products-close"><i class="icon-close"></i></button>
							<h1> تعديل ماركه</h1>
						</div>
						<div id="error_msg_ed"></div>
						<form class="form" id="edite-products" action="{{url('/update-products')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">الاسم باللغه العربيه </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="ar">
											<input type="hidden" id="eventInput1" class="form-control" name="products_id">
											
											<input type="text" id="eventInput1" class="form-control" name="products_name_arabic">
										</div>

										<div class="form-group" >
											<label for="eventInput2">الأسم باللغه الانجليزيه</label>
											<input type="text" id="eventInput2" class="form-control" name="products_name">
										</div>
										<div class="form-group">
											<select id="category_edite_id" class="form-control" name="category_edite"  data-link="{{URL::to('/getsubcategory/')}}">
												<option value="0">المجموعه الرئيسية</option>
												@foreach($all_category_info as $v_category){	
												<option value="{{$v_category->category_id}}">{{$v_category->category_name_arabic}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group" id="subcategoryedite"></div>

										<div class="form-group">
											<select class="form-control" name="company_id">
												<option value="0">اختر  المورد</option>
												@foreach($all_company_info as $v_company){	
												<option value="{{$v_company->company_id}}">{{$v_company->company_name_arabic}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<select class="form-control" name="brand_id">
												<option value="0">اختر  الماركة</option>
												@foreach($all_brand_info as $v_brand){	
												<option value="{{$v_brand->brand_id}}">{{$v_brand->brand_name_arabic}}</option>
												@endforeach
											</select>
										</div>
										
										<div class="form-group">
											<label for="eventInput3">وصف قصير  باللغه العربيه</label>
											<textarea class="form-control" name="products_short_description_arabic"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput4">وصف قصير باللغه الانجليزيه</label>
											<textarea class="form-control" name="products_short_description"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput3">وصف طويل  باللغه العربيه</label>
											<textarea  class="form-control" name="products_long_description_arabic"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput4">وصف طويل باللغه الانجليزيه</label>
											<textarea class="form-control" name="products_long_description"></textarea>
										</div>

										<div class="form-group">
											<label>سعر المنتج</label>
											<input type="text" class="form-control " name="products_price" />
										</div>

										<div class="form-group">
											<label>سعر المنتج بالجمله</label>
											<input type="text" class="form-control " name="products_priceg" />
										</div>

										<div class="form-group">
											<label>صور المنتج</label>
											<div class="col-md-12 row">
												<input type="file" class="form-control col-md-3 mr-1" name="products_image1" />
												<input type="file" class="form-control col-md-3 mr-1" name="products_image2" />
												<input type="file" class="form-control col-md-3 mr-1" name="products_image3" />
												<input type="file" class="form-control col-md-2 mr-1" name="products_image4" />
											</div>
										</div>
										<input type="text" name="products_publication">
									
									</div>
								</div>
							</div>

							<div class="form-actions right">
								<button type="submit" class="btn btn-dark" id="update">
									<i class="fa fa-check-square-o"></i> تحديث
								</button>
							
							</div>
						</form>	

					</div>
				</div>
				<!------------------------------------------ end Edite products ------------------------------------>
				
				<!------------------------------------------ Edite products ---------------------------------------->
					<div class="card-content collapse show hide delete-products-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right delete-products-close"><i class="icon-close"></i></button>
							<h1 id="name"> هل انت متأكد من مسح الماركه </h1>
						</div>
						<div id="error_msg_down"></div>
						<form class="form" id="delete-products" action="{{url('/delete-products')}}">
						{{ csrf_field() }}
									
							<div class="form-actions right">
							<input type="hidden"   name="lang" value="ar">
							<input type="hidden"   name="products_id">
								<button type="submit" class="btn btn-success" id="remove">
									<i class="fa fa-check-square-o"></i> نعم
								</button>
								<button type="button" class="btn btn-danger mr-1 delete-products-close">
									<i class="ft-x"></i> لا
								</button>
							</div>
						</form>	

					</div>
				</div>
				<!------------------------------------------ end Edite products ------------------------------------>
				
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->
    </div></div></div></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

  </div>
@else
@include('admin.inc.en.head')
@include('admin.inc.en.header')
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>

    <div class="app-content">
      <div class="content-wrapper pad0">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Azhary Store</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">productss
                  </li>
                </ol>
              </div>
            </div>
          </div>
          
        </div>
        <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">productss</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
					<div class="col-md-12">
						<button class="btn btn-dark btn-lg mt-2 mb- float-right addtion-products" >ADD</button>
					</div>
                </div>
				<!--------------------------------------------- table --------------------------------------------------->
                <div class="card-content collapse show" id="products-table">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration" id="tabledatap">
                            <thead>
                                <tr>
									<th>#</th>
                                    <th>Name</th>
                                    <th>Opreation</th>
									<th>Images</th>
                                </tr>
                            </thead>
                            <tbody>
							@foreach($all_products_info as $key=>$v_products)
                                <tr id="{{$v_products->products_id}}">
								<td>{{$key+1}}</td>
                                    <td>{{$v_products->products_name}}</td>
                                    <td>
										<span>
										@if ($v_products->products_publication == 1)
											<a class="btn btn-green btn-sm  mr-1 mb-1 white mg active-products" active-id="{{$v_products->products_id}}"
											data-link="{{URL::to('/active_products/'.$v_products->products_id)}}">
												<i class="icon-like"></i></i>
											</a>
										@else
											<a class="btn btn-danger btn-sm  mr-1 mb-1 white mg active-products" active-id="{{$v_products->products_id}}"
											data-link="{{URL::to('/active_products/'.$v_products->products_id)}}">
												<i class="icon-dislike"></i></i>
											</a>
										@endif
											<a class="btn btn-info btn-sm mr-1 mb-1 edite-products-btn" data-link="{{URL::to('/edit-products/'.$v_products->products_id)}}">
											<i class="icon-pencil"></i>
											</a>
											<a class="btn btn-danger btn-sm mr-1 mb-1 remove-products-btn" data-link="{{URL::to('/delete-products/'.$v_products->products_id)}}" 
											data-name="{{$v_products->products_name}}" data-id="{{$v_products->products_id}}">
											<i class="icon-trash"></i>
											</a>
										</span>
									</td>
									<td class="center">
										<img src="/{{$v_products->products_image1}}" width="50"/>
										<img src="/{{$v_products->products_image2}}" width="50"/>
										<img src="/{{$v_products->products_image3}}" width="50"/>
										<img src="/{{$v_products->products_image4}}" width="50"/>
									</td>
                                </tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
				<!------------------------------------------ end table ----------------------------------------------->
				
				<!------------------------------------------ Addtion Category ---------------------------------------->
					<div class="card-content collapse show hide addtion-products-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right addtion-products-close"><i class="icon-close"></i></button>
							<h1> Addtion New</h1>
						</div>
						<div id="error_msg"></div>
						<form class="form" id="add-products" action="{{url('/save-product')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">Arabic Name </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="en">
											<input type="text" id="eventInput1" class="form-control" name="product_name_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput2">English name</label>
											<input type="text" id="eventInput2" class="form-control" name="product_name">
										</div>
										<div class="form-group">
											<select id="category_id" class="form-control" name="category_parent"  data-link="{{URL::to('/getsubcategory/')}}">
												<option value="0">Main Group</option>
												@foreach($all_category_info as $v_category){	
												<option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group" id="subcategory"></div>

										<div class="form-group">
											<select class="form-control" name="company_id">
												<option value="0">Choose Company</option>
												@foreach($all_company_info as $v_company){	
												<option value="{{$v_company->company_id}}">{{$v_company->company_name}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<select class="form-control" name="brand_id">
												<option value="0">Choose Brand</option>
												@foreach($all_brand_info as $v_brand){	
												<option value="{{$v_brand->brand_id}}">{{$v_brand->brand_name}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="eventInput3">Short Arabic description</label>
											<textarea class="form-control" name="product_short_description_arabic"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput4">Short English description</label>
											<textarea class="form-control" name="product_short_description"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput3">Arabic description</label>
											<textarea  class="form-control" name="product_long_description_arabic"></textarea>
										</div>

										<div class="form-group">
											<label for="eventInput4">English description</label>
											<textarea class="form-control" name="product_long_description"></textarea>
										</div>

										<div class="form-group">
											<label>Price</label>
											<input type="text" class="form-control " name="product_price" />
										</div>

										<div class="form-group">
											<label>Wholesale price</label>
											<input type="text" class="form-control " name="product_priceg" />
										</div>

										<div class="form-group">
											<label>Images </label>
											<div class="col-md-12 row">
												<input type="file" class="form-control col-md-3 mr-1" name="product_image1" />
												<input type="file" class="form-control col-md-3 mr-1" name="product_image2" />
												<input type="file" class="form-control col-md-3 mr-1" name="product_image3" />
												<input type="file" class="form-control col-md-2 mr-1" name="product_image4" />
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-actions right">
								<button type="submit" class="btn btn-dark" id="save">
									<i class="fa fa-check-square-o"></i> ADD
								</button>
								<button type="reset" class="btn btn-danger mr-1">
									<i class="ft-x"></i> Reset
								</button>
							</div>
						</form>	

					</div>
				</div>
				<!------------------------------------------ end Addtion Category ------------------------------------>
				
				
				<!------------------------------------------ Edite Category ---------------------------------------->
					<div class="card-content collapse show hide edite-products-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right edite-products-close"><i class="icon-close"></i></button>
							<h1>Update Info</h1>
						</div>
						<div id="error_msg_ed"></div>
						<form class="form" id="edite-products" action="{{url('/update-products')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">Arabic Name </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="en">
											<input type="hidden" id="eventInput1" class="form-control" name="products_id">
											<input type="hidden" id="eventInput1" class="form-control" name="products_publication">
											<input type="text" id="eventInput1" class="form-control" name="products_name_arabic">
										</div>

										<div class="form-group" >
											<label for="eventInput2">English Name </label>
											<input type="text" id="eventInput2" class="form-control" name="products_name">
										</div>

										<div class="form-group">
											<label for="eventInput3">Arabic Description </label>
											<input type="text" id="eventInput3" class="form-control" name="products_description_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput4">English Description </label>
											<input type="text" id="eventInput4" class="form-control" name="products_description">
										</div>
									</div>
								</div>
							</div>

							<div class="form-actions right">
								<button type="submit" class="btn btn-dark" id="update">
									<i class="fa fa-check-square-o"></i> Update
								</button>
							
							</div>
						</form>	

					</div>
				</div>
				<!------------------------------------------ end Edite Category ------------------------------------>
				
				<!------------------------------------------ Edite Category ---------------------------------------->
					<div class="card-content collapse show hide delete-products-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right delete-products-close"><i class="icon-close"></i></button>
							<h1 id="name">Are You Sure for remove : </h1>
						</div>
						<div id="error_msg_down"></div>
						<form class="form" id="delete-products" action="{{url('/delete-products')}}">
						{{ csrf_field() }}
									
							<div class="form-actions right">
							<input type="hidden"   name="lang" value="en">
							<input type="hidden"   name="products_id">
								<button type="submit" class="btn btn-success" id="remove">
									<i class="fa fa-check-square-o"></i> Yes
								</button>
								<button type="button" class="btn btn-danger mr-1 delete-products-close">
									<i class="ft-x"></i> No
							</div>
						</form>	

					</div>
				</div>
				<!------------------------------------------ end Edite Category ------------------------------------>
				
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->
    </div></div></div></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

  </div>

@endif
	@include('admin.inc.footer')
