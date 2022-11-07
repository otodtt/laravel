<?php
//if(!isset($protocols)){
//    $return_violation = null;
//    $return_no = false;
//    $return_yes = false;
//    $act_no = false;
//    $act_yes = false;
//    $return_ascertainment = null;
//    $return_taken = null;
//    $return_order_protocol = null;
//}
//else{
//    if($protocols->violation == 0){
//        $return_no = true;
//        $return_yes = false;
//    }
//    if($protocols->violation == 1){
//        $return_no = false;
//        $return_yes = true;
//    }
//    if($protocols->act == 0){
//        $act_no = true;
//        $act_yes = false;
//    }
//    if($protocols->act == 1){
//        $act_no = false;
//        $act_yes = true;
//    }
//    //////
//    $return_act = $protocols->act;
//    $return_ascertainment = $protocols->ascertainment;
//    $return_taken = $protocols->taken;
//    $return_order_protocol = $protocols->order_protocol;
//}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Констатация и други данни</legend>
                <div class="col-md-12 act_wrap">
                    <div class="col-md-4 col-md-6_my inspectors_divs" >
                        <fieldset class="mini_field mini_top">
                            <div class="col-md-6 col-md-6_my " >
                                <span class="bold">Констатирани нарушения:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-6 col-md-6_my  " >
                                <label class="violation"><span>НЕ: </span>
                                    {!! Form::radio('violation', 0, false, array('class'=>'violation')) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="violation "><span>&nbsp;&nbsp;ДА: </span>
                                    {!! Form::radio('violation', 1, false, array('class'=>'violation')) !!}
                                </label>
                            </div>
                        </fieldset>
                        <fieldset class="mini_field">
                            <div class="col-md-6 col-md-6_my" >
                                <span class="bold">Издаден АКТ за АН:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-6 col-md-6_my" >
                                <label class="act"><span>НЕ: </span>
                                    {!! Form::radio('act', 0, false) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;ДА: </span>
                                    {!! Form::radio('act', 1, false) !!}
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-5 col-md-6_my inspectors_divs ">
                        <p class="description" >Ако се маркира "Да" в полето "Констатирани нарушения" или "Издаден АКТ за
                            административно нарушение", ЗАДЪЛЖИТЕЛНО опишете нарушенията в полето "Констатация" и предписанията в полето
                            "Предписание". Маркирай ако има АКТ!
                        </p>
                    </div>

                    <div class="col-md-3 col-md-6_my" >
                        <p class="error description">{{ $errors->first('violation') }}</p>
                        <p class="error description">{{ $errors->first('act') }}</p>
                        <p class="error description">{{ $errors->first('ascertainment') }}</p>
                        <p class="error description">{{ $errors->first('taken') }}</p>
                        <p class="error description">{{ $errors->first('order_protocol') }}</p>
                    </div>
                </div>

                <div class="col-md-12 col-md-6_my  ">
                    <div class="col-md-4 col-md-6_my inspectors_divs ">
                        {!! Form::label('ascertainment', 'Констатация:', ['class'=>'my_labels']) !!}
                        {!! Form::textarea('ascertainment', null, ['class'=>'form-control form-control-my', 'cols'=>'50', 'rows'=>'3']) !!}
                    </div>
                    <div class="col-md-4 col-md-6_my inspectors_divs ">
                        {!! Form::label('taken', 'Конфискувани:', ['class'=>'my_labels']) !!}
                        {!! Form::textarea('taken', null, ['class'=>'form-control form-control-my', 'cols'=>'50', 'rows'=>'3']) !!}
                    </div>
                    <div class="col-md-4 col-md-6_my inspectors_divs ">
                        {!! Form::label('order_protocol', 'Предписание:', ['class'=>'my_labels']) !!}
                        {!! Form::textarea('order_protocol', null, ['class'=>'form-control form-control-my', 'cols'=>'50', 'rows'=>'3']) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>