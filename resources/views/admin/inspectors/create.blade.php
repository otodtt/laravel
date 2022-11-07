@extends('layouts.admin')
@section('title')
    {{ 'Добави инспектор' }}
@endsection

@section('css')
    {!!Html::style("css/admin/create_inspectors.css" )!!}
@endsection

@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <fieldset class="">
        <p class="description_alert"><span class="red">ВНИМАНИЕ!</span> Прочети преди да продължиш!<br/>
            1. В полето "<span class="bold_desc ">Дестващ ли е:</span>" се маркира дали инспектора е дейсвтащ в момента или вече е напуснал. Дори да е напуснал може да се използва при опис на стари документи<br/>
            2. От полето "<span class="bold_desc">Длъжост:</span>" се избира длъжността на инспектора.<br/>
            3. В полето "<span class="bold_desc">Име на Инспектора:</span>" се изписват трите имена на инспектора или само Имe и Фамилия в случай, че не се знае презимето му.<br/>
            4. Полето "<span class="bold_desc">№ на сл. Карта:</span>" се попълва само с цифри без други символи и букви.<span class="bold_desc">Номера на картата трябва да е уникален!</span><br/>
            5. В полето "<span class="bold_desc">Кратко име:</span>" се изписва съкратено Имe на инспектора и Фамилията му. Използва се в много случаи!<br/>
            6. В полето "<span class="bold_desc">Логин име:</span>" е името с което се влиза в ситемата. ЗАДЪЛЖИТЕЛНО се изписва на латински с минимум 4 символа!<br/>
            Трябва да е уникално за системата. Не може да има двама потребители с едно и също логин име.<br/>
            7. <span class="bold_desc">Паролата трябва да е най-малко с 4 символа!!! Най-много - 15.</span><br/>
            8. Повторете паролата!<br/>
            9. В полето "<span class="bold_desc">Права:</span>" се определя дали инспектора ще има администраторски права. Ако има такива ще има
            достъп до администраторския панел. <br/>
            <span class="red bold_desc">Не е желателно да има повече от един Администратор.</span>
        </p>
    </fieldset>
    {!! Form::open(['route'=>'admin.users.store', 'method'=>'POST']) !!}

        @include('admin.inspectors.form')

        {!! Form::submit('Добави!', ['class'=>'btn btn-primary','id'=>'submit']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!!Html::script("js/confirm/prevent.js" )!!}
@endsection
