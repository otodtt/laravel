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
            </td>
            <td>
                {{substr($invoice->identifier, 2)}}
            </td>
            <td class="right">
                {{$invoice->sum}}
            </td>
            <td>
                <span style="text-transform: uppercase;">{{$invoice->importer_name}}</span>
                <a href="{!!URL::to('/контрол/вносители/'.$invoice->importer_id.'/show')!!}" class="fa fa-binoculars btn btn-default my_btn" style="float: right"></a>
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
                    <span>вътрешен - </span>
                @endif

            </td>
            {{--<td class="center last-column">--}}
                {{--<a href="{!!URL::to('/контрол/вносители/'.$invoice->id.'/edit')!!}" class="fa fa-edit btn btn-primary my_btn"></a>--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3" style="text-align:right">Всичко:</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </tfoot>
</table>