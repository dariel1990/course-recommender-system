<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from admin.pixelstrap.com/tivo/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Feb 2023 03:15:42 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="tivo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Tivo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <link rel="icon" href="{{ asset('/assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/color-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/responsive.css') }}">
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"> </div>
        <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light" width="180px"
                                    src="{{ asset('/assets/images/NEMSU.png') }}" alt="looginpage"></a></div>
                        <div class="login-main">
                            <p>Congrats for finishing the exam! You can now proceed to the admin for printing of your
                                exam
                                result. Thank you!</p>
                            <a class="btn btn-primary" href="{{ route('examination.page') }}">Go back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ asset('/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
        <script src="{{ asset('/assets/js/config.js') }}"></script>
        <script src="{{ asset('/assets/js/script.js') }}"></script>
    </div>
</body>

</html>
