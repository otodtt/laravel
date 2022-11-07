@extends('layouts.farmers')
@section('title')
    {{ 'Редактиране на Констативен Протокол!' }}
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
                <h4 class="my_center bold">КОНСТАТИВЕН ПРОТОКОЛ НА</h4>
                @include('records.add.object_edit_info')
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
        {!! Form::model($protocol, ['url'=>'протокол-редактирай/update/'.$protocol->id , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
        <hr class="my_hr"/>
        @include('records.add.radio_type')
        <hr class="my_hr"/>

        @include('records.add.number_protocol')
        <hr class="my_hr"/>

        @include('records.add.inspectors')
        <hr class="my_hr"/>

        @include('records.add.data_protocol')
        <hr class="my_hr"/>

        @include('records.add.example')
        <hr class="my_hr"/>

        <div class="col-md-6 ">
            <a href="{{ '/протокол-зс/'.$protocol->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                Откажи! Назад към Протокола!
            </a>
        </div>

        <div class="col-md-6">
            {!! Form::submit('Редактирай Протокол', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
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
    {!!Html::script("js/records/hasAssay.js" )!!}
    {!!Html::script("js/records/selectAssayProtocol.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection