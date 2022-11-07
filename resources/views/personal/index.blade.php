@extends('layouts.personal')
@section('title')
    {{ 'Смяна на парола' }}
@endsection

@section('css')
    {!! Html::style('css/password.css') !!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row" id="password">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">СМЯНА НА ПАРОЛАТА</h3>
                </div>

                <div class="row ">
                    <div class="col-lg-12 mx-auto">
                        <div class="card mt-2 mx-auto p-4 bg-light">
                            <div class="card-body bg-light">
                                {!! Form::open(['url' => 'password/change/' . Auth::user()->id, 'method' => 'post']) !!}
                                {{ csrf_field() }}
                                <div class="controls">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_old">Стара парола</label>
                                                <input id="form_old" type="password" name="old"
                                                    value="{{ old('old') }}" class="form-control"
                                                    placeholder="Въведи старата парола">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_new">Нова парола</label>
                                                <input id="form_new" type="password" name="pass"
                                                    value="{{ old('pass') }}" class="form-control"
                                                    placeholder="Въведи нова парола">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="repeat">Повтори новата парола</label>
                                                <input id="repeat" type="password" name="repeat"
                                                    value="{{ old('repeat') }}" class="form-control"
                                                    placeholder="Повтори новата парола">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-success btn-send  pt-2 btn-block"
                                                value="СМЕНИ">
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
