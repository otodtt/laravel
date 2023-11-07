@extends('layouts.admin')
@section('title')
    {{ 'Редактиране на индексите' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create.css" )!!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div >
                <div class="panel panel-default">
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
                            {!! Form::model($area, ['url'=>'admin/settings/add_stamp/'.$area->id , 'method'=>'POST', 'id'=>'form']) !!}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="col-md-12" style="margin-bottom: 15px">
                                                {!! Form::label('q_index', 'Индех преди номера на печата') !!}
                                                {!! Form::text('q_index', null, ['class'=>'form-control my_input_index', 'maxlength'=>5]) !!}
                                            </div>

                                            <div class="col-md-12" style="margin-bottom: 15px">
                                                {!! Form::label('authority_bg', 'Контролен орган на български') !!}
                                                {!! Form::text('authority_bg', null, ['class'=>'form-control ',  'maxlength'=>100, 'placeholder'=> 'БАБХ: ОДБХ-Хасково']) !!}
                                            </div>

                                            <div class="col-md-12">
                                                {!! Form::label('authority_en', 'Контролен орган на англиски') !!}
                                                {!! Form::text('authority_en', null, ['class'=>'form-control ',  'maxlength'=>100, 'placeholder'=> 'BFSA: RDFS-HASKOVO']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                            </div>

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