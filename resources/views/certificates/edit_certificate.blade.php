@extends('layouts.certificates')
@section('title')
    {{ 'Редактирай Сертификат!' }}
@endsection

@section('css')
    {!!Html::style("css/certificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 " >
                <h3 class="my_center" >Редактиране на Сертификат!</h3>
            </div>
        </div>
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
        {!! Form::open(['url'=>'сертификати/update/'.$certificate->id , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            @include('certificates.forms.form_edit_certificate')
            <div class="col-md-6 " >
                <a href="{{ '/сертификат/'.$certificate->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> Откажи! Назад към Сертификата!</a>
            </div>
            <div class="col-md-6" >
                {!! Form::submit('Редактирай Сертификат!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
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
        $('input[name="limit_certificate"]').on('click', function(){
            if($('input[name=limit_certificate]:checked').val() == 1){
                $( "#date_end" ).addClass( "hidden" );
                $( "#date_end_label" ).addClass( "hidden" );
            }
            else if($('input[name=limit_certificate]:checked').val() >= 2){
                $( "#date_end" ).removeClass( "hidden" );
                $( "#date_end_label" ).removeClass( "hidden" );

            }
            else{
                $( "#date_end" ).addClass( "hidden" );
                $( "#date_end_label" ).addClass( "hidden" );
            }
        });

        if ($("input[name='limit_certificate']").is(':checked')){
            if($('input[name=limit_certificate]:checked').val() == 1){
                $( "#date_end" ).addClass( "hidden" );
                $( "#date_end_label" ).addClass( "hidden" );
            }
            else if($('input[name=limit_certificate]:checked').val() >= 2){
                $( "#date_end" ).removeClass( "hidden" );
                $( "#date_end_label" ).removeClass( "hidden" );

            }
            else{
                $( "#date_end" ).addClass( "hidden" );
                $( "#date_end_label" ).addClass( "hidden" );
            }
        }
        else{
            $( "#date_end" ).addClass( "hidden" );
            $( "#date_end_label" ).addClass( "hidden" );
        }
    </script>
@endsection