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

    if(Input::has('abc')){
        $sort_abc = Input::get('abc');
    }
    else{
        $sort_abc = $abc;
    }

    for ($i = 0 ;  $i <$ic ; ++$i) {
        $keys =null;
        foreach ($alphabet as $v){
            if($v === $i){
                if($sort_abc == $i){
                    echo '<a href="/дневници/сортирай/'.$i.'/'.$year_now.'  " class="alphabet alphabet_mark" name="abc" >[ '.$alphabet_bg[$i].' ]</a>&nbsp;&nbsp;';
                    $keys = $i;
                    break;
                }
                else{
                    echo '<a href="/дневници/сортирай/'.$i.'/'.$year_now.' " class="alphabet" name="abc">'.$alphabet_bg[$i].'</a>&nbsp;&nbsp;';
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
        <a href="/дневници/сортирай/0/{!! $year_now !!}" class="fa fa-list-ol btn btn-primary my_btn" name="abc" > Всички</a>
    </div>
</div>