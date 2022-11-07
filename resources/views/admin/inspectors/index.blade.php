@extends('layouts.admin')
@section('title')
    {{ 'Всички инспектори' }}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <fieldset class="mini_title">
        <h5>ВСИЧКИ ИНСПЕКТОРИ</h5>
    </fieldset>
    <table class="table">
        <thead>
            <tr>
                <th>N</th>
                <th>Длъжност</th>
                <!-- <th>Пълно Име</th> -->
                <th>Кратко име</th>
                <th>Карта N</th>
                <th>Печат N</th>
                <th>Логин име</th>
                <th>Дестващ</th>
                <th>Админ Права</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $n = 1; ?>
        @foreach($users as $user)
            <tr>
                <?php
                if ($user->dlaznost == 0) {
                    $dlaznost = 'Грешка в БД';
                }
                if ($user->dlaznost == 1) {
                    $dlaznost = 'Н-к отдел';
                }
                if ($user->dlaznost == 2) {
                    $dlaznost = 'Гл. Инспектор';
                }
                if ($user->dlaznost == 3) {
                    $dlaznost = 'Ст. Инспектор';
                }
                if ($user->dlaznost == 4) {
                    $dlaznost = 'Инспектор';
                }
                ///
                if ($user->admin == 1) {
                    $admin = '-';
                }
                if ($user->admin == 2) {
                    $admin = 'Да';
                }
                ////
                if ($user->active == 1) {
                    $active = 'Да';
                }
                if ($user->active == 2) {
                    $active = '-';
                }
                ?>
                <td><?php echo $n++; ?></td>
                <td>{!! $dlaznost !!}</td>
                <!-- <td>{{$user->all_name}}</td> -->
                <td>{{$user->short_name}}</td>
                <td>{{$user->karta}}</td>
                <td>{{$user->stamp_number}}</td>
                <td>{{$user->name}}</td>
                <td><?php echo $active; ?></td>
                <td><?php echo $admin; ?></td>
                <td>
                    {!!link_to_route('admin.users.edit', $title = '', $parameters = $user->id,
                    $attributes = ['class' =>'fa fa-edit btn btn-primary'] )!!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection