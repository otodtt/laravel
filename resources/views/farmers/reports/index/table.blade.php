<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th >№ </th>
        <th >№ </th>
        <th >Дата </th>
        <th >Име на ЗС </th>
        <th >ЕГН/ЕИК </th>
        <th >Стопанство в<br/> община </th>
        <th >Издаден за:</th>
        <th >Инспектор </th>
        <th >Вид Пр-ка</th>
        <th >Виж</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($protocols as $protocol)
        <?php
        if ($protocol->type_check == 1) {
            $check = 'документи';
        }
        else{
            $check = 'на терен';
        }
        foreach($districts_farm as $key=>$object){
            if($key == $protocol->district_object){
                $farm_district = $object;
            }
        }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $protocol->number_protocol !!}</td>
            <td class="center">{!! date('d.m.Y', $protocol->date_protocol) !!}</td>
            <td>{{ $protocol->name }}</td>
            <td>{{$protocol->pin}}</td>

            <td>{{ $farm_district }}</td>

            <td>{!! $protocol->description !!}</td>
            <td>{!! $protocol->inspector_name !!}</td>

            <td>{!! $check !!}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/протокол-зс/'.$protocol->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>