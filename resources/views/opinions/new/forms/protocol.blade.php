<?php
if(isset($opinion)){
    if($opinion->date_protocol > 0){
        $date_protocol = date('d.m.Y', $opinion->date_protocol);
    }
    else{
        $date_protocol = null;
    }
    //////
    if($opinion->number_protocol == 0){
        $number_protocol = null;
    }
    else{
        $number_protocol = $opinion->number_protocol;
    }

}
else{
    $number_protocol = null;
    $date_protocol = null;
}
?>
<div class="col-md-12 col-md-6_my" >
    {!! Form::label('number_protocol', 'Протокол №', ['class'=>'my_labels']) !!}
    {!! Form::text('number_protocol', $number_protocol, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
    &nbsp;&nbsp;&nbsp;&nbsp;
    {!! Form::label('date_protocol', 'Дата:', ['class'=>'my_labels']) !!}
    {!! Form::text('date_protocol', $date_protocol, ['class'=>'form-control form-control-my date_certificate',
    'id'=>'date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}

    &nbsp;&nbsp;&nbsp;&nbsp;
    @if(isset($opinion))
        {!! Form::label('inspectors_protocol', 'Кой е написал Протокола:', ['class'=>'my_labels']) !!}
        {!! Form::select('inspectors_protocol', $inspectors, $opinion->user_protocol, ['id' =>'inspectors_protocol', 'class' =>'inspector form-control form-control_my_opinion' ]) !!}
    @else
        {!! Form::label('inspectors_protocol', 'Кой е написал Протокола:', ['class'=>'my_labels']) !!}
        {!! Form::select('inspectors_protocol', $inspectors, null, ['id' =>'inspectors_protocol', 'class' =>'inspector form-control form-control_my_opinion' ]) !!}
    @endif

    <hr class="hr_in"/>

    <span class="bold">Взета проба:</span>
    <label class="labels"><span>НЕ: </span>
        {!! Form::radio('assay_no', 0, false) !!}
    </label> |
    <label class="labels"><span>&nbsp;Остатъци от ПРЗ: </span>
        {!! Form::radio('assay_more', 1, false) !!}
    </label> |
    <label class="labels"><span>&nbsp;Идентификация на ПРЗ: </span>
        {!! Form::radio('assay_prz', 1, false) !!}
    </label> |
    <label class="labels"><span>&nbsp;Нитрати : </span>
        {!! Form::radio('assay_tor', 1, false) !!}
    </label> |
    <label class="labels"><span>&nbsp;Тежки метали: </span>
        {!! Form::radio('assay_metal', 1, false) !!}
    </label> |
    <label class="labels"><span>&nbsp;Микроб. замърсители: </span>
        {!! Form::radio('assay_micro', 1, false) !!}
    </label> |
    <label class="labels"><span>&nbsp;Други: </span>
        {!! Form::radio('assay_other', 1, false) !!}
    </label>
    <a href="javascript:ClearChecked();" class="fa fa-eraser btn btn-success my_btn_check"> Изчисти!</a>
    <input type="hidden" name="assay_error" value="0">
</div>