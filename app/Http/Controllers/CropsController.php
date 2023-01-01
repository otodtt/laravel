<?php

namespace odbh\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use odbh\Crop;
use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Http\Requests\CropsRequest;
use odbh\StockExport;
use odbh\StockInternal;
use Session;
use odbh\Stock;
use Input;
use DB;

class CropsController extends Controller
{
    private $index = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = array(
            1 =>'Зърненожитни',
            2 => 'Бобови',
            3 => 'Технически',
            4 => 'Зеленчуци',
            5 => 'Зелеви култури',
            6 => 'Тиквови култури',
            7 => 'Лукови култури',
            8 => 'Листни зеленчуци',
            9 => 'Коренови и стъблени',
            10 => 'Овощни',
            11 => 'Ягодоплодни',
            12 => 'Лоза',
            13 => 'Етерично-Маслени',
            14 => 'Украсни и Горски видове',
            15 => 'Цитросови',
            16 => 'Други'
        );
        
        $cultures = Crop::get();
        return view('crops.index', compact('cultures', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crops.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\CropsRequest|CropsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CropsRequest $request)
    {
        
        $string = $request->latin;
        $insert = preg_replace('/(\w+)/', '-$1', $string);
        $remove= str_replace(' ', '', $insert);
        $first = substr($remove, 1);

        $data = [
            'name' => $request['name'],
            'group_id' => (int)$request['group_id'],
            'name_en' => $request['name_en'],
            'date_create' => date('d.m.Y H:i:s', time()),
            'created_by' => Auth::user()->id,
            // 'latin' => $request['latin'],
            // 'latin_name' => $lower,
            // 'cropDescription' => $request['cropDescription'],

        ];
        Crop::create($data);
        Session::flash('message', 'Културата е добавена успешно!');
        return Redirect::to('/контрол/култури/внос');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
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
        /// IMPORT
        $certs_import = Stock::get();
        if(count($certs_import) > 0) {
            foreach($certs_import as $cert){
                $array_import[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
                $yearsI = array_filter(array_unique($array_import));
            }
        }
        else{
            $yearsI = array();
        }
        /// EXPORT
        $certs_export = StockExport::get();
        if(count($certs_export) > 0) {
            foreach($certs_export as $cert){
                $array_export[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
                $yearsX = array_filter(array_unique($array_export));
            }
        }
        else {
            $yearsX = array();
        }
        /// DOMESTIC
        $certs_domestic = StockInternal::get();
        if(count($certs_domestic) > 0){
            foreach($certs_domestic as $cert){
                $array_domestic[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
                $yearsD = array_filter(array_unique($array_domestic));
            }
        }
        else {
            $yearsD = array();
        }
        
        if(isset($yearsI) || isset($yearsX) || isset($yearsD)  ) {
            $years = array_replace($yearsI, $yearsX, $yearsD);
            ksort($years);
        }
        else {
            $years = [2022 => "2022"];
        }
        
       

        $culture = Crop::findOrFail($id);
        $stocks_import = Stock::where('crop_id', $id)->where('date_issue', '>=', $time_start )->where('date_issue', '<=', $time_end )->orderby('date_issue', 'desc')->get();
        $stocks_export = StockExport::where('crop_id', $id)->where('date_issue', '>=', $time_start )->where('date_issue', '<=', $time_end )->orderby('date_issue', 'desc')->get();
        $stocks_domestic = StockInternal::where('crop_id', $id)->where('date_issue', '>=', $time_start )->where('date_issue', '<=', $time_end )->orderby('date_issue', 'desc')->get();


        return view('crops.show', compact('culture', 'stocks_import', 'stocks_export', 'stocks_domestic', 'years', 'year_now'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crops = Crop::findOrFail($id);
        return view('crops.forms.edit', compact('crops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|CropsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CropsRequest $request, $id)
    {
        $crop = Crop::findOrFail($id);
        $string = $request->latin;
        $insert = preg_replace('/(\w+)/', '-$1', $string);
        $remove= str_replace(' ', '', $insert);
        $first = substr($remove, 1);
        //  $lower = strtolower($first);

       $data = [
            'name' => $request['name'],
            'group_id' => (int)$request['group_id'],
            'name_en' => $request['name_en'],
           'date_update' => date('d.m.Y H:i:s', time()),
           'updated_by' => Auth::user()->id,
            // 'latin' => $request['latin'],
            // 'latin_name' => $lower,
            // 'cropDescription' => $request['cropDescription'],

       ];

        $crop->fill($data);
        $crop->save();

        Session::flash('message', 'Културата е редактирана успешно!');
        return Redirect::to('/контрол/култури');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crop = Crop::find($id);
        $crop->delete();
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function crops_import(Request $request)
    {
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

        $certs = Stock::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));

        $initial_year = null;
        $final_year = null;
        $crop_sort = null;

        if (Input::has('initial_year') || Input::has('final_year') || Input::has('crop_sort')) {
            $years_start_sort = Input::get('initial_year');
            $years_end_sort = Input::get('final_year');
            $sort_crop = Input::get('crop_sort');
        }
        else {
            $years_start_sort = $initial_year;
            $years_end_sort = $final_year;
            $sort_crop = $crop_sort;
        }

        if ((isset($years_start_sort) && $years_start_sort != '') || (isset($years_end_sort) && $years_end_sort != '')) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');

            if($start > 0 && $end == false){
                $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
            }
            if($end > 0 && $start == false){
                $years_sql = ' AND date_issue='.$end.' OR date_issue='.$timezone_paris_end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)){
                $years_sql = ' AND date_issue>='.$start.' AND date_issue<='.$end.'';
            }
            if(($start > 0 && $end > 0) && ($start > $end)){
                $years_sql = ' AND date_issue>='.$end.' AND date_issue<='.$start.'';
            }
        }
        else{
            $years_sql = ' ';
        }

        // Сортиране по култура
        if (isset($sort_crop) && (int)$sort_crop != 0) {
            $crops_sql = ' AND crop_id ='.$sort_crop.'';
        }
        else{
            $crops_sql = '';
        }

        if(strlen($years_sql) > 0 && $years_sql != ' ') {
            $date_sql = $years_sql;
        }
        else {
            $date_sql = ' AND date_issue>='.$time_start.' AND date_issue<='.$time_end.'';
        }

        $lists = Stock::orderBy('crop_id', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->lists('crops_name', 'crop_id')->toArray();

        $stocks = array();
        foreach($lists as $k=>$list){
            $stocks[$list] = DB::select("SELECT * FROM stocks WHERE crop_id=$k $date_sql $crops_sql ");
        }
        $stocks = json_decode(json_encode(array_filter($stocks)), true);

        return view('crops.import', compact('stocks', 'years', 'year_now', 'lists', 'sort_crop', 'years_start_sort', 'years_end_sort' ));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function crops_export(Request $request)
    {
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

        $certs = StockExport::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));

        $initial_year = null;
        $final_year = null;
        $crop_sort = null;

        if (Input::has('initial_year') || Input::has('final_year') || Input::has('crop_sort')) {
            $years_start_sort = Input::get('initial_year');
            $years_end_sort = Input::get('final_year');
            $sort_crop = Input::get('crop_sort');
        }
        else {
            $years_start_sort = $initial_year;
            $years_end_sort = $final_year;
            $sort_crop = $crop_sort;
        }

        if ((isset($years_start_sort) && $years_start_sort != '') || (isset($years_end_sort) && $years_end_sort != '')) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');

            if($start > 0 && $end == false){
                $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
            }
            if($end > 0 && $start == false){
                $years_sql = ' AND date_issue='.$end.' OR date_issue='.$timezone_paris_end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)){
                $years_sql = ' AND date_issue>='.$start.' AND date_issue<='.$end.'';
            }
            if(($start > 0 && $end > 0) && ($start > $end)){
                $years_sql = ' AND date_issue>='.$end.' AND date_issue<='.$start.'';
            }
        }
        else{
            $years_sql = ' ';
        }

        // Сортиране по култура
        if (isset($sort_crop) && (int)$sort_crop != 0) {
            $crops_sql = ' AND crop_id ='.$sort_crop.'';
        }
        else{
            $crops_sql = '';
        }

        if(strlen($years_sql) > 0 && $years_sql != ' ') {
            $date_sql = $years_sql;
        }
        else {
            $date_sql = ' AND date_issue>='.$time_start.' AND date_issue<='.$time_end.'';
        }

        $lists = StockExport::orderBy('crop_id', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->lists('crops_name', 'crop_id')->toArray();

        $stocks = array();
        foreach($lists as $k=>$list){
            $stocks[$list] = DB::select("SELECT * FROM stocks_export WHERE crop_id=$k $date_sql $crops_sql ");
        }
        $stocks = json_decode(json_encode(array_filter($stocks)), true);

        return view('crops.export', compact('stocks', 'years', 'year_now', 'lists', 'sort_crop', 'years_start_sort', 'years_end_sort' ));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function crops_domestic(Request $request)
    {
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

        $certs = StockInternal::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));

        $initial_year = null;
        $final_year = null;
        $crop_sort = null;

        if (Input::has('initial_year') || Input::has('final_year') || Input::has('crop_sort')) {
            $years_start_sort = Input::get('initial_year');
            $years_end_sort = Input::get('final_year');
            $sort_crop = Input::get('crop_sort');
        }
        else {
            $years_start_sort = $initial_year;
            $years_end_sort = $final_year;
            $sort_crop = $crop_sort;
        }

        if ((isset($years_start_sort) && $years_start_sort != '') || (isset($years_end_sort) && $years_end_sort != '')) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');

            if($start > 0 && $end == false){
                $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
            }
            if($end > 0 && $start == false){
                $years_sql = ' AND date_issue='.$end.' OR date_issue='.$timezone_paris_end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)){
                $years_sql = ' AND date_issue>='.$start.' AND date_issue<='.$end.'';
            }
            if(($start > 0 && $end > 0) && ($start > $end)){
                $years_sql = ' AND date_issue>='.$end.' AND date_issue<='.$start.'';
            }
        }
        else{
            $years_sql = ' ';
        }

        // Сортиране по култура
        if (isset($sort_crop) && (int)$sort_crop != 0) {
            $crops_sql = ' AND crop_id ='.$sort_crop.'';
        }
        else{
            $crops_sql = '';
        }

        if(strlen($years_sql) > 0 && $years_sql != ' ') {
            $date_sql = $years_sql;
        }
        else {
            $date_sql = ' AND date_issue>='.$time_start.' AND date_issue<='.$time_end.'';
        }

        $lists = StockInternal::orderBy('crop_id', 'asc')->where('date_issue', '>=', $time_start)->where('date_issue', '<=', $time_end)->lists('crops_name', 'crop_id')->toArray();

        $stocks = array();
        foreach($lists as $k=>$list){
            $stocks[$list] = DB::select("SELECT * FROM stocks_internal WHERE crop_id=$k $date_sql $crops_sql ");
        }
        $stocks = json_decode(json_encode(array_filter($stocks)), true);

        return view('crops.domestic', compact('stocks', 'years', 'year_now', 'lists', 'sort_crop', 'years_start_sort', 'years_end_sort' ));
    }
}
