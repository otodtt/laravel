@extends('layouts.admin')
@section('title')
    {{ 'Редактирай Директор' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create_inspectors.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible" role="alert">
        <p class="deskript"><span class="red">ВНИМАНИЕ!</span> Прочети преди да продължиш!<br/>
            1. <span class="bold_desc">Редактирай само</span> ако има грешни данни. Ако е бил ИД или ИФ и става Директор <span class="bold_desc">ДОБАВИ НОВ ЗАПИС!!!</span><br/>
        </p>
    </div>

    {!! Form::model($director, ['route'=>['admin.directors.update', $director->id ], 'method'=>'PUT']) !!}

    @include('admin.directors.form')

    {!! Form::submit('Редактирай!', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/balloons/jquery.balloon.min.js" )!!}
    {!!Html::script("js/balloons/my_balloon.js" )!!}
    {!!Html::script("js/date/my_date.js" )!!}
@endsection