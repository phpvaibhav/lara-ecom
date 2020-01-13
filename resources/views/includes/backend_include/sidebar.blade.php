<!---begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
	<!-- begin: Header Menu -->
	<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
	<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
		<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
			<!-- <ul class="kt-menu__nav ">
			</ul> -->
		</div>
	</div>
	<!-- end: Header Menu -->
	<!-- begin:: Header Topbar -->
	<div class="kt-header__topbar">
		<!--begin: Search -->
		<!--end: Search -->
		<!--begin: Notifications -->
		<!--end: Notifications -->
		<!--begin: Quick Actions -->
		<!--end: Quick Actions -->
		<!--begin: My Cart -->
		<!--end: My Cart -->
		<!--begin: Quick panel toggler -->
		<!--end: Quick panel toggler -->
		<!--begin: Language bar -->
		<!--end: Language bar -->
		<!--begin: User Bar -->
		<div class="kt-header__topbar-item kt-header__topbar-item--user">
			<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
				<div class="kt-header__topbar-user">
					<span class="kt-header__topbar-welcome kt-hidden-mobile"></span>
					<span class="kt-header__topbar-username kt-hidden-mobile">{{Auth::user()->name}}</span>
					<img alt="Pic" class="kt-radius-100" src="{{ asset('backend_assets/media/users/300_25.jpg')}}" />
					<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
					<!--<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>-->
				</div>
			</div>
			<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

				<!--begin: Head -->
				<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{asset('backend_assets/media/misc/bg-1.jpg')}})">
					<div class="kt-user-card__avatar">
						<img class="kt-hidden" alt="Pic" src="{{asset('backend_assets/media/users/300_25.jpg')}}" />
						<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
						<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"> {{mb_substr(Auth::user()->name, 0, 1)}}</span>
					</div>
					<div class="kt-user-card__name">
						{{Auth::user()->name}}
					</div>
					<div class="kt-user-card__badge">
						<!-- <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span> -->
					</div>
				</div>
				<!--end: Head -->
				<!--begin: Navigation -->
				<div class="kt-notification">
					<a href="" class="kt-notification__item">
						<div class="kt-notification__item-icon">
							<i class="flaticon2-calendar-3 kt-font-success"></i>
						</div>
						<div class="kt-notification__item-details">
							<div class="kt-notification__item-title kt-font-bold">
								My Profile
							</div>
							<div class="kt-notification__item-time">
							<!-- 	Account settings and more -->
							</div>
						</div>
					</a>
					
					<div class="kt-notification__custom kt-space-between">
						<a href="{{ route('admin.logout') }}"
                                       class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
						<!-- <a href="#" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a> -->
					</div>
				</div>

				<!--end: Navigation -->
			</div>

		</div>
		<!--end: User Bar -->
		<!--start:logout-->
		<div class="kt-header__topbar-item ">
			<div class="kt-header__topbar-wrapper"  data-offset="10px,0px">
				<span class="kt-header__topbar-icon">
					<a  href="{{ route('admin.logout') }}">
					<i class="fa fa-sign-out-alt" aria-hidden="true"></i>
					</a>
					
				</span>
			</div>

		</div>
		
		<!--end: logout -->
	</div>

	<!-- end:: Header Topbar -->
</div>
<!-- end:: Header