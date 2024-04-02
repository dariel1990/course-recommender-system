<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from admin.pixelstrap.com/tivo/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Feb 2023 03:13:05 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('/assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @stack('page-css')
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/datatable-extension.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/color-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/vector-map.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"> </div>
        <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                    </div>
                    <div class="logo-header-main"><a href="{{ url('/') }}"><img
                                class="img-fluid for-light img-100" src="../assets/images/nemsu-logo.png"
                                alt=""><img class="img-fluid for-dark" src="../assets/images/nemsu-logo.png"
                                alt=""></a></div>
                </div>
                <div class="left-header col horizontal-wrapper ps-0">
                    <div class="left-menu-header">
                        <ul class="header-left">

                        </ul>
                    </div>
                </div>
                <div class="nav-right col-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="language-nav"></li>
                        <li class="profile-nav onhover-dropdown">
                            <div class="account-user"><i data-feather="user"></i></div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="{{ route('edit.profile') }}"><i
                                            data-feather="user"></i><span>Account</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('settings.index') }}"><i
                                            data-feather="settings"></i><span>Settings</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i data-feather="log-in"></i><span>Logout</span>
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div>
                    <div class="logo-wrapper"><a href="{{ url('/superadmin') }}"><img class="img-fluid for-light"
                                src="{{ asset('/assets/images/nemsu-logo.png') }}" alt=""
                                width="70%"></a>
                        <div class="back-btn"><i data-feather="grid"></i></div>
                        <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle"
                                data-feather="grid"> </i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="{{ url('/') }}">
                            <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
                        </a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn">
                                    <div class="mobile-back text-end"><span>Back</span><i
                                            class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>
                                <li class="menu-box">
                                    <ul>
                                        {{-- <li class="sidebar-list">
                                            <a class="sidebar-link sidebar-title link-nav" href="/home">
                                                <i data-feather="home"></i><span>Dashboard</span>
                                            </a>
                                        </li> --}}
                                        <li class="sidebar-list">
                                            <a class="sidebar-link sidebar-title link-nav" href="/examinations">
                                                <i data-feather="file-text"></i><span>Examinations</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-list">
                                            <a class="sidebar-link sidebar-title link-nav" href="/students">
                                                <i data-feather="users"></i><span>Registration</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                                                href="javascript:void(0)"><i data-feather="user"></i><span>User
                                                    Management </span></a>
                                            <ul class="sidebar-submenu">
                                                <li><a class="lan-4" href="/users">Users</a></li>
                                            </ul>
                                        </li>
                                        <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                                                href="javascript:void(0)"><i
                                                    data-feather="settings"></i><span>Maintenance </span></a>
                                            <ul class="sidebar-submenu">
                                                <li><a class="lan-4" href="/academic/year">Academic Year</a></li>
                                                <li><a class="lan-4" href="/courses">Courses</a>
                                                </li>
                                                <li><a class="lan-4" href="/question">Questions</a></li>
                                            </ul>
                                        </li>
                                </li>
                            </ul>
                            </li>
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 p-0 footer-left">
                            <p class="mb-0">Copyright © 2023 Course Recommender System. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 p-0 footer-right">
                            <p class="mb-0">Powered by NEMSU Students <i class="fa fa-bolt font-primary"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('/assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/libs/winbox/winbox.bundle.js') }}"></script>
    <!-- Template js-->
    <script src="{{ asset('/assets/js/script.js') }}"></script>
    <!-- login js-->
    <script>
        $(document).ready(function() {
            // Get the CSRF token value from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Set the CSRF token as a default header for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        });
    </script>
    @stack('page-scripts')
</body>

</html>
