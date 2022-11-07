 {{--Данни на стоките--}}
 {{-- <input type="hidden" value="" name="hidden" id="hidden_value"> --}}

 <div class="container-fluid"  id="container" >
    <div class="row">
        <div class="col-md-12" >
            <input type="hidden" name="type_crops" value="1">
            <fieldset class="small_field"><legend class="small_legend">Данни на стоката</legend>
                {{-- ОПАКОВКИ --}}
                <div class="col-md-4 col-md-6_my" >
                    <fieldset class="small_field_in">
                        <p class="description">Поле 8. Опаковки (брой и вид)</p><hr class="hr_in"/>
                        <div class="row">
                            <div class="col-md-7">
                                <label for="type_package">Вид:</label>
                                <br>
                                <select onchange="run()" name="type_package" id="type" class="type_pack localsID form-control" style="width: 100%">
                                    <option value="0">Избери вида опаковка</option>
                                    @foreach($packages as $k => $pack)
                                    <option value="{{$k}}"
                                        @if (old('quality_class') == null)
                                            {{($article[0]['type_pack'] == $k )? 'selected':''}}
                                        @else
                                            {{(old('type_package') == $k)? 'selected':''}}
                                        @endif
                                    >{{$pack}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                            {!! Form::label('number', 'Брой опаковки:', ['class'=>'my_labels']) !!}
                                <br>
                            {!! Form::number('number_packages', $article[0]['number_packages'], ['class'=>'hide_number form-control form-control-my', 'style'=>'width: 100px', 'size'=>'5', 'maxlength'=>'10']) !!}
                            </div>
                        </div>
                        
                        <div class="row different_row hidden" id="different_row">
                            <div class="col-md-7">
                                {!! Form::text('different', $article[0]['different'], ['class'=>'form-control', 'style'=>'width: 100%; margin-top: 10px', 'placeholder'=> 'Опаковката я няма в списъка']) !!}
                            </div>
                        </div>

                    </fieldset>
                </div>
                {{-- КУЛТУРИ --}}
                <div class="col-md-4 col-md-6_my" >
                    <fieldset class="small_field_in">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="description">Поле 9. Тип продукт (сорт, </p><hr class="hr_in"/>
                                <label for="crops">Избери култура:</label>
                                <br>
                                <select name="crops" id="crops" class="localsID form-control">
                                    <option value="0">-- Избери --</option>
                                    @foreach($crops as $crop)
                                        <option value="{{$crop['id']}}" 
                                            @if (old('crops') == null)
                                                {{($article[0]['crop_id'] == $crop['id'])? 'selected':''}}
                                            @else
                                                {{(old('crops') == $crop['id'])? 'selected':''}}
                                            @endif
                                            crop_en="{{$crop['name_en']}}" 
                                            crops_name="{{$crop['name']}}"
                                            group_id="{{$crop['group_id']}}"
                                        >{{ mb_strtoupper($crop['name'], 'utf-8') }}
                                        </option>
                                    @endforeach
                                </select>
                                <?php 
                                    if(old('crop_en') == null){
                                        $crop_en = $article[0]['crop_en'];
                                    }else{
                                        $crop_en = old('crop_en');
                                    };
                                    if(old('crops_name') == null){
                                        $crops_name = $article[0]['crops_name'];
                                    }else{
                                        $crops_name = old('crops_name');
                                    };
                                    // if(old('group_id') == null){
                                    //     $group_id = $article[0]['group_id'];
                                    // }else{
                                    //     $group_id = old('group_id');
                                    // };
                                    
                                ?>
                                <input type="hidden" name="crop_en" id="crop_en" value="{{$crop_en}}">
                                <input type="hidden" name="crops_name" id="crops_name" value="{{$crops_name}}">
                                {{-- <input type="hidden" name="group_id" id="group_id" value="{{$$group_id}}"> --}}
                                
                                {{-- {!! Form::hidden('crop_en', old('crop_en'), ['id'=>'crop_en']) !!}
                                {!! Form::hidden('crops_name', old('crops_name'), ['id'=>'crops_name']) !!}
                                {!! Form::hidden('group_id', old('group_id'), ['id'=>'group_id']) !!} --}}
                                <input type="hidden" name="certificate_id" value="{{$id}}">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p class="description">Сорт (произход), ако..</p><hr class="hr_in"/>
                                    <label for="variety">Сорт/Произход:</label>
                                    <br>
                                    {!! Form::text('variety', $article[0]['variety'], ['class'=>'form-control', 'style'=>'width: 97%', 'placeholder'=> 'Сорт/Произход ако е необходимо', 'style' => 'padding-left: 6px']) !!}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- Качество --}}
                <div class="col-md-2"  style="padding: 0">
                    <fieldset class="small_field_in">
                        <p class="description">Поле 10</p><hr class="hr_in"/>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="quality_class">Качество:</label>
                                <select name="quality_class" id="quality_class" class="localsID form-control" style="width: 95%">
                                    <option value="0" >Избери</option>
                                    @foreach($qualitys as $k => $quality)
                                        <option value="{{$k}}"
                                            @if (old('quality_class') == null)
                                                {{($article[0]['quality_class'] == $k )? 'selected':''}}
                                            @else
                                                {{(old('quality_class') == $k)? 'selected':''}}
                                            @endif
                                        >{{$quality}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- Количество --}}
                <div class="col-md-2" style="padding: 0" >
                    <fieldset class="small_field_in">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="description">Поле 11</p><hr class="hr_in"/>
                                
                                {{-- <label class="weigh"><span>Количество: </span> --}}
                                <label for="weight">Количество:</label>
                                <br>
                                {!! Form::number('weight', $article[0]['weight'], ['class'=>'hide_number form-control form-control-my', 'style'=>'width: 100px', 'size'=>'5', 'maxlength'=>'10']) !!}
                            </div>
                        </div>
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>