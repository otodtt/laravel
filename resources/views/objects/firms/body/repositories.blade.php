<fieldset class="store_all_field">
    <legend class="apt_all_legend">С К Л А Д О В Е</legend>
    <?php $n = 1;?>
    @foreach($repositories as $repo)
        <?php
        /////////////////////////////
        if ($repo->number_licence <= 9 && $repo->raz_udost == 2) {
            $number_view = '00' . $repo->number_licence;
        } elseif ($repo->number_licence <= 99 && $repo->raz_udost == 2) {
            $number_view = '0' . $repo->number_licence;
        } else {
            $number_view = $repo->number_licence;
        }
        ///////////////////////////////////
        if ($repo->certificate <= 9) {
            $certificate_number = '000' . $repo->certificate;
        } elseif ($repo->certificate <= 99) {
            $certificate_number = '00' . $repo->certificate;
        } elseif ($repo->certificate <= 999) {
            $certificate_number = '0' . $repo->certificate;
        } else {
            $certificate_number = $repo->certificate;
        }
        //////////////////////////////////
        if ($repo->raz_udost == 2) {
            $number_licence = $repo->index_licence . '-' . $number_view . ' / ' . date('d.m.Y', $repo->date_licence) . ' г.';
            $raz_udost = 'Удостоверение';
            $change_class = 'field_apt_permit';
        }
        if ($repo->raz_udost == 1) {
            $number_licence = $repo->number_licence . ' / ' . date('d.m.Y', $repo->date_licence) . ' г.';
            $raz_udost = 'Разрешително';
            $change_class = 'field_apt_document';
        }
        ?>
        <fieldset class="{!! $change_class !!}">
            <legend class="legend_apt">СКЛАД - <?php echo $n++;?> &nbsp;&nbsp;Данни
                за {!! $raz_udost !!}</legend>
            <fieldset class="small_apt_left">
                <div class="col-md-12 my_col_top">
                    <div class="col-md-8 my_col-md-12">
                        @if($repo->raz_udost == 1)
                            <span class="view_licence_rz" >РАЗРЕШИТЕЛНО</span>
                        @endif
                        @if($repo->raz_udost == 2)
                            @if($repo->edition == 0)
                                <span><a class="fa fa-eye btn btn-info my_btn"
                                         href="{!!URL::to('/склад-удостоверение/'.$repo->firm_id.'/'.$repo->id)!!}">
                                        ВИЖ </a></span>
                                &nbsp;&nbsp;<span class="view_green">УДОСТОВЕРЕНИЕ</span>
                            @else
                                <span><a class="fa fa-eye btn btn-info my_btn"
                                         href="{!!URL::to('/склад-удостоверение/'.$repo->firm_id.'/'.$repo->id.'/'.$repo->edition)!!}">
                                        ВИЖ </a></span>
                                &nbsp;&nbsp;<span class="view_green">УДОСТОВЕРЕНИЕ</span>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-4 change_objects_div">
                        <a class="change_objects " href="{!! URL::to('/склад/'.$repo->id.'/промяна-обстоятелства')!!}">
                            <i class="fa fa-random " aria-hidden="true"></i> Промяна в обстоятелствата на този Склад</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <p style="display: inline-block; ">{!! $raz_udost !!} №
                        <span class="bold">{!! $number_licence !!}</span> за търговия с ПРЗ на дребно в СКЛАД.</p>
                </div>
                <div class="col-md-12">
                    <?php
                    if ($repo->edition > 0) {
                        $edition = $repo->edition . ' / ' . date('d.m.Y', $repo->date_edition) . ' г.';
                    } else {
                        $edition = 'Няма промяна в обстоятелствата';
                    }
                    /////////////////////////////////
                    if ($repo->active == 0) {
                        $date_now = time();
                        if ($date_now > $repo->end_date) {
                            $valid = '<span class="red">Изтекъл срок.</span>';
                        } else {
                            $valid = date('d.m.Y', $repo->end_date) . ' г.';
                        }
                    } else {
                        $valid = '<span class="red">Прекратен срок.</span>';
                    }
                    ////////////////////////////
                    if ($repo->type_location == 1) {
                        $type_location_ap = 'гр.';
                    } elseif ($repo->type_location == 2) {
                        $type_location_ap = 'с.';
                    } else {
                        $type_location_ap = 'гр./с.';
                    }
                    ?>
                    <p>Издание: <span class="bold"> {!! $edition !!}</span></p>

                    <p>Адрес на аптеката: <span class="bold">общ. {!! $districts_show[$repo->district_object] !!};
                            {!! $type_location_ap !!} {!! $repo->location !!}; {!! $repo->address !!}</span></p>

                    <p>{!! $raz_udost !!} валидно до: <span class="bold">{!! $valid !!}</span></p>
                </div>

                @if($repo->raz_udost == 2)
                    <div class="col-md-8 my_col_bottom">
                        <span>Лице със  сертификат: <span class="bold">{!! $repo->seller !!}</span>
                            със Сертификат №: <span class="bold">{!! $repo->index_certificate !!}
                                - {!! $certificate_number !!} / {!! $repo->date_certificate !!}
                                г.</span></span>
                    </div>
                    <div class="col-md-4 my_col_bottom">
                        @if((int)$index[0]['area_id'] == (int)$repo->index_certificate)
                            @foreach($certificates as $certificate)
                                @if($certificate == $repo->certificate)
                                    <?php
                                    $has_certificate = 1;
                                    ?>
                                    <span class="right_view_licence">
                                        <a href="{!! URL::to('/сертификат/'.$repo->certificate) !!}" class="fa fa-certificate btn btn-info my_btn"> ВИЖ</a>
                                        Сертификата на продавач-консултанта!
                                    </span>
                                @endif
                            @endforeach
                            @if(!isset($has_certificate))
                                <span class="description red">Няма Сетрификат с този номер във Вашата БД</span>
                            @endif
                        @else
                            @foreach($areas as $area)
                                @if($area->id == $repo->index_certificate)
                                    <span class="right_view_licence">Сертификата e издаден от <span class="bold" >ОДБХ - {!! $area->areas_name !!}</span></span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endif
                @if($repo->raz_udost == 1)
                    <div class="col-md-12 my_col_bottom">
                        <a style="margin-left: 400px;" class="links_document"
                           href="{!!URL::to('/склад/'.$repo->firm_id.'/удостоверение/'.$repo->id)!!}">
                            <i class="fa fa-check-square" aria-hidden="true"></i> Добави Удостоверение за този склад!
                        </a>
                        <p style="margin-left: 200px;" class="description">
                            <span class="red">
                                <i class="fa fa-warning" aria-hidden="true"></i>
                                ВНИМАНИЕ!
                            </span>
                            Използвай <span class="bold">"Добави Удостоверение за този склад"</span> когато е изтекъл срока на
                            Разрешителното!!!
                        </p>
                    </div>
                @endif
            </fieldset>
            <hr/>
            <fieldset class="small_apt_right">
                <div class="btn-group">
                    <span><a href="{!!URL::to('/протокол/'.$repo->id.'/добави/2') !!}" class="fa fa-file-powerpoint-o btn btn-info my_btn">
                            Добави КП за този склад</a></span>
                </div>

                <div class="btn-group my_btn-group">
                    @if(Auth::user()->admin == 2 )
                        <a href="{!!URL::to('/склад/'.$repo->firm_id.'/редактирай/'.$repo->id.'/1')!!}"
                           class="fa fa-edit btn btn-danger my_btn"> Администратор. Редактирай този Склад!
                        </a>
                    @endif
                </div>
            </fieldset>
        </fieldset>
        <hr class="my_hr"/>
    @endforeach
</fieldset>