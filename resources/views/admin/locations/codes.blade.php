@extends('layouts.admin')
@section('title')
    {{ 'Населени места' }}
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
        <p class="bold">НАСЕЛЕНИ МЕСТА В ОБЩИНА <span class="red"><?php echo mb_strtoupper($areas[0]['name']);?></span></p>
    </div>

    <table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
        <thead>
            <tr>
                <th>N</th>
                <th>Населено място</th>
                <th>Пощенски код</th>
                <th>ЕКАТТЕ</th>
            </tr>
        </thead>
        <?php $n=1; ?>
        <tbody>
            @foreach($locations as $location)
                <tr>
                    <td class="center">{!! $n++ !!}</td>
                    <td class="left">{{$location->t_v_m}}  {{$location->name}}</td>
                    <td class="center"> {{$location->postal_code}} </td>
                    <td class="center"> {{$location->ekatte}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/locationsTable.js" )!!}
@endsection