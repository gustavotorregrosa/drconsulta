<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="dominio" content="{{ url('/') }}">
    <title>Dr Consulta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- <link href="https://unpkg.com/tabulator-tables@4.2.7/dist/css/tabulator.min.css" rel="stylesheet"> -->
    <link href="{{ asset('css/tabulator_semantic-ui.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d3bbd26013.js"></script>
</head>

<body>
    <header>
        <nav class="indigo darken-4">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo">Dr Consulta</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main>
        <div style="margin-top: 5em;" class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    @yield('java-script-adicional')


</body>

</html>