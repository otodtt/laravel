<fieldset class="apt_all_field">
    <legend class="apt_all_legend">А П Т Е К И</legend>
    <?php $n = 1;?>
    @foreach($pharmacies as $apt)
        <?php
        /////////////////////////////
        if ($apt->number_licence <= 9 && $apt->raz_udost == 2) {
            $number_view = '00' . $apt->number_licence;
        } elseif ($apt->number_licence <= 99 && $apt->raz_udost == 2) {
            $number_view = '0' . $apt->number_licence;
        } else {
            $number_view = $apt->number_licence;
        }
        ///////////////////////////////////
        if ($apt->certificate <= 9) {
            $certificate_number = '000' . $apt->certificate;
        } elseif ($apt->certificate <= 99) {
            $certificate_number = '00' . $apt->certificate;
        } elseif ($apt->certificate <= 999) {
            $certificate_number = '0' . $apt->certificate;
        } else {
            $certificate_number = $apt->certificate;
        }
        //////////////////////////////////
        if ($apt->raz_udost == 2) {
            $number_licence = $apt->index_licence . '-' . $number_view . ' / ' . date('d.m.Y', $apt->date_licence) . ' г.';
            $raz_udost = 'Удостоверение';
            $change_class = 'field_apt_permit';
        }
        if ($apt->raz_udost == 1) {
            $number_licence = $apt->number_licence . ' / ' . date('d.m.Y', $apt->date_licence) . ' г.';
            $raz_udost = 'Разрешително';
            $change_class = 'field_apt_document';
        }
        ?>
        <fieldset class="{!! $change_class !!}">
            <legend class="legend_apt">АПТЕКА - <?php echo $n++;?> &nbsp;&nbsp;Данни за {!! $raz_udost !!}</legend>
            <fieldset class="small_apt_left">
                <div class="col-md-12 my_col_top">
                    <div class="col-md-8 my_col-md-12">
                        @if($apt->raz_udost == 1)
                            <span class="view_licence_rz" >РАЗРЕШИТЕЛНО</span>
                        @endif
                        @if($apt->raz_udost == 2)
                            @if($apt->edition == 0)
                                <span><a class="fa fa-eye btn btn-info my_btn"
                                         href="{!!URL::to('/аптека-удостоверение/'.$apt->firm_id.'/'.$apt->id)!!}"> ВИЖ
                                    </a>
                                </span>
                                &nbsp;&nbsp;<span class="view_green">УДОСТОВЕРЕНИЕ</span>
                            @else
                                <span>
                                    <a class="fa fa-eye btn btn-info my_btn" href="{!!URL::to('/аптека-удостоверение/'.$apt->firm_id.'/'.$apt->id.'/'.$apt->edition)!!}">
                                        ВИЖ
                                    </a>
                                </span>
                                &nbsp;&nbsp;<span class="view_green">УДОСТОВЕРЕНИЕ</span>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-4 change_objects_div">
                        <a class="change_objects " href="{!!URL::to('/аптека/'.$apt->id.'/промяна-обстоятелства')!!}">
                            <i class="fa fa-random " aria-hidden="true"></i>
                            Промяна в обстоятелствата на тази Аптека.
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <p style="display: inline-block; ">
                        {!! $raz_udost !!} № <span class="bold">{!! $number_licence !!}</span> за търговия с ПРЗ на дребно в ССА.
                    </p>
                </div>
                <div class="col-md-12">
                    <?php
                    if ($apt->edition > 0) {
                        $edition = $apt->edition . ' / ' . date('d.m.Y', $apt->date_edition) . ' г.';
                    } else {
                        $edition = 'Няма промяна в обстоятелствата';
                    }
                    /////////////////////////////////
                    if ($apt->active == 0) {
                        $date_now = time();
                        if ($date_now > $apt->end_date) {
                            $valid = '<span class="red">Изтекъл срок.</span>';
                        } else {
                            $valid = date('d.m.Y', $apt->end_date) . ' г.';
                        }
                    } else {
                        $valid = '<span class="red">Прекратен срок.</span>';
                    }
                    ////////////////////////////
                    if ($apt->type_location == 1) {
                        $type_location_ap = 'гр.';
                    } elseif ($apt->type_location == 2) {
                        $type_location_ap = 'с.';
                    } else {
                        $type_location_ap = 'гр./с.';
                    }
                    ?>
                    <p>Издание: <span class="bold"> {!! $edition !!}</span></p>

                    <p>Адрес на аптеката: <span class="bold">общ. {!! $districts_show[$apt->district_object] !!};
                            {!! $type_location_ap !!} {!! $apt->location !!}; {!! $apt->address !!}</span></p>

                    <p>{!! $raz_udost !!} валидно до: <span class="bold">{!! $valid !!}</span></p>
                </div>

                @if($apt->raz_udost == 2)
                    <div class="col-md-8 my_col_bottom">
                        <span>Лице със сертификат: <span class="bold">{!! $apt->seller !!}</span>
                            със Сертификат №: <span class="bold">{!! $apt->index_certificate !!}
                                - {!! $certificate_number !!} / {!! $apt->date_certificate !!}
                                г.</span>
                        </span>
                    </div>

                    <div class="col-md-4 my_col_bottom">
                        @if((int)$index[0]['area_id'] == (int)$apt->index_certificate)
                           @foreach($certificates as $certificate)
                               @if($certificate == $apt->certificate)
                                   <?php
                                        $has_certificate = 1;
                                    ?>
                                    <span class="right_view_licence">
                                        <a href="{!! URL::to('/сертификат/'.$apt->certificate) !!}" class="fa fa-certificate btn btn-info my_btn"> ВИЖ</a>
                                        Сертификата на продавач-консултанта!
                                    </span>
                               @endif
                           @endforeach
                            @if(!isset($has_certificate))
                                <span class="description red">Няма Сетрификат с този номер във Вашата БД</span>
                            @endif
                        @else
                            @foreach($areas as $area)
                                @if($area->id == $apt->index_certificate)
                                    <span class="right_view_licence">Сертификата e издаден от <span class="bold" >ОДБХ - {!! $area->areas_name !!}</span></span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endif
                @if($apt->raz_udost == 1)
                    <div class="col-md-12 my_col_bottom">
                        <a style="margin-left: 400px;" class="links_document"
                           href="{!!URL::to('/аптека/'.$apt->firm_id.'/удостоверение/'.$apt->id)!!}">
                            <i class="fa fa-check-square" aria-hidden="true"></i> Добави Удостоверение за тази аптека!
                        </a>
                        <p style="margin-left: 200px;" class="description">
                            <span class="red"><i class="fa fa-warning" aria-hidden="true"></i> ВНИМАНИЕ! </span>
                            Използвай <span class="bold">"Добави Удостоверение за тази аптека"</span>
                            когато е изтекъл срока на Разрешителното!!!
                        </p>
                    </div>
                @endif
            </fieldset>
            <hr/>
            <fieldset class="small_apt_right">
                <div class="btn-group">
                    <span><a href="{!!URL::to('/протокол/'.$apt->id.'/добави/1') !!}" class="fa fa-file-powerpoint-o btn btn-default my_btn" >
                            Добави КП БЕЗ ДОКЛАД!</a></span>
                    <span><a href="{!!URL::to('/доклад-аптека/'.$apt->id.'/добави/1') !!}" class="fa fa-file-text-o btn btn-info my_btn" >
                            Добави ДОКЛАД за тази аптека</a></span>
                </div>
                <div class="btn-group my_btn-group">
                    @if(Auth::user()->admin == 2 )
                        <a href="{!!URL::to('/аптека/'.$apt->firm_id.'/редактирай/'.$apt->id.'/1')!!}" class="fa fa-edit btn btn-danger my_btn">
                            Администратор. Редактирай тази Аптека!
                        </a>
                    @endif
                </div>
            </fieldset>
        </fieldset>
        <hr class="my_hr"/>
    @endforeach
</fieldset>