<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 example_bottom" >
            <div class="col-md-12 col-md-6_my ">
                <fieldset class="small_field example_field_right">
                    <p>
                        <span class="red bold"><i class="fa fa-warning"></i> Внимание!</span> Проби от тор могат да се вземат от
                        обекти кото не са аптеки или складове за ПРЗ.
                    </p>
                    <span class="bold">Взета проба от ТОР:</span>&nbsp;&nbsp;
                    <label class="assay_tor"><span>НЕ: </span>
                        {!! Form::radio('assay_tor', 0, false) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="assay_tor"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('assay_tor', 1, false) !!}
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                </fieldset>
            </div>
        </div>
    </div>
</div>