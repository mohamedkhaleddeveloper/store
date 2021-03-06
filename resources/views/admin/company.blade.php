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
                  <li class="breadcrumb-item active">المستوردين
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
                    <h4 class="card-title">المستورد</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
					<div class="col-md-12">
						<button class="btn btn-dark btn-lg mt-2 mb- float-right addtion-company" >إضافه</button>
					</div>
                </div>
				<!--------------------------------------------- table --------------------------------------------------->
                <div class="card-content collapse show" id="company-table">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration" id="tabledatac">
                            <thead>
                                <tr>
									<th>#</th>
                                    <th>الاسم</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
							@foreach($all_company_info as $key=>$v_company)
                                <tr id="{{$v_company->company_id}}">
								<td>{{$key+1}}</td>
                                    <td>{{$v_company->company_name_arabic}}</td>
                                    <td>
										<span>
										@if ($v_company->company_publication == 1)
											<a class="btn btn-green btn-sm  mr-1 mb-1 white mg active-company" active-id="{{$v_company->company_id}}"
											data-link="{{URL::to('/active_company/'.$v_company->company_id)}}">
												<i class="icon-like"></i></i>
											</a>
										@else
											<a class="btn btn-danger btn-sm  mr-1 mb-1 white mg active-company" active-id="{{$v_company->company_id}}"
											data-link="{{URL::to('/active_company/'.$v_company->company_id)}}">
												<i class="icon-dislike"></i></i>
											</a>
										@endif
											<a class="btn btn-info btn-sm mr-1 mb-1 edite-company-btn" data-link="{{URL::to('/edit-company/'.$v_company->company_id)}}">
											<i class="icon-pencil"></i>
											</a>
											<a class="btn btn-danger btn-sm mr-1 mb-1 remove-company-btn" data-link="{{URL::to('/delete-company/'.$v_company->company_id)}}" 
											data-name="{{$v_company->company_name_arabic}}" data-id="{{$v_company->company_id}}">
											<i class="icon-trash"></i>
											</a>
										</span>
									</td>
                                </tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
				<!------------------------------------------ end table ----------------------------------------------->
				
				<!------------------------------------------ Addtion Company ---------------------------------------->
					<div class="card-content collapse show hide addtion-company-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right addtion-company-close"><i class="icon-close"></i></button>
							<h1> إضافه قسم جديد</h1>
						</div>
						<div id="error_msg"></div>
						<form class="form" id="add-company" action="{{url('/save-company')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">الاسم باللغه العربيه </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="ar">
											<input type="text" id="eventInput1" class="form-control" name="company_name_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput2">الأسم باللغه الانجليزيه</label>
											<input type="text" id="eventInput2" class="form-control" name="company_name">
										</div>

										<div class="form-group">
											<label for="eventInput3">وصف الصنف باللغه العربيه</label>
											<input type="text" id="eventInput3" class="form-control" name="company_description_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput4">وصف صنف باللغه الانجليزيه</label>
											<input type="text" id="eventInput4" class="form-control" name="company_description">
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
					<div class="card-content collapse show hide edite-company-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right edite-company-close"><i class="icon-close"></i></button>
							<h1> تعديل قسم</h1>
						</div>
						<div id="error_msg_ed"></div>
						<form class="form" id="edite-company" action="{{url('/update-company')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">الاسم باللغه العربيه </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="ar">
											<input type="hidden" id="eventInput1" class="form-control" name="company_id">
											<input type="hidden" id="eventInput1" class="form-control" name="company_publication">
											<input type="text" id="eventInput1" class="form-control" name="company_name_arabic">
										</div>

										<div class="form-group" >
											<label for="eventInput2">الأسم باللغه الانجليزيه</label>
											<input type="text" id="eventInput2" class="form-control" name="company_name">
										</div>

										<div class="form-group">
											<label for="eventInput3">وصف الصنف باللغه العربيه</label>
											<input type="text" id="eventInput3" class="form-control" name="company_description_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput4">وصف صنف باللغه الانجليزيه</label>
											<input type="text" id="eventInput4" class="form-control" name="company_description">
										</div>
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
				<!------------------------------------------ end Edite Category ------------------------------------>
				
				<!------------------------------------------ Edite Category ---------------------------------------->
					<div class="card-content collapse show hide delete-company-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right delete-company-close"><i class="icon-close"></i></button>
							<h1 id="name"> هل انت متأكد من مسح مستورد </h1>
						</div>
						<div id="error_msg_down"></div>
						<form class="form" id="delete-company" action="{{url('/delete-company')}}">
						{{ csrf_field() }}
									
							<div class="form-actions right">
							<input type="hidden"   name="lang" value="ar">
							<input type="hidden"   name="company_id">
								<button type="submit" class="btn btn-success" id="remove">
									<i class="fa fa-check-square-o"></i> نعم
								</button>
								<button type="button" class="btn btn-danger mr-1 delete-category-close">
									<i class="ft-x"></i> لا
								</button>
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
                  <li class="breadcrumb-item active">companies
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
                    <h4 class="card-title">Companies</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
					<div class="col-md-12">
						<button class="btn btn-dark btn-lg mt-2 mb- float-right addtion-company" >ADD</button>
					</div>
                </div>
				<!--------------------------------------------- table --------------------------------------------------->
                <div class="card-content collapse show" id="company-table">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration" id="tabledatac">
                            <thead>
                                <tr>
									<th>#</th>
                                    <th>Name</th>
                                    <th>Opreation</th>
                                </tr>
                            </thead>
                            <tbody>
							@foreach($all_company_info as $key=>$v_company)
                                <tr id="{{$v_company->company_id}}">
								<td>{{$key+1}}</td>
                                    <td>{{$v_company->company_name}}</td>
                                    <td>
										<span>
										@if ($v_company->company_publication == 1)
											<a class="btn btn-green btn-sm  mr-1 mb-1 white mg active-company" active-id="{{$v_company->company_id}}"
											data-link="{{URL::to('/active_company/'.$v_company->company_id)}}">
												<i class="icon-like"></i></i>
											</a>
										@else
											<a class="btn btn-danger btn-sm  mr-1 mb-1 white mg active-company" active-id="{{$v_company->company_id}}"
											data-link="{{URL::to('/active_company/'.$v_company->company_id)}}">
												<i class="icon-dislike"></i></i>
											</a>
										@endif
											<a class="btn btn-info btn-sm mr-1 mb-1 edite-company-btn" data-link="{{URL::to('/edit-company/'.$v_company->company_id)}}">
											<i class="icon-pencil"></i>
											</a>
											<a class="btn btn-danger btn-sm mr-1 mb-1 remove-company-btn" data-link="{{URL::to('/delete-company/'.$v_company->company_id)}}" 
											data-name="{{$v_company->company_name}}" data-id="{{$v_company->company_id}}">
											<i class="icon-trash"></i>
											</a>
										</span>
									</td>
                                </tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
				<!------------------------------------------ end table ----------------------------------------------->
				
				<!------------------------------------------ Addtion Category ---------------------------------------->
					<div class="card-content collapse show hide addtion-company-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right addtion-company-close"><i class="icon-close"></i></button>
							<h1> Addtion New</h1>
						</div>
						<div id="error_msg"></div>
						<form class="form" id="add-company" action="{{url('/save-company')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">Arabic Name </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="en">
											<input type="text" id="eventInput1" class="form-control" name="company_name_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput2">English Name</label>
											<input type="text" id="eventInput2" class="form-control" name="company_name">
										</div>

										<div class="form-group">
											<label for="eventInput3">Description Arabic</label>
											<input type="text" id="eventInput3" class="form-control" name="company_description_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput4">Description English</label>
											<input type="text" id="eventInput4" class="form-control" name="company_description">
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
					<div class="card-content collapse show hide edite-company-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right edite-company-close"><i class="icon-close"></i></button>
							<h1>Update Info</h1>
						</div>
						<div id="error_msg_ed"></div>
						<form class="form" id="edite-company" action="{{url('/update-company')}}">
						{{ csrf_field() }}
							<div class="row justify-content-md-center">
								<div class="col-md-12">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">Arabic Name </label>
											<input type="hidden" id="eventInput1" class="form-control" name="lang" value="en">
											<input type="hidden" id="eventInput1" class="form-control" name="company_id">
											<input type="hidden" id="eventInput1" class="form-control" name="company_publication">
											<input type="text" id="eventInput1" class="form-control" name="company_name_arabic">
										</div>

										<div class="form-group" >
											<label for="eventInput2">English Name </label>
											<input type="text" id="eventInput2" class="form-control" name="company_name">
										</div>

										<div class="form-group">
											<label for="eventInput3">Arabic Description </label>
											<input type="text" id="eventInput3" class="form-control" name="company_description_arabic">
										</div>

										<div class="form-group">
											<label for="eventInput4">English Description </label>
											<input type="text" id="eventInput4" class="form-control" name="company_description">
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
					<div class="card-content collapse show hide delete-company-form">
					<div class="card-body">

						<div class="card-text mb-2">
						<button class="btn btn-outline-dark btn-sm mr-1 mb-1 float-right delete-company-close"><i class="icon-close"></i></button>
							<h1 id="name">Are You Sure for remove : </h1>
						</div>
						<div id="error_msg_down"></div>
						<form class="form" id="delete-company" action="{{url('/delete-company')}}">
						{{ csrf_field() }}
									
							<div class="form-actions right">
							<input type="hidden"   name="lang" value="en">
							<input type="hidden"   name="company_id">
								<button type="submit" class="btn btn-success" id="remove">
									<i class="fa fa-check-square-o"></i> Yes
								</button>
								<button type="button" class="btn btn-danger mr-1 delete-company-close">
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
