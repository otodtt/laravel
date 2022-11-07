<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>№</th>
        <th>№ на придружи-телното писмо от ОДБХ и № на пробата</th>
        <th>№ на протокола за вземане на пробата</th>
        <th>Дата на вземане на пробата</th>
        <th>Фирма и обект от който е пробата</th>
        <th>Търговско наименование и количество на пробата</th>
        <th>Активно вещество и № на партида</th>
        <th>Производител (преопаковчик) дата на производство</th>
        <th>Имена на инспектора взел пробата</th>
        <th>Резултати от анализа</th>
        <th>Редактирай и добави данни</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($samples_prz as $sample)
        <?php
        if($sample->from_object == 1){
            $type = 'Аптека';
        }
        if($sample->from_object == 2){
            $type = 'Склад';
        }
        if($sample->from_object == 3){
            $type = 'Цех';
        }
        if($sample->from_object == 100){
            $type = 'Н.Р.О';
        }
        if($sample->from_object == 200){
            $type = 'Производител';
        }
        if($sample->number_mail == 0 || $sample->date_mail == 0){
            $mail_number = '';
        }
        else{
            $mail_number = $sample->number_mail.' / '.$sample->date_mail.' г.';
        }
        if($sample->volume_pac == 0){
            $volume_assay = '';
        }
        else{
            $volume_assay = ' - '. $sample->volume_pac.' '.$sample->type_pac;
        }
        if(strlen($sample->lot_number) == 0){
            $lot = '';
        }
        else{
            $lot = ' - № '.$sample->lot_number;
        }
        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="">{{ $mail_number }}</td>
            <td class="right">{!! $sample->number_sample !!}</td>
            <td class="">{!! date('d.m.Y', $sample->date_number) !!}</td>
            <td>{{ $sample->from_firm }} - {{$type}}</td>
            <td class="">{{$sample->name}}{!! $volume_assay !!}</td>
            <td>{{$sample->active_subs}}{!! $lot !!}</td>
            <td class="center">{!! $sample->maker !!}</td>
            <td class="center">{!! $sample->inspector !!}</td>
            <td class="center">{!! $sample->results !!}</td>
            <td class="td_btn center">
                <a href="{!! URL::to('/проба/'.$sample->id.'/редактиране')!!}" class="fa fa-edit btn btn-danger my_btn_td"> Редактирай</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>