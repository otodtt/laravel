<?php
if(isset($operator)){
    if($operator->update_number > 0 && $operator->update_date > 0){
        $update_date = date('d.m.Y', $operator->update_date);
    }
    else{
        $update_date = null;
    }
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field" ><legend class="small_legend"> Вписване в регистър</legend>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in" >
                        @if(isset($operator))
                            @if($operator->update_number > 0 && $operator->update_date)
                                <p class="description">
                                    Актуализация на данни.
                                </p>
                                <div class="col-md-8 col-md-6_my" >
                                    {!! Form::label('update_number', 'Заповед за Актуализация', ['class'=>'my_labels']) !!}
                                    {!! Form::text('update_number', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'update_number' ]) !!}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    {!! Form::label('update_date', 'Дата:', ['class'=>'my_labels']) !!}
                                    {!! Form::text('update_date', $update_date, ['class'=>'form-control form-control-my date_certificate',
                                    'id'=>'update_date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                                    <input type="hidden" name="is_update" value="1">
                                </div>
                            @else
                                <p class="description">
                                    Вписва се в регистъра за пъви път и е избрано "Вписване в регистър".
                                </p>
                                <hr class="hr_in"/>
                                {{--ЩЕ СЕ ДОРАБОТВА--}}
                                <label class="labels_limit"><span>Вписване в регистър</span>
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                </label>&nbsp;&nbsp;|
                                <label class="labels_limit"><span>&nbsp;&nbsp;Актуализация на данни</span>
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                </label>
                                <input type="hidden" name="is_update" value="0">
                            @endif
                        @else
                            <p class="description">
                                Вписва се в регистъра за първи път и е избрано "Вписване в регистър".
                            </p>
                            <hr class="hr_in"/>
                            {{--ЩЕ СЕ ДОРАБОТВА--}}
                            <label class="labels_limit"><span>Вписване в регистър</span>
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            </label>&nbsp;&nbsp;|
                            <label class="labels_limit"><span>&nbsp;&nbsp;Актуализация на данни</span>
                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                            </label>
                            <input type="hidden" name="is_update" value="0">
                        @endif
                    </fieldset>
                </div>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset id="show_type" class="small_field_in show_type ">
                        <p class="description">
                            Декларация за липса на промяна във вписаните в регистъра обстоятелства и данни от предходната година.
                        </p>
                        <hr class="hr_in"/>
                        <span>Декларация &nbsp;&nbsp;&nbsp;</span>
                        <label class="labels_limit"><span>ДА</span>
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                        </label>&nbsp;&nbsp;|
                        <label class="labels_limit"><span>&nbsp;&nbsp;НЕ</span>
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                        </label>
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>