@if(count($factory)> 0)
    <?php
        if($factory['type_location'] == 1){
            $tvm = 'гр. ';
        }
        if($factory['type_location'] == 2){
            $tvm = 'с. ';
        }
        $firm_name = $tvm.$factory['location'];

        foreach($regions_return as $value){
            if($value['id'] == $factory['areas_id']){
                $area = $value['areas_name'];
            }
        }
    ?>
    <div class="col-md-12" id="firm_select">
        <div class="col-md-8 select_cols" >
            <p>Име на Фирмата: <span class="bold">{!! mb_strtoupper($factory['name'], "utf-8") !!}</span> с ЕИК/Булстат: <span class="bold">{!! $factory['bulstat'] !!}</span></p>
            <p>
                <span class="bold">{!! $firm_name !!}</span>, п.к. <span class="bold">{!! $factory['postal_code'] !!}</span>, общ. <span class="bold">{!! $district_name !!}</span>, обл. <span class="bold">{!! $area !!}</span>
            </p>
            <p>
                С адрес: <span class="bold">{!! $factory['address'] !!}</span>
            </p>
            <p>Телефон: <span class="bold">{!! $factory['phone'] !!}</span> Мобилен: <span class="bold">{!! $factory['mobil'] !!}</span> E-mail: <span class="bold">{!! $factory['email'] !!}</span></p>
        </div>
        @if(strlen($factory['owner']) > 0)
            <div class="col-md-4 select_cols">
                <p class="bold">Управител/Представител на фирмата:</p>
                <p>Трите имена: <span class="bold">{!! $factory['owner'] !!}</span></p>
                <p>ЕГН: <span class="bold">{!! $factory['egn'] !!}</span></p>
            </div>
        @endif
        <input type="hidden" value="{!! $factory['id'] !!}" name="id_factory" id="id_factory">
    </div>
@else
    <div class="col-md-12" id="firm_select">
        <h3>ПЪРВО ИЗБЕРИ ФИРМА ПРОИЗВОДИТЕЛ!</h3>
        <input type="hidden" value="0" name="id_factory" id="id_factory">
    </div>
@endif

