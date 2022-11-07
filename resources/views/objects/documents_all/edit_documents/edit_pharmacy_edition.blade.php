@extends('layouts.objects')
@section('title')
    {{ 'Редактиране на Удостоверение!' }}
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
            <div class="col-md-1">
                <a href="/аптека-удостоверение/{{$pharmacy->firm_id}}/{{$pharmacy->id}}/{{$pharmacy->edition}}/" class="fa fa-arrow-left btn btn-success "> Назад!</a>
            </div>
            <div class="col-md-11 my_alert_center">
                <h3 class="my_center_edition">Редактиране на Издание на Удостоверение!</h3>
            </div>
        </div>
    </div>
    <div class="alert alert-info my_alert2 my_alert_center" role="alert">
        <p class="my_center_edition_1" >АКО ИМА ГРЕШКА В ДАННИТЕ НА ФИРМАТА, ОБЪРНЕТЕ СЕ КЪМ СИСТЕМНИЯ АДМИНИСТРАТОР!</p>
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
        {!! Form::model($pharmacy, ['url'=>'update-pharmacy-edition/'.$pharmacy->firm_id.'/'.$pharmacy->id , 'method'=>'POST', 'id'=>'form']) !!}
        @include('objects.documents_all.edit_documents.forms.form_edit_pharmacy_edition')
        <div class="col-md-12 col-center-block">
            {!! Form::submit('Редактирай!', ['class'=>'btn btn-danger my_btn-success col-center-block', 'id'=>'submit']) !!}
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        {!! Form::close() !!}
    </div>
@endsection


@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/location/findLocationPhar.js" )!!}
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/confirm/changePharConfirm.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection