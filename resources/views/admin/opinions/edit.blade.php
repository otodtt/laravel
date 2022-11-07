@extends('layouts.admin')
@section('title')
    {{ 'Редактирай Мярка' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create.css" )!!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 ">
                <div class="panel panel-default">
                    <div class="alert alert-success alert-dismissible">
                        <p>
                            <span class="bold red"><i class="fa fa-warning"></i> ВНИМАНИЕ!</span>
                            Ако мярката се маркира да не се показва, няма да може да се създава ново Становище за нея.
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

                        {!! Form::model($rate, ['route'=>['admin.miarki.update', $rate->id ], 'method'=>'PUT']) !!}

                        @include('admin.opinions.form')

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