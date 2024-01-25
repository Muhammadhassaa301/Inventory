<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    @yield('meta')

    <title>@yield('title','Admin Panel')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="{{ url('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/pages/app-invoice.css')}}">
    <!-- BEGIN: Custom CSS-->

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"--}}
{{--          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="--}}
{{--          crossorigin="anonymous" referrerpolicy="no-referrer"/>--}}


    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}">

    <!-- END: Custom CSS-->
    <style>
        .back-light {
            background-color: #ffdcdccf;
            padding: 4px;
            position: relative;
            bottom: 4px;
            border-radius: 5px;
        }

        .invoice-summary-sticky {
            position: fixed;
            top: 130px;
            width: 285px;
        }

        .invoice-optional-fields {
            border: 1px solid #c1c1c1;
            padding: 14px 13px 21px 13px;
            margin: 41px 2px 40px 2px;
            border-radius: 5px;
        }

        table.dataTable.compact tbody th, table.dataTable.compact tbody td {
            padding-left: 4px;
            padding-right: 4px;
        }

        .search_view_more {
            padding: 6px !important;
            margin-top: 8px;
            font-size: 12px;

        }

        .search-label {
            font-size: 17px;
            font-weight: bolder;
            color: #000000a1;
            text-transform: capitalize;
        }

        .toggle-tr {
            padding: 10px 20px !important;
            font-weight: 500;
            text-align: left;
            font-size: 12px;
        }

        .custom-table-responsive td.toggle-tr {
            white-space: normal;
        }

        td {
            word-wrap: break-word !important;
        }

        .toggle-more {
            position: relative;
            padding: 0px 15px;
            cursor: pointer;

        }

        .custom-table-responsive {
            width: 100%;
            overflow: auto;
        }

        .custom-table-responsive td,
        .custom-table-responsive th {
            padding: 10px 5px;
            white-space: nowrap;
        }

        .custom-table-responsive td .mobile-th {
            display: none;
        }

        .custom-table-responsive th .action {
            min-width: 4500px;
        }

        @media (max-width: 991px) {


            .custom-table-responsive thead {
                display: none;
            }

            .custom-table-responsive tfoot th {
                display: none;
            }

            .custom-table-responsive tr {
                display: flex;
                flex-wrap: wrap;
            }

            .custom-table-responsive tr td .mobile-th {
                display: inline-block;
                width: 200px;
                flex: 0 0 200px;
                padding: 10px;
                white-space: normal;
                vertical-align: middle;
                border-right: 1px solid #c1c1c1;
                margin-right: 15px;
                background: #f6f6f6;
                font-weight: 600;
                color: #6e6981;
            }

            .custom-table-responsive tr td {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
            }

            .custom-table-responsive tr td {
                padding: 0px;
                white-space: normal;
            }

            .custom-table-responsive tr {
                margin-bottom: 30px;
                border: 1px solid #d5d5d5;
            }
        }

        @media (max-width: 767px) {
            .custom-table-responsive tr td .mobile-th {
                flex: 0 0 100px;
                font-size: 13px;
            }
        }

        @media (max-width: 575px) {
            .custom-table-responsive tr td .mobile-th {
                width: 100%;
                flex: 0 0 100%;
                border-right: 0px;
                margin-right: 0px;
            }

            .custom-table-responsive tr td {
                padding: 10px;
                background: #f6f6f6;
            }

            .custom-table-responsive tr td button {
                margin-top: 10px;
                width: 100%;
            }
        }

        .form-switch {
            margin-right: 10px;
        }

        @media (max-width: 1860px) {
            .horizontal-layout.navbar-floating:not(.blank-page) .app-content {
                padding: calc(6rem + 4.45rem * 2 + 1.3rem) 2rem 0 2rem;
            }
        }

        @media (max-width: 1400px) {
            .dt-action-buttons button {
                font-size: 12px;
                padding: 10px;
                margin: 2px;
            }
        }

        @media (max-width: 1199px) {
            .horizontal-layout.navbar-floating .header-navbar-shadow {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .status_btns .btn-outline-primary {
                width: 49%;
                margin: 1%;
                border-radius: 3px !important;
            }

            .status_btns .btn-group {
                width: 100%;
                flex-wrap: wrap;
            }

            .status_btns {
                margin-bottom: 22px;
            }

            .lead-assign {
                padding: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f3f2f7;
                width: calc(100% - 30px);
                margin-left: 15px;
            }

            .lead-assign > label {
                margin-right: 10px;
                margin-bottom: 0px !important;
            }
        }

        @media (max-width: 575px) {


            div.dataTables_wrapper div.dataTables_filter label, div.dataTables_wrapper div.dataTables_length label {
                width: 100%;
                display: flex;
                align-items: center;
            }

            .dataTables_length {
                width: 100%;
            }

            .dataTables_length .form-select {
                width: auto !important;
                flex: 1;
                margin-right: 0px !important;
            }

            .dt-action-buttons > div {
                width: 100%;
                margin-right: 0px !important;
            }

            .dt-action-buttons > div .form-control {
                flex: 1;
            }

            .dt-action-buttons button {
                width: 100%;
            }
        }

        .custom-table-responsive {
            width: 100%;
            overflow: auto;
        }

        .custom-table-responsive td,
        .custom-table-responsive th {
            padding: 10px 5px;
            white-space: nowrap;
        }

        .custom-table-responsive td .mobile-th {
            display: none;
        }

        .custom-table-responsive th .action {
            min-width: 4500px;
        }

        @media (max-width: 991px) {


            .custom-table-responsive thead {
                display: none;
            }

            .custom-table-responsive tfoot th {
                display: none;
            }

            .custom-table-responsive tr {
                display: flex;
                flex-wrap: wrap;
            }

            .custom-table-responsive tr td .mobile-th {
                display: inline-block;
                width: 200px;
                flex: 0 0 200px;
                padding: 10px;
                white-space: normal;
                vertical-align: middle;
                border-right: 1px solid #c1c1c1;
                margin-right: 15px;
                font-weight: 600;
                color: #6e6981;
                background-color: #f3f2f7;

            }

            .custom-table-responsive tr td {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
            }

            .custom-table-responsive tr td {
                padding: 0px;
                white-space: normal;
            }

            .custom-table-responsive tr {
                margin-bottom: 30px;
                border: 1px solid #d5d5d5;
            }
        }

        @media (max-width: 767px) {
            .custom-table-responsive tr td .mobile-th {
                flex: 0 0 100px;
                font-size: 13px;
            }
        }

        @media (max-width: 575px) {
            .custom-table-responsive tr td .mobile-th {
                width: 100%;
                flex: 0 0 100%;
                border-right: 0px;
                margin-right: 0px;
                margin-bottom: 10px;
            }

            .custom-table-responsive tr td {
                padding: 10px;
                background: #f6f6f6;
            }

            .custom-table-responsive tr td button {
                margin-top: 10px;
                width: 100%;
            }
        }

        .modal .comments {
            height: 100%;
        }

        .modal .comments .user-chats {
            min-height: calc(100vh - 108px);
        }

        .status_btns {
            /*overflow: auto;*/
        }

        div#rendercomments .modal-content {
            padding: 0px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/payment-responsive.css') }}">
    @yield('css')
    @yield('head')
</head>

