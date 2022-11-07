<div>
    <span>Програма за развитие на селските райони 2007-2013</span>
    <span class="right bold" style="float: right">Приложение III</span>
</div>
<table border="1" id="sum_table">
    <thead>
        <tr>
            <th rowspan="3">Месец</th>
            <th rowspan="3" class="br_obst">
                Общ брой инспекции на земеделски стопани за издаване на Становища по мерките за подпомагане
                <span style="font-size: 0.8em;">(D+E+G+H+ J+K+M+N)</span>
            </th>
            <th rowspan="3" class="br_obst">Общ брой издадени Становища</th>
            <th colspan="12" class="">Брой инспекции на ЗП за издаване на Становище по съответната мярка за подпомагане</th>
        </tr>
        <tr>
            <th colspan="3" class="document">Мярка 112 "Създаване на стопанства на млади фермери”</th>
            <th colspan="3" class="document">Мярка 121 "Модернизиране на земеделските стопанства"</th>
            <th colspan="3" class="document">Мярка 141 "Подпомагане на ППС в процес на преструктуриране"</th>
            <th colspan="3" class="document">Мярка 214 "Агроекологични плащания"</th>
        </tr>
        <tr>
            <th class="middle_txt">Документална в ОДБХ</th>
            <th class="middle_txt">Посещение в стопанството</th>
            <th class="middle_txt">Брой издадени Становища</th>
            <th class="middle_txt">Документална в ОДБХ</th>
            <th class="middle_txt">Посещение в стопанството</th>
            <th class="middle_txt">Брой издадени Становища</th>
            <th class="middle_txt">Документална в ОДБХ</th>
            <th class="middle_txt">Посещение в стопанството</th>
            <th class="middle_txt">Брой издадени Становища</th>
            <th class="middle_txt">Документална в ОДБХ</th>
            <th class="middle_txt">Посещение в стопанството</th>
            <th class="middle_txt">Брой издадени Становища</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="middle">A</td>
            <td class="middle">B</td>
            <td class="middle">C</td>
            <td class="middle">D</td>
            <td class="middle">E</td>
            <td class="middle">F</td>
            <td class="middle">G</td>
            <td class="middle">H</td>
            <td class="middle">I</td>
            <td class="middle">J</td>
            <td class="middle">K</td>
            <td class="middle">L</td>
            <td class="middle">M</td>
            <td class="middle">N</td>
            <td class="middle">O</td>
        </tr>
    {!! $january[0] !!}
    {!! $february[0] !!}
    {!! $march[0] !!}
    {!! $april[0] !!}
    {!! $may[0] !!}
    {!! $june[0] !!}
    {!! $july[0] !!}
    {!! $august[0] !!}
    {!! $september[0] !!}
    {!! $october[0] !!}
    {!! $november[0] !!}
    {!! $december[0] !!}
    </tbody>
    <tfoot>
        <tr class="totalColumn">
            <td class="bottom">ОБЩО:</td>
            <td class="foot bottom"></td>
            <td class="foot bottom"></td>
            <td class="foot"></td>
            <td class="foot"></td>
            <td class="foot bottom"></td>
            <td class="foot"></td>
            <td class="foot"></td>
            <td class="foot bottom"></td>
            <td class="foot"></td>
            <td class="foot"></td>
            <td class="foot bottom"></td>
            <td class="foot"></td>
            <td class="foot"></td>
            <td class="foot bottom"></td>
        </tr>
    </tfoot>
</table>
<br/>
<p style="text-decoration: underline"><span class="bold">Забележка:</span> * Да се изпише името на мярката за подпомагане.</p>
{!! $january[2] !!}
{!! $february[2] !!}
{!! $march[2] !!}
{!! $april[2] !!}
{!! $may[2] !!}
{!! $june[2] !!}
{!! $july[2] !!}
{!! $august[2] !!}
{!! $september[2] !!}
{!! $october[2] !!}
{!! $november[2] !!}
{!! $december[2] !!}
<br/>
<hr/>
<br/>
<div>
    <span>Програма за развитие на селските райони 2014-2020</span>
    <span class="right bold"  style="float: right">Приложение III</span>
</div>
@if(count($periods)>0)
    <table border="1" id="data" class="tally">
        <thead>
            <tr>
                <th rowspan="3">Месец</th>
                <th rowspan="3" class="br_obst">
                    Общ брой инспекции на земеделски стопани за издаване на Становища по мерките за подпомагане
                </th>
                <th rowspan="3" class="br_obst">Общ брой издадени Становища</th>
                <th colspan="{{count($periods)*3}}" class="">Брой инспекции на ЗП за издаване на Становище по съответната мярка за подпомагане</th>
            </tr>
            <tr>
                @foreach($periods as $period)
                    <th colspan="3" class="document">Мярка {!! $period !!}</th>
                @endforeach
            </tr>
            <tr>
                @foreach($periods as $period)
                    <th class="middle_txt">Документална в ОДБХ</th>
                    <th class="middle_txt">Посещение в стопанството</th>
                    <th class="middle_txt">Брой издадени Становища</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="middle">A</td>
                <td class="middle">B</td>
                <td class="middle">C</td>
                @foreach($periods as $period)
                    <td class="middle">DD</td>
                    <td class="middle">EE</td>
                    <td class="middle">FF</td>
                @endforeach
            </tr>
            {!! $january[1] !!}
            {!! $february[1] !!}
            {!! $march[1] !!}
            {!! $april[1] !!}
            {!! $may[1] !!}
            {!! $june[1] !!}
            {!! $july[1] !!}
            {!! $august[1] !!}
            {!! $september[1] !!}
            {!! $october[1] !!}
            {!! $november[1] !!}
            {!! $december[1] !!}
        </tbody>
        <tfoot>
            <tr class="totalColumn">
                <td class="bottom">ОБЩО:</td>
                <td class="foot bottom"></td>
                <td class="foot bottom"></td>
                @foreach($periods as $period)
                    <td class="foot"></td>
                    <td class="foot"></td>
                    <td class="foot bottom"></td>
                @endforeach
            </tr>
        </tfoot>
    </table>
@endif