@extends('layouts.admin')
@section('title')
    {{ 'Редактирай Мярка' }}
@endsection

@section('css')
    {!!Html::style("css/admin/verifications.css" )!!}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="alert alert-success alert-dismissible">

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

                        {!! Form::model($record, ['route'=>['admin.verifications.update', $record->id ], 'method'=>'PUT']) !!}

                        @include('admin.verifications.form')
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Редактирай!</button>
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