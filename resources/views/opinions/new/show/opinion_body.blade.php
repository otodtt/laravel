<?php
    $year = date('Y', time());

    if ($opinion->type_firm == 1) {
        $et = '';
        $ood = '';
        $owner = $opinion->name;
    }  elseif ($opinion->type_firm == 2) {
        $et = 'ET "';
        $ood = '" ';
        $owner = $opinion->owner;
    } elseif ($opinion->type_firm == 3) {
        $et = '"';
        $ood = '" ООД';
        $owner = $opinion->owner;
    } elseif ($opinion->type_firm == 4) {
        $et = '"';
        $ood = '" ЕООД';
        $owner = $opinion->owner;
    } elseif ($opinion->type_firm == 5) {
        $et = '"';
        $ood = '" АД';
        $owner = $opinion->owner;
    } elseif ($opinion->type_firm == 6) {
        $et = '';
        $ood = '';
        $owner = $opinion->owner;
    } elseif ($opinion->type_firm == 7) {
        $et = '';
        $ood = '';
        $owner = $opinion->owner;
    } else {
        $et = '';
        $ood = '';
        $owner = $opinion->name;
    }
    ///
    if($opinion->tvm == 1){
        $tvm = 'гр. ';
    }
    elseif($opinion->tvm == 2){
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
        if($opinion->date_petition >= (int)$file && (int)$file != 0){
            $start_date = $file;
        }
    }
?>
@include('opinions.templates.'.$start_date.'_opinion_body')
