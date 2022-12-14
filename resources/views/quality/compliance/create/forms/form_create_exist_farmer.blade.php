<?php
if(isset($protocol) && !empty($protocol)){
    $date_protocol = date('d.m.Y', $protocol->date_protocol);
}
else{
    $date_protocol = null;
}
?>
{{--Номер и Дата на Протокола--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Дата на Формуляра</legend>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('date_compliance', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_compliance', $date_protocol, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                </div>
                <div class="col-md-3 col-md-6_my"  >
                    <p class="description" autocomplete="off">Полето е ЗАДЪЛЖИТЕЛНО!</p>
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <p class="error description">{{ $errors->first('number') }}</p>
                    <p class="error description">{{ $errors->first('date_protocol') }}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

{{--Вид на стока и други данни:--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Наименование и адрс на фирмата:</legend>
                <div class="col-md-12 col-md-6_my"  >
                    <p>Добавя се формуляр за съответствие на:</p>
                    @if($is_trader == 0)
                        @include('records.add.object_info')
                    @elseif($is_trader == 1)
                        <p>Фирма <span class="bold">{{$trader->trader_name}}</span></p>
                        <p>С адрес: <span class="bold">{{$trader->trader_address}}</span></p>
                        <p>ЕИК/Булстат: <span class="bold">{{$trader->trader_vin}}</span></p>
                    @else
                    @endif
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>


{{--Действия на търговеца--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Обект на контрол</legend>
                <div class="col-md-12 col-md-6_my" >
                    <p class="bold">
                        Изписва се Обекта на контрол
                    </p>
                    {!! Form::text('object_control', null, ['class'=>'form-control form-control-my',
                    'id'=>'object_control', 'size'=>55, 'maxlength'=>100, 'placeholder'=>'Обект на контрол' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Трите имена на търговеца</legend>
                <div class="col-md-12 col-md-6_my" >
                    <p class="bold">
                        Трите имена на търговеца или на негов представител
                    </p>
                    {!! Form::text('name_trader', null, ['class'=>'form-control form-control-my',
                    'id'=>'name_trader', 'size'=>55, 'maxlength'=>100, 'placeholder'=>'Трите имена' ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

{{--ИНСПЕКТОР--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Място на издаване и инспектор</legend>
                <div class="col-md-8 col-md-6_my" style="margin-top: 5px;">
                    {!! Form::label('notes', 'ДА - отговаря на изискванията за качество ', ['class'=>'my_labels']) !!}
                    {!! Form::radio('notes', 1, false, ['id'=>'notes']) !!}
                    &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                    {!! Form::label('notes_no', 'НЕ - не отговаря на изискванията за качество ', ['class'=>'my_labels']) !!}
                    {!! Form::radio('notes', 0, false, ['id'=>'notes_no']) !!}
                </div>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('place', 'Инспектор:', ['class'=>'my_labels']) !!}
                    <select name="inspectors" id="inspectors" class="localsID form-control" style=" margin: 5px 0; width: 200px; display: inline-block">
                        <option value="0">-- Избери --</option>
                        @foreach($inspectors as $k=>$inspector)
                            <option value="{{$k}}"
                                @if (old('inspectors') == null)
                                {{--{{($article[0]['crop_id'] == $crop['id'])? 'selected':''}}--}}
                                @else
                                {{(old('inspectors') == $k)? 'selected':''}}
                                @endif
                                inspector_name="{{$inspector}}"
                            >{{ mb_strtoupper($inspector, 'utf-8') }}
                            </option>
                        @endforeach
                    </select>
                    {!! Form::hidden('inspector_name', old('inspector_name'), ['id'=>'inspector_name']) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>