<?php
if(isset($protocol) && !empty($protocol)){
    if($protocol->assay_more !=0 || $protocol->assay_prz !=0 || $protocol->assay_tor !=0 || $protocol->assay_metal !=0
            || $protocol->assay_micro !=0 || $protocol->assay_other !=0){
        $assay_no = false;
    }
    else{
        $assay_no = true;
    }
}
else{
    $assay_no = false;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 example_bottom" >
            {{--/////////////////////////--}}
            <div class="col-md-12 col-md-6_my " >
                <fieldset class="small_field example_field">
                    <span class="bold">Взета проба:</span>
                    <label class="labels"><span>НЕ: </span>
                        {!! Form::radio('assay_no', 0, $assay_no) !!}
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
                </fieldset>
            </div>
            {{--/////////////////////////--}}
            <div class="col-md-12 col-md-6_my hidden" id="more_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            <span class="bold" style="width: 300px">Остатъци от ПРЗ - </span>
                            {!! Form::label('assay_more_name', 'Проба от:', ['class'=>'my_labels']) !!}
                            {!! Form::text('assay_more_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-12 col-md-6_my hidden" id="prz_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            <span class="bold" style="width: 300px">Идентификация на ПРЗ - </span>
                            {!! Form::label('assay_prz_name', 'Проба от:', ['class'=>'my_labels']) !!}
                            {!! Form::text('assay_prz_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-12 col-md-6_my hidden" id="tor_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            <span class="bold" style="width: 300px">Нитрати - </span>
                            {!! Form::label('assay_tor_name', 'Проба от:', ['class'=>'my_labels']) !!}
                            {!! Form::text('assay_tor_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-12 col-md-6_my hidden" id="metal_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            <span class="bold" style="width: 300px">Тежки метали - </span>
                            {!! Form::label('assay_metal_name', 'Проба от:', ['class'=>'my_labels']) !!}
                            {!! Form::text('assay_metal_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-12 col-md-6_my hidden" id="micro_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            <span class="bold" style="width: 300px">Микробиологични замърсители - </span>
                            {!! Form::label('assay_micro_name', 'Проба от:', ['class'=>'my_labels']) !!}
                            {!! Form::text('assay_micro_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-12 col-md-6_my hidden" id="other_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            <span class="bold" style="width: 300px">Други - </span>
                            {!! Form::label('assay_other_name', 'Проба от:', ['class'=>'my_labels']) !!}
                            {!! Form::text('assay_other_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>