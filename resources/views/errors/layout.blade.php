<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('user/images/favicon.ico') }}">

    <title>{{ config('app.name') }} | Error</title>

    <link href="{{ asset('/user/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/user/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/user/css/style.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('/user/js/modernizr.min.js') }}"></script>

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>

<div class="wrapper-page">
    @yield('content')
</div>

<!-- jQuery  -->
<script src="{{ asset('/user/js/jquery.min.js') }}"></script>
<script src="{{ asset('/user/js/popper.min.js') }}"></script> <!-- Popper for Bootstrap -->
<script src="{{ asset('/user/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/user/js/waves.js') }}"></script>
<script src="{{ asset('/user/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('/user/js/jquery.scrollTo.min.js') }}"></script>


<!-- App js -->
<script src="{{ asset('/user/js/jquery.core.js') }}"></script>
<script src="{{ asset('/user/js/jquery.app.js') }}"></script>

</body>
</html>