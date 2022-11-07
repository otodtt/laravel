<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>№</th>
        <th>№</th>
        <th>Дата</th>
        <th>Обект</th>
        <th>Обект в<br/> Град/Село</th>
        <th>Адрес на Проверен Обект</th>
        <th>Име на<br/> Фирма/Ф. Лице</th>
        <th>Инспектор</th>
        <th>Нарушение</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
        @foreach($protocols as $protocol)
            <?php
            ////////////////////////
            if ($protocol->firm == 1) {
                $et = '';
                $ood = '';
            }
            elseif ($protocol->firm == 2) {
                $et = 'ET';
                $ood = '';
            }
            elseif ($protocol->firm == 3) {
                $et = '';
                $ood = 'ООД';
            }
            elseif ($protocol->firm == 4) {
                $et = '';
                $ood = 'ЕООД';
            }
            elseif ($protocol->firm == 5) {
                $et = '';
                $ood = 'АД';
            }
            else {
                $et = '';
                $ood = '';
            }
            ///////////////
            if($protocol->violation == 0){
                $violation = '';
            }
            if($protocol->violation == 1){
                $violation = 'Да';
            }
            ///////////////
            if($protocol->ot == 1){
                $object = 'Аптека';
            }
            elseif($protocol->ot == 2){
                $object = 'Склад';
            }
            elseif($protocol->ot == 3){
                $object = 'Цех';
            }
            else{
                $object = '';
            }
            ?>
            <tr>
                <td class="right"><?= $n++ ?></td>
                <td class="right">{!! $protocol->number !!}</td>
                <td class="">{!! date('d.m.Y', $protocol->date_protocol) !!}</td>
                <td class="center">{!! $object !!}</td>
                <td class="">{{$protocol->location_object}}</td>
                <td class="">{{$protocol->address_object}}</td>
                <td>{!! $et !!} {{$protocol->name}} {!! $ood !!}</td>
                <td>{{$protocol->inspector_name}}</td>

                <td class="center">{!! $violation !!}</td>
                <td class="center last-column">
                    <a href="{!!URL::to('/друг-обект-протокол/'.$protocol->id )!!}" class="fa fa-binoculars btn btn-primary my_btn">
                        &nbsp;Виж!
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>