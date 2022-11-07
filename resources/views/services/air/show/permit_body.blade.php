<?php
    $year = date('Y', time());

    if ($permit->type_firm == 1) {
        $et = '';
        $ood = '';
        $egn_eik = 'ЕГН';
    }  elseif ($permit->type_firm == 2) {
        $et = 'ET "';
        $ood = '" ';
        $egn_eik = 'УРН';
    } elseif ($permit->type_firm == 3) {
        $et = '"';
        $ood = '" ООД';
        $egn_eik = 'УРН';
    } elseif ($permit->type_firm == 4) {
        $et = '"';
        $ood = '" ЕООД';
        $egn_eik = 'УРН';
    } elseif ($permit->type_firm == 5) {
        $et = '"';
        $ood = '" АД';
        $egn_eik = 'УРН';
    } elseif ($permit->type_firm == 6) {
        $et = '';
        $ood = '';
        $egn_eik = 'УРН';
    } elseif ($permit->type_firm == 7) {
        $et = '';
        $ood = '';
        $egn_eik = 'УРН';
        $owner = $permit->owner;
    } else {
        $et = '';
        $ood = '';
    }
    ///
    if($permit->type_location == 1){
        $tvm = 'гр. ';
    }
    elseif($permit->type_location == 2){
        $tvm = 'с. ';
    }
    else{
        $tvm = 'гр./с. ';
    }
    //////////////////////////////////
    $destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'opinions'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR); // upload path
    $files = scandir($destinationPath);

    $files_date_sort = str_replace('_opinion_body.blade.php', '', $files);
    $files_date = array_sort_recursive($files_date_sort);
    foreach($files_date as $file){
        if($permit->date_permit >= (int)$file && (int)$file != 0){
            $start_date = $file;
        }
    }
?>
@include('services.air.templates.'.$start_date.'_permit_body')
