@extends('layouts.main') 
@section('title', 'Dashboard')
@section('content')
<style>
	.ignored {
    margin-top: 10px;
    color: red;
}
div#ignoredItems {
    font-size: 13px;
    border: 1px solid;
    padding: 17px;
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
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Imports</h1>
									<!--end::Title-->
									<!--begin::Separator-->
									<span class="h-20px border-gray-200 border-start mx-4"></span>
									<!--end::Separator-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="../../demo13/dist/index.html" class="text-muted text-hover-primary">Home</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">Import Master</li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
								<!--begin::Actions-->
								<div class="d-flex align-items-center py-1">
									<!--begin::Wrapper-->
									<!--end::Wrapper-->
									<!--begin::Button-->
									<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Home</a>
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
									<div class="card-body pb-0">
										<!--begin::Heading-->
										<div class="card-px text-center pt-20 pb-5">
											<!--begin::Title-->
											<h2 class="fs-2x fw-bolder mb-0">Upload Data</h2>
											<!--end::Title-->
											<!--begin::Description-->
											<p class="text-gray-400 fs-4 fw-bold py-7">Click on the below buttons to upload
											<br />a Excel File.</p>
											<!--end::Description-->
											<!--begin::Action-->
											<a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">Upload New File</a>
											<!--end::Action-->
										</div>
										<!--end::Heading-->
										<!--begin::Illustration-->
										<div class="text-center px-5">
											<img src="assets/media/illustrations/unitedpalms-1/19.png" alt="" class="mw-100 h-200px h-sm-325px" />
										</div>
										<!--end::Illustration-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card-->
								<!--begin::Modal - New Card-->
								<div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
									<!--begin::Modal dialog-->
									<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Modal header-->
											<div class="modal-header">
												<!--begin::Modal title-->
												<h2>Upload New</h2>
												<!--end::Modal title-->
												<!--begin::Close-->
												<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
															<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Close-->
											</div>
											<!--end::Modal header-->
											<!--begin::Modal body-->
											<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
												<!--begin::Form-->
                                                <form  id="kt_modal_upload_csv" class="form" action="{{ route('import') }}" method="POST" enctype="multipart/form-data" novalidate="">
                                                        {{ csrf_field() }}
														<div class="d-flex flex-column mb-8 fv-row">
														<label class="required fs-6 fw-bold mb-2">Import Type</label>
															<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Choose import type" id="itype" name="import_type">
																<option value="">Select...</option>
																<option value="1">Item Master</option>
																<option value="2">Sale Data</option>
																<option value="3">Purchase Data</option>
																<option value="4">Stock Transfer</option>
																<option value="5">Opening balance</option>
															</select> 
														<div>
														<div class="d-flex flex-column mb-8 fv-row mt-3">
                                                        <input type="file" id="myCsv" name="file" class="form-control">
														</div>
                                                        <br>
														<button type="submit" id="btn-save" class="btn btn-primary">
															<span class="indicator-label">Submit</span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
														<div class="ignored" style="display:none;">
															 <h2>Ignored Items, these items are not availabe in the Item Master.</h2>
														   <div id="ignoredItems">
                                                           </div>	
														<div>
                                                    </form>

											<!--end::Form-->
											</div>
											<!--end::Modal body-->
										</div>
										<!--end::Modal content-->
									</div>
									<!--end::Modal dialog-->
								</div>
								<!--end::Modal - New Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>

@endsection