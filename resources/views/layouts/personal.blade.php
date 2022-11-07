<!DOCTYPE html>
<html lang="bg">
<head >

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @section('title')@show</title>

    {!!Html::style("css/font-awesome.css" )!!}
    {!!Html::style("css/bootstrap.min.css" )!!}
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/sb-personal-2.css" )!!}

    {!!Html::style("css/admin/admin_css.css" )!!}
    @section('css')

    @show

    <!--[if lt IE 9]>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="wrapper">
        <div class="admin_panel">
            <h3 class="my_ps bold" >СМЯНА НА ПАРОЛА</h3>
        </div>
        <nav class="navbar navbar-default navbar-static-top my_top_nav" role="navigation" style="margin-bottom: 0">
            <ul class="nav_my navbar-top-links navbar-left">
                <li><a  href="{!!URL::to('/начало')!!}" class="my_a back_link"> <i class="fa fa-home fa-fw"></i> Начало</a></li>
            </ul>

            <ul class="nav navbar-top-links navbar-right">
                {{ Auth::user()->short_name }}
                <li>
                    <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Излез</a>
                </li>
            </ul>

        </nav>

        <div id="page-wrapper">
            @section('message')
            @show
            @yield('content')
        </div>
    </div>

    {!!Html::script("js/jquery.min.js" )!!}
    {!!Html::script("js/bootstrap.min.js" )!!}
    {!!Html::script("js/metisMenu.min.js" )!!}


    @section('scripts')

    @show
</body>

</html>
