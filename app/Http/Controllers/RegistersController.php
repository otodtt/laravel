<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

use odbh\Air;
use odbh\Certificate;
use odbh\FactoryProtocol;
use odbh\FarmerProtocol;
use odbh\Firm;
use odbh\Http\Requests;
use odbh\NoneProtocol;
use odbh\OldProtocol;
use odbh\Opinion;
use odbh\OtherProtocol;
use odbh\Pharmacy;
use odbh\Protocol;
use odbh\Repository;
use odbh\Set;
use odbh\Workshop;

class RegistersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control');
    }

    /**
     * Показва справка за фирмите с Удостоверение.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_firms()
    {
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }

        $firms = Firm::get();
        $pharmacies = Pharmacy::where('raz_udost','=',2)->get()->toArray();
        $repositories = Repository::where('raz_udost','=',2)->get()->toArray();
        $workshops = Workshop::where('raz_udost','=',2)->get()->toArray();
        $objects = array_merge($pharmacies, $repositories, $workshops);

        foreach ($objects as $key => $row) {
            $number[$key]  = $row['number_licence'];
            $date[$key]  = $row['date_licence'];
        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date, SORT_ASC, $number, SORT_ASC, $objects);

        return view('registers.market.index_firms', compact('objects', 'firms', 'city'));
    }

    /**
     * Показва справка за протоколите при контрол на пазара
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index_protocols(Request $request){
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $year_now = null;

        $protocols = Protocol::get();
        foreach($protocols as $protocol){
            $array[date('Y', $protocol->date_protocol)] = date('Y', $protocol->date_protocol);
        }
        $years = array_filter(array_unique($array));

        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now_key = date('Y', time());
            if(array_key_exists($year_now_key, $years)){
                $year_now = date('Y', time());
            }
            else{
                end($years);
                $year_now = key($years);
            }
        }

        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $objects_protocols = Protocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $none_protocols = NoneProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $factories_protocols = FactoryProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $others_protocols = OtherProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $all_protocols = array_merge($objects_protocols, $none_protocols, $factories_protocols, $others_protocols);
        foreach ($all_protocols as $key => $row) {
            $number[$key]  = $row['number'];
            $date[$key]  = $row['date_protocol'];
        }

        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date, SORT_ASC, $number, SORT_ASC, $all_protocols);

        return view('registers.market.index_protocols', compact('city', 'years', 'year_now', 'all_protocols'));
    }

    /**
     * Месечна справка
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index_reference(Request $request){
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $year_now = null;

        $protocols = Protocol::get();
        foreach($protocols as $protocol_year){
            $array[date('Y', $protocol_year->date_protocol)] = date('Y', $protocol_year->date_protocol);
        }
        $years = array_filter(array_unique($array));

        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now_key = date('Y', time());
            if(array_key_exists($year_now_key, $years)){
                $year_now = date('Y', time());
            }
            else{
                end($years);
                $year_now = key($years);
            }
        }

        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $objects_protocols = Protocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $none_protocols = NoneProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $factories_protocols = FactoryProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $others_protocols = OtherProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $all_protocols = array_merge($objects_protocols, $none_protocols, $factories_protocols, $others_protocols);
        foreach ($all_protocols as $key => $row) {
            $number[$key]  = $row['number'];
            $date[$key]  = $row['date_protocol'];

        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date, SORT_ASC, $number, SORT_ASC, $all_protocols);

               //////// Януари
        $january_start = strtotime(stripslashes('01.01.'.$year_now.''));
        $january_end = strtotime(stripslashes('31.01.'.$year_now.''));

        //////// Февруари
        $february_start = strtotime(stripslashes('01.02.'.$year_now.''));
        $february_end = strtotime(stripslashes('29.02.'.$year_now.''));


        //////// Март
        $march_start = strtotime(stripslashes('01.03.'.$year_now.''));
        $march_end = strtotime(stripslashes('31.03.'.$year_now.''));

        //////// Април
        $april_start = strtotime(stripslashes('01.04.'.$year_now.''));
        $april_end = strtotime(stripslashes('30.04.'.$year_now.''));

        //////// Май
        $may_start = strtotime(stripslashes('01.05.'.$year_now.''));
        $may_end = strtotime(stripslashes('31.05.'.$year_now.''));

        //////// Юни
        $june_start = strtotime(stripslashes('01.06.'.$year_now.''));
        $june_end = strtotime(stripslashes('30.06.'.$year_now.''));

        //////// Юли
        $july_start = strtotime(stripslashes('01.07.'.$year_now.''));
        $july_end = strtotime(stripslashes('31.07.'.$year_now.''));

        //////// Август
        $august_start = strtotime(stripslashes('01.08.'.$year_now.''));
        $august_end = strtotime(stripslashes('31.08.'.$year_now.''));

        //////// Септември
        $september_start = strtotime(stripslashes('01.09.'.$year_now.''));
        $september_end = strtotime(stripslashes('30.09.'.$year_now.''));

        //////// Октомври
        $october_start = strtotime(stripslashes('01.10.'.$year_now.''));
        $october_end = strtotime(stripslashes('31.10.'.$year_now.''));

        //////// Ноември
        $november_start = strtotime(stripslashes('01.11.'.$year_now.''));
        $november_end = strtotime(stripslashes('30.11.'.$year_now.''));

        //////// Декември
        $december_start = strtotime(stripslashes('01.12.'.$year_now.''));
        $december_end = strtotime(stripslashes('31.12.'.$year_now.''));

        foreach($all_protocols as $protocol){
            //////// Януари
            if($protocol['date_protocol'] >= $january_start && $protocol['date_protocol'] <= $january_end){
                $month_j = 'януари';
                $january_m[] = $protocol;
                $january = $this->add_table_row($january_m, $month_j);
            }
            if(!isset($january_m)>0){
                $month_j = 'януари';
                $january = $this->empty_row($month_j);
            }
            //////// Февруари
            if($protocol['date_protocol'] >= $february_start && $protocol['date_protocol'] <= $february_end){
                $month_f = 'февруари';
                $february_m[] = $protocol;
                $february = $this->add_table_row($february_m, $month_f);
            }
            if(!isset($february_m)>0){
                $month_f = 'февруари';
                $february = $this->empty_row($month_f);
            }
            //////// Март
            if($protocol['date_protocol'] >= $march_start && $protocol['date_protocol'] <= $march_end){
                $month_m = 'март';
                $march_m[] = $protocol;
                $march = $this->add_table_row($march_m, $month_m);
            }
            if(!isset($march_m)>0){
                $month_m = 'март';
                $march = $this->empty_row($month_m);
            }
            //////// Април
            if($protocol['date_protocol'] >= $april_start && $protocol['date_protocol'] <= $april_end){
                $month_a = 'април';
                $april_m[] = $protocol;
                $april = $this->add_table_row($april_m, $month_a);
            }
            if(!isset($april_m)>0){
                $month_a = 'април';
                $april = $this->empty_row($month_a);
            }
            //////// Май
            if($protocol['date_protocol'] >= $may_start && $protocol['date_protocol'] <= $may_end){
                $month_may = 'май';
                $may_m[] = $protocol;
                $may = $this->add_table_row($may_m, $month_may);
            }
            if(!isset($may_m)>0){
                $month_may = 'май';
                $may = $this->empty_row($month_may);
            }
            //////// Юни
            if($protocol['date_protocol'] >= $june_start && $protocol['date_protocol'] <= $june_end){
                $month_june = 'юни';
                $june_m[] = $protocol;
                $june = $this->add_table_row($june_m, $month_june);
            }
            if(!isset($june_m)>0){
                $month_june = 'юни';
                $june = $this->empty_row($month_june);
            }
            //////// Юли
            if($protocol['date_protocol'] >= $july_start && $protocol['date_protocol'] <= $july_end){
                $month_july = 'юли';
                $july_m[] = $protocol;
                $july = $this->add_table_row($july_m, $month_july);
            }
            if(!isset($july_m)>0){
                $month_july = 'юли';
                $july = $this->empty_row($month_july);
            }
            //////// Август
            if($protocol['date_protocol'] >= $august_start && $protocol['date_protocol'] <= $august_end){
                $month_av= 'август';
                $august_m[] = $protocol;
                $august = $this->add_table_row($august_m, $month_av);
            }
            if(!isset($august_m)>0){
                $month_av= 'август';
                $august = $this->empty_row($month_av);
            }
            //////// Септември
            if($protocol['date_protocol'] >= $september_start && $protocol['date_protocol'] <= $september_end){
                $month_s= 'септември';
                $september_m[] = $protocol;
                $september = $this->add_table_row($september_m, $month_s);
            }
            if(!isset($september_m)>0){
                $month_s= 'септември';
                $september = $this->empty_row($month_s);
            }
            //////// Октомври
            if($protocol['date_protocol'] >= $october_start && $protocol['date_protocol'] <= $october_end){
                $month_ok= 'октомври';
                $october_m[] = $protocol;
                $october = $this->add_table_row($october_m, $month_ok);
            }
            if(!isset($october_m)>0){
                $month_ok= 'октомври';
                $october = $this->empty_row($month_ok);
            }
            //////// Ноември
            if($protocol['date_protocol'] >= $november_start && $protocol['date_protocol'] <= $november_end){
                $month_nov= 'ноември';
                $november_m[] = $protocol;
                $november = $this->add_table_row($november_m, $month_nov);
            }
            if(!isset($november_m)>0){
                $month_nov= 'ноември';
                $november = $this->empty_row($month_nov);
            }
            //////// Декември
            if($protocol['date_protocol'] >= $december_start && $protocol['date_protocol'] <= $december_end){
                $month_d= 'декември';
                $december_m[] = $protocol;
                $december = $this->add_table_row($december_m, $month_d);
            }
            if(!isset($december_m)>0){
                $month_d= 'декември';
                $december = $this->empty_row($month_d);
            }
        }

        return view('registers.market.index_reference', compact('city', 'years', 'year_now', 'all_protocols',
            'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
            'october', 'november', 'december'));
    }

    /**
     * Показва справка за издадените Сертификати.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_certificates()
    {
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $certificates = Certificate::get();

        return view('registers.certificates.index_certificates', compact('city', 'certificates'));
    }

    /**
     * Добавя ред в таблицата когато има данни
     * @param $array
     * @param $month
     * @return string
     */
    public function add_table_row($array, $month){
        $pharmacy = array();
        $repository = array();
        $workshop = array();
        $production = array();
        $none = array();
        $protocols = array();
        $violation = array();
        $order = array();
        $act = array();
        $assay = array();
        $assay_more = array();

        foreach ($array as $value){
            //// Аптеки
            if($value['ot'] == 1){
                $pharmacy[] =  1;
            }
            else{
                $pharmacy[] = array();
            }
            //// Складове
            if($value['ot'] == 2){
                $repository[] = 1;
            }
            else{
                $repository[] = array();
            }
            //// Цехове
            if($value['ot'] == 3){
                $workshop[] = 1;
            }
            else{
                $workshop[] = array();
            }
            //// Производство
            if($value['ot'] == 200){
                $production[] = 1;
            }
            else{
                $production[] = array();
            }
            //// Нерегламентирани
            if($value['ot'] == 100){
                $none[] = 1;
            }
            else{
                $none[] = array();
            }
            /////// Протоколи
            if($value['number'] >0 && $value['date_protocol'] >0){
                $protocols[] = 1;
            }
            else{
                $protocols[] = array();
            }
            /////// Нарушения
            if($value['violation'] == 1 ){
                $violation[] = 1;
            }
            else{
                $violation[] = array();
            }
            /////// Предписания
            if(strlen($value['order_protocol']) > 0 ){
                $order[] = 1;
            }
            else{
                $order[] = array();
            }
            /////// Актове
            if($value['act'] == 1 ){
                $act[] = 1;
            }
            else{
                $act[] = array();
            }
            /////// Проби ПРЗ
            if($value['assay_prz'] == 1 ){
                $assay[] = 1;
            }
            else{
                $assay[] = array();
            }

            if($value['assay_more'] == 1 ){
                $assay_more[] = 1;
            }
            else{
                $assay_more[] = array();
            }
        }

        $all_count = count($array);
        $pharmacy_count = array_sum($pharmacy);
        $repository_count = array_sum($repository);
        $workshop_count = array_sum($workshop);
        $production_count = array_sum($production);
        $none_count = array_sum($none);
        $protocols_count = array_sum($protocols);
        $violation_count = array_sum($violation);
        $order_count = array_sum($order);
        $act_count = array_sum($act);
        $assay_count = array_sum($assay);
        $assay_more_count = array_sum($assay_more);


        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd bold">'.$all_count.'</td>
            <td class="rowDataSd ">'.$pharmacy_count.'</td>
            <td class="rowDataSd">'.$repository_count.'</td>
            <td class="rowDataSd">'.$workshop_count.'</td>
            <td class="rowDataSd">'.$production_count.'</td>
            <td class="rowDataSd">'.$none_count.'</td>
            <td class="bold rowDataSd" >'.$protocols_count.'</td>
            <td class="bold rowDataSd">'.$violation_count.'</td>
            <td class="bold rowDataSd">'.$order_count.'</td>
            <td class="bold rowDataSd">'.$act_count.'</td>
            <td class="bold rowDataSd">'.$assay_count.'</td>
            <td class="bold rowDataSd">'.$assay_more_count.'</td>
            <td></td>
            <td></td>
        </tr>
        ';
        return $data;
    }

    /**
     * Добавя празен ред
     * @param $month
     * @return string
     */
    private function empty_row($month){
        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd col1"></td>
            <td class="rowDataSd col2"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
        </tr>
        ';
        return $data;
    }


    /////// КОНТРОЛ НА УПОТРЕБАТА
    /**
     * Месечна справка
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index_farmers_reference(Request $request){
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $year_now = null;

        $protocols = FarmerProtocol::get();
        foreach($protocols as $protocol_year){
            $array[date('Y', $protocol_year->date_protocol)] = date('Y', $protocol_year->date_protocol);
        }
        $years = array_filter(array_unique($array));

        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now_key = date('Y', time());
            if(array_key_exists($year_now_key, $years)){
                $year_now = date('Y', time());
            }
            else{
                end($years);
                $year_now = key($years);
            }
        }

        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $all_protocols = FarmerProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $opinions = Opinion::where('date_opinion','>',$time_start)
            ->where('date_opinion','<',$time_end)
            ->get()->toArray();

        foreach ($all_protocols as $key => $row) {
            $number[$key]  = $row['number_protocol'];
            $date[$key]  = $row['date_protocol'];

        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date, SORT_ASC, $number, SORT_ASC, $all_protocols);


        //////// Януари
        $january_start = strtotime(stripslashes('01.01.'.$year_now.''));
        $january_end = strtotime(stripslashes('31.01.'.$year_now.''));

        //////// Февруари
        $february_start = strtotime(stripslashes('01.02.'.$year_now.''));
        $february_end = strtotime(stripslashes('29.02.'.$year_now.''));


        //////// Март
        $march_start = strtotime(stripslashes('01.03.'.$year_now.''));
        $march_end = strtotime(stripslashes('31.03.'.$year_now.''));

        //////// Април
        $april_start = strtotime(stripslashes('01.04.'.$year_now.''));
        $april_end = strtotime(stripslashes('30.04.'.$year_now.''));

        //////// Май
        $may_start = strtotime(stripslashes('01.05.'.$year_now.''));
        $may_end = strtotime(stripslashes('31.05.'.$year_now.''));

        //////// Юни
        $june_start = strtotime(stripslashes('01.06.'.$year_now.''));
        $june_end = strtotime(stripslashes('30.06.'.$year_now.''));

        //////// Юли
        $july_start = strtotime(stripslashes('01.07.'.$year_now.''));
        $july_end = strtotime(stripslashes('31.07.'.$year_now.''));

        //////// Август
        $august_start = strtotime(stripslashes('01.08.'.$year_now.''));
        $august_end = strtotime(stripslashes('31.08.'.$year_now.''));

        //////// Септември
        $september_start = strtotime(stripslashes('01.09.'.$year_now.''));
        $september_end = strtotime(stripslashes('30.09.'.$year_now.''));

        //////// Октомври
        $october_start = strtotime(stripslashes('01.10.'.$year_now.''));
        $october_end = strtotime(stripslashes('31.10.'.$year_now.''));

        //////// Ноември
        $november_start = strtotime(stripslashes('01.11.'.$year_now.''));
        $november_end = strtotime(stripslashes('30.11.'.$year_now.''));

        //////// Декември
        $december_start = strtotime(stripslashes('01.12.'.$year_now.''));
        $december_end = strtotime(stripslashes('31.12.'.$year_now.''));

        $january_opinion = array();
        $february_opinion = array();
        $march_opinion = array();
        $april_opinion = array();
        $may_opinion = array();
        $june_opinion = array();
        $july_opinion = array();
        $august_opinion = array();
        $september_opinion = array();
        $october_opinion = array();
        $november_opinion = array();
        $december_opinion = array();

        foreach ($opinions as $opinion){
            //////// Януари
            if($opinion['date_opinion'] >= $january_start && $opinion['date_opinion'] <= $january_end){
                $january_opinion[] = $opinion;
            }
            //////// Февруари
            if($opinion['date_opinion'] >= $february_start && $opinion['date_opinion'] <= $february_end){
                $february_opinion[] = $opinion;
            }
            //////// Март
            if($opinion['date_opinion'] >= $march_start && $opinion['date_opinion'] <= $march_end){
                $march_opinion[] = $opinion;
            }
            //////// Април
            if($opinion['date_opinion'] >= $april_start && $opinion['date_opinion'] <= $april_end){
                $april_opinion[] = $opinion;
            }
            //////// Май
            if($opinion['date_opinion'] >= $may_start && $opinion['date_opinion'] <= $may_end){
                $may_opinion[] = $opinion;
            }
            //////// Юни
            if($opinion['date_opinion'] >= $june_start && $opinion['date_opinion'] <= $june_end){
                $june_opinion[] = $opinion;
            }
            //////// Юли
            if($opinion['date_opinion'] >= $july_start && $opinion['date_opinion'] <= $july_end){
                $july_opinion[] = $opinion;
            }
            //////// Август
            if($opinion['date_opinion'] >= $august_start && $opinion['date_opinion'] <= $august_end){
                $august_opinion[] = $opinion;
            }
            //////// Септември
            if($opinion['date_opinion'] >= $september_start && $opinion['date_opinion'] <= $september_end){
                $september_opinion[] = $opinion;
            }
            //////// Октомври
            if($opinion['date_opinion'] >= $october_start && $opinion['date_opinion'] <= $october_end){
                $october_opinion[] = $opinion;
            }
            //////// Ноември
            if($opinion['date_opinion'] >= $november_start && $opinion['date_opinion'] <= $november_end){
                $november_opinion[] = $opinion;
            }
            //////// Декември
            if($opinion['date_opinion'] >= $december_start && $opinion['date_opinion'] <= $december_end){
                $december_opinion[] = $opinion;
            }
        }

        foreach($all_protocols as $protocol){
            //////// Януари
            if($protocol['date_protocol'] >= $january_start && $protocol['date_protocol'] <= $january_end){
                $month_j = 'януари';
                $january_m[] = $protocol;
                $january = $this->farmer_table_add_row($january_m, $month_j, $january_opinion);
            }
            if(!isset($january_m)>0){
                $month_j = 'януари';
                $january = $this->farmer_empty_row($month_j);
            }
            //////// Февруари
            if($protocol['date_protocol'] >= $february_start && $protocol['date_protocol'] <= $february_end){
                $month_f = 'февруари';
                $february_m[] = $protocol;
                $february = $this->farmer_table_add_row($february_m, $month_f, $february_opinion);
            }
            if(!isset($february_m)>0){
                $month_f = 'февруари';
                $february = $this->farmer_empty_row($month_f);
            }
            //////// Март
            if($protocol['date_protocol'] >= $march_start && $protocol['date_protocol'] <= $march_end){
                $month_m = 'март';
                $march_m[] = $protocol;
                $march = $this->farmer_table_add_row($march_m, $month_m, $march_opinion);
            }
            if(!isset($march_m)>0){
                $month_m = 'март';
                $march = $this->farmer_empty_row($month_m);
            }
            //////// Април
            if($protocol['date_protocol'] >= $april_start && $protocol['date_protocol'] <= $april_end){
                $month_a = 'април';
                $april_m[] = $protocol;
                $april = $this->farmer_table_add_row($april_m, $month_a, $april_opinion);
            }
            if(!isset($april_m)>0){
                $month_a = 'април';
                $april = $this->farmer_empty_row($month_a);
            }
            //////// Май
            if($protocol['date_protocol'] >= $may_start && $protocol['date_protocol'] <= $may_end){
                $month_may = 'май';
                $may_m[] = $protocol;
                $may = $this->farmer_table_add_row($may_m, $month_may, $may_opinion);
            }
            if(!isset($may_m)>0){
                $month_may = 'май';
                $may = $this->farmer_empty_row($month_may);
            }
            //////// Юни
            if($protocol['date_protocol'] >= $june_start && $protocol['date_protocol'] <= $june_end){
                $month_june = 'юни';
                $june_m[] = $protocol;
                $june = $this->farmer_table_add_row($june_m, $month_june, $june_opinion);
            }
            if(!isset($june_m)>0){
                $month_june = 'юни';
                $june = $this->farmer_empty_row($month_june);
            }
            //////// Юли
            if($protocol['date_protocol'] >= $july_start && $protocol['date_protocol'] <= $july_end){
                $month_july = 'юли';
                $july_m[] = $protocol;
                $july = $this->farmer_table_add_row($july_m, $month_july, $july_opinion);
            }
            if(!isset($july_m)>0){
                $month_july = 'юли';
                $july = $this->farmer_empty_row($month_july);
            }
            //////// Август
            if($protocol['date_protocol'] >= $august_start && $protocol['date_protocol'] <= $august_end){
                $month_av= 'август';
                $august_m[] = $protocol;
                $august = $this->farmer_table_add_row($august_m, $month_av, $august_opinion);
            }
            if(!isset($august_m)>0){
                $month_av= 'август';
                $august = $this->farmer_empty_row($month_av);
            }
            //////// Септември
            if($protocol['date_protocol'] >= $september_start && $protocol['date_protocol'] <= $september_end){
                $month_s= 'септември';
                $september_m[] = $protocol;
                $september = $this->farmer_table_add_row($september_m, $month_s, $september_opinion);
            }
            if(!isset($september_m)>0){
                $month_s= 'септември';
                $september = $this->farmer_empty_row($month_s);
            }
            //////// Октомври
            if($protocol['date_protocol'] >= $october_start && $protocol['date_protocol'] <= $october_end){
                $month_ok= 'октомври';
                $october_m[] = $protocol;
                $october = $this->farmer_table_add_row($october_m, $month_ok, $october_opinion);
            }
            if(!isset($october_m)>0){
                $month_ok= 'октомври';
                $october = $this->farmer_empty_row($month_ok);
            }
            //////// Ноември
            if($protocol['date_protocol'] >= $november_start && $protocol['date_protocol'] <= $november_end){
                $month_nov= 'ноември';
                $november_m[] = $protocol;
                $november = $this->farmer_table_add_row($november_m, $month_nov, $november_opinion);
            }
            if(!isset($november_m)>0){
                $month_nov= 'ноември';
                $november = $this->farmer_empty_row($month_nov);
            }
            //////// Декември
            if($protocol['date_protocol'] >= $december_start && $protocol['date_protocol'] <= $december_end){
                $month_d= 'декември';
                $december_m[] = $protocol;
                $december = $this->farmer_table_add_row($december_m, $month_d, $december_opinion);
            }
            if(!isset($december_m)>0){
                $month_d= 'декември';
                $december = $this->farmer_empty_row($month_d);
            }
        }

        return view('registers.farmers.index_reference', compact('city', 'years', 'year_now', 'all_protocols',
            'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
            'october', 'november', 'december'));
    }

    /**
     * Добавя ред в таблицата когато има данни
     * @param $array
     * @param $month
     * @param $opinion
     * @return string
     */
    public function farmer_table_add_row($array, $month, $opinion){
        $farmer_on = array();
        $farmer_doc = array();
        $opinion_on = array();
        $opinion_doc = array();
        $opinion_all = array();

        $protocols = array();
        $violation = array();
        $order = array();
        $act = array();

        $assay_more = array();
        $assay_prz = array();
        $assay_tor = array();
        $assay_metal = array();
        $assay_micro = array();
        $assay_other = array();

        foreach ($array as $value){
            if($value['check_type'] > 0 && $value['opinions'] == 0){
                if($value['type_check'] == 1){
                    $farmer_doc[] = 1;
                }
                elseif($value['type_check'] == 2){
                    $farmer_on[] = 1;
                }
            }
            if($value['check_type'] == 0 && $value['opinions'] > 0){
                if($value['type_check'] == 1){
                    $opinion_doc[] = 1;
                }
                elseif($value['type_check'] == 2){
                    $opinion_on[] = 1;
                }
            }
            if($value['opinions'] >0 ){
                $opinion_all[] = 1;
            }
            /////// Протоколи
            if($value['number_protocol'] >0 && $value['date_protocol'] >0){
                $protocols[] = 1;
            }
            else{
                $protocols[] = array();
            }
            /////// Нарушения
            if($value['violation'] == 1 ){
                $violation[] = 1;
            }
            else{
                $violation[] = array();
            }
            /////// Предписания
            if(strlen($value['order_protocol']) > 0 ){
                $order[] = 1;
            }
            else{
                $order[] = array();
            }
            /////// Актове
            if($value['act'] == 1 ){
                $act[] = 1;
            }
            else{
                $act[] = array();
            }
            /////// Проби ПРЗ
            $assay_more[] = array();
            $assay_prz[] = array();
            $assay_tor[] = array();
            $assay_metal[] = array();
            $assay_micro[] = array();
            $assay_other[] = array();
            ////// Остатъци
            if($value['assay_more'] == 1 ){
                $assay_more[] = 1;
            }
            else{
                $assay_more[] = array();
            }
            ////// Идентификация
            if($value['assay_prz'] == 1 ){
                $assay_prz[] = 1;
            }
            else{
                $assay_prz[] = array();
            }
            ////// Тор
            if($value['assay_tor'] == 1 ){
                $assay_tor[] = 1;
            }
            else{
                $assay_tor[] = array();
            }
            ////// Тежки метали
            if($value['assay_metal'] == 1 ){
                $assay_metal[] = 1;
            }
            else{
                $assay_metal[] = array();
            }
            ////// Микробиологични
            if($value['assay_micro'] == 1 ){
                $assay_micro[] = 1;
            }
            else{
                $assay_micro[] = array();
            }
            ////// Други
            if($value['assay_other'] == 1 ){
                $assay_other[] = 1;
            }
            else{
                $assay_other[] = array();
            }
        }


        $all_count = count($array);

        $farmer_on_count = array_sum($farmer_doc);
        $farmer_doc_count = array_sum($farmer_on);

        $opinion_on_count = array_sum($opinion_doc);
        $opinion_doc_count = array_sum($opinion_on);
        $opinion_all_count = count($opinion);

        $protocols_count = array_sum($protocols);
        $violation_count = array_sum($violation);
        $order_count = array_sum($order);
        $act_count = array_sum($act);
        $assay1_count = array_sum($assay_more);
        $assay2_count = array_sum($assay_prz);
        $assay3_count = array_sum($assay_tor);
        $assay4_count = array_sum($assay_metal);
        $assay5_count = array_sum($assay_micro);
        $assay6_count = array_sum($assay_other);


        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd bold">'.$all_count.'</td>
            <td class="rowDataSd ">'.$farmer_on_count.'</td>
            <td class="rowDataSd">'.$farmer_doc_count.'</td>
            <td class="rowDataSd">'.$opinion_on_count.'</td>
            <td class="rowDataSd">'.$opinion_doc_count.'</td>
            <td class="rowDataSd">'.$opinion_all_count.'</td>
            <td class="bold rowDataSd" >'.$protocols_count.'</td>
            <td class="bold rowDataSd">'.$violation_count.'</td>
            <td class="bold rowDataSd">'.$order_count.'</td>
            <td class="bold rowDataSd">'.$act_count.'</td>
            <td class="bold rowDataSd">'.$assay1_count.'</td>
            <td class="bold rowDataSd">'.$assay2_count.'</td>
            <td class="bold rowDataSd">'.$assay3_count.'</td>
            <td class="bold rowDataSd">'.$assay4_count.'</td>
            <td class="bold rowDataSd">'.$assay5_count.'</td>
            <td class="bold rowDataSd">'.$assay6_count.'</td>
        </tr>
        ';
        return $data;
    }

    /**
     * Добавя празен ред
     * @param $month
     * @return string
     */
    private function farmer_empty_row($month){
        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd col1"></td>
            <td class="rowDataSd col2"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
        </tr>
        ';
        return $data;
    }

    /////Месечни справки Становища
    public function index_opinions(Request $request){
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $periods = array();
        $year_now = null;
        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now = date('Y', time());
        }

        $opinions_all = Opinion::get();

        foreach($opinions_all as $opinions_year){
            $array[date('Y', $opinions_year->date_petition)] = date('Y', $opinions_year->date_petition);
            if($opinions_year->period == 2){
                $periods[$opinions_year->type_opinion] = $opinions_year->opinion_name_short;
            }
        }
        $years = array_filter(array_unique($array));

        //////// Януари
        $january_start = strtotime(stripslashes('01.01.'.$year_now.''));
        $january_end = strtotime(stripslashes('31.01.'.$year_now.''));

        //////// Февруари
        $february_start = strtotime(stripslashes('01.02.'.$year_now.''));
        $february_end = strtotime(stripslashes('29.02.'.$year_now.''));


        //////// Март
        $march_start = strtotime(stripslashes('01.03.'.$year_now.''));
        $march_end = strtotime(stripslashes('31.03.'.$year_now.''));

        //////// Април
        $april_start = strtotime(stripslashes('01.04.'.$year_now.''));
        $april_end = strtotime(stripslashes('30.04.'.$year_now.''));

        //////// Май
        $may_start = strtotime(stripslashes('01.05.'.$year_now.''));
        $may_end = strtotime(stripslashes('31.05.'.$year_now.''));

        //////// Юни
        $june_start = strtotime(stripslashes('01.06.'.$year_now.''));
        $june_end = strtotime(stripslashes('30.06.'.$year_now.''));

        //////// Юли
        $july_start = strtotime(stripslashes('01.07.'.$year_now.''));
        $july_end = strtotime(stripslashes('31.07.'.$year_now.''));

        //////// Август
        $august_start = strtotime(stripslashes('01.08.'.$year_now.''));
        $august_end = strtotime(stripslashes('31.08.'.$year_now.''));

        //////// Септември
        $september_start = strtotime(stripslashes('01.09.'.$year_now.''));
        $september_end = strtotime(stripslashes('30.09.'.$year_now.''));

        //////// Октомври
        $october_start = strtotime(stripslashes('01.10.'.$year_now.''));
        $october_end = strtotime(stripslashes('31.10.'.$year_now.''));

        //////// Ноември
        $november_start = strtotime(stripslashes('01.11.'.$year_now.''));
        $november_end = strtotime(stripslashes('30.11.'.$year_now.''));

        //////// Декември
        $december_start = strtotime(stripslashes('01.12.'.$year_now.''));
        $december_end = strtotime(stripslashes('31.12.'.$year_now.''));

        foreach($opinions_all as $opinion){
            //////// Януари
            if($opinion['date_opinion'] >= $january_start && $opinion['date_opinion'] <= $january_end){
                $month_j = 'януари';
                $january_m[] = $opinion;
                $january = $this->opinion_table_add_row($january_m, $month_j, $periods);
            }
            if(!isset($january_m)>0){
                $month_j = 'януари';
                $january = $this->opinion_empty_row($month_j);
            }
            //////// Февруари
            if($opinion['date_opinion'] >= $february_start && $opinion['date_opinion'] <= $february_end){
                $month_f = 'февруари';
                $february_m[] = $opinion;
                $february = $this->opinion_table_add_row($february_m, $month_f, $periods);
            }
            if(!isset($february_m)>0){
                $month_f = 'февруари';
                $february = $this->opinion_empty_row($month_f);
            }
            //////// Март
            if($opinion['date_opinion'] >= $march_start && $opinion['date_opinion'] <= $march_end){
                $month_m = 'март';
                $march_m[] = $opinion;
                $march = $this->opinion_table_add_row($march_m, $month_m, $periods);
            }
            if(!isset($march_m)>0){
                $month_m = 'март';
                $march = $this->opinion_empty_row($month_m);
            }
            //////// Април
            if($opinion['date_opinion'] >= $april_start && $opinion['date_opinion'] <= $april_end){
                $month_a = 'април';
                $april_m[] = $opinion;
                $april = $this->opinion_table_add_row($april_m, $month_a, $periods);
            }
            if(!isset($april_m)>0){
                $month_a = 'април';
                $april = $this->opinion_empty_row($month_a);
            }
            //////// Май
            if($opinion['date_opinion'] >= $may_start && $opinion['date_opinion'] <= $may_end){
                $month_may = 'май';
                $may_m[] = $opinion;
                $may = $this->opinion_table_add_row($may_m, $month_may, $periods);
            }
            if(!isset($may_m)>0){
                $month_may = 'май';
                $may = $this->opinion_empty_row($month_may);
            }
            //////// Юни
            if($opinion['date_opinion'] >= $june_start && $opinion['date_opinion'] <= $june_end){
                $month_june = 'юни';
                $june_m[] = $opinion;
                $june = $this->opinion_table_add_row($june_m, $month_june, $periods);
            }
            if(!isset($june_m)>0){
                $month_june = 'юни';
                $june = $this->opinion_empty_row($month_june);
            }
            //////// Юли
            if($opinion['date_opinion'] >= $july_start && $opinion['date_opinion'] <= $july_end){
                $month_july = 'юли';
                $july_m[] = $opinion;
                $july = $this->opinion_table_add_row($july_m, $month_july, $periods);
            }
            if(!isset($july_m)>0){
                $month_july = 'юли';
                $july = $this->opinion_empty_row($month_july);
            }
            //////// Август
            if($opinion['date_opinion'] >= $august_start && $opinion['date_opinion'] <= $august_end){
                $month_av= 'август';
                $august_m[] = $opinion;
                $august = $this->opinion_table_add_row($august_m, $month_av, $periods);
            }
            if(!isset($august_m)>0){
                $month_av= 'август';
                $august = $this->opinion_empty_row($month_av);
            }
            //////// Септември
            if($opinion['date_opinion'] >= $september_start && $opinion['date_opinion'] <= $september_end){
                $month_s= 'септември';
                $september_m[] = $opinion;
                $september = $this->opinion_table_add_row($september_m, $month_s, $periods);
            }
            if(!isset($september_m)>0){
                $month_s= 'септември';
                $september = $this->opinion_empty_row($month_s);
            }
            //////// Октомври
            if($opinion['date_opinion'] >= $october_start && $opinion['date_opinion'] <= $october_end){
                $month_ok= 'октомври';
                $october_m[] = $opinion;
                $october = $this->opinion_table_add_row($october_m, $month_ok, $periods);
            }
            if(!isset($october_m)>0){
                $month_ok= 'октомври';
                $october = $this->opinion_empty_row($month_ok);
            }
            //////// Ноември
            if($opinion['date_opinion'] >= $november_start && $opinion['date_opinion'] <= $november_end){
                $month_nov= 'ноември';
                $november_m[] = $opinion;
                $november = $this->opinion_table_add_row($november_m, $month_nov, $periods);
            }
            if(!isset($november_m)>0){
                $month_nov= 'ноември';
                $november = $this->opinion_empty_row($month_nov);
            }
            //////// Декември
            if($opinion['date_opinion'] >= $december_start && $opinion['date_opinion'] <= $december_end){
                $month_d= 'декември';
                $december_m[] = $opinion;
                $december = $this->opinion_table_add_row($december_m, $month_d, $periods);
            }
            if(!isset($december_m)>0){
                $month_d= 'декември';
                $december = $this->opinion_empty_row($month_d);
            }
        }

        return view('registers.farmers.index_opinions', compact('city', 'years', 'year_now', 'opinions_all',
            'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
            'october', 'november', 'december', 'periods'));
    }

    /**
     * Добавя празен ред
     * @param $month
     * @return string
     */
    private function opinion_empty_row($month){
        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd col1"></td>
            <td class="rowDataSd col2"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
        </tr>
        ';
        return $data;
    }

    /**
     * Добавя ред в таблицата когато има данни
     * @param $array
     * @param $month
     * @param $periods
     * @return string
     */
    private function opinion_table_add_row($array, $month, $periods){
        $opinion1_all = array();
        $opinion2_all = array();
        $opinion3_all = array();
        $opinion4_all = array();

        $opinion1_doc = array();
        $opinion1_on = array();
        $opinion2_doc = array();
        $opinion2_on = array();
        $opinion3_doc = array();
        $opinion3_on = array();
        $opinion4_doc = array();
        $opinion4_on = array();

        $new_opinion5_all = array();
        $new_opinion6_all = array();
        $new_opinion7_all = array();
        $new_opinion8_all = array();

        $new_opinion5_doc = array();
        $new_opinion5_on = array();
        $new_opinion6_doc = array();
        $new_opinion6_on = array();
        $new_opinion7_doc = array();
        $new_opinion7_on = array();
        $new_opinion8_doc = array();
        $new_opinion8_on = array();

        $period = array();

        foreach ($array as $value){
            if($value['type_opinion'] == 1){
                $opinion1_all[] =  1;
                if($value['type_check'] == 1){
                    $opinion1_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $opinion1_on[] =  1;
                }
            }
            else{
                $opinion1_all[] = array();
                $opinion1_doc[] = array();
                $opinion1_on[] = array();
            }
            ////
            if($value['type_opinion'] == 2){
                $opinion2_all[] = 1;
                if($value['type_check'] == 1){
                    $opinion2_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $opinion2_on[] =  1;
                }
            }
            else{
                $opinion2_all[] = array();
                $opinion2_doc[] = array();
                $opinion2_on[] = array();
            }
            //// Цехове
            if($value['type_opinion'] == 3){
                $opinion3_all[] = 1;
                if($value['type_check'] == 1){
                    $opinion3_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $opinion3_on[] =  1;
                }
            }
            else{
                $opinion3_all[] = array();
                $opinion3_doc[] = array();
                $opinion3_on[] = array();
            }
            //// Производство
            if($value['type_opinion'] == 4){
                $opinion4_all[] = 1;
                if($value['type_check'] == 1){
                    $opinion4_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $opinion4_on[] =  1;
                }
            }
            else{
                $opinion4_all[] = array();
                $opinion4_doc[] = array();
                $opinion4_on[] = array();
            }

            ///////////
            if($value['period'] != 1){
                $period[] = 1;
                $all_new_opinions[] = 1;
            }
            else{
                $period[] = array();
                $all_new_opinions[] = array();
            }
            ////// NEW
            //// 5
            if($value['type_opinion'] == 5){
                $new_opinion5_all[] =  1;
                if($value['type_check'] == 1){
                    $new_opinion5_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $new_opinion5_on[] =  1;
                }
            }
            else{
                $new_opinion5_all[] = array();
                $new_opinion5_doc[] = array();
                $new_opinion5_on[] = array();
            }
            //// 6
            if($value['type_opinion'] == 6){
                $new_opinion6_all[] =  1;
                if($value['type_check'] == 1){
                    $new_opinion6_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $new_opinion6_on[] =  1;
                }
            }
            else{
                $new_opinion6_all[] = array();
                $new_opinion6_doc[] = array();
                $new_opinion6_on[] = array();
            }
            //// 7
            if($value['type_opinion'] == 7){
                $new_opinion7_all[] =  1;
                if($value['type_check'] == 1){
                    $new_opinion7_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $new_opinion7_on[] =  1;
                }
            }
            else{
                $new_opinion7_all[] = array();
                $new_opinion7_doc[] = array();
                $new_opinion7_on[] = array();
            }
            //// 8
            if($value['type_opinion'] == 8){
                $new_opinion8_all[] =  1;
                if($value['type_check'] == 1){
                    $new_opinion8_doc[] =  1;
                }
                if($value['type_check'] != 1){
                    $new_opinion8_on[] =  1;
                }
            }
            else{
                $new_opinion8_all[] = array();
                $new_opinion8_doc[] = array();
                $new_opinion8_on[] = array();
            }
        }

        $all_count = count($array);
        $opinions_count = count($array);

        $opinion1_doc_count = array_sum($opinion1_doc);
        $opinion1_on_count = array_sum($opinion1_on);
        $opinion1_all_count = array_sum($opinion1_all);

        $opinion2_doc_count = array_sum($opinion2_doc);
        $opinion2_on_count = array_sum($opinion2_on);
        $opinion2_all_count = array_sum($opinion2_all);

        $opinion3_doc_count = array_sum($opinion3_doc);
        $opinion3_on_count = array_sum($opinion3_on);
        $opinion3_all_count = array_sum($opinion3_all);

        $opinion4_doc_count = array_sum($opinion4_doc);
        $opinion4_on_count = array_sum($opinion4_on);
        $opinion4_all_count = array_sum($opinion4_all);

        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="bold rowDataSd">'.$all_count.'</td>
            <td class="bold rowDataSd">'.$opinions_count.'</td>

            <td class="rowDataSd ">'.$opinion1_doc_count.'</td>
            <td class="rowDataSd">'.$opinion1_on_count.'</td>
            <td class="bold rowDataSd">'.$opinion1_all_count.'</td>

            <td class="rowDataSd">'.$opinion2_doc_count.'</td>
            <td class="rowDataSd">'.$opinion2_on_count.'</td>
            <td class="bold rowDataSd" >'.$opinion2_all_count.'</td>

            <td class="rowDataSd">'.$opinion3_doc_count.'</td>
            <td class="rowDataSd">'.$opinion3_on_count.'</td>
            <td class="bold rowDataSd">'.$opinion3_all_count.'</td>

            <td class="rowDataSd">'.$opinion4_doc_count.'</td>
            <td class="rowDataSd">'.$opinion4_on_count.'</td>
            <td class="bold rowDataSd">'.$opinion4_all_count.'</td>
        </tr>
        ';


        $period_count = array_sum($period);

        if(array_key_exists(5, $periods )){
            $new_opinion5_doc_count = array_sum($new_opinion5_doc);
            $new_opinion5_on_count = array_sum($new_opinion5_on);
            $new_opinion5_all_count = array_sum($new_opinion5_all);
            $data_new5 = '
                <td class="rowDataSd">'.$new_opinion5_doc_count.'</td>
                <td class="rowDataSd">'.$new_opinion5_on_count.'</td>
                <td class="bold rowDataSd">'.$new_opinion5_all_count.'</td>
            ';
            if($new_opinion5_all_count > 0){
                $text5 = "<p>За месец <span class='bold'>$month</span> има издадени $new_opinion5_all_count броя Становища по Мярка $periods[5]</p>";
            }
            else{
                $text5 = '';
            }
        }
        else{
            $data_new5 = '';
            $text5 = '';
        }
        if(array_key_exists(6, $periods )){
            $new_opinion6_doc_count = array_sum($new_opinion6_doc);
            $new_opinion6_on_count = array_sum($new_opinion6_on);
            $new_opinion6_all_count = array_sum($new_opinion6_all);
            $data_new6 = '
                <td class="rowDataSd">'.$new_opinion6_doc_count.'</td>
                <td class="rowDataSd">'.$new_opinion6_on_count.'</td>
                <td class="bold rowDataSd">'.$new_opinion6_all_count.'</td>
            ';
            if($new_opinion6_all_count > 0){
                $text6 = "<p>За месец <span class='bold'>$month</span> има издадени $new_opinion6_all_count броя Становища по Мярка $periods[6]</p>";
            }
            else{
                $text6 = '';
            }

        }
        else{
            $data_new6 = '';
            $text6 = '';
        }
        if(array_key_exists(7, $periods )){
            $new_opinion7_doc_count = array_sum($new_opinion7_doc);
            $new_opinion7_on_count = array_sum($new_opinion7_on);
            $new_opinion7_all_count = array_sum($new_opinion7_all);
            $data_new7 = '
                <td class="rowDataSd">'.$new_opinion7_doc_count.'</td>
                <td class="rowDataSd">'.$new_opinion7_on_count.'</td>
                <td class="bold rowDataSd">'.$new_opinion7_all_count.'</td>
            ';
            if($new_opinion7_all_count > 0){
                $text7 = "<p>За месец <span class='bold'>$month</span> има издадени $new_opinion7_all_count броя Становища по Мярка $periods[7]</p>";
            }
            else{
                $text7 = '';
            }
        }
        else{
            $data_new7 = '';
            $text7 = '';
        }
        if(array_key_exists(8, $periods )){
            $new_opinion8_doc_count = array_sum($new_opinion8_doc);
            $new_opinion8_on_count = array_sum($new_opinion8_on);
            $new_opinion8_all_count = array_sum($new_opinion8_all);

            $data_new8 = '
                <td class="rowDataSd">'.$new_opinion8_doc_count.'</td>
                <td class="rowDataSd">'.$new_opinion8_on_count.'</td>
                <td class="bold rowDataSd">'.$new_opinion8_all_count.'</td>
            ';
        }
        else{
            $data_new8 = '';
        }
        $data_new = '
            <tr>
                <td class="month" >'.$month.'</td>
                <td class="bold rowDataSd">'.$period_count.'</td>
                <td class="bold rowDataSd">'.$period_count.'</td>
                '.$data_new5.'
                '.$data_new6.'
                '.$data_new7.'
                '.$data_new8.'
            </tr>
        ';
        $data_txt = '
            '.$text5.'
            '.$text6.'
            '.$text7.'
        ';
        return array($data, $data_new, $data_txt);
    }
    /////КРАИ Месечни справки Становища

    /////Месечни справки Контрол
    public function index_control(Request $request){
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $year_now = null;

        $protocols = FarmerProtocol::get();
        foreach($protocols as $protocol_year){
            $array[date('Y', $protocol_year->date_protocol)] = date('Y', $protocol_year->date_protocol);
        }
        $years = array_filter(array_unique($array));
        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now_key = date('Y', time());
            if(array_key_exists($year_now_key, $years)){
                $year_now = date('Y', time());
            }
            else{
                end($years);
                $year_now = key($years);
            }
        }

        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $all_protocols = FarmerProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $permits = Air::where('date_permit','>',$time_start)
            ->where('date_permit','<',$time_end)
            ->get()->toArray();

        foreach ($all_protocols as $key => $row) {
            $number[$key]  = $row['number_protocol'];
            $date[$key]  = $row['date_protocol'];

        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date, SORT_ASC, $number, SORT_ASC, $all_protocols);


        //////// Януари
        $january_start = strtotime(stripslashes('01.01.'.$year_now.''));
        $january_end = strtotime(stripslashes('31.01.'.$year_now.''));

        //////// Февруари
        $february_start = strtotime(stripslashes('01.02.'.$year_now.''));
        $february_end = strtotime(stripslashes('29.02.'.$year_now.''));


        //////// Март
        $march_start = strtotime(stripslashes('01.03.'.$year_now.''));
        $march_end = strtotime(stripslashes('31.03.'.$year_now.''));

        //////// Април
        $april_start = strtotime(stripslashes('01.04.'.$year_now.''));
        $april_end = strtotime(stripslashes('30.04.'.$year_now.''));

        //////// Май
        $may_start = strtotime(stripslashes('01.05.'.$year_now.''));
        $may_end = strtotime(stripslashes('31.05.'.$year_now.''));

        //////// Юни
        $june_start = strtotime(stripslashes('01.06.'.$year_now.''));
        $june_end = strtotime(stripslashes('30.06.'.$year_now.''));

        //////// Юли
        $july_start = strtotime(stripslashes('01.07.'.$year_now.''));
        $july_end = strtotime(stripslashes('31.07.'.$year_now.''));

        //////// Август
        $august_start = strtotime(stripslashes('01.08.'.$year_now.''));
        $august_end = strtotime(stripslashes('31.08.'.$year_now.''));

        //////// Септември
        $september_start = strtotime(stripslashes('01.09.'.$year_now.''));
        $september_end = strtotime(stripslashes('30.09.'.$year_now.''));

        //////// Октомври
        $october_start = strtotime(stripslashes('01.10.'.$year_now.''));
        $october_end = strtotime(stripslashes('31.10.'.$year_now.''));

        //////// Ноември
        $november_start = strtotime(stripslashes('01.11.'.$year_now.''));
        $november_end = strtotime(stripslashes('30.11.'.$year_now.''));

        //////// Декември
        $december_start = strtotime(stripslashes('01.12.'.$year_now.''));
        $december_end = strtotime(stripslashes('31.12.'.$year_now.''));

        $january_permit = array();
        $february_permit = array();
        $march_permit = array();
        $april_permit = array();
        $may_permit = array();
        $june_permit = array();
        $july_permit = array();
        $august_permit = array();
        $september_permit = array();
        $october_permit = array();
        $november_permit = array();
        $december_permit = array();

        foreach ($permits as $permit){
            //////// Януари
            if($permit['date_permit'] >= $january_start && $permit['date_permit'] <= $january_end){
                $january_permit[] = $permit;
            }
            //////// Февруари
            if($permit['date_permit'] >= $february_start && $permit['date_permit'] <= $february_end){
                $february_permit[] = $permit;
            }
            //////// Март
            if($permit['date_permit'] >= $march_start && $permit['date_permit'] <= $march_end){
                $march_permit[] = $permit;
            }
            //////// Април
            if($permit['date_permit'] >= $april_start && $permit['date_permit'] <= $april_end){
                $april_permit[] = $permit;
            }
            //////// Май
            if($permit['date_permit'] >= $may_start && $permit['date_permit'] <= $may_end){
                $may_permit[] = $permit;
            }
            //////// Юни
            if($permit['date_permit'] >= $june_start && $permit['date_permit'] <= $june_end){
                $june_permit[] = $permit;
            }
            //////// Юли
            if($permit['date_permit'] >= $july_start && $permit['date_permit'] <= $july_end){
                $july_permit[] = $permit;
            }
            //////// Август
            if($permit['date_permit'] >= $august_start && $permit['date_permit'] <= $august_end){
                $august_permit[] = $permit;
            }
            //////// Септември
            if($permit['date_permit'] >= $september_start && $permit['date_permit'] <= $september_end){
                $september_permit[] = $permit;
            }
            //////// Октомври
            if($permit['date_permit'] >= $october_start && $permit['date_permit'] <= $october_end){
                $october_permit[] = $permit;
            }
            //////// Ноември
            if($permit['date_permit'] >= $november_start && $permit['date_permit'] <= $november_end){
                $november_permit[] = $permit;
            }
            //////// Декември
            if($permit['date_permit'] >= $december_start && $permit['date_permit'] <= $december_end){
                $december_permit[] = $permit;
            }
        }

        foreach($all_protocols as $protocol){
            //////// Януари
            if($protocol['date_protocol'] >= $january_start && $protocol['date_protocol'] <= $january_end){
                $month_j = 'януари';
                $january_m[] = $protocol;
                $january = $this->control_table_add_row($january_m, $month_j, $january_permit);
            }
            if(!isset($january_m)>0){
                $month_j = 'януари';
                $january = $this->control_empty_row($month_j);
            }
            //////// Февруари
            if($protocol['date_protocol'] >= $february_start && $protocol['date_protocol'] <= $february_end){
                $month_f = 'февруари';
                $february_m[] = $protocol;
                $february = $this->control_table_add_row($february_m, $month_f, $february_permit);
            }
            if(!isset($february_m)>0){
                $month_f = 'февруари';
                $february = $this->control_empty_row($month_f);
            }
            //////// Март
            if($protocol['date_protocol'] >= $march_start && $protocol['date_protocol'] <= $march_end){
                $month_m = 'март';
                $march_m[] = $protocol;
                $march = $this->control_table_add_row($march_m, $month_m, $march_permit);
            }
            if(!isset($march_m)>0){
                $month_m = 'март';
                $march = $this->control_empty_row($month_m);
            }
            //////// Април
            if($protocol['date_protocol'] >= $april_start && $protocol['date_protocol'] <= $april_end){
                $month_a = 'април';
                $april_m[] = $protocol;
                $april = $this->control_table_add_row($april_m, $month_a, $april_permit);
            }
            if(!isset($april_m)>0){
                $month_a = 'април';
                $april = $this->control_empty_row($month_a);
            }
            //////// Май
            if($protocol['date_protocol'] >= $may_start && $protocol['date_protocol'] <= $may_end){
                $month_may = 'май';
                $may_m[] = $protocol;
                $may = $this->control_table_add_row($may_m, $month_may, $may_permit);
            }
            if(!isset($may_m)>0){
                $month_may = 'май';
                $may = $this->control_empty_row($month_may);
            }
            //////// Юни
            if($protocol['date_protocol'] >= $june_start && $protocol['date_protocol'] <= $june_end){
                $month_june = 'юни';
                $june_m[] = $protocol;
                $june = $this->control_table_add_row($june_m, $month_june, $june_permit);
            }
            if(!isset($june_m)>0){
                $month_june = 'юни';
                $june = $this->control_empty_row($month_june);
            }
            //////// Юли
            if($protocol['date_protocol'] >= $july_start && $protocol['date_protocol'] <= $july_end){
                $month_july = 'юли';
                $july_m[] = $protocol;
                $july = $this->control_table_add_row($july_m, $month_july, $july_permit);
            }
            if(!isset($july_m)>0){
                $month_july = 'юли';
                $july = $this->control_empty_row($month_july);
            }
            //////// Август
            if($protocol['date_protocol'] >= $august_start && $protocol['date_protocol'] <= $august_end){
                $month_av= 'август';
                $august_m[] = $protocol;
                $august = $this->control_table_add_row($august_m, $month_av, $august_permit);
            }
            if(!isset($august_m)>0){
                $month_av= 'август';
                $august = $this->control_empty_row($month_av);
            }
            //////// Септември
            if($protocol['date_protocol'] >= $september_start && $protocol['date_protocol'] <= $september_end){
                $month_s= 'септември';
                $september_m[] = $protocol;
                $september = $this->control_table_add_row($september_m, $month_s, $september_permit);
            }
            if(!isset($september_m)>0){
                $month_s= 'септември';
                $september = $this->control_empty_row($month_s);
            }
            //////// Октомври
            if($protocol['date_protocol'] >= $october_start && $protocol['date_protocol'] <= $october_end){
                $month_ok= 'октомври';
                $october_m[] = $protocol;
                $october = $this->control_table_add_row($october_m, $month_ok, $october_permit);
            }
            if(!isset($october_m)>0){
                $month_ok= 'октомври';
                $october = $this->control_empty_row($month_ok);
            }
            //////// Ноември
            if($protocol['date_protocol'] >= $november_start && $protocol['date_protocol'] <= $november_end){
                $month_nov= 'ноември';
                $november_m[] = $protocol;
                $november = $this->control_table_add_row($november_m, $month_nov, $november_permit);
            }
            if(!isset($november_m)>0){
                $month_nov= 'ноември';
                $november = $this->control_empty_row($month_nov);
            }
            //////// Декември
            if($protocol['date_protocol'] >= $december_start && $protocol['date_protocol'] <= $december_end){
                $month_d= 'декември';
                $december_m[] = $protocol;
                $december = $this->control_table_add_row($december_m, $month_d, $december_permit);
            }
            if(!isset($december_m)>0){
                $month_d= 'декември';
                $december = $this->control_empty_row($month_d);
            }
        }

        return view('registers.farmers.index_control', compact('city', 'years', 'year_now', 'all_protocols',
            'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
            'october', 'november', 'december'));
    }

    /**
     * Добавя празен ред
     * @param $month
     * @return string
     */
    private function control_empty_row($month){
        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd col1"></td>
            <td class="rowDataSd col2"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
        </tr>
        ';
        return $data;
    }

    /**
     * Добавя ред в таблицата когато има данни
     * @param $array
     * @param $month
     * @param $permits
     * @return string
     */
    public function control_table_add_row($array, $month, $permits){
        $air_check = array();
        $fumigation = array();
        $seeds = array();

        $helps = array();
        $protocols = array();
        $violation = array();
        $order = array();
        $act = array();

        $bulletin = array();
        $subscription = array();
        $education = array();

        foreach ($array as $value){
            if($value['check_type'] == 1){
                if($value['check_id'] == 9){
                    $air_check[] = 1;
                }
                elseif($value['check_id'] == 8){
                    $fumigation[] = 1;
                }
                elseif($value['check_id'] == 7){
                    $seeds[] = 1;
                }
            }
            /////// Помощи
            if($value['check_type'] == 3 ){
                $helps[] = 1;
            }
            else{
                $helps[] = array();
            }
            /////// Протоколи
            if($value['number_protocol'] >0 && $value['date_protocol'] >0){
                $protocols[] = 1;
            }
            else{
                $protocols[] = array();
            }
            /////// Нарушения
            if($value['violation'] == 1 ){
                $violation[] = 1;
            }
            else{
                $violation[] = array();
            }
            /////// Предписания
            if(strlen($value['order_protocol']) > 0 ){
                $order[] = 1;
            }
            else{
                $order[] = array();
            }
            /////// Актове
            if($value['act'] == 1 ){
                $act[] = 1;
            }
            else{
                $act[] = array();
            }
            /////// Проби ПРЗ
            $bulletin[] = array();
            $subscription[] = array();
            $education[] = array();
        }

        $all_count = count($array);

        $air_count = array_sum($air_check);
        $permits_all_count = count($permits);

        $fumigation_count = array_sum($fumigation);
        $seeds_count = array_sum($seeds);

        $helps_count = array_sum($helps);
        $protocols_count = array_sum($protocols);
        $violation_count = array_sum($violation);
        $order_count = array_sum($order);
        $act_count = array_sum($act);
//        $bulletin_count = array_sum($bulletin);
//        $subscription_count = array_sum($subscription);
//        $education_count = array_sum($education);


        $data = '
        <tr class="rowCount">
            <td class="month" >'.$month.'</td>
            <td class="total rowDataSd bold"></td>
            <td class="rowDataSd sumRow">'.$all_count.'</td>

            <td class="rowDataSd sumRow">0</td>
            <td class="rowDataSd sumRow">'.$air_count.'</td>
            <td class="rowDataSd sumRow">'.$permits_all_count.'</td>
            <td class="rowDataSd sumRow">'.$seeds_count.'</td>
            <td class="rowDataSd sumRow">'.$fumigation_count.'</td>

            <td class="bold rowDataSd">'.$helps_count.'</td>
            <td class="bold rowDataSd" >'.$protocols_count.'</td>
            <td class="bold rowDataSd">'.$violation_count.'</td>
            <td class="bold rowDataSd">'.$order_count.'</td>
            <td class="bold rowDataSd">'.$act_count.'</td>
            <td class="bold rowDataSd"> </td>
            <td class="bold rowDataSd"> </td>
            <td class="bold rowDataSd"> </td>
        </tr>
        ';
        return $data;
    }
    /////КРАЙ Месечни справки Контрол

    /////Месечни справки С ФОНДА
    public function index_fond(Request $request){
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $year_now = null;

        $protocols = FarmerProtocol::get();
        foreach($protocols as $protocol_year){
            $array[date('Y', $protocol_year->date_protocol)] = date('Y', $protocol_year->date_protocol);
        }
        $years = array_filter(array_unique($array));
        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now_key = date('Y', time());
            if(array_key_exists($year_now_key, $years)){
                $year_now = date('Y', time());
            }
            else{
                end($years);
                $year_now = key($years);
            }
        }

        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $all_protocols = FarmerProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();


        foreach ($all_protocols as $key => $row) {
            $number[$key]  = $row['number_protocol'];
            $date[$key]  = $row['date_protocol'];

        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date, SORT_ASC, $number, SORT_ASC, $all_protocols);


        //////// Януари
        $january_start = strtotime(stripslashes('01.01.'.$year_now.''));
        $january_end = strtotime(stripslashes('31.01.'.$year_now.''));

        //////// Февруари
        $february_start = strtotime(stripslashes('01.02.'.$year_now.''));
        $february_end = strtotime(stripslashes('29.02.'.$year_now.''));


        //////// Март
        $march_start = strtotime(stripslashes('01.03.'.$year_now.''));
        $march_end = strtotime(stripslashes('31.03.'.$year_now.''));

        //////// Април
        $april_start = strtotime(stripslashes('01.04.'.$year_now.''));
        $april_end = strtotime(stripslashes('30.04.'.$year_now.''));

        //////// Май
        $may_start = strtotime(stripslashes('01.05.'.$year_now.''));
        $may_end = strtotime(stripslashes('31.05.'.$year_now.''));

        //////// Юни
        $june_start = strtotime(stripslashes('01.06.'.$year_now.''));
        $june_end = strtotime(stripslashes('30.06.'.$year_now.''));

        //////// Юли
        $july_start = strtotime(stripslashes('01.07.'.$year_now.''));
        $july_end = strtotime(stripslashes('31.07.'.$year_now.''));

        //////// Август
        $august_start = strtotime(stripslashes('01.08.'.$year_now.''));
        $august_end = strtotime(stripslashes('31.08.'.$year_now.''));

        //////// Септември
        $september_start = strtotime(stripslashes('01.09.'.$year_now.''));
        $september_end = strtotime(stripslashes('30.09.'.$year_now.''));

        //////// Октомври
        $october_start = strtotime(stripslashes('01.10.'.$year_now.''));
        $october_end = strtotime(stripslashes('31.10.'.$year_now.''));

        //////// Ноември
        $november_start = strtotime(stripslashes('01.11.'.$year_now.''));
        $november_end = strtotime(stripslashes('30.11.'.$year_now.''));

        //////// Декември
        $december_start = strtotime(stripslashes('01.12.'.$year_now.''));
        $december_end = strtotime(stripslashes('31.12.'.$year_now.''));

        foreach($all_protocols as $protocol){
            //////// Януари
            if($protocol['date_protocol'] >= $january_start && $protocol['date_protocol'] <= $january_end){
                $month_j = 'януари';
                $january_m[] = $protocol;
                $january = $this->fond_table_add_row($january_m, $month_j);
            }
            if(!isset($january_m)>0){
                $month_j = 'януари';
                $january = $this->fond_empty_row($month_j);
            }
            //////// Февруари
            if($protocol['date_protocol'] >= $february_start && $protocol['date_protocol'] <= $february_end){
                $month_f = 'февруари';
                $february_m[] = $protocol;
                $february = $this->fond_table_add_row($february_m, $month_f);
            }
            if(!isset($february_m)>0){
                $month_f = 'февруари';
                $february = $this->fond_empty_row($month_f);
            }
            //////// Март
            if($protocol['date_protocol'] >= $march_start && $protocol['date_protocol'] <= $march_end){
                $month_m = 'март';
                $march_m[] = $protocol;
                $march = $this->fond_table_add_row($march_m, $month_m);
            }
            if(!isset($march_m)>0){
                $month_m = 'март';
                $march = $this->fond_empty_row($month_m);
            }
            //////// Април
            if($protocol['date_protocol'] >= $april_start && $protocol['date_protocol'] <= $april_end){
                $month_a = 'април';
                $april_m[] = $protocol;
                $april = $this->fond_table_add_row($april_m, $month_a);
            }
            if(!isset($april_m)>0){
                $month_a = 'април';
                $april = $this->fond_empty_row($month_a);
            }
            //////// Май
            if($protocol['date_protocol'] >= $may_start && $protocol['date_protocol'] <= $may_end){
                $month_may = 'май';
                $may_m[] = $protocol;
                $may = $this->fond_table_add_row($may_m, $month_may);
            }
            if(!isset($may_m)>0){
                $month_may = 'май';
                $may = $this->fond_empty_row($month_may);
            }
            //////// Юни
            if($protocol['date_protocol'] >= $june_start && $protocol['date_protocol'] <= $june_end){
                $month_june = 'юни';
                $june_m[] = $protocol;
                $june = $this->fond_table_add_row($june_m, $month_june);
            }
            if(!isset($june_m)>0){
                $month_june = 'юни';
                $june = $this->fond_empty_row($month_june);
            }
            //////// Юли
            if($protocol['date_protocol'] >= $july_start && $protocol['date_protocol'] <= $july_end){
                $month_july = 'юли';
                $july_m[] = $protocol;
                $july = $this->fond_table_add_row($july_m, $month_july);
            }
            if(!isset($july_m)>0){
                $month_july = 'юли';
                $july = $this->fond_empty_row($month_july);
            }
            //////// Август
            if($protocol['date_protocol'] >= $august_start && $protocol['date_protocol'] <= $august_end){
                $month_av= 'август';
                $august_m[] = $protocol;
                $august = $this->fond_table_add_row($august_m, $month_av);
            }
            if(!isset($august_m)>0){
                $month_av= 'август';
                $august = $this->fond_empty_row($month_av);
            }
            //////// Септември
            if($protocol['date_protocol'] >= $september_start && $protocol['date_protocol'] <= $september_end){
                $month_s= 'септември';
                $september_m[] = $protocol;
                $september = $this->fond_table_add_row($september_m, $month_s);
            }
            if(!isset($september_m)>0){
                $month_s= 'септември';
                $september = $this->fond_empty_row($month_s);
            }
            //////// Октомври
            if($protocol['date_protocol'] >= $october_start && $protocol['date_protocol'] <= $october_end){
                $month_ok= 'октомври';
                $october_m[] = $protocol;
                $october = $this->fond_table_add_row($october_m, $month_ok);
            }
            if(!isset($october_m)>0){
                $month_ok= 'октомври';
                $october = $this->fond_empty_row($month_ok);
            }
            //////// Ноември
            if($protocol['date_protocol'] >= $november_start && $protocol['date_protocol'] <= $november_end){
                $month_nov= 'ноември';
                $november_m[] = $protocol;
                $november = $this->fond_table_add_row($november_m, $month_nov);
            }
            if(!isset($november_m)>0){
                $month_nov= 'ноември';
                $november = $this->fond_empty_row($month_nov);
            }
            //////// Декември
            if($protocol['date_protocol'] >= $december_start && $protocol['date_protocol'] <= $december_end){
                $month_d= 'декември';
                $december_m[] = $protocol;
                $december = $this->fond_table_add_row($december_m, $month_d);
            }
            if(!isset($december_m)>0){
                $month_d= 'декември';
                $december = $this->fond_empty_row($month_d);
            }
        }

        return view('registers.farmers.index_fond', compact('city', 'years', 'year_now', 'all_protocols',
            'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
            'october', 'november', 'december'));
    }

    /**
     * Добавя празен ред
     * @param $month
     * @return string
     */
    private function fond_empty_row($month){
        $data = '
        <tr>
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd col1"></td>
            <td class="rowDataSd col2"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
            <td class="rowDataSd"></td>
        </tr>
        ';
        return $data;
    }

    /**
     * Добавя ред в таблицата когато има данни
     * @param $array
     * @param $month
     * @return string
     */
    public function fond_table_add_row($array, $month){
        $eco_all_check = array();
        $eco_violation = array();
        $eco_ascertainment = array();

        $all_check = array();
        $violation = array();
        $ascertainment = array();

        foreach ($array as $value){
            if($value['check_type'] == 2 && $value['check_id'] == 2){
                $eco_all_check[] = 1;

                if($value['violation'] != 0){
                    $eco_violation[] = 1;
                }
                if(strlen($value['ascertainment']) > 0){
                    $eco_ascertainment[] = 1;
                }
            }
            if($value['check_type'] == 2 && $value['check_id'] == 3){
                $all_check[] = 1;

                if($value['violation'] != 0){
                    $violation[] = 1;
                }
                if(strlen($value['ascertainment']) > 0){
                    $ascertainment[] = 1;
                }
            }

        }
        $eco_all_check_count = array_sum($eco_all_check);
        $eco_violation_count = array_sum($eco_violation);
        $eco_ascertainment_count = array_sum($eco_ascertainment);

        $all_check_count = array_sum($all_check);
        $violation_count = array_sum($violation);
        $ascertainment_count = array_sum($ascertainment);

        $data = '
        <tr class="rowCount">
            <td class="month" >'.$month.'</td>
            <td class="rowDataSd bold">'.$eco_all_check_count.'</td>
            <td class="rowDataSd bold">'.$eco_all_check_count.'</td>
            <td class="rowDataSd ">'. $eco_violation_count.'</td>
            <td class="rowDataSd ">'. $eco_ascertainment_count.'</td>
            <td class="rowDataSd "></td>

            <td class="total rowDataSd bold">'.$all_check_count.'</td>
            <td class="rowDataSd bold">'.$all_check_count.'</td>
            <td class="rowDataSd ">'. $violation_count.'</td>
            <td class="rowDataSd "></td>
            <td class="rowDataSd ">'. $ascertainment_count.'</td>
            <td class="rowDataSd "></td>
        </tr>
        ';
        return $data;
    }
    /////КРАЙ Месечни справки С ФОНДА

    /**
     * Показва справка за протоколите при контрол на пазара
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index_farmers_protocols(Request $request){
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $year_now = null;

        $protocols = Protocol::get()->toArray();
        $old_protocols = OldProtocol::get()->toArray();
        $all_protocols_all = array_merge($protocols, $old_protocols);
        foreach ($all_protocols_all as $key => $row) {
            $date[$key]  = $row['date_protocol'];
        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date, SORT_ASC, $all_protocols_all);

        foreach($all_protocols_all as $protocol){
            $array[date('Y', $protocol['date_protocol'])] = date('Y', $protocol['date_protocol']);
        }
        $years = array_filter(array_unique($array));

        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now_key = date('Y', time());
            if(array_key_exists($year_now_key, $years)){
                $year_now = date('Y', time());
            }
            else{
                end($years);
                $year_now = key($years);
            }
        }


        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $protocols = FarmerProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $old_protocols = OldProtocol::where('date_protocol','>',$time_start)
            ->where('date_protocol','<',$time_end)
            ->get()->toArray();

        $all_protocols = array_merge($protocols, $old_protocols);

        foreach ($all_protocols as $key => $row) {
            $number[$key]  = $row['number_protocol'];
            $date_all[$key]  = $row['date_protocol'];

        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort( $date_all, SORT_ASC, $number, SORT_ASC, $all_protocols);

        return view('registers.farmers.index_protocols', compact('city', 'years', 'year_now', 'all_protocols'));
    }



    /**
     * Показва справка за издадените Разрешителни за Въздушно.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index_air(Request $request)
    {
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }

        $array = array();
        $year_now = null;
        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        else{
            $year_now = date('Y', time());
        }
        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $protocols = Air::get();
        foreach($protocols as $protocol){
            $array[date('Y', $protocol->date_permit)] = date('Y', $protocol->date_permit);
        }
        $years = array_filter(array_unique($array));

        $permits = Air::where('date_permit','>',$time_start)->where('date_permit','<',$time_end)->get();

        return view('registers.air.index_air', compact('city', 'permits', 'years', 'year_now'));
    }
}
