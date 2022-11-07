<?php
if(isset($protocols)){
    $district_select = $protocols->district_object;
    $location_object = $protocols->location_object;
}
else{
    $district_select = null;
    $location_object = null;
}
?>
<p class="description" ><span class="bold red">Задължително</span> се избира общината и населеното място!
    Напишете адреса на проверения обект или го опишете! Пример - "Зеленчуков пазар".
</p>

{!! Form::label('localsObject', ' Избери:', ['class'=>'labels']) !!}
{!! Form::select('localsObject', $object_district, $district_select, ['id' =>'localsObject', 'class' =>'localsID form-control form-control-my']) !!}

{!! Form::text('list_name_ob', $location_object, ['class'=>'form-control form-control-my', 'list'=>'places_ob', 'id'=>'list_name_ob',  'autocomplete'=>'off' ]) !!}
<datalist id="places_ob" name="places_name_ob" >
    @foreach($object_locations as $location)
        <option value="{{$location['name']}}" data_id1="{{$location['id']}}" data_ekatte1="{{$location['ekatte']}}"
                data_tmv1="{{$location['tvm']}}" data_pc1="{{$location['postal_code']}}" areas_id2="{{$location['areas_id']}}"
                district_id2="{{$location['district_id']}}" >{{$location['name']}}</option>
    @endforeach
</datalist>
<a href="javascript:GetValueBottom();" class="fa fa-check-square-o btn btn-success my_btn_check"> Провери!</a>

<input type="hidden" id="error1" value="0" name="error1"/>
<input type="hidden" id="data_tmv1" value="0" name="data_tmv1"/>
<input type="hidden" id="data_id1" value="0" name="data_id1"/>

&nbsp;&nbsp; | &nbsp;&nbsp;
{!! Form::label('address_object', 'Адрес на обекта:', ['class'=>'my_labels']) !!}
{!! Form::text('address_object', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>250 ]) !!}