<div class="row" style="margin: 20px 0 10px 0">
    <div>
        <div class="col-md-6" >
            <p class="description">Задължително маркирай дали фирмата е българска или не!</p>
            <p class="description">Ако фирмата не е българска не е задължително да се попълват полетата име и адрес на бългаски!</p>
            {!! Form::label('is_bulgarian', ' Фирмата е българска:', ['class'=>'labels']) !!}
            &nbsp;<label >ДА
                {!! Form::radio('is_bulgarian', 0, null,['required']) !!}
            </label>&nbsp; | &nbsp;

            &nbsp;<label >НЕ
                {!! Form::radio('is_bulgarian', 1, false) !!}
            </label>
        </div>
        <div class="col-md-6 ">
            <p class="description">Задължително маркирай дейността на фирмата!</p>
            <p class="description">В зависимост от това ще се появи в различните падащи менюта!</p>
            &nbsp;<label >Внос
                {!! Form::radio('trade', 0, null,['required']) !!}
            </label>&nbsp; | &nbsp;

            &nbsp;<label >Износ
                {!! Form::radio('trade', 1, false) !!}
            </label>&nbsp; | &nbsp;

            &nbsp;<label >Внос/Износ
                {!! Form::radio('trade', 2, false) !!}
            </label>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>
<fieldset style="border: 3px solid black; padding: 10px; margin: 10px 5px 20px 5px">
    <legend style="width: 350px; text-align: center; border-bottom: none ;">Данни на фирмата на български:</legend>
    <div class="row">
        <div class="col-md-8" >
            <p class="description" >Изписва пълното име на фирмата с вида на фирмата (ЕТ, ООД, ЕООД  и т.х.)! Минимален брой символи - 4.<br/>
            {!! Form::label('name_bg', ' Име на фирмата на български:', ['class'=>'my_labels']) !!}
            {!! Form::text('name_bg', null, ['class'=>'form-control form-control-my', 'size'=>45, 'maxlength'=>250 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('name_bg'))
                    {{ $errors->first('name_bg') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>
    <div class="row">
        <div class="col-md-8" >
            {!! Form::label('address_bg', 'Адрес на фирмата на български:', ['class'=>'my_labels']) !!}
            {!! Form::text('address_bg', null, ['class'=>'form-control form-control-my', 'size'=>60, 'maxlength'=>250 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('address_bg'))
                    {{ $errors->first('address_bg') }}<br/>
                @endif
            </span>
        </div>
    </div>

</fieldset>

<fieldset style="border: 3px solid black; padding: 10px; margin: 10px 5px 20px 5px">
    <legend style="width: 350px; text-align: center; border-bottom: none ;">Данни на фирмата на английски:</legend>
    <div class="row">
        <div class="col-md-8" >
            <p class="description" >Изписва името на фирмата с латински символи! Минимален брой символи - 4.<br/>
            {!! Form::label('name_en', ' Име на фирмата на латиница:', ['class'=>'my_labels']) !!}
            {!! Form::text('name_en', null, ['class'=>'form-control form-control-my', 'size'=>45, 'maxlength'=>250 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('name_en'))
                    {{ $errors->first('name_en') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>
    <div class="row">
        <div class="col-md-8" >
            {!! Form::label('address_en', 'Адрес на фирмата на латиница:', ['class'=>'my_labels']) !!}
            {!! Form::text('address_en', null, ['class'=>'form-control form-control-my', 'size'=>60, 'maxlength'=>250 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('address_en'))
                    {{ $errors->first('address_en') }}<br/>
                @endif
            </span>
        </div>
    </div>

</fieldset>

<hr class="my_hr_in"/>

<div class="row" style="margin: 20px 0 10px 0">
    <div class="col-md-8" >
        <p class="description"><span class="bold red">ВАЖНО!</span> Ако фирмата е българска се изписват само цифри без идентификатор BG! Ако е чужда се изписва всичко!</p>
        <p class="description"><span class="bold red">ВАЖНО!</span>  Ако е чужда се изписва всичко или се оставя празно!</p>
        {!! Form::label('vin', 'ЕИК/Булстат:', ['class'=>'my_labels']) !!}
        {!! Form::text('vin', null, ['class'=>'form-control form-control-my', 'maxlength'=>40 ]) !!}
    </div>
    <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('vin'))
                {{ $errors->first('vin') }}<br/>
            @endif
        </span>
    </div>
</div>
<hr class="my_hr_in"/>