<?php
if(isset($sort_years)){
$sort_years_ret = '/'.$sort_years;
}
else{
$sort_years_ret = '';
}
?>
@if(count($pharmacies) > 0 )
    <div class="row-height-my col-md-12">
        <div class="small_field_phar">
            <table class="my_table">
                <tbody>
                @foreach($pharmacies as $pharmacy)
                    <?php
                    if ($pharmacy->type_location == 1) {
                        $grad_selo = 'гр.';
                    } elseif ($pharmacy->type_location == 2) {
                        $grad_selo = 'с.';
                    } else {
                        $grad_selo = 'гр. / с.';
                    }
                    ?>
                    <tr>
                        <td class="center"><i class="fa fa-plus-square color_fa_plus"></i> Констативни протоколи за АПТЕКА в</td>
                        <td>
                            <span class="bold">{!! $grad_selo !!} {{ $pharmacy->location }}</span>,
                            <span class="bold">{{$pharmacy->address}}</span>
                        </td>
                        <td class="left">
                            <a href="{!! URL::to('/протоколи-фирма/'.$firm->id.'/сортирай/'.$pharmacy->id.'/1'.$sort_years_ret)  !!}"
                                class=" btn btn-primary my_btn"><i class="fa fa-list-ul"></i> Сотрирай
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@if(count($repositories) > 0 )
    <div class="row-height-my col-md-12 middle">
        <div class="small_field_repo">
            <table class="my_table">
                <tbody>
                @foreach($repositories as $repository)
                    <?php
                    if ($repository->type_location == 1) {
                        $grad_selo = 'гр.';
                    } elseif ($repository->type_location == 2) {
                        $grad_selo = 'с.';
                    } else {
                        $grad_selo = 'гр. / с.';
                    }
                    ?>
                    <tr>
                        <td class="center"><i class="fa fa-shield color_fa_shield"></i> Констативни протоколи за СКЛАД в</td>
                        <td>
                            <span class="bold">{!! $grad_selo !!} {{$repository->location}}</span>,
                            <span class="bold">{{$repository->address}}</span>
                        </td>
                        <td class="left">
                            <a href="{!! URL::to('/протоколи-фирма/'.$firm->id.'/сортирай/'.$repository->id.'/2'.$sort_years_ret)  !!}"
                               class=" btn btn-primary my_btn"><i class="fa fa-list-ul"></i> Сотрирай
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@if(count($workshops) > 0 )
    <div class="row-height-my col-md-12">
        <div class="small_field_works">
            <table class="my_table">
                <tbody>
                @foreach($workshops as $workshop)
                    <?php
                    if ($workshop->type_location == 1) {
                        $grad_selo = 'гр.';
                    } elseif ($workshop->type_location == 2) {
                        $grad_selo = 'с.';
                    } else {
                        $grad_selo = 'гр. / с.';
                    }
                    ?>
                    <tr>
                        <td class="center"><i class="fa fa-cubes color_fa_industry "></i> Констативни протоколи за ЦЕХ в</td>
                        <td>
                            <span class="bold">{!! $grad_selo !!} {{$workshop->location}}</span>,
                            <span class="bold">{{$workshop->address}}</span>
                        </td>
                        <td class="left">
                            <a href="{!! URL::to('/протоколи-фирма/'.$firm->id.'/сортирай/'.$workshop->id.'/3'.$sort_years_ret)  !!}"
                               class=" btn btn-primary my_btn"><i class="fa fa-list-ul"></i> Сотрирай
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif