<table id="domestic_table" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th>N</th>
            <th>Номер</th>
            <th>Дата на издаване</th>
            <th>Вид</th>
            <th>Фирма</th>
            <th>Фактура</th>
            <th>Сума</th>
            <th>Инспектор</th>
            <th>Завършен</th>
            <th>Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($certificates as $certificate)
            <?php
                if($certificate->is_all == 0) {
                    $all = 'Не завършен';
                    $alert = 'red';
                } else {
                    $all = 'OK';
                    $alert = '';
                }
            ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td>{{$certificate->internal}}</td>
            <td>{{ date('d.m.Y', $certificate->date_issue) }}</td>
            <td class="right">
                @if($certificate->farmer_id >0 && $certificate->type_firm >0 )
                    ЗС
                @elseif($certificate->farmer_id == 0 && $certificate->type_firm == 0)
                    Търговец
                @endif
            </td>
            <td>{{mb_strtoupper($certificate->trader_name), 'utf-8'}}</td>
            <td style="text-align: right; padding-right: 4px">
                @if( $certificate->invoice_id == '0')
                    <a href='/контрол/фактури-износ/{{$certificate->id}}' class="fa fa-plus-circle btn btn-danger my_btn"> Add</a>
                @else
                    {{ $certificate->invoice_number }}/{{ date('d.m.Y' ,$certificate->invoice_date ) }}
                @endif
            </td>
            <td style="text-align: right; padding-right: 4px">{{ $certificate->sum }}</td>
            <td>{{$certificate->inspector_bg}}</td>
            <td><span class="{{$alert}}">{{$all}}</span></td>
            <td>
                @if ($certificate->is_all === 0)
                <a href='/контрол/сертификат-вътрешен/{{$certificate->id}}/завърши' class="fa fa-edit btn btn-danger my_btn"></a>
                @else
                <a href='/контрол/сертификат-вътрешен/{{$certificate->id}}' class="fa fa-binoculars btn btn-primary my_btn"></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="text-align:right">Всичко:</th>
            <th>
                <?php  $total = 0; ?>
                @foreach($certificates as $k=>$certificate)
                    <?php
                        $total += array_sum((array)$certificate->sum);
                    ?>
                @endforeach
                <p style="text-center: left; margin-left: 10px"> {{ number_format($total, 2, ',', ' ') }} лв.</p>
            </th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>