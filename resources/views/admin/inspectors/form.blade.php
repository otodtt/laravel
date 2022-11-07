<fieldset>
    <span class="description"><span class="bold">Задължително</span> маркирай дали е дестващ инспектор!</span><br/>
    {!! Form::label('active', ' Действащ ли е:', ['class'=>'labels']) !!}
    <label><span>&nbsp;&nbsp;Да: </span>
        {!! Form::radio('active', 1, false) !!}
    </label>
    <label><span>&nbsp;&nbsp;Не: </span>
        {!! Form::radio('active', 2, false) !!}
    </label>
</fieldset>

<fieldset>
    <span class="description"><span class="bold">Задължително</span> избери длъжността на инспектора!</span><br/>
    <?php
        if(isset($user->dlaznost)){
            $user_sel = $user->dlaznost;
        }
        else{
            $user_sel = '';
        }
    ?>
    {!! Form::label('dlaznost', ' Длъжост:', ['class'=>'labels']) !!}
    {!! Form::select('dlaznost',
        array('' => 'Избери длъжност', 1 =>'Началник отдел',2 => 'Главен инспектор', 3 => 'Старши инспектор',
        4 => 'Инспектор', 5 => 'Главен експерт', 6 => 'Старши експерт', 7 => 'Експерт'),
        $user_sel,['id' => 'dlaznost'])
    !!}
</fieldset>

<fieldset>
    <div class="col-md-3" >
        <table>
            <tr>
                <td>{!! Form::label('rz', 'Контрол:', ['class'=>'labels']) !!}</td>
                <td>
                    <label><span>&nbsp;&nbsp;Да: </span>
                        {!! Form::radio('rz', 1, false) !!}
                    </label>
                    <label><span>&nbsp;&nbsp;Не: </span>
                        {!! Form::radio('rz', 0, true) !!}
                    </label>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('orz', 'ОРЗ:', ['class'=>'labels']) !!}</td>
                <td>
                    <label><span>&nbsp;&nbsp;Да: </span>
                        {!! Form::radio('orz', 1, false) !!}
                    </label>
                    <label><span>&nbsp;&nbsp;Не: </span>
                        {!! Form::radio('orz', 0, true) !!}
                    </label>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('fsk', 'ФСК:', ['class'=>'labels']) !!}</td>
                <td>
                    <label><span>&nbsp;&nbsp;Да: </span>
                        {!! Form::radio('fsk', 1, false) !!}
                    </label>
                    <label><span>&nbsp;&nbsp;Не: </span>
                        {!! Form::radio('fsk', 0, true) !!}
                    </label>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('ppz', 'КППЗ:', ['class'=>'labels']) !!}</td>
                <td>
                    <label><span>&nbsp;&nbsp;Да: </span>
                        {!! Form::radio('ppz', 1, false) !!}
                    </label>
                    <label><span>&nbsp;&nbsp;Не: </span>
                        {!! Form::radio('ppz', 0, true) !!}
                    </label>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('lab', 'Лаборатория:', ['class'=>'labels']) !!}</td>
                <td>
                    <label><span>&nbsp;&nbsp;Да: </span>
                        {!! Form::radio('lab', 1, false) !!}
                    </label>
                    <label><span>&nbsp;&nbsp;Не: </span>
                        {!! Form::radio('lab', 0, true) !!}
                    </label>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-9" >
        <span class="description"><span class="bold red"><i class="fa fa-warning"></i> ВАЖНО!</span> Прочети преди да продължиш!!</span><br/>
        <span class="description">1. Ако се избере "Началник одел", ЗАДЪЛЖИТЕЛНО се маркират с "ДА" всички сектори!</span><br/>
        <span class="description">2. Ако се маркира, че има Администраторски права, ЗАДЪЛЖИТЕЛНО се маркират с "ДА" всички сектори!</span><br/>
        <span class="description">3. Задължително се избира поне една от посечениете възможности! Може и няколко.</span><br/>
        <span class="description">В зависимост от това кой сектор е избран, инспекторът ще има права да добавя или редактира
        документи. За останалите, само ще вижда определени страници. Н-к одела и Администратора трябва да иамат достъп
        до всички страници.</span><br/>
    </div>
