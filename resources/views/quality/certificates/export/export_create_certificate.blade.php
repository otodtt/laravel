@extends('layouts.quality')
@section('title')
    {{ 'Добави Сертификат!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавяне на Сертификат за ИЗНОС!</h3>
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

        {!! Form::open(['url'=>'контрол/сертификати-износ/store', 'method'=>'POST', 'autocomplete'=>'on']) !!}

            @include('quality.certificates.export.forms.form_create_certificate')

            <div class="col-md-6 " >
                <a href="{{ '/контрол/сертификати-износ' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към сертификатите!</a>
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

//        НЕ ИЗТРИВАЙ
//        $('input[name="what_7"]').on('click', function(){
            // if($('input[name=what_7]:checked').val() == 0){
            //     $( "#show_type" ).addClass( "hidden" );
            //     $( "#p_internal_yes" ).addClass( "hidden" );
            //     $( "#p_import_yes" ).addClass( "hidden" );
            //     $( "#p_export_yes" ).addClass( "hidden" );
            // }
            // else if($('input[name=what_7]:checked').val() == 1){
            //     $( "#show_type" ).removeClass( "hidden" );
            //     $( "#p_internal_yes" ).removeClass( "hidden" );
            //     $( "#p_internal_no" ).addClass( "hidden" );

            //     $( "#p_import_yes" ).addClass( "hidden" );
            //     $( "#p_import_no" ).removeClass( "hidden" );
            //     $( "#p_export_yes" ).addClass( "hidden" );
            //     $( "#p_export_no" ).removeClass( "hidden" );

            //     $( "#number_internal" ).removeClass( "hidden" );
            //     $( "#number_import" ).addClass( "hidden" );
            //     $( "#number_export" ).addClass( "hidden" );
            // }
            // else if($('input[name=what_7]:checked').val() == 2){
            //     $( "#show_type" ).removeClass( "hidden" );
            //     $( "#p_import_yes" ).removeClass( "hidden" );
            //     $( "#p_import_no" ).addClass( "hidden" );

            //     $( "#p_internal_yes" ).addClass( "hidden" );
            //     $( "#p_internal_no" ).removeClass( "hidden" );
            //     $( "#p_export_yes" ).addClass( "hidden" );
            //     $( "#p_export_no" ).removeClass( "hidden" );

            //     $( "#number_internal" ).addClass( "hidden" );
            //     $( "#number_import" ).removeClass( "hidden" );
            //     $( "#number_export" ).addClass( "hidden" );
            // }
            // else if($('input[name=what_7]:checked').val() == 3){
            //     $( "#show_type" ).removeClass( "hidden" );
            //     $( "#p_export_yes" ).removeClass( "hidden" );
            //     $( "#p_export_no" ).addClass( "hidden" );

            //     $( "#p_internal_yes" ).addClass( "hidden" );
            //     $( "#p_internal_no" ).removeClass( "hidden" );
            //     $( "#p_import_yes" ).addClass( "hidden" );
            //     $( "#p_import_no" ).removeClass( "hidden" );

            //     $( "#number_internal" ).addClass( "hidden" );
            //     $( "#number_import" ).addClass( "hidden" );
            //     $( "#number_export" ).removeClass( "hidden" );
            // }
            // else{
            //     $( "#show_type" ).addClass( "hidden" );
            // }
//        });

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