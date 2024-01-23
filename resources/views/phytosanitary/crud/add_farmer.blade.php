@extends('layouts.quality')
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
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавя се Земеделски производител като оператор!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Веднъж направен запис, Номера на Сертификата не може повече да се променя!
                Веднъж направен запис, Сертификата не може да се изтрие, може само да се редактира!
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
                    <h4 class="my_center bold">ДОБАВЯ СЕ ОПЕРАТОР</h4>
                    @include('records.add.object_info')
                </div>
            </div>
        </div>
        {!! Form::open(['url'=>'фито/оператор/фермер/store/'.$farmer->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}

            @include('phytosanitary.crud.forms.number_petition')
            <hr class="my_hr_in"/>
            @include('phytosanitary.crud.forms.entry_new')
            <hr class="my_hr_in"/>
            @include('phytosanitary.crud.forms.data_places')
            <hr class="my_hr_in"/>
            @include('phytosanitary.crud.forms.activity')
            <hr class="my_hr_in"/>
            @include('phytosanitary.crud.forms.common')
            <hr class="my_hr_in"/>
            @include('phytosanitary.crud.forms.contacts')
            <hr class="my_hr_in"/>
            @include('phytosanitary.crud.forms.corresponding')
            <hr class="my_hr_in"/>
            @include('phytosanitary.crud.forms.table')
            <hr class="my_hr_in"/>

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
    {!!Html::script("js/sanitary/date_issue.js" )!!}
    <script>
        function clearRadioButtons()
        {
            var radioEuropa = document.getElementsByName('europa');
            var radioBulgaria = document.getElementsByName('bulgaria');
            var radioOwn = document.getElementsByName('own');

            for (var i=0; i<radioEuropa.length; i++)
            {
                var radioButtonE = radioEuropa[i];
                radioButtonE.checked = false;
            }

            for (var i=0; i<radioBulgaria.length; i++)
            {
                var radioButtonB = radioBulgaria[i];
                radioButtonB.checked = false;
            }

            for (var i=0; i<radioOwn.length; i++)
            {
                var radioButtonO = radioOwn[i];
                radioButtonO.checked = false;
            }
        }
        function clearRadioButtonsOne()
        {
            var radioProduction = document.getElementsByName('production');
            var radioProcessing = document.getElementsByName('processing');
            var radioImport = document.getElementsByName('import');

            var radioExport = document.getElementsByName('export');
            var radioTrade = document.getElementsByName('trade');
            var radioStorage = document.getElementsByName('storage');
            var radioTreatment = document.getElementsByName('treatment');

            for (var i=0; i<radioProduction.length; i++)
            {
                var radioButtonPR = radioProduction[i];
                radioButtonPR.checked = false;
            }

            for (var i=0; i<radioProcessing.length; i++)
            {
                var radioButtonP = radioProcessing[i];
                radioButtonP.checked = false;
            }

            for (var i=0; i<radioImport.length; i++)
            {
                var radioButtonI = radioImport[i];
                radioButtonI.checked = false;
            }

            for (var i=0; i<radioExport.length; i++)
            {
                var radioButtonE = radioExport[i];
                radioButtonE.checked = false;
            }

            for (var i=0; i<radioTrade.length; i++)
            {
                var radioButtonT = radioTrade[i];
                radioButtonT.checked = false;
            }

            for (var i=0; i<radioStorage.length; i++)
            {
                var radioButtonS = radioStorage[i];
                radioButtonS.checked = false;
            }

            for (var i=0; i<radioTreatment.length; i++)
            {
                var radioButtonTR = radioTreatment[i];
                radioButtonTR.checked = false;
            }
        }

        $('#accepted').change(function () {
            var inspector_name=$(this).find('option:selected').attr('inspector_name');
            $('#inspector_name').val(inspector_name);
        });
        $('#checked').change(function () {
            var inspector_checked=$(this).find('option:selected').attr('inspector_checked');
            $('#inspector_checked').val(inspector_checked);
        });
    </script>
@endsection