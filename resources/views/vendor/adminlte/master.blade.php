<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
    @yield('title', config('adminlte.title', 'AdminLTE 2'))
    @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <!-- Toastr style -->
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    
    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    @endif

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<script src = "{{URL::asset('js/bootbox.min.js') }}"></script> 
<script src = "{{URL::asset('js/ModalAJAX.js') }}"></script>
<script src = "{{URL::asset('js/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "newestOnTop": true,
        "progressBar": true
    }
</script>
@if(Session::has('success')) 
    <script>
        toastr['success']("{!!session('success')!!}");
    </script>
@endif

@if(Session::has('info')) 
<script>
    toastr['info']("{!!session('info')!!}");
</script>
@endif

@if(Session::has('warning')) 
<script>
    toastr['warning']("{!!session('warning')!!}");
</script>
@endif

@if(Session::has('error')) 
<script>
    toastr['error']("{!!session('error')!!}");
</script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endif

@yield('adminlte_js')

</body>
</html>
