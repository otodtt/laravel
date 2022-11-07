@extends('layouts.admin')
@section('title')
    {{ 'Добави Населено място' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create_location.css" )!!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
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

                        {!! Form::open(['route'=>'admin.locations.store', 'method'=>'POST']) !!}

                        @include('admin.locations.form')

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