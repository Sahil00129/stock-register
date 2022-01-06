@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<style>
div#itemList_filter {
    width: 70%;
    float: left;
}
 .dt-buttons.btn-group.flex-wrap {
    float: right;
    margin-top: 10px;
}
select.cfilter {
    border: 1px solid #cccccc54;
    width: 100%;
}
th {
    color: #000 !important;
}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Item Master</h1>
				<!--end::Title-->
				<!--begin::Separator-->	<span class="h-20px border-gray-200 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">	<a href="../../demo13/dist/index.html" class="text-muted text-hover-primary">Home</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">	<span class="bullet bg-gray-200 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-dark">All Items</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<div class="d-flex align-items-center py-1">
				<!--begin::Wrapper-->
				<div class="me-4">
                <table>
                    <tr id="filters">
                    <th class="min-w-125px">Item name</th>
								<th class="min-w-125px">Bill No</th>
								<th class="min-w-125px">Vendor Name</th>
								<th class="min-w-125px">Batch No.</th>
                                <!--<th class="min-w-125px">Mfg Date</th>
								<th class="min-w-125px">Exp Date</th>-->
                                <th class="min-w-125px">VInv. No</th>
                                <th class="min-w-125px">VInv. Date</th>
                                <th class="min-w-125px">Qty in kgltr</th>
                                <th class="min-w-125px">Doc Type</th>
							</tr>
                    </table> 
				</div>
				<!--end::Wrapper-->
				<!--begin::Button-->
                <!--<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Create</a>-->
				<!--end::Button-->
			</div>
			<!--end::Actions-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card body-->
				<div class="card-body pt-0">     
					<!--begin::Table-->
					<table class="table align-middle table-row-dashed fs-6 gy-5" id="purchaseData">
						<!--begin::Table head-->
						<thead>
							<!--begin::Table row-->
							<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Item name</th>
								<th class="min-w-125px">Bill No</th>
								<th class="min-w-125px">Vendor Name</th>
								<th class="min-w-125px">Batch No.</th>
                                <th class="min-w-125px">VInv. No</th>
                                <th class="min-w-125px">VInv. Date</th>
                                <th class="min-w-125px">Qty in kgltr</th>
                                <th class="min-w-125px">Doc Type</th>
							</tr>
							<!--end::Table row-->
						</thead>
						<!--end::Table head-->
						<!--begin::Table body-->
                        <?php
                       //echo "<pre>"; print_r($list);?>
						<tbody class="fw-bold text-gray-600">

						</tbody>
						<!--end::Table body-->
					</table>
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
@endsection