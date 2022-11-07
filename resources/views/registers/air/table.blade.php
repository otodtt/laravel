<table border="1" class="tableall" id="testTable">
    <thead>
    <tr>
        <th class="nomred">№ по ред</th>
        <th class="vh_nom">Вх. № на Заявлението за издаване на Разрешение за прилагане на ПРЗ чрез въздушно пръскане по чл. 110 от ЗЗР
        </th>
        <th class="nom_sert">№ на Разрешението/ дата</th>
        <th class="br_insp">Наименование на земеделски производител/ юридическото лице или ЕТ</th>
        <th class="ime">Адрес на управление</th>
        <th class="address">ЕИК/ БУЛСТАТ</th>
        <th class="telef">Телефон /GSM</th>
        <th class="mail">е-mail:</th>
        <th class="diplom">Населено място и местност</th>
        <th class="drugdip">Култура/ дка</th>
        <th class="drugdip">Вредител/ ПИВ</th>
        <th class="drugdip">Период на провеждане на пръскането (от......до) / час на третиране (от......до)</th>
        <th class="drugdip">Вид и търговско наименование на ПРЗ</th>
        <th class="drugdip">Доза на дка</th>
        <th class="drugdip">Карантинен срок на ПРЗ</th>
        <th class="drugdip">Име, презиме и фамилия на лицето отговорно за организиране и провеждане на въздушното
            пръскане
        </th>
        <th class="drugdip">№ и дата на Дипломата на лицето дало предписание за извършване на въздушно пръскане</th>
    </tr>

    </thead>
    <tbody>
    <tr>
        <td class="midle">A</td>
        <td class="midle">B</td>
        <td class="midle">C</td>
        <td class="midle">D</td>
        <td class="midle">E</td>
        <td class="midle">F</td>
        <td class="midle">G</td>
        <td class="midle">H</td>
        <td class="midle">I</td>
        <td class="midle">J</td>
        <td class="midle">K</td>
        <td class="midle">L</td>
        <td class="midle">M</td>
        <td class="midle">N</td>
        <td class="midle">O</td>
        <td class="midle">P</td>
        <td class="midle">Q</td>
    </tr>

    <?php
    $n = 1;
    $cz = 0;
    ?>
    @foreach($permits as $permit)
        <?php

        if ($permit->type_firm == 1) {
            $et = 'ЧЗП - ';
            $ood = '';
        }
        elseif ($permit->type_firm == 2) {
            $et = 'ET "';
            $ood = '" ';
        }
        elseif ($permit->type_firm == 3) {
            $et = ' "';
            $ood = '" ООД';
        }
        elseif ($permit->type_firm == 4) {
            $et = ' "';
            $ood = '" ЕООД';
        }
        elseif ($permit->type_firm == 5) {
            $et = ' "';
            $ood = '" АД';
        }
        elseif ($permit->type_firm == 6) {
            $et = '';
            $ood = '';
        }
        elseif ($permit->type_firm == 7) {
            $et = '';
            $ood = '';
        }
        else {
            $et = '';
            $ood = '';
        }

        $name_farmer = mb_convert_case($permit->name, MB_CASE_UPPER, 'UTF-8');
        $all_name = $et . '' . $name_farmer . '' . $ood;

        $limit = 'от' . date('d.m.Y', $permit->start_date) . ' до' . date('d.m.Y', $permit->end_date);

        if ($permit->quarantine == 0) {
            $quarantine = '';
        } else {
            $quarantine = $permit->quarantine;
        }
        ?>
        <tr>
            <td class="txt">{!! $n++ !!}</td>
            <td class="txt">{!! $permit->number_petition !!}/{!! date('d.m.Y', $permit->date_petition) !!}</td>
            <td class="txt">{!! $permit->number_permit !!}/{!! date('d.m.Y', $permit->date_permit) !!}</td>
            <td class="txt">{!! $all_name !!}</td>
            <td class="txt">{!! $permit->address !!}</td>
            <td class="txt">{!! $permit->urn !!}</td>
            <td class="txt">{!! $permit->phone !!}</td>
            <td class="txt">{!! $permit->email !!}</td>
            <td class="txt">{!! $permit->ground !!}</td>
            <td class="txt">{!! $permit->cultivation.' - '.$permit->acres.' дка.' !!}</td>
            <td class="txt">{!! $permit->pest !!}</td>
            <td class="txt">{!! $limit !!}</td>
            <td class="txt">{!! $permit->prz !!}</td>
            <td class="txt">{!! $permit->dose !!}</td>
            <td class="txt">{!! $quarantine !!}</td>
            <td class="txt">{!! $permit->agronomist !!}</td>
            <td class="txt">{!! $permit->certificate !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>