@extends('layouts.objects')
@section('title')
    {{ 'Промяна в Обстоятелствата - Заявление!' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
    {!!Html::style("css/firms_objects/change.css" )!!}
    {!!Html::style("css/firms_objects/add_object.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection


@section('content')
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 " >
                <a href="/фирма/{{$id}}" class="fa fa-arrow-left btn btn-success"> Назад!</a>
                <h3 class="my_center" >Промяна в обстоятелствата на Фирмата!</h3>
            </div>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <div class="row">
            <div class="col-md-12" >
                <p class="change_alert" style="text-align: center"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание!</span>
                    Използвай само ако в Заявлението има промени касаещи данните на фирмата!</p>
                    <p class="change_alert" style="text-align: center"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание!</span>
                        Ако в Заявлението има промени касаещи данните на обект, върни се и избери първо обекта!!</p>
            </div>
        </div>
    </div>
    <hr class="my_hr_in"/>
    @if ($errors->has('date_licence_max'))
        <div class="alert alert-danger">
            {{ $errors->first('date_licence_max') }}
        </div>
    @endif
    <div class="form-group">
        {!! Form::model($firm, ['url'=>'firms/change-firm-add/'.$firm->id , 'method'=>'POST', 'id'=>'form']) !!}
        @include('objects.change.forms.form_change_firm')
            <div class="col-md-12 ">
                {!! Form::submit('Запази промените!', ['class'=>'btn btn btn-danger my_btn-success col-center-block', 'id'=>'submit']) !!}
            </div>
                <input type="hidden" name="is_submit" value="{{$selected}}" id="is_submit">
                <input type="hidden" name="date_licence_max" value="{{$date_licence_max}}" id="date_licence_max">
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection