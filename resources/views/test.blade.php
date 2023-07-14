@extends('layouts.app')

@section('title')
    {{ 'ОДБХ Начало' }}
@endsection

@section('css')
    {!!Html::style("css/home.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">КОНТРОЛ НА УПОТРЕБАТА</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <label><input type="radio" name="gender" value="male"> Male</label>
    <label><input type="radio" name="gender" value="female"> Female</label>

    <br><br>

    <label><input type="radio" name="lang" value="html"> HTML</label>
    <label><input type="radio" name="lang" value="css"> CSS</label>





@endsection
@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {{--{!!Html::script("js/table/jquery.dataTables.js" )!!}--}}
    {{--{!!Html::script("js/table/date-de.js" )!!}--}}
    {{--{!!Html::script("js/table/marketProtocolsTable.js" )!!}--}}
    {{--{!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}--}}
    {{--{!!Html::script("js/date/in_date.js" )!!}--}}

    <script>
        $(document).ready(function(){
            $("#uncheck").click(function(){
                $("[type=radio]") .prop("checked", false);
            });
        });
//        jQuery("#radio_1").attr('checked', 'checked');

        $("#button_1").click(function() {
            $("INPUT[name=type]").val(['1']);
            console.log('ok 1');
        });
//
//        $("#button_2").click(function() {
//            $("INPUT[name=type]").val(['2']);
//            console.log('ok 2');
//        });
//
//        $("#button_3").click(function() {
//            $("INPUT[name=type]").val(['3']);
//            console.log('ok 3');
//        });

    </script>
@endsection