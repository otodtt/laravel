<?php

namespace odbh\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use odbh\Article;
use odbh\Certificate;
use odbh\FarmerProtocol;
use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\QCertificate;
use odbh\QCompliance;
use odbh\QIdentification;
use odbh\QINCertificate;
use odbh\QProtocol;
use odbh\QXCertificate;
use odbh\Set;
use odbh\Stock;
use odbh\StockExport;
use odbh\StockIdentification;
use odbh\StockInternal;

class QReportsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = Set::get();
        foreach ($cities as $city_one){
            $city = $city_one;
        }
        $array = array();
        $year_now = null;
        $all = null;

        $certificates = QCertificate::get();
        $xcertificates = QXCertificate::get();
        $incertificates = QINCertificate::get();
        $protocols = QProtocol::get();
        $compliances = QCompliance::get();
        $identifications = QIdentification::get();

        $month_select = [
            0 => 'Избери Месец',
            1 => 'Януари',
            2 => 'Февруари',
            3 => 'Март',
            4 => 'Април',
            5 => 'Май',
            6 => 'Юни',
            7 => 'Юли',
            8 => 'Август',
            9 => 'Септември',
            10 => 'Октомври',
            11 => 'Ноември',
            12 => 'Декември',
            13 => 'Първите 6 месеца',
            14 => 'Вторите 6 месеца',
        ];

        if(count($certificates) != 0 && count($xcertificates) == 0 && count($incertificates) == 0 && count($identifications) == 0) {
            $all = $certificates;
        }
        elseif(count($certificates) == 0 && count($xcertificates) != 0 && count($incertificates) == 0 && count($identifications) == 0) {
            $all = $xcertificates;
        }
        elseif(count($certificates) == 0 && count($xcertificates) == 0 && count($incertificates) != 0 && count($identifications) == 0) {
            $all = $incertificates;
        }
        elseif(count($certificates) == 0 && count($xcertificates) == 0 && count($incertificates) == 0 && count($identifications) != 0) {
            $all = $identifications;
        }
        elseif(count($certificates) != 0 && count($xcertificates) != 0 && count($incertificates) == 0 && count($identifications) == 0) {
            $all = $certificates;
        }
        elseif(count($certificates) != 0 && count($xcertificates) == 0 && count($incertificates) != 0 && count($identifications) == 0) {
            $all = $certificates;
        }
        elseif(count($certificates) == 0 && count($xcertificates) != 0 && count($incertificates) != 0 && count($identifications) == 0) {
            $all = $incertificates;
        }
        elseif(count($certificates) != 0 && count($xcertificates) != 0 && count($incertificates) != 0 && count($identifications) == 0) {
            $all = $certificates;
        }
        else {
            $all = $certificates;
        }

        foreach($all as $certificate_year){
            $array[date('Y', $certificate_year->date_issue)] = date('Y', $certificate_year->date_issue);
        }
        $years = array_filter(array_unique($array));

        if(isset($request['years'])){
            $year_now = $request['years'];
            $start = '01.01.';
            $end = '31.12.';
        }
        else{
            $year_now_key = date('Y', time());
            if(array_key_exists($year_now_key, $years)){
                $year_now = date('Y', time());
                $start = '01.01.';
                $end = '31.12.';
            }
            else{
                end($years);
                $year_now = key($years);
                $start = '01.01.';
                $end = '31.12.';
            }
        }

        if(isset($request['month_select'])){
            $selected_month = $request['month_select'];
            if($request['month_select'] == 1) {
                $start = '01.01.';
                $end = '31.01.';
            }
            elseif ($request['month_select'] == 2) {
                $start = '01.02.';
                $end = '29.02.';
            }
            elseif ($request['month_select'] == 3) {
                $start = '01.03.';
                $end = '31.03.';
            }
            elseif ($request['month_select'] == 4) {
                $start = '01.04.';
                $end = '30.04.';
            }
            elseif ($request['month_select'] == 5) {
                $start = '01.05.';
                $end = '31.05.';
            }
            elseif ($request['month_select'] == 6) {
                $start = '01.06.';
                $end = '30.06.';
            }
            elseif ($request['month_select'] == 7) {
                $start = '01.07.';
                $end = '31.07.';
            }
            elseif ($request['month_select'] == 8) {
                $start = '01.08.';
                $end = '31.08.';
            }
            elseif ($request['month_select'] == 9) {
                $start = '01.09.';
                $end = '30.09.';
            }
            elseif ($request['month_select'] == 10) {
                $start = '01.10.';
                $end = '31.10.';
            }
            elseif ($request['month_select'] == 11) {
                $start = '01.11.';
                $end = '30.11.';
            }
            elseif ($request['month_select'] == 12) {
                $start = '01.12.';
                $end = '31.12.';
            }
            elseif ($request['month_select'] == 13) {
                $start = '01.01.';
                $end = '31.06.';
            }
            elseif ($request['month_select'] == 14) {
                $start = '01.07.';
                $end = '31.12.';
            }
            else {
                $start = '01.01.';
                $end = '31.12.';
            }
        }
        else{
            $selected_month = 'false';
        }

        $start_year = $start. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = $end. $year_now;
        $time_end = strtotime(stripslashes($end_year));
