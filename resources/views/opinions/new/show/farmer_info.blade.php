<?php
    if($farmer->type_firm == 1 || $farmer->type_firm  == 0){
        $et = '';
        $ood = '';
        $pin = 'ЕГН: ';
    }
    elseif($farmer->type_firm == 2 ){
        $et = 'ET "';
        $ood = '" ';
        $pin = 'ЕИК: ';
    }
    elseif($farmer->type_firm  == 3 ){
        $et = ' "';
        $ood = '" ООД';
        $pin = 'ЕИК: ';
    }
    elseif($farmer->type_firm  == 4 ){
        $et = ' "';
        $ood = '" ЕООД';
        $pin = 'ЕИК: ';
    }
    elseif($farmer->type_firm  == 5 ){
        $et = ' "';
        $ood = '" АД';
        $pin = 'ЕИК: ';
    }
    elseif($farmer->type_firm  == 6 ){
        $et = '';
        $ood = '';
        $pin = 'ЕИК: ';
    }
    else{
        $et = '';
        $ood = '';
        $pin = 'ЕГН/ЕИК: ';
    }
    $name = mb_convert_case($farmer->name, MB_CASE_UPPER, 'UTF-8' );
    $all_name = $et.''.$name.''.$ood;

    if($farmer->tvm == 1){
        $tvm = 'гр. ';
    }
    elseif($farmer->tvm == 2 ){
        $tvm = 'с. ';
    }
    else{
        $tvm = 'гр./с. ';
    }
    //////
    foreach($districts as $key=>$district){
        if($key == $farmer->district_id){
            $district_farm = $district;
        }
    }
    ///////
    foreach($districts_farm as $key=>$district){
        if($key == $farmer->district_object){
            $district_object = $district;
        }
    }
    /////
    foreach($regions as $key=>$region){
        if($key == $farmer->areas_id){
            $region_farm = $region;
        }
    }
    if(strlen($farmer->pin_owner) > 0){
        $pin_owner = 'с ЕГН: '.$farmer->pin_owner;
    }
    else{
        $pin_owner = '';
    }
?>
<p >Мярка: <span class="bold">{!! $opinion->opinion_name !!}</span></p>
<hr class="my_hr_in"/>
@if($farmer->type_firm == 1 || $farmer->type_firm  == 0)
    <p >Име на ЧЗП: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $farmer->pin !!}</span></p>
@else
    <p >Име на Фирма: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $farmer->bulstat !!}</span></p>
    <p >С управител: <span class="bold">{!! $farmer->owner !!}</span> <span class="bold">{!! $pin_owner !!}</span></p>
@endif
<hr class="my_hr_in"/>
<p ><span class="bold">{!! $tvm !!} {!! $farmer->location !!}, общ. {!! $district_farm !!}, обл. {!! $region_farm !!} </span></p>
<p >Адрес: <span class="bold">{!! $farmer->address !!}</span></p>
@if(strlen($farmer->phone) > 0 || strlen($farmer->mobil) > 0 || strlen($farmer->email > 0))
    <?php
        if(strlen($farmer->phone) > 0){
            $phone = "Телефон: <span class='bold'>$farmer->phone</span> ";
        }
        else{
            $phone = '';
        }
        if(strlen($farmer->mobil) > 0){
            $mobil = "GSM: <span class='bold'>$farmer->mobil</span> ";
        }
        else{
            $mobil = '';
        }
        if(strlen($farmer->email) > 0){
            $email = "Email: <span class='bold'>$farmer->email</span> ";
        }
        else{
            $email = '';
        }
    ?>
    <hr class="my_hr_in"/>
    {!! $phone !!} {!! $mobil !!} {!! $email !!}
@endif