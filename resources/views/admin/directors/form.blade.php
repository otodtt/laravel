<fieldset>
    <span class="description">Полето се попълва ако е временно изпълняващ или друго. Пример "И.Д.", "ИФ" и т.н.</span><br>
    {!! Form::label('type_dir', ' ИД или ИФ:', ['class'=>'labels']) !!}
    {!! Form::text('type_dir', null, ['class'=>'sample2', 'placeholder'=>'И.Д. И.Ф.', 'title'=>'Ако е ИД или ИФ', 'size'=>30 ]) !!}
    <span class="error">
        {{ $errors->first('type_dir') }}
    </span>
</fieldset>
<fieldset>
    <span class="description">Полето се попълва ако има титла. Пример "Д-р", "Ст. н.с." и т.н.</span><br>
    {!! Form::label('degree', ' Титла ако има:', ['class'=>'labels']) !!}
    {!! Form::text('degree', null, ['class'=>'sample2', 'placeholder'=>'Д-р, Доцент', 'title'=>'Ако има титла преди името', 'size'=>30 ]) !!}
    <span class="error">
        {{ $errors->first('degree') }}
    </span>
</fieldset>
<fieldset>
    &nbsp; <span class="bold">Име:</span>
    {!! Form::text('name', null, ['class'=>'sample2', 'size'=>20 ]) !!} |
    <span class="bold">Презиме:</span>
    {!! Form::text('surname', null, ['class'=>'sample2', 'size'=>20 ]) !!} |
    <span class="bold">Фамилия:</span>
    {!! Form::text('family', null, ['class'=>'sample2', 'size'=>20 ]) !!}
    <span class="error"><br/>
        {{ $errors->first('name') }}
        {{ $errors->first('surname') }}
        {{ $errors->first('family') }}
    </span>
</fieldset>
<fieldset>
    <?php if (isset($director->start_date)) {
        $value = date('d.m.Y', $director->start_date);
    } else {
        $value = null;
    }
    ?>
    <span class="description">Датата от която е назначен.</span><br>
        {!! Form::label('start_date', ' Начална дата::', ['class'=>'labels']) !!}
        {!! Form::text('start_date', $value, ['class'=>'sample2', 'size'=>30, 'id'=>'start_date']) !!}
    <span class="error">
        {{ $errors->first('start_date') }}
    </span>
</fieldset>
<br/>