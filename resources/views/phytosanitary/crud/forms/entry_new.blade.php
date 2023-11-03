<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field" ><legend class="small_legend"> Вписване в регистър</legend>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in" >
                        <p class="description">
                            Вписва се в регистъра за пъви път и е избрано "Вписване в регистър".
                        </p>
                        <hr class="hr_in"/>
                        {{--ЩЕ СЕ ДОРАБОТВА--}}
                        <label class="labels_limit"><span>Вписване в регистър</span>
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                        </label>&nbsp;&nbsp;|
                        <label class="labels_limit"><span>&nbsp;&nbsp;Актуализация на данни</span>
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                        </label>
                    </fieldset>
                </div>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset id="show_type" class="small_field_in show_type ">
                        <p class="description">
                            Декларация за липса на промяна във вписаните в регистъра обстоятелства и данни от предходната година.
                        </p>
                        <hr class="hr_in"/>
                        <span>Декларация &nbsp;&nbsp;&nbsp;</span>
                        <label class="labels_limit"><span>ДА</span>
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                        </label>&nbsp;&nbsp;|
                        <label class="labels_limit"><span>&nbsp;&nbsp;НЕ</span>
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                        </label>
                        {{--ЩЕ СЕ ДОРАБОТВА ВИЖ ПО-ДОЛУ--}}

                        {{--<span>Декларация &nbsp;&nbsp;&nbsp;</span>--}}
                        {{--<label class="labels_limit"><span>ДА</span>--}}
                            {{--{!! Form::radio('declaration', 1) !!}--}}
                        {{--</label>&nbsp;&nbsp;|--}}
                        {{--<label class="labels_limit"><span>&nbsp;&nbsp;НЕ</span>--}}
                            {{--{!! Form::radio('declaration', 2) !!}--}}
                        {{--</label>--}}
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>