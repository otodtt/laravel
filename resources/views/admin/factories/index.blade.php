@extends('layouts.admin')
@section('title')
    {{ 'Всички Фирми производители' }}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible" role="alert">
        <p class="bold">
            <span class="red">ВНИМАНИЕ!</span> Тук се добавят САМО фирмите производители на ПРЗ.<br/>
            Не се добавят цехове за преопаковане,за които се издава Удостоверение!
        </p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>N</th>
            <th>Име на Фирмата</th>
            <th>Регистрирана в:</th>
            <th>Адрес</th>
            <th>ЕИК/Булстат</th>
            <th>Редактирай</th>
            <th>Виж!</th>
        </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($firms as $firm)
            <?php
            ////////////////////////
            if ($firm->type_firm == 1) {
                $et = 'ET';
                $ood = '';
            } elseif ($firm->type_firm == 2) {
                $et = '';
                $ood = 'ООД';
            } elseif ($firm->type_firm == 3) {
                $et = '';
                $ood = 'ЕООД';
            } elseif ($firm->type_firm == 4) {
                $et = '';
                $ood = 'АД';
            } else {
                $et = '';
                $ood = '';
            }
            //////////////////////////
            if($firm->type_location == 1){
                $tvm = 'гр. ';
            }
            if($firm->type_location == 2){
                $tvm = 'с. ';
            }
            ?>
            <tr>
                <td>{!! $n++ !!}</td>
                <th>{!! $et !!} "{{$firm->name}}" {!! $ood !!}</th>
                <td>{!! $tvm.$firm->location !!}</td>
                <td>{{$firm->address}}</td>
                <td>{{$firm->bulstat}}</td>
                <td>
                    <a href="{!! URL::to('/админ/производители/'.$firm->id.'/edit')!!}" class="fa fa-edit btn btn-danger my_btn"> Редактирай!</a>
                </td>
                <td>
                    <a href="{!! URL::to('/админ/производители/'.$firm->id)!!}" class="fa fa-binoculars btn btn-primary my_btn"> Виж!</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

