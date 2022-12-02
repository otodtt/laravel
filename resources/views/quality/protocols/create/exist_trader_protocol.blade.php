@extends('layouts.quality')
@section('title')
    {{ 'Добави Констативен Протокол!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qprotocols/qprotocolsAddEdit.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавяне на КОНСТАТИВЕН ПРОТОКОЛ!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">
                Провери внимателно данните! Ако има грешки, редактирай данните на Търговеца и тогава добави Конатативен Протокол!
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
                    <h4 class="my_center bold">КОНСТАТИВЕН ПРОТОКОЛ НА</h4>
                    <p >
                        Име на Фирма: <span class="bold">{!! $trader->trader_name !!}</span><br>
                        С адрес: <span class="bold">{!! $trader->trader_address !!}</span>;
                        С ЕИК/Булстат: <span class="bold">{!! $trader->trader_vin !!}</span>
                    </p>
                </div>
            </div>
        </div>
        {!! Form::open(['url'=>'контрол/протоколи/търговец/'.$trader->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}

            @include('quality.protocols.create.forms.form_create_exist_farmer')
            <input type="hidden" name="hidden_date" value="{{date('d.m.Y', time())}}">

            <div class="col-md-6 " >
                <a href="{{ '/контрол/протоколи' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към протоколите!</a>
            </div>
            <div class="col-md-6" id="add_certificate" >
                {!! Form::submit('Добави протокол!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
            
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
{{--    {!!Html::script("js/quality/date_issue.js" )!!}--}}
    <script>
        function clearRadioButtons()
        {
            var radioButtonArray = document.getElementsByName('matches');

            for (var i=0; i<radioButtonArray.length; i++)
            {
                var radioButton = radioButtonArray[i];
                radioButton.checked = false;
            }
        }
        $('#crops').change(function () {
            var crops_name=$(this).find('option:selected').attr('crops_name');
            $('#crops_name').val(crops_name);
        });
        $('#inspectors').change(function () {
            var inspector_name=$(this).find('option:selected').attr('inspector_name');
            $('#inspector_name').val(inspector_name);
        });

        var test = $( "#type option:selected" ).text();
        if (test == 'ДРУГО') {
            $( "#different_row" ).removeClass( "hidden" );
        } else {
            $( "#different_row" ).addClass( "hidden" );
        }

        function run() {
            var different = document.getElementById('type').value;
            if (different == 999) {
                $( "#different_row" ).removeClass( "hidden" );
            }
            else {
                $( "#different_row" ).addClass( "hidden" );
            }
        }
    </script>
@endsection