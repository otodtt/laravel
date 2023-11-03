
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <fieldset class="small_field"><legend class="small_legend">II. Данни за местата  </legend>
                <fieldset class="small_field_in" style="width: 49%; float: left">
                    <p class="description">
                        II. Данни за местата на провеждане на дейността (описание на обектите, вкл. адрес)
                    </p>
                    <br>
                    <hr class="hr_in" />
                    {!! Form::textarea('description_objects', null, ['class'=>'form-control', 'style'=>'width: 99%; margin-top: 10px;',
                            'autocomplete'=>'observations', 'rows'=>2 ]) !!}
                </fieldset>
                <fieldset class="small_field_in" style="width: 49%; float: right">
                    <p class="description">IIА. Данни за местата на провеждане на дейност на територията на друга ОДБХ /
                        друга държава членка <br>(описание на обектите, данни за контакт, вкл. адрес)
                    </p>
                    <hr class="hr_in"/>
                    <div class="col-md-12 col-md-6_my" >
                        {!! Form::textarea('description_places', null, ['class'=>'form-control', 'style'=>' margin-top: 10px;',
                           'autocomplete'=>'observations', 'rows'=>2 ]) !!}
                    </div>

                </fieldset>
            </fieldset>
        </div>
    </div>
</div>