
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
                            @if ($type == 0)
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
                    <div class="col-md-7 col-md-6_my" >
                        <p class="description">
                            Поле № 1 Избери фирмата! Търговец /Trader &nbsp; &nbsp; &nbsp;<br>
                        </p>
                        <label for="importer_data">Избери износител:</label>
                        <select name="importer_data" id="importer_data" class="localsID form-control">
                            <option value="">-- Избери --</option>
                            @foreach($importers as $key => $importer)
                                <option value="{{$importer['id']}}"
                                    @if (old('importer_data') == null)
                                        {{( $certificate->importer_id  == $importer['id']) ? 'selected':''}}
                                    @else
                                        {{(old('importer_data') == $importer['id']) ? 'selected':''}}
                                    @endif
                                        name_en="{{$importer['name_en']}}" 
                                        address_en="{{$importer['address_en']}}"
                                        vin="{{$importer['vin']}}" >{{ strtoupper($importer['name_en']) }}
                                </option>
                            @endforeach
                        </select>
                        <?php 
                            if(old('en_name') == null){
                                $name = $certificate->importer_name;
                            }else{
                                $name = old('en_name');
                            };
                            if(old('en_address') == null){
                                $address = $certificate->importer_address;
                            }else{
                                $address = old('en_address');
                            };
                            if(old('vin_hidden') == null){
                                $vin_number = $certificate->importer_vin;
                            }else{
                                $vin_number = old('vin_hidden');
                            }
                        ?>
                        <input type="hidden" name="en_name" id="en_name" value="{{$name}}">
                        <input type="hidden" name="en_address" id="en_address" value="{{$address}}">
                        <input type="hidden" name="vin_hidden" id="vin_hidden" value="{{$vin_number}}">
                    </div>
                    <div  class="col-md-5">
                        <p class="description">
                            <span class="red">ВАЖНО!!!</span> Ако фирмата я няма в падащото меню, иди на страница
                            „ВСИЧКИ ФИРМИ“ и добави фирмата!
                        </p>
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
                            №/No  {{ $certificate->stamp_number }}/ {{ $certificate->import }}
                            <span class="number_import hidden" id="number_import">{{ $certificate->import }}</span>
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
            {{-- 2. Опаковчик --}}
            <div class="col-md-4" >
                <fieldset class="small_field"><legend class="small_legend">2. Опаковчик, посочен върху опаковката </legend>
                    <div class="col-md-12 col-md-6_my" >
                        <p class="description">
                            Поле № 2. Опаковчик, посочен върху .. &nbsp; &nbsp; &nbsp;<br>
                        </p>
                        <label for="packer_data">Избери Опаковчик:</label>
                        <select name="packer_data" id="packer_data" class="localsID form-control" style="width: 97%">
                            <option value="">-- Избери --</option>
                            <option value="888"
                                    @if (old('packer_data') == null)
                                        {{( $certificate->packer_id  == 888) ? 'selected':''}}
                                    @else
                                        {{(old('packer_data') == 888) ? 'selected':''}}
                                    @endif
                                    {{(old('packer_data') == 888)? 'selected':''}}
                                >БЕЗ ФИРМА!</option>
                            @foreach($packers as $packer)
                                <option value="{{$packer['id']}}"
                                        @if (old('packer_data') == null)
                                        {{( $certificate->packer_id  == $packer['id']) ? 'selected':''}}
                                        @else
                                        {{(old('packer_data') == $packer['id']) ? 'selected':''}}
                                        @endif

{{--                                        {{(old('packer_data') == $packer['id'])? 'selected':''}}--}}
                                        name_of_packer="{{$packer['packer_name']}}"
                                        address_of_packer="{{$packer['packer_address']}}">
                                    {{ strtoupper($packer['packer_name']) }}
                                </option>
                            @endforeach
                        </select>

                        <?php
                        if(old('name_of_packer') == null){
                            $name = $certificate->packer_name;
                        }else{
                            $name = old('name_of_packer');
                        };
                        if(old('address_of_packer') == null){
                            $address = $certificate->packer_address;
                        }else{
                            $address = old('address_of_packer');
                        }
                        ?>
                        <input type="hidden" name="name_of_packer" id="name_of_packer" value="{{$name}}">
                        <input type="hidden" name="address_of_packer" id="address_of_packer" value="{{$address}}">
                        {{--{!! Form::hidden('name_of_packer', old('name_of_packer'), ['id'=>'name_of_packer']) !!}--}}
                        {{--{!! Form::hidden('address_of_packer', old('address_of_packer'), ['id'=>'address_of_packer']) !!}--}}
                        <br class="my_br" />
                        <br class="my_br" />
                        <br />
                        {{--<label for="packer_name">Име на Опаковчик:</label>--}}
                        {{--{!! Form::text('packer_name', null, ['class'=>'form-control', 'style'=>'width: 97%', 'placeholder'=> 'Име на Опаковчик']) !!}--}}
                        {{--<br>--}}
                        {{--<label for="packer_address">Адрес:</label>--}}
                        {{--{!! Form::text('packer_address', null, ['class'=>'form-control', 'style'=>'width: 97%', 'placeholder'=>'Адрес на Опаковчик', 'autocomplete'=>'packer_address']) !!}--}}
                    </div>
                </fieldset>
            </div>
            {{-- 3. Контролен орган --}}
            <div class="col-md-2">
                <fieldset class="small_field"><legend class="small_legend">3. Контролен орган</legend>
                    <p class="description">
                        Поле № 3. Контролен орган
                    </p>
                    <br>
                    <p> <p class="bold">{{ $index[0]['authority_bg'] }}</p></p>
                    <p> <p class="bold">{{ $index[0]['authority_en'] }}</p></p>
                    <br>
                    <br>
                    <br>
                </fieldset>
            </div>
            {{-- 4. Произход --}}
            <div class="col-md-3">
                <fieldset class="small_field"><legend class="small_legend">4. Произход
                    </legend>
                    <div class="col-md-12 col-md-6_my" >
                        <p class="description">
                            Поле № 4. Място на инспекцията/страна на произход
                        </p>
                        <br>
                        <label for="from_country">Страна:</label>
                        {!! Form::text('from_country', null, ['class'=>'form-control', 'style'=>'width: 97%', 'autocomplete'=>'on', 'placeholder'=> 'Турция/ Turkey' ]) !!}
                        <br>
                    </div>
                </fieldset>
            </div>
            {{-- 5. Местоназначение --}}
            <div class="col-md-3">
                <fieldset class="small_field"><legend class="small_legend">5. Местоназначение</legend>
                    <div class="col-md-12 col-md-6_my" >
                        <p class="description">
                            Поле № 5. Регион или страна на .. /Region
                        </p>
                        <br>
                        <label for="country">Избери страна:</label>
                        <select name="id_country" id="id_country" class="localsID form-control" style="width: 97%">
                            <option value="">-- Избери --</option>
                            @foreach($countries as $country)
                                <option value="{{$country['id']}}" 
                                    @if (old('id_country') == null)
                                        {{( $certificate->id_country == $country['id'])? 'selected':''}}
                                    @else
                                        {{(old('id_country') == $country['id'])? 'selected':''}}
                                    @endif
                                        for_country_bg="{{$country['name']}}" 
                                        for_country_en="{{$country['name_en']}}"
                                        >{{ mb_strtoupper($country['name'], 'utf-8' )  }}
                                </option>
                            @endforeach
                        </select>
                        <?php 
                            if(old('for_country_bg') == null){
                                $country_bg = $certificate->for_country_bg;
                            }else{
                                $country_bg = old('for_country_bg');
                            };
                            if(old('for_country_en') == null){
                                $country_en = $certificate->for_country_en;
                            }else{
                                $country_en = old('for_country_en');
                            };
                            
                        ?>
                        <input type="hidden" name="for_country_bg" id="for_country_bg" value="{{$country_bg}}">
                        <input type="hidden" name="for_country_en" id="for_country_en" value="{{$country_en}}">
                        <br>
                        <br>
                        
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
                <fieldset class="small_field"><legend class="small_legend">Идентификация на транспортни средства</legend>

                    <div class="col-md-12" >
                        <p class="description">
                            Поле № 6 Идентификация на транспортните средства.
                        </p>
                        {!! Form::label('transport', 'Номера:', ['class'=>'my_labels']) !!}
                        {!! Form::text('transport', null, ['class'=>'form-control', 'style'=>'width: 50%', 'maxlength'=>30]) !!}
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6 ">
                <fieldset class="small_field"><legend class="small_legend">За какво се издава сертификата.</legend>
                    <p class="description">
                        Поле № 7
                    </p>
                    @if ($type == 0)
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
                        {{-- Митническо учреждение --}}
                        <div class="col-md-4">
                            <fieldset class="small_field_in">
                                <p class="description">Поле 12. Митническо учреждение </p><hr class="hr_in"/>
                                <div class="col-md-12 col-md-6_my" >
                                    {!! Form::label('customs_bg', 'Митница на български:', ['class'=>'my_labels']) !!}&nbsp;
                                    {!! Form::text('customs_bg', null, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>250,
                                    'placeholder'=> 'МБ Свиленград' ]) !!}
                                    <br><br>
                                    {!! Form::label('customs_en', 'Митница на латиница:  ', ['class'=>'my_labels']) !!}&nbsp;&nbsp;
                                    {!! Form::text('customs_en', null, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>250,
                                    'placeholder'=> 'CP-Svilengrad' ]) !!}
                                </div>
                            </fieldset>
                        </div>
                        {{--  Място на издаване --}}
                        <div class="col-md-4">
                            <fieldset class="small_field_in">
                                <p class="description">Поле 12. Място на издаване </p><hr class="hr_in"/>
                                <div class="col-md-12 col-md-6_my" >
                                    {!! Form::label('place_bg', 'Място на български:', ['class'=>'my_labels']) !!}&nbsp;
                                    {!! Form::text('place_bg', null, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>250,
                                    'placeholder'=> 'Свиленград' ]) !!}
                                    <br><br>
                                    {!! Form::label('place_en', 'Място на латиница:', ['class'=>'my_labels']) !!}&nbsp;&nbsp;
                                    {!! Form::text('place_en', null, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>250,
                                    'placeholder'=> 'Svilengrad' ]) !!}
                                    <input type="hidden" name="hidden_date" value="{{date('d.m.Y', $certificate->date_issue)}}">
                                </div>
                            </fieldset>
                        </div>
                        {{--  Валиден до --}}
                        <div class="col-md-2">
                            <fieldset class="small_field_in" >
                                <p class="description">Поле 12. Валиден до </p><hr class="hr_in"/>
                                {{-- <br> --}}
                                <div class="col-md-12 col-md-6_my" >
                                    {!! Form::label('valid_until', 'Дата:', ['class'=>'my_labels']) !!}<br>
                                    {!! Form::text('valid_until', null, ['class'=>'form-control form-control-my',
                                    'id'=>'date_edit', 'size'=>12, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг',  'autocomplete'=>'off' ]) !!}
                                    <br>
                                    <br>
                                </div>
                            </fieldset>
                        </div>
                        {{--  Инспектор --}}
                        <div class="col-md-2">
                            <fieldset class="small_field_in" >
                                <p class="description">Инспектор</p><hr class="hr_in"/>
                                <div class="col-md-12 col-md-6_my" >
                                    <p style="margin-top: 15px">
                                        <span class="bold">{{ mb_strtoupper($certificate->inspector_bg), 'utf-8' }}</span>
                                    </p>
                                    <hr class="hr_in"/>
                                    <p style="margin-top: 15px">Дата на издаване:
                                        <span class="bold" style="margin-right: 20px">{{date('d.m.Y', $certificate->date_issue)}}</span>
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
                        {!! Form::text('observations', null, ['class'=>'form-control', 'style'=>'width: 99%; margin-top: 10px;', 'autocomplete'=>'observations']) !!}
                        <input type="hidden" name="export" value="1111" id="export">
                    </fieldset>
                </fieldset>
            </div>
        </div>
    </div>
</div>