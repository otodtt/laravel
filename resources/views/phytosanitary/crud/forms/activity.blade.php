<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <fieldset class="small_field"><legend class="small_legend">III. Вид на дейността</legend>
                <fieldset class="small_field_in" >
                    <div class="row">
                        <div class="col-md-3">
                            <label class="labels_limit">
                            {!! Form::radio('production', 1) !!}<span>&nbsp;&nbsp; 1. производство </span>
                            </label>

                        </div>
                        <div class="col-md-3">
                            <label class="labels_limit">
                                {!! Form::radio('processing', 1) !!}<span>&nbsp;&nbsp; 2. преработка </span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="labels_limit">
                                {!! Form::radio('import', 1) !!}<span>&nbsp;&nbsp; 3. внос </span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="labels_limit">
                                {!! Form::radio('export', 1) !!}<span>&nbsp;&nbsp; 4. износ </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="labels_limit">
                                {!! Form::radio('trade', 1) !!}<span>&nbsp;&nbsp; 5. търговия </span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="labels_limit">
                                {!! Form::radio('storage', 1) !!}<span>&nbsp;&nbsp; 6. складиране  </span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="labels_limit">
                                {!! Form::radio('treatment', 1) !!}<span>&nbsp;&nbsp; 7. третиране, маркиране и поправка на
                                    дървен опаковъчен материал ....</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="labels_limit">
                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <span>&nbsp;&nbsp; 8. други (изброяват се)</span>
                                {!! Form::text('others', null, ['class'=>'form-control form-control-my',  'size'=>50, 'id'=>'others' ]) !!}
                            </label>
                            <input style="float: right; margin-right: 100px;" type="button" onclick="clearRadioButtonsOne();" value="Изчисти" class="btn btn-danger my_btn" />
                        </div>
                    </div>

                </fieldset>
            </fieldset>
        </div>
    </div>
</div>