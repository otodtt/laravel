@extends('layouts.admin')
@section('title')
    {{ 'Шаблон за Становище' }}
@endsection

@section('css')
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/admin/create.css" )!!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 panel panel-default" style="text-align: center; margin-top: 10px; vertical-align: middle">
                <span class="bold">ДОБАВЯНЕ НА ШАБЛОН ЗА СТАНОВИЩЕ</span>
            </div>

            <div class="col-md-10 ">
                <div class="panel panel-default">
                    <div class="alert alert-success alert-dismissible">
                        <p class="description_alert">
                            <i class="fa fa-warning red"></i> <span class="red">ВНИМАНИЕ!</span> В името на файла трябва да се съдържа "_opinion_body.blade"!<br/>
                            <i class="fa fa-warning red"></i> <span class="red">ВНИМАНИЕ!</span> Не променяй името или съдържанието на файла!!!"!
                        </p>
                    </div>
                    <div class="panel-body">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error  }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(['url'=>'admin/templates-opinion-create' , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
                        <div class="form-group">
                            <label class="col-md-5 control-label">0000000000_opinion_body.blade </label>&nbsp;&nbsp;
                            <div class="col-md-6">
                                {!! Form::file('blade',['id'=>'filename']) !!}
                            </div>
                            <br/>
                        </div>
                        <div class="col-md-6 col-md-offset-4 " style="margin-top: 20px">
                            <button type="submit" class="btn btn-primary" id="submit">Добави!</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection