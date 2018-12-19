<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('backend/css/material-dashboard.css') }}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('backend/demo/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.min.css')}}">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>
<body>
    <div id="app">
        <div class="wrapper">
            @if(Request::is('arch*'))
                @include('layouts.partials.sidebar')
            @endif
            <div class="main-panel">
                @if(Request::is('arch*'))
                    @include('layouts.partials.topbar')
                @endif
                    @yield('content')
                @if(Request::is('arch*'))
                    @include('layouts.partials.footer')
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!--   Core JS Files   -->
    <script src="{{ asset('backend/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
    <!--  PerfectScrollbar Library -->
    <script src="{{ asset('backend/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('backend/js/plugins/bootstrap-notify.js') }}"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('backend/js/material-dashboard.js') }}"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('backend/demo/demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>

    @stack('scripts')
</body>
</html>
