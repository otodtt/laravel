<table id="compliances_table" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
        <tr>
            <th>N</th>
            <th>Дата </th>
            <th></th>
            <th>Издаден на</th>
            <th>Обект на контрол</th>
            <th>Инспектор</th>
            <th>Виж</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($compliances as $compliance)

        <tr>
            <td class="right"><?= $n++ ?></td>
            <td>{{ date('d.m.Y', $compliance->date_compliance) }}</td>
            <td class="right">
                @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                    <span>ЗП</span>
                @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                    <span>Търговец</span>
                @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                    <span>Нерег.</span>
                @endif
            </td>
            <td>
                @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                    {{mb_strtoupper($compliance->farmer_name, 'utf-8')}}
                @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                    {{mb_strtoupper($compliance->trader_name, 'utf-8')}}
                @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                    {{mb_strtoupper($compliance->unregulated_name, 'utf-8')}}
                @endif
            </td>
            <td><span class="">{{$compliance->object_control}}</span></td>
            <td>{{$compliance->inspector_name}}</td>
            <td>
                @if($compliance->is_all == 0)
                    <a href='/контрол/артикули/{{$compliance->id}}/0/add' class="fa fa-edit btn btn-danger my_btn"></a>
                @else
                    <a href='/контрол/формуляри/{{$compliance->id}}/show' class="fa fa-binoculars btn btn-info my_btn"></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>