</fieldset>

<fieldset>
    <span class="description">Попълни име и фамиля на инспектора! Ако е маркиран КППЗ, попълни името на английски!</span><br/>
    {!! Form::label('all_name', ' Име на Инспектора:', ['class'=>'labels']) !!}
    {!! Form::text('all_name', null, ['class'=>'sample2', 'placeholder'=>'Иван Петров', 'title'=>'Трите имена или Име и Фамилия на инспектора', 'size'=>30 ]) !!}
    {!! Form::label('all_name_en', ' Имена на Английски:', ['class'=>'labels', 'style'=>'float: right; margin-right: 50px' ]) !!}
    {!! Form::text('all_name_en', null, ['class'=>'sample2', 'placeholder'=>'Ivan Petrov', 'title'=>'Трите имена на английски', 'size'=>30, 'style'=>'float: right; margin-right: 0px' ]) !!}
    <span class="error">
        {{ $errors->first('all_name') }}
    </span>
    <br/>
    {!! Form::label('karta', ' № на сл. Карта:', ['class'=>'labels']) !!}
    {!! Form::text('karta', null, ['class'=>'sample2', 'placeholder'=>'26062', 'title'=>'Номер на сл. карта. Само с цифри!', 'size'=>20 ]) !!}

    <br/>
    <span class="description">Попълни само Фамилията или съкратено име и фамилия! Пример: Ив. Петров</span><br/>
    {!! Form::label('short_name', ' Кратко име:', ['class'=>'labels']) !!}
    {!! Form::text('short_name', null, ['class'=>'sample2', 'placeholder'=>'Ив. Петров', 'title'=>'Само Фамилията или съкратено име и фамилия', 'size'=>20 ]) !!}
</fieldset>

<fieldset>
    <span class="description"> Логин името <span class="bold">ЗАДЪЛЖИТЕЛНО</span> се изписва на латиница! Това е името с което ще влиза в системата. <span
                class="bold">Трябва да е уникално!</span></span><br/>

    {!! Form::label('name', ' Логин име:', ['class'=>'labels']) !!}
    {!! Form::text('name', null, ['class'=>'sample2', 'placeholder'=>'login name', 'title'=>'Името с което ще влиза в системата', 'size'=>20 ]) !!}
</fieldset>

<fieldset>
    <span class="description"> Номер на печат <span class="bold red">ЗАДЪЛЖИТЕЛНО</span> се изписва когато е избран инспектор от КППЗ.
        <span class="bold">Ако е администратор без печат добави число над 5000!</span>
        <span class="bold">Номера трябва да е уникален!</span>
    </span><br/>

    {!! Form::label('stamp_number', ' Номер на печат:', ['class'=>'labels']) !!}
    {!! Form::text('stamp_number', null, ['class'=>'sample2', 'placeholder'=>'Номер на печат', 'title'=>'Номера на личния печат', 'size'=>20 ]) !!}
</fieldset>

<fieldset>
    <span class="description"> За парола се използват малки и големи латиски букви и цифри с минимум 4 символа.</span><br/>
    {!! Form::label('password', ' Парола:', ['class'=>'labels']) !!}
    {!! Form::password('password', null, ['maxlength'=>15 ]) !!}

    {!! Form::label('password', ' Повтори Паролата', ['class'=>'labels']) !!}
    {!! Form::password('password2', null, ['maxlength'=>15 ]) !!}
    <br/>
</fieldset>

<fieldset>
    <span class="description"><span class="bold">Да има ли администраторски права?</span></span><br/>
    {!! Form::label('admin', ' Админ. Права:', ['class'=>'labels']) !!}
    <label><span>&nbsp;&nbsp;Не: </span>
        {!! Form::radio('admin', 1, true) !!}
    </label>
    <label><span>&nbsp;&nbsp;Да: </span>
        {!! Form::radio('admin', 2, false) !!}
    </label>
</fieldset>
{!! Form::hidden('error_type', 0, ['id' =>'error_type']) !!}
<br/>
