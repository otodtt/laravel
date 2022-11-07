@extends('layouts.services')
@section('title')
    {{ 'Добави Разрешително!' }}
@endsection

@section('css')
    {!!Html::style("css/records/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">РАЗРЕШИТЕЛНО ЗА ВЪЗДУШНО ТРЕТИРАНЕ НА НОВ ЗЕМЕДЕЛСКИ СТОПАНИН</h4>
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
        {!! Form::open(['url'=>'въздушно-нов/store' , 'method'=>'POST', 'id'=>'form']) !!}
            <hr class="my_hr"/>
            @include('services.air.new.data_object')
            {{--<hr class="my_hr"/>--}}
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Адрес на Земеделския Стопанин</legend>
                            @include('services.air.new.locations')
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
                            @include('services.air.new.location_farm')
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>
            @include('services.air.add.permit')
            <hr class="my_hr"/>

            @include('services.air.add.numbers')
            <hr class="my_hr"/>

            @include('services.air.add.data_permit')
            <hr class="my_hr"/>

            @include('services.air.add.pests')
            <hr class="my_hr"/>

            @include('services.air.add.certificate')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/въздушни' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към Разрешителни!
                </a>
            </div>

            <div class="col-md-6">
                {!! Form::submit('Добави НОВО Разрешително!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/permit_date.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection