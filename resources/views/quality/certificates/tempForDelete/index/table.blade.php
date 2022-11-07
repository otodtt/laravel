<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>N</th>
        <th>Ид - номер</th>
        <th>Дата на издаване</th>
        <th>Име Презиме Фамилия</th>
        <th>ЕГН</th>
        <th>Валиден до</th>
        <th>Инспектор</th>
        <th>Виж</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($certificates as $certificate)
        <?php
        if ($certificate->number <= 9) {
            $certificate_number = '000' . $certificate->number;
        } elseif ($certificate->number <= 99) {
            $certificate_number = '00' . $certificate->number;
        } elseif ($certificate->number <= 999) {
            $certificate_number = '0' . $certificate->number;
        } else {
            $certificate_number = $certificate->number;
        }
        if ($certificate->limit_certificate == 1) {
            $valid = 'БЕЗСРОЧЕН';
        } else {
            $date_now = time();
            if ($date_now > $certificate->to_date) {
                $valid = 'Изтекъл срок';
            } else {
                $valid = date('d.m.Y', $certificate->to_date);
            }
        }
        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="right">{!! $certificate->index_cert !!} - {!! $certificate_number !!}</td>
            <td class="center">{{date('d.m.Y', $certificate->date)}}</td>
            <td>{{$certificate->name}}</td>
            <td class="center">{{$certificate->pin}}</td>
            <td class="center">{{ $valid }}</td>
            <td class="center">{{$certificate->short_name}}</td>
            <td class="center last-column">
                <a href="{!!URL::to('/сертификат/'.$certificate->number)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>