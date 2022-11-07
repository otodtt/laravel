@extends('layouts.farmers')
@section('title')
{{ 'Добави Заверка на Дневник!' }}
@endsection

@section('css')
{!!Html::style("css/records/add_edit.css" )!!}
{!!Html::style("css/date/jquery.datetimepicker.css" )!!}
{!!Html::style("css/diaries/diaries.css" )!!}
@endsection

@section('content')
<hr class="my_hr"/>
<div class="alert alert-info my_alert" role="alert">
    <div class="row">
        <div class="col-md-12 ">
            <h4 class="my_center bold">НОВ ЗЕМЕДЕЛСКИ СТОПАНИН И ЗАВЕРКА НА ДНЕВНИК</h4>
        </div>
    </div>
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
    {!! Form::open(['url'=>'нов/дневник/store' , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
        <hr class="my_hr"/>
        @include('records.add.data_farmer.data_object')
        <hr class="my_hr"/>

        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-12" >
                    <fieldset class="small_field"><legend class="small_legend">Адрес на Земеделския Стопанин</legend>
                        @include('records.add.data_farmer.locations')
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-12" >
                    <fieldset class="small_field"><legend class="small_legend">Други данни на Земеделския Стопанин</legend>
                        @include('layouts.forms.phone')
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-12" >
                    <fieldset class="small_field"><legend class="small_legend">Данни за Стопанството</legend>
                        @include('records.add.data_farmer.location_farm')
                    </fieldset>
                </div>
            </div>
        </div>

        <hr class="my_hr"/>
        {!! Form::label('date_diary', 'Дата на заверка:', ['class'=>'my_labels']) !!}
        {!! Form::text('date_diary', null, ['class'=>'form-control form-control-my date_certificate',
        'id'=>'date_diary', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="bold">Направени предписания </span>
        <label class="act"><span>НЕ: </span>
            {!! Form::radio('act', 0, false) !!}
        </label>&nbsp;&nbsp;|
        <label class="act"><span>&nbsp;&nbsp;ДА: </span>
            {!! Form::radio('act', 1, false) !!}
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::label('inspector', 'Кой е направил заверката:', ['class'=>'my_labels']) !!}
        {!! Form::select('inspector', $inspectors, null, ['id' =>'inspector',
                'class' =>'inspector form-control form-control_my_inspector' ]) !!}
        <hr class="my_hr"/>

        <div class="col-md-6 ">
            <a href="{{ '/дневници' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                Откажи! Назад към Всички Дневници!
            </a>
        </div>

        <div class="col-md-6">
            {!! Form::submit('Добави Заверка на Дневник!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
        </div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
    {!! Form::close() !!}
</div>
<br/>
<hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection