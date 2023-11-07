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
                            {!! Form::model($area, ['url'=>'admin/settings/operator/'.$area->id , 'method'=>'POST', 'id'=>'form']) !!}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <p style="margin-left: 15px;" ><span class="red">ВНИМАНИЕ !!!</span> Попълни САМО Идентификационен код на областа! Пример "HKV".</p>

                                            <div class="col-md-12" style="margin-bottom: 15px">
                                                {!! Form::label('operator_index_not', 'Идентификационен код на областа') !!}
                                                {!! Form::text('operator_index_not', null, ['class'=>'form-control ', 'minlength'=>3,  'maxlength'=>3, 'placeholder'=> 'HKV', 'style'=>'width:15%']) !!}
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