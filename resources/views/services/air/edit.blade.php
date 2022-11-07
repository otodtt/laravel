@extends('layouts.services')
@section('title')
    {{ 'Редактиране Разрешително!' }}
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
                <h4 class="my_center bold">РЕДАКТИРАНЕ НА РАЗРЕШИТЕЛНО ЗА ВЪЗДУШНО ТРЕТИРАНЕ</h4>
                @include('services.air.add.object_info')
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
        {!! Form::model($permits, ['url'=>'въздушни/update/'.$permits->id , 'method'=>'POST', 'id'=>'form']) !!}
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
                <a href="{{ '/въздушни/'.$permits->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към разрешителното!
                </a>
            </div>

            <div class="col-md-6">
                {!! Form::submit('Редактирай Разрешително!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
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