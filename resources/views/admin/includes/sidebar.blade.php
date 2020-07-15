<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @if(request()->segment(1) == 'admin') active @endif"><a
                    href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main"> @lang('site.dashboard') </span></a>
            </li>

            @if (auth()->user()->hasPermission('languages_read'))
                <li class="nav-item @if(request()->segment(2) == 'languages') active @endif"><a href=""><i
                            class="la la-globe"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> @lang('site.languages') </span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Language::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->segment(2) == 'languages') active @endif"><a class="menu-item"
                                                                                               href="{{route('admin.languages.index')}}"
                                                                                               data-i18n="nav.dash.ecommerce"> @lang('site.show_all') </a>
                        </li>
                        @if (auth()->user()->hasPermission('languages_create'))
                            <li><a class="menu-item" href="{{route('admin.languages.create')}}"
                                   data-i18n="nav.dash.crypto">@lang('site.add_language')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif


            @if (auth()->user()->hasPermission('main_categories_read'))
                <li class="nav-item @if(request()->segment(2) == 'maincategories') active @endif"><a href=""><i
                            class="la la-book"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> @lang('site.main_categories') </span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\MainCategory::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->segment(2) == 'maincategories') active @endif"><a class="menu-item"
                                                                                                    href="{{route('admin.maincategories.index')}}"
                                                                                                    data-i18n="nav.dash.ecommerce"> @lang('site.show_all') </a>
                        </li>
                        @if (auth()->user()->hasPermission('main_categories_create'))
                            <li><a class="menu-item" href="{{route('admin.maincategories.create')}}"
                                   data-i18n="nav.dash.crypto">@lang('site.add_main_category')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasPermission('vendors_read'))
                <li class="nav-item @if(request()->segment(2) == 'vendors') active @endif"><a href=""><i
                            class="la la-male"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> @lang('site.vendors') </span>
                        <span
                            class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Vendor::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->segment(2) == 'vendors') active @endif"><a class="menu-item"
                                                                                             href="{{route('admin.vendors.index')}}"
                                                                                             data-i18n="nav.dash.ecommerce"> @lang('site.show_all') </a>
                        </li>
                        @if (auth()->user()->hasPermission('vendors_create'))
                            <li><a class="menu-item" href="{{route('admin.vendors.create')}}"
                                   data-i18n="nav.dash.crypto">@lang('site.add_vendor')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasPermission('admins_read'))
                <li class="nav-item @if(request()->segment(2) == 'admins') active @endif"><a href=""><i
                            class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> @lang('site.admins') </span>
                        <span
                            class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Models\Admin::whereRoleIs('admin')->count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->segment(2) == 'admins') active @endif"><a class="menu-item"
                                                                                            href="{{route('admin.admins.index')}}"
                                                                                            data-i18n="nav.dash.ecommerce"> @lang('site.show_all') </a>
                        </li>
                        @if (auth()->user()->hasPermission('admins_create'))
                            <li><a class="menu-item" href="{{route('admin.admins.create')}}"
                                   data-i18n="nav.dash.crypto">@lang('site.add_admin')</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif


            {{--            <li class="nav-item">--}}
            {{--                <a href=""><i class="la la-male"></i>--}}
            {{--                    <span class="menu-title" data-i18n="nav.dash.main">تذاكر المراسلات   </span>--}}
            {{--                    <span--}}
            {{--                        class="badge badge badge-danger  badge-pill float-right mr-2">0</span>--}}
            {{--                </a>--}}
            {{--                <ul class="menu-content">--}}
            {{--                    <li class="active"><a class="menu-item" href=""--}}
            {{--                                          data-i18n="nav.dash.ecommerce"> تذاكر الطلاب </a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}

        </ul>
    </div>
</div>
