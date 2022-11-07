@extends('layouts.admin')
@section('title')
    {{ 'Всички Настройки' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible" role="alert" >
        <p class="bold">НЕОБХОДИМИ НАСТРОЙКИ</p>
    </div>
    <div class="alert-info" role="alert" style="text-align: center" >
        <p class="bold">Виж Логото и Антетката на готово Становище или Удостоверение!</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>N</th>
                <th>Настройка</th>
                <th>
                    <a class="fa fa-edit btn btn-primary my_btn" href="{!!URL::to('/админ/настройки/редактирай/1')!!}">  Редактирай!</a>
                </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Област</td>
                    <td>{{ $settings[0]['area'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Номер на Областта</td>
                    <td>{{ $settings[0]['area_id'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Град</td>
                    <td>{{ $settings[0]['city'] }} - Пощенски код: {{ $settings[0]['postal_code'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Адрес</td>
                    <td>{{ $settings[0]['address'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ел. поща</td>
                    <td>{{ $settings[0]['mail'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ел. адрес</td>
                    <td>{{ $settings[0]['site'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Телефон</td>
                    <td>{{ $settings[0]['phone'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Факс</td>
                    <td>{{ $settings[0]['fax'] }}</td>
                    <td></td>
                </tr>
            </tbody>
    </table>

    <div class="alert-info" role="alert" style="text-align: center" >
        <p class="bold">Индекси пред/зад Входящ и Изходящ Номер</p>
    </div>
    <table class="table">
        <tbody>
            <tr>
                <td>
                    <p>За Входящи Номера <span class="bold red">{{ $settings[0]['index_in'] }}</span> - 0000 <span class="bold red">{{ $settings[0]['in_second'] }}</span> </p>
                </td>
                <td>
                    <p>За Изходящи Номера <span class="bold red">{{ $settings[0]['index_out'] }}</span> - 0000 <span class="bold red">{{ $settings[0]['out_second'] }}</span> </p>
                </td>
                <td>
                    <a class="fa fa-edit btn btn-primary my_btn" href="{!!URL::to('/админ/настройки/индекси/1')!!}">  Редактирай!</a>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="alert-info" role="alert" style="text-align: center" >
        <p class="bold">Заключване на добавянето на Разрешителни за Обекти</p>
    </div>
    <table class="table">
        <tbody>
            <tr>
                @if($settings[0]['lock_permit'] == 0)
                    <td>
                        <p><span class="bold red">ВНИМАНИЕ !!!</span> В момента могат да се добавят Разрешителни за Обекти (аптеки, складове, цехове).<br/>
                            <span class="bold red">Задължително</span> e след като бъдат въведени всички разрешителни в базата данни да се заключи!!!</p>
                    </td>
                    <td>
                        {!! Form::model($settings, ['url'=>'admin/settings/lock-permits/'.$settings[0]['id'] , 'method'=>'POST', 'id'=>'form']) !!}
                        <button type="submit" class="btn-sm btn-success " id="lockConfirm">
                            <i class="fa fa-lock"></i> Заключи!
                        </button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        {!! Form::close() !!}
                    </td>
                @else
                    <td>
                        <p><span class="bold">ВНИМАНИЕ !!!</span> В момента не могат да се добавят Разрешителни за Обекти. Не отключвай ако не е наложително!</p>
                    </td>
                    <td>
                        {!! Form::model($settings, ['url'=>'admin/settings/unlock-permits/'.$settings[0]['id'] , 'method'=>'POST', 'id'=>'form']) !!}
                        <button type="submit" class="btn-sm btn-danger " id="lockConfirm">
                            <i class="fa fa-unlock"></i> Отключи!
                        </button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        {!! Form::close() !!}
                    </td>
                @endif
            </tr>
        </tbody>
    </table>

    <div class="alert-info" role="alert" style="text-align: center" >
        <p class="bold">Индех преди номер на печат и Контролен орган</p>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td>
                <p>За Номер на Печат <span class="bold red">{{ $settings[0]['q_index'] }}</span> - 0000 <span class="bold red">{{ $settings[0]['in_second'] }}</span> </p>
            </td>
            <td>
                <p>Име на контролен орган <span class="bold red">{{ $settings[0]['authority_bg'] }} </span></p>
            </td>
            <td>
                <p>Име на английски <span class="bold red">{{ $settings[0]['authority_en'] }}</span> </p>
            </td>
            <td>
                <a class="fa fa-edit btn btn-primary my_btn" href="{!!URL::to('/админ/настройки/сертификат/1')!!}">  Редактирай!</a>
            </td>
        </tr>
        </tbody>
    </table>
@endsection