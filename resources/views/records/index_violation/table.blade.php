<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th >№ </th>
        <th >№ </th>
        <th >Дата </th>
        <th >Име на ЗС </th>
        <th >ЕГН/ЕИК </th>
        <th >Инспектор </th>
        <th >С нарушение </th>
        <th >С предписание</th>
        <th >Акт</th>
        <th >Виж</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($protocols as $protocol)
        <?php
        if ($protocol->violation == 0) {
            $violation = '';
        }
        else{
            $violation = 'ДА';
        }
        if ($protocol->act == 0) {
            $act = '';
        }
        else{
            $act = 'ДА';
        }
        if (strlen($protocol->order_protocol) == 0) {
            $order = '';
        }
        else{
            $order = 'ДА';
        }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $protocol->number_protocol !!}</td>
            <td class="center">{!! date('d.m.Y', $protocol->date_protocol) !!}</td>
            <td >{{ $protocol->name }}</td>
            <td class="center">{{$protocol->pin}}</td>
            <td class="center">{!! $protocol->inspector_name !!}</td>

            <td class="center">{{ $violation }}</td>
            <td class="center">{!! $order !!}</td>
            <td class="center">{!! $act !!}</td>

            <td class="center last-column">
                <a href="{!!URL::to('/протокол-зс/'.$protocol->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>