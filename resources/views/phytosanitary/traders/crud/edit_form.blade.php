<fieldset style="border: 3px solid black; padding: 10px; margin: 10px 5px 20px 5px">
    <legend style="width: 350px; text-align: center; border-bottom: none ;">Данни на фирмата търговец:</legend>
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
        <div class="col-md-5" >
            {!! Form::label('trader_address', 'Адрес на фирмата:', ['class'=>'my_labels']) !!}
            <br>
            {!! Form::text('trader_address', null, ['class'=>'form-control form-control-my', 'size'=>100, 'maxlength'=>500 ]) !!}
        </div>
        <div class="col-md-4" >
            {!! Form::label('city', 'Град/Село на фирмата:', ['class'=>'my_labels']) !!}
            <br>
            {!! Form::text('city', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>500, 'placeholder'=> 'Град/Село' ]) !!}
        </div>
        <div class="col-md-3">
            <span class="errors">
                @if ($errors->has('trader_address'))
                    {{ $errors->first('trader_address') }}<br/>
                @endif
            </span>
            <span class="errors">
                @if ($errors->has('city'))
                    {{ $errors->first('city') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>

    <div class="row">
        <div class="col-md-8" >
            <p><span class="bold danger">ВНИМАНИЕ!</span> Булстата не може да се редактира.</p>
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('trader_vin'))
                    {{ $errors->first('trader_vin') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>
    <div class="row">
        <div class="col-md-8" >
            {!! Form::label('phone', 'Телефон. Изписват се само цифри:', ['class'=>'my_labels']) !!}
            <br>
            {!! Form::text('phone', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('phone'))
                    {{ $errors->first('phone') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>
    {{--<h4>Полетата са задължителни за да се попълни таблицата</h4>--}}
    <hr class="my_hr_in"/>

</fieldset>

<hr class="my_hr_in"/>

