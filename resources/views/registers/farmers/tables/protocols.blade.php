<table class="tableall" id="testTable"  border="1">
    <thead>
    <tr>
        <th>№</th>
        <th class="middle" >№ на КП и дата</th>
        <th style="width: 180px" class="middle">Проверяващ инспектор<br/><span class="small" >(име, фамилия, длъжност)</span></th>
        <th style="width: 280px" class="middle">Проверявано лице/<br/><span class="small" >(ЗП / фирма)</span></th>
        <th style="width: 100px" class="middle">Адрес на стопанството</th>

        <th class="middle">Констатирано нарушение/я<br/><span class="small">(описание на нарушението/ята)</span></th>

        <th class="middle">Направено предписание/я<br/><span class="small">(брой)</span></th>
        <th class="middle">Съставен Акт<br/>№/дата</th>
        <th class="middle">Издадено НП<br/>№/дата</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $n = 1;
    $cz = 0;
    ?>
    @foreach($all_protocols as $protocol)
        <?php
        if ($protocol['firm'] == 1) {
            $et = '';
            $ood = '';
        } elseif ($protocol['firm'] == 2) {
            $et = 'ET "';
            $ood = '" ';
        } elseif ($protocol['firm'] == 3) {
            $et = ' "';
            $ood = '" ООД';
        } elseif ($protocol['firm'] == 4) {
            $et = ' "';
            $ood = '" ЕООД';
        } elseif ($protocol['firm'] == 5) {
            $et = ' "';
            $ood = '" АД';
        } else {
            $et = '';
            $ood = '';
        }
//        $name_firm = mb_convert_case($protocol['name'], MB_CASE_UPPER, 'UTF-8');
        $full_name = $et . ''. $protocol['name'].'' . $ood;
        if(strlen($protocol['order_protocol']) > 0){
            $order_protocol = 1;
        }
        else{
            $order_protocol = '';
        }
        if($protocol['act'] == 0){
            $act = '';
        }
        else{
            $act = $protocol['act'];
        }


        ?>
        <tr >
            <td>{{ $n++ }}</td>
            <td>{{ $protocol['number_protocol'] }}/{{ date('d.m.Y', $protocol['date_protocol']) }}</td>
            <td class="">{{ $protocol['inspector_name'].' - '.$protocol['position_short'] }}</td>
            <td class="">{{ $full_name }}</td>
            <td class="middle" >{{ $protocol['location_farm'] }}</td>
            <td class="" >{{ $protocol['ascertainment'] }}</td>
            <td class="middle" >{{ $order_protocol }}</td>
            <td class="middle">{{ $act }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>