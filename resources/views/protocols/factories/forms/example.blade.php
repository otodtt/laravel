<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 example_bottom" >
            <div class="col-md-12 col-md-6_my ">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            <span class="bold">Проба от ПРЗ:</span>&nbsp;&nbsp;
                            <label class="assay_prz"><span>НЕ: </span>
                                {!! Form::radio('assay_prz', 0, false) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="assay_prz"><span>&nbsp;&nbsp;ДА: </span>
                                {!! Form::radio('assay_prz', 1, false) !!}
                            </label>
                            &nbsp;&nbsp; | &nbsp;&nbsp;
                            {!! Form::label('prz_name', 'Име на ПРЗ:', ['class'=>'my_labels']) !!}
                            {!! Form::text('prz_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                            &nbsp;&nbsp;
                            {!! Form::label('prz_av', 'А. В-во:', ['class'=>'my_labels']) !!}
                            {!! Form::text('prz_av', null, ['size'=>20, 'maxlength'=>100 ]) !!}

                            &nbsp;&nbsp; | &nbsp;&nbsp;

                            <span class="bold">За удължаване срока на годност на ПРЗ:</span>&nbsp;&nbsp;
                            <label class="assay_more"><span class="green">НЕ: </span>
                                {!! Form::radio('assay_more', 0, true) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="more"><span class="red">&nbsp;&nbsp;ДА: </span>
                                {!! Form::radio('assay_more', 1, false) !!}
                            </label>
                        </div>
                    </div>
                    <div class="input_fields_wrap">
                        <p class="bold">
                            <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> Маркирай с "ДА" САМО ако
                            пробата е за удължаване срока на годност на ПРЗ! В противен случай го оставте маркирано - "НЕ".
                        </p>
                        <p>
                            <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> Ако има взети повече проби от ПРЗ
                            с този протокол, отворете Констативния Протокол и добавете останалите проби!
                        </p>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>