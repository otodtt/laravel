<div class="col-md-12_my div_margin" style="margin-top: 40px">
    @if($opinion->number_opinion == 0 || $opinion->date_opinion == 0)
        <p class="" style="font-style: italic; font-size: 0.9em">Изх. №................./............... {!! $year !!} год.</p>
    @else
        <p class="" style="font-style: italic; font-size: 0.9em">Изх. № {!! $index[0]['index_out'].' - '.$opinion->number_opinion.' '.$index[0]['out_second'] !!} / {!! date('d.m.Y', $opinion->date_opinion) !!} год.</p>
    @endif
</div>
<div class="col-md-12_my div_margin">
    <p id="opinion" style="font-weight: bold; text-align: center; font-size: 1.7em;">С Т А Н О В И Щ Е</p>
</div>
<div class="col-md-12_my div_margin">
    <table>
        <tr>
            <td class="" style="vertical-align: top">
                <p class="" style="text-decoration: underline; font-size: 1.3em">ОТНОСНО:</p>
            </td>
            <td class="" >
                <p class="" style="font-size: 1.3em; margin-left: 10px; line-height: 20px;">
                    Предоставяне  на безвъзмездна финансова помощ по<br/>
                    Програма за развитие на селските райони (2007-2013) и<br/>
                    Програма за развитие на селските райони (2014-2020)
                </p>
            </td>
        </tr>
    </table>
</div>
<div class="col-md-12_my div_margin">
    <table>
        <tbody>
        <tr>
            <td style="vertical-align: top;">
                <span style="font-style: italic; font-weight: bold; font-size: 1.15em; line-height: 5px;">Земеделският производител/стопанин:</span>
            </td>
            <td>
                &nbsp;
                <span style="font-weight: bold; font-size: 1.15em; line-height: 5px;">
                    {!! $et.mb_convert_case($opinion->name, MB_CASE_UPPER, 'UTF-8' ).$ood !!}
                </span>
            </td>
        </tr>
        </tbody>
    </table>
    <div style="text-align: center">
        <p style="font-style: italic; font-size: 0.7em;">( ЧЗП, ЕТ, ЕООД, ООД, ЗК )</p>
    </div>
</div>
<div class="col-md-12_my div_margin">
    <table>
        <tbody>
            <tr>
                <td style="vertical-align: top; width: 165px;">
                    <span style="font-weight: bold; font-style: italic; font-size: 1.1em; ">с адрес на управление: </span>
                </td>
                <td >
                    <div id="address_1" class="">
                        <p style="font-size: 1.1em; text-align: center" id="p_address" class="p_address">
                            {!! $tvm.$opinion->location.', '.$opinion->address.', общ. '.$district[0]['name'].', обл. '.$area[0]['areas_name'] !!}
                        </p>
                    </div>
                    <div id="address_2" class="hidden">
                        <p style="font-size: 1.1em; text-align: center " id="p_address2" class="p_address">
                            {!! $tvm.$opinion->location.', '.$opinion->address.', общ. '.$district[0]['name'].',' !!}<br/>
                            {!! 'обл. '.$area[0]['areas_name'] !!}
                        </p>
                    </div>
                    <div id="address_3" class="hidden" class="p_address">
                        <p style="font-size: 1.1em; text-align: center" class="p_address">
                            {!! $tvm.$opinion->location.', '.$opinion->address.',' !!}<br/>
                            {!! 'общ. '.$district[0]['name'].', обл. '.$area[0]['areas_name'] !!}
                        </p>
                    </div>

                    <p style="font-style: italic; font-size: 0.8em; ">(гр/с, кв.ул., №, бл., вх., ет., ап., община, област)</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-12_my div_margin">
    <p style="font-weight: bold; font-size: 1.15em;"><span style="font-style: italic;">ЕИК / ЕГН:</span> {!! $opinion->pin !!}</p>
</div>
<div class="col-md-12_my div_margin" style="text-align: justify; text-indent : 30px;">
    <p style="font-size: 1.15em;">
        Представляван от {!! mb_convert_case($owner, MB_CASE_UPPER, 'UTF-8' ) !!} е подал заявление в
        @if($opinion->areas_id == 22 || $opinion->areas_id == 22)
            ОДБХ {!! $logo[0]['odbh_city'] !!}
        @else
            ОДБХ гр. {!! $logo[0]['odbh_city'] !!}
        @endif
        с вх. № {!! $opinion->index_petition.'-'.$opinion->number_petition.' от '.date('d.m.Y',$opinion->date_petition ) !!} г.
        за издаване на Становище по мярка {!! $opinion->opinion_name !!}.
    </p>
    <p style="font-size: 1.15em; margin-top: 10px">
        @if($opinion->areas_id == 22 || $opinion->areas_id == 22)
            Земеделският производител е представил в ОДБХ {!! $logo[0]['odbh_city'] !!} необходимите документи посочени  в  заявлението.
        @else
            Земеделският производител е представил в ОДБХ гр. {!! $logo[0]['odbh_city'] !!} необходимите документи посочени  в  заявлението.
        @endif
    </p>
