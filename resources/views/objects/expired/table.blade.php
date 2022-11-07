<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>N</th>
        <th>Р / У</th>
        <th>№</th>
        <th>Дата</th>
        <th>Име на Фирмата</th>
        <th>Населено място</th>
        <th>Адрес</th>
        <th>Валидно до</th>
        <th></th>
        <th>Обект</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($pharmacies as $pharmacy)
        <?php
        ////////////////////////
        if ($pharmacy['type_firm'] == 1) {
            $et = 'ET';
            $ood = '';
        } elseif ($pharmacy['type_firm'] == 2) {
            $et = '';
            $ood = 'ООД';
        } elseif ($pharmacy['type_firm'] == 3) {
            $et = '';
            $ood = 'ЕООД';
        } elseif ($pharmacy['type_firm'] == 4) {
            $et = '';
            $ood = 'АД';
        } else {
            $et = '';
            $ood = '';
        }
        //////////////////////////
        if ($pharmacy['raz_udost'] == 1) {
            $type_licence = 'Разр';
        }
        if ($pharmacy['raz_udost'] == 2) {
            $type_licence = 'Удост';
        }
        //////////////////////////////////
        if ($pharmacy['active'] == 0) {
            $date_now = time();
            if ($date_now > $pharmacy['end_date']) {
                $valid = '<span class="red">Изтекъл срок</span>';
            } else {
                $valid = date('d.m.Y', $pharmacy['end_date']);
            }
        }
        if ($pharmacy['active'] == 1) {
            $valid = '<span class="red">Прекратен срок</span>';
        }
        /////////////////////////////
        if ($pharmacy['number_licence'] <= 9 && $pharmacy['raz_udost'] == 2) {
            $number_view = '00' . $pharmacy['number_licence'];
        } elseif ($pharmacy['number_licence'] <= 99 && $pharmacy['raz_udost'] == 2) {
            $number_view = '0' . $pharmacy['number_licence'];
        } else {
            $number_view = $pharmacy['number_licence'];
        }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $type_licence !!}</td>
            <td class="center">{!! $number_view !!}</td>
            <td class="right">{!! date('d.m.Y', $pharmacy['date_licence']) !!}</td>
            <td>{!! $et !!} "{{$pharmacy['name']}}" {!! $ood !!}</td>
            <td class="">{{$pharmacy['location']}}</td>
            <td>{{$pharmacy['address']}}</td>
            <td class="center">{!! date('d.m.Y', $pharmacy['end_date']) !!}</td>
            <td class="center">{!! $valid !!}</td>
            <td class="center">Аптека</td>
            <td class="center last-column">
                <a href="{!!URL::to('/фирма/'.$pharmacy['firm_id'])!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach

    @foreach($repositories as $repository)
        <?php
        ////////////////////////
        if ($repository['type_firm'] == 1) {
            $et = 'ET';
            $ood = '';
        } elseif ($repository['type_firm'] == 2) {
            $et = '';
            $ood = 'ООД';
        } elseif ($repository['type_firm'] == 3) {
            $et = '';
            $ood = 'ЕООД';
        } elseif ($repository['type_firm'] == 4) {
            $et = '';
            $ood = 'АД';
        } else {
            $et = '';
            $ood = '';
        }
        //////////////////////////
        if ($repository['raz_udost'] == 1) {
            $type_licence = 'Разр';
        }
        if ($repository['raz_udost'] == 2) {
            $type_licence = 'Удост';
        }
        //////////////////////////////////
        if ($repository['active'] == 0) {
            $date_now = time();
            if ($date_now > $repository['end_date']) {
                $valid = '<span class="red">Изтекъл срок</span>';
            } else {
                $valid = date('d.m.Y', $repository['end_date']);
            }
        }
        if ($repository['active'] == 1) {
            $valid = '<span class="red">Прекратен срок</span>';
        }
        /////////////////////////////
        if ($repository['number_licence'] <= 9 && $repository['raz_udost'] == 2) {
            $number_view = '00' . $repository['number_licence'];
        } elseif ($pharmacy['number_licence'] <= 99 && $repository['raz_udost'] == 2) {
            $number_view = '0' . $repository['number_licence'];
        } else {
            $number_view = $repository['number_licence'];
        }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $type_licence !!}</td>
            <td class="center">{!! $number_view !!}</td>
            <td class="right">{!! date('d.m.Y', $repository['date_licence']) !!}</td>
            <td>{!! $et !!} "{{$repository['name']}}" {!! $ood !!}</td>
            <td class="">{{$repository['location']}}</td>
            <td>{{$repository['address']}}</td>
            <td class="center">{!! date('d.m.Y', $repository['end_date']) !!}</td>
            <td class="center">{!! $valid !!}</td>
            <td class="center">Склад</td>
            <td class="center last-column">
                <a href="{!!URL::to('/фирма/'.$repository['firm_id'])!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach

    @foreach($workshops as $workshop)
        <?php
        ////////////////////////
        if ($workshop['type_firm'] == 1) {
            $et = 'ET';
            $ood = '';
        } elseif ($workshop['type_firm'] == 2) {
            $et = '';
            $ood = 'ООД';
        } elseif ($workshop['type_firm'] == 3) {
            $et = '';
            $ood = 'ЕООД';
        } elseif ($workshop['type_firm'] == 4) {
            $et = '';
            $ood = 'АД';
        } else {
            $et = '';
            $ood = '';
        }
        //////////////////////////
        if ($workshop['raz_udost'] == 1) {
            $type_licence = 'Разр';
        }
        if ($workshop['raz_udost'] == 2) {
            $type_licence = 'Удост';
        }
        //////////////////////////////////
        if ($workshop['active'] == 0) {
            $date_now = time();
            if ($date_now > $workshop['end_date']) {
                $valid = '<span class="red">Изтекъл срок</span>';
            } else {
                $valid = date('d.m.Y', $workshop['end_date']);
            }
        }
        if ($workshop['active'] == 1) {
            $valid = '<span class="red">Прекратен срок</span>';
        }
        /////////////////////////////
        if ($workshop['number_licence'] <= 9 && $workshop['raz_udost'] == 2) {
            $number_view = '00' . $workshop['number_licence'];
        } elseif ($workshop['number_licence'] <= 99 && $workshop['raz_udost'] == 2) {
            $number_view = '0' . $workshop['number_licence'];
        } else {
            $number_view = $workshop['number_licence'];
        }
        ?>
        <tr>
            <td class="right">{!! $n++ !!}</td>
            <td class="right">{!! $type_licence !!}</td>
            <td class="center">{!! $number_view !!}</td>
            <td class="right">{!! date('d.m.Y', $workshop['date_licence']) !!}</td>
            <td>{!! $et !!} "{{$workshop['name']}}" {!! $ood !!}</td>
            <td class="">{{$workshop['location']}}</td>
            <td>{{$workshop['address']}}</td>
            <td class="center">{!! date('d.m.Y', $workshop['end_date'])!!}</td>
            <td class="center">{!! $valid !!}</td>
            <td class="center">Цех</td>
            <td class="center last-column">
                <a href="{!!URL::to('/фирма/'.$workshop['firm_id'])!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>