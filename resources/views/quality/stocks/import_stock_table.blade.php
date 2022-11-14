<table id="example_stock" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th>N</th>
            {{-- <th>Дата на издаване</th> --}}
            <th>Серт. Номер/Дата</th>
            <th>Издаден на</th>
            <th>Култура</th>
            <th>Опаковки</th>
            <th>Количество</th>
            <th>Инспектор</th>
            <th>Виж</th>
        </tr>
    </thead>
    <tbody>
        <?php $n = 1; ?>
        @foreach ($stocks as $stock)
            <tr>
                <td class="right"><?= $n++ ?></td>
                <td>
                    {{ $stock->certificate_number }} / {{ date('d.m.Y', $stock->date_issue) }}
                </td>
                <td>
                    <p style="text-transform: uppercase;">{{ $stock->firm_name }}</p>
                </td>
                <td style="text-align: left">
                    <?php
                    if(strlen($stock->variety) > 0) {
                        $variety = '('.$stock->variety.')';
                    }
                    else{
                        $variety = '';
                    }   
                    ?>
                    <span style="font-weight: bold;">{{ $stock->crops_name }}</span> / {{ $stock->crop_en }} {{$variety}}
                </td>
                <td style="text-align: left;">
                    <?php
                    if ($stock->type_pack == 1) {
                        $type = 'Каси';
                    } elseif ($stock->type_pack == 2) {
                        $type = 'Палети';
                    } elseif ($stock->type_pack == 3) {
                        $type = 'Кашони';
                    } elseif ($stock->type_pack == 4) {
                        $type = 'Торби';
                    } elseif ($stock->type_pack == 999) {
                        $type = $stock->different;
                    } else {
                        $type = '';
                    }
                    ?>
                    {{ $type }} 
                    <span style="float: right; margin-right: 10px">- {{ $stock->number_packages }}</span>
                </td>
                <td style="text-align: right; padding-right: 4px">{{ $stock->weight}}</td>
                 {{--<td style="text-align: right; padding-right: 4px">{{ number_format($stock->weight, 0, ',', ' ') }}</td>--}}
                <td>{{ $stock->inspector_name }}</td>
                <td>
                    <a href='/контрол/сертификат-внос/{{ $stock->certificate_id }}'class="fa fa-binoculars btn btn-primary my_btn"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5" style="text-align: right">
                Всичко:
            </th>
            <th >
                <?php  $total = 0; ?>
                @foreach($stocks as $k=>$stock)
                    <?php
                        //$total += array_sum((array)$stock['weight']);
                        $total += array_sum((array)$stock->weight);
                    ?>
                @endforeach
                <p style="text-center: left; margin-left: 10px"> {{ number_format($total, 0, ',', ' ') }} kg.</p>
            </th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
