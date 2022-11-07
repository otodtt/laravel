<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th>N</th>
            <th></th>
            <th>Име на Фирмата</th>
            <th>П. код</th>
            <th>Регистрирана в</th>
            <th>Булстат</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($firms as $firm)
        <?php
        if ($firm->type_firm == 1) {
            $et = 'ET';
        } elseif ($firm->type_firm == 2) {
            $et = 'ООД';
        } elseif ($firm->type_firm == 3) {
            $et = 'ЕООД';
        } elseif ($firm->type_firm == 4) {
            $et = 'АД';
        } else {
            $et = '';
        }
        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="right"><?php echo $et; ?></td>
            <td>{{$firm->name}}</td>
            <td class="center">{{$firm->postal_code}}</td>
            <td>{{$firm->location}}</td>
            <td class="center">{{$firm->bulstat}}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/фирма/'.$firm->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>