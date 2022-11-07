<?php
if ((int)$firm->egn === 0) {
    $egn_view = '';
} else {
    $egn_view = '&nbsp;&nbsp;ЕГН: <span class="bold"> ' . $firm->egn . ' </span>';
}
//////////////////////////
if ((int)$firm->bulstat === 0) {
    $bulstat_view = '';
} else {
    $bulstat_view = 'ЕИК/Булстат: <span class="bold"> ' . $firm->bulstat . ' </span>';
}
//////////////////////////////////
if ($firm->type_location == 1) {
    $grad_selo = 'гр.';
} elseif ($firm->type_location == 2) {
    $grad_selo = 'с.';
} else {
    $grad_selo = 'гр. / с.';
}
///////////////////////////////////////
if ($firm->type_firm == 1) {
    $et = 'ET';
} else {
    $et = '';
}
if ($firm->type_firm == 2) {
    $ood = 'ООД';
} elseif ($firm->type_firm == 3) {
    $ood = 'ЕООД';
} elseif ($firm->type_firm == 4) {
    $ood = 'АД';
} else {
    $ood = '';
}
///////
foreach ($areas as $area) {
    if ($area->id == $firm->areas_id) {
        $area_name = $area->areas_name;
    }
}
foreach ($districts_firm as $district) {
    if ($district->district_id == $firm->district_id) {
        $district_name_firm = $district->name;
    }
}

?>
<p>Име на фирмата: <span class="bold"><?php echo $et ?> "{{$firm->name}}" <?php echo $ood; ?></span></p>
<hr class="my_hr_in"/>
<p><?php echo $bulstat_view; ?></p>
<hr class="my_hr_in"/>
<p><?php echo $grad_selo; ?> <span class="bold">{{$firm->location}}</span>
    п.к. <span class="bold">{{$firm->postal_code}}</span>;
    общ. <span class="bold">{{$district_name_firm}}</span>;
    обл. <span class="bold">{{$area_name}}</span>
</p>
<p>Адрес: <span class="bold">{{$firm->address}}</span></p>
<hr class="my_hr_in"/>

<p>Представител: <span class="bold">{{$firm->owner}}</span><?php echo $egn_view; ?> </p>

<p>Мобилен: <span class="bold">{{$firm->mobil}}</span>
    &nbsp;&nbsp;Телефон: <span class="bold">{{$firm->phone}}</span>
    &nbsp;&nbsp;Email: <span class="bold">{{$firm->email}}</span></p>