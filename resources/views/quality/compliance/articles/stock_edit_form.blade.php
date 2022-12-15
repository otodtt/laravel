<div class="container-fluid"  id="container" >
    <div class="row">
        <div class="col-md-12" >
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
                                        @if (old('crops') == null)
                                        {{($article[0]['product_id'] == $crop['id'])? 'selected':''}}
                                        @else
                                        {{(old('crops') == $crop['id'])? 'selected':''}}
                                        @endif
                                        crops_name="{{$crop['name']}}"
                                    >{{ mb_strtoupper($crop['name'], 'utf-8') }}
                                    </option>
                                    @endforeach
                                </select>
                                <?php
                                if(old('crops_name') == null){
                                    $crops_name = $article[0]['product'];
                                }else{
                                    $crops_name = old('product');
                                };
                                ?>
                                <input type="hidden" name="crops_name" id="crops_name" value="{{$crops_name}}">
                                <input type="hidden" name="compliance_id" value="{{$id}}">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p class="description">2. Страна на произход</p><hr class="hr_in"/>
                                    <label for="country">Произход:</label>
                                    <br>
                                    {!! Form::text('country', $article[0]['country'], ['class'=>'form-control', 'style'=>'width: 97%', 'placeholder'=> 'Страна на произход', 'style' => 'padding-left: 6px']) !!}
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
                                    <option value="0" >Избери</option>
                                    @foreach($qualitys as $k => $quality)
                                        <option value="{{$k}}"
                                        @if (old('quality_class') == null)
                                            {{($article[0]['class'] == $k )? 'selected':''}}
                                                @else
                                            {{(old('class') == $k)? 'selected':''}}
                                                @endif
                                        >{{$quality}}</option>
                                    @endforeach
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
                                <label for="quantity">Количество кг.:</label>
                                <br>
                                {!! Form::number('quantity', $article[0]['quantity'], ['class'=>'hide_number form-control form-control-my', 'style'=>'width: 100px', 'size'=>'5', 'maxlength'=>'10', 'placeholder'=> 'кг.']) !!}
                            </div>
                        </div>
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>

