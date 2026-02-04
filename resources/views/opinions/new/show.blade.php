@extends('layouts.farmers')
@section('title')
    {{ 'Становище' }}
@endsection

@section('css')
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/opinions/logo_document.css" )!!}
    {!!Html::style("css/opinions/show_opinion.css" )!!}
    {!!Html::style("css/opinions/add_opinion.css" )!!}
    {!!Html::style("css/documents/print.css", array('media' => 'print'))!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        <a href="{!! URL::to('/стопанин/'.$opinion->farmer_id)!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Земеделския стопанин!</a>
        <h4 class="bold title_doc" >ДАННИ ЗА СТАНОВИЩЕ</h4>
        <hr class="my_hr"/>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <fieldset class="big_field ">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-user "></i> ДАННИ НА ЗЕМЕДЕЛСКИЯ СТОПАНИН</span>
                    </div>
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-phar-info"><i class="fa fa-address-card-o "></i> СТАНОВИЩЕ</span>
                    </div>
                </div>

                <div class="small_field_left" style="display: table-cell">
                    @include('opinions.new.show.farmer_info')
                </div>
                <div class="small_field_right" style="display: table-cell">
                    @include('opinions.new.show.add_number')
                </div>
            </div>
            <hr class="my_hr_in"/>

            <div class="col-md-12 row-table-bottom " style="display: table">
                @if($opinion->number_opinion == 0 || $opinion->date_opinion == 0)
                    <div class="small_field_bottom" style="display: table-cell">
                        <p class="bold">
                            <span class="red "><i class="fa fa-warning"></i>ВНИМАНИЕ !</span>
                            След като се добавят изходящ номер и дата, Становището ще може да се редактира само от Администратора!
                        </p>
                    </div>
                    <div class="small_field_bottom" style="display: table-cell">
                        <a href="{!! URL::to('редактирай/становище/'.$opinion->id)!!}" class="fa fa-edit btn btn-danger my_btn my_float_right btn_protocol"> Редактирай ако е необходимо!</a>
                    </div>
                @else
                    <div class="small_field_bottom" style="display: table-cell">
                        <p class="bold">Становището може да се редактира само от Администратора!</p>
                    </div>
                    @if(Auth::user()->admin == 2 )
                        <div class="small_field_bottom" style="display: table-cell">
                            <a href="{!! URL::to('администратор-редактирай/становище/'.$opinion->id)!!}" class="fa fa-edit btn btn-danger my_btn my_float_right btn_protocol"> Администратор Редактирай!</a>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-6 row-table-bottom " style="width: 100%">
                <div  class="archive small_field_bottom print-button" >
                    <button id="btn_archive" class="btn-sm"><i class="fa fa-print"></i> Виж и принтирай за клиента</button>
                </div>
                <div  class="hidden client small_field_bottom print-button" style="display: table-cell">
                    <button id="btn_client" class="btn-sm" ><i class="fa fa-print"></i> За архива</button>
                </div>
                <div  class="archive small_field_bottom print-button" >
                    <a href="{!! URL::to('/opinion-word/'.$opinion->id)!!}" class="fa btn btn-info my_btn ">
                        <i class="fa fa-download"></i> Изтегли докумета</a>
                </div>
            </div>
        </fieldset>
    </div>

    <div id="wrap_in" class="col-md-12">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all">
                <div class="col-md-12_my" id="flip_in">
                    <div class="col-md-12_my" style="margin: 0 auto">
                        @include('opinions.new.show.logo')
                    </div>
                    @include('opinions.new.show.opinion_body')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/opinions/clientDocument.js" )!!}
    {!!Html::script("js/opinions/flipText.js" )!!}
    {!!Html::script("js/opinions/addressFlip.js" )!!}
@endsection