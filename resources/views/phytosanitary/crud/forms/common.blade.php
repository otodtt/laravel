<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <fieldset class="small_field">
                <fieldset class="small_field_in" ><legend class="small_legend">IV.  Наименование на растенията</legend>
                    <p class="description">
                        IV.  Наименование на растенията, растителните продукти и другите обекти, предмет на дейност<br>
                        (при необходимост, към заявлението се прилага подробен опис)
                    </p>
                    <hr class="hr_in" />
                    {!! Form::text('plants', null, ['class'=>'form-control', 'style'=>'width: 50%; margin-top: 10px;',
                            'autocomplete'=>'observations', 'rows'=>3 ]) !!}
                </fieldset>
                <fieldset class="small_field_in"><legend class="small_legend">V.  Произход на растенията</legend>
                    <p class="description">
                        V.  Произход на растенията, растителните продукти и другите обекти
                    </p>
                    <hr class="hr_in"/>
                    <div class="col-md-12 col-md-6_my" >
                        <div class="row">
                            <div class="col-md-2">
                                <label class="labels_limit">
                                    {!! Form::radio('europa', 1) !!}<span>&nbsp;&nbsp; ЕС</span>
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="labels_limit">
                                    {!! Form::radio('bulgaria', 1) !!}<span>&nbsp;&nbsp; България  </span>
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="labels_limit">
                                    {!! Form::radio('own', 1) !!}<span>&nbsp;&nbsp; Собствен</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="labels_limit">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span>&nbsp;&nbsp; внос от трета/и държава/и</span>
                                    {!! Form::text('origin_from', null, ['class'=>'form-control form-control-my',  'size'=>50, 'id'=>'origin_from' ]) !!}
                                </label> &nbsp;&nbsp;|&nbsp;&nbsp;
                                <input type="button" onclick="clearRadioButtons();" value="Изчисти" class="btn btn-info my_btn" />
                            </div>
                        </div>
                    </div>
                </fieldset>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <fieldset class="small_field">
                <fieldset class="small_field_in" style="width: 49%; float: left"><legend class="small_legend">VI. ЗАЯВЯВАНЕ ЗА ПАСПОРТ </legend>
                    <p class="description">
                        VI. ЗАЯВЯВАНЕ за РАЗРЕШЕНИЕ за издаване на растителни паспорти
                    </p>
                    <br>
                    <hr class="hr_in" />
                    <label class="labels_limit">
                        <span>НЕ  </span>
                        {!! Form::radio('passports', 0) !!}
                    </label>
                    <label class="labels_limit">
                        <span>&nbsp;&nbsp; ДА  </span>
                        {!! Form::radio('passports', 1) !!}
                    </label>
                    <p class="description">
                        ПРИ ДА (прилага се подробен опис на растенията, за които се иска разрешение за издаване на растителен паспорт – посочват се до вид, по възможност)
                    </p>
                </fieldset>
                <fieldset class="small_field_in" style="width: 49%; float: right"><legend class="small_legend">ЗАЯВЯВАНЕ за РАЗРЕШЕНИЕ</legend>
                    <p class="description">
                        VII. ЗАЯВЯВАНЕ за РАЗРЕШЕНИЕ за поставяне на маркировка върху дървен опаковъчен материал, дървесина или други обекти и за поправка на дървен опаковъчен материал
                    </p>
                    <hr class="hr_in" />
                    <label class="labels_limit">
                        <span>НЕ  </span>
                        {!! Form::radio('marking', 0) !!}
                    </label>
                    <label class="labels_limit">
                        <span>&nbsp;&nbsp; ДА  </span>
                        {!! Form::radio('marking', 1) !!}
                    </label>
                    <p class="description">
                        ПРИ ДА (прилагат се технически спецификации на съоръжението/ята и оборудването за извършване на дейността/ите)
                    </p>
                </fieldset>
            </fieldset>
        </div>
    </div>
</div>