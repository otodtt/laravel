@extends('layouts.certificates')
@section('title')
    {{ 'Добави Сертификат!' }}
@endsection

@section('css')
    {!!Html::style("css/certificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 " >
                <h3 class="my_center" >Добавяне на Сертификат!</h3>
            </div>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Ведъж направен запис, Номера на Сертификата не може повече да се променя!
                Ведъж направен запис, Сертификата не може да се изтрие, може само да се редактира!
            </span>
        </p>
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
        {!! Form::open(['url'=>'сертификати/store' , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            @include('certificates.forms.form_create_certificate')
            <div class="col-md-6 " >
                <a href="{{ '/сертификати' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към сертификатите!</a>
            </div>
            <div class="col-md-6" >
                {!! Form::submit('Добави НОВ Сертификат!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection