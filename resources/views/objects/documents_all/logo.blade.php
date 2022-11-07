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
$destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR); // upload path
$files = scandir($destinationPath);

$files_date_sort = str_replace('_logo.blade.php', '', $files);
$files_date = array_sort_recursive($files_date_sort);
foreach($files_date as $file){
    if($object->date_licence >= (int)$file && (int)$file != 0){
        $start_date = $file;
    }
}
?>
@include('layouts.logo.'.$start_date.'_logo')