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
                            {!! Form::model($area, ['url'=>'admin/settings/add-index/'.$area->id , 'method'=>'POST', 'id'=>'form']) !!}

                            @include('admin.settings.form.form_index')

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