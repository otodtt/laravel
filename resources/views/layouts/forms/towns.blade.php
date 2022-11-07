<?php
    if(isset($selected_area)){
        $area_select = $selected_area;
    }
    else{
        $area_select = null;
    }
    ?>
    {!! Form::select('localsID', $districts, $area_select, ['id' =>'localsID', 'class' =>'localsID form-control form-control-my']) !!}

    <?php
    if(isset($name_location)){
        $name_select = $name_location;
    }
    else{
        $name_select = null;
    }
?>
{!! Form::text('list_name', $name_select, ['class'=>'form-control form-control-my', 'list'=>'places', 'id'=>'list_name',  'autocomplete'=>'off' ]) !!}
<datalist id="places" name="places_name" >
    @foreach($locations as $location)
        <option value="{{$location['name']}}" data_id="{{$location['id']}}" data_ekatte="{{$location['ekatte']}}"
                data_tmv="{{$location['tvm']}}" data_pc="{{$location['postal_code']}}" areas_id="{{$location['areas_id']}}"
                district_id="{{$location['district_id']}}" >{{$location['name']}}</option>
    @endforeach
</datalist>
<a href="javascript:GetValue();" class="fa fa-check-square-o btn btn-success my_btn_check"> Провери!</a>

<input type="hidden" id="error" value="0" name="error"/>
<input type="hidden" id="data_tmv" value="0" name="data_tmv"/>
<input type="hidden" id="data_id" value="0" name="data_id"/>

