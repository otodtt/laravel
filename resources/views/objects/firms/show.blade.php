@extends('layouts.objects')
@section('title')
    {{ 'Данни на фирмата' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/firms_objects/firm_info.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!!URL::to('/фирми')!!}" class="fa fa-bank btn btn-info my_btn"> Всички фирми</a>
        <a href="{!!URL::to('/аптеки')!!}" class="fa fa-plus-circle btn btn-info my_btn"> Всички аптеки</a>
        <a href="{!!URL::to('/складове')!!}" class="fa fa-shield btn btn-info my_btn"> Всички складове</a>
        <a href="{!!URL::to('/workshops')!!}" class="fa fa-cubes btn btn-info my_btn"> Всички цехове</a>
    </div>
    <hr class="my_hr"/>
    <fieldset class="big_field">
        <legend class="big_legend">ДАННИ НА ФИРМАТА</legend>
        @if($lock_permit[0]['lock_permit'] == 0)
            <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="red"> ВНИМАНИЕ!!!</span>
                Използвай само при първоначалното въвеждане в Базата Данни!&nbsp;&nbsp;&nbsp;
            </p>

            <div class="my_btn">
                <a href="{!! URL::to('/аптека/'.$firm->id.'/разрешително-аптека' )!!}" class="fa fa-plus-square btn btn-success my_btn"> Добави Аптека</a> |

                <a href="{!! URL::to('/склад/'.$firm->id.'/разрешително-склад')!!}" class="fa fa-shield btn btn-info my_btn"> Добави Склад</a> |

                <a href="{!! URL::to('/цех/'.$firm->id.'/разрешително-цех')!!}" class="fa fa-cubes btn btn-primary my_btn"> Добави Цех</a>
            </div>
            <hr class="my_hr_in"/>
        @endif
        <div class="row-height-my" style="display: table">
            <div class="small_field_left" style="display: table-cell">
                @include('objects.forms.firm_info_all')
            </div>
            <div class="small_field_right" style="display: table-cell">
                <p class="description"><i class="fa fa-warning red" aria-hidden="true"></i> <span class="red">ВНИМАНИЕ!!!</span>
                    Използвай <span class="bold">"Добави НОВ обект ...."</span>
                    САМО когато фирмата открива нов несъществуващ до сега обект!!!
                    <br>Когато се добавя Удостоверение за съществуващ обект ВИЖ долу!!!</p>
                <hr/>
                <a class="text_add " href="{!!URL::to('/аптека/'.$firm->id.'/ново-удостоверение/')!!}">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i> Добави НОВ обект - АПТЕКА</a><br/>
                <a class="text_add " href="{!!URL::to('/склад/'.$firm->id.'/ново-удостоверение/')!!}">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i> Добави НОВ обект - СКЛАД</a><br/>
                <a class="text_add" href="{!!URL::to('/цех/'.$firm->id.'/ново-удостоверение/')!!}">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i> Добави НОВ обект - ЦЕХ</a><br/>
            </div>
        </div>
        <div class="col-md-12 admin">
            <div class="my_col-md-12 " style="font-family: 'Times New Roman'">
                <span class="bottom"><i class="fa fa-file-text-o green_color" aria-hidden="true"></i> Всички Доклади издадени на Фирмата &nbsp;</span>
                <a class="fa fa-binoculars btn btn-success my_btn" style="float: right" href="{!!URL::to('протоколи-фирма/'.$firm->id.'')!!}"> ВИЖ</a>
                <hr style="clear: both;"/>
                <span class="bottom"><i class="fa fa-file-powerpoint-o red" aria-hidden="true"></i> Констативни Протоколи за Нарушения към Доклади &nbsp;</span>
                <a class="fa fa-binoculars btn btn-danger my_btn" style="float: right" href="{!!URL::to('протоколи-фирма/'.$firm->id.'')!!}"> ВИЖ</a>
                <hr style="clear: both;"/>
                <span class="bottom"><i class="fa fa-file-powerpoint-o blue_color" aria-hidden="true"></i> Констативни Протоколи издадени на Фирмата до 30.06.2023 &nbsp;</span>
                <a class="fa fa-binoculars btn btn-primary my_btn" style="float: right" href="{!!URL::to('протоколи-фирма/'.$firm->id.'')!!}"> ВИЖ</a>
                <hr style="clear: both;"/>

            </div>
        </div>
        <div class="col-md-12 admin">
            <div class="col-md-6 my_col-md-12">
                <a class="change_objects btn btn-primary my_btn" href="/фирма/{{$firm->id}}/промяна-обстоятелства">
                    <i class="fa fa-random " aria-hidden="true"></i> Промяна в обстоятелствата на Фирмата.</a>
            </div>
            <div class="btn-group my_btn-group">
                @if(Auth::user()->admin == 2 )
                    {!!link_to_route('firms.edit', $title = ' Администратор. Редактирай фирмата!', $parameters = $firm->id,
                    $attributes = ['class' =>'fa fa-edit btn btn-danger my_btn'] )!!}
                @endif
            </div>
        </div>
    </fieldset>
    <hr/>
    <hr/>

    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="li_pharmacy">
                @if(empty($pharmacies->toArray()))
                    <a href="{!!URL::to('/фирма/'.$firm->id)!!}"><i class="fa fa-plus-square fa-fw"></i>
                        <span class="bold">А П Т Е К И - Фирмата Няма регистрирани аптеки.</span>
                        <span class="fa arrow"></span>
                    </a>
                @else
                    <a href="{!!URL::to('/фирма/'.$firm->id)!!}"><i class="fa fa-plus-square fa-fw"></i>
                        <span class="bold">А П Т Е К И</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            @include('objects.firms.body.pharmacies')
                        </li>
                    </ul>
                @endif
            </li>
            <li class="li_repository">
                @if(empty($repositories->toArray()))
                    <a href="{!!URL::to('/фирма/'.$firm->id)!!}"><i class="fa fa-shield fa-fw"></i>
                        <span class="bold">СКЛАДОВЕ - Фирмата Няма регистрирани складове.</span>
                        <span class="fa arrow"></span>
                    </a>
                @else
                    <a href="{!!URL::to('/фирма/'.$firm->id)!!}"><i class="fa fa-shield fa-fw"></i>
                        <span class="bold">СКЛАДОВЕ</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            @include('objects.firms.body.repositories')
                        </li>
                    </ul>
                @endif
            </li>
            <li class="li_workshop">
                @if(empty($workshops->toArray()))
                    <a href="{!!URL::to('/фирма/'.$firm->id)!!}"><i class="fa fa-cubes fa-fw"></i>
                        <span class="bold">ЦЕХОВЕ - Фирмата Няма регистрирани цехове.</span>
                        <span class="fa arrow"></span>
                    </a>
                @else
                    <a href="{!!URL::to('/фирма/'.$firm->id)!!}"><i class="fa fa-cubes fa-fw"></i>
                        <span class="bold">ЦЕХОВЕ</span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            @include('objects.firms.body.workshops')
                        </li>
                    </ul>
                @endif
            </li>
        </ul>
    </div>
@endsection

@section('scripts')
    {!! Html::script("js/metisMenu.min.js" ) !!}
    {!! Html::script("js/sb-admin-2.js" ) !!}
@endsection