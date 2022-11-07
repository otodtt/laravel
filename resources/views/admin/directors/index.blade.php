@extends('layouts.admin')
@section('title')
    {{ 'Всички Директори' }}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible" role="alert">
        <p>
            <span class="red">ВНИМАНИЕ!</span>
            Ако се назначи директор като И.Д. или И.Ф. се <span class="bold">ДОБАВЯ като нов Директор</span>. След това
            ако същият се
            назначи като Директор се прави <span class="bold">НОВ запис</span>. Ще има два записа.
            1 - И.Д. Директор .........&nbsp;&nbsp;&nbsp;&nbsp;
            2 Директор .........
        </p>
        <hr/>
        <p><span class="red">ВНИМАНИЕ!</span> След като се добави нов директор, старите записи няма да могат да се редактират.</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>N</th>
                <th>ИД или ИФ</th>
                <th>Титла</th>
                <th>Трите имена</th>
                <th>Начална дата</th>
                <th>Крайна дата</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $max = $directors->max('id');
        $n = 1;
        ?>
        @foreach($directors as $user)
            <tr>
                <?php
                $end_date = '01.01.2030';
                if ($user->end_date == strtotime($end_date)) {
                    $end_date = ' - ';
                } else {
                    $end_date = date('d.m.Y', $user->end_date);
                }
                ?>
                <td><?php echo $n++; ?></td>
                <td>{{$user->type_dir.' Директор'}}</td>
                <td>{{$user->degree}}</td>
                <td>{{$user->name}} {{$user->surname}} {{$user->family}}</td>
                <td>{{ date('d.m.Y', $user->start_date)}}</td>
                <td> <?php echo $end_date; ?> </td>
                <td>
                    @if($max == $user->id)
                        {!!link_to_route('admin.directors.edit', $title = ' Редактирай', $parameters = $user->id,
                        $attributes = ['class' =>'fa fa-edit btn btn-primary'] )!!}
                    @else
                        <span> - </span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection