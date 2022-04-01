<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('user/images/favicon.ico') }}">

    <title>{{ config('app.name') }} | Error</title>

    <link rel="stylesheet" href="{{URL::TO('assets/css/bootstrap.min.css')}}">
		
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{URL::TO('assets/css/font-awesome.min.css')}}">
    
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{URL::TO('assets/css/line-awesome.min.css')}}">
    
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{URL::TO('assets/css/dataTables.bootstrap4.min.css')}}">
    
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{URL::TO('assets/css/select2.min.css')}}">
    
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{URL::TO('assets/css/bootstrap-datetimepicker.min.css')}}">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{URL::TO('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>

<div class="wrapper-page">
    @yield('content')
</div>

<!-- jQuery -->
<script src="{{URL::TO('assets/js/jquery-3.2.1.min.js')}}"></script>

<!-- Bootstrap Core JS -->
<script src="{{URL::TO('assets/js/popper.min.js')}}"></script>
<script src="{{URL::TO('assets/js/bootstrap.min.js')}}"></script>

<!-- Slimscroll JS -->
<script src="{{URL::TO('assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- Select2 JS -->
<script src="{{URL::TO('assets/js/select2.min.js')}}"></script>

<!-- Datetimepicker JS -->
<script src="{{URL::TO('assets/js/moment.min.js')}}"></script>
<script src="{{URL::TO('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

<!-- Datatable JS -->
<script src="{{URL::TO('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::TO('assets/js/dataTables.bootstrap4.min.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js" integrity="sha256-mpnrJ5DpEZZkwkE1ZgkEQQJW/46CSEh/STrZKOB/qoM=" crossorigin="anonymous"></script>


<!-- Custom JS -->
<script src="{{URL::TO('assets/js/app.js')}}" defer></script>

</body>
</html>