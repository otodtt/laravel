@extends('layouts.quality')
@section('title')
    {{ 'Добави Формуляр за съответствие!' }}
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
            <h3 class="my_center" style="color: #d9534f;">Добавяне на ФОРМУЛЯР ЗА СЪОТВЕТСТВИЕ!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">
                Провери внимателно данните! Ако има грешки, редактирай данните на Търговеца и тогава добави Формуляра!
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
                    <h4 class="my_center bold">ФОРМУЛЯР ЗА СЪОТВЕТСТВИЕ НА НОВ ТЪРГОВЕЦ</h4>
                </div>
            </div>
        </div>
        {!! Form::open(['url'=>'контрол/формуляр/нов-търговец/store', 'method'=>'POST', 'autocomplete'=>'on']) !!}

            @include('quality.compliance.create.forms.form_new_trader')
            <input type="hidden" name="hidden_date" value="{{date('d.m.Y', time())}}">

            <div class="col-md-6 " >
                <a href="{{ '/контрол/формуляри' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към формулярите!</a>
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
    {!!Html::script("js/confirm/prevent.js" )!!}
    <script>
        $('#inspectors').change(function () {
            var inspector_name=$(this).find('option:selected').attr('inspector_name');
            $('#inspector_name').val(inspector_name);
        });

    </script>
@endsection