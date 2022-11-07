<?php
//if(isset($protocol)){
//    $selected_regions = $protocol->areas_id;
//    $area_select = $protocol->district_id;
//    $name_select = $protocol->location;;
//}
//else{
//    $selected_regions = $selected;
//    $area_select = null;
//    $name_select = null;
//}
?>
<p class="description" ><span class="bold red">Задължително</span> се избира областта! Ако се знае общината се избира и тя.
    Избраното населено място Задължително трябва да е от списъка.
</p>
{!! Form::label('areasID', ' Избери:', ['class'=>'labels']) !!}
{!! Form::select('areasID',  $areas_all, $selected, ['id' =>'areasID', 'class' =>'areasID form-control' ]) !!}

<?php
if(isset($selected_district)){
    $district_select = $selected_district;
}
else{
    $district_select = null;
}
?>
{!! Form::select('localsID', $district_list, $district_select, ['id' =>'localsID', 'class' =>'localsID form-control']) !!}
<?php
if(isset($protocol)){
    $name_select = $protocol->location_object;
}
else{
    $name_select = null;
}

?>
{!! Form::text('list_name', $name_select, ['class'=>'form-control form-control-my', 'list'=>'places', 'id'=>'list_name', 'size'=>22, 'autocomplete'=>'off' ]) !!}
<datalist id="places" name="places_name" >
    @foreach($locations as $location)
        <option value="{{$location['name']}}" data_id="{{$location['id']}}" data_ekatte="{{$location['ekatte']}}"
                data_tmv="{{$location['tvm']}}" data_pc="{{$location['postal_code']}}" areas_id="{{$location['areas_id']}}"
                district_id="{{$location['district_id']}}" >{{$location['name']}}</option>
    @endforeach
</datalist>
<a href="javascript:GetValue();" class="fa fa-check-square-o btn btn-success my_btn_check"> Провери!</a>

{!! Form::hidden('hidden', $selected, ['id' =>'hidden']) !!}

{!! Form::hidden('data_id', null, ['id' =>'data_id']) !!}
{!! Form::hidden('data_ekatte', null, ['id' =>'data_ekatte']) !!}
{!! Form::hidden('data_tmv', null, ['id' =>'data_tmv']) !!}
{!! Form::hidden('postal_code', null, ['id' =>'postal_code']) !!}
{!! Form::hidden('areas_id', null, ['id' =>'areas_ids']) !!}
{!! Form::hidden('district_id', null, ['id' =>'district_ids']) !!}
<input type="hidden" id="error" value="0" name="error"/>

&nbsp;&nbsp; | &nbsp;&nbsp;
{!! Form::label('address_object', 'Адрес на проверявания обект:', ['class'=>'my_labels']) !!}
{!! Form::text('address_object', null, ['class'=>'form-control form-control-my', 'size'=>35, 'maxlength'=>250 ]) !!}