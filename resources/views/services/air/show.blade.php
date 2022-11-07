@extends('layouts.services')
@section('title')
    {{ 'Разрешително Въздушно Третиране' }}
@endsection

@section('css')
    {!!Html::style("css/air/permit.css" )!!}
    {!!Html::style("css/documents/logo_document.css" )!!}
    {!!Html::style("css/documents/document_body.css")!!}
    {!!Html::style("css/documents/print.css", array('media' => 'print'))!!}

    <style type="text/css" media="print">
        @media print {
            @page { margin: 0; }
            body { margin: 10px 0 0 -10px; }
        }
    </style>
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <h4 class="bold title_doc" >РАЗРЕШИТЕЛНО ЗА ВЪЗДУШНО ТРЕТИРАНЕ</h4>
    <hr class="my_hr"/>
    <fieldset class="big_field ">
        <div class="row-height-my col-md-12" style="display: table">
            <div style="display: table-row">
                <div class="small_field_right top_info" style="display: table-cell" >
                    <span class="span-firm-info"><i class="fa fa-user-secret "></i> ДАННИ НА ЗАЯВИТЕЛЯ</span>
                </div>
                <div class="small_field_right top_info" style="display: table-cell" >
                    <span class="span-phar-info"><i class="fa fa-plane"></i> ДАННИ ЗА ТРЕТИРАНЕТО</span>
                </div>
            </div>

            <div class="small_field_left" style="display: table-cell">
                @include('services.air.forms.owner')
            </div>
            <div class="small_field_right" style="display: table-cell">
                @include('services.air.forms.info_permit')
            </div>
        </div>
        <div class="col-md-12 row-table-bottom " style="display: table">

            <div class="small_field_bottom-middle " style="display: table-cell">
                <div  class="archive  print-button" >
                    <button id="btn_archive" class="btn-sm"><i class="fa fa-print"></i> Виж и принтирай за клиента</button>
                    <a href="{!!URL::to('/въздушни/'.$permit->id.'/редактирай')!!}" class="btn btn-danger my_btn right">
                        <i class="fa fa-edit"></i> Редактирай Разрешителното
                    </a>
                </div>
                <div  class="hidden client print-button" >
                    <button id="btn_client" class="btn-sm" ><i class="fa fa-print"></i> За архива</button>
                </div>
            </div>
        </div>
    </fieldset>
    <div id="wrap_in" class="col-md-12">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all">
                <div class="col-md-12_my" id="flip_in">
                    <div class="col-md-12_my" style="margin: 0 auto">
                        @include('services.air.show.logo')
                    </div>
                    @include('services.air.show.permit_body')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/opinions/clientDocument.js" )!!}
    {!!Html::script("js/opinions/flipText.js" )!!}
    {!!Html::script("js/opinions/addressFlip.js" )!!}
@endsection