
@if($farmer->type_firm == 1 || $farmer->type_firm  == 0)
    <span >Име на ЧЗП: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $farmer->pin !!}</span></span>
    <p >С адрес: <span class="bold">{!! $farmer->address !!}</span>, <span class="bold">{!! $tvm !!} {!! $farmer->location !!},
            общ. {!! $district_farm !!}, обл. {!! $region_farm !!} </span></p>
@else
    <p >Име на Фирма: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $farmer->bulstat !!}</span>
    <span >С управител: <span class="bold">{!! $farmer->owner !!}</span> <span class="bold">{!! $pin_owner !!}</span></span></p>
    <p >С адрес: <span class="bold">{!! $farmer->address !!}</span>, <span class="bold">{!! $tvm !!} {!! $farmer->location !!},
            общ. {!! $district_farm !!}, обл. {!! $region_farm !!} </span></p>
@endif
