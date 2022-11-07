@extends('layouts.farmers')
@section('title')
    {{ 'Добави Становище!' }}
@endsection

@section('css')
    {!!Html::style("css/opinions/exist.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">ДОБАВЯНЕ НА СТАНОВИЩЕ НА СЪЩЕСТВУВАЩ ЗЕМЕДЕЛСКИ СТОПАНИН</h4>
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
        {!! Form::open(['url'=>'добави/становище/'.$farmer->id.'/store' , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            <hr class="my_hr"/>
            @include('opinions.new.forms.petition')
            <hr class="my_hr"/>
            {!! Form::label('opinion', 'Избери Мярка:', ['class'=>'my_labels']) !!}
            {!! Form::select('opinion', $opinions, null, ['id' =>'opinion', 'class' =>'inspector form-control form-control_my_opinion' ]) !!}

            &nbsp;&nbsp;&nbsp;
            <span class="bold">Земеделското стопанство отговаря на изискванията на ЗЗР</span>
            &nbsp;&nbsp;
            <label class="labels"><span>ДА: </span>
                {!! Form::radio('yes', 0, true) !!}
            </label>&nbsp; |
            <label class="labels"><span>&nbsp;НЕ: </span>
                {!! Form::radio('yes', 1, false) !!}
            </label>

            &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
            <span class="bold">Проверката е: </span>
            <label class="labels"><span>Документална : </span>
                {!! Form::radio('type_check', 1, true) !!}
            </label> |
            <label class="labels"><span>&nbsp;На терен: </span>
                {!! Form::radio('type_check', 2, false) !!}
            </label>
            <hr class="my_hr"/>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Данни на заявителя</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('opinions.new.forms.exist_data')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Адрес на Заявителя</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('opinions.new.forms.location')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Други данни</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('opinions.new.forms.phones')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Други за стопанството</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('opinions.new.forms.location_farm')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>

            <div class="row">
                <div class="col-md-6" >
                    {!! Form::label('inspectors', 'Кой е изготвил документите за Становището:', ['class'=>'my_labels']) !!}
                    {!! Form::select('inspectors', $inspectors, null, ['id' =>'inspectors', 'class' =>'inspector form-control form-control_my_opinion' ]) !!}
                </div>
                <div class="col-md-6" >
                    &nbsp;&nbsp;
                    <label class="labels"><span>ДА: </span>
                        {!! Form::radio('has_protocol', 1, false) !!}
                    </label> |
                    <label class="labels"><span>&nbsp;НЕ: </span>
                        {!! Form::radio('has_protocol', 0, false) !!}
                    </label>
                    &nbsp;&nbsp;
                    <span class="bold">Има ли Констативен Протокол за Становището?</span>
                </div>
            </div>
            <hr class="my_hr"/>

            <div class="container-fluid hidden" id="protocol_show">
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Данни за Констативния Протокол</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('opinions.new.forms.protocol')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr hidden"  id="hr_last"/>

            <div class="col-md-6 ">
                @if(isset($type) && $type == 1)
                    <a href="{{ '/стопанин/'.$farmer->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад Земеделския Стопанин!</a>
                @else
                    <a href="{{ '/становища' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към всички Становища!</a>
                @endif
            </div>

            <div class="col-md-6">
                {!! Form::submit('Добави НОВО Становище!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
            <input type="hidden" name="type_firm" value="{!! $farmer->type_firm !!}" id="type_firm">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/opinions/hasProtocol.js" )!!}
    {!!Html::script("js/opinions/hasAssay.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection