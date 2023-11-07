@extends('layouts.admin')
@section('title')
    {{ 'Териториални единици' }}
@endsection
@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_locations.css" )!!}
@endsection
@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible bold" role="alert" style="text-align: center; text-transform: uppercase">
        Административно-териториални единици в
        Република България
    </div>
    <div >
        <table id="example" class="display my_table table-striped " cellspacing="0"  border="1px" style="margin-left: auto; margin-right: auto;">
        <thead>
            <tr>
                <th style="width: 50px">N</th>
                <th style="width: 200px">ЕКАТТЕ</th>
                <th style="width: 400px">ОБЛАСТ</th>
            </tr>
        </thead>
        <?php $n=1; ?>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td class="left">BLG</td>
                <td class="left">Благоевград</td>
            </tr>
            <tr>
                <td class="center">2</td>
                <td class="left">BGS</td>
                <td class="left">Бургас</td>
            </tr>
            <tr>
                <td class="center">3</td>
                <td class="left">VAR</td>
                <td class="left">Варна</td>
            </tr>
            <tr>
                <td class="center">4</td>
                <td class="left">VTR</td>
                <td class="left">Велико Търново</td>
            </tr>
            <tr>
                <td class="center">5</td>
                <td class="left">VID</td>
                <td class="left">Видин</td>
            </tr>
            <tr>
                <td class="center">6</td>
                <td class="left">VRC</td>
                <td class="left">Враца</td>
            </tr>
            <tr>
                <td class="center">7</td>
                <td class="left">GAB</td>
                <td class="left">Габрово</td>
            </tr>
            <tr>
                <td class="center">8</td>
                <td class="left">DOB</td>
                <td class="left">Добрич</td>
            </tr>
            <tr>
                <td class="center">9</td>
                <td class="left">KRZ</td>
                <td class="left">Кърджали</td>
            </tr>
            <tr>
                <td class="center">10</td>
                <td class="left">KNL</td>
                <td class="left">Кюстендил</td>
            </tr>
            <tr>
                <td class="center">11</td>
                <td class="left">LOV</td>
                <td class="left">Ловеч</td>
            </tr>
            <tr>
                <td class="center">12</td>
                <td class="left"> MON</td>
                <td class="left">Монтана</td>
            </tr>
            <tr>
                <td class="center">13</td>
                <td class="left">PAZ</td>
                <td class="left">Пазарджик</td>
            </tr>
            <tr>
                <td class="center">14</td>
                <td class="left">PER</td>
                <td class="left">Перник</td>
            </tr>
            <tr>
                <td class="center">15</td>
                <td class="left">PVN</td>
                <td class="left">Плевен</td>
            </tr>
            <tr>
                <td class="center">16</td>
                <td class="left">PDV</td>
                <td class="left">Пловдив</td>
            </tr>
            <tr>
                <td class="center">17</td>
                <td class="left">RAZ</td>
                <td class="left">Разград</td>
            </tr>
            <tr>
                <td class="center">18</td>
                <td class="left">RSE</td>
                <td class="left">Русе</td>
            </tr>
            <tr>
                <td class="center">19</td>
                <td class="left">SLS </td>
                <td class="left">Силистра</td>
            </tr>
            <tr>
                <td class="center">20</td>
                <td class="left">SLV</td>
                <td class="left">Сливен</td>
            </tr>
            <tr>
                <td class="center">21</td>
                <td class="left">SML</td>
                <td class="left">Смолян</td>
            </tr>
            <tr>
                <td class="center">22</td>
                <td class="left">SFO</td>
                <td class="left">София</td>
            </tr>


            <tr>
                <td class="center">23</td>
                <td class="left">SOF</td>
                <td class="left">София (столица)</td>
            </tr>
            <tr>
                <td class="center">24</td>
                <td class="left">SZR</td>
                <td class="left">Стара Загора</td>
            </tr>
            <tr>
                <td class="center">25</td>
                <td class="left">TGV</td>
                <td class="left">Търговище</td>
            </tr>
            <tr>
                <td class="center">26</td>
                <td class="left">HKV</td>
                <td class="left">Хасково</td>
            </tr>
            <tr>
                <td class="center">27</td>
                <td class="left">SHU</td>
                <td class="left">Шумен</td>
            </tr>
            <tr>
                <td class="center">28</td>
                <td class="left">JAM</td>
                <td class="left">Ямбол</td>
            </tr>
        </tbody>
    </table>
    </div>
@endsection

@section('scripts')
{{--    {!!Html::script("js/table/jquery.dataTables.js" )!!}--}}
{{--    {!!Html::script("js/table/locationsTable.js" )!!}--}}
@endsection