<div class="row">
    <div class="col-md-8" >
        @include('objects.firms.index.radio')
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-12" >
        <p class="description" >Изписва се само името на фирмата без ЕТ, ООД или ЕООД!
            Ако е избрано <span class="bold">"Друго"</span> тогава се изписва със съкращението - ЗПК Надежда</p>
        {!! Form::label('name', ' Име на Фирмата:', ['class'=>'my_labels']) !!}
        {!! Form::text('name', null, ['class'=>'form-control form-control-my', 'size'=>60, 'maxlength'=>250 ]) !!}
        &nbsp; | &nbsp;
        {!! Form::label('bulstat', 'ЕИК/Булстат:', ['class'=>'my_labels']) !!}
        {!! Form::text('bulstat', null, ['class'=>'form-control form-control-my', 'maxlength'=>13, 'size'=>15, ]) !!}
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-12" >
        @include('layouts.forms.locations')
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-8" >
        {!! Form::label('address', 'Адрес на Фирмата:', ['class'=>'my_labels']) !!}
        {!! Form::text('address', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>250 ]) !!}
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-12">
        @include('admin.factories.forms.pin')
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-12" >
        @include('layouts.forms.phone')
    </div>
</div>
<hr class="my_hr_in"/>