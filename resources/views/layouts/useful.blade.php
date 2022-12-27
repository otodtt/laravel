<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @section('title')@show</title>

    <!-- Fonts -->
    {!!Html::style("css/font-awesome.css" )!!}
            <!-- Styles -->
    {!!Html::style("css/bootstrap.min.css" )!!}
    {!!Html::style("css/sb-admin-2.css" )!!}
    {!!Html::style("css/layout/layout.css" )!!}
    {!!Html::style("css/layout/kppz.css" )!!}
    @section('css')

    @show
</head>
<body id="wrapper">
<nav class="navbar navbar-default navbar-static-top my_top_nav">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
        <li><a href="{{ url('/начало') }}"><i class="fa fa-home fa-fw blue_color"></i> Начало</a></li>
        <li>
            <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info dark_color" aria-hidden="true"></i>
                &nbsp;ПОЛЕЗНО &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" >
                <li><a href="{!! URL::to( '/полезно/регламенти') !!}" class="my_a back_link"> <i class="fa fa-euro fa-fw "></i> Регламенти</a></li>
                <li><a href="{!! URL::to( '/полезно/закони') !!}" class="my_a back_link"> <i class="fa fa-balance-scale fa-fw "></i> Закони</a></li>
                <li><a href="{!! URL::to( '/полезно/наредби') !!}" class="my_a back_link"> <i class="fa fa-gavel fa-fw "></i> Наредби</a></li>

                <li role="separator" class="divider"></li>
                <li><a class="my_a back_link" href="{!! URL::to( 'полезно/заявления') !!}"><i class="fa fa-pencil-square-o fa-fw "></i> Заявления</a></li>
                <li><a class="my_a back_link" href="{!! URL::to( 'полезно/декларации') !!}"> <i class="fa fa-pencil-square-o fa-fw "></i> Декларации</a></li>
                <li><a class="my_a back_link" href="{!! URL::to( 'полезно/въздушни') !!}"> <i class="fa fa-pencil-square-o fa-fw "></i> Въздушни</a></li>
                <li><a class="my_a back_link" href="{!! URL::to( 'полезно/процедури') !!}"> <i class="fa fa-pencil-square-o fa-fw "></i> Процедури</a></li>
                <li><a class="my_a back_link" href="{!! URL::to( 'полезно/други') !!}"> <i class="fa fa-pencil-square-o fa-fw "></i> Други</a></li>
            </ul>
        </li>
    </ul>
    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Влез</a></li>
        @else
            @if(Auth::user()->admin == 2 )
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->short_name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Излез</a></li>
                        <li><a href="{{ url('/админ') }}"><i class="fa fa-btn fa-sign-out"></i> Админ панел</a></li>
                    </ul>
                </li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->short_name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Излез</a></li>
                        <li><a href="{{ url('/парола/'.Auth::user()->id) }}"><i class="fa fa-key"></i> Смяна на парола</a></li>
                    </ul>
                </li>
            @endif
        @endif
    </ul>
</nav>

<div id="wrapper_section" style="width: 100%; margin: auto">
    @section('message')
    @show

    @yield('content')
</div>
</div>
<!-- JavaScripts -->
{!!Html::script("js/jquery.min.js" )!!}
{!!Html::script("js/bootstrap.min.js" )!!}
@section('scripts')
@show
</body>
</html>
