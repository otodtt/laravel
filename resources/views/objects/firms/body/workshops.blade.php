<fieldset class="works_all_field">
    <legend class="apt_all_legend">Ц Е Х О В Е</legend>
    <?php $n = 1;?>
    @foreach($workshops as $work)
        <?php
        /////////////////////////////
        if ($work->number_licence <= 9 && $work->raz_udost == 2) {
            $number_view = '00' . $work->number_licence;
        } elseif ($work->number_licence <= 99 && $work->raz_udost == 2) {
            $number_view = '0' . $work->number_licence;
        } else {
            $number_view = $work->number_licence;
        }
        ///////////////////////////////////
        if ($work->certificate <= 9) {
            $certificate_number = '000' . $work->certificate;
        } elseif ($work->certificate <= 99) {
            $certificate_number = '00' . $work->certificate;
        } elseif ($work->certificate <= 999) {
            $certificate_number = '0' . $work->certificate;
        } else {
            $certificate_number = $work->certificate;
        }
        //////////////////////////////////
        if ($work->raz_udost == 2) {
            $number_licence = $work->index_licence . '-' . $number_view . ' / ' . date('d.m.Y', $work->date_licence) . ' г.';
            $raz_udost = 'Удостоверение';
            $change_class = 'field_apt_permit';
        }
        if ($work->raz_udost == 1) {
            $number_licence = $work->number_licence . ' / ' . date('d.m.Y', $work->date_licence) . ' г.';
            $raz_udost = 'Разрешително';
            $change_class = 'field_apt_document';
        }
        ?>
        <fieldset class="{!! $change_class !!}">
            <legend class="legend_apt">ЦЕХ - <?php echo $n++;?> &nbsp;&nbsp;Данни
                за {!! $raz_udost !!}</legend>
            <fieldset class="small_apt_left">
                <div class="col-md-12 my_col_top">
                    <div class="col-md-8 my_col-md-12">
                        @if($work->raz_udost == 1)
                            <span class="view_licence_rz" >РАЗРЕШИТЕЛНО</span>
                        @endif
                        @if($work->raz_udost == 2)
                            @if($work->edition == 0)
                                <span><a class="fa fa-eye btn btn-info my_btn"
                                         href="{!!URL::to('/цех-удостоверение/'.$work->firm_id.'/'.$work->id)!!}">
                                        ВИЖ </a></span>
                                &nbsp;&nbsp;<span class="view_green">УДОСТОВЕРЕНИЕ</span>
                            @else
                                <span><a class="fa fa-eye btn btn-info my_btn"
                                         href="{!!URL::to('/цех-удостоверение/'.$work->firm_id.'/'.$work->id.'/'.$work->edition)!!}">
                                        ВИЖ </a></span>
                                &nbsp;&nbsp;<span class="view_green">УДОСТОВЕРЕНИЕ</span>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-4 change_objects_div">
                        <a class="change_objects " href="{!!URL::to('/цех/'.$work->id.'/промяна-обстоятелства')!!}">
                            <i class="fa fa-random " aria-hidden="true"></i> Промяна в обстоятелствата на този ЦЕХ</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <p style="display: inline-block; ">{!! $raz_udost !!} №
                        <span class="bold">{!! $number_licence !!}</span> за търговия с ПРЗ на дребно в ЦЕХ.</p>
                </div>
                <div class="col-md-12">
                    <?php
                    if ($work->edition > 0) {
                        $edition = $work->edition . ' / ' . date('d.m.Y', $work->date_edition) . ' г.';
                    } else {
                        $edition = 'Няма промяна в обстоятелствата';
                    }
                    /////////////////////////////////
                    if ($work->active == 0) {
                        $date_now = time();
                        if ($date_now > $work->end_date) {
                            $valid = '<span class="red">Изтекъл срок.</span>';
                        } else {
                            $valid = date('d.m.Y', $work->end_date) . ' г.';
                        }
                    } else {
                        $valid = '<span class="red">Прекратен срок.</span>';
                    }
                    ////////////////////////////
                    if ($work->type_location == 1) {
                        $type_location_ap = 'гр.';
                    } elseif ($work->type_location == 2) {
                        $type_location_ap = 'с.';
                    } else {
                        $type_location_ap = 'гр./с.';
                    }
                    ?>
                    <p>Издание: <span class="bold"> {!! $edition !!}</span></p>

                    <p>Адрес на аптеката: <span class="bold">общ. {!! $districts_show[$work->district_object] !!};
                            {!! $type_location_ap !!} {!! $work->location !!}; {!! $work->address !!}</span></p>

                    <p>{!! $raz_udost !!} валидно до: <span class="bold">{!! $valid !!}</span></p>
                </div>

                @if($work->raz_udost == 2)
                    <div class="col-md-8 my_col_bottom">
                        <span>Лице със  сертификат: <span class="bold">{!! $work->seller !!}</span>
                            със Сертификат №: <span class="bold">{!! $work->index_certificate !!}
                                - {!! $certificate_number !!} / {!! $work->date_certificate !!}
                                г.</span></span>
                    </div>
                    <div class="col-md-4 my_col_bottom">
                        @if((int)$index[0]['area_id'] == (int)$work->index_certificate)
                            @foreach($certificates as $certificate)
                                @if($certificate == $work->certificate)
                                    <?php
                                    $has_certificate = 1;
                                    ?>
                                    <span class="right_view_licence">
                                        <a href="{!! URL::to('/сертификат/'.$work->certificate) !!}" class="fa fa-certificate btn btn-info my_btn"> ВИЖ</a>
                                        Сертификата на продавач-консултанта!
                                    </span>
                                @endif
                            @endforeach
                            @if(!isset($has_certificate))
                                <span class="description red">Няма Сетрификат с този номер във Вашата БД</span>
                            @endif
                        @else
                            @foreach($areas as $area)
                                @if($area->id == $work->index_certificate)
                                    <span class="right_view_licence">Сертификата e издаден от <span class="bold" >ОДБХ - {!! $area->areas_name !!}</span></span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endif
                @if($work->raz_udost == 1)
                    <div class="col-md-12 my_col_bottom">
                        <a style="margin-left: 400px;" class="links_document"
                           href="{!!URL::to('/цех/'.$work->firm_id.'/удостоверение/'.$work->id)!!}">
                            <i class="fa fa-check-square" aria-hidden="true"></i> Добави Удостоверение за този цех!
                        </a>
                        <p style="margin-left: 200px;" class="description">
                            <span class="red">
                                <i class="fa fa-warning" aria-hidden="true"></i>
                                ВНИМАНИЕ!
                            </span>
                            Използвай <span class="bold">"Добави Удостоверение за този цех"</span> когато е изтекъл срока на
                            Разрешителното!!!
                        </p>
                    </div>
                @endif
            </fieldset>
            <hr/>
            <fieldset class="small_apt_right">
                <div class="btn-group">
                    <span><a href="{!!URL::to('/протокол/'.$work->id.'/добави/3') !!}" class="fa fa-file-powerpoint-o btn btn-info my_btn" >
                            Добави КП за този цех</a></span>
                </div>

                <div class="btn-group my_btn-group">
                    @if(Auth::user()->admin == 2 )
                        <a href="{!!URL::to('/цех/'.$work->firm_id.'/редактирай/'.$work->id.'/1')!!}"
                           class="fa fa-edit btn btn-danger my_btn"> Администратор. Редактирай този Цех!
                        </a>
                    @endif
                </div>
            </fieldset>
        </fieldset>
        <hr class="my_hr"/>
    @endforeach
</fieldset>