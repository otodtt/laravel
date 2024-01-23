<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field" ><legend class="small_legend">ЗА ПОПЪЛВАНЕ НА ТАБЛИЦАТА</legend>
                <p class="description bold">
                   Кратък текст за коректно попълване на таблицата. Някои от полетата се повтарят, но за по пригледно показване на таблицата.
                </p>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in" >
                        {!! Form::label('activity', 'Дейност/и по чл. 65(1) ', ['class'=>'my_labels']) !!}
                        {!! Form::text('activity', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>50, 'id'=>'activity', 'style'=>'margin-left: 55px' ]) !!}
                        <hr class="hr_in"/>
                        {!! Form::label('products', 'Растения/естество', ['class'=>'my_labels']) !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::text('products', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>50, 'id'=>'products', 'style'=>'margin-left: 50px'  ]) !!}
                        <hr class="hr_in"/>
                        {!! Form::label('derivation', 'Растения/произход', ['class'=>'my_labels']) !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::text('derivation', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>50, 'id'=>'derivation', 'style'=>'margin-left: 45px' ]) !!}
                        <hr class="hr_in"/>
                        {!! Form::label('purpose', 'Растения/предназначение', ['class'=>'my_labels']) !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::text('purpose', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>50, 'id'=>'purpose' ]) !!}
                    </fieldset>
                </div>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in" >
                        {!! Form::label('room', 'Адрес на помещенията:', ['class'=>'my_labels']) !!}
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::text('room', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>500, 'id'=>'room' ]) !!}
                        <hr class="hr_in"/>
                        {!! Form::label('action', 'Дейност/и по чл. 66(2)', ['class'=>'my_labels']) !!}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::text('action', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>500, 'id'=>'action' ]) !!}
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>