//        dd($end_year);

//        $start_year = '01.01.'. $year_now;
//        $time_start = strtotime(stripslashes($start_year));
//        $end_year = '31.12.'. $year_now;
//        $time_end = strtotime(stripslashes($end_year));

        $certificates_year = QCertificate::where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->where('type_crops', '=', 1)->get();
        $certificates_year_cons = QCertificate::where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->where('type_crops', '=', 2)->get();
        $xcertificates_year = QXCertificate::where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->get();
        $incertificates_year = QINCertificate::where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->get();
        $protocols_year = QProtocol::where('date_protocol', '>=', $time_start)->where('date_protocol', '<=', $time_end)->get();
        $compliance_year = QCompliance::where('date_compliance', '>=', $time_start)->where('date_compliance', '<=', $time_end)->get();
        $identification_year = QIdentification::where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->where('type_crops', '=', 1)->get();

        //// ЗА СТОКИТЕ ВНОС
        $lists = Stock::orderBy('crops_name', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->where('type_crops', '=', 1)->lists('crops_name', 'crop_id')->toArray();
        $stocks = array();
        foreach($lists as $k=>$list){
            $stocks[$list] = DB::select("SELECT `crops_name`, `weight` FROM stocks WHERE crop_id=$k AND type_crops=1 AND date_issue >= $time_start AND date_issue <= $time_end ");
        }
        $stocks = json_decode(json_encode(array_filter($stocks)), true);

        //// ЗА СТОКИТЕ IDENTIFICATION
        $lists = StockIdentification::orderBy('crops_name', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->where('type_crops', '=', 1)->lists('crops_name', 'crop_id')->toArray();
        $stocks_identification = array();
        foreach($lists as $k=>$list){
            $stocks_identification[$list] = DB::select("SELECT `crops_name`, `weight` FROM stocks_identification WHERE crop_id=$k AND type_crops=1 AND date_issue >= $time_start AND date_issue <= $time_end ");
        }
        $stocks_identification = json_decode(json_encode(array_filter($stocks_identification)), true);

        //// ЗА СТОКИТЕ ИЗНОС
        $xlists = StockExport::orderBy('crops_name', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->lists('crops_name', 'crop_id')->toArray();
        $stocks_export = array();
        foreach($xlists as $k=>$list){
            $stocks_export[$list] = DB::select("SELECT `crops_name`, `weight` FROM stocks_export WHERE crop_id=$k  AND date_issue >= $time_start AND date_issue <= $time_end ");
        }
        $stocks_export = json_decode(json_encode(array_filter($stocks_export)), true);

        //// ЗА СТОКИТЕ ВЪТРЕШНИ
        $inlists = StockInternal::orderBy('crops_name', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->lists('crops_name', 'crop_id')->toArray();
        $stocks_internal = array();
        foreach($inlists as $k=>$list){
            $stocks_internal[$list] = DB::select("SELECT `crops_name`, `weight` FROM stocks_internal WHERE crop_id=$k  AND date_issue >= $time_start AND date_issue <= $time_end ");
        }
        $stocks_internal = json_decode(json_encode(array_filter($stocks_internal)), true);

        //// ЗА СТОКИТЕ КОНСУМАЦИЯ
        $clists = Stock::orderBy('crops_name', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->where('type_crops', '=', 2)->lists('crops_name', 'crop_id')->toArray();
        $stocks_consume = array();
        foreach($clists as $k=>$list){
            $stocks_consume[$list] = DB::select("SELECT `crops_name`, `weight` FROM stocks WHERE crop_id=$k AND type_crops=2  AND date_issue >= $time_start AND date_issue <= $time_end ");
        }
        $stocks_consume = json_decode(json_encode(array_filter($stocks_consume)), true);

        //// ЗА СТОКИТЕ ВЪВ ФОРМУЛЯР
        $lists_compliance = Article::orderBy('product', 'asc')->where('date_compliance', '>=', $time_start)->where('date_compliance', '<=', $time_end)->lists('product', 'product_id')->toArray();
        $stocks_compliance = array();
        foreach($lists_compliance as $k=>$list){
            $stocks_compliance[$list] = DB::select("SELECT `product`, `quantity` FROM qarticles WHERE product_id=$k  AND date_compliance >= $time_start AND date_compliance <= $time_end ");
        }
        $stocks_compliance = json_decode(json_encode(array_filter($stocks_compliance)), true);

        return view('quality.reports.index', compact('city', 'years', 'year_now',
            'certificates', 'certificates_year', 'certificates_year_cons',
            'identifications', 'identification_year',
            'xcertificates', 'xcertificates_year',
            'incertificates', 'incertificates_year',
            'protocols', 'protocols_year',
            'compliances', 'compliance_year',
            'stocks_compliance', 'stocks', 'stocks_export', 'stocks_internal', 'stocks_consume', 'stocks_identification',
            'month_select', 'selected_month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
