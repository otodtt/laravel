@extends('layouts.objects')
@section('title')
    {{ 'Удостоверение за Аптека!' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
    {!!Html::style("css/firms_objects/add_object.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection


@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 " >
                <a href="{!! URL::to('/аптеки')!!}" class="fa fa-plus-square btn btn-info my_btn"> Към всички Аптеки</a>
                <h3 class="my_center" >Добавяне на Удостоверение!</h3>
            </div>
        </div>
    </div>

    <div class="alert alert-danger my_alert" role="alert" style="text-align: center">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">
                Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Използвай тази страница САМО когато обекта съществува и е изтекъл срока на Разрешителното!</span>
        </p>
    </div>

    <div class="alert alert-info my_alert2" role="alert">
        @include('objects.forms.firm_info')
    </div>
    <div class="form-group">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::model($pharmacy, ['url'=>'pharmacies/store-add/'.$pharmacy->id , 'method'=>'PUT', 'id'=>'form']) !!}
        @include('objects.forms.form_create_pharmacy')
            <div class="col-md-6 ">
                <a href="/фирма/{{$firm->id}}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към фирмата!</a>
            </div>
            <div class="col-md-6 ">
                {!! Form::submit('Добави Удостоверение!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
        <input type="hidden" name="hidden" value="{{$firm->id}}" id="hidden">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection


@section('scripts')
    {!!Html::script("js/location/jquery.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
    {!!Html::script("js/location/findLocationPhar.js" )!!}
@endsection