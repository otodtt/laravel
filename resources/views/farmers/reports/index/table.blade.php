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
        <th >Вид Пр-ка</th>
        <th >Инспектор </th>
        <th >Виж</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($reports as $report)
        <?php
        if ($report->where_check == 1) {
            $check = 'в ОДБХ';
        }
        else{
            $check = 'на терен';
        }
        foreach($districts_farm as $key=>$object){
            if($key == $report->district_object){
                $farm_district = $object;
            }
        }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $report->number_report !!}</td>
            <td class="center">{!! date('d.m.Y', $report->date_report) !!}</td>
            <td>{{ $report->name }}</td>
            <td>{{$report->pin}}</td>

            <td>{{ $farm_district }}</td>

            <td>{!! $report->description !!}</td>
            <td>{!! $check !!}</td>

            <td>{!! $report->inspector_name !!} </td>
            <td class="center last-column">

                @if($report->is_all != 11)
                    <a href="{!!URL::to('/доклад-добави/'.$report->farmer_id.'/'.$report->id.'/'.$report->is_all)!!}" class="fa fa-edit btn btn-danger my_btn">
                        Продължи!
                    </a>
                @else
                    <a href="{!!URL::to('/доклад-зс/'.$report->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                        &nbsp;Виж!
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>