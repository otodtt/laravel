@extends('layouts.phyto')
@section('title')
    {{ 'Добави в регистъра!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/records/add_edit.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавяне на нов земедлец към регистъра на професионалните оператори!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">
                Данните са за физическо лице и ще бъдат добавени към регистрираните Земеделски стопани! Ще бъде създаен нов ЗЕМЕДЕЛСКИ СТОПАНИН!
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
        {!! Form::open(['url'=>'фито/оператор/нов/store', 'method'=>'POST', 'autocomplete'=>'new-password']) !!}
            @include('phytosanitary.crud.forms.form_create_farmer')
            <input type="hidden" name="hidden_date" value="{{date('d.m.Y', time())}}">

            <div class="col-md-6 " >
                <a href="{{ '/фито/търси-оператор' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към търси</a>
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
{{--    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}--}}
    {!!Html::script("js/phito/findLocation.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}
{{--    {!!Html::script("js/quality/date_issue.js" )!!}--}}
    <script>
//        $('#id_country').change(function () {
//            var for_country_bg=$(this).find('option:selected').attr('for_country_bg');
//            var for_country_en=$(this).find('option:selected').attr('for_country_en');
//            $('#for_country_bg').val(for_country_bg);
//            $('#for_country_en').val(for_country_en);
//        });

    </script>
@endsection