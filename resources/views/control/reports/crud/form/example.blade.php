<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 example_bottom" >
            {{--/////////////////////////--}}
            <div class="col-md-6 col-md-6_my " >
                <fieldset class="small_field example_field_left">
                    <span class="bold">Взета проба от ПРЗ:</span>&nbsp;&nbsp;
                    <label class="assay_prz"><span>НЕ: </span>
                        {!! Form::radio('assay_prz', 0, false) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_prz"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_prz', 1, false) !!}
                    </label>
                </fieldset>
            </div>

            <div class="col-md-6 col-md-6_my ">
                <fieldset class="small_field example_field_right">
                    <span class="bold">Взета проба от ТОР:</span>&nbsp;&nbsp;
                    <label class="assay_tor"><span>НЕ: </span>
                        {!! Form::radio('assay_tor', 0, false) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_tor"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_tor', 1, false) !!}
                    </label>
                </fieldset>
            </div>
            {{--/////////////////////////--}}

            <div class="col-md-12 col-md-6_my hidden" id="prz_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            {!! Form::label('prz_name', 'Име на ПРЗ:', ['class'=>'my_labels']) !!}
                            {!! Form::text('prz_name', null, ['size'=>20, 'maxlength'=>100 ]) !!}
                            &nbsp;&nbsp;
                            {!! Form::label('prz_av', 'А. Веществово:', ['class'=>'my_labels']) !!}
                            {!! Form::text('prz_av', null, ['size'=>20, 'maxlength'=>100 ]) !!}

                            &nbsp;&nbsp; | &nbsp;&nbsp;

                            <span class="bold">Взета проба за удължаване срока на годност на ПРЗ:</span>&nbsp;&nbsp;
                            <label class="more"><span class="green">НЕ: </span>
                                {!! Form::radio('more', 0, true) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="more"><span class="red">&nbsp;&nbsp;ДА: </span>
                                {!! Form::radio('more', 1, false) !!}
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
                            с този доклад, отворете Доклада и добавете останалите проби!
                        </p>
                    </div>
                </fieldset>
            </div>


            <div class="col-md-12 col-md-6_my hidden" id="tor_check">
                <fieldset class="small_field example_field">
                    <div class="input_fields_wrap">
                        <div>
                            {!! Form::label('tor_name', 'Име на ТОР:', ['class'=>'my_labels']) !!}
                            {!! Form::text('tor_name', null, ['size'=>15, 'maxlength'=>100 ]) !!}
                            &nbsp;&nbsp;
                            {!! Form::label('tor_av', 'Съдържание:', ['class'=>'my_labels']) !!}
                            {!! Form::text('tor_av', null, ['size'=>15, 'maxlength'=>100 ]) !!}

                            <label class="eo_tor"><span>&nbsp;ЕО&nbsp; НЕ: </span>
                                {!! Form::radio('eo_tor', 0, false) !!}
                            </label>
                            <label class="eo_tor"><span>&nbsp;&nbsp;ДА: </span>
                                {!! Form::radio('eo_tor', 1, false) !!}
                            </label>
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
        </div>
    </div>
</div>