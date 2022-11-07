<?php

namespace odbh\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\QXCertificate;
use odbh\Stock;
use odbh\QCertificate;
use odbh\Http\Requests\StocksRequest;
use odbh\StockExport;
use odbh\User;
use odbh\Crop;
use odbh\Set;
use Auth;
use Input;
use odbh\Importer;
use Redirect;
use Response;
use Session;


class StocksController extends Controller
{
    private $index = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'choose', 'create_import']]);
        

        $this->index = Set::select('q_index', 'authority_bg', 'authority_en')->get()->toArray();
    }

    /**
     * ВНОС СПИСЪК СЪС СТОКИТЕ
     * Display the specified resource.
     *
     * @return Response
     */
    public function import_index()
    {
        $stocks = Stock::where('import', '>', 0)->orderBy('certificate_id', 'desc')->get();
        $list = Stock::orderBy('crop_id', 'asc')->lists('crops_name', 'crop_id')->toArray();
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();
        $inspectors = User::select('id', 'short_name')
                                        ->where('active', '=', 1)
                                        ->where('ppz','=', 1)
                                        ->where('stamp_number','<', 5000)
                                        ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('quality.stocks.index', compact('stocks', 'list', 'firms', 'inspectors'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param StocksRequest $request
     * @return Response
     */
    public function import_stock_store(StocksRequest $request)
    {
        $data = [
            'certificate_id' => $request->certificate_id,
            'certificate_number' => $request->certificate_number,
            'firm_id' => $request->firm_id,
            'firm_name' => $request->firm_name,
            'date_issue' => $request->date_issue,
            'import' => 2,
            'type_pack' => (int)$request->type_package,
            'type_crops' => $request->type_crops,
            'number_packages' => $request->number_packages,
            'different' => $request->different,
            'crop_id' => $request->crops,
            'crops_name' => $request->crops_name,
            'crop_en' => $request->crop_en,
            'variety' => $request->variety,
            'quality_class' => $request->quality_class,
            'weight' => $request->weight,
            'date_add' => date('d.m.Y', time()),
            'inspector_name' => Auth::user()->short_name,
            'added_by' => Auth::user()->id,
        ];

        Stock::create($data);
        return back();
    }

    public function import_stock_update(StocksRequest $request, $id)
    {
        $stock = Stock::findOrFail($id);

        if ($request->type_package != 999) {
            $different = '';
        } else {
            $different = $request->different;
        }
        $data = [
            'type_pack' => (int)$request->type_package,
            'type_crops' => (int)$request->type_crops,
            'number_packages' => $request->number_packages,
            'different' => $different,
            'crop_id' => $request->crops,
            'crops_name' => $request->crops_name,
            'crop_en' => $request->crop_en,
            'variety' => $request->variety,
            'quality_class' => $request->quality_class,
            'weight' => $request->weight,
            'date_update' => date('d.m.Y', time()),
            'updated_by' => Auth::user()->id,
        ];

        $stock->fill($data);
        $stock->save();

        return Redirect::to('/import/stock/'.$stock->certificate_id.'/0/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param $sid
     * @return Response
     */
    public function import_stocks_edit($id, $sid) 
    {
        $qualitys = ['1' => 'I клас/I class', '2' => 'II клас/II class', '3' => 'OПС/GPS'];
        $packages = ['4' => 'Торби/ Bags', '3' => 'Кашони/ C. boxes', '2' => 'Палети/ Cages', '1' => 'Каси/ Pl. cases', '999' => 'ДРУГО'];
        $crops= Crop::select('id', 'name', 'name_en', 'group_id')
            ->where('group_id', '=', 4)
            ->orWhere('group_id', '=', 5)
            ->orWhere('group_id', '=', 6)
            ->orWhere('group_id', '=', 7)
            ->orWhere('group_id', '=', 8)
            ->orWhere('group_id', '=', 9)
            ->orWhere('group_id', '=', 10)
            ->orWhere('group_id', '=', 11)
            ->orWhere('group_id', '=', 15)
            ->orWhere('group_id', '=', 16)
            ->orderBy('group_id', 'asc')->get()->toArray();

        $certificate = QCertificate::findOrFail($id);
        $stocks = $certificate->stocks->toArray();
        $count = count($stocks);
        $lock = $certificate->is_lock;
        if ($sid != 0) {
            $article = Stock::select()->where('id','=', $sid)->where('certificate_id','=', $id)->get()->toArray();
        }
        else {
            $article = 0;
        }

        return view('quality.certificates.import.stock_edit', compact('id', 'crops', 'certificate', 'stocks', 'count', 'lock', 'article', 'qualitys', 'packages' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function import_destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete();
        return back();
    }


    /**
     * Сортира по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @param null $crop_sort
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $inspector_sort
     *
     * @return \Illuminate\Http\Response
     * @internal param Crop $int
     */
    public function import_sort(Request $request, $start_year = null, $end_year = null, $crop_sort = null, $inspector_sort = null, $firm_sort = null ) 
    {
        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        if (Input::has('start_year') || Input::has('end_year') || Input::has('crop_sort') || Input::has('inspector_sort') || Input::has('firm_sort')) {
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_crop = Input::get('crop_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_firm = Input::get('firm_sort');
        } else {
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_crop = $crop_sort;
            $sort_inspector = $inspector_sort;
            $sort_firm = $firm_sort;
        }

        if ((isset($years_start_sort) && $years_start_sort != '') || (isset($years_end_sort) && $years_end_sort != '')) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');
            if($start > 0 && $end == false){
                // $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
                $years_sql = ' AND date_issue='.$start;
            }
            if($end > 0 && $start == false){
                // $years_sql = ' AND date_issue='.$end.' OR date_issue='.$timezone_paris_end;
                $years_sql = ' AND date_issue='.$end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                // $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
                $years_sql = ' AND date_issue='.$start;
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
            $crop_sql = ' AND crop_id='.$sort_crop;
        }
        else{
            $crop_sql = ' ';
        }
        // Сортиране по инспектор
        if (isset($sort_inspector) && (int)$sort_inspector > 0){
            $inspector_sql = ' AND added_by= '.$sort_inspector;
        }
        else{
            $inspector_sql = '';
        }
        // Сортиране по фирма
        if (isset($sort_firm) && (int)$sort_firm != 0) {
            $firm_sql = ' AND firm_id='.$sort_firm;
        }
        else{
            $firm_sql = ' ';
        }

        $list = Stock::orderBy('crop_id', 'asc')->lists('crops_name', 'crop_id')->toArray();
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

        $stocks = DB::select("SELECT * FROM stocks WHERE import >0 $years_sql $crop_sql $inspector_sql $firm_sql ORDER BY certificate_id DESC;");

        return view('quality.stocks.index', compact('stocks', 'list', 'firms', 'inspectors',
                'years_start_sort', 'years_end_sort', 'sort_crop', 'sort_inspector', 'sort_firm'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  int $type
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function import_search(Request $request, $type)
    {
        $search_value_return = $request['stock_number'];
        $search_firm_return = $request['search_firm'];

        if($type == 1) {
            $this->validate($request, ['stock_number' => 'required|digits_between:1,4'],
                                      [
                                          'stock_number.required' => 'Попълни търсения номер!',
                                          'stock_number.digits_between' => 'Номера трябва да е между една и четири цифри!',
                                      ]);
            $stocks = Stock::where('certificate_number', '=', $request['stock_number'])->get();
        }
        if($type == 2) {
            $this->validate($request, ['search_firm' => 'required|not_in:0'],
                                      [
                                          'search_firm.required' => 'Избери фирма!',
                                          'search_firm.not_in' => 'Избери фирма!',
                                      ]);

            $stocks = Stock::where('firm_id', '=', $request['search_firm'])->get();
        }

        $list = Stock::orderBy('crop_id', 'asc')->lists('crops_name', 'crop_id')->toArray();
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);
        
        return view('quality.stocks.index', compact('stocks', 'search_value_return', 'search_firm_return', 'list', 'firms', 'inspectors'));
    }


    /** КОНСУМАЦИЯ ПРЕРАБОТКА
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function consume(Request $request)
    {
        $list = Stock::orderBy('crop_id', 'asc')->lists('crops_name', 'crop_id')->toArray();
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();
        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        if( Input::has('type_crops')) {
            $type_crops = Input::get('type_crops');
            $type_sql = ' AND type_crops='.$type_crops;
        }
        else {
            $type_crops = 1;
            $type_sql = ' AND type_crops=1';
        }

        if( Input::has('stock_number')) {
            $stock_number = Input::get('stock_number');
            $stock_sql  = ' AND certificate_number ='.$stock_number;
        }
        else {
            $stock_sql = '';
        }
        $stocks = DB::select("SELECT * FROM stocks WHERE import >0 $type_sql $stock_sql ORDER BY certificate_id DESC;");

        return view('quality.stocks.consume.index', compact('stocks', 'list', 'firms', 'inspectors', 'type_crops'));
    }

    /**
     * Сортира по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @param null $crop_sort
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $inspector_sort
     * @param  int $firm_sort
     * @param  int $type_crops
     *
     * @return \Illuminate\Http\Response
     * @internal param Crop $int
     */
    public function consume_sort(Request $request, $type_crops = null, $start_year = null, $end_year = null, $crop_sort = null, $inspector_sort = null, $firm_sort = null )
    {
        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        if (Input::has('start_year') || Input::has('end_year')  || Input::has('type_hidden') || Input::has('crop_sort') || Input::has('inspector_sort') || Input::has('firm_sort')) {
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_crop = Input::get('crop_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_firm = Input::get('firm_sort');
            $crops_type = Input::get('type_hidden');
        } else {
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_crop = $crop_sort;
            $sort_inspector = $inspector_sort;
            $sort_firm = $firm_sort;
            $crops_type = $type_crops;
        }

        if ((isset($years_start_sort) && $years_start_sort != '') || (isset($years_end_sort) && $years_end_sort != '')) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');
            if($start > 0 && $end == false){
                // $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
                $years_sql = ' AND date_issue='.$start;
            }
            if($end > 0 && $start == false){
                // $years_sql = ' AND date_issue='.$end.' OR date_issue='.$timezone_paris_end;
                $years_sql = ' AND date_issue='.$end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                // $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
                $years_sql = ' AND date_issue='.$start;
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

        if( isset($crops_type) && (int)$crops_type != 0 ) {
            $type_crops = $crops_type;
            $type_sql = ' AND type_crops='.$crops_type;
        }
        else {
            $type_crops = 1;
            $type_sql = ' AND type_crops=1';
        }

        // Сортиране по култура
        if (isset($sort_crop) && (int)$sort_crop != 0) {
            $crop_sql = ' AND crop_id='.$sort_crop;
        }
        else{
            $crop_sql = ' ';
        }
        // Сортиране по инспектор
        if (isset($sort_inspector) && (int)$sort_inspector > 0){
            $inspector_sql = ' AND added_by= '.$sort_inspector;
        }
        else{
            $inspector_sql = '';
        }
        // Сортиране по фирма
        if (isset($sort_firm) && (int)$sort_firm != 0) {
            $firm_sql = ' AND firm_id='.$sort_firm;
        }
        else{
            $firm_sql = ' ';
        }

        $list = Stock::orderBy('crop_id', 'asc')->lists('crops_name', 'crop_id')->toArray();
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

        $stocks = DB::select("SELECT * FROM stocks WHERE import >0 $type_sql $years_sql $crop_sql $inspector_sql $firm_sql ORDER BY certificate_id DESC;");

        return view('quality.stocks.consume.index', compact('stocks', 'list', 'firms', 'inspectors', 'type_crops',
            'years_start_sort', 'years_end_sort', 'sort_crop', 'sort_inspector', 'sort_firm'));
    }


    /**
     * ВНОС СПИСЪК СЪС СТОКИТЕ
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function export_index(Request $request)
    {
        $search_value_return = $request['stock_number'];
        $search_firm_return = $request['search_firm'];

        if(count((array)$request['stock_number']) != 0) {
            $this->validate($request, ['stock_number' => 'required|digits_between:1,4'],
                [
                    'stock_number.required' => 'Попълни търсения номер!',
                    'stock_number.digits_between' => 'Номера трябва да е между една и четири цифри!',
                ]);
            $stocks = StockExport::where('certificate_number', '=', $request['stock_number'])->get();
        }
        elseif (count((array)$request['search_firm']) != 0) {
            $this->validate($request, ['search_firm' => 'required|not_in:0'],
                [
                    'search_firm.required' => 'Избери фирма!',
                    'search_firm.not_in' => 'Избери фирма!',
                ]);

            $stocks = StockExport::where('firm_id', '=', $request['search_firm'])->get();
        }
        else {
            $stocks = StockExport::where('export', '>', 0)->orderBy('certificate_id', 'desc')->get();
        }

        $list = StockExport::orderBy('crop_id', 'asc')->lists('crops_name', 'crop_id')->toArray();
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 1)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();
        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('quality.stocks.export.index', compact('stocks', 'list', 'firms', 'inspectors', 'search_firm_return'));
    }

    /**
     * Сортира по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @param null $crop_sort
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $inspector_sort
     *
     * @return \Illuminate\Http\Response
     * @internal param Crop $int
     */
    public function export_sort(Request $request, $start_year = null, $end_year = null, $crop_sort = null, $inspector_sort = null, $firm_sort = null )
    {
        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        if (Input::has('start_year') || Input::has('end_year') || Input::has('crop_sort') || Input::has('inspector_sort') || Input::has('firm_sort')) {
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_crop = Input::get('crop_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_firm = Input::get('firm_sort');
        } else {
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_crop = $crop_sort;
            $sort_inspector = $inspector_sort;
            $sort_firm = $firm_sort;
        }

        if ((isset($years_start_sort) && $years_start_sort != '') || (isset($years_end_sort) && $years_end_sort != '')) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');
            if($start > 0 && $end == false){
                // $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
                $years_sql = ' AND date_issue='.$start;
            }
            if($end > 0 && $start == false){
                // $years_sql = ' AND date_issue='.$end.' OR date_issue='.$timezone_paris_end;
                $years_sql = ' AND date_issue='.$end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                // $years_sql = ' AND date_issue='.$start.' OR date_issue='.$timezone_paris_start;
                $years_sql = ' AND date_issue='.$start;
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
            $crop_sql = ' AND crop_id='.$sort_crop;
        }
        else{
            $crop_sql = ' ';
        }
        // Сортиране по инспектор
        if (isset($sort_inspector) && (int)$sort_inspector > 0){
            $inspector_sql = ' AND added_by= '.$sort_inspector;
        }
        else{
            $inspector_sql = '';
        }
        // Сортиране по фирма
        if (isset($sort_firm) && (int)$sort_firm != 0) {
            $firm_sql = ' AND firm_id='.$sort_firm;
        }
        else{
            $firm_sql = ' ';
        }

        $list = Stock::orderBy('crop_id', 'asc')->lists('crops_name', 'crop_id')->toArray();
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 1)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

        $stocks = DB::select("SELECT * FROM stocks_export WHERE export >0 $years_sql $crop_sql $inspector_sql $firm_sql ORDER BY certificate_id DESC;");

        return view('quality.stocks.export.index', compact('stocks', 'list', 'firms', 'inspectors',
            'years_start_sort', 'years_end_sort', 'sort_crop', 'sort_inspector', 'sort_firm'));
    }

    /** ВНОС */
    /**
     * Display the specified resource.
     *
     *
     * @param StocksRequest $request
     * @return Response
     */
    public function export_stock_store(StocksRequest $request)
    {
        $data = [
            'certificate_id' => $request->certificate_id,
            'certificate_number' => $request->certificate_number,
            'firm_id' => $request->firm_id,
            'firm_name' => $request->firm_name,
            'date_issue' => $request->date_issue,
            'export' => 3,
            'type_pack' => (int)$request->type_package,
            'type_crops' => $request->type_crops,
            'number_packages' => $request->number_packages,
            'different' => $request->different,
            'crop_id' => $request->crops,
            'crops_name' => $request->crops_name,
            'crop_en' => $request->crop_en,
            'variety' => $request->variety,
            'quality_class' => $request->quality_class,
            'weight' => $request->weight,
            'date_add' => date('d.m.Y', time()),
            'inspector_name' => Auth::user()->short_name,
            'added_by' => Auth::user()->id,
        ];

        StockExport::create($data);
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param $sid
     * @return Response
     */
    public function export_stocks_edit($id, $sid)
    {
        $qualitys = ['1' => 'I клас/I class', '2' => 'II клас/II class', '3' => 'OПС/GPS'];
        $packages = ['4' => 'Торби/ Bags', '3' => 'Кашони/ C. boxes', '2' => 'Палети/ Cages', '1' => 'Каси/ Pl. cases', '999' => 'ДРУГО'];
        $crops= Crop::select('id', 'name', 'name_en', 'group_id')
            ->where('group_id', '=', 4)
            ->orWhere('group_id', '=', 5)
            ->orWhere('group_id', '=', 6)
            ->orWhere('group_id', '=', 7)
            ->orWhere('group_id', '=', 8)
            ->orWhere('group_id', '=', 9)
            ->orWhere('group_id', '=', 10)
            ->orWhere('group_id', '=', 11)
            ->orWhere('group_id', '=', 15)
            ->orWhere('group_id', '=', 16)
            ->orderBy('group_id', 'asc')->get()->toArray();

        $certificate = QXCertificate::findOrFail($id);
        $stocks = $certificate->export_stocks->toArray();
        $count = count($stocks);
        $lock = $certificate->is_lock;

        if ($sid != 0) {
            $article = StockExport::select()->where('id','=', $sid)->where('certificate_id','=', $id)->get()->toArray();
        }
        else {
            $article = 0;
        }

        return view('quality.certificates.export.stock_edit', compact('id', 'crops', 'certificate', 'stocks', 'count', 'lock', 'article', 'qualitys', 'packages' ));
    }

    public function export_stock_update(StocksRequest $request, $id)
    {

        $stock = StockExport::findOrFail($id);

        if ($request->type_package != 999) {
            $different = '';
        } else {
            $different = $request->different;
        }
        $data = [
            'type_pack' => (int)$request->type_package,
            'type_crops' => (int)$request->type_crops,
            'number_packages' => $request->number_packages,
            'different' => $different,
            'crop_id' => $request->crops,
            'crops_name' => $request->crops_name,
            'crop_en' => $request->crop_en,
            'variety' => $request->variety,
            'quality_class' => $request->quality_class,
            'weight' => $request->weight,
            'date_update' => date('d.m.Y', time()),
            'updated_by' => Auth::user()->id,
        ];

        $stock->fill($data);
        $stock->save();

        return Redirect::to('/export/stock/'.$stock->certificate_id.'/0/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function export_destroy($id)
    {
        $stock = StockExport::find($id);
        $stock->delete();
        return back();
    }






    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


}
