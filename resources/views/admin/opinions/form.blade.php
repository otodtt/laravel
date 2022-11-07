<div class="form-group">
    <label class="col-md-4 control-label">Избери период: </label>
    <div class="col-md-6">
        {!! Form::select('period', array(0 => 'избери период', 1 =>'2007 - 2013',2 => '2014 - 2020'), null,['id' => 'period'])!!}
    </div>
    <br/>
</div>
<br/>
<div class="form-group">
    <label class="col-md-4 control-label">Пълно име на Мярката: </label>
    <div class="col-md-6">
        {!! Form::text('full_name', null, ['class'=>'form-control', 'placeholder'=>'141 - Полупазарни Стопанства']) !!}
    </div>
    <br/>
</div>
<br/>
<div class="form-group">
    <label class="col-md-4 control-label">Кратко име: </label>
    <div class="col-md-6">
        {!! Form::text('short_name', null, ['class'=>'form-control', 'placeholder'=>'141 - ПП С-ва']) !!}
    </div>
    <br/>
</div>

<div class="form-group">
    <br/>
    {!! Form::label('new', 'Да се показва?', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <label><span>&nbsp;&nbsp;Да: </span>
            {!! Form::radio('show_rate', 1, false) !!}
        </label>
        <label><span>&nbsp;&nbsp;Не: </span>
            {!! Form::radio('show_rate', 0, false) !!}
        </label>
    </div>
</div>