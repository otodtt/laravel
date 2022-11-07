<?php

namespace odbh\Providers;

use Illuminate\Support\ServiceProvider;

use Input;
use Validator;
use DB;
use odbh\Director;

class AppServiceProvider extends ServiceProvider
{
    ////////////// Мой код за Валидация на БУЛСТАТ
    const EIK9_LENGTH = 9;
    const EIK13_LENGTH = 13;
    const EIK13_PART_LENGTH = 5;

    const MODUL = 11;
    const MODUL_MAGIC = 10;
    ////////////// КРАЙ Мой код за Валидация на БУЛСТАТ

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('cyrillic', function($attribute, $value)
        {
            $pattern = "/^[\p{Cyrillic} \ \-\.]+$/u";
            return trim(preg_match($pattern, $value));
        });

        Validator::extend('cyrillic_names', function($attribute, $value)
        {
            $pattern = "/^[\p{Cyrillic}0-9\s \ \-\. 0-9]+$/u";
            return trim(preg_match($pattern, $value));
        });

        Validator::extend('cyrillic_names_objects', function($attribute, $value)
        {
            $pattern = "/^[\p{Cyrillic} \ \, \; \.]+$/u";
            return trim(preg_match($pattern, $value));
        });

        Validator::extend('only_cyrillic', function($attribute, $value)
        {
            $pattern = "/^[\p{Cyrillic} ]+$/u";
            return trim(preg_match($pattern, $value));
        });

        Validator::extend('cyrillic_with', function($attribute, $value)
        {
            $pattern = "/^[\p{Cyrillic}0-9\s -\ –\"\'\-\, _\.\; \“ \” \„ \” \/ ! ? ! ? N № 0-9]+$/u";
            return trim(preg_match($pattern, $value));
        });

        Validator::extend('latin', function($attribute, $value)
        {
            $pattern = '/^[\w\d\s-_]*$/';
            return trim(preg_match($pattern, $value));
        });

        Validator::extend('min_date_create', function($attribute, $value)
        {
            $end_date = '01.01.2030';
            $query = new Director();
            $query = DB::table('directors') ->select('*')
                    ->where('end_date', '=',strtotime($end_date))
                    ->where('start_date', '>=', strtotime($value))
                    ->get();
            if(!empty($query)){
                return false;
            }
            return true;
        });

        Validator::extend('min_date_update', function($attribute, $value)
        {
            $end_date = '01.01.2030';
            $query = new Director();
            $query = DB::table('directors') ->select('*')
                        ->where('end_date', '!=',strtotime($end_date))
                        ->where('start_date', '>=', strtotime($value))
                        ->get();
            if(!empty($query)){
                return false;
            }
            return true;
        });

