<table id="table" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
    <thead>
    <tr>
        <th rowspan="2">Брой<br>проверки</th>
        <th rowspan="2" >Брой<br>костативни<br>протоколи</th>
        <th colspan="3">Формуляри за съответствие</th>
        <th rowspan="2">Брой<br>актове</th>
        <th colspan="5">Сертификати за съответствие</th>
        <th rowspan="2">Продукт</th>
        <th rowspan="2">количество<br>/тона/</th>
    </tr>
    <tr>

        <th>Брой</th>
        <th>Продукт</th>
        <th>количество<br>/тона/</th>

        <th>Държава</th>
        <th>Брой<br>внос</th>
        <th>Брой<br>износ</th>
        <th>Брой<br>Вътрешни</th>
        <th>Брой<br>Преработка</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td class="bold">{{count($certificates_year) + count($certificates_year_cons) + count($xcertificates_year) + count($incertificates_year) + count($protocols_year) + count($compliance_year)}}</td>
            <td class="bold">{{count($protocols_year)}}</td>
            <td class="bold">{{count($compliance_year)}}</td>
            <td class="bold"></td>
            <td class="bold"></td>
            <td></td>
            <td></td>
            <td class="bold">{{count($certificates_year)}}</td>
            <td class="bold">{{count($xcertificates_year)}}</td>
            <td class="bold">{{count($incertificates_year)}}</td>
            <td class="bold">{{count($certificates_year_cons)}}</td>
            <td class="bold"></td>
            <td class="bold"></td>
        </tr>
        {{-- ФОРМУЛЯРИ --}}
        @foreach($stocks_compliance as $key => $stock)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: left"><span >{{ $key }}</span></td>
                <td class="rowDataSd" >
                    <?php $total = 0; ?>
                    @foreach ($stock as $val)
                        <?php
                        $total += array_sum((array) $val['quantity']);
                        ?>
                    @endforeach
                    <span style="float: right">
                        {{ number_format($total / 1000, 3, ',', ' ') }}
                    </span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        {{-- ВНОС --}}
        @if(count($certificates_year) != 0)
            <tr>
                <td colspan="7" style="text-align: right"><span class="bold"> Сертификати внос: Брой:</span></td>
                <td><span class="bold">{{count($certificates_year)}}</span></td>
                <td colspan="5"></td>
            </tr>
            @foreach($stocks as $key => $stock)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: left"><span >{{ $key }}</span></td>
                    <td class="rowDataSd" >
                        <?php $total = 0; ?>
                        @foreach ($stock as $val)
                            <?php
                            $total += array_sum((array) $val['weight']);
                            ?>
                        @endforeach
                        <span style="float: right">
                            {{ number_format($total / 1000, 3, ',', ' ') }}
                        </span>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="13" style="text-align: right">
                    <?php $quantity_import = 0; ?>
                    @foreach($stocks as $key => $article)
                        @foreach($article as $k => $val)
                            <?php
                            $quantity_import += $val['weight'];
                            ?>
                        @endforeach
                    @endforeach
                    <span style="float: right" class="bold">
                        ВСИЧКО ВНОС: {{ number_format($quantity_import/1000, 3, ',', ' ') }}
                    </span>
                </td>
            </tr>
        @else
            <?php
            $quantity_import = 0;
            ?>
        @endif
        {{-- ИЗНОС --}}
        @if(count($xcertificates_year) != 0)
            <tr>
                <td colspan="8" style="text-align: right"><span class="bold"> Сертификати износ: Брой:</span></td>
                <td><span class="bold">{{count($xcertificates_year)}}</span></td>
                <td colspan="4"></td>
            </tr>
            @foreach($stocks_export as $key => $stock)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: left"><span >{{ $key }}</span></td>
                    <td class="rowDataSd" >
                        <?php $total = 0; ?>
                        @foreach ($stock as $val)
                            <?php
                            $total += array_sum((array) $val['weight']);
                            ?>
                        @endforeach
                        <span style="float: right">
                            {{ number_format($total / 1000, 3, ',', ' ') }}
                        </span>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="13" style="text-align: right">
                    <?php $quantity_export = 0; ?>
                    @foreach($stocks_export as $key => $article)
                        @foreach($article as $k => $val)
                            <?php
                            $quantity_export += $val['weight'];
                            ?>
                        @endforeach
                    @endforeach
                    <span style="float: right" class="bold">
                        ВСИЧКО ИЗНОС: {{ number_format($quantity_export/1000, 3, ',', ' ') }}
                    </span>
                </td>
            </tr>
        @else
            <?php
            $quantity_export = 0;
            ?>
        @endif
        {{-- ВЪТРЕШНИ --}}
        @if(count($incertificates_year) != 0)
            <tr>
                <td colspan="9" style="text-align: right"><span class="bold"> Сертификати вътрешни: Брой:</span></td>
                <td><span class="bold">{{count($incertificates_year)}}</span></td>
                <td colspan="3"></td>
            </tr>
            @foreach($stocks_internal as $key => $stock)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: left"><span >{{ $key }}</span></td>
                    <td class="rowDataSd" >
                        <?php $total = 0; ?>
                        @foreach ($stock as $val)
                            <?php
                            $total += array_sum((array) $val['weight']);
                            ?>
                        @endforeach
                        <span style="float: right">
                            {{ number_format($total / 1000, 3, ',', ' ') }}
                        </span>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="13" style="text-align: right">
                    <?php $quantity_internal = 0; ?>
                    @foreach($stocks_internal as $key => $article)
                        @foreach($article as $k => $val)
                            <?php
                            $quantity_internal += $val['weight'];
                            ?>
                        @endforeach
                    @endforeach
                    <span style="float: right" class="bold">
                        ВСИЧКО ВЪТРЕШНИ: {{ number_format($quantity_internal/1000, 3, ',', ' ') }}
                    </span>
                </td>
            </tr>
        @else
            <?php
            $quantity_internal = 0;
            ?>
        @endif
        {{-- ЗА ПРЕРАБОТКА --}}
        @if(count($certificates_year_cons) != 0)
            <tr>
                <td colspan="10" style="text-align: right"><span class="bold"> Сертификати ЗА ПРЕРАБОТКА: Брой:</span></td>
                <td><span class="bold">{{count($certificates_year_cons)}}</span></td>
                <td colspan="2"></td>
            </tr>
            @foreach($stocks_consume as $key => $stock)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: left"><span >{{ $key }}</span></td>
                    <td class="rowDataSd" >
                        <?php $total = 0; ?>
                        @foreach ($stock as $val)
                            <?php
                            $total += array_sum((array) $val['weight']);
                            ?>
                        @endforeach
                        <span style="float: right">
                            {{ number_format($total / 1000, 3, ',', ' ') }}
                        </span>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="13" style="text-align: right">
                    <?php $quantity_consume = 0; ?>
                    @foreach($stocks_consume as $key => $article)
                        @foreach($article as $k => $val)
                            <?php
                                $quantity_consume  += $val['weight'];
                            ?>
                        @endforeach
                    @endforeach
                    <span style="float: right" class="bold">
                        ВСИЧКО ИЗНОС: {{ number_format($quantity_consume/1000, 3, ',', ' ') }}
                    </span>
                </td>
            </tr>
        @else
            <?php
            $quantity_consume = 0;
            ?>
        @endif
    </tbody>

    <tfoot>
        <tr>
            <td class="foot bottom">{{count($certificates_year) + count($certificates_year_cons) + count($xcertificates_year) + count($incertificates_year) + count($protocols_year) + count($compliance_year)}}</td>
            <td class="foot bottom">{{count($protocols_year)}}</td>
            <td class="foot bottom">{{count($compliance_year)}}</td>
            <td class="foot bottom"></td>
            <td class="foot bottom">
                <?php $quantity = 0; ?>
                @foreach($stocks_compliance as $key => $article)
                    @foreach($article as $k => $val)
                        <?php
                            $quantity += $val['quantity'];
                        ?>
                    @endforeach
                @endforeach
                <span style="float: right">
                    {{ number_format($quantity/1000, 3, ',', ' ') }}
                </span>
            </td>
            <td class="foot bottom"></td>
            <td class="foot bottom"></td>
            <td class="foot bottom">{{count($certificates_year)}}</td>
            <td class="foot bottom">{{count($xcertificates_year)}}</td>
            <td class="foot bottom">{{count($incertificates_year)}}</td>
            <td class="foot bottom">{{count($certificates_year_cons)}}</td>
            <td class="foot bottom"></td>
            <td class="foot bottom">
                {{ number_format(($quantity_import + $quantity_export + $quantity_internal + $quantity_consume)/1000, 3, ',', ' ') }}
            </td>
        </tr>
    </tfoot>
</table>