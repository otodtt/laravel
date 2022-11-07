@extends('layouts.admin')
@section('title')
    {{ 'Редактирай Населено място' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create_location.css" )!!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="alert alert-success alert-dismissible">
                        <p class="description_alert"><span class="red">ВНИМАНИЕ!</span> Тук се добавят най-често използваните населени места! Може да са градове и села.</p>
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

                        {!! Form::model($location, ['route'=>['admin.locations.update', $location->id ], 'method'=>'PUT']) !!}

                            @include('admin.locations.form')

                            <div class="col-md-4">
                                <a href="{!! URL::to('/admin/locations-added') !!}" class="btn btn-success">Назад! Откажи!</a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Редактирай!</button>
                            </div>
                        {!! Form::close() !!}

                        {!! Form::open(['route'=>['admin.locations.destroy', $location->id ], 'method'=>'DELETE', 'id'=>'form']) !!}
                            <div class="col-md-4">
                                <button type="submit" id="complexConfirm"  class="btn btn-danger delete" >Изтрий!</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/bootstrap.min.js" )!!}
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/location/deleteConfirm.js" )!!}
@endsection