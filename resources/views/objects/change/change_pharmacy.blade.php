@extends('layouts.objects')
@section('title')
    {{ 'Промяна в Обстоятелствата - Аптека!' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
    {!!Html::style("css/firms_objects/add_object.css" )!!}
    {!!Html::style("css/firms_objects/edit_object.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 " >
                <a href="{!! URL::to('/фирма/'.$pharmacy->firm_id)!!}" class="fa fa-arrow-left btn btn-success "> Назад!</a>
                <h3 class="my_center">Промяна в обстоятелствата на Аптека!</h3>
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
        {!! Form::model($pharmacy, ['url'=>'pharmacies/change-pharmacy-add/'.$pharmacy->id , 'method'=>'POST', 'id'=>'form']) !!}
            @include('objects.change.forms.form_change_pharmacy')
            <div class="col-md-12 col-center-block">
                {!! Form::submit('Запази промените! Край!', ['class'=>'btn btn-danger my_btn-success col-center-block', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection


@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/location/findLocationPhar.js" )!!}
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/confirm/changePharConfirm.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection