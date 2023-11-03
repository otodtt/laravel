
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <fieldset class="small_field"><legend class="small_legend">Забележки, Номер и дата на Фактура</legend>
                <fieldset class="small_field_in" style="width: 49%; float: left">
                    <p class="description">
                        Поле 13 <span class="red bold">ВАЖНО!!!</span> Когато се избира "<span class="bold">За преработка</span>" текста
                        "Сертификатът се издава на основание чл. 4 т. 7 от Регламент (ЕС) 543/2011 г." <span class="bold">НЕ СЕ ВЪВЕЖДА!!!</span>
                        Ще се изпише автоматично. Тук се вписват САМО ако има други забележки!!!
                    </p>
                    <hr class="hr_in" />
                    {!! Form::text('observations', null, ['class'=>'form-control', 'style'=>'width: 99%; margin-top: 10px;
                    }', 'autocomplete'=>'observations']) !!}
                </fieldset>
                <fieldset class="small_field_in" style="width: 49%; float: right">
                    <p class="description"><span class="fa fa-warning red" aria-hidden="true"> ЗАДЪЛЖИТЕЛНО </span>
                        попълни сумата и името на спедитора!</p>
                    <hr class="hr_in"/>
                    {{-- <div class="col-md-12 col-md-6_my" >
                        {!! Form::label('sum', 'Сума', ['class'=>'my_labels']) !!}<br>
                        {!! Form::text('sum', null, ['class'=>'form-control form-control-my', 'size'=>5, 'maxlength'=>10 ]) !!}
                    </div> --}}
                    <div class="col-md-12 col-md-6_my" >
                        {!! Form::label('forwarder', 'Име на спедитора:', ['class'=>'my_labels']) !!}<br>
                        {!! Form::text('forwarder', null, ['class'=>'form-control form-control-my', 'size'=>70, 'maxlength'=>100, 'placeholder'=>'Име на спедитора', ]) !!}
                    </div>
                    <div class="col-md-12 col-md-6_my" >
                        {!! Form::label('forwarder_address', 'Адрес на спедитора:', ['class'=>'my_labels']) !!}<br>
                        {!! Form::text('forwarder_address', null, ['class'=>'form-control form-control-my',
                        'id'=>'forwarder_address', 'size'=>70, 'maxlength'=>500, 'placeholder'=>'Адрес',  'autocomplete'=>'off' ]) !!}
                    </div>
                </fieldset>
            </fieldset>
        </div>
    </div>
</div>