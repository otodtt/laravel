<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th rowspan="2">N</th>
        <th rowspan="2">Вх.№ на заявление за <br/>първоначална регистрация <br/>/актуализация /промяна във вписаните  обстоятелства</th>
        <th rowspan="2">Номер и дата на <br/>удостоверението за <br/>регистрация Официален регистрационен номер</th>
        <th colspan="3">Име и адрес на <br/>професионалният оператор Данни за връзка </th>
        <th rowspan="2">Дейност/и по чл. 65(1) </th>
        <th colspan="3">Растения, растителни <br/>продукти и други обекти</th>
        {{--<th>произход</th>--}}
        {{--<th>предназначение</th>--}}
        <th rowspan="2">Адрес на помещенията, <br/>разположение на поземлените парцели</th>
        <th rowspan="2">Дейност/и по чл. 66(2)</th>
        <th rowspan="2">Дата на <br/>заличаване на регистрацията/ <br/>Причина</th>
        <th rowspan="2">Виж</th>
    </tr>
    <tr>
        <th></th>
        <th>Име</th>
        <th>Адрес</th>

        <th>естество</th>
        <th>произход</th>
        <th>предназначение</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($operators as $operator)
        <?php
        if ($operator->type_firm == 1) {
            $et = 'ЗС';
            $eik = 'ЕГН';
        }  elseif ($operator->type_firm == 2) {
            $et = 'ET';
            $eik = 'Булс.';
        } elseif ($operator->type_firm == 3) {
            $et = 'ООД';
            $eik = 'Булс.';
        } elseif ($operator->type_firm == 4) {
            $et = 'ЕООД';
            $eik = 'Булс.';
        } elseif ($operator->type_firm == 5) {
            $et = 'АД';
            $eik = 'Булс.';
        } elseif ($operator->type_firm == 6) {
            $et = 'КООП';
            $eik = 'Булс.';
        } else {
            $et = '';
            $eik = 'Булс.';
        }
        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="left">{!! $operator->number_petition !!} / {{date('d.m.Y', $operator->date_petition)}}</td>
            <td class="">{{date('d.m.Y', $operator->date_petition)}}</td>
{{--            <td>{{$operator->name_operator}}</td>--}}

            <td class="right">{{$et}}</td>
            <td class="">{{ $operator->name_operator }}</td>
            <td class="">{{$operator->address}}</td>

            <td class="">{{$operator->activity}}</td>
            <td class="">{{ $operator->products }}</td>
            <td class="">{{$operator->derivation}}</td>
            <td class="">{{$operator->purpose}}</td>
            <td class="">{{$operator->room}}</td>
            <td class="">{{$operator->action}}</td>
            <td class="center">{{$operator->deletion}}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/фито/оператор/'.$operator->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>