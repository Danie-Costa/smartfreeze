<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        .form-signin {
            max-width: 480px;
            padding: 15px;
            margin: auto;
        }
        * {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            box-sizing: border-box;
        }

        .clear {
            clear: both;
        }

        body {
            font-size: 1.4rem;
            color: #ffffff;
            font-family: "DM Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }

        html {
            scroll-behavior: smooth;
          }
          .bg-faixa{
            background: #151C47;
          }
          
        .mh-400{max-height:400px; width: auto;}
        .hide-mobile{display:block}
        @media (max-width: 640px) {
            .mh-400{max-height:200px; width: auto;}
            .hide-mobile{display:none !important}
        }
    </style>
</head>
<body>
    <div class="container-fluid">

    <div class="row vh-100">
        <div class="col-12 col-sm-6 d-flex justify-content-center align-items-center "><img src="{{ asset('storage/login.png') }}" class="img-fluid mh-400"></div>
        <div class="col-12 col-sm-6 bg-faixa d-flex">
                <form method="POST" class="form-signin" id="loginForm" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1 class="h3 mb-3 font-weight-normal">Login</h1>
                    <label for="inputEmail" class="sr-only">Email address</label>
                <input name="email" type="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" required="" autofocus="">
                
                <label for="inputPassword" class="sr-only">Password</label>
                <input  name="password" type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                <button class="btn btn-lg btn-warning btn-block"  id="recoverPassword" type="button">Recuperar a Senha</button>
                <div id="alertContainer" class=" py-3"></div>
            </form>
                
        </div>
        
    </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        feather.replace()
    </script>
    @yield('js')
    @if (session('success'))
        <script>
            Swal.fire({
                title: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif

</body>
</html>
