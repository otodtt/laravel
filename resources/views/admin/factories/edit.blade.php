@extends('layouts.admin')
@section('title')
    {{ 'Редактиране на фирма!' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
@endsection

@section('content')
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
    </div>
    <div class="container-fluid" >
        <div class="form-group">
            {!! Form::model($firm, array('url'=>'/админ/производители/'.$firm->id.'/update', 'method'=>'POST')) !!}
            @include('admin.factories.forms.create')
            <div class="col-md-6 ">
                <a href="{!! URL::to('/админ/производители')!!}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи. Назад</a>
            </div>
            <div class="col-md-6 ">
                {!! Form::submit('Редактирай фирмата!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
            <input type="hidden" name="id_firm" value="{{$firm->id}}" id="id_firm">
            {!! Form::close() !!}
        </div>
    </div>
    <hr class="my_hr"/>

    <div class="alert alert-danger my_alert" role="alert">
        <h4 class="my_p1" style="text-align: center"><span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold red">След като се изтрие фирмата, ще бъдат изтрити всички Констативни Протокли издадени за нея!</span>
        </h4>
    </div>
    <div class="container-fluid" >
        <div class="form-group">
            <div class="col-md-12 " role="alert">
                {!! Form::open(array('url'=>'/админ/производители/'.$firm->id.'/destroy', 'method'=>'DELETE', 'id'=>'form')) !!}
                <button type="submit" id="complexConfirm"  class="btn btn-danger delete " >
                    <span class="fa fa-cut" aria-hidden="false"></span>
                    Изтрий Фирмата!</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/firms/deleteFactoryFirmConfirm.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection