<div class="container-fluid"  id="container" >
    <div class="row">
        <div class="col-md-12" >
            {{--<input type="hidden" name="type_crops" value="{{$certificate->type_crops}}">--}}
            <fieldset class="small_field"><legend class="small_legend">Данни на стоката</legend>
                {{-- КУЛТУРИ --}}
                <div class="col-md-6 col-md-6_my" >
                    <fieldset class="small_field_in">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="description">1. Избери продукт </p><hr class="hr_in"/>
                                <label for="crops">Избери култура:</label>
                                <br>
                                <select name="crops" id="crops" class="localsID form-control">
                                    <option value="0">-- Избери --</option>
                                    @foreach($crops as $crop)
                                    <option value="{{$crop['id']}}" 
                                        {{(old('crops') == $crop['id'])? 'selected':''}}
                                        {{--crop_en="{{$crop['name_en']}}" --}}
                                        crops_name="{{$crop['name']}}"
                                        {{--group_id="{{$crop['group_id']}}"--}}
                                    >{{ mb_strtoupper($crop['name'], 'utf-8') }}
                                    </option>
                                    @endforeach
                                </select>
{{--                                {!! Form::hidden('crop_en', old('crop_en'), ['id'=>'crop_en']) !!}--}}
                                {!! Form::hidden('crops_name', old('crops_name'), ['id'=>'crops_name']) !!}
{{--                                {!! Form::hidden('group_id', old('group_id'), ['id'=>'group_id']) !!}--}}
                                <input type="hidden" name="compliance_id" value="{{$id}}">
                                {{--<input type="hidden" name="certificate_number" value="{{$certificate->import}}">--}}
                                {{--<input type="hidden" name="firm_id" value="{{$certificate->importer_id}}">--}}
                                {{--<input type="hidden" name="firm_name" value="{{$certificate->importer_name}}">--}}
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p class="description">2. Страна на произход</p><hr class="hr_in"/>
                                    <label for="country">Произход:</label>
                                    <br>
                                    {!! Form::text('country', null, ['class'=>'form-control', 'style'=>'width: 97%', 'placeholder'=> 'Страна на произход', 'style' => 'padding-left: 6px']) !!}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- Качество --}}
                <div class="col-md-3"  style="padding: 0">
                    <fieldset class="small_field_in">
                        <p class="description">3. Обявен клас на качество</p><hr class="hr_in"/>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="class">Качество:</label>
                                <select name="class" id="class" class="localsID form-control" style="width: 95%">
                                    <option value="0" {{(old('class') == 0 )? 'selected':''}} >-- Избери --</option>
                                    <option value="999" {{(old('class') == 127 )? 'selected':''}} >БЕЗ КЛАС</option>
                                    <option value="1" {{(old('class') == 1 )? 'selected':''}} >I клас/I class</option>
                                    <option value="2" {{(old('class') == 2 )? 'selected':''}} >II клас/II class</option>
                                    <option value="3" {{(old('class') == 3 )? 'selected':''}} >OПС/GPS</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- Количество --}}
                <div class="col-md-3" style="padding: 0" >
                    <fieldset class="small_field_in">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="description">4. Количество в кг.</p><hr class="hr_in"/>
                                
                                {{-- <label class="weigh"><span>Количество: </span> --}}
                                <label for="quantity">Количество кг.:</label>
                                <br>
                                {!! Form::number('quantity', null, ['class'=>'hide_number form-control form-control-my', 'style'=>'width: 100px', 'size'=>'5', 'maxlength'=>'10', 'placeholder'=> 'кг.']) !!}
                            </div>
                        </div>
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>

