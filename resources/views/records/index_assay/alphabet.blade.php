<?php
$alphabet_bg= array(0=>'', 1=>'А', 2=>'Б', 3=>'В', 4=>'Г', 5=>'Д', 6=>'Е', 7=>'Ж', 8=>'З', 9=>'И', 10=>'Й',
        11=>'К', 12=>'Л', 13=>'М', 14=>'Н', 15=>'О', 16=>'П', 17=>'Р', 18=>'С',	19=>'Т', 20=>'У',
        21=>'Ф', 22=>'Х', 23=>'Ц', 24=>'Ч', 25=>'Ш', 26=>'Щ', 27=>'Ъ',	28=>'Ь', 29=>'Ю', 30=>'Я');
/*
 * Показваме всички букви от двете азбуку и тези които имаме са линковае
 * ТОВА Е ДОБРЕ И С ЛИНКОВЕТЕ
 */
echo '<div class="alf_wrap ">';
$ic=count($alphabet_bg);

if(Input::has('start_year') || Input::has('end_year') || Input::has('ot_object') || Input::has('inspector_sort') || Input::has('abc')){
    $sort_abc = Input::get('abc');
    $start_years = Input::get('start_year');
    $end_years =  Input::get('end_year');
    $sort_object_return =  Input::get('ot_object');
    $sort_inspector_return =  Input::get('inspector_sort');

    if((int)$start_years == 0){
        $start_years = 0;
    }
    if((int)$end_years == 0){
        $end_years = 0;
    }
    if((int)$sort_object_return == 0){
        $sort_object_return = 0;
    }
    if((int)$sort_inspector_return == 0){
        $sort_inspector_return = 0;
    }
}
else{
    $sort_abc = $abc;
    if(isset($years_start_sort) || isset($years_end_sort) || isset($sort_object) || isset($sort_inspector)){
        $start_years = $years_start_sort;
        $end_years = $years_end_sort;
        $sort_object_return =  $sort_object;
        $sort_inspector_return =  $sort_inspector;
    }
    else{
        $start_years = 0;
        $end_years =  0;
        $sort_object_return =  0;
        $sort_inspector_return =  0;
    }
}

for ($i = 0 ;  $i <$ic ; ++$i) {
    $keys =null;
    foreach ($alphabet as $v){
        if($v === $i){
            if($sort_abc == $i){
                echo '<a href="/протоколи-проби/сортирай/'.$i.'/'.$start_years.'/'.$end_years.'/'.$sort_object_return.'/'.$sort_inspector_return.'
                " class="alphabet alphabet_mark" name="abc" >[ '.$alphabet_bg[$i].' ]</a>&nbsp;&nbsp;';
                $keys = $i;
                break;
            }
            else{
                echo '<a href="/протоколи-проби/сортирай/'.$i.'/'.$start_years.'/'.$end_years.'/'.$sort_object_return.'/'.$sort_inspector_return.'
                " class="alphabet" name="abc">'.$alphabet_bg[$i].'</a>&nbsp;&nbsp;';
                $keys = $i;
                break;
            }
        }
    }
    if($i!==$keys){
        echo '<span class="alphabet_not">'.$alphabet_bg[$i].'</span>&nbsp;&nbsp;';
    }
}
?>
<div class="wrap_alphabet_reset">
    <a href="/протоколи-проби/сортирай/0/{!! $start_years !!}/{!! $end_years !!}/{!! $sort_object_return !!}/{!! $sort_inspector_return !!}
            " class="fa fa-list-ol btn btn-primary my_btn" name="abc" > Всички</a>
</div>
</div>