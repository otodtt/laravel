@extends('layouts.quality')
@section('title')
    {{ 'Редактиране на фирма!' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
@endsection


@section('content')
    <a href="{!! URL::to('/контрол/вносители')!!}" class="fa fa-home btn btn-info my_btn"> Откажи. Към всички фирми</a>
    <hr class="my_hr"/>

    <div class="container-fluid" >
        <div class="form-group">
            {!! Form::model($packers, ['url'=>'контрол/опаковчик/'.$packers->id.'/update', 'method'=>'POST', ''=>'']) !!}
                @include('quality.packers.form')

                <div class="col-md-4">
                    <a href="{!! URL::to('/контрол/опаковчици')!!}" class="fa fa-arrow-circle-left btn btn-success "> Откажи. Назад</a>
                </div>
                <div class="col-md-4">
                    {!! Form::submit(' Редактирай фирмата!', ['class'=>'btn btn-info', 'id'=>'submit']) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
{{--    {!!Html::script("js/firms/deleteFirmConfirm.js" )!!}--}}
@endsection