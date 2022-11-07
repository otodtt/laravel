<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>N</th>
        <th>Номер</th>
        <th>Дата</th>
        <th>Име на Фирмата/ЧЗП</th>
        <th>Регистриран/а в</th>
        <th>ЕИК/ЕГН</th>
        <th>От .... - До ....</th>
        <th>Инспектор</th>
        <th>Виж</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($permits as $permit)
        <?php
        if ($permit->number_permit <= 9) {
            $number = '00' . $permit->number_permit;
        }
        elseif ($permit->number_permit <= 99) {
            $number = '0' . $permit->number_permit;
        }
        else {
            $number = $permit->number_permit;
        }
        ///// Вид на Фирмата
        if ($permit->type_firm == 1) {
            $et = '';
            $ood = '';
        }
        elseif ($permit->type_firm == 2) {
            $et = 'ЕТ "';
            $ood = '"';
        }
        elseif ($permit->type_firm == 3) {
            $et = '"';
            $ood = '" ООД';
        }
        elseif ($permit->type_firm == 4) {
            $et = '"';
            $ood = '" ЕООД';
        }
        elseif ($permit->type_firm == 5) {
            $et = '"';
            $ood = '" АД';
        }
        else {
            $et = '';
            $ood = '';
        }
        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="right">{!! $number !!}</td>
            <td class="center">{{date('d.m.Y', $permit->date_permit)}}</td>
            <td>{{$et.''.$permit->name.''.$ood}}</td>
            <td class="">{{ $permit->location }}</td>
            <td class="">{{$permit->urn}}</td>
            <td class="center">{{date('d.m.Y', $permit->start_date)}} - {{date('d.m.Y', $permit->end_date)}}</td>
            <td class="center">{{$permit->inspector_name}}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/въздушни/'.$permit->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>