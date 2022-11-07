<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th >№ </th>
            <th >ЧЗП/Фирма </th>
            <th >Име ЗП/Фирма </th>
            <th >ЕГН/ЕИК</th>
            <th >Дата на Заверка</th>
            <th >Предписание</th>
            <th >Инспектор</th>
            <th >Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($diaries as $diary)
        <?php
            if ($diary->type_firm == 1) {
                $et = 'ЧЗС';
            }  elseif ($diary->type_firm == 2) {
                $et = 'ET';
            } elseif ($diary->type_firm == 3) {
                $et = 'ООД';
            } elseif ($diary->type_firm == 4) {
                $et = 'ЕООД';
            } elseif ($diary->type_firm == 5) {
                $et = 'АД';
            } elseif ($diary->type_firm == 6) {
                $et = 'КООП';
            } else {
                $et = '';
            }
            if($diary->act == 0 ){
                $act = '';
            }
            if($diary->act == 1 ){
                $act = 'ДА';
            }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $et !!}</td>
            <td>{{ $diary->name }}</td>
            <td class="center">{{ $diary->pin }}</td>
            <td class="center">{{ date('d.m.Y', $diary->date_diary) }}</td>
            <td class="center">{{ $act }}</td>
            <td>{{$diary->inspector_name}}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/стопанин/'.$diary->farmer_id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>