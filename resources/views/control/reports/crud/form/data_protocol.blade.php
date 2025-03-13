<?php
if(!isset($reports)){
    $protocol_no = false;
    $protocol_yes = false;

    $protocol_number = '';
    $protocol_date = '';
}
else{
    if($reports->protocol == 0){
        $protocol_no = true;
        $protocol_yes = false;

        $protocol_number = '';
        $protocol_date = '';
    }
    if($reports->protocol == 1){
        $protocol_no = false;
        $protocol_yes = true;

        $protocol_number = $reports->protocol_number;
        $protocol_date = date('d.m.Y', $reports->protocol_date);
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
                <div class="col-md-12 col-md-6_my hidden" id="protocol_check">
                    <fieldset class="small_field example_field">
                        <div class="input_fields_wrap">
                            <div>
                                {!! Form::label('protocol_number', '№ на Протокола:', ['class'=>'my_labels']) !!}
                                {!! Form::text('protocol_number', $protocol_number, ['size'=>15, 'maxlength'=>100 ]) !!}
                                &nbsp;&nbsp;
                                {!! Form::label('protocol_date', 'Дата на Протокола:', ['class'=>'my_labels']) !!}
                                {!! Form::text('protocol_date', $protocol_date, ['size'=>15, 'maxlength'=>100, 'id'=>'protocol_date' ]) !!}
                            </div>
                        </div>
                        <div class="input_fields_wrap">
                            <p>
                                <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> Ако има взети повече проби от тор
                                с този доклад, отворете Доклада и добавете останалите проби!
                            </p>
                        </div>
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>