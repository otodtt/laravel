<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th >№ </th>
        <th >№ </th>
        <th >Дата </th>
        <th >Име на ЗС </th>
        <th >ЕГН/ЕИК </th>
        <th >Инспектор</th>
        <th >Остатъци<br/> от ПРЗ</th>
        <th >Идентификация<br/> на ПРЗ</th>
        <th >Нитрати</th>
        <th >Тежки метали</th>
        <th >Замърсители</th>
        <th >Друго</th>
        <th >Виж</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($protocols as $protocol)
        <?php
        $assay_more = '';
        $assay_prz = '';
        $assay_tor = '';
        $assay_metal = '';
        $assay_micro = '';
        $assay_other = '';
        if ($protocol->assay_more == 1) {
            $assay_more = 'ДА';
        }
        if ($protocol->assay_prz == 1) {
            $assay_prz = 'ДА';
        }
        if ($protocol->assay_tor == 1) {
            $assay_tor = 'ДА';
        }
        if ($protocol->assay_metal == 1) {
            $assay_metal = 'ДА';
        }
        if ($protocol->assay_micro == 1) {
            $assay_micro = 'ДА';
        }
        if ($protocol->assay_other == 1) {
            $assay_other = 'ДА';
        }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $protocol->number_protocol !!}</td>
            <td class="center">{!! date('d.m.Y', $protocol->date_protocol) !!}</td>
            <td >{{ $protocol->name }}</td>
            <td class="center">{{$protocol->pin}}</td>
            <td class="center">{!! $protocol->inspector_name !!}</td>

            <td class="center">{{ $assay_more }}</td>
            <td class="center">{{ $assay_prz }}</td>
            <td class="center">{{ $assay_tor }}</td>
            <td class="center">{{ $assay_metal }}</td>
            <td class="center">{{ $assay_micro }}</td>
            <td class="center">{{ $assay_other }}</td>

            <td class="center last-column">
                <a href="{!!URL::to('/протокол-зс/'.$protocol->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>