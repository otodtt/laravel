<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px" style="margin-top: 50px">
    <thead>
        <tr>
            <th>N</th>
            <th>Edit</th>
            <th>Име на Фирмата</th>
            <th>Адрес</th>
            <th>ЕИК</th>
            <th>Виж</th>
            <th>Добави Сертификат</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($traders as $trader)
        <tr>
            <td class="center"><?= $n++ ?></td>
            <td class="center last-column">
                <a href="{!!URL::to('/контрол/търговци/'.$trader->id.'/edit')!!}" class="fa fa-edit btn btn-primary my_btn"></a>
            </td>
            <td>
                {{mb_strtoupper($trader->trader_name), 'UTF-8'}}
            </td>
            <td class="">
                {{$trader->trader_address}}
            </td>
            <td class="">
                {{$trader->trader_vin}}
            </td>
            <td class="center last-column">
                <a href="{!!URL::to('/контрол/търговци/'.$trader->id.'/show')!!}" class="fa fa-binoculars btn btn-info my_btn"></a>
            </td>
            <td class="center last-column">
                <a href="{!!URL::to('/контрол/сертификати-вътрешен/търговец/добави/'.$trader->id)!!}" class="fa fa-plus-circle btn btn-success my_btn"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>