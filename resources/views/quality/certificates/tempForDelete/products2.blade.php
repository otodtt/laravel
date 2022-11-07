<div class="container-fluid" style="display: {{$display}}" id="container1">
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни на стоките - 1</legend>
                <div class="col-md-4 col-md-6_my" >
                    <fieldset class="small_field_in">
                        <p class="description">Поле 8. Опаковки (брой и вид)</p><hr class="hr_in"/>
                        <div class="row">
                            <div class="col-md-7">
                                <label for="products">Вид:</label>
                                <select onchange="run1()" name="products[1][type]" class="type_pack1 localsID form-control" style="width: 100%">
                                    <option value="0">Избери вида опаковка</option>
                                    <option value="5">КАСИ</option>
                                    <option value="4">ПАЛЕТИ</option>
                                    <option value="3">БОКС</option>
                                    <option value="2">НАСИПНО</option>
                                    <option value="1">Друго</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                {!! Form::label('products', 'Брой опаковки:', ['class'=>'my_labels']) !!}
                                <input type="number" name="products[1][number]" class="hide_number1 form-control form-control-my"
                                       size="5" maxlength="10" style="width: 100px">
                            </div>
                        </div>
                        <div class="row different_row1 hidden" >
                            <div class="col-md-7">
                                <input type="text" name="products[1][different]" class="form-control" style="width: 100%; margin-top: 10px"
                                       placeholder="Опаковката я няма в списъка" maxlength="100">
                            </div>
                            <div class="col-md-5">
                                <input type="number" name="products[1][dif_number]" class="form-control form-control-my" size="5"
                                       maxlength="10" style="width: 100px;  margin-top: 10px">
                            </div>
                        </div>

                    </fieldset>
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <fieldset class="small_field_in">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="description">Поле 9. Тип продукт (сорт, </p><hr class="hr_in"/>
                                <label for="products">Избери култура:</label>
                                <select name="products[1][crops]" id="crops" class="localsID form-control">
                                    <option value="0">-- Избери --</option>
                                    @foreach($crops as $crop)
                                        <option value="{{$crop['id']}}" >{{ mb_strtoupper($crop['name'], 'utf-8') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p class="description">Сорт, ако..</p><hr class="hr_in"/>
                                    <label for="products">Сорт:</label>
                                    <input type="text" name="products[1][variety]" class="form-control"
                                           maxlength="100" style="width: 100px;" placeholder="Сорт ако е необходимо">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-2"  style="padding: 0">
                    <fieldset class="small_field_in">
                        <p class="description">Поле 10</p><hr class="hr_in"/>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="products">Качество:</label>
                                <select name="products[1][quality_class]" id="quality_class" class="localsID form-control" style="width: 95%">
                                    <option value="0">Избери</option>
                                    <option value="1">ПЪРВО/FIRST</option>
                                    <option value="2">НЕ ЗНАМ СИ КВО</option>
                                    <option value="3">OПС/GPS</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-2" style="padding: 0" >
                    <fieldset class="small_field_in">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="description">Поле 11</p><hr class="hr_in"/>
                                <label class="products"><span>Kg</span>
                                    <input type="radio" name="products[1][weight_kg]" value="1">
                                </label>&nbsp;&nbsp;|
                                <label class="products"><span>&nbsp;&nbsp;Тон</span>
                                    <input type="radio" name="products[1][weight_kg]" value="2">
                                </label>
                                <br>
                                <input type="number" name="products[1][weight]" class="form-control form-control-my" size="5"
                                       maxlength="100" style="width: 100px;" >
                                <span class="bold">К-во</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </fieldset>
        </div>
        <button style="background-color:green;" class="add_btn btn btn-info " onclick="showDiv1(); test(1)" name="add"  type="button">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
        <button style="background-color:red; float: right;
                        display: {{$minus_btn}}"
                id="fa-minus_1"
                class=" btn btn-info ">
            <i class="fa fa-minus" aria-hidden="true"></i>
        </button>
        <input type="hidden" value="1" name="hidden_in">
    </div>
</div>

<hr id="hr1" class="my_hr_in" style="display: {{$display}}"/>