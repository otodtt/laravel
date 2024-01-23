<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field" ><legend class="small_legend">VIII.  ДАННИ НА ЛИЦАТА ЗА КОНТАКТ  </legend>
                <p class="description bold">
                    VIII.  ДАННИ НА ЛИЦАТА ЗА КОНТАКТ  (спедиторски фирми, технически изпълнители, преки производители, вносители, други)
                </p>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in" >
                        {!! Form::label('contact', 'Име и фамилия', ['class'=>'my_labels']) !!}
                        {!! Form::text('contact', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>6, 'id'=>'contact' ]) !!}
                        {{--</label>--}}
                        <hr class="hr_in"/>
                        {!! Form::label('contact_phone', 'Телефон', ['class'=>'my_labels']) !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::text('contact_phone', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>10, 'id'=>'contact_phone' ]) !!}
                    </fieldset>
                </div>

                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in" >
                        {!! Form::label('contact_address', 'Адрес:', ['class'=>'my_labels']) !!}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::text('contact_address', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>500, 'id'=>'contact_address' ]) !!}
                        {{--</label>--}}
                        <hr class="hr_in"/>
                        {!! Form::label('contact_city', 'Село/Град/Община/Област:', ['class'=>'my_labels']) !!}
                        {!! Form::text('contact_city', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>500, 'id'=>'contact_city' ]) !!}
                    </fieldset>
                </div>
                <div class="col-md-12 col-md-6_my in_table">
                    <fieldset class="small_field_in" ><legend class="small_legend">Място и дата на подаване</legend>
                        {!! Form::label('place', 'Място на подаване:', ['class'=>'my_labels']) !!}
                        {!! Form::text('place', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>500, 'id'=>'place' ]) !!}
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::label('date_place', 'Дата на подаване:', ['class'=>'my_labels']) !!}
                        {!! Form::text('date_place', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>10, 'id'=>'date_place',
                         'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off']) !!}
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>