<table id="report_example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
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
        <th>Несъответствие</th>
        <th>С К. Протокол</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
        @foreach($reports as $report)
            <?php
            ////////////////////////
            if ($report->firm == 1) {
                $et = 'ET';
                $ood = '';
            } elseif ($report->firm == 2) {
                $et = '';
                $ood = 'ООД';
            } elseif ($report->firm == 3) {
                $et = '';
                $ood = 'ЕООД';
            } elseif ($report->firm == 4) {
                $et = '';
                $ood = 'АД';
            } else {
                $et = '';
                $ood = '';
            }
            ///////////////
            if($report->ot == 1){
                $type_object = 'Аптека';
            }
            if($report->ot == 2){
                $type_object = 'Склад';
            }
            if($report->ot == 3){
                $type_object = 'Цех';
            }

            ///////////////
            if($report->violation == 0){
                $violation = '';
            }
            if($report->violation == 1){
                $violation = 'Да';
            }
            ///////////////
            if($report->assay_prz == 0){
                $assay_prz = '';
            }
            if($report->assay_prz > 0){
                $assay_prz = 'От ПРЗ';
            }
            if($report->assay_tor == 0){
                $assay_tor = '';
            }
            if($report->assay_tor > 0){
                $assay_tor = 'От тор';
            }
            ?>
            <tr>
                <td class="right"><?= $n++ ?></td>
                <td class="right">{!! $report->number !!}</td>
                <td class="">{!! date('d.m.Y', $report->date_report) !!}</td>
                <td class="">{{$type_object}}</td>
                <td>{!! $et !!} "{{$report->name}}" {!! $ood !!}</td>
                <td class="">{{$report->place}}</td>
                <td>{{$report->inspector_name}}</td>
                <td class="center">{!! $assay_prz !!}</td>
                <td class="center">{!! $assay_tor !!}</td>
                <td class="center">
                    @if($report->violation == 1)
                        ДА
                    @endif
                </td>
                <td class="center">
                    @if($report->protocol == 1 && $report->is_protocol == 0)
                        <span class="red bold">Не е добавен</span>
                    @else
                        @if($report->protocol_number != 0)
                            {{$report->protocol_number}}/{!! date('d.m.Y', $report->protocol_date) !!}
                        @endif
                    @endif
                </td>
                <td class="center last-column">
                    <a href="{!!URL::to('/доклад-аптека/'.$report->id )!!}" class="fa fa-binoculars btn btn-primary my_btn">
                        &nbsp;Виж!
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>