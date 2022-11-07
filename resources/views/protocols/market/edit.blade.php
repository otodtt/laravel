@extends('layouts.objects')
@section('title')
    {{ 'Редактирай Констативен Протокол!' }}
@endsection

@section('css')
    {!!Html::style("css/protocols/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">РЕДАКТИРАНЕ НА КОНСТАТИВЕН ПРОТОКОЛ НА ФИРМА:</h4>
                @include('protocols.market.form_add.edit_info')
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
        {!! Form::open(['url'=>'протоколи/'.$protocols->id.'/update', 'method'=>'POST', 'id'=>'form']) !!}
            <hr class="my_hr"/>
            @include('protocols.market.form_add.radio_type')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.number_protocol')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.inspectors')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.data_protocol')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.edit_example')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/протокол/'.$protocols->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към Протокола!</a>
            </div>

            <div class="col-md-6">
                {!! Form::submit('Редактирай Протокола!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
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