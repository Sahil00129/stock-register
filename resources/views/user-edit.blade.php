@extends('layouts.main') 
@section('title', $user->name)
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
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('Edit User')}}</h1>
									<!--end::Title-->
									<!--begin::Separator-->
									<span class="h-20px border-gray-200 border-start mx-4"></span>
									<!--end::Separator-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="#" class="text-muted text-hover-primary">{{ __('Create new user, assign roles & permissions')}}</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">{{ clean($user->name, 'titles')}}</li>
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
									<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">All Users</a>
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
                                <div class="row">
                                    <!-- start message area-->
                                    @include('include.message')
                                    <!-- end message area-->
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="forms-sample" method="POST" action="{{ url('user/update') }}" >
                                                @csrf
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label for="name">{{ __('Username')}}<span class="text-red">*</span></label>
                                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ clean($user->name, 'titles')}}" required>
                                                                <div class="help-block with-errors"></div>

                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ clean($user->email, 'titles')}}" required>
                                                                <div class="help-block with-errors"></div>

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                        
                                                            <div class="form-group">
                                                                <label for="password">{{ __('Password')}}</label>
                                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  >
                                                                <div class="help-block with-errors"></div>

                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password-confirm">{{ __('Confirm Password')}}</label>
                                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            
                                                            
                                                            
                                                            
                                                        
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- Assign role & view role permisions -->
                                                            <div class="form-group">
                                                                <label for="role">{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                                                {!! Form::select('role', $roles, $user_role->id??'' ,[ 'class'=>'form-control select2', 'placeholder' => 'Select Role','id'=> 'role', 'required'=>'required']) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">{{ __('Permissions')}}</label>
                                                                <div id="permission" class="form-group">
                                                                    @foreach($user->getAllPermissions() as $key => $permission) 
                                                                    <span class="badge badge-dark m-1">
                                                                        <!-- clean unescaped data is to avoid potential XSS risk -->
                                                                        {{ clean($permission->name, 'titles')}}
                                                                    </span>
                                                                    @endforeach
                                                                </div>
                                                                <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary form-control-right">{{ __('Update')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            

						</div>
						<!--end::Post-->
					</div>

@endsection
