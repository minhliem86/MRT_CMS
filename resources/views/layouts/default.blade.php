<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="css/style.css">-->
    <title>Marketing Tool</title>
</head>
<body>
    <div class="page-container">
        @include('layouts.header')
        <section class="content">
            @yield('content')
        </section>
        @include('layouts.footer')
    </div>

    <script src="{{asset('public/assets')}}/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="{{asset('public/assets')}}/plugins/js/bootstrap.min.js"></script>

    <!-- DATATABLE -->
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/dataTable/datatables.min.css">
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/dataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <script src="{{asset('public/assets')}}/plugins/dataTable/datatables.min.js"></script>
    <script src="{{asset('public/assets')}}/plugins/dataTable/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <!-- DATE PICKER -->
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/datepicker/css/bootstrap-datepicker3.min.css">
    <script src="{{asset('public/assets')}}/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>

    @yield('script')

</body>
</html>