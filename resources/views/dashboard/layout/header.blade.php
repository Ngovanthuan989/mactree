<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active" data-menu-toggle="click" aria-haspopup="true">
                        <a href="/">
                            <span class="menu-text">Dashboard</span>
                            <i class="menu-arrow"></i>
                        </a>

                    </li>

                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Search-->

            <!--end::Search-->
            <!--begin::Notifications-->
        <!--begin::Notifications-->
        <div class="dropdown">
            <!--begin::Toggle-->
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                    <span class="svg-icon svg-icon-xl svg-icon-primary">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                        <i class="flaticon-bell text-success icon-lg"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="pulse-ring"></span>
                </div>
            </div>
            <!--end::Toggle-->
            <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <form>
                        <!--begin::Header-->
                        <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{asset('admin/assets/media/misc/bg-1.jpg')}})">
                            <!--begin::Title-->
                            <h4 class="d-flex flex-center rounded-top">
                                <span class="text-white">Thông báo</span>
                                <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2 total-notify">0</span>
                            </h4>
                            <!--end::Title-->
                            <!--begin::Tabs-->
                            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events">Mactree</a>
                                </li>

                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Content-->
                        <div class="tab-content">

                            <!--begin::Tabpane-->
                            <div class="tab-pane active" id="topbar_notifications_events" role="tabpanel">
                                <!--begin::Nav-->
                                <div class="navi navi-hover scroll my-4 list-notify" data-scroll="true" data-height="300" data-mobile-height="200">
                                    <!--begin::Item-->

                                </div>
                                <!--end::Nav-->
                            </div>
                            <!--end::Tabpane-->

                        </div>
                        <!--end::Content-->
                    </form>
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Notifications-->
            <!--end::Notifications-->

            <!--end::Dropdown-->
            <!--begin::Quick Actions-->

            <!--end::Cart-->
            <!--begin::Quick panel-->

            <!--end::Quick panel-->
            <!--begin::Chat-->

            <!--end::Chat-->
            <!--begin::Languages-->

            <!--end::Languages-->
            <!--begin::User-->

            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Xin chào,</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{$user->full_name}}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold">T</span>
                    </span>
                </div>
            </div>

            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>


