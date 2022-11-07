@extends('layouts.objects')
@section('title')
    {{ 'Добави фирма!' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
@endsection


@section('content')
    <a href="{!! URL::to('/фирми')!!}" class="fa fa-home btn btn-info my_btn"> Откажи. Назад</a>
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert" style="text-align: center">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold red">Тук се добавят само фирми с обекти (аптеки, складове и цехове), за които се издава Удостоверение!</span><br/>
            <span class="bold red">Веднъж създаден запис за НОВА фирма не може да се изтрие и само Ситемния Администратор може да го редактира!</span><br/>
        </p>
    </div>
    <div class="container-fluid" >
        <div class="form-group">
            {!! Form::open(['route'=>'firms.store', 'method'=>'POST', 'id'=>'form']) !!}
                @include('objects.firms.index.form')
                <div class="col-md-6 ">
                    <a href="{!! URL::to('/фирми')!!}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи. Назад</a>
                </div>
                <div class="col-md-6 ">
                    {!! Form::submit('Добави НОВА фирма!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                <input type="hidden" name="is_submit" value="{{$selected}}" id="is_submit">
            {!! Form::close() !!}
        </div>
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/location/jquery.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection