<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th >№ </th>
            <th >№ </th>
            <th >Дата </th>
            <th >Мярка </th>
            <th >Бенифициент </th>
            <th >ЕГН/ЕИК </th>
            <th >Стопанство в<br/> гр./с. </th>
            <th >Инспектор </th>
            <th >№ КП </th>
            <th >Дата КП </th>
            <th >Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($opinions as $opinion)
        <?php
            if ($opinion->double_protocol >= 4) {
                $number = '-';
                $date = 'Без КП';
                $class = 'center';
            }
            else{
                $number = $opinion->number_protocol;
                $date = date('d.m.Y', $opinion->date_protocol);
                $class = 'right';
            }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $opinion->number_opinion !!}</td>
            <td class="center">{!! date('d.m.Y', $opinion->date_opinion) !!}</td>
            <td>{{$opinion->opinion}}</td>
            <td>{{ $opinion->name }}</td>
            <td>{{$opinion->pin}}</td>
            <td>{{ $opinion->location }}</td>
            <td>{!! $opinion->inspector_name !!}</td>
            <td class="{!! $class !!}">{!! $number !!}</td>
            <td>{!! $date !!}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/становище-старо/'.$opinion->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>