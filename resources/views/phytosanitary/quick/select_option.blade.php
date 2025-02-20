{{--Номер и Дата на Заявлението--}}
<textarea id="w3review" name="w3review" rows="1" cols="100"></textarea>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Избери дали е Търговец или ЗС!</legend>
                <div class="col-md-8 col-md-6_my" >
                    <label >Фирмата е ТЪРГОВЕЦ
                        {!! Form::radio('result', 1, false, ['id'=>'trader']) !!}
                    </label>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

                    <label >Земеделски стопанин
                        {!! Form::radio('result', 2, false, ['id'=>'farmer']) !!}
                    </label>
                </div>
            </fieldset>
        </div>
    </div>
</div>
{{--Дата на Регистрационния номер--}}
<div class="container-fluid archive hidden" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">ЗЕМЕДЕЛЕЦ</legend>
                <div class="col-md-12 col-md-6_my" >
                    <span>Ако земеделеца е вписан в регистъра добави неговото ID!</span>
                    <hr class="my_hr_in"/>
                    <div class="row">
                        <div class="col-md-4" >
                            {!! Form::label('farmer_id', 'ID на земеделеца ако се знае', ['class'=>'my_labels']) !!}
                            {!! Form::text('farmer_id', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'number_petition' ]) !!}
                        </div>
                        <div class="col-md-4" >
                            {!! Form::label('pin', 'ЕГН/Булстат', ['class'=>'my_labels']) !!}
                            {!! Form::text('pin', null, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>10, 'id'=>'pin' ]) !!}
                        </div>
                    </div>
                    <hr class="my_hr_in"/>
                    <div class="row">
                        <div class="col-md-4" >
                            {!! Form::label('name_operator', 'Име на ЗС. Задължително!', ['class'=>'my_labels']) !!}
                            <br>
                            {!! Form::text('name_operator', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>100 ]) !!}
                        </div>
                        <div class="col-md-4" >
                            {!! Form::label('address', 'Населено мясо на ЗС. Задължително!', ['class'=>'my_labels']) !!}
                            <br>
                            {!! Form::text('address', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>100 ]) !!}
                        </div>
                        <div class="col-md-4" >
                            {!! Form::label('address_operator', 'Адреса на ЗС ако се знае!', ['class'=>'my_labels']) !!}
                            <br>
                            {!! Form::text('address_operator', null, ['class'=>'form-control form-control-my', 'size'=>70, 'maxlength'=>150 ]) !!}
                        </div>
                    </div>

                </div>
            </fieldset>
        </div>
    </div>
</div>

{{--ДРУГИ ДАННИ--}}
<div class="container-fluid hidden client" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">ДАННИ НА ТЪРГОВЕЦ</legend>
                <p>Името на търговеца и населеното място са ЗАДЪЛЖИТЕЛНИ! Другите данни ако се знаят или ще се попълнят после!</p>
                <hr class="my_hr_in"/>
                <div class="row">
                    <div class="col-md-4" >
                        {!! Form::label('trader_name', 'Име на Фирмата. Задължително!', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('trader_name', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>100 ]) !!}
                    </div>
                    <div class="col-md-4" >
                        {!! Form::label('city', 'Населено мясо на фирмата. Задължително!', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('city', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>100 ]) !!}
                    </div>
                    <div class="col-md-4" >
                        {!! Form::label('trader_address', 'Адреса на фирмата ако се знае!', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('trader_address', null, ['class'=>'form-control form-control-my', 'size'=>70, 'maxlength'=>150 ]) !!}
                    </div>
                </div>
                <hr class="my_hr_in"/>
                <div class="row">
                    <div class="col-md-4" >
                        {!! Form::label('trader_vin', 'ЕИК/Булстат Ако се знае!', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('trader_vin', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                    <div class="col-md-4" >
                        {!! Form::label('phone', 'Телефон Ако се знае!', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('phone', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
