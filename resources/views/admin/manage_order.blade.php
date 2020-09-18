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
                    <h4 class="card-title">الطلبات</h4>
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
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration" id="tabledata">
                            <thead>
                                <tr>
									<th>#</th>
									<th>اسم العميل</th>
									<th>المبلغ</th>
									<th>حاله الطلب</th>
									<th></th>
                                </tr>
                            </thead>
							<tbody>
							@foreach($all_order_info as $v_order)
                                <tr id="{{$v_order->order_id}}">
								<td>{{$v_order->order_id}}</td>
								<td>{{$v_order->customer_name}}</td>
								<td>{{$v_order->order_total}}</td>
                                    <td>
										<span>
										@if ($v_order->order_status == 1)
											<a class="btn btn-green btn-sm" href="{{URL::to('/unactive_order/'.$v_order->order_id.'/ar')}}">
												<i class="icon-like"></i>  
											</a>
										@else
											<a class="btn btn-danger btn-sm" href="{{URL::to('/active_order/'.$v_order->order_id.'/ar')}}">
												<i class="icon-dislike"></i>  
											</a>
										@endif
											<a class="btn btn-info btn-sm" href="{{URL::to('/view-order/'.$v_order->order_id.'/ar')}}">
												<i class="icon-notebook"></i>  
											</a>
											<a class="btn btn-danger btn-sm" href="{{URL::to('/delete-order/'.$v_order->order_id.'/ar')}}" id="delete">
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
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration" id="tabledata">
                            <thead>
                                <tr>
									<th>#</th>
									<th>Castumer name</th>
									<th>Amount</th>
									<th>Status</th>
									<th></th>
                                </tr>
                            </thead>
							<tbody>
							@foreach($all_order_info as $v_order)
                                <tr id="{{$v_order->order_id}}">
								<td>{{$v_order->order_id}}</td>
								<td>{{$v_order->customer_name}}</td>
								<td>{{$v_order->order_total}}</td>
                                    <td>
										<span>
										@if ($v_order->order_status == 1)
											<a class="btn btn-green btn-sm" href="{{URL::to('/unactive_order/'.$v_order->order_id.'/en')}}">
												<i class="icon-like"></i>  
											</a>
										@else
											<a class="btn btn-danger btn-sm" href="{{URL::to('/active_order/'.$v_order->order_id.'/en')}}">
												<i class="icon-dislike"></i>  
											</a>
										@endif
											<a class="btn btn-info btn-sm" href="{{URL::to('/view-order/'.$v_order->order_id.'/en')}}">
												<i class="icon-notebook"></i>  
											</a>
											<a class="btn btn-danger btn-sm" href="{{URL::to('/delete-order/'.$v_order->order_id.'/en')}}" id="delete">
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
				</section>
				

				<!------------------------------------------ end table ----------------------------------------------->




@endif
@include('admin.inc.footer')

