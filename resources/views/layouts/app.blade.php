<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Start MDBootstrap --}}
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
    {{-- End MDBootstrap --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        * {
            padding: 0;
            margin: 0;
            font-size: 12px;
        }

        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .sc-bottom-bar {
            position: fixed;
            bottom: 0;
            left: 33%;
            right: 33%;
        }

        .center-vertical {
            position: absolute;
            top: 45%;
            left: 50.5%;
            border: 0.1px solid #e3e3e3;
            border-radius: 10px;
            padding: 20px;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div id="app"
        style="background-color: #e3e3e3; background-image: url('https://media.istockphoto.com/id/1248378027/vector/vector-seamless-pattern-with-education-back-to-school-icons-doodle-student-dark-background.jpg?s=612x612&w=0&k=20&c=faIgQ0wy5ssG7W-B6GyeFkNEASh9NSraNhNlpe_gbe8=');">
        <div class="row justify-content-center" style="height: 100vh">
            <div class="col-md-4 border bg-white">
                @yield('content')




                @guest
                @else
                    @include('templates.menubar-footer')
                @endguest
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    @yield('js')
</body>

</html>
