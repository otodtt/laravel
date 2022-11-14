@extends('layouts.quality')
@section('title')
    {{ 'Редактирай Сертификат!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    @if ($lock == 0)
        <hr class="my_hr"/>
        <div class="alert alert-info my_alert" role="alert">
            <div class="row">
                <h3 class="my_center" style="color: #d9534f;">Редактиране на Сертификат ВЪТРЕШЕН с НОМЕР {{$certificate->internal}}!</h3>
            </div>
        </div>
        <div class="alert alert-danger my_alert" role="alert">
            <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
                <span class="bold">Номера на Сертификата не може повече да се променя, като и инспектора и датата на издаването му!
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

            {!! Form::model($certificate, ['url'=>'контрол/сертификати-вътрешен/'.$certificate->id.'/update', 'method'=>'POST', 'autocomplete'=>'on']) !!}
            
                @include('quality.certificates.domestic.edit.form_edit_certificate')
                <input type="hidden" name="date_issue" value="{{$certificate['date_issue']}}">

                <div class="col-md-6 " >
                    <a href="{{ '/контрол/сертификати-вътрешен/'.$certificate->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към сертификатa!</a>
                </div>
                <div class="col-md-6" id="add_certificate" >
                    {!! Form::submit('Редактирай!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                
            {!! Form::close() !!}
        </div>
        <br/>
        <hr/>
    @else
        <div class="alert alert-danger my_alert" role="alert">
            <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание!</span><br/>
                <span class="bold">Сертификатът е заключен и не може да се редактира повече!
                </span>
            </p>
        </div>
        <div class="col-md-12" style="text-align: center;">
            <a href="{{ '/контрол/сертификати-вътрешен/'.$certificate['id'] }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Назад към сертификата рррр!</a>
        </div>
    @endif
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
    {!!Html::script("js/quality/date_issue.js" )!!}
    <script>

        $('#importer_data').change(function () {
            var name=$(this).find('option:selected').attr('name');
            var address=$(this).find('option:selected').attr('address');
            var vin=$(this).find('option:selected').attr('vin');
            $('#name').val(name);
            $('#address').val(address);
            $('#vin').val(vin);
        });

        $('#id_country').change(function () {
            var for_country_bg=$(this).find('option:selected').attr('for_country_bg');
            var for_country_en=$(this).find('option:selected').attr('for_country_en');
            $('#for_country_bg').val(for_country_bg);
            $('#for_country_en').val(for_country_en);
        });

        // $('#packer_data').change(function () {
        //     var name_of_packer=$(this).find('option:selected').attr('name_of_packer');
        //     var address_of_packer=$(this).find('option:selected').attr('address_of_packer');
        //     $('#name_of_packer').val(name_of_packer);
        //     $('#address_of_packer').val(address_of_packer);
        // });

    </script>
@endsection