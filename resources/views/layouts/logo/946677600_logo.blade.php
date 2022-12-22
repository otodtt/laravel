<div class="page_logo" >
    <div class="img_logo ">
        <img src="{!! URL::to('/img/logo.png')!!}" alt="logo" style="width: 130px"/>
    </div >
    <div class="logo_txt_wrap">
        <div class="mzh col-md-12">
            <p id="p_mzh">МИНИСТЕРСТВО НА ЗЕМЕДЕЛИЕТО И ХРАНИТЕ</p>
        </div >
        <div class="mzh col-md-12">
            <p id="odbh">БЪЛГАРСКА АГЕНЦИЯ ПО БЕЗОПАСНОСТ НА ХРАНИТЕ</p>
        </div >
        <div class="mzh col-md-12s last">
            <p id="babh">ОБЛАСТНА ДИРЕКЦИЯ ПО БЕЗОПАСНОСТ НА ХРАНИТЕ</p>
        </div >
        <div id="fitin" class=" address col-md-12">
            <div class="address" id="address">
                <p>
                    <i class="fa fa-envelope-o"></i>
                    &nbsp; {!! $logo[0]['city'] !!},  п.к. {!! $logo[0]['postal_code'] !!},  {!! $logo[0]['address'] !!};<br/>
                </p>
            </div>
        </div>
        <div id="fitin_bottom" class=" address col-md-12">
            <div class="address ">
                @if($logo[0]['fax'] == 0)
                    <i class="fa fa-phone"></i> +359(0){!! $logo[0]['phone'] !!}; {!! $logo[0]['mail'] !!}
                @else
                    <i class="fa fa-phone"></i> / <i class="fa fa-fax"></i> : +359(0){!! $logo[0]['fax'] !!},
                    <i class="fa fa-phone"></i> +359(0){!! $logo[0]['phone'] !!}; {!! $logo[0]['mail'] !!}
                @endif
            </div>
        </div>
    </div>
</div>
