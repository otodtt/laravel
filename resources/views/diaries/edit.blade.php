@extends('layouts.farmers')
@section('title')
    {{ 'Редактиране на Заверка!' }}
@endsection

@section('css')
    {!!Html::style("css/diaries/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">РЕДАКТИРАНЕ НА ЗАВЕРКА НА ДНЕВНИК</h4>
                @include('diaries.object_info')
            </div>
        </div>
    </div>

    <div class="form-group">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::model($diaries, ['url'=>'дневник/update/'.$diaries->id , 'method'=>'POST', 'id'=>'form']) !!}
            <hr class="my_hr"/>
            {!! Form::label('date_diary', 'Дата на заверка:', ['class'=>'my_labels']) !!}
            {!! Form::text('date_diary', date('d.m.Y', $diaries->date_diary), ['class'=>'form-control form-control-my date_certificate',
            'id'=>'date_diary', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="bold">Направени предписания </span>
            <label class="act"><span>НЕ: </span>
                {!! Form::radio('act', 0, false) !!}
            </label>&nbsp;&nbsp;|
            <label class="act"><span>&nbsp;&nbsp;ДА: </span>
                {!! Form::radio('act', 1, false) !!}
            </label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::label('inspector', 'Кой е направил заверката:', ['class'=>'my_labels']) !!}
            {!! Form::select('inspector', $inspectors, null, ['id' =>'inspector',
                    'class' =>'inspector form-control form-control_my_inspector' ]) !!}

            <hr class="my_hr"/>

            <div class="col-md-12 text-center">
                {!! Form::submit('Редактирай!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection