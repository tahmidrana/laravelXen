<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Xenon Boostrap Admin Panel"/>
    <meta name="author" content=""/>

    <title>@yield('title')</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts/linecons/css/linecons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/xenon-core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/xenon-forms.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/xenon-components.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/xenon-skins.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/js/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!--  Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
    <style media="screen">
        .sidebar-menu .logo-env {
            padding: 24px 40px;
            border-bottom: 1px solid #313437;
        }
    </style>
    <style>
        .sidebar-menu {
            width: 280px;
        }
    </style>
</head>
<body class="page-body">


<div class="settings-pane">

    <a href="#" data-toggle="settings-pane" data-animate="true">
        &times;
    </a>

    <div class="settings-pane-inner">

        <div class="row">

            <div class="col-md-4">

                <div class="user-info">

                    <div class="user-image">
                        <a href="extra-profile.html">
                            <img src="assets/images/user-2.png" class="img-responsive img-circle" />
                        </a>
                    </div>

                    <div class="user-details">

                        <h3>
                            <a href="extra-profile.html">
                                @if(Auth::user())
                                {{ Auth::user()->getFullName() }}
                                @else
                                Anonymous
                                @endif
                            </a>

                            <!-- Available statuses: is-online, is-idle, is-busy and is-offline -->
                            <span class="user-status is-online"></span>
                        </h3>

                        <p class="user-title">
                        @if(Auth::user())
                            @if(Auth::user()->is_superuser())
                                Super User
                            @else
                               {{ Auth::user()->role->name }}
                            @endif
                        @else
                        Anonymous
                        @endif
                        </p>

                        <div class="user-links">
                            <a href="extra-profile.html" class="btn btn-primary">Edit Profile</a>
                            <a href="extra-profile.html" class="btn btn-success">Upgrade</a>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-8 link-blocks-env">

            </div>

        </div>

    </div>

</div>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
    <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
    <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
    @include('inc/left_nav')
    

    <div class="main-content">

        @include('inc.top_nav')

        @yield('content')

        @include('inc.footer')
    </div>
</div>


    <!-- Page Loading Overlay -->
    <div class="page-loading-overlay">
        <div class="loader-2"></div>
    </div>



<!-- Bottom Scripts -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/js/resizeable.js') }}"></script>
    <script src="{{ asset('assets/js/joinable.js') }}"></script>
    <script src="{{ asset('assets/js/xenon-api.js') }}"></script>
    <script src="{{ asset('assets/js/xenon-toggles.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('assets/js/xenon-widgets.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/devexpress-web-14.1/js/globalize.min.js') }}"></script>
    <script src="{{ asset('assets/js/devexpress-web-14.1/js/dx.chartjs.js') }}"></script> -->
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/multiselect/js/jquery.multi-select.js') }}"></script>

    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="{{ asset('assets/js/xenon-custom.js') }}"></script>

    @yield('scripts')
</body>
</html>
