<p class="description" ><span class="bold red"><i class="fa fa-warning"></i> Внимание</span>
    Задължително се избира областа, общината и насленото място където е регистрирана фирмата.
</p>
{!! Form::label('areasID', ' Избери:', ['class'=>'labels']) !!}
{!! Form::select('areasID',  $regions, $selected, ['id' =>'areasID', 'class' =>'areasID form-control', ]) !!}

<?php
if(isset($protocols)){
    $district_select = $protocols->district_id;
    $name_select = $protocols->location;
}
else{
    $district_select = null;
    $name_select = null;
}
?>
{!! Form::select('localsID', $district_list, $district_select, ['id' =>'localsID', 'class' =>'localsID form-control']) !!}

{!! Form::text('list_name', $name_select, ['class'=>'form-control form-control-my', 'list'=>'places', 'id'=>'list_name', 'size'=>22, 'autocomplete'=>'off' ]) !!}
<datalist id="places" name="places_name" >
    @foreach($locations as $location)
        <option value="{{$location['name']}}" data_id="{{$location['id']}}" data_ekatte="{{$location['ekatte']}}"
                data_tmv="{{$location['tvm']}}" data_pc="{{$location['postal_code']}}" areas_id="{{$location['areas_id']}}"
                district_id="{{$location['district_id']}}" >{{$location['name']}}
        </option>
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
{!! Form::label('address', 'Адрес на Фирмата:', ['class'=>'my_labels']) !!}
{!! Form::text('address', null, ['class'=>'form-control form-control-my', 'size'=>35, 'maxlength'=>250 ]) !!}