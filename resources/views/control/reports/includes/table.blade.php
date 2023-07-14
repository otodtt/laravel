<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>№</th>
        <th>№</th>
        <th>Дата</th>
        <th>Обект</th>
        <th>Име на Фирмата</th>
        <th>Град/Село</th>
        <th>Инспектор</th>
        <th>Проба ПРЗ</th>
        <th>Проба ТОР</th>
        <th>С К. Протокол</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
        @foreach($protocols as $protocol)
            <?php
            ////////////////////////
            if ($protocol->firm == 1) {
                $et = 'ET';
                $ood = '';
            } elseif ($protocol->firm == 2) {
                $et = '';
                $ood = 'ООД';
            } elseif ($protocol->firm == 3) {
                $et = '';
                $ood = 'ЕООД';
            } elseif ($protocol->firm == 4) {
                $et = '';
                $ood = 'АД';
            } else {
                $et = '';
                $ood = '';
            }
            ///////////////
            if($protocol->ot == 1){
                $type_object = 'Аптека';
            }
            if($protocol->ot == 2){
                $type_object = 'Склад';
            }
            if($protocol->ot == 3){
                $type_object = 'Цех';
            }

            ///////////////
            if($protocol->violation == 0){
                $violation = '';
            }
            if($protocol->violation == 1){
                $violation = 'Да';
            }
            ///////////////
            if($protocol->assay_prz == 0){
                $assay_prz = '';
            }
            if($protocol->assay_prz > 0){
                $assay_prz = 'От ПРЗ';
            }
            if($protocol->assay_tor == 0){
                $assay_tor = '';
            }
            if($protocol->assay_tor > 0){
                $assay_tor = 'От тор';
            }
            ?>
            <tr>
                <td class="right"><?= $n++ ?></td>
                <td class="right">{!! $protocol->number !!}</td>
                <td class="">{!! date('d.m.Y', $protocol->date_protocol) !!}</td>
                <td class="">{{$type_object}}</td>
                <td>{!! $et !!} "{{$protocol->name}}" {!! $ood !!}</td>
                <td class="">{{$protocol->place}}</td>
                <td>{{$protocol->inspector_name}}</td>
                <td class="center">{!! $assay_prz !!}</td>
                <td class="center">{!! $assay_tor !!}</td>
                <td class="center">{!! $violation !!}</td>
                <td class="center last-column">
                    <a href="{!!URL::to('/доклад/'.$protocol->id )!!}" class="fa fa-binoculars btn btn-primary my_btn">
                        &nbsp;Виж!
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>