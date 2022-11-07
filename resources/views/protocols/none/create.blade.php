@extends('layouts.objects')
@section('title')
    {{ 'Добави Констативен Протокол!' }}
@endsection

@section('css')
    {!!Html::style("css/protocols/add_edit_none.css" )!!}
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
                <h4 class="my_center bold">ДОБАВЯНЕ НА КОНСТАТИВЕН ПРОТОКОЛ НА НЕРЕГЛАМЕНТИРАН ОБЕКТ</h4>
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
        {!! Form::open(['url'=>'обект-протокол/store' , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            <hr class="my_hr"/>
            @include('protocols.none.forms.inspectors')
            <hr class="my_hr"/>

            @include('protocols.none.forms.data_object')
            <hr class="my_hr"/>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Точен адрес на Фирмата/Лицето</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('protocols.none.forms.locations')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Адрес на проверения обекр</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('protocols.none.forms.object_location')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>
            @include('protocols.none.forms.data_protocol')
            <hr class="my_hr"/>

            @include('protocols.none.forms.example')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/протоколи-обекти' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към Протоколите!</a>
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
    {!!Html::script("js/protocols/selectFirms.js" )!!}
    {!!Html::script("js/location/jquery.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/protocols/findLocationObject.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection
