<?php
$destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR); // upload path
$files = scandir($destinationPath);

$files_date = str_replace('_logo.blade.php', '', $files);
//$proba = '01.01.2000';
foreach($files_date as $file){
    if($protocol->date_protocol >= (int)$file && (int)$file != 0){
        $start_date = $file;
    }
}
?>
@include('layouts.logo.'.$start_date.'_logo')