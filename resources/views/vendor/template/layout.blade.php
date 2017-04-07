<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Escola de desenvolvedores.">
    <meta name="author" content="Devyzi">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

    <title>Consulta CNPJs</title>

    @yield('style-sheets')
</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    @yield('top-bar')
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    @yield('left-menu')
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                @yield('page-title')

                @yield('container')

                <!--<div style="min-height: 1000px;"></div>-->


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            © 2017. All rights reserved.
        </footer>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <!-- Right Sidebar -->
    @yield('right-menu')
    <!-- /Right-bar -->

</div>
<!-- END wrapper -->

@yield('script')

</body>
</html>