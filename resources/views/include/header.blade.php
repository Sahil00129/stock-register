<div id="kt_header" style="" class="header align-items-stretch">
	<!--begin::Container-->
	<div class="container-xxl d-flex align-items-stretch justify-content-between">
		<!--begin::Aside mobile toggle-->
		<!--end::Aside mobile toggle-->
		<!--begin::Logo-->
		<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
			<a href="{{ url('dashboard') }}">
				<img alt="Logo" src="{{ asset('assets/media/logos/eRegister.png') }}" class="h-35px" />
			</a>
		</div>
		<!--end::Logo-->
		<!--begin::Wrapper-->
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
			<!--begin::Navbar-->
			<div class="d-flex align-items-stretch" id="kt_header_nav">
				<!--begin::Menu wrapper-->
				<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
					<!--begin::Menu-->
					<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
						<div class="menu-item me-lg-1">
							<a class="menu-link py-3" href="{{ url('dashboard') }}">	<span class="menu-title">Dashboard</span>
							</a>
						</div>
						<div class="menu-item me-lg-1">
							<a class="menu-link py-3" href="{{ url('importExportView') }}">	<span class="menu-title">Import Master</span>
							</a>
						</div>
						<div class="menu-item me-lg-1">
							<a class="menu-link py-3" href="{{ url('items') }}">	<span class="menu-title">Items Master</span>
							</a>
						</div>
						<div class="menu-item me-lg-1">
							<a class="menu-link py-3" href="{{ url('saledata') }}"><span class="menu-title">Sales Data</span>
							</a>
						</div>
						<div class="menu-item me-lg-1">
							<a class="menu-link py-3" href="{{ url('purchasedata') }}"><span class="menu-title">Purchase Data</span>
							</a>
						</div>
						<div class="menu-item me-lg-1">
							<a class="menu-link py-3" href="{{ url('getPdf') }}"><span class="menu-title">Single PDF</span>
							</a>
						</div>
						<div class="menu-item me-lg-1">
							<a class="menu-link py-3" href="{{ url('bulkpdf') }}"><span class="menu-title">Grouped PDF</span>
							</a>
						</div>
					</div>
					<!--end::Menu-->
				</div>
				<!--end::Menu wrapper-->
			</div>
			<!--end::Navbar-->
			<!--begin::Topbar-->
			<div class="d-flex align-items-stretch flex-shrink-0">
				<!--begin::Toolbar wrapper-->
				<div class="topbar d-flex align-items-stretch flex-shrink-0">
					<!--begin::Search-->
					<div class="d-flex align-items-stretch">
						<!--begin::Search-->
						<div id="kt_header_search" class="d-flex align-items-stretch" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
							<!--begin::Search toggle-->
							<div class="d-flex align-items-stretch" data-kt-search-element="toggle" id="kt_header_search_toggle">
								<div class="topbar-item px-3 px-lg-5">	<i class="bi bi-search fs-3"></i>
								</div>
							</div>
							<!--end::Search toggle-->

						
						</div>
						<!--end::Search-->
					</div>
					<!--end::Search-->
					<!--begin::Activities-->
					<div class="d-flex align-items-stretch">
						<!--begin::drawer toggle-->
						<div class="topbar-item px-3 px-lg-5" id="kt_activities_toggle">	<i class="bi bi-box-seam fs-3"></i>
						</div>
						<!--end::drawer toggle-->
					</div>
					<!--end::Activities-->
					<!--begin::Quick links-->
					<div class="d-flex align-items-stretch">
						<!--begin::Menu wrapper-->
						<div class="topbar-item px-3 px-lg-5" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">	<i class="bi bi-bar-chart fs-3"></i>
						</div>

						<!--end::Menu wrapper-->
					</div>
					<!--end::Quick links-->
					<!--begin::Chat-->
					<div class="d-flex align-items-stretch">
						<!--begin::Menu wrapper-->
						<div class="topbar-item position-relative px-3 px-lg-5" id="kt_drawer_chat_toggle">	<i class="bi bi-chat-left-text fs-3"></i>
							<span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 mt-4 start-50 animation-blink"></span>
						</div>
						<!--end::Menu wrapper-->
					</div>
					<!--end::Chat-->
					<!--begin::Notifications-->
					<div class="d-flex align-items-stretch">
						<!--begin::Menu wrapper-->
						<div class="topbar-item position-relative px-3 px-lg-5" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">	<i class="bi bi-app-indicator fs-3"></i>
						</div>
						<!--end::Menu wrapper-->
					</div>
					<!--end::Notifications-->
					<!--begin::User-->
					<div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
						<!--begin::Menu wrapper-->
						<div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
							<img src="{{ asset('assets/media/avatars/150-2.jpg') }}" alt="metronic" />
						</div>
						<!--begin::Menu-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content d-flex align-items-center px-3">
									<!--begin::Avatar-->
									<div class="symbol symbol-50px me-5">
										<img alt="Logo" src="{{ asset('assets/media/avatars/150-26.jpg') }}" />
									</div>
									<!--end::Avatar-->
									<!--begin::Username-->
									<div class="d-flex flex-column">
										<div class="fw-bolder d-flex align-items-center fs-5">Max Smith	<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
										</div>	<a href="#" class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
									</div>
									<!--end::Username-->
								</div>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator my-2"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">	<a href="{{url('profile')}}" class="menu-link px-5">My Profile</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
								<a href="{{ url('logout') }}" class="menu-link px-5">	<span class="menu-text"> {{ __('Logout')}}</span>
								</a>
							</div>



							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator my-2"></div>
							<!--end::Menu separator-->
	
							
							<!--begin::Menu separator-->
							<div class="separator my-2"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
								<div class="menu-content px-5">
									<label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
										<input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="../../demo13/dist/index.html" />	<span class="pulse-ring ms-n1"></span>
										<span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
									</label>
								</div>
							</div>
							<!--end::Menu item-->
						</div>
						<!--end::Menu-->
						<!--end::Menu wrapper-->
					</div>
					<!--end::User -->
					<!--begin::Heaeder menu toggle-->
					<div class="d-flex align-items-stretch d-lg-none px-3 me-n3" title="Show header menu">
						<div class="topbar-item" id="kt_header_menu_mobile_toggle">	<i class="bi bi-text-left fs-1"></i>
						</div>
					</div>
					<!--end::Heaeder menu toggle-->
				</div>
				<!--end::Toolbar wrapper-->
			</div>
			<!--end::Topbar-->
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Container-->
</div>