</div>
<div class="col-md-12_my div_margin" style="text-align: center">
    @if($opinion->areas_id == 22 || $opinion->areas_id == 22)
        <p class="" style="font-size: 1.15em; margin-bottom: 20px"> Областна дирекция по безопасност на храните {!! $logo[0]['odbh_city'] !!} издава настоящото</p>
    @else
        <p class="" style="font-size: 1.15em; margin-bottom: 20px"> Областна дирекция по безопасност на храните {!! 'гр. '.$logo[0]['odbh_city'] !!} издава настоящото</p>
    @endif
    <p class="bold" style="font-size: 1.4em">СТАНОВИЩЕ</p>
</div>
<div class="col-md-12_my div_margin" style="text-align: justify; ">
    @if($opinion->yes == 0)
        <p class="bold" style="font-size: 1.15em">на {!! $et.mb_convert_case($opinion->name, MB_CASE_UPPER, 'UTF-8' ).$ood !!}, в уверение на това, че Земеделското стопанство и дейността му отговарят на изискванията на Закона за защита на растенията.</p>
    @else
        <p class="bold" style="font-size: 1.15em">на {!! $et.mb_convert_case($opinion->name, MB_CASE_UPPER, 'UTF-8' ).$ood !!}, в уверение на това, че Земеделското стопанство и дейността му НЕ отговарят на изискванията на Закона за защита на растенията.</p>
    @endif
</div>
<div class="col-md-12_my div_margin" style="text-align: justify; text-indent : 30px;">
    <p style="font-size: 1.15em">Настоящето Становище се издава, за да послужи пред Разплащателна агенция, ДФЗ .</p>
</div>

@if($opinion->date_petition < 1478728800)
    <div class="col-md-12_my uppercase" id="bottom">
        <div class="col-md-12_my" style="margin-bottom: 10px;">
            <p class="bold inspector" style="font-size: 1.15em">ИЗГОТВИЛ: .............................. </p>
            <p class="bold inspector" style="font-size: 1.15em; margin-left: 100px">/{!! $opinion->position_short.' '.$opinion->inspector_name !!}/ </p>
        </div>
        <div class="col-md-12_my">
            <p class="bold" style="font-size: 1.15em">{{$director[0]['type_dir']}} ДИРЕКТОР НА ОДБХ:..............................</p>
        </div>
        <div class="col-md-12_my" >
            <p class="bold director" style="font-size: 1.15em; margin-left: 160px">/ {{$director[0]['degree']}} {{$director[0]['name']}} {{$director[0]['family']}} /</p>
        </div>
    </div>
@else
    <div class="col-md-12_my div_margin " id="bottom">
        <div class="col-md-12_my" style="margin-bottom: 10px;">
            <p class="bold inspector" style="font-size: 1.15em">ИЗГОТВИЛ: .............................. </p>
            <p class="bold inspector" style="font-size: 1.15em; margin-left: 100px">/{!! $opinion->position_short.' '.$opinion->inspector_name !!}/ </p>
        </div>
        <div class="col-md-12_my">
            <p class="bold" style="font-size: 1.15em">{{$director[0]['type_dir']}} ДИРЕКТОР НА ОДБХ:..............................</p>
        </div>
        <div class="col-md-12_my" >
            <p class="bold director" style="font-size: 1.15em; margin-left: 160px">/ {{$director[0]['degree']}} {{$director[0]['name']}} {{$director[0]['family']}} /</p>
        </div>
    </div>
    <div class="col-md-12_my uppercase" id="bottom" style="text-align: center; " >
        <p style="font-size: 0.9em; font-weight: bold">
            <i class="fa fa-envelope-o"></i>
            &nbsp; {!! $logo[0]['city'] !!},  п.к. {!! $logo[0]['postal_code'] !!},  {!! $logo[0]['address'] !!};<br/>
        </p>
        @if($logo[0]['fax'] == 0)
            <p style="font-size: 0.9em; font-weight: bold"><i class="fa fa-phone"></i> +359(0){!! $logo[0]['phone'] !!}; www.babh.government.bg</p>
        @else
            <p style="font-size: 0.9em; font-weight: bold"><i class="fa fa-phone my_fa"></i> / <i class="fa fa-fax"></i> : +359(0){!! $logo[0]['fax'] !!},
            <i class="fa fa-phone my_fa"></i> +359(0){!! $logo[0]['phone'] !!}; www.babh.government.bg</p>
        @endif
    </div>
@endif