        Validator::extend('all_phone_validate', function($attribute, $value)
        {
            $trim_value = trim($value);
            if($pattern = preg_match('/^[0-9]{3}\/[0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{3}\/[0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{3}\/ [0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{3}\/ [0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/ [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/[0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/ [0-9]{4}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/[0-9]{4}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/ [0-9]{2} [0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/ [0-9]{4} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/[0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/[0-9]{4} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2} [0-9]{4} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/[0-9]{7}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/ [0-9]{7}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2} [0-9]{7}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{9}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/[0-9]{3} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/ [0-9]{3} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/[0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/ [0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/ [0-9]{5}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/[0-9]{5}$/', $trim_value)){
                return true;
            }

            if($pattern = preg_match('/^[0-9]{4}\/[0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4}\/ [0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4}\/[0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4}\/ [0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4} [0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
        });

        Validator::extend('phone_validate', function($attribute, $value)
        {
            $trim_value = trim($value);
            if($pattern = preg_match('/^[0-9]{3}\/[0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{3}\/[0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{3}\/ [0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{3}\/ [0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/ [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/[0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/ [0-9]{4}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{5}\/[0-9]{4}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/ [0-9]{2} [0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/ [0-9]{4} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/[0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/[0-9]{4} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2} [0-9]{4} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/[0-9]{7}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2}\/ [0-9]{7}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{2} [0-9]{7}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{9}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/[0-9]{3} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/ [0-9]{3} [0-9]{2}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/[0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/ [0-9]{2} [0-9]{3}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/ [0-9]{5}$/', $trim_value)){
                return true;
            }
            elseif($pattern = preg_match('/^[0-9]{4}\/[0-9]{5}$/', $trim_value)){
                return true;
            }
        });

        Validator::extend('mobile_validate', function($attribute, $value) {
            $trim_value = trim($value);
            if($pattern = preg_match('/^[0-9]{4}\/[0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4}\/ [0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4}\/[0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4}\/ [0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4} [0-9]{3} [0-9]{3}$/', $trim_value)){
                return true;
            }
            if($pattern = preg_match('/^[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}$/', $trim_value)){
                return true;
            }
        });

        //////////////////////
        Validator::extend('pin_validate', function($attribute, $value) {

            $name = Input::get('owner');
            $gender_inp = Input::get('gender');
            $pin_inp = $value;
            if (isset($name) && isset($gender_inp) && isset($pin_inp)) {
                $isValidData = true;
                $gender = $gender_inp;
                $genderValue = (($gender == "male") ? 0 : 1);

                $nameString = $name;
                $namePattern = '/^[a-zA-Z\p{Cyrillic}\d\s\-]+$/u';

                preg_match($namePattern, $nameString, $name);

                $pinString = $pin_inp;
                $pinPattern = "/[0-9]{10}/";
                preg_match($pinPattern, $pinString, $pin);

                if (empty($name) || empty($pin)) {
                    $isValidData = false;
                } else {
                    $name = $name[0];
                    $pin = $pin[0];

                    $year = substr($pin,0,2);
                    $month = substr($pin,2,2);
                    $day = substr($pin,4,2);

                    if ($month > 40) {
                        $month -= 40;
                        $year = "20".$year;
                    } elseif ($month > 20) {
                        $year = "18".$year;
                        $month -= 20;
                    } else {
                        $year = "19".$year;
                    }

                    $dateStr = $day."-".$month."-".$year;
                    $date = date_create($dateStr, timezone_open("Europe/Sofia"));
                    if (!$date) {
                        return false;
                    }
                    $monthChk = date_format($date, "m");
                    if ($monthChk != $month) {
                        return false;
                    }

                    $genderChk = substr($pin,8,1);
                    if ($genderChk % 2 != $genderValue) {
                        return false;
                    }

                    $sumChk = substr($pin,9,1);
                    $weights = [2,4,8,5,10,9,7,3,6];
                    $sum = 0;
                    for ($i = 0; $i < 9; $i++) {
                        $sum += substr($pin,$i,1) * $weights[$i];
                    }
                    $sum = $sum % 11 % 10;
                    if($sum != $sumChk) {
                        return false;
                    }
                    return true;
                }
            }
            return false;
        });

        //////////////////////
        Validator::extend('pin_farmer', function($attribute, $value) {

            $name = Input::get('name_farmer');
            $gender_inp = Input::get('gender_farmer');
            $pin_inp = $value;
            if (isset($name) && isset($gender_inp) && isset($pin_inp)) {
                $isValidData = true;
                $gender = $gender_inp;
                $genderValue = (($gender == "male") ? 0 : 1);

                $nameString = $name;
                $namePattern = '/^[a-zA-Z\p{Cyrillic}\d\s\-]+$/u';

                preg_match($namePattern, $nameString, $name);

                $pinString = $pin_inp;
                $pinPattern = "/[0-9]{10}/";
                preg_match($pinPattern, $pinString, $pin);

                if (empty($name) || empty($pin)) {
                    $isValidData = false;
                } else {
                    $name = $name[0];
                    $pin = $pin[0];

                    $year = substr($pin,0,2);
                    $month = substr($pin,2,2);
                    $day = substr($pin,4,2);

                    if ($month > 40) {
                        $month -= 40;
                        $year = "20".$year;
                    } elseif ($month > 20) {
                        $year = "18".$year;
                        $month -= 20;
                    } else {
                        $year = "19".$year;
                    }

                    $dateStr = $day."-".$month."-".$year;
                    $date = date_create($dateStr, timezone_open("Europe/Sofia"));
                    if (!$date) {
                        return false;
                    }
                    $monthChk = date_format($date, "m");
                    if ($monthChk != $month) {
                        return false;
                    }

                    $genderChk = substr($pin,8,1);
                    if ($genderChk % 2 != $genderValue) {
                        return false;
                    }

                    $sumChk = substr($pin,9,1);
                    $weights = [2,4,8,5,10,9,7,3,6];
                    $sum = 0;
                    for ($i = 0; $i < 9; $i++) {
                        $sum += substr($pin,$i,1) * $weights[$i];
                    }
                    $sum = $sum % 11 % 10;
                    if($sum != $sumChk) {
                        return false;
                    }
                    return true;
                }
            }
            return false;
        });

        Validator::extend('pin_validate_name', function($attribute, $value) {

            $name = Input::get('name');
            $gender_inp = Input::get('gender');
            $pin_inp = $value;
            if (isset($name) && isset($gender_inp) && isset($pin_inp)) {
                $isValidData = true;
                $gender = $gender_inp;
                $genderValue = (($gender == "male") ? 0 : 1);

                $nameString = $name;
                $namePattern = '/^[a-zA-Z\p{Cyrillic}\d\s\-]+$/u';

                preg_match($namePattern, $nameString, $name);

                $pinString = $pin_inp;
                $pinPattern = "/[0-9]{10}/";
                preg_match($pinPattern, $pinString, $pin);

                if (empty($name) || empty($pin)) {
                    $isValidData = false;
                } else {
                    $name = $name[0];
                    $pin = $pin[0];

                    $year = substr($pin,0,2);
                    $month = substr($pin,2,2);
                    $day = substr($pin,4,2);

                    if ($month > 40) {
                        $month -= 40;
                        $year = "20".$year;
                    } elseif ($month > 20) {
                        $year = "18".$year;
                        $month -= 20;
                    } else {
                        $year = "19".$year;
                    }

                    $dateStr = $day."-".$month."-".$year;
                    $date = date_create($dateStr, timezone_open("Europe/Sofia"));
                    if (!$date) {
                        return false;
                    }
                    $monthChk = date_format($date, "m");
                    if ($monthChk != $month) {
                        return false;
                    }

                    $genderChk = substr($pin,8,1);
                    if ($genderChk % 2 != $genderValue) {
                        return false;
                    }

                    $sumChk = substr($pin,9,1);
                    $weights = [2,4,8,5,10,9,7,3,6];
                    $sum = 0;
                    for ($i = 0; $i < 9; $i++) {
                        $sum += substr($pin,$i,1) * $weights[$i];
                    }
                    $sum = $sum % 11 % 10;
                    if($sum != $sumChk) {
                        return false;
                    }
                    return true;
                }
            }
            return false;
        });

        Validator::extend('pin_validate_owner', function($attribute, $value) {

            $name = Input::get('owner');
            $gender_inp = Input::get('gender_owner');
            $pin_inp = $value;
            if (isset($name) && isset($gender_inp) && isset($pin_inp)) {
                $isValidData = true;
                $gender = $gender_inp;
                $genderValue = (($gender == "male") ? 0 : 1);

                $nameString = $name;
                $namePattern = '/^[a-zA-Z\p{Cyrillic}\d\s\-]+$/u';

                preg_match($namePattern, $nameString, $name);

                $pinString = $pin_inp;
                $pinPattern = "/[0-9]{10}/";
                preg_match($pinPattern, $pinString, $pin);

                if (empty($name) || empty($pin)) {
                    $isValidData = false;
                } else {
                    $name = $name[0];
                    $pin = $pin[0];

                    $year = substr($pin,0,2);
                    $month = substr($pin,2,2);
                    $day = substr($pin,4,2);

                    if ($month > 40) {
                        $month -= 40;
                        $year = "20".$year;
                    } elseif ($month > 20) {
                        $year = "18".$year;
                        $month -= 20;
                    } else {
                        $year = "19".$year;
                    }

                    $dateStr = $day."-".$month."-".$year;
                    $date = date_create($dateStr, timezone_open("Europe/Sofia"));
                    if (!$date) {
                        return false;
                    }
                    $monthChk = date_format($date, "m");
                    if ($monthChk != $month) {
                        return false;
                    }

                    $genderChk = substr($pin,8,1);
                    if ($genderChk % 2 != $genderValue) {
                        return false;
                    }

                    $sumChk = substr($pin,9,1);
                    $weights = [2,4,8,5,10,9,7,3,6];
                    $sum = 0;
                    for ($i = 0; $i < 9; $i++) {
                        $sum += substr($pin,$i,1) * $weights[$i];
                    }
                    $sum = $sum % 11 % 10;
                    if($sum != $sumChk) {
                        return false;
                    }
                    return true;
                }
            }
            return false;
        });

        ////////////////// За шаблони на докуметнтите
        Validator::extend('logo_blade', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            $file_doc_name = preg_replace('/[0-9]+/', '', $filename);

            if($pattern = preg_match('/_logo.blade.php/i', $file_doc_name)){
                return true;
            }
        });

        Validator::extend('logo_blade_length', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            if(strlen($filename) == 25){
                return true;
            }
        });

