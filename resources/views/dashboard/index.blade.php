@extends('app')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="javascript:;">Home</a></li>
	<li class="active">Dashboard</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-green">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>TOTAL VISITORS</h4>
				<p>3,291,922</p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-blue">
			<div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
			<div class="stats-info">
				<h4>BOUNCE RATE</h4>
				<p>20.44%</p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-purple">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>UNIQUE VISITORS</h4>
				<p>1,291,922</p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-clock-o"></i></div>
			<div class="stats-info">
				<h4>AVG TIME ON SITE</h4>
				<p>00:12:23</p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->
<!-- begin row -->
<div class="row">
	<!-- begin col-8 -->
	<div class="col-md-8">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Website Analytics (Last 7 Days)</h4>
			</div>
			<div class="panel-body">
				<div id="interactive-chart" class="height-sm"></div>
			</div>
		</div>
		
        
	</div>
	<!-- end col-8 -->
	<!-- begin col-4 -->
	<div class="col-md-4">
		<div class="panel panel-inverse" data-sortable-id="index-6">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Analytics Details</h4>
			</div>
			<div class="panel-body p-t-0">
				<table class="table table-valign-middle m-b-0">
					<thead>
						<tr>	
							<th>Source</th>
							<th>Total</th>
							<th>Trend</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label class="label label-danger">Unique Visitor</label></td>
							<td>13,203 <span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
							<td><div id="sparkline-unique-visitor"></div></td>
						</tr>
						<tr>
							<td><label class="label label-warning">Bounce Rate</label></td>
							<td>28.2%</td>
							<td><div id="sparkline-bounce-rate"></div></td>
						</tr>
						<tr>
							<td><label class="label label-success">Total Page Views</label></td>
							<td>1,230,030</td>
							<td><div id="sparkline-total-page-views"></div></td>
						</tr>
						<tr>
							<td><label class="label label-primary">Avg Time On Site</label></td>
							<td>00:03:45</td>
							<td><div id="sparkline-avg-time-on-site"></div></td>
						</tr>
						<tr>
							<td><label class="label label-default">% New Visits</label></td>
							<td>40.5%</td>
							<td><div id="sparkline-new-visits"></div></td>
						</tr>
						<tr>
							<td><label class="label label-inverse">Return Visitors</label></td>
							<td>73.4%</td>
							<td><div id="sparkline-return-visitors"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="panel panel-inverse" data-sortable-id="index-7">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Visitors User Agent</h4>
			</div>
			<div class="panel-body">
				<div id="donut-chart" class="height-sm"></div>
			</div>
		</div>
		
		<div class="panel panel-inverse" data-sortable-id="index-10">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Calendar</h4>
			</div>
			<div class="panel-body">
				<div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
			</div>
		</div>
	</div>
	<!-- end col-4 -->
</div>
<!-- end row -->

@endsection