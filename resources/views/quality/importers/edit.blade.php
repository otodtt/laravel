@extends('layouts.quality')
@section('title')
    {{ 'Редактиране на фирма!' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
@endsection


@section('content')
    <a href="{!! URL::to('/контрол/търговци')!!}" class="fa fa-home btn btn-info my_btn"> Откажи. Към всички фирми</a>
    <hr class="my_hr"/>

    <div class="container-fluid" >
        <div class="form-group">
            {!! Form::model($importers, ['url'=>'контрол/търговци/'.$importers->id.'/update', 'method'=>'POST']) !!}
            {{-- {!! Form::model($importers, ['route'=>['контрол.търговци.update', $importers->id ], 'method'=>'PUT']) !!} --}}
                <div class="row" style="margin: 20px 0 10px 0">
                    <div class="col-md-8" >
                        {{-- <p class="description">Задължително маркирай дали фирмата е българска или не!</p> --}}
                        <p class="description">Ако фирмата не е вече активна може да се маркира НЕ и няма да се показва в падащото меню!</p>
                        {!! Form::label('is_active', 'Фирмата е активна:', ['class'=>'labels']) !!}
                        &nbsp;<label >ДА
                            {!! Form::radio('is_active', 1, null,['required']) !!}
                        </label>&nbsp; | &nbsp;
                
                        &nbsp;<label >НЕ
                            {!! Form::radio('is_active', 0, false) !!}
                        </label>&nbsp; | &nbsp;
                    </div>
                    <div class="col-md-4 ">
                        <span class="errors">
                            {{ $errors->first('is_active') }}
                        </span>
                    </div>
                </div>
                <hr class="my_hr_in"/>
                @include('quality.importers.form')

                <div class="col-md-4">
                    <a href="{!! URL::to('/контрол/търговци')!!}" class="fa fa-arrow-circle-left btn btn-success "> Откажи. Назад</a>
                </div>
                <div class="col-md-4">
                    {!! Form::submit(' Редактирай фирмата!', ['class'=>'btn btn-info', 'id'=>'submit']) !!}
                    {{-- <input type="hidden" name="is_submit" value="{{$selected}}" id="is_submit"> --}}
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr class="my_hr"/>
    {{--<div class="alert alert-info my_alert" role="alert">--}}
        {{--<p class="my_p"><span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>--}}
            {{--<span class="bold red">След като се изтрие фирмата, ще бъдат изтрити всички обеки (Аптеки, Складове и Цехове) регистрирани--}}
                {{--към нея. Ще бъдат изтрити и Констативните Протокли издадени за тях!</span>--}}
        {{--</p>--}}
    {{--</div>--}}
    {{--<div class="container-fluid" >--}}
        {{--<div class="form-group">--}}
            {{--<div class="col-md-4">--}}
                {{--{!! Form::open(['route'=>['firms.destroy', $firm->id ], 'method'=>'DELETE', 'id'=>'form']) !!}--}}
                    {{--<button type="submit" id="complexConfirm"  class="btn btn-danger delete " >--}}
                        {{--<i class="fa fa-cut" aria-hidden="false"></i> Изтрий Фирмата!--}}
                    {{--</button>--}}
                {{--{!! Form::close() !!}--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
    {!!Html::script("js/firms/deleteFirmConfirm.js" )!!}
@endsection