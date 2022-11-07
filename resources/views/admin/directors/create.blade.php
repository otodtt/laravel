@extends('layouts.admin')
@section('title')
    {{ 'Добави Директор' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create_inspectors.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection


@section('content')
    <div class="alert alert-success alert-dismissible" role="alert">
        <p class="description_alert"><span class="red">ВНИМАНИЕ!</span> Прочети преди да продължиш!<br/>
            1. Полето "<span class="bold_desc">ИД или ИФ</span>" се попълва само ако е времнно изпълняващ длъжността или функциите.<br/>
            2. Полето "<span class="bold_desc">Титла ако има:</span>" се попълва само ако има титла. Пример "Д-р", "Ст. н.с." и т.н.<br/>
            3. Полетата "<span class="bold_desc">Име: и Фамилия:</span>" са ЗАДЪЛЖИТЕЛНИ ! Полето "<span class="bold_desc">Презиме:</span> не е."<br/>
            4. Задължително избери "<span class="bold">Начална дата:</span>" от която е назначен!<br/>
        </p>
    </div>
    {!! Form::open(['route'=>'admin.directors.store', 'method'=>'POST']) !!}

    @include('admin.directors.form')

    {!! Form::submit('Добави!', ['class'=>'btn btn-primary', 'id'=>'submit']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/balloons/jquery.balloon.min.js" )!!}
    {!!Html::script("js/balloons/my_balloon.js" )!!}
    {!!Html::script("js/date/my_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection
