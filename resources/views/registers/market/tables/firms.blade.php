<table  id="example" class="display my_table table-striped "  >
    <thead >
    <tr >
        <th rowspan="2" class="num_row">№ по ред</th>
        <th rowspan="2" class="vh_number" >Вх. № на Заявлението за издаване на удостоверение</th>
        <th colspan="2" class="licence_number" >№ / дата на Удостоверение</th>
        <th colspan="3" class="address_obj" >Адреса на обекта</th>
        <th rowspan="2" class="ime" >Наименование на юридическото лице или ЕТ</th>
        <th rowspan="2" class="address" >Адрес на управление</th>
        <th rowspan="2" class="object" style="width: 6%" >ЕИК/ БУЛСТАТ</th>
        <th rowspan="2" class="phone" style="width: 7%" >Телефон/ GSM</th>
        <th rowspan="2" class="mail" style="width: 5%" >е-mail:</th>
        <th rowspan="2" class="diploma" style="width: 160px">Име на лицето извършващо дейността в обекта и № на сертификата по чл. 83 от ЗЗР</th>
    </tr>
    <tr>
        <th class="middle_top licence_obj" >Търговия с ПРЗ</th>
        <th class="middle_top licence_obj" >Преопаковане на ПРЗ</th>
        <th class="middle_top type_obj" style="width: 90px" >СС аптека</th>
        <th class="middle_top type_obj" style="width: 90px" >Склад</th>
        <th class="middle_top type_obj" style="width: 90px" >Цех</th>
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
        <td class="middle" >K</td>
        <td class="middle" >L</td>
        <td class="middle" >M</td>
    </tr>
    <?php
    $n = 1;
    $cz = 0;
    ?>
    @foreach($objects as $object)
        <?php
        if($object['number_licence'] <= 9){
            $number_view = '00'.$object['number_licence'];
        }
        elseif($object['number_licence'] <= 99){
            $number_view = '0'.$object['number_licence'];
        }
        else{
            $number_view = $object['number_licence'];
        }
        $petition = $object['index_petition'].' '.$object['number_petition'].' / '.date('d.m.Y', $object['date_petition']);
        if($object['index_licence'] == 262){
            $licence_obj = '';
            $licence_ceh = $object['index_licence'].'-'.$number_view.' / '.date('d.m.Y', $object['date_licence']);
        }
        else{
            $licence_obj = $object['index_licence'].'-'.$number_view.' / '.date('d.m.Y', $object['date_licence']);
            $licence_ceh = '';
        }

        if($object['type_location'] == 1){
            $type_location = 'гр. ';
        }
        if($object['type_location'] == 2){
            $type_location = 'с. ';
        }
        if($object['index_licence'] == 26 || $object['index_licence'] == 260){
            $address_skl = $type_location.' '.$object['location'].', '.$object['address'];
            $address_apt = '';
            $address_ceh = '';
        }
        if($object['index_licence'] == 261){
            $address_skl = '';
            $address_apt = $type_location.' '.$object['location'].', '.$object['address'];
            $address_ceh = '';
        }
        if($object['index_licence'] == 262){
            $address_skl = '';
            $address_apt = '';
            $address_ceh = $type_location.' '.$object['location'].', '.$object['address'];
        }
        if($object['certificate'] <= 9){
            $number_certificate = '000'.$object['certificate'];
        }
        elseif($object['certificate'] <= 99){
            $number_certificate = '00'.$object['certificate'];
        }
        elseif($object['certificate'] <= 999){
            $number_certificate = '0'.$object['certificate'];
        }
        else{
            $number_certificate = $object['certificate'];
        }
        $seller = $object['seller'].' - '.$object['index_licence'].'-'.$number_certificate.' / '.$object['date_certificate'];

        foreach($firms as $firm){
            if($firm->id == $object['firm_id']){
                if($firm->type_firm == 1){
                    $et = 'ЕТ ';
                    $ood = '';
                }
                if($firm->type_firm == 2){
                    $et = '';
                    $ood = ' ООД';
                }
                if($firm->type_firm == 3){
                    $et = '';
                    $ood = ' ЕООД';
                }
                if($firm->type_firm == 4){
                    $et = '';
                    $ood = ' АД';
                }
                $name_firm = $et.' "'.$firm->name.'" '.$ood;
                if($firm->type_location == 1){
                    $gr_sel_firm = 'гр. ';
                }
                if($firm->type_location == 2){
                    $gr_sel_firm = 'с. ';
                }
                $address_firm = $gr_sel_firm.' '.$firm->location.', '.$firm->address;
                $bulstat_firm = $firm->bulstat;
                $email_firm = $firm->email;
                if(strlen($firm->mobil)>0 && strlen($firm->phone)>0){
                    $phone_firm = $firm->mobil;
                }
                if(strlen($firm->mobil)>0 && strlen($firm->phone)==0){
                    $phone_firm = $firm->mobil;
                }
                if(strlen($firm->mobil)==0 && strlen($firm->phone)>0){
                    $phone_firm = $firm->phone;
                }
                if(strlen($firm->mobil)==0 && strlen($firm->phone)==0){
                    $phone_firm = '';
                }
            }
        }
        ?>
        <tr class="<?=($cz++%2==1) ? 'odd' : 'even' ?>" >
            <td class="txt num_row" >{{  $n++ }}</td>
            <td class="txt" >{{ $petition }}</td>
            <td class="txt" >{{ $licence_obj }}</td>
            <td class="txt" >{{ $licence_ceh }}</td>
            <td class="txt" >{{ $address_apt }}</td>
            <td class="txt" >{{ $address_skl }}</td>
            <td class="txt" >{{ $address_ceh }}</td>
            <td class="txt" >{{ $name_firm }}</td>
            <td class="txt" >{{ $address_firm }}</td>
            <td class="txt" >{{ $bulstat_firm }}</td>
            <td class="txt" >{{ $phone_firm }}</td>
            <td class="txt" style="width: 5%" >{{ $email_firm }}</td>
            <td class="txt" >{{ $seller }}</td>
        </tr>
    @endforeach
    </tbody>
</table>