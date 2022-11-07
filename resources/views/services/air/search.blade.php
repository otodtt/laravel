@extends('layouts.services')
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
        <h4 class="bold red layout-title">ТЪРСИ ЗЕМЕДЕЛСКИ СТОПАНИН И ДОБАВИ НОВО РАЗРЕШИТЕЛНО</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/въздушни')!!}" class="fa fa-plane btn btn-primary my_btn">  Рзрешителни - Въздушно третиране</a>
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
                {!! Form::open(['url'=>'/търси-въздушно' , 'method'=>'POST', 'id'=>'form']) !!}
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
                    <span><a href="javascript:GetPinFarmer();" class="fa fa-check-square-o btn btn-danger my_btn_check" id="check_farmer"> Провери по рожденна дата!</a></span>
                </div>
                <div class="col-md-2 col-md-6_my " style="text-align: center; margin-bottom: 5px;" >
                    <span><a href="javascript:GetNameFarmer();" class="fa fa-check-square-o btn btn-danger my_btn_check" id="check_name_farmer"> Провери по име!</a></span>
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
                    <span><a href="javascript:GetNameFirm();" class="fa fa-check-square-o btn btn-danger my_btn_check" id="check_name_firm"> Провери по име на Фирма!</a></span>
                </div>
            </div>
        @endif
    @endif

    <div class="div_find">
        <span id="has"></span>
        @if(isset($farmers))
            @if(count($farmers) == 0)
                <div class="col-md-6 col-md-6_my " >
                    <p class="new_farmer bold">
                        <span class="view red">Няма намерен такъв Земеделски Производител. ЕГН или Булстат са верни.</span><br/>
                        Добави Протокол на НОВ Земеделски Производител
                    </p>
                </div>
                <div class="col-md-6 col-md-6_my " >
                    {!! Form::open(['url'=>'/въздушно-нов/добави' , 'method'=>'GET', 'id'=>'form_new_opinion']) !!}
                        <input type="submit" class="fa fa-address-card-o btn btn-success my_btn_check" value=" ДОБАВИ РАЗРЕШИТЕЛНО">
                        @if($firm == 1)
                            <input type="hidden" name="firm" value="{!! $firm !!}">
                            <input type="hidden" name="name" value="{!! $name !!}">
                            <input type="hidden" name="gender" value="{!! $gender !!}">
                            <input type="hidden" name="pin" value="{!! $pin !!}">
                        @else
                            <input type="hidden" name="firm" value="{!! $firm !!}">
                            <input type="hidden" name="name_firm" value="{!! $name_firm !!}">
                            <input type="hidden" name="eik" value="{!! $eik !!}">
                        @endif

                    {!! Form::close() !!}
                </div>
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
                            <a href="{!! URL::to('/въздушни/добави/'.$farmer->id)!!}" class="fa fa-plane btn btn-info my_btn_check" > ДОБАВИ РАЗРЕШИТЕЛНО ЗА ТОЗИ ЗС!</a>
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
    {!!Html::script("js/permits/search/searchFarmer.js" )!!}
    {!!Html::script("js/permits/search/searchFarmerByPin.js" )!!}
    {!!Html::script("js/permits/search/searchFarmerByName.js" )!!}
    {!!Html::script("js/permits/search/searchFirmByName.js" )!!}
@endsection