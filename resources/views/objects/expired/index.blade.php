@extends('layouts.objects')
@section('title')
    {{ 'С изтекъл или прекратен срок' }}
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
        <h4 class="bold layout-title">ОБЕКТИ С ИЗТЕКЪЛ СРОК НА РАЗРЕШИТЕЛНО И ПРЕКРАТЕН СРОК НА УДОСТОВЕРЕНИЕ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!!URL::to('/фирми')!!}" class="fa fa-bank btn btn-info my_btn"> Всички фирми</a>
        <a href="{!!URL::to('/аптеки')!!}" class="fa fa-plus-square btn btn-info my_btn"> Всички аптеки</a>
        <a href="{!!URL::to('/складове')!!}" class="fa fa-shield btn btn-info my_btn"> Всички складове</a>
        <a href="{!!URL::to('/цехове')!!}" class="fa fa-cubes btn btn-info my_btn"> Всички цехове</a>
        <span class="fa fa-times btn btn-default my_btn"> С изтекъл или прекратен срок</span>
    </div>
    <hr/>
    @include('objects.expired.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/expiredTable.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
@endsection