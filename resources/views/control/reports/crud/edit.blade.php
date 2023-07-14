@extends('layouts.objects')
@section('title')
    {{ 'Редактирай Констативен Протокол!' }}
@endsection

@section('css')
    {!!Html::style("css/protocols/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">РЕДАКТИРАНЕ НА ДОКЛАД ОТ ПРОВЕРКА НА ФИРМА:</h4>
                @include('protocols.market.form_add.edit_info')
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
        {!! Form::open(['url'=>'доклад/'.$protocols->id.'/update', 'method'=>'POST', 'id'=>'form']) !!}
            <hr class="my_hr"/>
            @include('control.reports.crud.form.radio_type')
            <hr class="my_hr"/>

            @include('control.reports.crud.form.number_protocol')
            <hr class="my_hr"/>

            @include('control.reports.crud.form.inspectors')
            <hr class="my_hr"/>

            @include('control.reports.crud.form.elements')
            <hr class="my_hr"/>

            @include('control.reports.crud.form.data_protocol')
            <hr class="my_hr"/>

            @include('control.reports.crud.form.edit_example')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/доклад/'.$protocols->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към Доклада!</a>
            </div>

            <div class="col-md-6">
                {!! Form::submit('Редактирай Доклад!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
            <input type="hidden" name="edit" value="1" id="edit">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    {!!Html::script("js/protocols/selectAssay.js" )!!}
    {{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}
    <script>
        $(document).ready(function(){
            $("#unchecked").click(function(){
                $("INPUT[name=activity]").prop("checked", false);
                $("INPUT[name=certificate]").prop("checked", false);
                $("INPUT[name=delivery]").prop("checked", false);
                $("INPUT[name=sales]").prop("checked", false);

                $("INPUT[name=unauthorized]").prop("checked", false);
                $("INPUT[name=first]").prop("checked", false);
                $("INPUT[name=improperly]").prop("checked", false);
                $("INPUT[name=repackaged]").prop("checked", false);
                $("INPUT[name=expired]").prop("checked", false);
                $("INPUT[name=compliance]").prop("checked", false);
                $("INPUT[name=leaflet]").prop("checked", false);
                $("INPUT[name=larger]").prop("checked", false);
                $("INPUT[name=purpose]").prop("checked", false);
                $("INPUT[name=storage]").prop("checked", false);
                $("INPUT[name=warehouse]").prop("checked", false);

                $("INPUT[name=separated]").prop("checked", false);
                $("INPUT[name=access]").prop("checked", false);
                $("INPUT[name=flooring]").prop("checked", false);
                $("INPUT[name=combustible]").prop("checked", false);

                $("INPUT[name=contract]").prop("checked", false);
            });
        });
        $(document).ready(function(){
            $("#check_all").click(function() {
                jQuery('input:radio[name="activity"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="certificate"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="delivery"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="sales"]').filter('[value="1"]').prop('checked', true);

                jQuery('input:radio[name="unauthorized"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="first"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="improperly"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="repackaged"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="expired"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="compliance"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="leaflet"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="larger"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="purpose"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="storage"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="warehouse"]').filter('[value="1"]').prop('checked', true);

                jQuery('input:radio[name="separated"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="access"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="flooring"]').filter('[value="1"]').prop('checked', true);
                jQuery('input:radio[name="combustible"]').filter('[value="1"]').prop('checked', true);

                jQuery('input:radio[name="contract"]').filter('[value="1"]').prop('checked', true);
            });
        });

        $(document).ready(function(){
            $("#check_none").click(function() {
                jQuery('input:radio[name="activity"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="certificate"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="delivery"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="sales"]').filter('[value="3"]').prop('checked', true);

                jQuery('input:radio[name="unauthorized"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="first"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="improperly"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="repackaged"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="expired"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="compliance"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="leaflet"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="larger"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="purpose"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="storage"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="warehouse"]').filter('[value="3"]').prop('checked', true);

                jQuery('input:radio[name="separated"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="access"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="flooring"]').filter('[value="3"]').prop('checked', true);
                jQuery('input:radio[name="combustible"]').filter('[value="3"]').prop('checked', true);

                jQuery('input:radio[name="contract"]').filter('[value="3"]').prop('checked', true);
            });
        });
    </script>
@endsection