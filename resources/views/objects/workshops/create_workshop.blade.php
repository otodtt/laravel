@extends('layouts.objects')
@section('title')
    {{ 'Добави Удостоверение за Цех!' }}
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
                <a href="{!! '/цехове' !!}" class="fa fa-cubes btn btn-info my_btn"> Към всички Цехове</a>
                <h3 class="my_center" >Добавяне на Цех и Удостоверение!</h3>
            </div>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Използвай тази страница САМО когато фирмата открива нов несъществуващ до сега обект
                или при първоначалното въвеждане в Базата Данни!</span>
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
        {!! Form::open(['route'=>'workshops.store', 'method'=>'POST', 'id'=>'form']) !!}
        @include('objects.forms.form_create_pharmacy')
        <div class="col-md-6 " >
            <a href="/фирма/{{$firm->id}}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към фирмата!</a>
        </div>
        <div class="col-md-6" >
            {!! Form::submit('Добави НОВ Цех!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
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