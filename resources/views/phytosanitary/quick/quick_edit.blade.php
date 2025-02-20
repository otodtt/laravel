@extends('layouts.phyto')
@section('title')
    {{ 'Добави Оператор!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    <style>
        .table {
            width: 95%;
            /*border: 1px solid black;*/
            /*float: right;*/
            /*margin-right: 50px;*/
        }
        .table>thead>tr>th {
            /*border: 1px solid black;*/
        }
        th {
            /*border: 1px solid black;*/
            text-align: center;
        }
        .first {
            width: 45%;
        }
        .second {
            width: 20%;
        }
        .third {
            width: 35%;
        }
        tbody {
            /*border: 1px solid black;*/
        }
        td {
            /*border: 1px solid black;*/
        }
        .center {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <?php //echo(count($is_farmer)) ?>
    {{--@if(count($is_farmer) == 0 )--}}
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Редактират се оператор {{$operator->name_operator}}! Само за таблицата!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Веднъж направен запис,  Регистрационния номер не може повече да се променя!
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
        {!! Form::model($operator, ['url'=>'фито/таблица/table_edit_operator/'.$operator->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
            <textarea id="w3review" name="w3review" rows="1" cols="100"></textarea>
            {{--@include('phytosanitary.quick.select_option')--}}
            <h4>ДАННИ ЗА ЗАЯВЛЕНИЕТО ОТ ТАБЛИЦАТА</h4>
            @include('phytosanitary.quick.number_petition')

            <input type="hidden" name="hidden_date" value="{{date('d.m.Y', time())}}">

            <div class="col-md-6 " >
                <a href="{{ '/фито/регистър-оператори' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към регистъра!</a>
            </div>
            <div class="col-md-6" id="add_certificate" >
                {!! Form::submit('Добави и продължи!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
            
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}
    {!!Html::script("js/sanitary/date_traders.js" )!!}

    <script>
        $(document).ready(function(){
            $("#trader").click(function(){
                $('.archive').addClass('hidden');
                $('.client').removeClass('hidden');
            });

            $("#farmer").click(function(){
                $('.client').addClass('hidden');
                $('.archive').removeClass('hidden');
            });
        });

        if(document.getElementById('trader').checked) {
            $('.archive').addClass('hidden');
            $('.client').removeClass('hidden');
        }
//        else if(document.getElementById('trader').unchecked) {
//            $('.client').addClass('hidden');
//            $('.archive').removeClass('hidden');
//        }

        if(document.getElementById('farmer').checked) {
            $('.client').addClass('hidden');
            $('.archive').removeClass('hidden');
        }
    </script>

@endsection