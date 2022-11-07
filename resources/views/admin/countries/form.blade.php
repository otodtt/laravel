<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <label>Не е член:
                {!! Form::radio('EC', 0, false) !!}
            </label>
            <label>&nbsp;&nbsp;Член на ЕС:
                {!! Form::radio('EC', 1, false) !!}
            </label>
            <label>&nbsp;&nbsp;Кандидат:
                {!! Form::radio('EC', 2, false) !!}
            </label>
        </div>
        
    </div>
</div>
<hr class="my_hr_in"/>

<hr class="my_hr_in"/>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-10">
            {!! Form::label('name_en', 'Име на англиски:', ['class'=>'my_labels']) !!}
            {!! Form::text('name_en', null, ['class'=>'form-control form-control-my', 'size'=>30, 'id'=>'name' ]) !!}
        </div>
    </div>
</div>
<hr class="my_hr_in"/>