
@include('admin.inc.en.head')
@include('admin.inc.en.header')

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Sales stats -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="pb-1">
                                <div class="clearfix mb-1">
                                    <i class="icon-star font-large-1 blue-grey float-left mt-1"></i>
                                    <span class="font-large-2 text-bold-300 info float-right">5,879</span>
                                </div>
                                <div class="clearfix">
                                    <span class="text-muted">المنتجات</span>
                                    <span class="info float-right"><i class="ft-arrow-up info"></i> 16.89%</span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height: 7px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-lg-6  col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="pb-1">
                                <div class="clearfix mb-1">
                                    <i class="icon-user font-large-1 blue-grey float-left mt-1"></i>
                                    <span class="font-large-2 text-bold-300 danger float-right">423</span>
                                </div>
                                <div class="clearfix">
                                    <span class="text-muted">الطلبات</span>
                                    <span class="danger float-right"><i class="ft-arrow-up danger"></i> 5.14%</span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height: 7px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Sales stats -->
<!-- Sales by Campaigns & Year -->
<div class="row">
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Smooth Area Chart</h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <ul class="list-inline text-center">
                        <li>
                            <h6><i class="ft-circle grey lighten-1"></i> iPhone</h6>
                        </li>
                        <li>
                            <h6><i class="ft-circle success"></i> Samsung</h6>
                        </li>
                    </ul>
                    <div id="smooth-area-chart" class="height-350"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body sales-growth-chart">
                    <div id="mobile-sales" class="height-300"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="chart-title mb-1">
                    <span class="text-muted">Total mobile units sold and total earning statistics.</span>
                </div>
                <ul class="list-inline text-center clearfix mt-1">
                    <li class="mr-3"><span class="text-muted">Total Units Sold</span><h2 class="block">18.6 k</h2></li>
                    <li><span class="text-muted">Total Earnings</span><h2 class="block">64.54 M</h2></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ Sales by Campaigns & Year -->


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

	
	@include('admin.inc.footer')
