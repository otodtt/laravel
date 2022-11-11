@extends('layouts.quality')
@section('title')
    {{ 'Намери Земеделски Стопанин' }}
@endsection

@section('css')
    {!!Html::style("css/protocols/add_edit_none.css" )!!}
    {!!Html::style("css/opinions/search.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold red layout-title">ТЪРСИ ЗЕМЕДЕЛСКИ СТОПАНИН И ДОБАВИ НОВ СЕРТИФИКАТ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa  btn btn-default my_btn"><i class="fa fa-certificate " aria-hidden="true"></i>  Сертификати</span>
        <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <a href="{!! URL::to('/контрол/вносители')!!}" class="fa fa-trademark btn btn-info my_btn"> Всички фирми</a>
        <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <a href="{!! URL::to('/контрол/култури')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
    </div>

    <hr/>
    <div class="btn-group" >
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-arrow-down btn btn-info my_btn"> Сетификати/Внос</a>
        <a href="{!! URL::to('/контрол/сертификати-износ')!!}" class="fa fa-arrow-up btn btn-info my_btn"> Сетификати/Износ </a>
        <span class="fa fa-retweet btn btn-default my_btn"> Вътрешни</span>
    </div>
    <hr/>

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
    </div>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12" >
                <fieldset class="small_field"><legend class="small_legend">Данни на Фирмата/Лицето</legend>
                {!! Form::open(['url'=>'/контрол/търси-земеделец' , 'method'=>'POST', 'id'=>'form']) !!}
                    @include('layouts.forms.search_protocol')

                    <div class="col-md-12 col-md-6_my div_btn" >
                        <hr/>
                        {!! Form::submit('ТЪРСИ !!!', ['class'=>'btn btn-primary', 'id'=>'submit']) !!}
                    </div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                    <input type="hidden" name="search_hidden" value="1" id="search_hidden">
                {!! Form::close() !!}
                </fieldset>
            </div>
        </div>
    </div>

    @if(count($errors)>0)
        @if ($errors->has('pin_farmer') && !$errors->has('gender_farmer'))
            <div class="alert alert-danger col-md-12 col-md-6_my">
                <div class="col-md-12 col-md-6_my " style="text-align: center" >
                    <p class="bold" style="margin-left: 10px">
                        Провери още веднъж дали правилно са попълнени данните! За да продължите може да проверите по роженна дата или по име.
                    </p>
                </div>
                <div class="col-md-4 col-md-6_my " style="text-align: center" >
                    <span><a href="javascript:GetPinFarmerCertificate();" class="fa fa-check-square-o btn btn-danger my_btn_check" id="check_farmer_certificate"> Провери по рожденна дата!</a></span>
                </div>
                <div class="col-md-2 col-md-6_my " style="text-align: center; margin-bottom: 5px;" >
                    <span><a href="javascript:GetNameFarmerCertificate();" class="fa fa-check-square-o btn btn-danger my_btn_check" id="check_name_farmer_certificate"> Провери по име!</a></span>
                </div>
                <div class="col-md-4 col-md-6_my "  >
                    <p class="description bold" style="margin-top: 7px;">Желателно е да се търси с трите имена.</p>
                </div>
            </div>
        @endif
    @endif

    @if(count($errors)>0)
        @if ($errors->has('eik_search'))
            <div class="alert alert-danger col-md-12 col-md-6_my">
                <div class="col-md-12 col-md-6_my " style="text-align: center" >
                    <p class="bold" style="margin-left: 10px">
                        Провери още веднъж дали правилно са попълнени данните! За да продължите може да проверите по име на фирмата.
                    </p>
                </div>
                <div class="col-md-12 col-md-6_my " style="text-align: center; margin-bottom: 5px;" >
                    <span><a href="javascript:GetNameFirm();" class="fa fa-check-square-o btn btn-danger my_btn_check" id="check_name_firm_certificate"> Провери по име на Фирма!</a></span>
                </div>
            </div>
        @endif
    @endif

    <div class="div_find">
        <span id="has"></span>
        @if(isset($farmers))
            @if(count($farmers) == 0)
                @if($firm == 1)
                    <div class="col-md-6 col-md-6_my " >
                        <p class="new_farmer bold">
                            <span class="view red">Няма намерен такъв Земеделски Производител. ЕГН или Булстат са верни.</span><br/>
                            Добави Сертификат на НОВ Земеделски Производител
                        </p>
                    </div>
                    <div class="col-md-6 col-md-6_my " >
                        {!! Form::open(['url'=>'/контрол/сертификати-вътрешен/фермер/нов' , 'method'=>'GET', 'id'=>'form_new_opinion']) !!}
                            <input type="submit" class="fa fa-address-card-o btn btn-success my_btn_check" value=" ДОБАВИ СЕРТИФИКАТ ЗА НОВ СТОПАНИН">
                            <input type="hidden" name="firm" value="{!! $firm !!}">
                            <input type="hidden" name="name" value="{!! $name !!}">
                            <input type="hidden" name="gender" value="{!! $gender !!}">
                            <input type="hidden" name="pin" value="{!! $pin !!}">
                        {!! Form::close() !!}
                    </div>
                @else
                    <div class="col-md-6 col-md-6_my " >
                        <p class="new_farmer bold">
                            <span class="view red">Няма намерена такъва фирма. ЕИК или Булстат са верни.</span><br/>
                            Добави Сертификат на НОВА Фирма. ИЗБРЕИ ВИДА НА ФИРМАТА!
                        </p>
                    </div>
                    <div class="col-md-6 col-md-6_my " >
                        {!! Form::open(['url'=>'/контрол/сертификати-вътрешен/фермер/нова-фирма' , 'method'=>'GET', 'id'=>'form_new_opinion']) !!}
                            <input type="submit" class="fa fa-address-card-o btn btn-success my_btn_check" style="width: 350px" value=" ФИРМАТА Е ЗЕМЕДЕЛСКИ ПРОИЗВОДИТЕЛ">
                            <input type="hidden" name="firm" value="{!! $firm !!}">
                            <input type="hidden" name="name_firm" value="{!! $name_firm !!}">
                            <input type="hidden" name="eik" value="{!! $eik !!}">
                        {!! Form::close() !!}
                        <hr>
                        {!! Form::open(['url'=>'/контрол/сертификати-вътрешен/фермер/търговец' , 'method'=>'GET', 'id'=>'form_new_opinion']) !!}
                            <input type="submit" class="fa fa-address-card-o btn btn-info my_btn_check" style="width: 350px" value=" ФИРМАТА Е САМО ТЪРГОВЕЦ">
                            <input type="hidden" name="firm" value="{!! $firm !!}">
                            <input type="hidden" name="name_firm" value="{!! $name_firm !!}">
                            <input type="hidden" name="eik" value="{!! $eik !!}">
                        {!! Form::close() !!}
                    </div>
                @endif
            @else
                @foreach($farmers as $farmer)
                    <div class="col-md-12 col-md-6_my " >
                        <div class="col-md-6 col-md-6_my " >
                            <p class="new_farmer bold">
                                <span class="view_green">Намерен Земеделски Производител</span><br/>
                                {!! $farmer->name !!} с ЕГН/БУЛСТАТ: {!! $farmer->pin !!}
                            </p>
                        </div>
                        <div class="col-md-6 col-md-6_my " >
                            <a href="{!! URL::to('/контрол/сертификати-вътрешен/добави/'.$farmer->id)!!}" class="fa fa-address-card-o btn btn-success my_btn_check" > ДОБАВИ СЕРТИФИКАТ ЗА ТОЗИ ЗС!</a>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
    <br/>
    <br/>
@endsection

@section('scripts')
    {!!Html::script("js/records/search/searchFarmer.js" )!!}
    {!!Html::script("js/records/search/searchFarmerByPin.js" )!!}
    {!!Html::script("js/records/search/searchFarmerByName.js" )!!}
    {!!Html::script("js/records/search/searchFirmByName.js" )!!}
    <script>
        $(document).ready(function(){
            $("#check_farmer_certificate").click(GetPinFarmerCertificate);
            $("#check_name_farmer_certificate").click(GetNameFarmerCertificate);
            $("#check_name_firm_certificate").click(GetNameFirmCertificate);
        });

        function GetPinFarmerCertificate(){
            $.ajax({
                type: "POST",
                url: "http://odbhrz.test/certificate/pin",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                dataType:'json',
                data:{
                    val1:$('#pin_farmer').val(),
                }

            }).done(function(data){
                $('#has').html(data[0]);
            });
        }
        function GetNameFarmerCertificate(){
            $.ajax({
                type: "POST",
                url: "http://odbhrz.test/certificate/names",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                dataType:'json',
                data:{
                    val1:$('#name_farmer').val(),
                }

            }).done(function(data){
                $('#has').html(data[0]);
            });
        }
        function GetNameFirmCertificate(){
            $.ajax({
                type: "POST",
                url: "http://odbhrz.test/certificate/firms",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                dataType:'json',
                data:{
                    val1:$('#firm_name_search').val(),
                }

            }).done(function(data){
                $('#has').html(data[0]);
            });
        }
    </script>
@endsection