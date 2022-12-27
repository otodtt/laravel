@extends('layouts.useful')
@section('title')
    {{ 'Закони' }}
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
        <h4 class="bold layout-title">БЪЛГАРСКО ЗАКОНОДАТЕЛСТВО</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/полезно/регламенти')!!}" class="fa fa-euro btn btn-info my_btn"> Регламенти</a>
        <span class="fa  btn btn-default my_btn"><i class="fa fa-balance-scale" aria-hidden="true"></i>  Закони</span>
        <a href="{!! URL::to('/полезно/наредби')!!}" class="fa fa-gavel btn btn-info my_btn"> Наредби</a>
        <a href="{!! URL::to('/полезно/заявления')!!}" class="fa fa-pencil-square-o btn btn-info my_btn"> Бланки</a>
        
        @if(Auth::user()->admin == 2 )
            <a href="{!! URL::to('/полезно/неактивни')!!}" class="fa fa-minus btn btn-info my_btn"> Не активни</a>
        @endif
    </div>
    @if(Auth::user()->admin == 2 )
    <div class="btn_add_firm">
        <a href="{!!URL::to('/полезно/добави-документ')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">
            Добави Документ
        </a>
    </div>
    @endif
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
    <h3 style="text-align: center; margin: 20px 0">ЗАКОНИ</h3>
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
                            <a href="{{URL::to('/')}}{{$path}}{{$regulation->filename}}" target="_blank" rel="noopener noreferrer" >
                                <i class="btn btn-default btn-sm fa fa-download" aria-hidden="true"></i>
                            </a>
                        </td>
                        @if(Auth::user()->admin == 2 )
                            <td>
                                <a href="{!! URL::to('/полезно/редактирай-документ/'.$regulation->id)!!}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
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
@endsection