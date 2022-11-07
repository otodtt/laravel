@extends('layouts.farmers')
@section('title')
    {{ 'Всички Земеделски Стопани' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/farmers/table_farmers.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ВСИЧКИ ЗЕМЕДЕЛСКИ СТОПАНИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa fa-users btn btn-default my_btn"> Всички Земеделски Стопани</span>
        <a href="{!! URL::to('/становища')!!}" class="fa fa-address-card-o btn btn-success my_btn"> Всички Становища</a>
        <a href="{!! URL::to('/становища-стари')!!}" class="fa fa-address-card-o btn btn-warning my_btn"> Всички Стари Становища</a>
        <a href="{!! URL::to('/дневници')!!}" class="fa fa-book btn btn-primary my_btn"> Всички Заверени Дневници</a>
    </div>
    {{--<div class="btn_add_firm">--}}
        {{--<a href="{!!URL::to('/фирми/create')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави НОВА фирма</a>--}}
    {{--</div>--}}
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div  id="sort_miar_wrap"  >
                    {!! Form::open(['url'=>'/земеделци/сортирай', 'method'=>'POST']) !!}
                        <?php
                        if(Input::has('abc') ){
                            $abc_sel = Input::get('abc');
                            $sorting = Input::get('sort');
                            $sorting_firm = Input::get('sort_firm');
                        }
                        else{
                            $abc_sel = $abc;
                            if(isset($sort)){
                                $sorting = $sort;
                                $sorting_firm = $sort_firm;
                            }
                            else{
                                $sorting = Input::get('sort');
                                $sorting_firm = Input::get('sort_firm');
                            }
                        }
                        ?>
                        {!! Form::label('sort', 'Стопанство в община:') !!}
                        {!! Form::select('sort',$districts_list, $sorting , ['id'=>'sorts', 'class'=>'form-control form-control-my-search']) !!}

                        {!! Form::label('sort_firm', 'Сортирай по:') !!}
                        {!! Form::select('sort_firm', [0=>'Вид на ЧЗС/Фирма', 1=>'ЧЗС', 2=>'ЕТ', 3=>'ООД', 4=>'ЕООД', 5=>'АД', 6=>'КООПЕРАЦИЯ']
                        , $sorting_firm , ['id'=>'sorts', 'class'=>'form-control form-control-my-search']) !!}

                        {!! Form::hidden('_token', csrf_token() ) !!}
                        {!! Form::hidden('abc', $abc_sel )!!} &nbsp;
                        {!! Form::submit('Сортирай!',['class'=>'fa btn btn-success my_btn']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>
    @include('farmers.index.alphabet')
    <div class="refresh">
        <a href="{{ url('/земеделци') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('farmers.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/farmers/farmersTable.js" )!!}
@endsection