@extends('layouts.quality')
@section('title')
    {{ 'Добави Формуляр за съответствие!' }}
@endsection

@section('css')
    {!!Html::style("css/records/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qprotocols/qprotocolsAddEdit.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавяне на ФОРМУЛЯР ЗА СЪОТВЕТСТВИЕ!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">
                Ако е Земеделски стопанин веднъж направен запис, Формуляра няма да може да се коригира по Получател!
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
                    <h4 class="my_center bold">ФОРМУЛЯР ЗА СЪОТВЕТСТВИЕ НА НОВ ЗЕМЕДЕЛСКИ СТОПАНИН</h4>
                </div>
            </div>
        </div>
        {!! Form::open(['url'=>'контрол/формуляр/farmer/store', 'method'=>'POST', 'autocomplete'=>'on']) !!}
            @include('records.add.data_farmer.data_object')

            <hr class="my_hr_in"/>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Адрес на Земеделския Стопанин</legend>
                            @include('records.add.data_farmer.locations')
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Други данни на Земеделския Стопанин</legend>
                            @include('layouts.forms.phone')
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" >
                        <fieldset class="small_field"><legend class="small_legend">Данни за Стопанството</legend>
                            @include('records.add.data_farmer.location_farm')
                        </fieldset>
                    </div>
                </div>
            </div>

            @include('quality.compliance.create.forms.form_create_new')
            <input type="hidden" name="hidden_date" value="{{date('d.m.Y', time())}}">

            <div class="col-md-6 " >
                <a href="{{ '/контрол/протоколи' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към протоколите!</a>
            </div>
            <div class="col-md-6" id="add_certificate" >
                {!! Form::submit('Добави формуляр!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
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
    {!!Html::script("js/location/findLocation.js" )!!}
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