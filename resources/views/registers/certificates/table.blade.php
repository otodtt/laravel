<table  id="example" class="display my_table table-striped "  >
    <thead >
    <tr >
        <th class="nomred">№ по ред</th>
        <th class="vh_number" >Вх. № на Заявлението за издаване на Сертификат за използване на ПРЗ от професионална категория на употреба по чл. 83  от ЗЗР </th>
        <th class="vh_number" >№ на Сертификата/ дата</th>
        <th class="" >Срок на валидност на Сертификата</th>
        <th class="" >Име, презиме, фамилия на притежателя на сертификата</th>
        <th class="" >Постоянен адрес</th>
        <th class="phone" >Телефон/ GSM</th>
        <th class="" >е-mail:</th>
        <th class="" >№ и дата на Диплома за висше образование в областта на аграрните науки с направление "Растителна защита или "Растениевъдство"</th>
        <th class="" >№ и дата на Документ за преминато обучение по чл. 84, ал. 2 от ЗЗР/ Обучаваща институция </th>
    </tr>

    </thead>
    <tbody >
        <tr>
            <td class="middle" >A</td>
            <td class="middle" >B</td>
            <td class="middle" >C</td>
            <td class="middle" >D</td>
            <td class="middle" >E</td>
            <td class="middle" >F</td>
            <td class="middle" >G</td>
            <td class="middle" >H</td>
            <td class="middle" >I</td>
            <td class="middle" >J</td>
        </tr>
        <?php
        $n = 1;
        $cz = 0;
        ?>
        @foreach($certificates as $certificate)
            <?php
                if($certificate->number <= 9){
                    $number = '000'.$certificate->number;
                }
                elseif($certificate->number <= 99){
                    $number = '00'.$certificate->number;
                }
                elseif($certificate->number <= 999){
                    $number = '0'.$certificate->number;
                }
                else{
                    $number = $certificate->number;
                }
                ///////////
                if($certificate->limit_certificate == 1){
                    $limit = 'безсрочен';
                    $document_no_limit = $certificate->series.' № '.$certificate->number_diploma.'/'.$certificate->date_diploma;
                    $document_limit = '';
                }
                if($certificate->limit_certificate == 2){
                    $limit = date('d.m.Y', $certificate->to_date);
                    $document_no_limit = '';
                    $document_limit = $certificate->series.' № '.$certificate->number_diploma.'/'.$certificate->date_diploma;
                }
            ?>
            <tr class="<?=($cz++%2==1) ? 'odd' : 'even' ?>" >
                <td class="txt num_row" >{!! $n++ !!}</td>
                <td class="txt" >{!! $certificate->index_petition.' - '.$certificate->petition !!} / {!! date('d.m.Y', $certificate->date_petition) !!}</td>
                <td class="txt" >{!! $certificate->index_cert.'-'.$number !!}/{!! date('d.m.Y', $certificate->date) !!}</td>
                <td class="txt" >{!! $limit !!}</td>
                <td class="txt" >{!! $certificate->name !!}</td>
                <td class="txt" >{!! $certificate->address !!}</td>
                <td class="txt" >{!! $certificate->phone !!}</td>
                <td class="txt" >{!! $certificate->email !!}</td>
                <td class="txt" >{!! $document_no_limit !!}</td>
                <td class="txt" >{!! $document_limit !!}</td>
            </tr>
        @endforeach
    </tbody >
</table>