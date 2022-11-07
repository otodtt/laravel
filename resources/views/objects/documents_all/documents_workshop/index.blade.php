@extends('layouts.objects')
@section('title')
    {{ 'Удостоверение Цех' }}
@endsection

@section('css')
    {!!Html::style("css/documents/documents.css" )!!}
    {!!Html::style("css/documents/logo_document.css" )!!}
    {!!Html::style("css/documents/document_body.css")!!}
    {!!Html::style("css/documents/print.css", array('media' => 'print'))!!}

@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        <a href="{!! URL::to('/фирма/'.$firm->id) !!}" class="fa fa-arrow-left btn btn-success my_btn my_float"> Назад към Фирмата!</a>
        <h4 class="bold title_doc" >УДОСТОВЕРЕНИЕ ЦЕХА</h4>
        <hr class="my_hr"/>
        <fieldset class="big_field ">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-bank "></i> ДАННИ НА ФИРМАТА</span>
                    </div>
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-phar-info"><i class="fa fa-shield"></i> ДАННИ НА ЦЕХА</span>
                    </div>
                </div>

                <div class="small_field_left" style="display: table-cell">
                    @include('objects.forms.firm_info_objects')
                </div>
                <div class="small_field_right" style="display: table-cell">
                    @include('objects.documents_all.documents_workshop.workshop_info')
                </div>
            </div>
            <hr class="my_hr_in"/>
            <div class="col-md-12 row-table-bottom " style="display: table">
                @if($workshop->locks == 0)
                    <div class="small_field_bottom" style="display: table-cell">
                        @if(isset($edition) && $edition >0)
                            <a href="{!!URL::to('/цех/редактиране-издание/'.$workshop->firm_id.'/'.$workshop->id)!!}">
                                <i class="fa fa-edit"></i> Редактирай Издание на Удостоверение</a>
                        @else
                            <a href="{!!URL::to('/цех/'.$workshop->firm_id.'/редактирай/'.$workshop->id)!!}">
                                <i class="fa fa-edit"></i> Редактирай Удостоверение</a>
                        @endif
                    </div>
                    <div class="small_field_bottom" style="display: table-cell">
                        <p ><span class="red bold"><i class="fa fa-warning"></i>
                            ВНИМАНИЕ!!</span> Ако данните са коректни и Удостовернието е отпечатано,
                            ТРЯБВА да се заключи.<br/>
                            След като бъде заключено, няма да могат да се правят повече промени по него. </p>
                    </div>
                    <div class="small_field_bottom" style="display: table-cell">
                        {!! Form::model($workshop, ['url'=>'locks-workshop/'.$workshop->id , 'method'=>'POST', 'id'=>'form']) !!}
                            <button type="submit" class="btn-sm btn-danger " id="complexConfirm">
                                <i class="fa fa-lock"></i> Заключи!
                            </button>
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        {!! Form::close() !!}
                    </div>
                @else
                    <div class="small_field_bottom" style="display: table-cell">
                        <p class="bold">Удостоверението е заключено и не може да се редактира повече.</p>
                    </div>
                    @if(Auth::user()->admin == 2 )
                        <div class="small_field_bottom" style="display: table-cell">
                            {!! Form::model($workshop, ['url'=>'unlocks-workshop/'.$workshop->id , 'method'=>'POST', 'id'=>'form']) !!}
                                <button type="submit" class="btn-sm btn-success " id="unlockConfirm">
                                    <i class="fa fa-unlock"></i> Откючи!
                                </button>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                            {!! Form::close() !!}
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-12 row-table-bottom " >
                <div  class="archive small_field_bottom print-button" >
                    <button id="btn_archive" class="btn-sm"><i class="fa fa-print"></i> Виж и принтирай за клиента</button>
                </div>
                <div  class="hidden client small_field_bottom print-button" style="display: table-cell">
                    <button id="btn_client" class="btn-sm" ><i class="fa fa-print"></i> За архива</button>
                </div>
            </div>
        </fieldset>
    </div>
    <div id="wrap_in" class="col-md-12">
        <div class="page" >
            <div class="col-md-12" id="flip_all">
                <div class="col-md-12" id="flip_in">
                    @if(isset($edition) && $edition >0)
                        <div class="col-md-12_my" style="margin: 0 auto">
                            @include('objects.documents_all.logo_edition')
                        </div>
                        @include('objects.documents_all.edition_body')
                    @else
                        <div class="col-md-12_my" style="margin: 0 auto">
                            @include('objects.documents_all.logo')
                        </div>
                        @include('objects.documents_all.document_body')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/confirm/jquery.confirm.min.js" )!!}
    {!!Html::script("js/firms/locksDocument.js" )!!}
    {!!Html::script("js/firms/clientDocument.js" )!!}
    {!!Html::script("js/firms/flipText.js" )!!}
@endsection