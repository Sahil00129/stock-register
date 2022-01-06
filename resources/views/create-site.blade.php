@extends('layouts.main') 
@section('title', 'Create Site')
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
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('Add Warehouse')}}</h1>
									<!--end::Title-->
									<!--begin::Separator-->
									<span class="h-20px border-gray-200 border-start mx-4"></span>
									<!--end::Separator-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="#" class="text-muted text-hover-primary">{{ __('Create new warehouse')}}</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted"></li>
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
									<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">All Sites</a>
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
                                <div class="card">
                                    <!-- start message area-->
                                    @include('include.message')
                                    <!-- end message area-->
                                    <div class="col-md-12">
                                        <div class="card ">
                                            <div class="card-body">
                                                <form class="forms-sample" method="POST" action="{{ url('site/create') }}" >
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label for="siteid">{{ __('Site ID')}}<span class="text-red">*</span></label>
                                                                <input id="siteid" type="text" class="form-control @error('siteid') is-invalid @enderror" name="siteid" value="" placeholder="Enter Site ID" required>
                                                                <div class="help-block with-errors"></div>

                                                                @error('siteid')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="sname">{{ __('Site Name')}}<span class="text-red">*</span></label>
                                                                <input id="sname" type="text" class="form-control  @error('sname') is-invalid @enderror" name="sname" value="" placeholder="Enter Site Name" required>
                                                                <div class="help-block with-errors" ></div>

                                                                @error('sname')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            </div>

                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">{{ __('Create')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </form>
                                            </div>
                                        <?php //echo "<pre>"; print_r($list)?>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0"> 
                                            
                                        <?php //echo "<pre>"; print_r($result);die;?>
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="allSites">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                             <th>Sr No</th>        
                                                             <th>{{ __('Site ID')}}</th>
                                                            <th>{{ __('Site name')}}</th>
                                                            <th>{{ __('Action')}}</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <?php
                                            //echo "<pre>"; print_r($list);?>
                                                <tbody class="fw-bold text-gray-600">
                                                @foreach ($list as $i)
                                                <tr>
                                                    <!--begin::Checkbox-->
                                                    <td>{{ $i->site_id }}</td>
                                                    <td>{{ $i->site_id }}</td>
                                                    <td>{{ $i->site_name }}</td>
                                                    <td><a href="{{ url('site/delete/'.$i->id) }}" class="btn btn-light-danger font-weight-bold mr-2"><i class="fas fa-trash-alt"></i> Delete</a></td>
                                                </tr>@endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>

                            </div>
                            </div>                            

						</div>
						<!--end::Post-->
					</div>

@endsection
