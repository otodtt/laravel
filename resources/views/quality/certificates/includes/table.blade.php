<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th>N</th>
            <th>Номер</th>
            <th>Дата на издаване</th>
            <th>Фирма</th>
            <th>Фактура</th>
            <th>Сума</th>
            <th>Инспектор</th>
            <th>Завършен</th>
            <th>Виж</th>
            @if(Auth::user()->admin == 2 || Auth::user()->id == 2 )
            <th>База</th>
            <th>%</th>
            <th>Сума</th>
            <th></th>
            @endif
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
            <td>{{$certificate->import}}</td>
            <td>{{ date('d.m.Y', $certificate->date_issue) }}</td>
            <td>{{strtoupper($certificate->importer_name)}}</td>
            <td style="text-align: right; padding-right: 4px">
                @if( $certificate->invoice_id == '0')
                    <a href='/контрол/фактури-внос/{{$certificate->id}}' class="fa fa-plus-circle btn btn-danger my_btn"> Add</a>
                @else
                    {{ $certificate->invoice_number }}/{{ date('d.m.Y' ,$certificate->invoice_date ) }}
                @endif
            </td>
            <td style="text-align: right; padding-right: 4px">{{ $certificate->sum }}</td>
            <td>{{$certificate->inspector_bg}}</td>
            <td><span class="{{$alert}}">{{$all}}</span></td>
            <td>
                @if ($certificate->is_all === 0)
                <a href='/контрол/сертификат-внос/{{$certificate->id}}/завърши' class="fa fa-edit btn btn-danger my_btn"></a>
                @else
                <a href='/контрол/сертификат-внос/{{$certificate->id}}' class="fa fa-binoculars btn btn-primary my_btn"></a>
                @endif
            </td>
            @if(Auth::user()->admin == 2 || Auth::user()->id == 2 )
            <?php 
            if($certificate->percent == 0) {
                $percent = '0%';
            }
            elseif ($certificate->percent == 1) {
                $percent = '42%';
            }
            elseif ($certificate->percent == 2) {
                $percent = '84%';
            }
            else {
                $percent = 'ER';
            }
            ?>
            <td>{{$certificate->base_sum}}</td>
            <td>{{$percent}}</td>
            <td>{{$certificate->sum}}</td>
            <td>
                <a href='/myedit/certificate-import/{{$certificate->id}}' class="fa fa-edit btn btn-danger my_btn"></a>
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5" style="text-align:right">Всичко:</th>
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
            @if(Auth::user()->admin == 2 || Auth::user()->id == 2 )
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            @endif
        </tr>
    </tfoot>
</table>