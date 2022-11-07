<?php
if(!empty($factory)> 0){
    $firm_select = $factory['id'];
}
else{
    $firm_select = null;
}
?>
<div class="row">
    <div class="col-md-7 " >
        {!! Form::label('select_factory', 'Избери фирма производител:', ['class'=>'my_labels']) !!}
        {!! Form::select('select_factory', $firms, $firm_select, ['id' =>'select_factory', 'class' =>'inspector form-control form-control_my_factory' ]) !!}
    </div>
    <div class="col-md-5 ">
    @if(isset($edit) && $edit == 1)
        <p class="description factory_description bold red" >Не променяй ако не е задължително!</p>
    @else
        <p class="description factory_description bold" >Задължително избери фирма производител!</p>
    @endif
    </div>
</div>