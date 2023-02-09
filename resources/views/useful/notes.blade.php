@extends('layouts.useful')
@section('title')
    {{ 'Бележка каса' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}

    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/qcertificates/body_table.css" )!!}
    {!!Html::style("css/qcertificates/note.css", array('media' => 'print'))!!}

@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">БЕЛЕЖКА КАСА</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/полезно/закони')!!}" class="fa fa-euro btn btn-info my_btn"> Регламенти</a>
        <a href="{!! URL::to('/полезно/закони')!!}" class="fa fa-balance-scale btn btn-info my_btn"> Закони</a>
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
    <fieldset class="form-group" id="form-group-note">
        <div class="wrap_sort">
            {!! Form::open(array('url'=>'/полезно/бележки/подготви', 'method'=>'POST')) !!}
            {!! Form::label('select', 'За какво се издава:', ['class'=>'labels']) !!}
            {!! Form::select('select', $select, $selected, ['class'=>'form-control form-control-my-search inspector_sort ', 'style'=> 'width: 200px;', 'id'=>'select']) !!}
            {{--<span class="bold"> година. </span>&nbsp;&nbsp;--}}
            {!! Form::label('name', ' Попълни името!', ['class'=>'labels']) !!}
            {!! Form::text('name', $selected_name, ['class'=>'form-control search_value', 'size'=>100, 'style'=>'display: inline-block; width: 200px']) !!}

            {!! Form::label('number', 'Брой:', ['class'=>'labels']) !!}
            {!! Form::select('number',
                    array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,),
                    $number, ['class'=>'form-control form-control-my-search inspector_sort ', 'style'=> 'width: 50px;', 'id'=>'number']) !!}
            {!! Form::submit('Подготви за печат!', ['class'=>'fa btn btn-success my_btn']) !!}
            {!!Form::hidden('_token', csrf_token() )!!}
            <a href="{!! URL::to('/полезно/бележки') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn" style="float: right">
                &nbsp; Изчисти!
            </a>
            {!! Form::close() !!}

        </div>
    </fieldset>
    {{--<hr/>--}}
    {{--<h3 style="text-align: center; margin: 20px 0">БЕЛЕЖКА КАСА</h3>--}}
    {{--<hr/>--}}
    <div id="wrap_in_note" class="col-md-12 ">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all_note">
                <div class="col-md-12_my" id="flip_in_note">
                    <div class="col-md-12_my" style="margin: 0 auto">
                        <h3 class="h3_note">Б Е Л Е Ж К А</h3>
                        <p class="top_p">за дейност/услуга, за която се плаща в ОДБХ - Хаково</p>
                        <p class="top_p">гр. Хаково бул. "Освобождение" 57 ИН 176986657 ИН по ЗДДС: BG 176986657</p>
                    </div>

                    {{-- Таблица 1 --}}
                    <table id="first_table_note" style="width:100%;">
                        <tbody>
                        <tr id="first-row_note" >
                            <td class="cell first-row-cell cell_note" style="height: 3cm; width: 6.5cm">
                                <p class="p_info_note" style="margin-bottom: 3px">
                                    Основанието за плащане да се отбележи със знак<br>
                                    "X"
                                </p>
                            </td>
                            <td class="cell first-row-cell cell-top cell_note" style="height: 3cm; width: 1.04cm">
                                <p class="p_info_note" style="margin-bottom: 3px">
                                    Тарифа<br>"X"
                                </p>
                            </td>
                            <td class="cell first-row-cell cell-top cell_note" style="height: 3cm; width: 2.8cm">
                                <p class="p_info_note" style="margin-bottom: 3px">Ценоразпис</p>
                            </td>
                            <td class="cell first-row-cell last_cell cell_note last_cell_note" style="height: 3cm; width: 6cm">
                                <p class="p_content_note" style="margin-bottom: 8px">
                                    <span style="text-transform: uppercase;">{{ $selected_name }}</span>
                                </p>
                                <p class="p_info_note p_bottom_note" style="margin-bottom: 3px">юридическо или физ. лице, булстат, адрес, МОЛ</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    {{-- Таблица 2 --}}
                    <table class="table" id="second_table_note">
                        <thead>
                            <tr>
                            <th style="width: 3.4cm">Вид дейност/услуга</th>
                            <th style="width: 4.5cm">
                                Основание за<br>
                                плащане
                            </th>
                            <th style="width: 1.4cm; padding: 3px">
                                Мярка -<br>
                                бр,кг,тон
                            </th>
                            <th style="width: 1.4cm; padding: 3px">Количес<br>тво</th>
                            <th style="width: 1.4cm">
                                Ед.<br>
                                цена
                            </th>
                            <th style="width: 1.4cm">
                                Стойно<br>ст
                            </th>
                            <th style="width: 1.6cm">
                                ДДС<br>
                                20%
                            </th>
                            <th style="width: 1.6cm; padding: 2px">
                                Обща<br>
                                стойност<br>
                                <span style="font-size: 8px">(за плащане)</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="empty_tr">
                                <td>{{$reason}}</td>
                                <td>{{$text}}</td>
                                <td>бр.</td>
                                <td>{{$number}}</td>
                                <td>{{$sum}}</td>
                                <td>{{number_format($total, 2, ',', '')}}</td>
                                <td></td>
                                <td>{{number_format($total, 2, ',', '')}}</td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><span class="bold">ВСИЧКО:</span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="bold">{{number_format($total, 2, ',', '')}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <br>
                <p class="bottom_p" style="font-weight: bold;">За дейностите/услугите, заплащани по ценоразпис се дължи и 20% ДДС.</p>
                <p class="bottom_p" style="font-weight: bold;">
                    <span style="text-decoration: underline">За плащане по банков път:</span>
                    Получател - Областна дирекция по безопасност на храните -
                </p>
                <p class="bottom_p">
                    Банкова сметка:
                    <span class="bold">BG CECB 97903117 5800 00</span>;
                    Банков код:
                    <span class="bold">CECBBGSF</span>;
                    Банка:
                    <span class="bold">ЦКБ АД</span>
                </p>
                <br>
                <p>
                    Изготвил: <span class="bold">{{ Auth::user()->short_name }}</span>
                    <span class="bold inspector_signature" >Подпис: . . . . . . . . . . . . . . . .</span>
                </p>
                <p class="inspector_info">
                    <span class="inspector_nfo">(име фамилия)</span>
                    <span class="bold inspector_signature" >(подпис)</span>
                </p>
            </div>
        </div>
    </div>
    {{--<hr/>--}}
@endsection

@section('scripts')
@endsection