@extends('layouts.objects')
@section('title')
    {{ 'Добави Констативен Протокол!' }}
@endsection

@section('css')
    {!!Html::style("css/protocols/add_edit_none.css" )!!}
    {!!Html::style("css/protocols/add_edit_factory.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection


@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">ВНИМАНИЕ! Прочети преди да продължиш!</span><br/>
            <span class="bold">Тук се добавят Констативни Протоколи само при проверка на фирми производители на ПРЗ!</span><br/>
            <span class="bold">На цехове за които се издава Удостоверение, иди на фирмата и добави там Констативния протокол!</span>
        </p>
    </div>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">ДОБАВЯНЕ НА КОНСТАТИВЕН ПРОТОКОЛ НА ПРОИЗВОДИТЕЛ НА ПРЗ</h4>
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
        {!! Form::open(['url'=>'производител/добави-протокол/store' , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            <hr class="my_hr"/>
            @include('protocols.factories.forms.inspectors')
            <hr class="my_hr"/>

            @include('protocols.factories.forms.select_firm')
            <hr class="my_hr"/>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Данни на Фирмата</legend>
                            <div class="col-md-12 col-md-6_my inspectors_divs " >
                                @include('protocols.factories.forms.firm_data')
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
                                @include('protocols.factories.forms.object_location')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <hr class="my_hr"/>
            @include('protocols.factories.forms.data_protocol')
            <hr class="my_hr"/>

            @include('protocols.factories.forms.example')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/производители' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
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
    {!!Html::script("js/location/jquery.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/protocols/selectFactoryFirms.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection
