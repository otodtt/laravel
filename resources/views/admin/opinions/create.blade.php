@extends('layouts.admin')
@section('title')
    {{ 'Добави Мярка' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create.css" )!!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="alert alert-success alert-dismissible">
                        <p class="description_alert"><span class="red">ВНИМАНИЕ!</span> Тук се добавят мерките за новия програмен период!<br/>
                            1. Изпиши пълното име на Мярката!<br/>
                            2. Изпиши съкратено име!<br/>

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

                            {!! Form::open(['route'=>'admin.miarki.store', 'method'=>'POST']) !!}

                            @include('admin.opinions.form')

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Добави!</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection