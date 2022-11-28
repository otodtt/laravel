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
        <h4 class="bold red layout-title">ТЪРСИ ЗЕМЕДЕЛСКИ СТОПАНИН ИЛИ ТЪРГОВЕЦ И ДОБАВИ НОВ ПРОТОКОЛ ЗА КАЧЕСТВО</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa  btn btn-default my_btn"><i class="fa fa-file-powerpoint-o " aria-hidden="true"></i>  Констативни протоколи</span>
        <a href="{!! URL::to('/контрол/формуляри')!!}" class="fa fa-check-square btn btn-info my_btn"> Формуляри за съответствие</a>
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
                {!! Form::open(['url'=>'/контрол/протоколи/търси-търговец' , 'method'=>'POST', 'id'=>'form']) !!}
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
                        {!! Form::open(['url'=>'/контрол/протоколи/фермер/нов' , 'method'=>'GET', 'id'=>'form_new_opinion']) !!}
                            <input type="submit" class="fa fa-address-card-o btn btn-success my_btn_check" value=" ДОБАВИ СЕРТИФИКАТ ЗА НОВ СТОПАНИН">
                            <input type="hidden" name="firm" value="{!! $firm !!}">
                            <input type="hidden" name="name" value="{!! $name !!}">
                            <input type="hidden" name="gender" value="{!! $gender !!}">
                            <input type="hidden" name="pin" value="{!! $pin !!}">
                        {!! Form::close() !!}
                    </div>
                @else
                    @if (count($trader) == 0)
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
                    @else
                        <div class="col-md-6 col-md-6_my " >
                            <p class="new_farmer bold">
                                <span class="view" style="color: green">Намерена е фирма търговец.</span><br/>
                                Добави Сертификат на Фирма - {{$trader[0]['trader_name']}}!
                            </p>
                        </div>
                        <div class="col-md-6 col-md-6_my " >
                            <a href="{!!URL::to('/контрол/протоколи/търговец/'.$trader[0]['id'])!!}" class="fa fa-file-powerpoint-o btn btn-primary my_btn_check" style="width: 350px">
                                &nbsp;&nbsp;Добави Констативен протокол на тази фирма!
                            </a>
                        </div>
                    @endif
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
                            <a href="{!! URL::to('/контрол/протоколи/добави/'.$farmer->id)!!}" class="fa fa-address-card-o btn btn-success my_btn_check" > ДОБАВИ СЕРТИФИКАТ ЗА ТОЗИ ЗС!</a>
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
    {!!Html::script("js/quality/locationDomestic.js" )!!}
@endsection