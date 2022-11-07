<?php
    $alphabet_bg= array(0=>'', 1=>'А', 2=>'Б', 3=>'В', 4=>'Г', 5=>'Д', 6=>'Е', 7=>'Ж', 8=>'З', 9=>'И', 10=>'Й',
            11=>'К', 12=>'Л', 13=>'М', 14=>'Н', 15=>'О', 16=>'П', 17=>'Р', 18=>'С',	19=>'Т', 20=>'У',
            21=>'Ф', 22=>'Х', 23=>'Ц', 24=>'Ч', 25=>'Ш', 26=>'Щ', 27=>'Ъ',	28=>'Ь', 29=>'Ю', 30=>'Я');
    /*
     * Показваме всички букви от двете азбуку и тези които имаме са линковае
     * ТОВА Е ДОБРЕ И С ЛИНКОВЕТЕ
     */
    echo '<div class="alf_wrap">';
    $ic=count($alphabet_bg);

    if(Input::has('areas_sort') || Input::has('years_sort') || Input::has('licence_sort') || Input::has('abc')){
        $sort_abc = Input::get('abc');
        $sort_areas = Input::get('areas_sort');
        $sort_years =  Input::get('years_sort');
        $sort_licence =  Input::get('licence_sort');
    }
    else{
        $sort_abc = $abc;
        if(isset($sort_areas) || isset($years_sort) || isset($licence_sort)){
            $sort_areas = $areas_sort;
            $sort_years = $years_sort;
            $sort_licence =  $licence_sort;
        }
        else{
            $sort_areas = Input::get('areas_sort');
            $sort_years =  Input::get('years_sort');
            $sort_licence =  Input::get('licence_sort');
        }
    }
    for ($i = 0 ;  $i <$ic ; ++$i) {
        $keys =null;
        foreach ($alphabet as $v){
            if($v === $i){
                if($sort_abc == $i){
                    echo '<a href="/аптеки/сортирай/'.$i.'/'.$sort_areas.'/'.$sort_years.'/'.$sort_licence.'  " class="alfabet, ,alfmark" name="abc" >[ '.$alphabet_bg[$i].' ]</a>&nbsp;&nbsp;';
                    $keys = $i;
                    break;
                }
                else{
                    echo '<a href="/аптеки/сортирай/'.$i.'/'.$sort_areas.'/'.$sort_years.'/'.$sort_licence.' " class="alfabet" name="abc">'.$alphabet_bg[$i].'</a>&nbsp;&nbsp;';
                    $keys = $i;
                    break;
                }
            }
        }
        if($i!==$keys){
            echo '<span class="alfanot">'.$alphabet_bg[$i].'</span>&nbsp;&nbsp;';
        }
    }
    ?>
    <div class="wrap_alfrecet">
        <a href="/аптеки/сортирай/0/<?php echo $sort_areas; ?>/<?php echo $sort_years; ?>/<?php echo $sort_licence; ?>" class="fa fa-list-ol btn btn-primary my_btn" name="abc" > Всички</a>
    </div>
</div>