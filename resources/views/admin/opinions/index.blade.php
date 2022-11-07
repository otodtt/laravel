@extends('layouts.admin')
@section('title')
    {{ 'Всички Мерки' }}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible" role="alert">
        <p class="bold">ВСИЧКИ МЯРКИ ПО КОИТО СЕ ИЗДАВАТ СТАНОВИЩА</p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>N</th>
            <th>Цялото име</th>
            <th style="width: 170px">Кратко име</th>
            <th style="width: 110px">Период</th>
            <th style="width: 110px">Показва се</th>
            <th></th>
        </tr>
        </thead>
        <?php $n = 1; ?>
        <tbody>
        @foreach($rates as $rate)
            <?php
            if ($rate->period == 1) {
                $period = '2007 - 2013';
            } elseif ($rate->period == 2) {
                $period = '2014 - 2020';
            } else {
                $period = 'Редактирай!';
            }
            ?>
            <tr>
                <td><?php echo $n++; ?></td>
                <td>{{$rate->full_name}}</td>
                <td>{{$rate->short_name}}</td>
                <td>{{$period}}</td>
                @if($rate->show_rate == 0 )
                    <td>Не</td>
                @else
                    <td>Да</td>
                @endif
                <td>
                    <a href="{!!URL::to('/админ/мярки/редактирай/'.$rate->id)!!}"
                       class="fa fa-edit btn btn-primary"> </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection