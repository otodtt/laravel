@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error  }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('message')
    @include('admin.alerts.success')
@endsection
{!! Form::open(['url'=>'стопанин/'.$farmer->id , 'method'=>'POST', 'id'=>'form']) !!}
    {!! Form::label('date_diary', 'Дата на заверка:', ['class'=>'my_labels']) !!}
    {!! Form::text('date_diary', null, ['class'=>'form-control form-control-my date_certificate',
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

    <input type="hidden" name="search" value="1" id="search">
    {!! Form::submit('Добави Заверка!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
{!! Form::close() !!}