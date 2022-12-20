@extends('layouts.quality')
@section('title')
    {{ 'Редактиране на добавени констативни протоколи!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qprotocols/qprotocolsAddEdit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Редактиране на добавени констативни протоколи!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">
                Провери внимателно данните! Ако има грешки, редактирай данните на Земеделския Стопанин и тогава добави Формуляр за Съответствие!
            </span>
        </p>
    </div>
    <div class="form-group">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="alert alert-info my_alert" role="alert">
            <div class="row">
                <div class="col-md-12 ">
                    <h4 class="my_center bold">ФОРМУЛЯР ЗА СЪОТВЕТСВИЕ НА </h4>
                    {{--@include('records.add.object_info')--}}
                    <p >Фирма/ЗС:
                        @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                            <span class="bold" style="text-transform: uppercase">{{$compliance->farmer_name }}</span>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                            <span class="bold" style="text-transform: uppercase">{{$compliance->trader_name }}</span>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                            <span class="bold" style="text-transform: uppercase">{{$compliance->unregulated_name }}</span>
                        @endif
                    </p>
                    {{--<hr class="my_hr_in"/>--}}
                    <p >Адрес:
                        @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                            <span class="bold" >{{$compliance->farmer_address}}</span>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                            <span class="bold">{{$compliance->trader_address }}</span>
                        @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                            <span class="bold" >{{$compliance->unregulated_address }}</span>
                        @endif
                    </p>
                    <p>
                        Протокол с номер <span class="bold" >{{$compliance->number_protocol }}</span> и
                        дата: <span class="bold" >{{ date('d.m.Y', $compliance->date_protocol) }}</span>
                    </p>
                    {{--<hr class="my_hr_in"/>--}}
                </div>
            </div>
        </div>
        <div class="row" style="text-align: center; margin-bottom: 20px">
            <p class="bold">ТЪРСИ ПО НОМЕР НА ПРОТОКОЛ</p>
        </div>
        <div class="row" style=" margin-bottom: 20px; margin-top: 20px; text-align: center">
            {!! Form::open(['url'=>'контрол/формуляри/edit_protocol/'.$compliance->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}

                <div class="row" >
                    <div class="col-md-3">
                        <label for="number_protocol" style="display: inline-block">Номер:</label>
                        <?php
                        if(isset($number_protocol) && !empty($number_protocol)){
                            $protocol_number = $number_protocol;
                        }
                        else{
                            $protocol_number = null;
                        }
                        ?>
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
                    <div class="col-md-6" id="add_certificate" >
                        {!! Form::submit('Търси протокол!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
                    </div>
                </div>
                <input type="hidden" name="search" value="1" id="search">

                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
            {!! Form::close() !!}
        </div>
            <hr class="my_hr"/>
        <div class="row" style="text-align: left; margin-bottom: 20px; margin-left: 50px">
            <p class="bold">{{$errors_protocol}}</p>
            @if($count > 0)

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
                            {!! Form::open(['url'=>'контрол/формуляри/update_protocol/'.$value['id'] , 'method'=>'POST', 'autocomplete'=>'on', 'onsubmit'=>"return confirm('Наистина ли искате да промените този протокол?');"]) !!}
                                {!! Form::submit('Промени с Този Протокол ', ['class'=>'btn btn-success btn-sm', 'id'=>'submit-finish']) !!}
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                <input type="hidden" name="number_protocol" value="{{$value['number_protocol']}}" id="number_protocol">
                                <input type="hidden" name="date_protocol" value="{{$value['date_protocol']}}" id="date_protocol">
                                <input type="hidden" name="compliance_id" value="{{ $compliance->id }}" id="compliance_id">
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>

    </div>
    <div class="col-md-6 " >
        <a href="{{ '/контрол/формуляри' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към формулярите!</a>
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}

    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    <script>
        $('#inspectors').change(function () {
            var inspector_name=$(this).find('option:selected').attr('inspector_name');
            $('#inspector_name').val(inspector_name);
        });
    </script>
@endsection