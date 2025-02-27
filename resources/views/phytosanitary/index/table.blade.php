<table id="operators" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th rowspan="2">N</th>
        <th rowspan="2">Вх.№ на заявление за <br/>първоначална регистрация </th>
        <th rowspan="2">промяна вписана</th>
        <th rowspan="2">Номер и дата на <br/>удостоверението за <br/>регистрация Официален регистрационен номер</th>
        <th colspan="2">Име и адрес на <br/>професионалният оператор Данни за връзка </th>
        <th rowspan="2">Дейност/и по чл. 65(1) </th>
        <th colspan="3">Растения, растителни <br/>продукти и други обекти</th>
        {{--<th>произход</th>--}}
        {{--<th>предназначение</th>--}}
        <th rowspan="2">Адрес на помещенията, <br/>разположение на поземлените парцели</th>
        <th rowspan="2">Дейност/и по чл. 66(2)</th>
        <th rowspan="2">Дата на <br/>заличаване на регистрацията/ <br/>Причина</th>
        <th rowspan="2">Виж</th>
        {{--<th rowspan="2">EDIT</th>--}}
    </tr>
    <tr>
        <th></th>
        <th>Име</th>

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
                    $et = 'Тър.';
                    $eik = 'Булс.';
                }
                if($operator->farmer_id == 0 && $operator->trader_id == 0 ){
                    $et = '';
                }
                if($operator->id >= 1 && $operator->id <= 9){
                    $nulls = '000';
                }
                elseif($operator->id >= 10 && $operator->id <= 99){
                    $nulls = '00';
                }
                elseif($operator->id >= 100 ){
                    $nulls = '0';
                }
                else {
                    $nulls = '';
                }
        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="left">
                @if($operator->number_petition == 0 && $operator->is_completed == 0)
                    @if($operator->number_petition == 0 && $operator->registration_date == 0 )
                        <span style="color: #ff0000; font-weight: bold">-</span>
                    @else
                        <span style="color: #ff0000; font-weight: bold">Не е завършено</span>
                    @endif
                @else
                    {!! $operator->number_petition !!} / {{date('d.m.Y', $operator->date_petition)}}
                @endif
            </td>
            <td>
                @if($operator->update_date != 0)
                    {{date('d.m.Y', $operator->update_date)}}
                @else

                @endif
            </td>
            <td class="">
                @if($operator->registration_number == 0 && $operator->is_completed == 0)
                    <span style="color: #ff0000; font-weight: bold">Не е добавен</span>
                @else
                    @if($operator->registration_date == 0)
                        {{$operator_index[0]['operator_index_bg']}}-{{$nulls.$operator->registration_number }}
                        {{--/{{date('d.m.Y', $operator->registration_date)}}--}}
                    @else
                        {{$operator_index[0]['operator_index_bg']}}-{{$nulls.$operator->registration_number }}
                        /{{date('d.m.Y', $operator->registration_date)}}
                    @endif
                @endif
            </td>
            <td class="right">{{$et}}</td>
            <td class="">{{ $operator->name_operator }}</td>
            {{--<td class="">{{$operator->address}}</td>--}}

            <td class="">{{$operator->activity}}</td>
            <td class="">{{ $operator->products }}</td>
            <td class="">{{$operator->derivation}}</td>
            <td class="">{{$operator->purpose}}</td>
            <td class="">{{$operator->room}}</td>
            <td class="">{{$operator->action}}</td>
            <td class="center">
                @if($operator->deletion != 0)
                    <p>{{$operator->deletion}}/{{date('d.m.Y', $operator->deletion_date)}}</p>
                @endif
            </td>
            <td class="center last-column">
                @if($operator->number_petition == 0 && $operator->is_completed == 0)
                    @if($operator->number_petition == 0 && $operator->registration_date == 0 )
                        <span style="color: #ff0000; font-weight: bold">-</span>
                    @else
                        <a href="{!!URL::to('/фито/таблица/table_farmer/'.$operator->farmer_id).'/'.$operator->id !!}" class="fa fa-edit btn btn-danger my_btn">
                            &nbsp;ЗА ТАБЛИЦА!
                        </a>
                        <hr>
                        <a href="{!!URL::to('/фито/оператор/земеделец/завърши/'.$operator->id)!!}" class="fa fa-edit btn btn-success my_btn">
                            &nbsp;ЗАВЪРШИ!
                        </a>
                    @endif
                @else
                    <a href="{!!URL::to('/фито/оператор/'.$operator->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                        &nbsp;Виж!
                    </a>
                @endif

            </td>
            {{--<td>--}}
                {{--<a href="{!!URL::to('/фито/таблица/table_edit/'.$operator->id)!!}" class="fa fa-edit btn btn-danger my_btn">--}}
                    {{--&nbsp;EDIT!--}}
                {{--</a>--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>