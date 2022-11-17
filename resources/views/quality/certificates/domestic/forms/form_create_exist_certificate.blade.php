
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field" ><legend class="small_legend">Сертификата се издава за ..</legend>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in" >
                        <p class="description">
                            Поле № 7. За какво се издава сертификата.
                        </p>
                        <hr class="hr_in"/>
                        <label class="labels_limit"><span>Вътрешен/Internal</span>
                            @if ($type == 3)
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                            @endif
                        </label>&nbsp;&nbsp;|
                        <label class="labels_limit"><span>&nbsp;&nbsp;Внос/Import</span>
                            @if ($type == 1)
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                            @endif
                        </label>
                        &nbsp; | &nbsp;
                        <label class="labels_limit"><span>&nbsp;&nbsp;Износ/Export</span>
                            @if ($type == 2)
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                            @endif
                        </label>
                    </fieldset>
                </div>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset id="show_type" class="small_field_in show_type ">
                        <p class="description">
                            Поле № 1 колона 2. Избери дали е за консумация или преработка.
                        </p>
                        <hr class="hr_in"/>
                        <label class="labels_limit"><span>За консумация</span>
                            <span>&nbsp;&nbsp;<i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                        </label>&nbsp;&nbsp;|
                        <label class="labels_limit"><span>&nbsp;&nbsp;За преработка</span>
                            <span>&nbsp;&nbsp;<i class="fa fa-circle-o" aria-hidden="true"></i></span>
                        </label>&nbsp; | &nbsp;
                        <input type="hidden" name="type_crops" value="1">
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div id="field_wrapper" >

    {{-- Търговец --}}
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-6" >
                <fieldset class="small_field"><legend class="small_legend">1. Търговец /Trader</legend>
                    <div class="col-md-8 col-md-6_my" >
                        <p class="description">
                            Поле № 1 Попълни фирмата! Търговец /Trader <br>
                        </p>
                        <p>Фирма: <span class="bold">{{$trader->trader_name}}</span></p>
                        <p>Адрес: <span class="bold">{{$trader->trader_address}}</span></p>
                        <p>ЕИК/Булстат: <span class="bold">{{$trader->trader_vin}}</span></p>
                        <input type="hidden" name="trader_id" value="{{$trader->id}}">
                    </div>

                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="small_field"><legend class="small_legend">Сертификат за съответствие </legend>
                    <div class="col-md-12 col-md-6_my" >
                        <p class="description">
                            Сертификат за съответствие с пазарните стандарти на Европейския съюз,
                        </p>
                        <br>
                        <p class="bold">
                            №/No {{ $index[0]['q_index'] }}-{{$user[0]['stamp_number']}}/ {{$last_number[0]['internal'] + 1}}
                            <span class="number_import hidden" id="number_import">{{$last_number[0]['internal']}}</span>
                        </p>
                        <p class="description red">
                            Провери дали данните са верни!
                        </p>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <hr class="my_hr_in"/>

    {{--Опаковчик, посочен върху опаковката--}}
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-4" >
                <fieldset class="small_field"><legend class="small_legend">2. Опаковчик, посочен върху опаковката </legend>
                    <div class="col-md-12 col-md-6_my" >
                        <p class="description">
                            Поле № 2. Опаковчик, посочен върху .. ЕИК/Булстат не е задължителен<br>
                        </p>

                        <div class="packer_wrap" >
                            <label for="packer_name">Име на Опаковчик: &lt;br&gt;</label>
                            {!! Form::text('packer_name', null, ['class'=>'form-control', 'style'=>'width: 97%', 'placeholder'=> 'Име на Опаковчик']) !!}
                            {{--<br>--}}
                            <label for="packer_address">Адрес:</label>
                            {!! Form::text('packer_address', null, ['class'=>'form-control', 'style'=>'width: 97%', 'placeholder'=>'Адрес на Опаковчик']) !!}
                            <label for="packer_address">ЕИК:</label>
                            {!! Form::text('packer_vin', null, ['class'=>'form-control', 'style'=>'width: 40%', 'placeholder'=>'ЕИК/Булстат']) !!}
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-2">
                <fieldset class="small_field"><legend class="small_legend">3. Контролен орган</legend>
                    <p class="description">
                        Поле № 3. Контролен орган
                    </p>
                    <br>
                    <p> <p class="bold">{{ $index[0]['authority_bg'] }}</p></p>
                    {{-- <p> <p class="bold">{{ $index[0]['authority_en'] }}</p></p> --}}
                    <br>
                    <br>
                    <br>
                </fieldset>
            </div>
            <div class="col-md-3">
                <fieldset class="small_field"><legend class="small_legend">4. Произход
                    </legend>
                    <div class="col-md-12 col-md-6_my" >
                        <p class="description">
                            Поле № 4. Място на инспекцията/страна на произход
                        </p>
                        <label for="from_country">Страна:</label>
                        {!! Form::text('from_country', null, ['class'=>'form-control', 'style'=>'width: 97%', 'autocomplete'=>'on', 'placeholder'=> 'Попълни страната' ]) !!}
                        <br>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-3">
                <fieldset class="small_field"><legend class="small_legend">5. Местоназначение</legend>
                    <div class="col-md-12 col-md-6_my" >
                        <p class="description">
                            Поле № 5. Регион или страна на .. /Region
                        </p>
                        <label for="country">Избери страна:</label>
                        <select name="id_country" id="id_country" class="localsID form-control" style="width: 97%">
                            <option value="">-- Избери --</option>
                            @foreach($countries as $country)
                                <option value="{{$country['id']}}" 
                                        {{( (old('id_country') == $country['id']) || ($country['id'] == 9))? 'selected':''}}
                                        for_country_bg="{{$country['name']}}" 
                                        for_country_en="{{$country['name_en']}}"
                                        >{{ mb_strtoupper($country['name'], 'utf-8' )  }}
                                </option>
                            @endforeach
                        </select>
                        <?php 
                         if(old('for_country_bg') == null){
                                $country_bg = 'България';
                            }else{
                                $country_bg = old('for_country_bg');
                            };
                            if(old('for_country_en') == null){
                                $country_en = 'Bulgaria';
                            }else{
                                $country_en = old('for_country_en');
                            };
                        ?>
                        <input type="hidden" name="for_country_bg" value="{{$country_bg}}" id="for_country_bg">
                        <input type="hidden" name="for_country_en" value="{{$country_en}}" id="for_country_en">
                        {{-- {!! Form::hidden('for_country_bg', old('for_country_bg'), ['id'=>'for_country_bg']) !!} --}}
                        {{-- {!! Form::hidden('for_country_en', old('for_country_en'), ['id'=>'for_country_en']) !!} --}}
                        <br>
                        {{-- <br> --}}
                        
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <hr class="my_hr_in"/>

    {{--Идентификация на тр. средства--}}
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-6" >
                <fieldset class="small_field" style="height: 110px;"><legend class="small_legend">Идентификация на транспортни средства</legend>

                    <div class="col-md-12" >
                        <p class="description">
                            Поле № 6 Идентификация на транспортните средства.
                        </p>
                        <br>
                        {!! Form::label('transport', 'Номера - Не се попълват:', ['class'=>'my_labels']) !!}
                        <br>
                        {{-- {!! Form::text('transport', null, ['class'=>'form-control', 'style'=>'width: 50%', 'maxlength'=>30]) !!} --}}
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6 ">
                <fieldset class="small_field"><legend class="small_legend">За какво се издава сертификата.</legend>
                    <p class="description">
                        Поле № 7
                    </p>
                    @if ($type == 3)
                    <p id="p_internal_yes" class=""><i class="fa fa-check-square-o" aria-hidden="true"></i> <span style="text-decoration: underline">вътрешен/internal</span></p>
                    @else
                    <p id="p_internal_no"><i class="fa fa-square-o" aria-hidden="true"></i> <span>вътрешен/internal</span></p>
                    @endif

                    @if ($type == 1)
                    <p id="p_import_yes" ><i class="fa fa-check-square-o" aria-hidden="true"></i> <span style="text-decoration: underline">внос/import</span></p>
                    @else  
                    <p id="p_import_no" class=""><i class="fa fa-square-o" aria-hidden="true"></i> <span >внос/import</span></p>  
                    @endif

                    @if ($type == 2)
                    <p id="p_export_yes" class=""><i class="fa fa-check-square-o" aria-hidden="true"></i> <span style="text-decoration: underline">износ/export</span></p>
                    @else   
                    <p id="p_export_no"><i class="fa fa-square-o" aria-hidden="true"></i> <span>износ/export</span></p> 
                    @endif
                </fieldset>
            </div>
        </div>
    </div>

    <hr class="my_hr_in"/>

    {{--Място и дата на провеката--}}
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12" >
                <fieldset class="small_field"><legend class="small_legend">Данни за митническо учреждение и други</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <fieldset class="small_field_in" style="height: 114px">
                                <p class="description">Поле 12. Митническо учреждение </p><hr class="hr_in"/>
                                <div class="col-md-12 col-md-6_my" >
                                    <br>
                                </div>
                            </fieldset>
                        </div>
                        {{--<hr class="hr_in"/>--}}
                        <div class="col-md-4">
                            <fieldset class="small_field_in" style="height: 114px">
                                <p class="description">Поле 12. Място на издаване </p><hr class="hr_in"/>
                                <div class="col-md-12 col-md-6_my" >
                                    {{--<br>--}}
                                    {!! Form::label('place_bg', 'Място на български:', ['class'=>'my_labels']) !!}&nbsp;
                                    {!! Form::text('place_bg', null, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>250,
                                    'placeholder'=> 'Свиленград' ]) !!}
                                    <br><br>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-2">
                            <fieldset class="small_field_in" style="height: 114px" >
                                <p class="description">Поле 12. Валиден до </p><hr class="hr_in"/>
                                {{-- <br> --}}
                                <div class="col-md-12 col-md-6_my" >
                                    {!! Form::label('valid_until', 'Дата:', ['class'=>'my_labels']) !!}<br>
                                    {!! Form::text('valid_until', null, ['class'=>'form-control form-control-my',
                                    'id'=>'date_issue', 'size'=>12, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг',  'autocomplete'=>'off' ]) !!}
                                    <br>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-2">
                            <fieldset class="small_field_in" >
                                <p class="description">Инспектор</p><hr class="hr_in"/>
                                <div class="col-md-12 col-md-6_my" >
                                    <p style="margin-top: 15px">
                                        <span class="bold">{{ mb_strtoupper($user[0]['all_name']), 'utf-8' }}</span>
                                    </p>
                                    <hr class="hr_in"/>
                                    <p style="margin-top: 15px">Дата на издаване:
                                        <span class="bold" style="margin-right: 20px">{{date('d.m.Y', time())}}</span>
                                    </p>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <hr class="my_hr_in"/>

    {{--ФАКТУРА И ДАТА--}}
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12">
                <fieldset class="small_field"><legend class="small_legend">Забележки, Номер и дата на Фактура</legend>
                    <fieldset class="small_field_in" style="width: 49%; float: left">
                        <p class="description">
                            Поле 13 <span class="red bold">ВАЖНО!!!</span> Когато се избира "<span class="bold">За преработка</span>" текста 
                            "Сертификатът се издава на основание чл. 4 т. 7 от Регламент (ЕС) 543/2011 г." <span class="bold">НЕ СЕ ВЪВЕЖДА!!!</span> 
                            Ще се изпише автоматично. Тук се вписват САМО ако има други забележки!!!
                        </p>
                        <hr class="hr_in" />
                        {!! Form::text('observations', null, ['class'=>'form-control', 'style'=>'width: 99%; margin-top: 10px;
                    }', 'autocomplete'=>'observations']) !!}
                    </fieldset>
                </fieldset>
            </div>
        </div>
    </div>
</div>