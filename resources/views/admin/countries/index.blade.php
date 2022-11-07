@extends('layouts.admin')
@section('title')
    {{ 'Държави в Европа' }}
@endsection
@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_locations.css" )!!}
@endsection
@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible" role="alert" >
        <p class="bold">ВСИЧКИ ДЪРЖАВИ В ЕВРОПА</p>
    </div>

    <table id="country" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
        <thead>
            <tr>
                <th>N</th>
                <th>Кратко име</th>
                <th>Официално наименование</th>
                <th>Име на английски</th>
                <th>Член на ЕС</th>
                <th>Edit</th>
            </tr>
        </thead>
        <?php $n=1; ?>
        <tbody>
            @foreach($countries as $country)
            <tr>
                <?php
                ////
                if ($country->EC == 0) {
                    $member = '';
                }
                if ($country->EC == 1) {
                    $member= 'Член на ЕС';
                }
                if ($country->EC == 2) {
                    $member = 'Кандидат';
                }
                ?>
                <td class="center">{!! $n++ !!}</td>
                <td class="left">{{$country->name}}</td>
                <td class="left"> {{$country->official_name}} </td>
                <td class="left"> {{$country->name_en}} </td>
                <td class="center"> {{$member}} </td>
                <th>
                    <a href="{!!URL::to('/admin/country/'.$country->id.'/edit')!!}" class="fa fa-edit btn btn-primary my_btn"></a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/locationsTable.js" )!!}
@endsection