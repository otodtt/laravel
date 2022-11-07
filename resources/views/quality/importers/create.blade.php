@extends('layouts.quality')
@section('title')
    {{ 'Добави фирма!' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
@endsection


@section('content')
    <a href="{!! URL::to('/контрол/търговци')!!}" class="fa fa-home btn btn-info my_btn"> Откажи. Назад</a>
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert" style="text-align: center">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold red">Тук се добавят само нови търговски фирми ако ги няма в падащото меню!</span><br/>
            <span class="bold red">ВАЖНО!! Трябва да се отбележи дейността на фирмата. Внос, износ, вътрешна търговия. В зависимост от това ще се появи в падащото меню!</span><br/>
            <span class="bold red">Важно е да се отбележи дали фирмата е българска или не!</span><br/>
        </p>
    </div>
    <div class="container-fluid" >
        <div class="form-group">
            {!! Form::open(['route'=>'контрол.търговци.store', 'method'=>'POST']) !!}
                @include('quality/importers/form')
                <div class="col-md-6 " style="margin-bottom: 15px; margin-top: 15px">
                    <a href="{!! URL::to('/контрол/търговци')!!}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи. Назад</a>
                </div>
                <div class="col-md-6 " style="margin-bottom: 15px; margin-top: 15px">
                    {!! Form::submit('Добави НОВА фирма!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
            {!! Form::close() !!}
        </div>
    </div>
    <br/><br/>
    <hr class="my_hr_in"/>
@endsection

@section('scripts')
    {!!Html::script("js/location/jquery.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection