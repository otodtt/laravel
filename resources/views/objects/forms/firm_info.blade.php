<?php
    if((int)$firm->egn === 0){
        $egn_view ='';
    }
    else{
        $egn_view ='&nbsp;&nbsp;ЕГН: <span class="bold"> '.$firm->egn.' </span>';
    }
    //////////////////////////
    if((int)$firm->bulstat === 0){
        $bulstat_view ='';
    }
    else{
        $bulstat_view ='ЕИК/Булстат: <span class="bold"> '.$firm->bulstat.' </span>';
    }
    //////////////////////////////////
    if($firm->type_location == 1){
        $grad_selo = 'гр.';
    }
    elseif($firm->type_location == 2){
        $grad_selo = 'с.';
    }
    else{
        $grad_selo = 'гр. / с.';
    }
    ///////////////////////////////////////
    if($firm->type_firm ==1){
        $et = 'ET';
    }
    else{
        $et = '';
    }
    if($firm->type_firm == 2){
        $ood = 'ООД';
    }
    elseif($firm->type_firm ==3){
        $ood = 'ЕООД';
    }
    elseif($firm->type_firm ==4){
        $ood = 'АД';
    }
    else{
        $ood = '';
    }
    ///////
    foreach($areas_firm as $area){
        if($area->id == $firm->areas_id){
            $area_name = $area->areas_name;
        }
    }
    foreach($districts_firm_show as $district){
        if($district->district_id == $firm->district_id){
            $district_name = $district->name;
        }
    }
?>
<div class="col-md-12 my_alert3" >
    @if(isset($admin) && $admin == 1)
        <p class="description" >Виж данните на фирмата! Ако има грешка, коригирай първо тях!</p>
    @else
        <p class="description" >Виж данните на фирмата! Ако има грешка, обърнете се към
            <span class="bold">Системния администратор</span> за корекция!</p>
    @endif

</div>
<div class="row">
    <div class="col-md-6" >
        <p >Име на фирмата: <span class="bold">{!! $et !!} "{{$firm->name}}" {!! $ood !!}</span></p>
        <p >{!! $grad_selo !!} <span class="bold">{{$firm->location}}</span>
            п.к. <span class="bold">{{$firm->postal_code}}</span>;
            общ. <span class="bold">{{ $district_name }}</span>;
            обл. <span class="bold">{{ $area_name }}</span></p>
        <p >Адрес: <span class="bold">{{$firm->address}}</span></p>
    </div>
    <div class="col-md-6 ">
        <p >{!! $bulstat_view !!}</p>
        <p >Представител: <span class="bold">{{$firm->owner}}</span>{!! $egn_view !!} </p>
        <p >Мобилен: <span class="bold">{{$firm->mobil}}</span>;
            &nbsp;&nbsp;Телефон: <span class="bold">{{$firm->phone}}</span>; &nbsp;&nbsp;Email: <span class="bold">{{$firm->email}}</span></p>
    </div>
</div>
