<?php
    if(isset($passport) && !empty($passport)){
        if($passport->date_invoice == 0){
            $date_invoice = null;
        }
        else{
            $date_invoice = date('d.m.Y', $passport->date_invoice);
        }


        if($passport->date_permit == 0){
            $date_permit = null;
        }
        else{
            $date_permit = date('d.m.Y', $passport->date_permit);
        }

    }
    else{
        $date_invoice = null;
        $date_permit = null;
    }

?>
@if(!isset($passports))
    <div class="container-fluid" >
        {{--<p class="bold "><span class="red"> Последно използван номер за Паспорт e {!! $last !!}.</span> Използвай {!! $last_plus !!} !</p>--}}
        <div class="row">
            <div class="col-md-4" >
                <fieldset class="small_field"><legend class="small_legend">Номер и дата на Паспорт</legend>
                    <div class="col-md-6 col-md-6_my" >
                        <p>Номера на Паспорта не може да се редактира!</p>
                        <input type="hidden" name="passport" id="passport" value="{{$passport->passport}}">
                    </div>
                    <div class="col-md-6" >
                        {!! Form::label('date_permit', 'Дата:', ['class'=>'my_labels']) !!}
                        {!! Form::text('date_permit', $date_permit, ['class'=>'form-control form-control-my date_certificate',
                        'id'=>'date_permit', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                    </div>
                </fieldset>
            </div>
            <div class="col-md-4 ">
                <p class="description">
                    <br/>
                    <span class="fa fa-warning red" aria-hidden="true"> ВНИМАНИЕ! </span> Номера на Паспорта е попълнен автоматично. Не променяй ако не е необходимо!
                </p>
            </div>
            <div class="col-md-4" >
                <fieldset class="small_field"><legend class="small_legend">Номер и дата на Фактурата</legend>
                    {!! Form::label('invoice', 'Фактура №', ['class'=>'my_labels']) !!}
                    {!! Form::text('invoice', null, ['class'=>'form-control form-control-my', 'size'=>7, 'maxlength'=>15 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_invoice', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_invoice', $date_invoice , ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_invoice', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </fieldset>
            </div>
        </div>
    </div>
@else
    <p class="bold">Редактиране на Разрешително № {!! $passports->passport !!} от {!! date('d.m.Y', $passports->passport_date) !!} г.</p>
@endif


