@extends('layouts.quality')

@section('title')
    {{ 'Всички Култири' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css" )!!}
    {!!Html::style("css/table/crop.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">ВСИЧКИ КУЛТУРИ</h4>
    </div>
    <hr/>
    <div class="btn-group" >
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
        <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <a href="{!! URL::to('/контрол/вносители')!!}" class="fa fa-trademark btn btn-info my_btn"> Всички фирми</a>
        <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <span class="fa fa-leaf btn btn-default my_btn"> Култури</span>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/култури/create')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави култура</a>
    </div>
    <hr/>
    <div class="btn-group" >
        <span class="fa fa-leaf btn btn-default my_btn"> Всички Култури</span>
        <a href="{!! URL::to('/контрол/култури/внос')!!}" class="fa fa-arrow-down btn btn-info my_btn"> Култури/Внос</a>
        <a href="{!! URL::to('/контрол/култури/износ')!!}" class="fa fa-arrow-up btn btn-info my_btn"> Култури/Износ</a>
        <a href="{!! URL::to('/контрол/култури/вътрешни')!!}" class="fa fa-retweet btn btn-info my_btn"> Култури/Вътрешни</a>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div  id="sort_miar_wrap"  style="justify-content: center">
                    <h3>Всички култури</h3>
                    <p style="color: black">
                        <span  style="color: red; font-weight: bold;">ВНИМАНИЕ!!!</span>
                         В сертификатите няма да се показват кутури от гропите 
                         <span style="font-weight: bold">Зърненожитни</span>, 
                         <span style="font-weight: bold">Бобови</span> и  
                         <span style="font-weight: bold">Технически</span>. 
                    </p>
                    <p>
                        Ако е необходима някоя от тези кутури добавете я в група <span style="font-weight: bold">ДРУГИ</span>.
                    </p>
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>
    <div class="container">
        <table  class="table display my_table table-striped " cellspacing="0" width="100%" border="1px">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Име</th>
                    <th>Name</th>
                    <th>Delete</th>
                    <th>Edit</th>
                    <th>Виж</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1; ?>
                @foreach ($groups as $k=> $group)
                    @foreach($cultures as $key => $culture)
                        @if($k == $culture->group_id)
                            <tr>
                                <td colspan="6"><p style="font-weight: bold">{{$group}}</p></td>
                            </tr>
                            <?php break ; ?>
                        @endif
                    @endforeach
                    @foreach($cultures as $key => $culture)
                    <?php  
                        if ($k == $culture->group_id) {
                        ?>
                            <tr>
                                <td class="first_td">{{$culture->id}}</td>
                                <td class="crop_td">{{$culture->name}}</td>
                                <td class="crop_td">{{$culture->name_en}}</td>
                                <td class="crop_btn">
                                    <form action="{{ url('/crops/delete/'.$culture->id) }}" method="post" style="display: inline-block" onsubmit="return confirm('Наистина ли искате да изтриете тази култура?');">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                    </form>
                                </td>
                                <td class="crop_btn">
                                    <a href="{!!URL::to('/crops/edit/'.$culture->id)!!}" class="fa fa-edit btn btn-primary">
                                        &nbsp;Редактирай!
                                    </a>
                                </td>
                                <td class="crop_btn">
                                    <a href="{!!URL::to('/crops/show/'.$culture->id)!!}" class="fa fa-binoculars btn btn-success">
                                        &nbsp;ВИЖ КУЛТУРАТА!
                                    </a>
                                </td>
                            </tr>

                        <?php
                            continue ;
                        }
                    ?>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection