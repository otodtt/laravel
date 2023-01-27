<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>N</th>
        <th>Номер/дата на Фактурата</th>
        <th>Идентификатор</th>
        <th>Стойност</th>
        <th>Издадена на</th>
        <th>Издадена за</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($invoices as $invoice)
        <tr>
            <td class="center"><?= $n++ ?></td>
            <td>
                {{$invoice->number_invoice}}/{{ date('d.m.Y', $invoice->date_invoice)  }}

                <a href="{!!URL::to('/контрол/фактура/'.$invoice->number_invoice.'/'.$invoice->date_invoice )!!}" class="fa fa-search-plus btn btn-default my_btn" style="float: right"></a>

            </td>
            <td>
                {{substr($invoice->identifier, 2)}}
            </td>
            <td class="right">
                {{number_format($invoice->sum, 2, ',', ' ')}}
            </td>
            <td>
                <span style="text-transform: uppercase;">{{$invoice->importer_name}}</span>
                @if($invoice->importer_id != 0 && $invoice->farmer_id == 0 && $invoice->trader_id == 0)
                    @if($invoice->importer_id != 0 && $invoice->invoice_for == 1)
                        <a href="{!!URL::to('/контрол/вносители/'.$invoice->importer_id.'/show')!!}" class="fa fa-binoculars btn btn-default my_btn" style="float: right"></a>
                    @elseif($invoice->importer_id != 0 && $invoice->invoice_for == 2)
                        <a href="{!!URL::to('/контрол/вносители/'.$invoice->importer_id.'/show')!!}" class="fa fa-binoculars btn btn-warning my_btn" style="float: right"></a>
                    @endif

                @elseif($invoice->importer_id == 0 && $invoice->farmer_id != 0 && $invoice->trader_id == 0)
                    <a href="{!!URL::to('/стопанин/'.$invoice->farmer_id)!!}" class="fa fa-binoculars btn btn-success my_btn" style="float: right"></a>
                @elseif($invoice->importer_id == 0 && $invoice->farmer_id == 0 && $invoice->trader_id != 0)
                    <a href="{!!URL::to('/контрол/търговци/'.$invoice->trader_id.'/show')!!}" class="fa fa-binoculars btn btn-info my_btn" style="float: right"></a>
                @endif

            </td>
            <td>
                @if($invoice->invoice_for == 1)
                    <span>внос - </span>
                @elseif($invoice->invoice_for == 2)
                    <span>износ - </span>
                @elseif($invoice->invoice_for == 3)
                    <span>вътрешен - </span>
                @endif
                {{$invoice->certificate_number}}
                @if($invoice->invoice_for == 1)
                        <a href="{!!URL::to('/контрол/сертификат-внос/'.$invoice->certificate_id )!!}" class="fa fa-search-plus btn btn-default my_btn" style="float: right"></a>
                @elseif($invoice->invoice_for == 2)
                        <a href="{!!URL::to('/контрол/сертификат-износ/'.$invoice->certificate_id )!!}" class="fa fa-search-plus btn btn-default my_btn" style="float: right"></a>
                @elseif($invoice->invoice_for == 3)
                        <a href="{!!URL::to('/контрол/сертификати-вътрешен/'.$invoice->certificate_id )!!}" class="fa fa-search-plus btn btn-default my_btn" style="float: right"></a>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3" style="text-align:right">Всичко:</th>
        <th>
            <?php  $total = 0; ?>
            @foreach($invoices as $k=>$invoice)
                <?php
                $total += array_sum((array)$invoice->sum);
                ?>
            @endforeach
            <p style="text-center: left; margin-left: 10px"> {{ number_format($total, 2, ',', ' ') }} лв.</p>
        </th>
        <th></th>
        <th></th>
    </tr>
    </tfoot>
</table>