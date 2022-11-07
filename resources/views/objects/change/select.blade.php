@extends('layouts.objects')
@section('title')
    {{ 'Промяна в Обстоятелствата - Избреи!' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
    {!!Html::style("css/firms_objects/select.css" )!!}
@endsection


@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
<hr class="my_hr_in"/>
<div class="alert alert-info my_alert" role="alert">
    <p class=""><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание!
                Прочети преди да продължиш!</span></p>

    <p>Ако в завлението има промени които касаят фирмата притежател на Разрешително/Удостоверение, натисни
        - <span class="bold fa fa-arrow-right">ДА Продължи!</span></p>
    <p>В противен случай натисни - <span class="bold fa fa-close"> Край!</span></p>
</div>
<hr class=""/>
<div class="form-group">
    <div class="col-md-6">
        <a href="/фирма/{{$id}} " class="fa fa-close btn btn-success link" id="complexConfirm"> Край!</a>
    </div>
    <div class="col-md-6">
        <a href="/фирма/{{$id}}/промяна-обстоятелства-фирма/{{$id_obj}}/{{$type_obj}} " class="fa fa-arrow-right btn btn-primary "> ДА Продължи!</a>
    </div>
</div>
@endsection

@section('scripts')
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/firms/exitConfirm.js" )!!}
@endsection