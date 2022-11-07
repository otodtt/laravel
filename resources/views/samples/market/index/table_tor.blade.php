<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th>№</th>
        {{--<th>№ на придружи-телното писмо от ОДБХ и № на пробата</th>--}}
        <th>№ и дата на протокола за вземане на пробата</th>
        <th>Търговско наименование и съдържание на хранителни вещества</th>
        <th>№ на партида, дата на производство и количество на партидата</th>
        <th>Състояние и Наличие на маркировка "ЕО ТОР"</th>
        <th>Собственик на тора.</th>
        <th>Производител на тора</th>
        <th>Опакован от</th>
        <th>Имена на инспектора взел пробата</th>
        <th>Резултати от анализа</th>
        <th>Редактирай и добави данни</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($samples_tor as $sample)
        <?php
        if($sample->from_object == 1){
            $type = 'Аптека';
        }
        elseif($sample->from_object == 2){
            $type = 'Склад';
        }
        elseif($sample->from_object == 3){
            $type = 'Цех';
        }
        else{
            $type = 'Н.Р.О.';
        }
        ////////////////
        if($sample->volume == 0){
            $volume_assay = '';
        }
        else{
            $volume_assay = ' - '. $sample->volume.' '.$sample->volume_lot;
        }
        //////////////////
        if(strlen($sample->lot_number) == 0){
            $lot = '';
        }
        else{
            $lot = '№ '.$sample->lot_number.' / '.$sample->date_lot;
        }
        ////////////////////
        if($sample->eo == 0){
            $eo = 'НЕ';
        }
        else{
            $eo = 'ДА';
        }
        ///////////////
        if($sample->state == 1){
            $state = 'Насипен - ';
        }
        elseif($sample->state == 2){
            $state = 'Опакован - ';
        }
        else{
            $state = '';
        }
        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            {{--<td class="">{{ $mail_number }}</td>--}}
            {{--<td class="right">{!! $sample->number_sample !!}</td>--}}
            <td class="">{!! $sample->number_sample !!} / {!! date('d.m.Y', $sample->date_number) !!}</td>
            <td class="">{{$sample->name}} - {!! $sample->active_subs !!}</td>
            <td>{{$lot}}{!! $volume_assay !!}</td>
            <td class="">{{ $state }}{{ $eo }}</td>
            <td>{{ $sample->from_firm }} - {{$type}}</td>


            <td class="center">{!! $sample->maker !!}</td>
            <td class="center">{!! $sample->packaged !!}</td>
            <td class="center">{!! $sample->inspector !!}</td>
            <td class="center">{!! $sample->results !!}</td>
            <td class="td_btn center">
                <a href="{!! URL::to('/проба-тор/'.$sample->id.'/редактиране')!!}" class="fa fa-edit btn btn-danger my_btn_td"> Редактирай</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>