@extends('layouts.certificates')
@section('title')
    {{ 'Сертификат' }}
@endsection

@section('css')
    {!!Html::style("css/documents/logo_document.css" )!!}
    {!!Html::style("css/certificates/certificates.css" )!!}
    {!!Html::style("css/certificates/certificate_page.css" )!!}
    {!!Html::style("css/certificates/certificate_body.css" )!!}

    {!!Html::style("css/certificates/print.css", array('media' => 'print'))!!}

    <style type="text/css" media="print">
        @media print {
            @page { margin: 0; }
            body { margin: 0 auto; }
        }
    </style>
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <h4 class="bold title_doc" >С Е Р Т И Ф И К А Т</h4>
    <hr class="my_hr"/>
    <div class="btn-group my_group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/сертификати')!!}" class="fa fa-certificate btn btn-info my_btn"> Всички издадени Сертификати</a>
        <a href="{!! URL::to('/регистър-сертификати')!!}" class="fa fa-registered btn btn-info my_btn"> Таблица Регистър на издадените Сертификати</a>
    </div>
    <hr class="my_hr"/>
    <fieldset class="big_field ">
        <div class="row-height-my col-md-12" style="display: table">
            <div style="display: table-row">
                <div class="small_field_right top_info" style="display: table-cell" >
                    <span class="span-firm-info"><i class="fa fa-user-secret "></i> ДАННИ НА ПРИТЕЖАТЕЛЯ</span>
                </div>
                <div class="small_field_right top_info" style="display: table-cell" >
                    <span class="span-phar-info"><i class="fa fa-certificate"></i> ДАННИ ЗА СЕРТИФИКАТА</span>
                </div>
            </div>

            <div class="small_field_left" style="display: table-cell">
                @include('certificates.forms.owner')
            </div>
            <div class="small_field_right" style="display: table-cell">
                @include('certificates.forms.info_certificate')
            </div>
        </div>
        <div class="col-md-12 row-table-bottom " style="display: table">
            <div class="small_field_bottom" style="display: table-cell">
                    <a href="{!!URL::to('/сертификат/'.$certificate->id.'/редактирай')!!}"> <i class="fa fa-edit"></i> Редактирай Сертификата</a>
            </div>
            <div class="small_field_bottom-middle center" style="display: table-cell">
                <div  class="archive  print-button" >
                    <button id="btn_archive" class="btn-sm"><i class="fa fa-print"></i> Виж и принтирай за клиента</button>
                </div>
                <div  class="hidden client print-button" >
                    <button id="btn_client" class="btn-sm" ><i class="fa fa-print"></i> За архива</button>
                </div>
            </div>
            <div class="small_field_bottom" style="display: table-cell">
                <span class="">Редактирай снимка:</span>&nbsp;&nbsp;
                <input type="range" id="slider" min="30" max="120" value="100" step="5" onchange="updateSlider(this.value)" name="range" class="range" title="slider_title"/>&nbsp;&nbsp;<span id="chosen">70</span>
            </div>
        </div>
    </fieldset>
    <div id="wrap_in" class="col-md-12">
        <div class="page"  >
            <div class="col-md-12 frame_archive" id="flip_all">
                <div class="col-md-12" id="flip_in">
                    <div class="col-md-12_my" style="margin: 0 auto">
                        @include('certificates.forms.logo')
                    </div>
                    @include('certificates.forms.body')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(window).load(function(){
            var div_margin = $('.div_margin');
            div_margin.css('margin-bottom', '40px');

            while ($('#flip_all').height() < $('#flip_in').height()) {
                div_margin.css('margin-bottom', (parseInt(div_margin.css('margin-bottom')) - 1) + "px");
            }
        });
    </script>
    {!!Html::script("js/certificates/flipText.js" )!!}
    {!!Html::script("js/certificates/clientDocument.js" )!!}
    {!!Html::script("js/certificates/picResize.js" )!!}
@endsection
