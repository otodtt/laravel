<?php
if(isset($protocol) && !empty($protocol)){
    $date_operator = date('d.m.Y', $protocol->date_operator);
}
else{
    $date_operator = null;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <fieldset class="small_field">
                <fieldset class="small_field_in" style="width: 49%; float: left"><legend class="small_legend">IX. СЪОТВЕТСТВИЯ по чл. 66 </legend>
                    <p class="description bold">
                        IX. СЪОТВЕТСТВИЯ по чл. 66 от Регламент (ЕС) 2016/2031 и чл. … от ЗЗР
                    </p>
                    <table class="table">
                        <thead>
                            <th class="first">Представени документи: отбелязва се с «ДА»/«НЕ»</th>
                            <th  class="second">ДА / НЕ</th>
                            <th  class="third">Допълнителни бележки</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Регистрация като ЗП</td>
                                <td class="center">
                                    <label class="labels_limit">
                                        <span>ДА </span>
                                        {!! Form::radio('registration', 1) !!}
                                    </label>
                                    /
                                    <label class="labels_limit">
                                        <span> НЕ  </span>
                                        {!! Form::radio('registration', 0) !!}
                                    </label>
                                </td>
                                <td>
                                    {!! Form::text('registration_note', null, ['class'=>'form-control form-control-my', 'size'=>30, 'id'=>'registration_note' ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>2. Схема с разположение на предприятието/площите</td>
                                <td class="center">
                                    <label class="labels_limit">
                                        <span>ДА </span>
                                        {!! Form::radio('disposition', 1) !!}
                                    </label>
                                    /
                                    <label class="labels_limit">
                                        <span> НЕ  </span>
                                        {!! Form::radio('disposition', 0) !!}
                                    </label>
                                </td>
                                <td>
                                    {!! Form::text('disposition_note', null, ['class'=>'form-control form-control-my', 'size'=>30, 'id'=>'disposition_note' ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>3. Документ за право на собственост/ползване на предприятието/площите</td>
                                <td class="center">
                                    <label class="labels_limit">
                                        <span>ДА </span>
                                        {!! Form::radio('property', 1) !!}
                                    </label>
                                    /
                                    <label class="labels_limit">
                                        <span> НЕ  </span>
                                        {!! Form::radio('property', 0) !!}
                                    </label>
                                </td>
                                <td>
                                    {!! Form::text('property_note', null, ['class'=>'form-control form-control-my', 'size'=>30, 'id'=>'property_note' ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>4. Документи за произход на растенията, растителните продукти и други обекти</td>
                                <td class="center">
                                    <label class="labels_limit">
                                        <span>ДА </span>
                                        {!! Form::radio('plants_origin', 1) !!}
                                    </label>
                                    /
                                    <label class="labels_limit">
                                        <span> НЕ  </span>
                                        {!! Form::radio('plants_origin', 0) !!}
                                    </label>
                                </td>
                                <td>
                                    {!! Form::text('plants_note', null, ['class'=>'form-control form-control-my', 'size'=>30, 'id'=>'plants_note' ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>5. Други</td>
                                <td class="center" >
                                </td>
                                <td>
                                    {!! Form::text('others_note', null, ['class'=>'form-control form-control-my', 'size'=>30, 'id'=>'others_note' ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('accepted', 'Инспектор Приел:', ['class'=>'my_labels']) !!}
                                    <?php echo(old('accepted')) ?>
                                    <select name="accepted" id="accepted" class="localsID form-control" style=" margin: 5px 0; width: 200px; display: inline-block">
                                        <option value="0">-- Избери Инспектор--</option>
                                        @foreach($inspectors as $k=>$inspector)
                                            <option value="{{$k}}"
                                                    @if ($operator->accepted == $k)
                                                    {{($operator->accepted == $k)? 'selected':''}}
                                                    @endif
                                                    inspector_name="{{$inspector}}"

                                            >{{ mb_strtoupper($inspector, 'utf-8') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! Form::hidden('inspector_name', old('inspector_name'), ['id'=>'inspector_name']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset class="small_field_in" style="width: 49%; float: right"><legend class="small_legend">X. СТАНОВИЩЕ НА ИНСПЕКТОРА </legend>
                    {!! Form::textarea('free_text', null, ['class'=>'form-control', 'style'=>'width: 99%; margin-top: 10px;',
                            'autocomplete'=>'observations', 'rows'=>4, 'placeholder'=>'Свободен текст:' ]) !!}

                    <hr class="hr_in"/>

                    {!! Form::label('place', 'Инспектор Проверил:', ['class'=>'my_labels']) !!}
                    <select name="checked" id="checked" class="localsID form-control" style=" margin: 5px 0; width: 200px; display: inline-block">
                        <option value="0">-- Избери Инспектор--</option>
                        @foreach($inspectors as $k=>$inspector)
                            <option value="{{$k}}"
                                    @if ($operator->checked == $k)
                                    {{($operator->checked == $k)? 'selected':''}}
                                    @endif
                                    inspector_checked="{{$inspector}}"

                            >{{ mb_strtoupper($inspector, 'utf-8') }}
                            </option>
                        @endforeach
                    </select>
                    {!! Form::hidden('inspector_checked', old('inspector_checked'), ['id'=>'inspector_checked']) !!}


                    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_operator', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_operator', $date_operator, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_operator', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}

                    <hr class="hr_in"/>
                    <p>
                        Регистрационен № на заявителя
                    </p>
                </fieldset>
            </fieldset>
        </div>
    </div>
</div>