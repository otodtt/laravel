
<?php
if(!isset($protocol)){
    $return_date = null;

}
else{
    $return_date = date('d.m.Y', $protocol->date_protocol);
}
?>
<span class="bold">ВИД НА ПРОВЕРКАТА:</span>&nbsp;&nbsp;
<label class="type_check"><span>НА ТЕРЕН: </span>
    {!! Form::radio('type_check', 1, true) !!}
</label>&nbsp;&nbsp;|
<label class="type_check"><span>&nbsp;&nbsp;ДОКУМЕНТАЛНА: </span>
    {!! Form::radio('type_check', 2, false) !!}
</label>

<hr class="my_hr"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Протокола</legend>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('number', 'Протокол №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_protocol', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_protocol', $return_date, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
                <div class="col-md-3 col-md-6_my"  >
                    <p class="description">Полетата са ЗАДЪЛЖИТЕЛНИ!</p>
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <p class="error description">{{ $errors->first('number') }}</p>
                    <p class="error description">{{ $errors->first('date_protocol') }}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Инспектори</legend>
                <div class="col-md-7 col-md-6_my inspectors_divs border_divs" >
                    {!! Form::label('inspector', 'Водещ:', ['class'=>'my_labels']) !!}
                    {!! Form::select('inspector', $inspectors, null, ['id' =>'id_user',
                            'class' =>'inspector form-control form-control_my_insp' ]) !!}

                    {!! Form::label('inspector_two', 'Инспектор 2:', ['class'=>'my_labels']) !!}
                    {!! Form::select('inspector_two', $inspectors, null, ['id' =>'id_user_two',
                            'class' =>'inspector form-control form-control_my_insp' ]) !!}

                    {!! Form::label('inspector_three', 'Инспектор 3:', ['class'=>'my_labels']) !!}
                    {!! Form::select('inspector_three', $inspectors, null, ['id' =>'id_user_three',
                            'class' =>'inspector form-control form-control_my_insp' ]) !!}
                </div>
                <div class="col-md-5 col-md-6_my inspectors_divs">
                    <p class="description" >Задължително се избира водещ инспектор! Останалите са опционални!</p>
                </div>

                <div class="col-md-8 col-md-6_my" >
                    {!! Form::label('inspector_another', 'Инспектор от друга служба:', ['class'=>'my_labels']) !!}
                    {!! Form::text('inspector_another', null, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>250 ]) !!}

                    {!! Form::label('inspector_from', ' От служба:', ['class'=>'my_labels']) !!}
                    {!! Form::text('inspector_from', null, ['class'=>'form-control form-control-my', 'size'=>20, 'maxlength'=>50 ]) !!}

                </div>

                <div class="col-md-4 col-md-6_my" >
                    <p class="error description">{{ $errors->first('inspector') }}</p>
                    <p class="error description">{{ $errors->first('inspector_two') }}</p>
                    <p class="error description">{{ $errors->first('inspector_three') }}</p>
                    <p class="error description">{{ $errors->first('inspector_another') }}</p>
                    <p class="error description">{{ $errors->first('inspector_from') }}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>

