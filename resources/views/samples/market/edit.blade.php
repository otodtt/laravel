@extends('layouts.objects')
@section('title')
    {{ 'Редактирай Проба!' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/samples/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection


@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <?php
                if($samples->from_object == 1){
                    $type = 'Аптека';
                }
                if($samples->from_object == 2){
                    $type = 'Склад';
                }
                if($samples->from_object == 3){
                    $type = 'Цех';
                }
                if($samples->from_object == 100){
                    $type = 'Нерегламентиран обект';
                }
                if($samples->from_object == 200){
                    $type = 'Производител на ПРЗ';
                }
                ?>
                <h4 class="my_center bold">РЕДАКТИРАНЕ И ДОБАВЯНЕ НА ДАННИ ЗА ВЗЕТА ПРОБА ОТ:<br>
                    {{ $type }} на фирма {{ $samples->from_firm }}
                </h4>
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
        {!! Form::open(['url'=>'проба/update/'.$samples->id, 'method'=>'POST', 'id'=>'form']) !!}
        <hr class="my_hr"/>

        @include('samples.market.edit.number_protocol')
        <hr class="my_hr"/>

        @include('samples.market.edit.data_samples')
        <hr class="my_hr"/>

        <div class="col-md-6 ">
            <a href="{{ '/проби' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                Откажи! Назад към Дневника!</a>
        </div>

        <div class="col-md-6">
            <button type="submit"   class="btn btn-danger delete submit_button " id="submit">
                <span class="fa fa-edit" aria-hidden="false"></span> Редактирай Пробата!
            </button>
        </div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    {!!Html::script("js/samples/addIdButton.js" )!!}
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection