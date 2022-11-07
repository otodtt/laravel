<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>N</th>
        <th>Р / У</th>
        <th>№</th>
        <th>Дата</th>
        <th>Име на Фирмата</th>
        <th>Населено място</th>
        <th>Адрес</th>
        <th>Валидно до</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
        @foreach($pharmacies as $pharmacy)
            <?php
            ////////////////////////
            if ($pharmacy->type_firm == 1) {
                $et = 'ET';
                $ood = '';
            } elseif ($pharmacy->type_firm == 2) {
                $et = '';
                $ood = 'ООД';
            } elseif ($pharmacy->type_firm == 3) {
                $et = '';
                $ood = 'ЕООД';
            } elseif ($pharmacy->type_firm == 4) {
                $et = '';
                $ood = 'АД';
            } else {
                $et = '';
                $ood = '';
            }
            //////////////////////////
            if ($pharmacy->raz_udost == 1) {
                $type_licence = 'Разр';
            }
            if ($pharmacy->raz_udost == 2) {
                $type_licence = 'Удост';
            }
            //////////////////////////////////
            if ($pharmacy->active == 0) {
                $date_now = time();
                if ($date_now > $pharmacy->end_date) {
                    $valid = '<span class="red">Изтекъл срок</span>';
                } else {
                    $valid = date('d.m.Y', $pharmacy->end_date);
                }
            }
            if ($pharmacy->active == 1) {
                $valid = '<span class="red">Прекратен срок</span>';
            }
            /////////////////////////////
            if ($pharmacy->number_licence <= 9 && $pharmacy->raz_udost == 2) {
                $number_view = '00' . $pharmacy->number_licence;
            } elseif ($pharmacy->number_licence <= 99 && $pharmacy->raz_udost == 2) {
                $number_view = '0' . $pharmacy->number_licence;
            } else {
                $number_view = $pharmacy->number_licence;
            }
            ?>
            <tr>
                <td class="right"><?= $n++ ?></td>
                <td class="right">{!! $type_licence !!}</td>
                <td class="center">{!! $number_view !!}</td>
                <td class="right">{!! date('d.m.Y', $pharmacy->date_licence) !!}</td>
                <td>{!! $et !!} "{{$pharmacy->name}}" {!! $ood !!}</td>
                <td class="">{{$pharmacy->location}}</td>
                <td>{{$pharmacy->address}}</td>
                <td class="center">{!! $valid !!}</td>
                <td class="center last-column">
                    <a href="{!!URL::to('/фирма/'.$pharmacy->firm_id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                        &nbsp;Виж!
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>