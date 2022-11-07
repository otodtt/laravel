@extends('layouts.admin')
@section('title')
    {{ 'Добави фирма!' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/add_firm.css" )!!}
@endsection

@section('content')
    <div class="alert alert-info my_alert" role="alert">
        <p class="my_ps"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold red">Веднъж създаден запис за НОВА фирма не може да се изтрие и само може да се редактира!</span><br/>
        </p>
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
    </div>
    <div class="container-fluid" >
        <div class="form-group">
            {!! Form::open(['route'=>'админ.производители.store', 'method'=>'POST', 'id'=>'form']) !!}
            @include('admin.factories.forms.create')
            <div class="col-md-6 ">
                <a href="{!! URL::to('/админ/производители')!!}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи. Назад</a>
            </div>
            <div class="col-md-6 ">
                {!! Form::submit('Добави НОВА фирма!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/location/findLocation.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection