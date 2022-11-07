<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <label>Град:
                {!! Form::radio('tvm', 1, false) !!}
            </label>
            <label>&nbsp;&nbsp;Село:
                {!! Form::radio('tvm', 2, false) !!}
            </label>
            <label>&nbsp;&nbsp;Манастир:
                {!! Form::radio('tvm', 3, false) !!}
            </label>
        </div>
        <div class="col-md-8">
            <?php
                if(isset($location)){
                    $selected = $location->district_id;
                }
                else{
                    $selected = null;
                }
            ?>
            {!! Form::label('district_id', ' Избери общината! ', ['class'=>'labels']) !!}
            {!! Form::select('district_id',  $district_list, $selected, ['id' =>'obstina_id', 'class' =>'obstina_id form-control', ]) !!}
        </div>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            {!! Form::label('postal_code', 'Пошенски код:', ['class'=>'my_labels']) !!}
            {!! Form::text('postal_code', null, ['class'=>'form-control form-control-my', 'maxlength'=>4, 'size'=>10, 'id'=>'postal_code' ]) !!}
        </div>
        <div class="col-md-8">
            {!! Form::label('ekatte', 'ЕКАТТЕ:', ['class'=>'my_labels']) !!}
            {!! Form::text('ekatte', null, ['class'=>'form-control form-control-my', 'maxlength'=>5, 'size'=>10, 'id'=>'ekatte' ]) !!}
        </div>
    </div>
</div>
<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-10">
            {!! Form::label('name', 'Населено място:', ['class'=>'my_labels']) !!}
            {!! Form::text('name', null, ['class'=>'form-control form-control-my', 'size'=>30, 'id'=>'name' ]) !!}
        </div>
    </div>
</div>
<hr class="my_hr_in"/>