        Validator::extend('doc_blade', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            $file_doc_name = preg_replace('/[0-9]+/', '', $filename);

            if($pattern = preg_match('/_document_body.blade.php/i', $file_doc_name)){
                return true;
            }
        });

        Validator::extend('doc_blade_length', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            if(strlen($filename) == 34){
                return true;
            }
        });

        Validator::extend('edition_blade', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            $file_doc_name = preg_replace('/[0-9]+/', '', $filename);

            if($pattern = preg_match('/_edition_body.blade.php/i', $file_doc_name)){
                return true;
            }
        });

        Validator::extend('edition_blade_length', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            if(strlen($filename) == 33){
                return true;
            }
        });

        Validator::extend('certificate_blade', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            $file_doc_name = preg_replace('/[0-9]+/', '', $filename);

            if($pattern = preg_match('/_certificate_body.blade.php/i', $file_doc_name)){
                return true;
            }
        });

        Validator::extend('certificate_blade_length', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            if(strlen($filename) == 37){
                return true;
            }
        });

        Validator::extend('opinion_blade', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            $file_doc_name = preg_replace('/[0-9]+/', '', $filename);

            if($pattern = preg_match('/_opinion_body.blade.php/i', $file_doc_name)){
                return true;
            }
        });

        Validator::extend('opinion_blade_length', function($attribute, $value)
        {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            if(strlen($filename) == 33){
                return true;
            }
        });

        /////// Валидация на БУЛСТАТ
        Validator::extend('is_valid', function($attribute, $value)
        {
            $ret = false;

            if (ctype_digit($value)) {
                $len = strlen($value);

                if ($len == self::EIK9_LENGTH || $len == self::EIK13_LENGTH) {
                    if ($len == self::EIK9_LENGTH) {
                        $ret = self::validate9($value);
                    } else {
                        if (self::validate9(substr($value, 0, 9))) {
                            $ret = self::validate13(substr($value, -1 * self::EIK13_PART_LENGTH));
                        }
                    }
                }
            }
            return $ret;
        });

        Validator::extend('my_numeric', function($attribute, $value)
        {
            $switched = str_replace(',', '.', $value);
            if (is_numeric($switched) && (int)$value >0 ) {
                return true;
            }
            else{
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){}

    ////////////// Мой код за Валидация на БУЛСТАТ
    private static function validate9($eik) {
        $v_9 = array(	array(1,2,3,4,5,6,7,8),
            array(3,4,5,6,7,8,9,10)
        );


        return self::validate_n($eik, self::EIK9_LENGTH, $v_9);
    }


    private static function validate13($eik) {
        $v_13 = array(	array(2,7,3,5),
            array(4,9,5,7)
        );


        return self::validate_n($eik, self::EIK13_PART_LENGTH, $v_13);
    }


    private static function validate_n($eik, $n, $coef_arr) {
        $ret = false;

        $eik_arr = str_split($eik);

        $pass_1_sum = 0;
        for($i = 0; $i < $n - 1; $i++) {
            $pass_1_sum += $coef_arr[0][$i] * $eik_arr[$i];
        }

        $rest1 = $pass_1_sum % self::MODUL;

        if ($rest1 == 10) {
            $pass_2_sum = 0;
            for($i = 0; $i < $n - 1; $i++) {
                $pass_2_sum += $coef_arr[1][$i] * $eik_arr[$i];
            }

            $rest2 = $pass_2_sum % 11;
            if ($rest2 == self::MODUL_MAGIC) {
                $rest2 = 0;
            }

            if ($rest2 == $eik_arr[$n - 1]) {
                $ret = true;
            }
        } else {
            if ($rest1 == $eik_arr[$n - 1]) {
                $ret = true;
            }
        }
        return $ret;
    }

}
