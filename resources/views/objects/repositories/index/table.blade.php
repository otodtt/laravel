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
    @if(isset($repositories))
        @foreach($repositories as $store)
            <?php
            ////////////////////////
            if ($store->type_firm == 1) {
                $et = 'ET';
                $ood = '';
            } elseif ($store->type_firm == 2) {
                $et = '';
                $ood = 'ООД';
            } elseif ($store->type_firm == 3) {
                $et = '';
                $ood = 'ЕООД';
            } elseif ($store->type_firm == 4) {
                $et = '';
                $ood = 'АД';
            } else {
                $et = '';
                $ood = '';
            }
            //////////////////////////
            if ($store->raz_udost == 1) {
                $type_licence = 'Разр';
            }
            if ($store->raz_udost == 2) {
                $type_licence = 'Удост';
            }
            //////////////////////////////////
            if ($store->active == 0) {
                $date_now = time();
                if ($date_now > $store->end_date) {
                    $valid = '<span class="red">Изтекъл срок</span>';
                } else {
                    $valid = date('d.m.Y', $store->end_date);
                }
            }
            if ($store->active == 1) {
                $valid = '<span class="red">Прекратен срок</span>';
            }
            /////////////////////////////
            if ($store->number_licence <= 9 && $store->raz_udost == 2) {
                $number_view = '00' . $store->number_licence;
            } elseif ($store->number_licence <= 99 && $store->raz_udost == 2) {
                $number_view = '0' . $store->number_licence;
            } else {
                $number_view = $store->number_licence;
            }
            ?>

            <tr>
                <td class="right"><?= $n++ ?></td>
                <td class="right">{!! $type_licence !!}</td>
                <td class="center">{!! $number_view !!}</td>
                <td class="right">{!! date('d.m.Y', $store->date_licence) !!}</td>
                <td>{!! $et !!} "{{$store->name}}" {!! $ood !!}</td>
                <td class="">{{$store->location}}</td>
                <td>{{$store->address}}</td>
                <td class="center">{!! $valid !!}</td>
                <td class="center last-column">
                    <a href="{!!URL::to('/фирма/'.$store->firm_id)!!}" class="fa fa-binoculars btn btn-primary my_btn">&nbsp;Виж!</a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>