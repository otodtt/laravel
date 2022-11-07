@extends('layouts.admin')
@section('title')
    {{ 'Добавени Населени места' }}
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
        <p class="bold">ДОБАВЕНИ НАСЕЛЕНИ МЕСТА <span class="red"></span></p>
    </div>
    <?php
        $location_id = $new_locations->toArray();
    ?>
    @if(!isset($location_id[0]['id']))
        <p>Няма добавени нови населени места.</p>
    @else
    <table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
        <thead>
            <tr>
                <th>N</th>
                <th>Населено място</th>
                <th>Община</th>
                <th>Пощенски код</th>
                <th>ЕКАТТЕ</th>
                <th></th>
            </tr>
        </thead>
        <tbody >
        <?php $n=1; ?>
        @foreach($new_locations as $location)
            @foreach($districts as $district)
                @if( $district->district_id == $location->district_id)
                    <?php
                        $name_district = $district->name;
                    ?>
                @endif
            @endforeach
            <tr>
                <td class="center">{!! $n++ !!}</td>
                <td class="left">{{$location->t_v_m}}  {{$location->name}}</td>
                <td class="center">{{ $name_district }}</td>
                <td class="center"> {{$location->postal_code}} </td>
                <td class="center"> {{$location->ekatte}} </td>
                <td class="center">
                    {!!link_to_route('admin.locations.edit', $title = ' Редактирай!', $parameters = $location->id,
                        $attributes = ['class' =>'fa fa-edit btn btn-primary my_btn'] )!!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

@endsection

@section('scripts')
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/locationsTable2.js" )!!}
@endsection