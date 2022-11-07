<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th >№ </th>
            <th >ЧЗП/<br/>Фирма </th>
            <th >Име ЗП/Фирма </th>
            <th >Адрес на регистрация </th>
            <th ></th>
            <th >ЕГН/ЕИК</th>
            <th >Стопанство в<br/> община </th>
            <th >Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($farmers as $farmer)
        <?php
            if ($farmer->type_firm == 1) {
                $et = 'ЧЗС';
                $eik = 'ЕГН';
            }  elseif ($farmer->type_firm == 2) {
                $et = 'ET';
                $eik = 'Булс.';
            } elseif ($farmer->type_firm == 3) {
                $et = 'ООД';
                $eik = 'Булс.';
            } elseif ($farmer->type_firm == 4) {
                $et = 'ЕООД';
                $eik = 'Булс.';
            } elseif ($farmer->type_firm == 5) {
                $et = 'АД';
                $eik = 'Булс.';
            } elseif ($farmer->type_firm == 6) {
                $et = 'КООП';
                $eik = 'Булс.';
            } else {
                $et = '';
                $eik = 'Булс.';
            }
            foreach($districts_farm as $key=>$district){
                if($key == $farmer->district_object){
                    $district_farm = $district;
                }
            }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $et !!}</td>
            <td>{{$farmer->name}}</td>
            <td>{{$farmer->location.'; '.$farmer->address }}</td>
            <td>{{ $eik }}</td>
            <td>{{$farmer->pin}}</td>
            <td>{{ $district_farm }}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/стопанин/'.$farmer->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>