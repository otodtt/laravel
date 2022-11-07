<?php
if($object_type == 1){
    $object = $pharmacy;
}
if($object_type == 2){
    $object = $repository;
}
if($object_type == 3){
    $object = $workshop;
}
/////////////////////////////
if ($object->number_licence <= 9) {
    $number_view = '00' . $object->number_licence;
} elseif ($object->number_licence <= 99) {
    $number_view = '0' . $object->number_licence;
} else {
    $number_view = $object->number_licence;
}

    $number_licence = $object->index_licence . ' ' . $number_view;
    ///////////////////////////////////////
    if ($firm->type_firm == 1) {
        $et = 'ET';
    } else {
        $et = '';
    }
    if ($firm->type_firm == 2) {
        $ood = 'ООД';
    } elseif ($firm->type_firm == 3) {
        $ood = 'ЕООД';
    } elseif ($firm->type_firm == 4) {
        $ood = 'АД';
    } else {
        $ood = '';
    }
    //////////////////////////////////
    if ($object->type_location == 1) {
        $town_object = 'гр.';
    } elseif ($object->type_location == 2) {
        $town_object = 'с.';
    } else {
        $town_object = 'гр. / с.';
    }
    //////////////////////////////////
    if ($firm->type_location == 1) {
        $grad_selo = 'гр.';
    } elseif ($firm->type_location == 2) {
        $grad_selo = 'с.';
    } else {
        $grad_selo = 'гр. / с.';
    }
    /////////////////////////////////////
    if ($object->certificate <= 9) {
        $certificate_number = '000' . $object->certificate;
    } elseif ($object->certificate <= 99) {
        $certificate_number = '00' . $object->certificate;
    } elseif ($object->certificate <= 999) {
        $certificate_number = '0' . $object->certificate;
    } else {
        $certificate_number = $object->certificate;
    }
    ////////////////////////////////

    $destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'objects'.DIRECTORY_SEPARATOR.'documents_all'.DIRECTORY_SEPARATOR.'doc_editions'.DIRECTORY_SEPARATOR); // upload path
    $files = scandir($destinationPath);
    $files_date_sort = str_replace('_edition_body.blade.php', '', $files);
    $files_date = array_sort_recursive($files_date_sort);

    foreach($files_date as $file){
        if($object->date_change >= (int)$file && (int)$file != 0){
            $start_date = (int)$file;
        }
    }

?>
@include('objects.documents_all.doc_editions.'.$start_date.'_edition_body')