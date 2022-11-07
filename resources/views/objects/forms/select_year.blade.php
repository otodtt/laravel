<?php
    $year_now = date('Y', time());

    $year_1 = date('Y', time());
    $year_2 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 1 year"));
    $year_3 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 2 year"));
    $year_4 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 3 year"));
    $year_5 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 4 year"));
    $year_6 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 5 year"));
    $year_7 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 6 year"));
    $year_8 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 7 year"));
    $year_9 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 8 year"));
    $year_10 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 9 year"));
    $year_11 = date('Y', strtotime(date("Y", strtotime($year_now)) . " + 10 year"));

    $years_sort = [
            0 => 'Избери година',
            $year_1 => $year_1,
            $year_2 => $year_2,
            $year_3 => $year_3,
            $year_4 => $year_4,
            $year_5 => $year_5,
            $year_6 => $year_6,
            $year_7 => $year_7,
            $year_8 => $year_8,
            $year_9 => $year_9,
            $year_10 => $year_10,
            $year_11 => $year_11,
    ];
?>
{!! Form::label('years_sort', ' Валидно до:', ['class'=>'labels']) !!}
{!! Form::select('years_sort', $years_sort, $sort_years,['id' => 'years', 'class'=>'form-control form-control-my-search search_years']) !!}

