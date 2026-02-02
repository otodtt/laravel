@extends('layouts.objects')
@section('title')
    {{ 'Констативни протоколи на фирма' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/protocols/show_protocols.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap pos col-md-12">
        <a href="{!! URL::to('/фирма/'.$firm->id )!!}" class="fa fa-arrow-left btn btn-success my_btn my_float"> Назад към
            Фирмата!</a>
        <h4 class="title_doc">ИЗДАДЕНИ КОНСТАТИВНИ ПРОТОКОЛИ НА ФИРМА</h4>
        <hr class="my_hr"/>
    </div>
    <?php
    if ($firm->type_firm == 1) {
        $et = 'ET';
    } else {
        $et = '';
    }
    if ($firm->type_firm == 2) {
        $ood = 'ООД';
    } elseif ($firm->type_firm == 3) {
        $ood = 'ЕООД';
    } elseif ($firm->type_firm == 4) {
        $ood = 'АД';
    } else {
        $ood = '';
    }
    ?>
    <div class="info-wrap pos col-md-12">
        <h4 class="bold title_doc">{!! $et !!} "{!! $firm->name !!}" {!! $ood !!}</h4>
        <hr class="my_hr"/>
    </div>
    @if(count($pharmacies) > 1 || count($repositories) > 1 && count($workshops) > 1)
        <fieldset class="big_field">
            @include('protocols.market.form.body_firm_protocols')
        </fieldset>
    @endif
    <hr/>
    <fieldset class="form-group my-form-group field_bottom">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/протоколи-фирма/'.$firm->id.'/сортирай/', 'method'=>'POST')) !!}
                @include('protocols.market.form.sort_protocols')
                {!! Form::close() !!}
                <span class="errors">
                    @if ($errors->has('years'))
                        {{ $errors->first('years') }}<br/>
                    @endif
                </span>
            </div>
        </div>
        <div class="refresh">
            <a href="{{ url('/протоколи-фирма/'.$firm->id) }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
        </div>
    </fieldset>
    <hr/>
    @include('protocols.market.form.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
    {!!Html::script("js/protocols/firmsSelectProtocolsTable.js" )!!}
@endsection