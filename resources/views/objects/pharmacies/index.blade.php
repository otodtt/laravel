@extends('layouts.objects')
@section('title')
    {{ 'Всички аптеки' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ВСИЧКИ АПТЕКИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!!URL::to('/фирми')!!}" class="fa fa-bank btn btn-info my_btn"> Всички фирми</a>
        <span class="fa fa-plus-square btn btn-default my_btn"> Всички аптеки</span>
        <a href="{!!URL::to('/складове')!!}" class="fa fa-shield btn btn-info my_btn"> Всички складове</a>
        <a href="{!!URL::to('/цехове')!!}" class="fa fa-cubes btn btn-info my_btn"> Всички цехове</a>
        <a href="{!!URL::to('/изтекъл-срок')!!}" class="fa fa-times btn btn-info my_btn"> С изтекъл или прекратен срок</a>
    </div>
    <hr/>
    @if(isset($pharmacies))
        <fieldset class="form-group">
            <div class="wrap_sort">
                <div id="wr_choiz_all">
                    <div  id="sort_miar_wrap"  >
                        {!! Form::open(array('url'=>'/аптеки/сортирай', 'method'=>'POST')) !!}
                        @include('objects.pharmacies.index.sorting')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </fieldset>
        <hr/>

        @include('objects.pharmacies.index.alphabet')
        <div class="refresh">
            <a href="{{ url('/аптеки') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
        </div>
        <hr/>
    @endif
    @include('objects.pharmacies.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/pharmaciesTable.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
@endsection