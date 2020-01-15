@extends('layouts.backend')
@section('title', 'Products')
@section('breadcrumbs')
	<a href="{{route('admin.dashboard')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Product</span>
@endsection
@section('content')

	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					List
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						
						&nbsp;
							<a href="{{route('admin.product.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							New Product
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Country</th>
						<th>Ship City</th>
						<th>Company Name</th>
						<th>Ship Date</th>
						<th>Status</th>
						<th>Type</th>
						<th>Actions</th>
					</tr>
				</thead>
			</table>

			<!--end: Datatable -->
		</div>
	</div>

@endsection