<table id="protocols_table" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th>N</th>
            <th>Номер</th>
            <th>Дата </th>
            <th></th>
            <th>Издаден на</th>
            <th>ЕГН/ЕИК</th>
            <th>Вид на стоката</th>
            <th>Място на издаване</th>
            <th>Инспектор</th>
            <th>Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($protocols as $protocol)

        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="right">{{$protocol->number_protocol}}</td>
            <td>{{ date('d.m.Y', $protocol->date_protocol) }}</td>
            <td class="right">
                @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                    <span>ЗП</span>
                @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                    <span>Търговец</span>
                @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                    <span>Нерег.</span>
                @endif
            </td>
            <td>
                @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                    {{mb_strtoupper($protocol->farmer_name, 'utf-8')}}
                @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                    {{mb_strtoupper($protocol->trader_name, 'utf-8')}}
                @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                    {{mb_strtoupper($protocol->unregulated_name, 'utf-8')}}
                @endif
            </td>
            <td style="text-align: right; padding-right: 4px">
                @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                    {{mb_strtoupper($protocol->farmer_vin, 'utf-8')}}
                @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                    {{mb_strtoupper($protocol->trader_vin, 'utf-8')}}
                @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0  && $protocol->unregulated_id > 0)
                    {{mb_strtoupper($protocol->unregulated_vin, 'utf-8')}}
                @endif
            </td>
            <td style="text-align: right; padding-right: 4px">{{ $protocol->crops_name }}</td>
            <td><span class="">{{ $protocol->place }}</span></td>
            <td>{{$protocol->inspector_name}}</td>
            <td>
                <a href='/контрол/протоколи/{{$protocol->id}}/show' class="fa fa-binoculars btn btn-info my_btn"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>