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
            {!! Form::text('trader_vin', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>10 ]) !!}
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
    <h4>Полетата са задължителни за да се попълни таблицата</h4>
    <hr class="my_hr_in"/>
    {{--<div class="row">--}}
        {{--<div class="col-md-4" >--}}
            {{--{!! Form::label('activity', 'Дейност/и по чл. 65(1)', ['class'=>'my_labels']) !!}--}}
            {{--<br>--}}
            {{--{!! Form::text('activity', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}--}}
        {{--</div>--}}
        {{--<div class="col-md-2">--}}
            {{--<span class="errors">--}}
                {{--@if ($errors->has('activity'))--}}
                    {{--{{ $errors->first('activity') }}<br/>--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-4" >--}}
            {{--{!! Form::label('products', 'Естество (изписват се растенията)', ['class'=>'my_labels']) !!}--}}
            {{--<br>--}}
            {{--{!! Form::text('products', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}--}}
        {{--</div>--}}
        {{--<div class="col-md-2">--}}
            {{--<span class="errors">--}}
                {{--@if ($errors->has('products'))--}}
                    {{--{{ $errors->first('products') }}<br/>--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<hr class="my_hr_in"/>--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-4" >--}}
            {{--{!! Form::label('derivation', 'Произход на растенията', ['class'=>'my_labels']) !!}--}}
            {{--<br>--}}
            {{--{!! Form::text('derivation', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}--}}
        {{--</div>--}}
        {{--<div class="col-md-2">--}}
            {{--<span class="errors">--}}
                {{--@if ($errors->has('derivation'))--}}
                    {{--{{ $errors->first('derivation') }}<br/>--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-4" >--}}
            {{--{!! Form::label('purpose', 'Предназначение ', ['class'=>'my_labels']) !!}--}}
            {{--<br>--}}
            {{--{!! Form::text('purpose', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}--}}
        {{--</div>--}}
        {{--<div class="col-md-2">--}}
            {{--<span class="errors">--}}
                {{--@if ($errors->has('purpose'))--}}
                    {{--{{ $errors->first('purpose') }}<br/>--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<hr class="my_hr_in"/>--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-4" >--}}
            {{--{!! Form::label('room', 'Адрес на помещенията', ['class'=>'my_labels']) !!}--}}
            {{--<br>--}}
            {{--{!! Form::text('room', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}--}}
        {{--</div>--}}
        {{--<div class="col-md-2">--}}
            {{--<span class="errors">--}}
                {{--@if ($errors->has('room'))--}}
                    {{--{{ $errors->first('room') }}<br/>--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-4" >--}}
            {{--{!! Form::label('action', 'Дейност/и по чл. 66(2) ', ['class'=>'my_labels']) !!}--}}
            {{--<br>--}}
            {{--{!! Form::text('action', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}--}}
        {{--</div>--}}
        {{--<div class="col-md-2">--}}
            {{--<span class="errors">--}}
                {{--@if ($errors->has('action'))--}}
                    {{--{{ $errors->first('action') }}<br/>--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</div>--}}
    {{--</div>--}}

</fieldset>

<hr class="my_hr_in"/>

