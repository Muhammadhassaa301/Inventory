<!-- BEGIN: Header-->

<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>

            <ul class="nav navbar-nav">


            </ul>
{{--            @if(Auth::user()?->isImpersonating())--}}
{{--                <ul class="nav navbar-nav">--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('admin.user.stopImpersonate') }}" class="btn btn-primary ms-2">Leave--}}
{{--                            Impersonation</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            @endif--}}

        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">

{{--            <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>--}}
{{--                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>--}}
{{--            </li>--}}
{{--                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>--}}
{{--            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>--}}
{{--                <div class="search-input">--}}
{{--                    <div class="search-input-icon"><i data-feather="search"></i></div>--}}
{{--                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">--}}
{{--                    <div class="search-input-close"><i data-feather="x"></i></div>--}}
{{--                    <ul class="search-list search-list-main"></ul>--}}
{{--                </div>--}}
{{--            </li>--}}
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
                                                                                   data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Search..." tabindex="-1"
                           data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main">


                    </ul>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="#"
                   data-bs-toggle="dropdown"><i class="ficon"
                                                data-feather="bell"></i>
{{--                    @if(auth()->user()?->unreadNotifications->count() > 0)--}}
                        <span
                            class="badge rounded-pill bg-danger badge-up" id="notification-pill">4</span>
{{--                    @endif--}}
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end notifications-dd">
{{--                    @include('admin.partials.notifications')--}}
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link"
                   id="dropdown-user" href="#" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    {{--                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{ Auth::user()->name }}</span><span class="user-status">{{ Auth::user()->roles()->first()->name}}</span></div>--}}
                    <span class="avatar"><img class="round" src="/app-assets/images/portrait/small/avatar-s-11.jpg"
                                              alt="avatar" height="40" width="40"><span
                            class="avatar-status-online"></span></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item"
                       href="#"><i
                            class="me-50" data-feather="user"></i> {{ Auth::user()?->name }}</a>
                    <a class="dropdown-item"
                       href="{{route('logout')}}"><i
                            class="me-50" data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<ul class="something_went_wrong_html main-search-list-defaultlist-other-list d-none mb-2 mt-2">
    <li class="auto-suggestion justify-content-between"><a
            class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="me-75" data-feather="frown"></span><span>Something went wrong. Please recheck and try again.</span>
            </div>
        </a></li>
</ul>

<ul class="please_wait_html main-search-list-defaultlist-other-list d-none mb-2 mt-2">
    <li class="auto-suggestion justify-content-between"><a
            class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="me-75" data-feather="loader"></span><span>Please Wait....</span>
            </div>
        </a></li>
</ul>
<!-- END: Header-->
