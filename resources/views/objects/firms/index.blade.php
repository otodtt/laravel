@extends('layouts.objects')
@section('title')
    {{ 'Всички Фирми' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ВСИЧКИ ФИРМИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa fa-bank btn btn-default my_btn"> Всички фирми</span>
        <a href="{!! URL::to('/аптеки')!!}" class="fa fa-plus-square btn btn-info my_btn"> Всички аптеки</a>
        <a href="{!! URL::to('/складове')!!}" class="fa fa-shield btn btn-info my_btn"> Всички складове</a>
        <a href="{!! URL::to('/цехове')!!}" class="fa fa-cubes btn btn-info my_btn"> Всички цехове</a>
        <a href="{!!URL::to('/изтекъл-срок')!!}" class="fa fa-times btn btn-info my_btn"> С изтекъл или прекратен срок</a>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/фирми/create')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави НОВА фирма</a>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div  id="sort_miar_wrap"  >
                    {!! Form::open(['url'=>'/фирми/сортирай', 'method'=>'POST']) !!}
                        <?php
                            if(Input::has('abc') ){
                                $abc_sel = Input::get('abc');
                                $sorting = Input::get('sort');
                            }
                            else{
                                $abc_sel = $abc;
                                if(isset($sort)){
                                    $sorting = $sort;
                                }
                                else{
                                    $sorting = Input::get('sort');
                                }
                            }
                        ?>
                        {!! Form::label('sort', 'Фирми регистрирани в:') !!}
                        {!! Form::select('sort',$districts_list, $sorting , ['id'=>'sorts', 'class'=>'form-control form-control-my-search']) !!}
                        {!! Form::hidden('_token', csrf_token() ) !!}
                        {!! Form::hidden('abc', $abc_sel )!!} &nbsp;
                        {!! Form::submit('Сортирай!',['class'=>'fa btn btn-success my_btn']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>
    @include('objects.firms.index.alphabet')
    <div class="refresh">
        <a href="{{ url('/фирми') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('objects.firms.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/firmsTable.js" )!!}
@endsection