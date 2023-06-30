@extends('layouts.quality')
@section('title')
    {{ 'Добави Идентификация!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавяне на Проверка и Идентификация!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">При Проверка на документи и Идентификация не се издава Сертификат, само бележка!
                Веднъж направен запис не може да се изтрие, може само да се редактира!
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

        {!! Form::open(['url'=>'контрол/идентификация/store', 'method'=>'POST', 'autocomplete'=>'on']) !!}
        
           
            @include('quality.identification.forms.import')
            <input type="hidden" name="export" value="4">

            <div class="col-md-6 " >
                <a href="{{ '/контрол/идентификация' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към проверките!</a>
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
    {!!Html::script("js/confirm/prevent.js" )!!}
    {!!Html::script("js/quality/date_issue.js" )!!}
    <script>
        $('#importer_data').change(function () {
            var en_name=$(this).find('option:selected').attr('name_en');
            var en_address=$(this).find('option:selected').attr('address_en');
            var vin_hidden=$(this).find('option:selected').attr('vin');
            $('#en_name').val(en_name);
            $('#en_address').val(en_address);
            $('#vin_hidden').val(vin_hidden);
        });

        $('#id_country').change(function () {
            var for_country_bg=$(this).find('option:selected').attr('for_country_bg');
            var for_country_en=$(this).find('option:selected').attr('for_country_en');
            $('#for_country_bg').val(for_country_bg);
            $('#for_country_en').val(for_country_en);
        });

        $('#packer_data').change(function () {
            var name_of_packer=$(this).find('option:selected').attr('name_of_packer');
            var address_of_packer=$(this).find('option:selected').attr('address_of_packer');
            $('#name_of_packer').val(name_of_packer);
            $('#address_of_packer').val(address_of_packer);
        });

        $(document).ready(function() {
            var selected = $("#packer_data option:selected").val();

            if (selected == 999) {
                $( ".packer_wrap" ).removeClass( "hidden" );
                $( ".my_br" ).addClass( "hidden" );
            }
            if (selected != 999) {
                $( ".packer_wrap" ).addClass( "hidden" );
                $( ".my_br" ).removeClass( "hidden" );
            }
            $("#packer_data").change(function() {
                var selectedVal = $("#packer_data option:selected").val();
                if (selectedVal == 999) {
                    $( ".packer_wrap" ).removeClass( "hidden" );
                    $( ".my_br" ).addClass( "hidden" );
                }
                if (selectedVal != 999) {
                    $( ".packer_wrap" ).addClass( "hidden" );
                    $( ".my_br" ).removeClass( "hidden" );
                }
            });
        });
    </script>
@endsection