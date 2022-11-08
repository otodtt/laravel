<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ODBH</title>

    <!-- Fonts -->
    {!!Html::style("css/font-awesome.css" )!!}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    {!!Html::style("css/bootstrap.min.css" )!!}
    <style>
        body {
            /*font-family: 'Lato';*/
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header" style="text-align: center">
            <?php ?>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                ОДБХ - <span style="text-transform: uppercase">{{$name_od[0]['odbh_city']}}</span> - ОТДЕЛ "РАСТИТЕЛНА ЗАЩИТА"
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                @else
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

        <!-- JavaScripts -->
    {!!Html::script("js/jquery.min.js" )!!}
    {!!Html::script("js/bootstrap.min.js" )!!}
</body>
</html>
