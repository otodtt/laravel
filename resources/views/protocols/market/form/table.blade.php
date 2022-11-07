<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>№</th>
        <th>№</th>
        <th>Дата</th>
        <th>Обект</th>
        <th>В град/село</th>
        <th>Адрес</th>
        <th>Издаден от:</th>
        <th>Проба ПРЗ</th>
        <th>Проба ТОР</th>
        <th>Нарушение</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($protocols as $protocol)
        <?php
        if ($protocol->ot == 1) {
            $type = 'Аптека';
        } elseif ($protocol->ot == 2) {
            $type = 'Склад';
        } elseif ($protocol->ot == 3) {
            $type = 'Цех';
        }

        if($protocol->assay_prz == 0 ){
            $assay_prz = '';
        }
        if($protocol->assay_prz > 0 ){
            $assay_prz = 'От ПРЗ';
        }
        if($protocol->assay_tor == 0){
            $assay_tor = '';
        }
        if($protocol->assay_tor > 0){
            $assay_tor = 'От тор';
        }

        if ($protocol->violation == 1) {
            $violation = 'ДА';
        } else {
            $violation = '';
        }

        ?>

        <tr>
            <td class="right">{{ $n++ }}</td>
            <td class="right">{{$protocol->number}}</td>
            <td>{{ date('d.m.Y', $protocol->date_protocol) }}</td>
            <td class="center">{{ $type }}</td>
            <td>{{ $protocol->place }}</td>
            <td>{{ $protocol->address }}</td>
            <td class="center">{{ $protocol->inspector_name }}</td>
            <td class="center">{{ $assay_prz }}</td>
            <td class="center">{{ $assay_tor }}</td>
            <td class="center">{{ $violation }}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/протокол/'.$protocol->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>