@extends('layouts.farmers')
@section('title')
    {{ 'Редактиране на Земедлски производител!' }}
@endsection

@section('css')
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/farmers/edit_farmer.css" )!!}
@endsection


@section('content')
    <a href="{!! URL::to('/земеделци')!!}" class="fa fa-home btn btn-info my_btn"> Откажи. Към всички земедлци</a>
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 title_h4">
                <h4 class="my_center bold">РЕДАКТИРАНЕ НА ЗЕМЕДЕЛСКИ СТОПАНИН</h4>
            </div>
        </div>
    </div>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid" >
        <div class="form-group">
            {!! Form::model($farmer, ['url'=>'стопанин/'.$farmer->id.'/update' , 'method'=>'PUT', 'id'=>'form']) !!}
                <div class="row">
                    @include('farmers.edit.type_firm')
                </div>
                <hr class="my_hr_in"/>
                <div class="row">
                    @include('farmers.edit.location')
                </div>
                <hr class="my_hr_in"/>
                <div class="row">
                    <div class="col-md-12 col-md-6_my "  >
                        @include('layouts.forms.phone')
                    </div>
                </div>
                <hr class="my_hr_in"/>
                <div class="row">
                    @include('farmers.edit.location_farm')
                </div>
                <hr class="my_hr_in"/>

                <div class="col-md-4">
                    <a href="{!! URL::to('/стопанин/'.$farmer->id)!!}" class="fa fa-arrow-circle-left btn btn-success "> Откажи. Назад</a>
                </div>
                <div class="col-md-4">
                    {!! Form::submit(' Редактирай Земедлския стопанин!', ['class'=>'btn btn-info', 'id'=>'submit']) !!}
                    <input type="hidden" name="is_submit" value="{{$selected}}" id="is_submit">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr class="my_hr"/>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection