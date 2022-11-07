<!DOCTYPE html >
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @section('title')@show</title>


    {!!Html::style("css/font-awesome.css" )!!}
    {!!Html::style("css/bootstrap.min.css" )!!}
    {!!Html::style("css/sb-admin-2.css" )!!}
    {!!Html::style("css/layout/layout.css" )!!}
    @section('css')
    @show

</head>
<body>

<div id="wrapper">
    <div class="div-layout-title">
        <h3 class="bold layout-title">КОНТРОЛ НА УПОТРЕБАТА</h3>
    </div>
    <nav class="navbar navbar-default navbar-static-top my_top_nav" >
        <!-- Top Navbar -->
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/начало') }}"><i class="fa fa-home fa-fw blue_color"></i> Начало</a></li>
            {{--<li><a href="{!! URL::to( '/земеделци') !!}" class=""> <i class="fa fa-users fa-fw green_color"></i> Всички Земедлески Стопани</a></li>--}}
            <li>
                <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users green_color" aria-hidden="true"></i>
                    &nbsp;Земеделски Стопани &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </a>
                <ul class="dropdown-menu" >
                    <li><a href="{!! URL::to('/земеделци')!!}" class=""> <i class="fa fa-users fa-fw green_color"></i> Всички Земедлески Стопани</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{!! URL::to('/дневници')!!}" class=""> <i class="fa fa-book fa-fw green_color"></i> Заверени Дневници</a></li>
                </ul>
            </li>
            <li>
                <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-address-card-o green_color" aria-hidden="true"></i>
                    &nbsp;Становища &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </a>
                <ul class="dropdown-menu" >
                    <li><a href="{!! URL::to('/становища')!!}" class=""> <i class="fa fa-address-card-o fa-fw green_color"></i> Становища</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{!! URL::to('/становища-стари')!!}" class=""> <i class="fa fa-address-card-o fa-fw old_color"></i> Становища - Стари </a></li>
                </ul>
            </li>

            <li>
                <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-powerpoint-o control_color" aria-hidden="true"></i>
                    &nbsp;Контрол на Употребата &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </a>
                <ul class="dropdown-menu" >
                    <li><a href="{!! URL::to('/протоколи-всички')!!}" class=""> <i class="fa fa-file-powerpoint-o fa-fw control_color"></i> Всички Констативни Протоколи</a></li>
                    <li><a href="{!! URL::to('/протоколи-становища')!!}" class=""> <i class="fa fa-address-card-o fa-fw control_color"></i> Констативни Протоколи - Становища</a></li>
                    <li><a href="{!! URL::to('/протоколи-стопани')!!}" class=""> <i class="fa fa-user fa-fw control_color"></i> Констативни Протоколи - ЗС</a></li>
                    <li><a href="{!! URL::to('/протоколи-дфз')!!}" class=""> <i class="fa fa-money fa-fw control_color"></i> Констативни Протоколи - Съвместно с ДФЗ</a></li>
                    <li><a href="{!! URL::to('/протоколи-други')!!}" class=""> <i class="fa fa-euro fa-fw control_color"></i> Констативни Протоколи - Други плащания</a></li>
                    <li><a href="{!! URL::to('/протоколи-нарушения')!!}" class=""> <i class="fa fa-user-times fa-fw control_color"></i> Констативни Протоколи - С нарушения</a></li>
                    <li><a href="{!! URL::to('/протоколи-проби')!!}" class=""> <i class="fa fa-flask fa-fw control_color"></i> Констативни Протоколи - С взети проби</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{!! URL::to('/стари-протоколи-всички')!!}" class=""> <i class="fa fa-file-powerpoint-o fa-fw old_color"></i> Стари Констативни Протоколи - всички</a></li>
                    <li><a href="{!! URL::to('/стари-протоколи-становища')!!}" class=""> <i class="fa fa-address-card-o fa-fw old_color"></i> Стари Протоколи - Становища</a></li>
                    <li><a href="{!! URL::to('/стари-протоколи-стопани')!!}" class=""> <i class="fa fa-user-times fa-fw old_color"></i> Стари Протоколи - ЗС</a></li>
                    <li><a href="{!! URL::to('/стари-протоколи-дфз')!!}" class=""> <i class="fa fa-money fa-fw old_color"></i> Стари Протоколи - Съвместно с ДФЗ</a></li>
                    <li><a href="{!! URL::to('/стари-протоколи-други')!!}" class=""> <i class="fa fa-euro fa-fw old_color"></i> Стари Протоколи - Други плащания</a></li>
                </ul>
            </li>


            <li>
                <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-registered  red" aria-hidden="true"></i>
                    &nbsp;Месечни справки &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </a>
                <ul class="dropdown-menu" >
                    <li><a href="{!! URL::to('/месечни-справки-зс')!!}" class="my_a back_link"> <i class="fa fa-calendar fa-fw red"></i> Таблица Регистър - Инспекции на ЗС</a></li>
                    <li><a href="{!! URL::to('/месечни-справки-становища')!!}" class="my_a back_link"> <i class="fa fa-address-card-o fa-fw red"></i> Таблица Регистър - Издадени Становища</a></li>
                    <li><a href="{!! URL::to('/месечни-справки-контрол')!!}" class="my_a back_link"> <i class="fa fa-check-circle-o fa-fw red"></i> Таблица Регистър - Контрол на Употребата</a></li>
                    <li><a href="{!! URL::to('/месечни-справки-дфз')!!}" class="my_a back_link"> <i class="fa fa-money fa-fw red"></i> Таблица Регистър - Контрол на ДРЗП</a></li>
                    <li><a href="{!! URL::to('/протоколи-регистър')!!}" class="my_a back_link"> <i class="fa fa-file-powerpoint-o fa-fw red"></i> Таблица Регистър - Констативни Протоколи</a></li>
                </ul>
            </li>
        </ul>
        <!-- Top Navbar -->
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
                            <li><a href="{{ url('/') }}"><i class="fa fa-edit"></i> Лични данни</a></li>
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

{!!Html::script("js/jquery.min.js" )!!}
{!!Html::script("js/bootstrap.min.js" )!!}
@section('scripts')

@show
</body>
</html>