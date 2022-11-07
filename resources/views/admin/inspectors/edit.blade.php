@extends('layouts.admin')
@section('title')
    {{ 'Редактирай инспектор' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create_inspectors.css" )!!}
@endsection

@section('content')
    <fieldset class="mini_title">
        <h4>Редактиране на инспектор</h4>
    </fieldset>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($user, ['route'=>['admin.users.update', $user->id ], 'method'=>'PUT']) !!}

    @include('admin.inspectors.form')

    {!! Form::submit('Редактирай!', ['class'=>'btn btn-primary','id'=>'submit']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection