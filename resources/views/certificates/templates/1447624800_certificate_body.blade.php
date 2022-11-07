<div class="number_doc_all col-md-12">
    <div class="img_wrap" style="display: inline-block" >
        <img id="pic" src="{{ asset($img_src) }}" alt="img">
    </div>
    <div class="col-md-12 row_top" >
        <h3 class="bold" id="number_doc">С Е Р Т И Ф И К А Т</h3>
    </div>
    <div class="col-md-12 row_top_bottom " >
        <p id="number_certificate">№ {!! $certificate->index_cert !!} - {!! $certificate_number !!} /
            {!! date('d.m.Y', $certificate->date) !!} г.</p>
    </div>
</div>
<div class="col-md-12 div_margin" >
    <div >
        <p >Настоящият сертификат се издава на <span class="bold uppercase" >{!! $certificate->name !!}</span></p>
    </div>
</div>
<div class="col-md-12 div_margin" >
    @if($certificate->limit_certificate == 1)
        <div class="fit_in_low">
            <p class="fit_p" >по чл. 84, ал. 1 във връзка с чл. 83 от Закона за защита на растенията, на основание
                <span class="bold">{!! $certificate->document !!} {!! $certificate->series !!} № {!! $certificate->number_diploma !!}
                    от {!! $certificate->date_diploma !!} г.,</span>
            </p>
        </div>
        <div class="fit_in_low">
            <p class="fit_p">издаден от <span class="bold">{!! $certificate->from_institute !!}</span>,
                професионално направление: <span class="bold">{!! $certificate->specialty !!}.</span>
            </p>
        </div>
    @endif
    @if($certificate->limit_certificate == 2)
        <div class="fit_in_low">
            <p class="fit_p" >по чл. 84, ал. 1 във връзка с чл. 83 от Закона за защита на растенията, на основание
            </p>
        </div>
        <div class="fit_in_low">
            <p class="fit_p" >документ
            <span class="bold">{!! $certificate->document !!} {!! $certificate->series !!} № {!! $certificate->number_diploma !!}
                от {!! $certificate->date_diploma !!} г.,</span> издаден от <span class="bold">{!! $certificate->from_institute !!}</span>
            </p>
        </div>
        <div class="fit_in_low">
            <p class="fit_p">по програма: <span class="bold">{!! $certificate->specialty !!}.</span></p>
        </div>
    @endif
</div>
<div class="col-md-12 div_margin">
    <div >
        @if($certificate->limit_certificate == 1)
            <p >Срок на валидност: <span class="bold">{!! $valid !!}</span></p>
        @else
            <p >Срок на валидност до: <span class="bold">{!! $valid !!}</span></p>
        @endif
    </div>
</div>
<div class="col-md-12 div_margin">
    <div >
        <p >Сертификатът е вписан в регистъра по чл. 6, ал. 1, т. 13 от Закона за защита на растенията.</p>
    </div>
</div>

<div class="col-md-12 div_margin_director" id="bottom">
    <div class="col-md-12 inspector">
        <p class="bold inspector">ИЗГОТВИЛ: {{$certificate->inspector_name}}:..............................</p>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <span class="bold uppercase" id="span_director">{{$director[0]['type_dir']}} ДИРЕКТОР НА ОДБХ {!! $logo[0]['odbh_city'] !!}</span>
            <span class="dots" >..............................</span>
        </div>

    </div>
    <div class="col-md-12" >
        <div class="col-md-12">
            <span class="bold director uppercase" id="director_name">/ {{$director[0]['degree']}} {{$director[0]['name']}} {{$director[0]['family']}} /</span>
        </div>
    </div>
</div>
