<?php
    if($opinion->date_protocol > 0){
        $date_protocol = date('d.m.Y', $opinion->date_protocol);
    }
    else{
        $date_protocol = null;
    }
    //////
    if($opinion->number_protocol == 0){
        $number_protocol = null;
    }
    else{
        $number_protocol = $opinion->number_protocol;
    }
?>
<div class="col-md-12 col-md-6_my" >
    @if($opinion->date_protocol > 0 && $opinion->number_protocol > 0 )
        <p class="bold">Становището има издаден Констативен Протокол с Номер {!! $number_protocol.' от '.$date_protocol !!} г.</p>
    @else
        <p>Становището няма издаден Констативен Протокол</p>
    @endif
</div>