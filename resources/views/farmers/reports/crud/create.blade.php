@extends('layouts.farmers')
@section('title')
    {{ 'Добави Доклад от проверка!' }}
@endsection

@section('css')
    {!!Html::style("css/records/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    {{--<div class="col-md-4 " style="margin-bottom: 20px">--}}
        {{--<a href="{{ '/стопанин/'.$farmer->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">--}}
            {{--Откажи! Назад към Земедлския Стопанин!--}}
        {{--</a>--}}
    {{--</div>--}}
    <hr class="my_hr"/>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Провери внимателно данните! Ако има грешки, редактирай данните на Земеделския Стопанин и тогава добави Конатативен Протокол!
            </span>
        </p>
    </div>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">ДОКЛАД ОТ ПРОВЕРКА НА</h4>
                @include('records.add.object_info')
                {{--<br>--}}
                <a href="{{ '/стопанин/'.$farmer->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Назад към Земедлския Стопанин!
                </a>
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
        <div>
            @if (!isset($report))
                {!! Form::open(['url'=>'доклад-зс/first/'.$farmer->id , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            @else
                {!! Form::model($report, ['url'=>'доклад-зс/first-edit/'.$report->id , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
            @endif
                <div id="first_part">
                    <hr class="my_hr"/>
                    @include('farmers.reports.forms.number_protocol')
                    <hr class="my_hr"/>

                    @include('farmers.reports.forms.radio_type')
                    <hr class="my_hr"/>
                    <div class="row">
                        <div class="col-md-6"  style="padding-left: 20px">
                            {!! Form::label('dimensions', 'Размер в ха:', ['class'=>'my_labels']) !!}
                            {!! Form::text('dimensions', null, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>50 ]) !!}
                        </div>
                        <div class="col-md-6 ">
                            {!! Form::label('crops', 'Отглеждани култури:', ['class'=>'my_labels']) !!}
                            {!! Form::text('crops', null, ['class'=>'form-control form-control-my', 'size'=>20, 'maxlength'=>200 ]) !!}
                        </div>
                    </div>
                    <hr class="my_hr"/>

                    @include('farmers.reports.forms.inspectors')

                    <hr class="my_hr"/>

                    <input type="hidden" name="is_all" value="1" id="hidden">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                @if(!isset($report))
                    <div class="col-md-12" style="margin-bottom: 20px; text-align: center">
                        <br>
                        {!! Form::submit('Добави и продължи!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
                    </div>
                @else
                    <div class="col-md-4">
                        <br>
                        <button style="display: none" class="btn btn-primary" type="button"  ></button>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 10px; text-align: center">
                        <p>Редактирай само ако необходимо. В противен случай - натисни бутона "НАПРЕД"</p>
                        {!! Form::submit('Редактирай ако е необходимо!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
                    </div>
                    <div>
                        <div class="col-md-4">
                            <br>
                            <a href="{{ '/доклад-добави/'.$farmer->id.'/'.$report->id.'/2' }}" class=" btn btn-success my_btn-success" id="first">
                                НАПРЕД <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            {!! Form::close() !!}
        </div>
            @if(isset($report))
            <div class="container-fluid" >
                <div class="row first_row" id="common_part_row" style="display: block" >
                    <div class="col-md-12" style="margin-top: 10px">
                        @include('farmers.reports.forms.common_part')
                    </div>
                </div>
                <div class="row first_row" id="storage_part_row" style="display: block" >
                    <div class="col-md-12" style="margin-top: 10px">
                        @include('farmers.reports.forms.storage_part')
                    </div>
                </div>
                <div class="row first_row" id="application_part_row" style="display: block" >
                    <div class="col-md-12" style="margin-top: 10px">
                        @include('farmers.reports.forms.application_part')
                    </div>
                </div>
                <div class="row first_row" id="aviation_part_row" style="display: block" >
                    <div class="col-md-12" style="margin-top: 10px">
                        @include('farmers.reports.forms.aviation_part')
                    </div>
                </div>
                <div class="row first_row" id="integrated_part_row" style="display: block" >
                    <div class="col-md-12" style="margin-top: 10px">
                        @include('farmers.reports.forms.integrated_part')
                    </div>
                </div>
                @endif
            </div>

            {{--@include('records.add.data_protocol')--}}
            {{--<hr class="my_hr"/>--}}

            {{--@include('records.add.example')--}}
            {{--<hr class="my_hr"/>--}}


    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/farmers/reports/in_date.js" )!!}
    {!!Html::script("js/records/hasAssay.js" )!!}
    {!!Html::script("js/records/selectAssayProtocol.js" )!!}
    {!!Html::script("js/farmers/reports/common_part.js" )!!}
    {!!Html::script("js/farmers/reports/storage_part.js" )!!}
    {!!Html::script("js/farmers/reports/application_part.js" )!!}
    {!!Html::script("js/farmers/reports/air_part.js" )!!}
    {!!Html::script("js/farmers/reports/final_part.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}


    <script type="text/javascript">
        const pathArray = window.location.pathname.split("/");
        const part = pathArray[4];
        console.log(part);  // outputs "m2-m3-m4-m5"
        if (part == 1 ) {
            document.getElementById("first_part").style.display = "block";
            document.getElementById("common_part_row").style.display = "none";
            document.getElementById("storage_part_row").style.display = "none";
            document.getElementById("application_part_row").style.display = "none";
            document.getElementById("aviation_part_row").style.display = "none";
            document.getElementById("integrated_part_row").style.display = "none";
        }
        if (part == 2 ) {
            document.getElementById("first_part").style.display = "none";
            document.getElementById("common_part_row").style.display = "block";
            document.getElementById("storage_part_row").style.display = "none";
            document.getElementById("application_part_row").style.display = "none";
            document.getElementById("aviation_part_row").style.display = "none";
            document.getElementById("integrated_part_row").style.display = "none";
        }
        if (part == 3 ) {
            document.getElementById("first_part").style.display = "none";
            document.getElementById("common_part_row").style.display = "none";
            document.getElementById("storage_part_row").style.display = "block";
            document.getElementById("application_part_row").style.display = "none";
            document.getElementById("aviation_part_row").style.display = "none";
            document.getElementById("integrated_part_row").style.display = "none";
        }
        if (part == 4 ) {
            document.getElementById("first_part").style.display = "none";
            document.getElementById("common_part_row").style.display = "none";
            document.getElementById("storage_part_row").style.display = "none";
            document.getElementById("application_part_row").style.display = "block";
            document.getElementById("aviation_part_row").style.display = "none";
            document.getElementById("integrated_part_row").style.display = "none";
        }


//        var value =  document.getElementById("hidden").value;
//        var value1 =  document.getElementById("hidden_one").value;
//        console.log(value, value1);
//        if(value == 1) {
//            document.getElementById("first_part").style.display = "none";
//            document.getElementById("common_part_row").style.display = "block";
//            document.getElementById("storage_part_row").style.display = "none";
//            document.getElementById("application_part_row").style.display = "none";
//            document.getElementById("aviation_part_row").style.display = "none";
//            document.getElementById("integrated_part_row").style.display = "none";
//            document.getElementById("integrated_part_row").style.display = "none";
//        }

//        document.getElementById("first").onclick = function() {
//            document.getElementById("first_part").style.display = "none";
//            document.getElementById("common_part_row").style.display = "block";
//        }
//
//
//        document.getElementById("second_back").onclick = function() {
//            document.getElementById("first_part").style.display = "block";
//            document.getElementById("common_part_row").style.display = "none";
//        }


//        function firstForward(){
//            document.getElementById("common_part_row").style.display = "none";
//            document.getElementById("storage_part_row").style.display = "block";
//        }
//        document.getElementById("common_part_row").style.display = "none";


    </script>

@endsection