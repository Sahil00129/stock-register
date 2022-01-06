<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | Eternity - Warehouse Register</title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')

</head>
<!--id="kt_body"-->
<body id="app" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    	<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!-- initiate header-->
					@include('include.header')
					<div class="page-wrap">

						<div class="main-content">
							<!-- yeild contents here -->
							@yield('content')
						</div>

						<!-- initiate chat section-->
						<!--@include('include.chat')-->


						<!-- initiate footer section-->
						@include('include.footer')

					</div>
				</div>
				
				<!-- initiate modal menu section-->
				@include('include.modalmenu')

             </div>
           </div>
        </div>

	<!-- initiate scripts-->
	@include('include.script')	
</body>
</html>