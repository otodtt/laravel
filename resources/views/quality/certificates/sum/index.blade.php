@extends('layouts.quality')
@section('title')
    {{ 'Редактирай Сертификат!' }}
@endsection

@section('css')
    {!! Html::style('css/qcertificates/add_edit.css') !!}
    {!! Html::style('css/date/jquery.datetimepicker.css') !!}
@endsection

@section('content')
    <hr class="my_hr" />
    <a href="{{ '/контрол/сертификат-внос/' . $certificate->id }}"
        class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към сертификатa!</a>
    <hr class="my_hr" />
    <div class="alert alert-infoD my_alertD">
        <div class="row">
            <h2>Сертификат с номер {{ $certificate->import }} / {{ date('d.m.Y', $certificate->date_issue) }} г.</h2>
            <br>
            <h3 class="my_center" style="">Общо килограмите за сертификата са - {{ $total_weight }} кг.</h3>
            <h3 class="my_center" style="">Добавена сума е - {{ $certificate->sum }}</h3>
            @if ($certificate->type_crops == 1)
                <h3 class="my_center" style="">Сертификата е издаден за консумация </h3>
                <br>
                <h4 class="my_center bold" style="">ПРЕДЛОЖЕРНИЕ ЗА СУМА - {{ $sum_import }}</h4>
                <br>
                @if ($sum_import != 0)
                    <h4 class="my_center bold" style="">ПРЕДЛОЖЕРНИЕ ЗА ПРОЦЕНТ - 
                        {{ (($certificate->sum - $sum_import) * 100) / $sum_import }} %
                    </h4>
                @else
                    <h4>ПРЕДЛОЖЕРНИЕ ЗА ПРОЦЕНТ - ТРЯБВА ДА СЕ ИЗЧИСЛИ!</h4>
                @endif
            @elseif ($certificate->type_crops == 2)
                <h3 class="my_center" style="">Сертификата е издаден за ПРЕРАБОТКА </h3>
                <br>
                <h4 class="my_center bold" style="">ПРЕДЛОЖЕРНИЕ ЗА СУМА - {{ $sum_type }}</h4>
                <br>
                @if ($sum_import != 0)
                    <h4 class="my_center bold" style="">ПРЕДЛОЖЕРНИЕ ЗА ПРОЦЕНТ -
                        {{ (($certificate->sum - $sum_type) * 100) / $sum_type }} %
                    </h4>
                @else
                    <h4>ПРЕДЛОЖЕРНИЕ ЗА ПРОЦЕНТ - ТРЯБВА ДА СЕ ИЗЧИСЛИ!</h4>
                @endif
            @else
                <h3 class="my_center" style="">НЕЩО НЕРЕДНО</h3>
            @endif
        </div>
    </div>

    <div class="form-group">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['url' => 'myedit/certificate-import/update/'. $certificate->id,'method' => 'POST','autocomplete' => 'on',]) !!}
            <div class="col-md-6 ">
                <?php
                // ЗА ИМПУТА SUM
                if ($certificate->type_crops == 1) {
                    if ($sum_import == 0) {
                        $sum_for_pay = $certificate->base_sum;
                    } else {
                        $sum_for_pay = $sum_import;
                    }
                } elseif ($certificate->type_crops == 2) {
                    if ($sum_type == 0) {
                        $sum_for_pay = $certificate->base_sum;
                    } else {
                        $sum_for_pay = $sum_type;
                    }
                } else {
                    $sum_for_pay = null;
                }

                // ЗА РАДИО БУТОНА
                if($sum_for_pay != 0) {
                    if((($certificate->sum - $sum_for_pay) * 100) / $sum_for_pay  == 0) {
                        $persent0 = 'checked';
                        $persent1 = '';
                        $persent2 = '';
                    }
                    elseif((($certificate->sum - $sum_for_pay) * 100) / $sum_for_pay  == 42) {
                        $persent0 = '';
                        $persent1 = 'checked';
                        $persent2 = '';
                    }
                    elseif((($certificate->sum - $sum_for_pay) * 100) / $sum_for_pay == 84) {
                        $persent0 = '';
                        $persent1 = '';
                        $persent2 = 'checked';
                    }
                    else {
                        $persent0 = '';
                        $persent1 = '';
                        $persent2 = '';
                    }
                } else {
                    $persent0 = '';
                    $persent1 = '';
                    $persent2 = '';
                }
                ?>
                {!! Form::label('sum', 'Предлагана сума за плащане:', ['class' => 'my_labels']) !!}
                {!! Form::text('sum', $sum_for_pay, [ 'class' => 'hide_numberss form-control form-control-my', 'style' => 'width: 100px; display: inline-block','size' => '3','maxlength' => '10','id' => 'sumField',]) !!}
                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                {!! Form::label('percent0', 'Без добавн процент', ['class' => 'my_labels']) !!}
                {!! Form::radio('percent', '0', $persent0, ['id' => 'percent0', 'class' => 'radioBtnClass']) !!}
                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                
                {!! Form::label('percent1', '42%', ['class' => 'my_labels']) !!}
                {!! Form::radio('percent', '1', $persent1, ['id' => 'percent1', 'class' => 'radioBtnClass']) !!}
                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                
                {!! Form::label('percent2', '84%', ['class' => 'my_labels']) !!}
                {!! Form::radio('percent', '2', $persent2, ['id' => 'percent2', 'class' => 'radioBtnClass']) !!}
                
                <input type="hidden" name="added_sum" value="{{ $certificate->sum }}" id="added_sum">
            </div>
            <div class="col-md-6" id="add_certificate">
                <button type="button" id="loadCheck" class="btn btn-success"> ПРОВЕРИ! </button>
                {!! Form::submit('Редактирай!', ['class' => 'btn btn-danger', 'id' => 'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" id="token">

        {!! Form::close() !!}
    </div>
    <br />
    <br />
    <br />
    <hr class="my_hr" />
    <h3>Въведена сума по фактура<span class="bold"> {{$certificate->sum}}</span> лв.</h3>
    <h3>Въведена базова сума <span class="bold"> {{$certificate->base_sum}}</span> лв.</h3>
    @if($certificate->percent == 0)
    <h3>Процент за начисляване <span class="bold">0 %</span> </h3>
    @elseif ($certificate->percent == 1)
    <h3>Процент за начисляване <span class="bold">42 %</span> </h3>
    @elseif ($certificate->percent == 2)
    <h3>Процент за начисляване <span class="bold">84 %</span> </h3>
    @endif
    
    <?php
    if($total_weight > 30000) {
        $test42 = ($certificate->sum*42)/142;
        $test84 = ($certificate->sum*84)/184;
        $minus42 = $certificate->sum - $test42;
        $minus84 = $certificate->sum - $test84;
    }
    ?>
    @if($total_weight > 30000)
    <hr class="my_hr" />
    <h3>Опитай със сума - {{number_format($minus42, 2, ',', ' ')}} при <span class="bold">42 %</span> </h3>
    <h3>Опитай със сума - {{number_format($minus84, 2, ',', ' ')}} при <span class="bold">84 %</span> </h3>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var loadTweets = function () {
                var real = $('#added_sum').val();
                var base = $('#sumField').val();
                var percent = $('input[name="percent"]:checked').val();
                if(percent == 0){
                    if(real == base) {
                        alert('OK')
                    } else {
                        alert('ПРОВЕРИ ОТНОВО - 0')
                    }
                }
                if(percent == 1){
                    if(real == parseFloat(base) +  parseFloat((base*42)/100)) {
                        alert('OK')
                    } else {
                        alert('ПРОВЕРИ ОТНОВО - 1')
                    }
                }
                if(percent == 2){
                    if(real == parseFloat(base) +  parseFloat((base*84)/100)) {
                        alert('OK')
                    } else {
                        alert('ПРОВЕРИ ОТНОВО - 2')
                    }
                }
                if(percent == undefined){
                    alert('ПРЕДЛОЖЕРНИЕ ЗА СУМА - ТРЯБВА ДА СЕ ИЗЧИСЛИ!!!!')
                }
            }
            $('#loadCheck').on('click', loadTweets)
        });
    </script>
@endsection
