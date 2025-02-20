<table id="phito_traders" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th style="">N</th>
            <th>Име на Фирмата</th>
            <th>Адрес</th>
            <th>Булстат</th>
            <th style="width: 70px">Вписан в регистъра</th>
            <th>Edit</th>
            <th>Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($traders as $trader)
        <tr>
            <td class="center"><?= $n++ ?></td>
            <td>
                {{mb_strtoupper($trader->trader_name), 'UTF-8'}}
            </td>
            <td class="">
                <p>
                    {{$trader->city}}, {{$trader->trader_address}}
                </p>

            </td>
            <td>
                @if($trader->trader_vin != 0)
                    {{$trader->trader_vin}}
                @endif
            </td>
            <td class="center">
                @if($trader->is_add == 0)
                    <p style="color: red "> НЕ </p>
                @else
                    <p style="color: black "> ДА </p>
                @endif

            </td>
            <td class="center last-column">
                <a href="{!!URL::to('/фито/търговец/'.$trader->id.'/edit')!!}" class="fa fa-edit btn btn-primary my_btn"></a>
            </td>
            <td class="center last-column">
                <a href="{!!URL::to('/фито/търговец/покажи/'.$trader->id)!!}" class="fa fa-binoculars btn btn-success my_btn"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>