@extends('layouts.quality')
@section('title')
    {{ 'Формуляр за съответствие' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
{{--    {!!Html::style("css/table/jquery.dataTables.css" )!!}--}}
{{--    {!!Html::style("css/table/table_firms.css " )!!}--}}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/qprotocols/body_protocol.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">ФОРМУЛЯР ЗА СЪОТВЕТСТВИЕ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        {{--<span class="fa  btn btn-default my_btn"><i class="fa fa-file-powerpoint-o " aria-hidden="true"></i>  Констативни протоколи</span>--}}
        <a href="{!! URL::to('/контрол/протоколи')!!}" class="fa fa-check-square btn btn-info my_btn"> Констативни протоколи</a>
        <a href="{!! URL::to('/контрол/формуляри')!!}" class="fa fa-check-square btn btn-info my_btn"> Формуляри за съответствие</a>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/формуляри/търси')!!}" class="fa fa-arrow-circle-right btn btn-default my_btn">
            Добави НОВ Формуляр</a>
        <a href="{!!URL::to('/контрол/нерегламентиран/формуляр')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">
            Добави Формуляр на нерегламентиран</a>
    </div>
    <hr/>

    <div class="info-wrap" style="margin-top: 30px">
        <h4 class="bold title_doc" style="text-align: center; margin: 0 0 20px 0">
            ФОРМУЛЯР ЗА СЪОТВЕТСТВИЕ С ДАТА<br>
            {{date('d.m.Y', $compliance->date_compliance) }}
        </h4>

        <hr class="my_hr"/>
        <fieldset class="big_field ">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_right top_info" style="display: table-cell" >
                        @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                            <span class="span-firm green_info"><i class="fa fa-user "></i> ДАННИ НА ЗЕМЕДЕЛСКИ СТОПАНИН</span>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                            <span class="firm_info"><i class="fa fa-user "></i> ДАННИ НА ТЪРГОВЕЦ</span>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                            <span class="span-firm-danger red"><i class="fa fa-user "></i> ДАННИ НА НЕРЕГЛАМЕНТИРАН ТЪРГОВЕЦ</span>
                        @endif
                    </div>
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-phar-info"><i class="fa fa-leaf "></i> ДАННИ НА ПРОДУКТИТЕ</span>
                    </div>
                </div>
                <div style="display: table-row">
                    <div class="small_field_left " style="display: table-cell">
                        @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                            <a href="{!!URL::to('/стопанин/'.$compliance->farmer_id)!!}" class="fa fa-arrow-circle-right btn btn-success my_btn">
                                Към Земеделския Стопанин</a>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                            <a href="{!!URL::to('/контрол/търговци/'.$compliance->trader_id.'/show')!!}" class="fa fa-arrow-circle-right btn btn-success my_btn">
                                Към Фирмата Търговец</a>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                        @endif

                        <hr class="my_hr_in"/>
                        <p >Фирма/ЗС:
                            @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$compliance->farmer_name }}</span>
                            @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$compliance->trader_name }}</span>
                            @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                                <span class="bold" style="text-transform: uppercase">{{$compliance->unregulated_name }}</span>
                            @endif
                        </p>
                        <hr class="my_hr_in"/>
                        <p >Адрес:
                            @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                                <span class="bold" >{{$compliance->farmer_address}}</span>
                            @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                                <span class="bold">{{$compliance->trader_address }}</span>
                            @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                                <span class="bold" >{{$compliance->unregulated_address }}</span>
                            @endif
                        </p>
                        <hr class="my_hr_in"/>
                        <p >Представител:<span class="bold" style="text-transform: uppercase">{{$compliance->name_trader }}</span></p>
                    </div>
                    <div class="small_field_right" style="display: table-cell">
                        @foreach($articles as $article)
                        <?php
                        if($article->class == 1) {
                            $class = 'I клас';
                        }
                        elseif ($article->class == 2) {
                            $class = 'II клас';
                        }
                        elseif ($article->class == 3) {
                            $class = 'OПС';
                        }
                        elseif ($article->class == 127) {
                            $class = '---';
                        }
                        else {
                            $class = '';
                        }
                        ?>
                        <p style="font-size: 13px" >
                            Стока: <span class="bold" style="display: inline-block; ">{{ $article->product }}</span> -
                            Произход: <span  class="bold" style="display: inline-block; ">{{ $article->country }}</span> -
                            Клас: <span  class="bold" style="display: inline-block; ">{{ $class }}</span> -
                            Количество: <span  class="bold" style="display: inline-block; ">{{ $article->quantity }} кг.</span>
                        </p>
                        <hr class="my_hr_in"/>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="my_hr_in"/>

            <div class="col-md-12 row-table-bottom " style="display: table">
                <div style="display: table-row">
                    <div class="small_field_bottom top_info" style="display: table-cell" >
                        <span class=""><i class="fa fa-database "></i> ДРУГИ ДАННИ</span>
                    </div>
                </div>
                <div class="small_field_bottom" style="display: table-cell">
                    <div class="col-md-6">
                        <p >Обект на контрол: <span class="bold" style="text-transform: none">{{$compliance->object_control}}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Обяснение:
                            @if($compliance->notes == 1)
                                <span class="bold">"ДА"</span> - отговаря на изискванията за качество
                            @elseif($compliance->notes == 0)
                                <span class="bold">"НЕ"</span> - не отговаря на изискванията (над допустимите отклонения)
                            @else
                                ---
                            @endif
                        </p>
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="col-md-6">
                        <p >Инспектор: <span class="bold" style="text-transform: uppercase">{{ $compliance->inspector_name }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Дата на издаване: <span class="bold" style="text-transform: none">{{ date( 'd.m.Y', $compliance->date_compliance) }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 row-table-bottom " style="display: table">
                <div class="small_field_bottom" style="display: table-cell">
                    <div class="col-md-6">
                        <div class="btn_add_edit">
                            @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                                <a href="{!!URL::to('/контрол/формуляри/фермер/edit/'.$compliance->id)!!}" class="fa fa-edit btn btn-danger my_btn">Редактирай Формуляра</a>
                            @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                                <a href="{!!URL::to('/контрол/формуляри/търговец/edit/'.$compliance->id)!!}" class="fa fa-edit btn btn-danger my_btn">Редактирай Формуляра</a>
                            @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                                <a href="{!!URL::to('/контрол/нерегламентиран/формуляр/edit/'.$compliance->id)!!}" class="fa fa-edit btn btn-danger my_btn">Редактирай Формуляра</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="btn_add_edit" style="text-align: right">
                            <a href="{!!URL::to('/контрол/артикули/'.$compliance->id.'/0/add')!!}" class="fa fa-edit btn btn-success my_btn">Редактирай Продуктите</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 row-table-bottom " style="display: table">
                <div class="small_field_bottom" style="display: table-cell">
                    @if($compliance->notes == 1)
                        <div class="col-md-12">
                            <p >
                                Маркирано е с <span class="bold">"ДА"</span> - отговаря на изискванията за качество
                                и няма издаден Констативен Протокол.
                            </p>
                        </div>
                    @endif
                    @if($compliance->notes == 0)
                        @if($compliance->protocol_id > 1)
                            <p >
                                Има издаден Констативен Протокол с
                                Номер: <span class="bold">{{$compliance->number_protocol}}</span> и
                                Дата: <span class="bold">{{date('d.m.Y', $compliance->date_protocol)}}</span> г.
                                <a href="{!!URL::to('/контрол/формуляри/edit_protocol/'.$compliance->id)!!}" class="fa fa-edit btn btn-primary my_btn"> Промени ако е необходимо!</a>
                            </p>

                        @else
                            <div class="col-md-12">
                            <p class="description">
                                Маркирано е с <span class="bold">"НЕ"</span> - не отговаря на изискванията за качество.
                                Ако има издаен констативен протокол, може да се добави тук.
                            </p>
                            <hr class="my_hr_in"/>
                            @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error  }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(isset($errors_protocol) && strlen($errors_protocol)>0)
                                <div class="alert alert-danger">
                                    {{ $errors_protocol  }}
                                    @if($count > 1)
                                        @foreach($protocol as $value)
                                            <div class="row">
                                                <div class="col-md-6" style="margin-top: 5px">
                                                    <p class="bold">
                                                        Номер КП {{$value['number_protocol']}} с Дата: {{date('d.m.Y', $value['date_protocol'])}}
                                                        @if($value['farmer_id'] > 0 && $value['trader_id'] == 0 && $value['unregulated_id'] == 0)
                                                            Издаен на: {{$value['farmer_name']}}
                                                        @elseif($value['farmer_id'] == 0 && $value['trader_id'] > 0 && $value['unregulated_id'] == 0)
                                                            Издаен на: {{$value['trader_name']}}
                                                        @elseif($value['farmer_id'] == 0 && $value['trader_id'] == 0 && $value['unregulated_id'] > 0)
                                                            Издаен на: {{$value['unregulated_name']}}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-6" style="padding: 0; margin: 0">
                                                    {!! Form::open(['url'=>'контрол/формуляри/this_protocol/'.$value['id'] , 'method'=>'POST', 'autocomplete'=>'on']) !!}
                                                        {!! Form::submit('Даобави Този Протокол ', ['class'=>'btn btn-success btn-sm', 'id'=>'submit-finish']) !!}
                                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                                        <input type="hidden" name="number_protocol" value="{{$value['number_protocol']}}" id="number_protocol">
                                                        <input type="hidden" name="date_protocol" value="{{$value['date_protocol']}}" id="date_protocol">
                                                        <input type="hidden" name="compliance_id" value="{{ $compliance->id }}" id="compliance_id">
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                            {{--{{$count}}--}}
                            {!! Form::open(['url'=>'контрол/формуляри/add_protocol/'.$compliance->id , 'method'=>'POST', 'autocomplete'=>'on']) !!}
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php
                                        if(isset($number_protocol) && !empty($number_protocol)){
                                            $protocol_number = $number_protocol;
                                        }
                                        else{
                                            $protocol_number = null;
                                        }
                                        ?>
                                        <label for="number_protocol" style="display: inline-block">Номер:</label>
                                        {!! Form::number('number_protocol', $protocol_number,  ['class'=>'hide_number form-control form-control-my', 'style'=>'width: 150px; display: inline-block', 'size'=>'5', 'maxlength'=>'10']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <?php
                                        if(isset($date_protocol) && !empty($date_protocol)){
                                            $protocol_date = $date_protocol;
                                        }
                                        else{
                                            $protocol_date = null;
                                        }
                                        ?>
                                        {!! Form::text('date_protocol', $protocol_date, ['class'=>'form-control form-control-my date_certificate',
                                        'id'=>'date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                                    </div>

                                    <div class="col-md-2" id="finish_stock" style="text-align: center; margin-top: 10px;">
                                        {!! Form::submit('Даобави Протокол', ['class'=>'btn btn-success btn-sm', 'id'=>'submit-finish']) !!}
                                    </div>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                    <input type="hidden" name="compliance_id" value="" id="finish">
                                </div>
                            {!! Form::close() !!}
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </fieldset>
    </div>

    <div id="wrap_in" class="col-md-12 ">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all">
                <div class="col-md-12_my" id="flip_in">
                    <div class="col-md-12_my" style="margin: 0 auto; padding: 50px 0 0 0">
                        <p >Поделение на : <span class="bold" style="text-transform: none">{{$index[0]['authority_bg'] }}</span></p>

                        <div class="row" style="margin: 30px 0 20px 0">
                            <h5 class="bold title_doc" style="text-align: center; margin: 10px 0 20px 0">
                                ФОРМУЛЯР ЗА ПРОВЕРКА ЗА СЪОТВЕТСТВИЕ
                            </h5>
                            <p>
                                <span class="bold">Дата: {{date( 'd.m.Y', $compliance->date_compliance) }}</span>
                                <span class="bold" style="float: right">Инспектор: {{ $compliance->inspector_name }}</span>
                            </p>
                            <p>
                                Фирма/ЗС:
                                @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                                    <span class="bold" style="text-transform: uppercase">{{$compliance->farmer_name }}</span>
                                @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                                    <span class="bold" style="text-transform: uppercase">{{$compliance->trader_name }}</span>
                                @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                                    <span class="bold" style="text-transform: uppercase">{{$compliance->unregulated_name }}</span>
                                @endif
                            </p>
                            <p >С адрес:
                                @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                                    <span class="bold" >{{$compliance->farmer_address}}</span>
                                @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                                    <span class="bold">{{$compliance->trader_address }}</span>
                                @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                                    <span class="bold" >{{$compliance->unregulated_address }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="row" style="margin: 30px 0 20px 0">
                            <p>
                                Обект на контрол:
                                <span class="bold">{{ $compliance->object_control  }}</span>
                            </p>
                            <p style="margin-top: 20px">
                                Търговец на контролирания обект:
                                <span class="bold">{{ $compliance->name_trader  }}</span>
                            </p>
                        </div>
                    </div>
                    {{----}}
                    <div class="row" style="margin: 30px 0 20px 0">
                        <table class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
                            <thead>
                                <tr>
                                    <th class="first">N</th>
                                    <th>Продукт</th>
                                    <th>Страна на произход</th>
                                    <th>Обявен клас на качество</th>
                                    <th>Количество /кг./</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1; ?>
                                @foreach($articles as $article)
                                    <?php
                                    if($article->class == 1) {
                                        $class = 'I клас';
                                    }
                                    elseif ($article->class == 2) {
                                        $class = 'II клас';
                                    }
                                    elseif ($article->class == 3) {
                                        $class = 'OПС';
                                    }
                                    elseif ($article->class == 127) {
                                        $class = '---';
                                    }
                                    else {
                                        $class = '';
                                    }
                                    ?>
                                    <tr>
                                        <td class="first"><?= $n++ ?></td>
                                        <td class="">{{$article->product}}</td>
                                        <td class="">{{$article->country}}</td>
                                        <td class="class">{{$class}}</td>
                                        <td class="last_td">{{$article->quantity}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row" style="margin: 30px 0 20px 0">
                        <p >Обяснение:
                            @if($compliance->notes == 1)
                                <span class="bold">"ДА"</span> - отговаря на изискванията за качество
                            @elseif($compliance->notes == 0)
                                <span class="bold">"НЕ"</span> - не отговаря на изискванията за качество (над допустимите отклонения)
                            @else
                                ---
                            @endif
                        </p>
                    </div>

                    <div class="row" style="margin: 30px 0 20px 0">
                        @if($compliance->notes == 0)
                            @if($compliance->number_protocol == 0)
                                Няма издаден Констативен протокол.
                            @else
                                <p >
                                    Има издаден Констативен Протокол с
                                    Номер: <span class="bold">{{$compliance->number_protocol}}</span> и
                                    Дата: <span class="bold">{{date('d.m.Y', $compliance->date_protocol)}}</span> г.
                                    <a href="{!!URL::to('/контрол/протоколи/'.$compliance->protocol_id.'/show')!!}" class="fa fa-binoculars btn btn-info my_btn"> Виж Протокола</a>
                                </p>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/quality/QcertificatesTable.js" )!!}

    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}

@endsection