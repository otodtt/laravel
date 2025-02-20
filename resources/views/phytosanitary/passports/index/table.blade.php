<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th>№</th>
            <th>Входящ №</th>
            <th>Дата</th>
            <th>РП №</th>
            <th>ЗП №</th>
            <th>Ботанически вид</th>
            <th>Количество</th>
            <th></th>
            <th>Производител</th>
            <th>Направление</th>
            <th>З. зона</th>
            <th>№ на фактура</th>
            <th>Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($passports as $passport)
        <?php
        if ($passport->passport <= 9) {
            $number = '00' . $passport->passport;
        }
        elseif ($passport->passport <= 99) {
            $number = '0' . $passport->passport;
        }
        else {
           $number = $passport->passport;
        }

        ?>
        <tr>
            <td class="right"><?= $n++ ?></td>
            <td class="right">{{$passport->number_petition}}</td>
            <td class="">{{date('d.m.Y', $passport->date_petition)}}</td>
            <td class="center">{!! $index[0]['operator_index_bg'].'-'.$number !!} / {{date('d.m.Y', $passport->date_permit)}}</td>
            <td class="center">
                @if($passport->is_farmer != 0)
                    <p>да</p>
                @else
                    <p>не</p>
                @endif
            </td>
            <td class="">{{$passport->botanical}}</td>
            <td class="">{{$passport->quantity}}</td>
            <td class="">
                @if($passport->quantity_type == 1)
                    <p>кг.</p>
                @elseif($passport->quantity_type == 2)
                    <p>т.</p>
                @elseif($passport->quantity_type == 3)
                    <p>бр.</p>
                @else
                    <p>-</p>
                @endif
            </td>
            <td class="">{{$passport->manufacturer}}</td>
            <td class="">{{$passport->direction}}</td>
            <td class="center">
                @if($passport->protected == 0)
                    <p>не</p>
                @elseif($passport->protected == 1)
                    <p>да</p>
                @else
                    <p>-</p>
                @endif
            </td>
            <td class="center">
                @if($passport->date_invoice != 0)
                    {!! $passport->invoice !!} / {{date('d.m.Y', $passport->date_invoice)}}
                @else
                    {!! $passport->invoice !!}
                @endif
            </td>

            <td class="center last-column">
                <a href="{!!URL::to('/фито/паспорт/покажи/'.$passport->id)!!}" class="fa fa-binoculars btn btn-primary my_btn">
                    &nbsp;Виж!
                </a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>