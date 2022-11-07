<?php
///////////////////////////////////
if ($certificate->number <= 9) {
    $certificate_number = '000' . $certificate->number;
} elseif ($certificate->number <= 99) {
    $certificate_number = '00' . $certificate->number;
} elseif ($certificate->number <= 999) {
    $certificate_number = '0' . $certificate->number;
} else {
    $certificate_number = $certificate->number;
}
//////////////////////////////////
if ($certificate->limit_certificate == 1) {
    $valid = 'БЕЗСРОЧЕН';
} else {
    $date_now = time();
    if ($date_now > $certificate->to_date) {
        $valid = 'Изтекъл срок';
    } else {
        $valid = date('d.m.Y', $certificate->to_date).' г.';
    }
}
/////
$img_src = 'certificates_pic'.DIRECTORY_SEPARATOR.''.$certificate->index_cert.'_'.$certificate_number.DIRECTORY_SEPARATOR.$certificate->user_pic;

$destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'certificates'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR); // upload path
$files = scandir($destinationPath);
$files_date_sort = str_replace('_certificate_body.blade.php', '', $files);
$files_date = array_sort_recursive($files_date_sort);
foreach($files_date as $file){
    if($certificate->date >= (int)$file && (int)$file != 0){
        $start_date = $file;
    }
}
?>
@include('certificates.templates.'.$start_date.'_certificate_body')
