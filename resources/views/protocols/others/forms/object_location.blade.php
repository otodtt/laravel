<p class="description" ><span class="bold red">Задължително</span> се избира областта! Ако се знае общината се избира и тя.
    Избраното населено място Задължително трябва да е от списъка.
</p>
{!! Form::label('areasIDObject', ' Избери:', ['class'=>'labels']) !!}
{!! Form::select('areasIDObject',  $regions_objects, $selected_objects, ['id' =>'areasIDObject', 'class' =>'areasID form-control' ]) !!}

<?php
if(isset($protocols)){
    $district_select_obj = $protocols->district_object;
    $name_select_obj = $protocols->location_object;
}
else{
    $district_select_obj = null;
    $name_select_obj = null;
}
?>
{!! Form::select('localsIDObject', $district_list_object, $district_select_obj, ['id' =>'localsIDObject', 'class' =>'localsID form-control']) !!}

{!! Form::text('list_name_object', $name_select_obj, ['class'=>'form-control form-control-my', 'list'=>'places_object', 'id'=>'list_name_object', 'size'=>22, 'autocomplete'=>'off' ]) !!}
<datalist id="places_object" name="places_name" >
    @foreach($locations_objects as $location)
        <option value="{{$location['name']}}" district_id2="{{$location['district_id']}}" tmv="{{$location['tvm']}}"  >{{$location['name']}}</option>
    @endforeach
</datalist>
<a href="javascript:GetValueObject();" class="fa fa-check-square-o btn btn-success my_btn_check"> Провери!</a>

{!! Form::hidden('hidden2', $selected_objects, ['id' =>'hidden2']) !!}
{!! Form::hidden('tmv', null, ['id' =>'tmv']) !!}
{!! Form::hidden('district_id2', null, ['id' =>'district_id2']) !!}
<input type="hidden" id="error2" value="0" name="error2"/>
<input type="hidden" name="is_submit2" value="{{$selected_objects}}" id="is_submit2">

&nbsp;&nbsp; | &nbsp;&nbsp;
{!! Form::label('address_object', 'Адрес на обекта:&nbsp;&nbsp;', ['class'=>'my_labels']) !!}
{!! Form::text('address_object', null, ['class'=>'form-control form-control-my', 'size'=>35, 'maxlength'=>250 ]) !!}