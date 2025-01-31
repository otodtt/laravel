<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\QCertificate;
use odbh\QIdentification;
use odbh\Set;
use odbh\Http\Requests\ImportersRequest;
use odbh\Importer;
use Auth;
use odbh\Stock;
use odbh\StockIdentification;
use Session;
use Input;
use DB;

class ImportersController extends Controller
{
    private $index = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @internal param null $type
     * @internal param null $sort
     */
    public function index()
    {
        $importers = Importer::orderBy('name_en', 'asc')->where('is_active', '=', '1')->get();

        return view('quality.importers.index', compact( 'importers'));
    }

    /**
     * Sort firms by different types.
     *
     * @param null $sort
     * @param null $type
     * @return \Illuminate\Http\Response
     * @internal param null $type
     */
    public function sort($sort = null, $type = null)
    {
        $input_sort = Input::get('sort');
        $input_type = Input::get('type');
        
        //////// При Избиране BG или Чужда
        if($input_sort !== null){
            if($input_sort >= 0){
                $importers_sql = ' AND is_bulgarian='.$input_sort;;
            }
            else{
                $importers_sql = '';
            }
        }
        else {
            $importers_sql = '';
        }
        //////// При Избиране вносител или износител
        if($input_type !== null){
            if($input_type >= 0){
                $type_sql = ' AND trade='.$input_type;;
            }
            else{
                $type_sql = '';
            }
        }
        else {
            $type_sql = '';
        }
      
        $importers = DB::select("SELECT * FROM importers WHERE is_active = 1 $importers_sql $type_sql");
        
        return view('quality.importers.index', compact( 'importers', 'input_sort', 'input_type' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quality.importers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|ImportersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportersRequest $request)
    {
        Importer::create ([
            'is_active'=> 1,
            'is_bulgarian'=> $request['is_bulgarian'],
            'trade'=> $request['trade'],
            'name_bg'=> mb_convert_case  ($request['name_bg'], MB_CASE_TITLE, "UTF-8"),
            'address_bg'=> $request['address_bg'],
            'name_en'=> mb_convert_case  ($request['name_en'], MB_CASE_TITLE),
            'address_en'=> $request['address_en'],
            'vin'=> $request['vin'],
            'created_by'=> Auth::user()->id,
            'date_create' => date('d.m.Y H:i:s', time()) ,
        ]);
    
        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/вносители');
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
        $importer  = Importer::findOrFail($id);
		$identification = array();
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
        $import_stocks = Stock::select(['id', 'certificate_id', 'crops_name','date_issue', 'weight'])
                                ->where('firm_id', '=', $id)
                                ->where('date_issue', '>=', $time_start )->where('date_issue', '<=', $time_end )
                                ->orderby('date_issue', 'desc')
                                ->get()->toArray();

        $time_certificates = QCertificate::select('date_issue')->where('importer_id', $id)->orderby('date_issue', 'desc')->get();
        if(count($time_certificates) > 0) {
            $import_certificates = QCertificate::select('id', 'import', 'date_issue', 'inspector_bg')
                                                ->where('importer_id', $id)
                                                ->where('date_issue', '>=', $time_start )
                                                ->where('date_issue', '<=', $time_end )
                                                ->orderby('date_issue', 'desc')->get();
            foreach($time_certificates as $cert){
                $array_import[date('Y', $cert['date_issue'])] = date('Y', $cert['date_issue']);
                $yearsI = array_filter(array_unique($array_import));
            }
        }
        else{
            $import_certificates = array();
            $yearsI = [2020 => "2022"];
        }

        // IDENTIFICATION
        $identification_stocks = StockIdentification::select(['id', 'identification_id', 'crops_name','date_issue', 'weight'])
            ->where('firm_id', '=', $id)
            ->where('date_issue', '>=', $time_start )->where('date_issue', '<=', $time_end )
            ->orderby('date_issue', 'desc')
            ->get()->toArray();
        $time_identification = QIdentification::select('date_issue')->where('importer_id', $id)->orderby('date_issue', 'desc')->get();
        if(count($time_identification) > 0) {
            foreach($time_identification as $cert){
                $array_identification[date('Y', $cert['date_issue'])] = date('Y', $cert['date_issue']);
                $yearsD = array_filter(array_unique($array_identification));
            }
        }
        else{
            $yearsD = array();
        }




        $export_certificates = $importer->qxcertificate;
        foreach($export_certificates as $certificate){
            $export_stocks[] = $certificate->export_stocks->toArray();
        }
        if(!isset($export_stocks)) {
            $export_stocks = array();
        }
        if(count($export_stocks) > 0) {
            foreach($identification as $cert){
                $export_stocks[date('Y', $cert[0]['date_issue'])] = date('Y', $cert[0]['date_issue']);
                $yearsX = array_filter(array_unique($export_stocks));
            }
        }
        else{
            $yearsX = array();
        }


        if(isset($yearsI) || isset($yearsX) || isset($yearsD)  ) {
            $years = array_replace($yearsI, $yearsX, $yearsD);
            ksort($years);
        }
        else {
            $years = [2022 => "2022"];
        }

        $import_identification = QIdentification::select('id', 'invoice_number', 'date_issue', 'inspector_bg')
                ->where('importer_id', $id)
                ->where('date_issue', '>=', $time_start )
                ->where('date_issue', '<=', $time_end )
                ->orderby('date_issue', 'desc')->get();

        return view('quality.importers.show', compact( 'importer', 'import_certificates', 'import_stocks',
                    'import_identification', 'identification_stocks', 'export_certificates', 'export_stocks', 'years', 'year_now'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $importers = Importer::findOrFail($id);
        return view('quality.importers.edit', compact('importers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|ImportersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImportersRequest $request, $id)
    {
        $importers = Importer::findOrFail($id);
        $data =([
            'is_active'=> $request['is_active'],
            'is_bulgarian'=> $request['is_bulgarian'],
            'trade'=> $request['trade'],
            'name_bg'=> mb_convert_case  ($request['name_bg'], MB_CASE_TITLE, "UTF-8"),
            'address_bg'=> $request['address_bg'],
            'name_en'=> mb_convert_case  ($request['name_en'], MB_CASE_TITLE),
            'address_en'=> $request['address_en'],
            'vin'=> $request['vin'],
            'updated_by'=> Auth::user()->id,
            'date_update' => date('d.m.Y H:i:s', time()) ,
        ]);
        

        $importers->fill($data);
        $importers->save();

        Session::flash('message', 'Фирмата е редактирана успешно!');
        return Redirect::to('/контрол/вносители');
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
