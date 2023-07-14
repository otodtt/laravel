@extends('layouts.objects')
@section('title')
    {{ 'Добави Констативен Протокол!' }}
@endsection

@section('css')
    {!!Html::style("css/protocols/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Ведъж направен запис за Констативен Протокол не може да се изтрие, може само да се редактира!
            </span>
        </p>
    </div>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">КОНСТАТИВЕН ПРОТОКОЛ НА</h4>
                @include('protocols.market.form_add.object_info')
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
        {!! Form::open(['url'=>'протоколи/store/'.$object->id.'/'.$type , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            <hr class="my_hr"/>
            @include('protocols.market.form_add.radio_type')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.number_protocol')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.inspectors')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.data_protocol')
            <hr class="my_hr"/>

            @include('protocols.market.form_add.example')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/фирма/'.$object->firm_id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към Фирмата!</a>
            </div>

            <div class="col-md-6">
                {!! Form::submit('Добави НОВ Протокол!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
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
    {!!Html::script("js/protocols/selectAssay.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection