@extends('layouts.farmers')
@section('title')
    {{ 'Данни на Земеделския Стопанин' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/farmers/farmer_info.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/земеделци')!!}" class="fa fa-users btn btn-success my_btn"> Всички Земеделски Стопани</a>
        <a href="{!! URL::to('/становища')!!}" class="fa fa-address-card-o btn btn-success my_btn"> Всички Становища</a>
        <a href="{!! URL::to('/становища-стари')!!}" class="fa fa-address-card-o btn btn-warning my_btn"> Всички Стари Становища</a>
        <a href="{!! URL::to('/дневници')!!}" class="fa fa-book btn btn-primary my_btn"> Всички Заверени Дневници</a>
    </div>
    <hr class="my_hr"/>
    <fieldset class="big_field">
        <legend class="big_legend">ДАННИ НА ЗЕМЕДЕЛСКИЯ СТОПАНИН</legend>
        <div class="row-height-my" style="display: table">
            <div class="small_field_left" style="display: table-cell">
                @include('farmers.forms.farmer_info')
            </div>
            <div class="small_field_right" style="display: table-cell">
                <div class="col-md-12 my_col-md-12 border_bottom">
                    <a href="{!! URL::to('/добави/становище/'.$farmer->id.'/1' )!!}" class='fa fa-address-card-o btn btn-success my_btn'> ДОБАВИ СТАНОВИЩЕ!</a>
                </div>
                <div class="col-md-12 my_col-md-12 border_bottom middle">
                    <a href="{!! URL::to('/протокол-добави/'.$farmer->id )!!}" class='fa fa-file-powerpoint-o btn btn-primary my_btn'> ДОБАВИ КОНСТАТИВЕН ПРОТОКОЛ!</a>
                </div>
                <div class="col-md-12 my_col-md-12 middle">
                    <a href="{!! URL::to('/въздушни/добави/'.$farmer->id )!!}" class='fa fa-plane btn btn-info my_btn'> ДОБАВИ РАЗРЕШИТЕЛНО - ВЪЗДУШНО!</a>
                </div>
            </div>
        </div>
        <div class="row-height-my">
            <a href="{!! URL::to('/стопанин/'.$farmer->id.'/редактирай' )!!}" class='fa fa-edit btn btn-danger my_btn'> Редактирай!</a>
        </div>
    </fieldset>
    <hr/>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">ЗАВЕРКА НА ДНЕВНИК ЗА ПХО</h3>
                </div>
                <div class="panel-body">
                    @include('farmers.forms.diary')
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="li_pharmacy">
                @if(!empty($old_opinions->toArray()) || !empty($opinions->toArray()))
                    <a href="{!!URL::to('/стопанин/'.$farmer->id)!!}"><i class="fa fa-address-card-o fa-fw"></i>
                        <span class="bold">С Т А Н О В И Щ А</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            @include('farmers.body.opinions')
                        </li>
                    </ul>
                @endif
            </li>

            @if(!empty($protocols->toArray()) || !empty($old_protocols->toArray()))
                <?php
                    $has_farmer = array();
                    $has_fond = array();
                    $has_other = array();
                    $has_farmer_old = array();
                    $has_fond_old = array();
                    $has_other_old = array();
                    foreach($protocols as $protocol){
                        if($protocol->check_type == 1){
                            $has_farmer[] = 1;
                        }
                        ////
                        if($protocol->check_type == 2){
                            $has_fond[] = 1;
                        }
                        ////
                        if($protocol->check_type == 3){
                            $has_other[] = 1;
                        }
                    }
                    foreach($old_protocols as $old_protocol){
                        if($old_protocol->check_type == 1){
                            $has_farmer_old[] = 1;
                        }
                        ////
                        if($old_protocol->check_type == 2){
                            $has_fond_old[] = 1;
                        }
                        ////
                        if($old_protocol->check_type == 3){
                            $has_other_old[] = 1;
                        }
                    }
                ?>
                @if(count($has_farmer) > 0 || count($has_farmer_old) > 0)
                    <li class="li_repository">
                        <a href="{!!URL::to('/стопанин/'.$farmer->id)!!}"><i class="fa fa-file-powerpoint-o fa-fw"></i>
                            <span class="bold">КОНСТАТИВНИ ПРОТОКОЛИ - Проверки на Земеделски стопани</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                @include('farmers.body.protocols_farmers')
                            </li>
                        </ul>
                    </li>
                @endif
                @if(count($has_fond) > 0 || count($has_fond_old) > 0)
                    <li class="li_repository">
                        <a href="{!!URL::to('/стопанин/'.$farmer->id)!!}"><i class="fa fa-money fa-fw"></i>
                            <span class="bold">КОНСТАТИВНИ ПРОТОКОЛИ - Съвместо с ДФЗ</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                @include('farmers.body.protocols_fond')
                            </li>
                        </ul>
                    </li>
                @endif
                @if(count($has_other) > 0 || count($has_other_old) > 0)
                    <li class="li_repository">
                        <a href="{!!URL::to('/стопанин/'.$farmer->id)!!}"><i class="fa fa-euro fa-fw"></i>
                            <span class="bold">КОНСТАТИВНИ ПРОТОКОЛИ - Държавни плащания</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                @include('farmers.body.protocols_others')
                            </li>
                        </ul>
                    </li>
                @endif
            @else
            @endif
            @if(!empty($permits->toArray()))
                    <li class="li_repository">
                        <a href="{!!URL::to('/стопанин/'.$farmer->id)!!}"><i class="fa fa-plane fa-fw"></i>
                            <span class="bold">ИЗДАДЕНИ РАЗРЕШИТЕЛНИ ЗА ВЪДУШНО ТРЕТИРАНЕ</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                @include('farmers.body.air')
                            </li>
                        </ul>
                    </li>
            @endif
            @if(!empty($diaries->toArray()))
                <li class="li_repository">
                    <a href="{!!URL::to('/стопанин/'.$farmer->id)!!}"><i class="fa fa-book fa-fw"></i>
                        <span class="bold">ЗАВЕРЕНИ ДНЕВНИЦИ</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            @include('farmers.body.diary')
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!! Html::script("js/metisMenu.min.js" ) !!}
    {!! Html::script("js/sb-admin-2.js" ) !!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection