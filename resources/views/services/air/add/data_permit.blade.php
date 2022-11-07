<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни за третирането</legend>
                <div class="col-md-6 col-md-6_my" >
                    <div class="col-md-12 col-md-6_my"  >
                        <p class="bold">Населено място и местност/и:</p>
                        <p class="description">Описват се населените места и месностите където ще се третира.</p>
                    </div>
                    <div class="col-md-12 col-md-6_my"  >
                        {!! Form::textarea('ground', null, ['class'=>'form-control form-control-my', 'rows'=>4, 'cols'=>70 ]) !!}
                    </div>
                </div>
                <div class="col-md-6 col-md-6_my"  >
                    <div class="col-md-12 col-md-6_my"  >
                        <p class="bold">Култура и вредител:</p>
                        <p class="description">Описват се културите и декарите които ще се третират.</p>
                        <br/>
                    </div>
                    <div class="col-md-12 col-md-6_my"  >
                        {!! Form::label('cultivation', 'Култура', ['class'=>'my_labels']) !!}
                        {!! Form::text('cultivation', null, ['class'=>'form-control form-control-my', 'size'=>45, 'maxlength'=>500 ]) !!}
                        &nbsp;
                        {!! Form::label('acres', 'Декари:', ['class'=>'my_labels']) !!}
                        {!! Form::text('acres', null, ['class'=>'form-control form-control-my',
                        'id'=>'acres', 'size'=>3, 'maxlength'=>10 ]) !!}
                        <hr class="my_hr"/>
                        {!! Form::label('pest', 'Вредител/ПИВ:', ['class'=>'my_labels']) !!}
                        {!! Form::text('pest', null, ['class'=>'form-control form-control-my',
                        'id'=>'pest', 'size'=>50, 'maxlength'=>250]) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>