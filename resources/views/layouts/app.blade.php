<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>APP - ASIA MANDIRI</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    {{-- Start MDBootstrap --}}
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="{{ asset('assets/mdb.min.css') }}" rel="stylesheet" />
    {{-- End MDBootstrap --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        * {
            padding: 0;
            margin: 0;
            font-size: 12px;
            letter-spacing: 0.03em;
            font-family: Arial, Helvetica, sans-serif;
        }

        html,
        body {
            max-width: 100%;
            overflow: unset;
            margin: 0;
            line-height: inherit;
            height: 100%;
        }

        #wrapper {
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            background-color: #e8f0fe !important;
        }

        .btn-menubar {
            display: flex;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            --tw-text-opacity: 1;
            color: rgba(30, 136, 229, var(--tw-text-opacity));
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            width: auto;
            border-style: none;
            padding: 0.75rem;
            background-color: rgba(0, 0, 0, 0);
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .menubar-footer {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            margin-top: 0px;
            margin-bottom: 0px;
            max-width: 100%;
            --tw-bg-opacity: 1;
            background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
            width: 480px;
            margin: 0rem auto;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .navbar-wrap {
            --tw-bg-opacity: 1;
            background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
            --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            display: block;
            position: fixed;
            max-width: 100%;
            width: 480px;
            margin-left: auto;
            margin-right: auto;
            left: 0px;
            right: 0px;
            bottom: 0px;
            z-index: 10;
            border-style: solid;
            border-width: 1px 0px 0px;
            --tw-border-opacity: 1;
            border-color: rgba(224, 224, 224, var(--tw-border-opacity));
        }

        .body-wrap {
            background: rgb(255, 255, 255);
            width: 480px;
            max-width: 100%;
            margin: 0px auto;
            min-height: 100%;
            border: .5px solid #e3e3e3;
        }

        .body {
            display: flex;
            flex-direction: column;
            flex: 1 1 0%;
        }

        .body-header {
            background: #333333;
            padding: 5px;
            position: fixed;
            width: 480px;
            max-width: 100%;
            z-index: 99;
        }

        .body-header-content {
            color: #fff;
            text-align: center;
            margin: 7px 0px;
        }

        .body-content {
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
            flex-direction: column;
            /* padding: 0px 16px; */
            padding-top: 15px
        }

        body {
            /* background-image: url('https://www.linkpicture.com/q/background_37.jpg'); */
            /* background-repeat: no-repeat; */
            background-size: cover;
        }

        .container {
            padding-left: 0px;
            padding-right: 0px;
        }

        #load-more {
            transition: background-color 0.2s ease-in-out, font-size 0.2s ease-in-out;
        }

        #load-more:hover {
            background-color: #169c49 !important;
            transition: background-color 0.2s ease-in-out;
            cursor: pointer;
            font-weight: bold;
        }

        .own-btn:hover {
            background-color: #333333 !important;
            transition: background-color 0.2s ease-in-out;
            cursor: pointer;
            font-weight: bold;
        }
    </style>

    @yield('css')
</head>

<body>
    <div id="wrapper">
        <div class="body-wrap">
            <div class="body">
                @include('templates.header')
                <div class="body-content" style="margin-top: 25px">
                    @yield('content')
                </div>
            </div>
        </div>
        @guest
        @else
            @include('templates.menubar-footer')
        @endguest
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('assets/mdb.min.js') }}"></script>

    {{-- JQUERY --}}
    <script src="{{ asset('assets/jquery-3.6.3.min.js') }}"></script>
    
    <script src="{{ asset('assets/sweetalert.min.js') }}"></script>
    @yield('js')
    <script type="text/javascript">
        @if (Session::has('success'))
            swal({
                title: "Berhasil!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                button: "Ok",
            });
        @endif

        @if (Session::has('error'))
            swal({
                title: "Gagal!",
                text: "{{ Session::get('error') }}",
                icon: "warning",
                button: "Ok",
            });
        @endif

        $('.show_pass').click(function() {
            const name = $(this).data('name'); // name element should be data-name
            const type = $(`input[name="${name}"]`).attr('type');

            if (type == 'text') {
                $(`input[name="${name}"]`).attr('type', 'password') // class name should be data-name
            } else {
                $(`input[name="${name}"]`).attr('type', 'text')
            }
        });

        $('#password-generate').click(function() {
            let username = $('#name').val();
            let string = btoa(username);
            let password = generateRandomString(10) + string;

            $('#password').val(password)
            $('#password-confirm').val(password)
        })

        function generateRandomString(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }

            return result;
        }
    </script>
</body>

</html>
