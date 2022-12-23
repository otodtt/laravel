@extends('layouts.useful')
@section('title')
    {{ 'Регламенти и директиви' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">РЕГЛАМЕНТИ И ДИРЕКТИВИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa  btn btn-default my_btn"><i class="fa fa-euro " aria-hidden="true"></i>  Регламенти</span>
        <a href="{!! URL::to('/полезно/закони')!!}" class="fa fa-balance-scale btn btn-info my_btn"> Закони</a>
        <a href="{!! URL::to('/полезно/наредби')!!}" class="fa fa-gavel btn btn-info my_btn"> Наредби</a>
        <a href="{!! URL::to('/полезно/Бланки')!!}" class="fa fa-tags btn btn-info my_btn"> Бланки</a>
    </div>
    @if(Auth::user()->admin == 2 )
    <div class="btn_add_firm">
        <a href="{!!URL::to('/полезно/добави-документ')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">
            Добави Документ
        </a>
    </div>
    @endif
    {{--<hr/>--}}
    {{--<div class="btn-group" >--}}
        {{--<span class="fa fa-arrow-down btn btn-default my_btn"> Сетификати/Внос</span>--}}
        {{--<a href="{!! URL::to('/контрол/сертификати-износ')!!}" class="fa fa-arrow-up btn btn-info my_btn"> Сетификати/Износ</a>--}}
        {{--<a href="{!! URL::to('/контрол/сертификати-вътрешен')!!}" class="fa fa-retweet btn btn-info my_btn"> Вътрешни</a>--}}
    {{--</div>--}}
    <hr/>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <fieldset class="form-group">
        <div class="wrap_sort">

        </div>
    </fieldset>
    <hr/>
    <h3 style="text-align: center; margin: 20px 0">ЕВРОПЕЙСКО ЗАКОНОДАТЕЛСТВО</h3>
    <hr/>
    <div class="row" style="">
        <div class="col-lg-12">
            <table>
                <tbody>
                <?php $n = 1; ?>
                @foreach($regulations as $regulation)
                    <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.45);">
                        <td style="padding: 10px"><?= $n++ ?></td>
                        <td>{{$regulation->document_name}}</td>
                        <td>
                            <a href="{{$regulation->document_path}}{{$regulation->filename}}" target="_blank" rel="noopener noreferrer" download="{{$regulation->filename}}">
                                <i class="btn btn-default btn-sm fa fa-download" aria-hidden="true"></i>
                            </a>
                        </td>
                        @if(Auth::user()->admin == 2 )
                            <td>
                                <a href="{!! URL::to('/полезно/редактирай-документ/'.$regulation->id)!!}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{!! URL::to('/полезно/редактирай-документ')!!}"  class="btn btn-danger btn-sm">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<hr/>--}}
@endsection

@section('scripts')
    {{--{!!Html::script("js/table/jquery-1.11.3.min.js" )!!}--}}
    {{--{!!Html::script("js/table/jquery.dataTables.js" )!!}--}}
    {{--{!!Html::script("js/quality/QcertificatesTable.js" )!!}--}}

    {{--{!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}--}}
    {{--{!!Html::script("js/date/in_date.js" )!!}--}}
    {{--<script>--}}
        {{--var selectedVal = $("#years option:selected").val();--}}
        {{--var getYear = document.getElementById("get_year").value = selectedVal;--}}
    {{--</script>--}}
@endsection