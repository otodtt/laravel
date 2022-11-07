<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 example_bottom" >
            <div class="col-md-12 col-md-6_my ">
                <fieldset class="small_field example_field">
                    <span class="bold">Взета проба от ПРЗ за идентификация:</span>&nbsp;&nbsp;
                    <label class="assay_prz"><span>НЕ: </span>
                        {!! Form::radio('assay_prz', 0, false) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_prz"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_prz', 1, false) !!}
                    </label>


                    <div class="input_fields_wrap">
                        @if($protocol->assay_prz == 0)
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
                    </div>
                </fieldset>

                <fieldset class="small_field example_field">
                    <span class="bold">Взета проба от ПРЗ за Удължаване на срока:</span>&nbsp;&nbsp;
                    <label class="assay_more"><span>НЕ: </span>
                        {!! Form::radio('assay_more', 0, false) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_more"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_more', 1, false) !!}
                    </label>


                    <div class="input_fields_wrap">
                        @if($protocol->assay_more == 0)
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
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>