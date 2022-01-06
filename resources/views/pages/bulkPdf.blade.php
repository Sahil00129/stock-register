@extends('layouts.main')
@section('title', 'Get PDF')
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
.form-inline {  
    flex-direction: column;
    align-items: stretch;
}

.form-inline label {
  margin: 5px 10px 5px 0;
  font-weight: bold;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 6px;
  background-color: #fff;
  border: 1px solid #ddd;
}
.form-inline select {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 6px;
  background-color: #fff;
  border: 1px solid #ddd;
}

.form-inline button {
  padding: 10px 20px;
  background-color: dodgerblue;
  border: 1px solid #ddd;
  color: white;
  cursor: pointer;
}

.form-inline button:hover {
  background-color: royalblue;
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
				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Filter Data</h1>
				<!--end::Title-->
				<!--begin::Separator-->	<span class="h-20px border-gray-200 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->

				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<div class="d-flex align-items-center py-1">
				<!--begin::Wrapper-->
				<div class="me-4">
                <form class="form-inline" method="post" action="{{  URL::to('/generate-allinone-pdf') }}" id="allinone">
				@csrf <!-- {{ csrf_field() }} -->
                <label for="date">From</label>
                <input type="date" id="fromDate" placeholder="" name="fromDate">
                 <label for="date">To</label>  <input type="date" id="toDate" placeholder="Enter email" name="toDate">
				 <label for="site">Site</label>
				 <select id="siteId" name="site_id">
                    @foreach ($site as $i)
					<option value="{{ $i->site_id }}">{{ $i->site_id }}</option>
                    @endforeach
				</select> 
                <button type="submit">Generate PDF</button>
                </form>

				</div>

			</div>
			<!--end::Actions-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post" >
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card body-->
				<div class="card-body pt-0" style="min-height:500px;">
					<?php //echo"<pre>";print_r($list);?>
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