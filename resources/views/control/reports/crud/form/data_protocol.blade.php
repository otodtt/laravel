<?php
if(!isset($protocols)){
    $protocol_no = false;
    $protocol_yes = false;
}
else{
    if($protocols->protocol == 0){
        $protocol_no = true;
        $protocol_yes = false;
    }
    if($protocols->protocol == 1){
        $protocol_no = false;
        $protocol_yes = true;
    }
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Издаден Констативен Протокол</legend>
                <div class="col-md-12 act_wrap" style="border-bottom: none">
                    <div class="col-md-5 col-md-6_my inspectors_div" >
                        <fieldset class="mini_field">
                            <div class="col-md-6 col-md-6_my" >
                                <span class="bold">Има ли издаден Констативен Протокол:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-6 col-md-6_my" >
                                <label class="act"><span>НЕ: </span>
                                    {!! Form::radio('protocol', 0, $protocol_no) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;ДА: </span>
                                    {!! Form::radio('protocol', 1, $protocol_yes) !!}
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4 col-md-6_mys inspectors_divs ">
                        <p class="description" >Ако се маркира "Да" в полето "Има ли издаден Констативен Протокол", ЗАДЪЛЖИТЕЛНО
                            се попълва и съответния Констативен Протокол към Доклада!!
                        </p>
                    </div>

                </div>

                <div class="col-md-12 col-md-6_my  ">
                </div>
            </fieldset>
        </div>
    </div>
</div>