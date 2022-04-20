<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    @yield('css')
    <!-- SB Admin CSS - Include with every page -->
    <link href="{{ asset('front/css/sb-admin.css') }}" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            @include('front.partial.navabar-header')
            @include('front.partial.navabar-right')
            @include('front.partial.navabar-menu')
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="{{ asset('front/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    @yield('js')
    <!-- SB Admin Scripts - Include with every page -->
    <script src="{{ asset('front/js/sb-admin.js') }}"></script>


</body>

</html>
