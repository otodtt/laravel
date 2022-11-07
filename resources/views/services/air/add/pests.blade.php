<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Продукти за Растителна Защита</legend>
                <div class="col-md-12 col-md-6_my" >
                    <div class="col-md-12 col-md-6_my"  >
                        <p class="description">
                            В полето "ПРЗ" се описват продуктите с които ще се третира с пълното им търговско наименование.
                            В полето "Доза на дка" се изписва дозата или концентрацията, като се спазва последователността на
                            описаните преди това ПРЗ. В полето "Карантинен срок на ПРЗ" се изписва карантинния срок на
                            Продукта за РЗ с най-дълаг такъв. Ако Продукта/те нямат карантинен срок се изписва "0"
                        </p>
                    </div>
                    <div class="col-md-12 col-md-6_my"  >
                        {!! Form::label('prz', 'ПРЗ:', ['class'=>'my_labels']) !!}
                        {!! Form::text('prz', null, ['class'=>'form-control form-control-my', 'size'=>45, 'maxlength'=>500 ]) !!}
                        &nbsp;
                        {!! Form::label('dose', 'Доза на дка:', ['class'=>'my_labels']) !!}
                        {!! Form::text('dose', null, ['class'=>'form-control form-control-my',
                        'id'=>'dose', 'size'=>45, 'maxlength'=>500 ]) !!}
                        &nbsp;
                        {!! Form::label('quarantine', 'Карантинен срок на ПРЗ:', ['class'=>'my_labels']) !!}
                        {!! Form::text('quarantine', null, ['class'=>'form-control form-control-my ',
                        'id'=>'quarantine', 'size'=>3, 'maxlength'=>20]) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>