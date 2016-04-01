<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/dt-1.10.11,b-1.1.2/datatables.min.css"/>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

    @include('menu')

    <div class="container">

    @yield('content')

    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!-- DataTables -->
    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/t/dt/dt-1.10.11,b-1.1.2/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

    <!-- Submenu -->
    <!-- See http://stackoverflow.com/questions/18023493/bootstrap-3-dropdown-sub-menu-missing -->
    <link href="{{ asset('css/submenu.css') }}" rel="stylesheet">
    {!! Html::script('js/submenu.js') !!}

    {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}

    @stack('scripts')

</body>
</html>
