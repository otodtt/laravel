<fieldset style="border: 3px solid black; padding: 10px; margin: 10px 5px 20px 5px">
    <legend style="width: 350px; text-align: center; border-bottom: none ;">Данни на фирмата на български:</legend>
    <div class="row">
        <div class="col-md-8" >
            <p class="description" >Изписва името на фирмата! Минимален брой символи - 4.<br/>
            {!! Form::label('trader_name', ' Име на фирмата:', ['class'=>'my_labels']) !!}
                <br>
            {!! Form::text('trader_name', null, ['class'=>'form-control form-control-my', 'size'=>100, 'maxlength'=>500 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('trader_name'))
                    {{ $errors->first('trader_name') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>
    <div class="row">
        <div class="col-md-8" >
            {!! Form::label('trader_address', 'Адрес на фирмата:', ['class'=>'my_labels']) !!}
            <br>
            {!! Form::text('trader_address', null, ['class'=>'form-control form-control-my', 'size'=>100, 'maxlength'=>500 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('trader_address'))
                    {{ $errors->first('trader_address') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>
    <div class="row">
        <div class="col-md-8" >
            {!! Form::label('trader_vin', 'ЕИК/Булстат. Изписват се само цифри:', ['class'=>'my_labels']) !!}
            <br>
            {!! Form::text('trader_vin', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('trader_vin'))
                    {{ $errors->first('trader_vin') }}<br/>
                @endif
            </span>
        </div>
    </div>

</fieldset>

<hr class="my_hr_in"/>

