<?php
if(!isset($protocols)){
    $prz_no = false;
    $prz_yes = false;
    $tor_no = false;
    $tor_yes = false;
    $eo_no = false;
    $eo_yes = false;
    $return_ascertainment = null;
    $return_taken = null;
    $return_order_protocol = null;
}
else{
    if($protocols->assay_prz == 0){
        $prz_no = true;
        $prz_yes = false;
    }
    if($protocols->assay_prz == 1){
        $prz_no = false;
        $prz_yes = true;
    }
    ///////////
    if($protocols->assay_tor == 0){
        $tor_no = true;
        $tor_yes = false;
    }
    if($protocols->assay_tor == 1){
        $tor_no = false;
        $tor_yes = true;
    }
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 example_bottom" >
            <div class="col-md-6 col-md-6_my ">
                <fieldset class="small_field example_field">
                    <span class="bold">Взета проба от ПРЗ за идентификация:</span>&nbsp;&nbsp;
                    <label class="assay_prz"><span>НЕ: </span>
                        {!! Form::radio('assay_prz', 0, $prz_no) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_prz"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_prz', 1, $prz_yes) !!}
                    </label>
                    <div class="input_fields_wrap">
                        @if($protocols->assay_prz == 0)
                            <p>
                                <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> <span class="bold">Ако се маркира, че има взета проба от ПРЗ
                                с този протокол, след като го редактирате добавете пробата!</span>
                            </p>
                        @else
                            <p >
                                <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> <span class="look bold">Ако се маркира, че е няма взета проба от ПРЗ
                                с този протокол, след като го редактирате изпълнете описаните инструкции в Протокола!</span>
                            </p>
                        @endif
                    </div>
                    <div class="input_fields_wrap">
                        <p class="error description">{{ $errors->first('assay_prz') }}</p>
                        <p class="error description">{{ $errors->first('prz_name') }}</p>
                        <p class="error description">{{ $errors->first('prz_av') }}</p>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6 col-md-6_my ">
                <fieldset class="small_field example_field_right">
                    <span class="bold">Взета проба от ТОР:</span>&nbsp;&nbsp;
                    <label class="assay_tor"><span>НЕ: </span>
                        {!! Form::radio('assay_tor', 0, $tor_no) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_tor"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_tor', 1, $tor_yes) !!}
                    </label>
                    <div class="input_fields_wrap">
                        @if($protocols->assay_tor == 0)
                            <p>
                                <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> <span class="bold">Ако се маркира, че има взета проба от ТОР
                                с този протокол, след като го редактирате добавете пробата!</span>
                            </p>
                        @else
                            <p>
                                <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> <span class="look bold">Ако се маркира, че е няма взета проба от ТОР
                                с този протокол, след като го редактирате изпълнете описаните инструкции в Протокола!</span>
                            </p>
                        @endif
                    </div>
                    <div class="input_fields_wrap">
                        <p class="error description">{{ $errors->first('assay_tor') }}</p>
                        <p class="error description">{{ $errors->first('tor_name') }}</p>
                        <p class="error description">{{ $errors->first('tor_av') }}</p>
                        <p class="error description">{{ $errors->first('eo_tor') }}</p>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>