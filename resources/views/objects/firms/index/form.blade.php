<div class="row">
    <div class="col-md-8" >
        @include('objects.firms.index.radio')
    </div>
    <div class="col-md-4 ">
        <span class="errors">
            {{ $errors->first('type_firm') }}
        </span>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-8" >
        <p class="description" >Изписва се само името на фирмата без ЕТ, ООД или ЕООД! Минимален брой символи - 4.<br/>
            Ако е избрано <span class="bold">"Друго"</span> тогава се изписва със съкращението - ЗПК Надежда</p>
        {!! Form::label('name', ' Име на Фирмата:', ['class'=>'my_labels']) !!}
        {!! Form::text('name', null, ['class'=>'form-control form-control-my', 'size'=>45, 'maxlength'=>250 ]) !!}
    </div>
    <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('name'))
                {{ $errors->first('name') }}<br/>
            @endif
        </span>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-8" >
        @include('layouts.forms.locations')
    </div>
    <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('error'))
                {{ $errors->first('error') }}<br/>
            @endif
            @if ($errors->has('list_name'))
                {{ $errors->first('list_name') }}<br/>
            @endif
                @if ($errors->has('localsID'))
                    {{ $errors->first('localsID') }}<br/>
                @endif
        </span>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-8" >
        {!! Form::label('address', 'Адрес на Фирмата:', ['class'=>'my_labels']) !!}
        {!! Form::text('address', null, ['class'=>'form-control form-control-my', 'size'=>60, 'maxlength'=>250 ]) !!}
    </div>
    <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('address'))
                {{ $errors->first('address') }}<br/>
            @endif
        </span>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-8" >
        {!! Form::label('bulstat', 'ЕИК/Булстат:', ['class'=>'my_labels']) !!}
        {!! Form::text('bulstat', null, ['class'=>'form-control form-control-my', 'maxlength'=>13 ]) !!}
    </div>
    <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('bulstat'))
                {{ $errors->first('bulstat') }}<br/>
            @endif
        </span>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-8">
        @include('layouts.forms.pin')
    </div>
    <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('owner'))
                {{ $errors->first('owner') }}<br/>
            @endif
                @if ($errors->has('gender'))
                    {{ $errors->first('gender') }}<br/>
                @endif
            @if ($errors->has('pin'))
                {{ $errors->first('pin') }}<br/>
            @endif
        </span>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-8" >
        @include('layouts.forms.phone')
    </div>
    <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('phone'))
                {{ $errors->first('phone') }}<br/>
            @endif
            @if ($errors->has('mobil'))
                {{ $errors->first('mobil') }}<br/>
            @endif
            @if ($errors->has('email'))
                {{ $errors->first('email') }}<br/>
            @endif
        </span>
    </div>
</div>
<hr class="my_hr_in"/>