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
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Протокола</legend>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('number_protocol', 'Протокол №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_protocol', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_protocol', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_protocol', $date_protocol, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                </div>
                <div class="col-md-3 col-md-6_my"  >
                    <p class="description" autocomplete="off">Полетата са ЗАДЪЛЖИТЕЛНИ!</p>
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
            <fieldset class="small_field"><legend class="small_legend">Вид на стока и други данни:</legend>
                <div class="col-md-6 col-md-6_my"  >
                    <table style="width: 100%">
                        <tbody>
                            <tr style="border-bottom: 1px solid black;">
                                <td>{!! Form::label('crops', '1. Вид на стоката:', ['class'=>'my_labels']) !!}</td>
                                <td>
                                    <select name="crops" id="crops" class="localsID form-control" style=" margin: 5px 0; float: right">
                                        <option value="0">-- Избери --</option>
                                        @foreach($crops as $crop)
                                            <option value="{{$crop['id']}}"
                                                @if (old('crops') == null)
                                                {{--{{($article[0]['crop_id'] == $crop['id'])? 'selected':''}}--}}
                                                @else
                                                {{(old('crops') == $crop['id'])? 'selected':''}}
                                                @endif
                                                crops_name="{{$crop['name']}}"
                                            >{{ mb_strtoupper($crop['name'], 'utf-8') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! Form::hidden('crops_name', old('en_name'), ['id'=>'crops_name']) !!}
                                </td>
                            </tr>
                            <tr  style="border-bottom: 1px solid black;">
                                <td>{!! Form::label('origin', '2. Страна на произход:', ['class'=>'my_labels']) !!}</td>
                                <td>
                                    {!! Form::text('origin', null, ['class'=>'form-control form-control-my', 'size'=>23, 'maxlength'=>250,
                                    'placeholder'=> 'Страна на произход', 'style'=>'margin:5px 0; float: right; width: 100%;' ]) !!}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <td>{!! Form::label('quality_class', '3. Означен клас на качество:', ['class'=>'my_labels']) !!}</td>
                                <td>
                                    <select name="quality_class" id="quality_class" class="localsID form-control" style="float: right; margin: 5px 0">
                                        <option value="0" >-- Избери --</option>
                                        @foreach($qualitys as $k => $quality)
                                            <option value="{{$k}}"
                                            @if (old('quality_class') == null)
                                                {{--{{($article[0]['quality_class'] == $k )? 'selected':''}}--}}
                                            @else
                                                {{(old('quality_class') == $k)? 'selected':''}}
                                            @endif
                                            >{{$quality}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <td>{!! Form::label('quality_naw', '4. Клас на качество в момента на контрола:', ['class'=>'my_labels']) !!}</td>
                                <td>
                                    <select name="quality_naw" id="quality_class" class="localsID form-control" style=" float: right; margin: 5px 0">
                                        <option value="0" >-- Избери --</option>
                                        @foreach($qualitys as $k => $quality)
                                            <option value="{{$k}}"
                                            @if (old('quality_naw') == null)
                                                {{--{{($article[0]['quality_class'] == $k )? 'selected':''}}--}}
                                                    @else
                                                {{(old('quality_naw') == $k)? 'selected':''}}
                                                    @endif
                                            >{{$quality}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr  style="border-bottom: 1px solid black;">
                                <td>{!! Form::label('tara', '5. Тегло бруто/нето(кг):', ['class'=>'my_labels']) !!}</td>
                                <td>
                                    {!! Form::text('tara', null, ['class'=>'form-control form-control-my', 'size'=>23, 'maxlength'=>250,
                                    'placeholder'=> 'бруто/нето(кг)', 'style'=>'margin:5px 0; float: right; width: 100%;' ]) !!}
                                </td>
                            </tr>
                            <tr  style="border-bottom: 1px solid black;">
                                <td>{!! Form::label('number', '6. Брой и вид на опаковките:', ['class'=>'my_labels']) !!}</td>
                                <td>
                                    {!! Form::text('number', null, ['class'=>'form-control form-control-my', 'size'=>23, 'maxlength'=>250,
                                    'placeholder'=> 'брой', 'style'=>'margin:5px 0; width: 45%;  display: inline-block;' ]) !!}

                                    <select onchange="run()" name="type_package" id="type" class="type_pack localsID form-control" style="width: 54%; display: inline-block;" >
                                        <option value="0">Избери вида опаковка</option>
                                        @foreach($packages as $k => $pack)
                                            <option value="{{$k}}"
                                            @if (old('quality_class') == null)
                                                {{--{{($article[0]['type_pack'] == $k )? 'selected':''}}--}}
                                            @else
                                                {{(old('type_package') == $k)? 'selected':''}}
                                            @endif
                                            >{{$pack}}</option>
                                        @endforeach
                                    </select>
                                    <div id="different_row" class="hidden">
                                        {!! Form::text('different', null, ['class'=>'form-control', 'style'=>'width: 100%; margin-top: 10px', 'placeholder'=> 'Опаковката я няма в списъка']) !!}
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-md-6_my" style="padding: 0 20px">
                    <p>7. Други идентификационни белези (сорт, размер, тегло)</p>
                    {{--<textarea id="variety" name="variety" rows="3" cols="70"></textarea>--}}
                    {!! Form::textarea('variety', null, ['class'=>'form-control', 'rows' => 3, 'cols' => 70, ]) !!}
                    <hr>
                    <p>8. Придружаващи стоката документи</p>
                    {{--<textarea id="documents" name="documents" rows="3" cols="70"></textarea>--}}
                    {!! Form::textarea('documents', null, ['class'=>'form-control', 'rows' => 3, 'cols' => 70, ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

{{--Отклонения от изискванията за качество--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Отклонения от изискванията за качество</legend>
                <p class="">При проведения контрол за съответствие бе установено .....</p>
                <table>
                    <tbody>
                        <tr class="full_row">
                            <td class="numbers_td">01</td>
                            <td class="labels_td">{!! Form::label('origin', 'Маркировка:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="marking" name="marking" min="0" max="100"> %
                            </td>
                            <td  class="numbers_td">05</td>
                            <td class="labels_td">{!! Form::label('origin', 'Чистота:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="cleanliness" name="cleanliness" min="0" max="100"> %
                            </td>
                            <td  class="numbers_td">08</td>
                            <td class="labels_td">{!! Form::label('origin', 'Оцветяване:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="coloring" name="coloring" min="0" max="100"> %
                            </td>
                        </tr>


                        <tr class="full_row">
                            <td class="numbers_td">02</td>
                            <td class="labels_td">{!! Form::label('origin', 'Размери:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="dimensions" name="dimensions" min="0" max="100"> %
                            </td>
                            <td  class="numbers_td">06</td>
                            <td class="labels_td">{!! Form::label('origin', 'Външен вид:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="appearance" name="appearance" min="0" max="100"> %
                            </td>
                            <td  class="numbers_td">09</td>
                            <td class="labels_td">{!! Form::label('origin', 'Зрялост:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="maturity" name="maturity" min="0" max="100"> %
                            </td>
                        </tr>


                        <tr class="full_row">
                            <td class="numbers_td">03</td>
                            <td class="labels_td">{!! Form::label('origin', 'Петна и повреди:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="damage" name="damage" min="0" max="100"> %
                            </td>
                            <td  class="numbers_td">07</td>
                            <td class="labels_td">{!! Form::label('origin', 'Форма:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="shape" name="shape" min="0" max="100"> %
                            </td>
                            <td  class="numbers_td">10</td>
                            <td class="labels_td">{!! Form::label('origin', 'Физиологични дефекти:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td">
                                <input type="number" id="defects" name="defects" min="0" max="100"> %
                            </td>
                        </tr>

                        <tr class="full_row">
                            <td class="numbers_td">04</td>
                            <td class="labels_td_last">{!! Form::label('origin', 'Повреди болести и загнивания:', ['class'=>'my_labels']) !!}</td>
                            <td class="input_td" colspan="6">
                                <input type="number" id="diseases" name="diseases" min="0" max="100"> %
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

{{--Партидата не съответства на изискванията--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Партидата не съответства на изискванията за качество</legend>
                <p class="">Поради това партидата не съответства на изискванията за качество на ....... и е негодна за:</p>
                <table>
                    <tbody>
                        <tr class="full_row">
                            <td class="numbers_td">1</td>
                            <td class="labels_td">
                                {!! Form::label('import', 'внос:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="import" name="matches" value="1">
                            </td>
                            <td  class="numbers_td">2</td>
                            <td class="labels_td">
                                {!! Form::label('export', 'износ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="export" name="matches" value="2">
                            </td>
                            <td  class="numbers_td">3</td>
                            <td class="labels_td">
                                {!! Form::label('wholesale', 'продажба на едро:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="wholesale" name="matches" value="3">
                            </td>
                            <td  class="numbers_td">4</td>
                            <td class="labels_td">
                                {!! Form::label('petty', 'продажба на дребно:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="petty" name="matches" value="4">
                            </td>
                            <td class="input_td">
                                <input type="button" onclick="clearRadioButtons();" value="Изчисти" class="btn btn-info my_btn" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

{{--Предписания на инспектора--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Предписания на инспектора за</legend>
                <table>
                    <tbody>
                        <tr class="full_row">
                            <td class="numbers_td">01</td>
                            <td class="labels_marking">
                                {!! Form::label('mark', 'Окачествяване и маркиране:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td" >
                                {!! Form::label('mark', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="mark" name="mark" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('mark_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="mark_no" name="mark" value="0" checked>
                            </td>
                            <td  class="numbers_td">04</td>
                            <td class="labels_marking">
                                {!! Form::label('repackaging', 'Препакетиране:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td">
                                {!! Form::label('repackaging', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="repackaging" name="repackaging" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('repackaging_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="repackaging_no" name="repackaging" value="0" checked>
                            </td>
                            <td  class="numbers_td">06</td>
                            <td class="labels_marking">
                                {!! Form::label('processing', 'Преработка:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td">
                                {!! Form::label('processing', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="processing" name="processing" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('processing_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="processing_no" name="processing" value="0" checked>
                            </td>
                        </tr>

                        <tr class="full_row">
                            <td class="numbers_td">02</td>
                            <td class="labels_marking">
                                {!! Form::label('low', 'Маркиране в по-долен клас:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td">
                                {!! Form::label('low', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="low" name="low" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('low_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="low_no" name="low" value="0" checked>
                            </td>
                            <td  class="numbers_td">05</td>
                            <td class="labels_marking">
                                {!! Form::label('relabeling', 'Преетикетиране:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td">
                                {!! Form::label('relabeling', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="relabeling" name="relabeling" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('relabeling_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="relabeling_no" name="relabeling" value="0" checked>
                            </td>
                            <td  class="numbers_td">07</td>
                            <td class="labels_marking">
                                {!! Form::label('fodder', 'Фураж:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td">
                                {!! Form::label('fodder', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="fodder" name="fodder" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('fodder_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="fodder_no" name="fodder" value="0" checked>
                            </td>
                        </tr>

                        <tr class="full_row">
                            <td class="numbers_td">03</td>
                            <td class="labels_marking" >
                                {!! Form::label('resort', 'Пресортиране:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td" colspan="4">
                                {!! Form::label('resort', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="resort" name="resort" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('resort_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="resort_no" name="resort" value="0" checked>
                            </td>
                            <td  class="numbers_td">08</td>
                            <td class="labels_marking">
                                {!! Form::label('destruction', 'Унищожаване:', ['class'=>'my_labels']) !!}
                            </td>
                            <td class="input_td">
                                {!! Form::label('destruction', 'ДА:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="destruction" name="destruction" value="1">
                                &nbsp;&nbsp;&nbsp;
                                {!! Form::label('destruction_no', 'НЕ:', ['class'=>'my_labels']) !!}
                                <input type="radio" id="destruction_no" name="destruction" value="0" checked>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

{{--Действия на търговеца--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Действия на търговеца</legend>
                <div class="col-md-12 col-md-6_my" >
                    <p class="bold">
                        Действия на търговеца в определен от него срок съгласно предписанията на инспектора
                    </p>
                    <textarea id="actions" name="actions" rows="2" cols="70"></textarea>
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
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('place', 'Място на издаване:', ['class'=>'my_labels']) !!}
                    {!! Form::text('place', null, ['class'=>'form-control form-control-my ',
                    'id'=>'place', 'size'=>20, 'maxlength'=>100, 'placeholder'=>'Място на издаване' ]) !!}
                </div>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('place', 'Инспектор:', ['class'=>'my_labels']) !!}

                    <select name="inspectors" id="inspectors" class="localsID form-control" style=" margin: 5px 0; width: 200px; display: inline-block">
                        <option value="0">-- Избери --</option>
                        @foreach($inspectors as $k=>$inspector)
                            <option value="{{$k}}"
                                {{--@if (old('inspectors') == null)--}}
                                {{--{{($article[0]['crop_id'] == $crop['id'])? 'selected':''}}--}}
                                {{--@else--}}
                                {{(old('inspectors') == $inspector)? 'selected':''}}
                                {{--@endif--}}
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