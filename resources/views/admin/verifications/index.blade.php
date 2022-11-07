@extends('layouts.admin')
@section('title')
    {{ 'Всички Проверки' }}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible" role="alert" >
        <p class="bold">ОПИСВАТ СЕ ВИДА НА ПРОВЕРКИТЕ ЗА КОИТО СЕ ИЗДАВАТ КОНСТАТИВНИ ПРОТОКОЛИ НА З.С.</p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>N</th>
            <th>Цялото име</th>
            <th>Кратко име</th>
            <th>Показва се</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                <tr>
                    <td>{{$record->id}}</td>
                    <td>{{$record->full_name}}</td>
                    <td>{{$record->short_name}}</td>
                    @if($record->show_check == 1)
                        <td style="text-align: center">Да</td>
                    @else
                        <td  style="text-align: center">-</td>
                    @endif

                    @if($record->type_check == 1)
                        <td style="text-align: center">Друго</td>
                    @elseif($record->type_check == 2)
                        <td  style="text-align: center">С ДФЗ</td>
                    @elseif($record->type_check == 3)
                        <td  style="text-align: center">Държавни</td>
                    @endif
                    <td>
                        <a href="{!!URL::to('/админ/проверки/редактирай/'.$record->id)!!}" class="fa fa-edit btn btn-primary">  Редактирай!</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection