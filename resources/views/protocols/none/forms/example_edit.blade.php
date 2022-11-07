<?php
if(!isset($protocols)){
    $tor_no = false;
    $tor_yes = false;
}
else{
    if($protocols->assay == 0){
        $tor_no = true;
        $tor_yes = false;
    }
    if($protocols->assay == 1){
        $tor_no = false;
        $tor_yes = true;
    }
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 example_bottom" >
            <div class="col-md-12 col-md-6_my ">
                <fieldset class="small_field example_field_right">
                    <span class="bold">Взета проба от ТОР:</span>&nbsp;&nbsp;
                    <label class="assay_tor"><span>НЕ: </span>
                        {!! Form::radio('assay_tor', 0, $tor_no) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_tor"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_tor', 1, $tor_yes) !!}
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @if($protocols->assay == 0)
                        <span>
                            <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> <span class="bold">Ако се маркира, че има взета проба от ТОР
                                с този протокол, след като го редактирате добавете пробата!</span>
                        </span>
                    @else
                        <span>
                            <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> <span class="look bold">Ако се маркира, че е няма взета проба от ТОР
                                с този протокол, след като го редактирате изпълнете описаните инструкции в Протокола!</span>
                        </span>
                    @endif
                </fieldset>
            </div>
        </div>
    </div>
</div>