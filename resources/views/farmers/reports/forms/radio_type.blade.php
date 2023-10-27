<?php
if(isset($protocol) && !empty($protocol)){
    $date_protocol = date('d.m.Y', $protocol->date_protocol);
}
else{
    $date_protocol = null;
}
?>
<div class="row" >
    <div class="col-md-6 col-md-6_my" >
        @if(isset($protocol) && !empty($protocol))
            @if($protocol->opinions == 0)
                {!! Form::label('check_id', 'ВИД НА ПРОВЕРКАТА:', ['class'=>'my_labels check_span']) !!}
                {!! Form::select('check_id', $checks, null, ['id' =>'check_id',
                        'class' =>'inspector form-control form-control_my_insp' ]) !!}
            @else
                <p style="margin-left: 20px" class="bold">Протокол издаден за Становище по мярка {{ $protocol->description }}</p>
            @endif
        @else
            {!! Form::label('check_id', 'ВИД НА ПРОВЕРКАТА:', ['class'=>'my_labels check_span']) !!}
            {!! Form::select('check_id', $checks, null, ['id' =>'check_id',
                    'class' =>'inspector form-control form-control_my_insp' ]) !!}
        @endif
    </div>
    <div class="col-md-6 col-md-6_my" >
        <span class="bold">ПРОВЕРКАТА Е:</span>&nbsp;&nbsp;
        <label class="type_check"><span>&nbsp;&nbsp;ДОКУМЕНТАЛНА: </span>
            {!! Form::radio('type_check', 1, false) !!}
        </label>
        <label class="type_check"><span>НА ТЕРЕН: </span>
            {!! Form::radio('type_check', 2, false) !!}
        </label>
    </div>
</div>