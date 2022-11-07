@extends('layouts.admin')
@section('title')
    {{ 'Редактирай Държава' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create_location.css" )!!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="alert alert-success alert-dismissible">
                        <p class="description_alert"><span class="red">ВНИМАНИЕ!</span> Тук може да се промени само дали е член на ЕС и името на държавата на английски език.</p>
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
                        <h3>{{$country->name}}</h3><br>
                        {!! Form::model($country, ['route'=>['admin.countries.update', $country->id ], 'method'=>'PUT']) !!}

                            @include('admin.countries.form')

                            <div class="col-md-4">
                                <a href="{!! URL::to('/admin/countries') !!}" class="btn btn-success">Назад! Откажи!</a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Редактирай!</button>
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
@endsection