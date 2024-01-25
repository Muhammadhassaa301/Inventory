<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Header-->


@include('admin.partials.head')
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">
<button id="startConfetti" class="d-none"></button>
<button id="stopConfetti" class="d-none"></button>
<button id="restartConfetti" class="d-none"></button>
@include('admin.partials.header')
@include('admin.partials.sidebar')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>

        @yield('content')


    </div>
</div>
<!-- END: Content-->



@include('admin.partials.footer')
@yield('scripts')
@include('admin.partials.scripts')



@yield('end')
@yield('endscripts')

</body>
<!-- END: Body-->

</html>
