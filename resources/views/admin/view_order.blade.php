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
                  <li class="breadcrumb-item active">الطلبات
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
                    <h4 class="card-title">Orders</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
				<!--------------------------------------------- table --------------------------------------------------->
                <div class="card-content collapse show" id="catogry-table">
                    <div class="card-body card-dashboard col-md-12 row">
                        <table class="table table-striped table-bordered col-md-4 mr-1">
						<thead>
						<tr>
						<th colspan="2" class="text-center">اسم العميل</th>
						</tr>		  
						<tr>
									  <th>اسم العميل </th>
									  <th>رقم التليفون</th>                                       
						</tr>
							  </thead>   
							  <tbody>
								<tr>
									 @foreach($order_by_id as $v_order)
									 @endforeach 
							         <td>{{$v_order->customer_name}}</td>
							         <td>{{$v_order->mobile_number}}</td> 
							                                  
								</tr>                                
							  </tbody>
						</table>
						
						<table class="table table-striped table-bordered  col-md-6">
						<thead>
						<tr>
						<th colspan="4" class="text-center">تفاصيل الشحن </th>
						</tr>
								  <tr>
									  <th>الاسم</th>
									  <th>العنوان</th>
									  <th>رقم التليفون</th> 
									   <th>البريد الالكتروني</th>           
								  </tr>
							  </thead>   
							  <tbody>
								<tr>
									@foreach($order_by_id as $v_order)
									 @endforeach
								      <td>{{$v_order->shipping_First_name}}</td>
								      <td>{{$v_order->shipping_address}}</td>                   
								      <td>{{$v_order->shipping_mobile_number}}</td>
								      <td>{{$v_order->shipping_email}}</td>   
								     
								</tr>
							                                 
							  </tbody>
						</table>
						
						<table class="table table-striped table-bordered  col-md-12">
						<thead>
						<tr>
							<th colspan="4" class="text-center"> تفاصيل الطلب </th>
						</tr>
						<tr>
							<th>رقم الطلب</th>
							<th>اسم الصنف</th>
							<th>سعر الصنف</th>
							<th>الكمية</th>
							<th>المجموع</th>
						</tr>
							  </thead>   
							  <tbody>
						 @foreach($order_by_id as $v_order)							  	 
							<tr>
						
				             <td>{{$v_order->order_id}}</td> 
				             <td>{{$v_order->product_name}}</td> 
				             <td>{{$v_order->product_price}}</td>
				             <td>{{$v_order->product_sales_quantity}}</td> 
                             <td>{{$v_order->product_price*$v_order->product_sales_quantity}}</td>
				                
                              
							</tr>
						@endforeach
							
						  </tbody>
                          <tfoot>
                          	<tr>
                          	<td colspan="4">الاجمالي</td>
                          	<td><strong>{{$v_order->order_total}}  جنيها مصري فقط لا غير </strong></td>
                          	</tr>
                          </tfoot>
                        </table>
                    </div>
				</div>
				</section>
				

				<!------------------------------------------ end table ----------------------------------------------->

			
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
                  <li class="breadcrumb-item active">Orders
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
                    <h4 class="card-title">Orders</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
				<!--------------------------------------------- table --------------------------------------------------->
                <div class="card-content collapse show" id="catogry-table">
                    <div class="card-body card-dashboard col-md-12 row">
                        <table class="table table-striped table-bordered col-md-4 mr-1">
						<thead>
						<tr>
						<th colspan="2" class="text-center">اسم العميل</th>
						</tr>		  
						<tr>
									  <th>Castumer Nme</th>
									  <th>Phone No.</th>                                       
						</tr>
							  </thead>   
							  <tbody>
								<tr>
									 @foreach($order_by_id as $v_order)
									 @endforeach 
							         <td>{{$v_order->customer_name}}</td>
							         <td>{{$v_order->mobile_number}}</td> 
							                                  
								</tr>                                
							  </tbody>
						</table>
						
						<table class="table table-striped table-bordered  col-md-6">
						<thead>
						<tr>
						<th colspan="4" class="text-center">تفاصيل الشحن </th>
						</tr>
								  <tr>
									  <th>Name</th>
									  <th>Adress</th>
									  <th>Phone No.</th>    
									  <th>E_mail</th>         
								  </tr>
							  </thead>   
							  <tbody>
								<tr>
									@foreach($order_by_id as $v_order)
									 @endforeach
								      <td>{{$v_order->shipping_First_name}}</td>
								      <td>{{$v_order->shipping_address}}</td>                   
								      <td>{{$v_order->shipping_mobile_number}}</td>
								      <td>{{$v_order->shipping_email}}</td>   
								     
								</tr>
							                                 
							  </tbody>
						</table>
						
						<table class="table table-striped table-bordered  col-md-12">
						<thead>
						<tr>
							<th colspan="4" class="text-center"> تفاصيل الطلب </th>
						</tr>
						<tr>
							<th>Order No.</th>
							<th> Product name</th>
							<th>Price </th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
							  </thead>   
							  <tbody>
						 @foreach($order_by_id as $v_order)							  	 
							<tr>
						
				             <td>{{$v_order->order_id}}</td> 
				             <td>{{$v_order->product_name}}</td> 
				             <td>{{$v_order->product_price}}</td>
				             <td>{{$v_order->product_sales_quantity}}</td> 
                             <td>{{$v_order->product_price*$v_order->product_sales_quantity}}</td>
				                
                              
							</tr>
						@endforeach
							
						  </tbody>
                          <tfoot>
                          	<tr>
                          	<td colspan="4">All Of Total</td>
                          	<td><strong>{{$v_order->order_total}} EGP Only </strong></td>
                          	</tr>
                          </tfoot>
                        </table>
                    </div>
				</div>
				</section>
				

				<!------------------------------------------ end table ----------------------------------------------->

			

@endif
@include('admin.inc.footer')