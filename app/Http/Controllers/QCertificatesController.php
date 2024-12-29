<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use odbh\Http\Requests\QCertificatesRequest;

use odbh\Crop;
use odbh\Invoice;
use odbh\Packer;
use odbh\Stock;
use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Importer;
use odbh\QCertificate;
use odbh\Set;
use odbh\Country;
use odbh\User;
use Auth;
use Redirect;
use Session;
use DB;
use Input;

class QCertificatesController extends Controller
{
    private $index = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'choose', 'create_import', 'import_ending',
                                                'import_finish', 'import_lock', 'import_unlock']]);
        

        $this->index = Set::select('q_index', 'authority_bg', 'authority_en')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request|QCertificatesRequest $request
     * @return Response
     */
    public function index(Request $request)
    {
        $array = array();
        $year_now = null;

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

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

        $certs = QCertificate::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));

        $certificates = QCertificate::where('date_issue','>=',$time_start)->where('date_issue','<=',$time_end)->orderBy('is_all', 'asc')->orderBy('id', 'desc')->get();

        return view('quality.certificates.import.index', compact('certificates', 'years', 'year_now', 'inspectors', 'firms'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $array = array();
        $year_now = null;

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

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

        $certs = QCertificate::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));
        $certificates = QCertificate::where('date_issue','>=',$time_start)->where('date_issue','<=',$time_end)->orderBy('is_all', 'asc')->orderBy('id', 'desc')->get();


        $search_return = $request['search'];
        $search_value_return = $request['search_value'];

        if((int)$request['search'] == 0){
            $this->validate($request, ['search' => 'not_in:0']);
        };
        if((int)$request['search'] == 1){
            $this->validate($request,
                    ['search_value' => 'required|digits_between:1,5'],
                    [
                        'search_value.required' => 'Попълни търсения номер!',
                        'search_value.digits_between' => 'Номера трябва да е между една и пет цифри!',
                    ]);
            $certificates = QCertificate::where('import','=',$request['search_value'])->get();
        };
        if((int)$request['search'] == 2){
            $this->validate($request,
                    ['search_value' => 'required|digits_between:3,10'],
                    [
                        'search_value.required' => 'Попълни номера на фактурата!',
                        'search_value.digits_between' => 'Номера трябва да е между 3 и 10 цифри!',
                    ]);
            $certificates = QCertificate::where('invoice_number','=',$request['search_value'])->get();
        };

        return view('quality.certificates.import.index', compact('certificates', 'years', 'year_now', 'search_return', 'inspectors', 'firms'));
    }

    public function sort(Request $request, $start_year = null, $end_year = null, $crop_sort = null, $inspector_sort = null, $firm_sort = null ) 
    {
        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 0)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

        if(isset($request['get_year'])){
            $year_now = $request['get_year'];
        }
        else{
            $year_now = date('Y', time());
        }
        $start_year = '01.01.'. $year_now;
        $time_start = strtotime(stripslashes($start_year));
        $end_year = '31.12.'. $year_now;
        $time_end = strtotime(stripslashes($end_year));

        $certs = QCertificate::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));

        if (Input::has('start_year') || Input::has('end_year') || Input::has('inspector_sort') || Input::has('firm_sort')) {
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_inspector = Input::get('inspector_sort');
            $sort_firm = Input::get('firm_sort');
        }
        else {
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
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
            $years_sql =' AND date_issue>='.$time_start.' AND date_issue<='.$time_end.'';
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
            $firm_sql = ' AND importer_id='.$sort_firm;
        }
        else{
            $firm_sql = ' ';
        }

        $certificates = DB::select("SELECT * FROM qcertificates WHERE import >0 $years_sql $inspector_sql $firm_sql ORDER BY id DESC");
        
        return view('quality.certificates.import.index', compact('certificates', 'firms', 'inspectors', 'years',
            'years_start_sort', 'years_end_sort', 'sort_inspector', 'sort_firm', 'year_now'));
    }

    /** ВНОС НАЧАЛО//////////////// */
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $type = 1;
        $edit = 0;
        $index = $this->index;

        $packers = Packer::select('id', 'packer_name', 'packer_address')->get()->toArray();
        $importers = Importer::select(['id', 'name_bg', 'name_en', 'address_en', 'vin', 'trade'])
                                    ->where('is_active', '=', 1)
                                    ->where('trade', '=', 0)
                                    ->orWhere('trade', '=', 2)
                                    ->get()->toArray();

        $countries= Country::select('id', 'name', 'name_en', 'EC')->where('EC', '=', 1)->orderBy('name', 'asc')->get()->toArray();

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
       
        $last_import = QCertificate::select('import')->orderBy('import', 'desc')->limit(1)->get()->toArray();

        $id = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $id)->get()->toArray();

        if(!empty($last_import)) {
            $last_number = $last_import;
        } else {
            $last_number[0]['import'] = '1001';
        }

        return view('quality.certificates.import.import_certificate',
                    compact('index', 'importers', 'countries', 'crops', 'user', 'last_number', 'type', 'edit', 'packers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\QCertificatesRequest $request
     * @return Response
     */
    public function store(QCertificatesRequest $request)
    {
        $index = $this->index;
        $user = User::select('id', 'all_name', 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', Auth::user()->id)->get()->toArray();

        $last_import = QCertificate::select('import')->orderBy('import', 'desc')->limit(1)->get()->toArray();

        $one = 1;
        $hundred = 1000;
        $thousand = 10000;

        if(!empty($last_import)) {
            if($last_import[0]['import'] < 1999 ){
                $import = $last_import[0]['import'] + 1;
            }
            if($last_import[0]['import'] == 1999 ){
                $import = $one.$hundred ;
            }
            if($last_import[0]['import'] >= 11000 ){
                $import = $last_import[0]['import'] + 1;
            }
            if($last_import[0]['import'] == 19999 ){
                $import = $one.$thousand ;
            }
            if($last_import[0]['import'] >= 110000 ){
                $import = $last_import[0]['import'] + 1;
            }
        } else {
            $import = '1001';
        }

        if($request->packer_data == 999  ) {
            $packer_name = $request->packer_name;
            $packer_address = $request->packer_address;
        } else {
            $packer_name = $request->name_of_packer;
            $packer_address = $request->address_of_packer;
        }

        $date_now = time();
        $convert_date = date('d.m.Y', $date_now);
        $final_date = strtotime($convert_date);

        $data = [
            'import' => $import,
            'what_7' => 2,
            'type_crops' => $request->type_crops,
            'importer_id' => $request->importer_data,
            'importer_name' => $request->en_name,
            'importer_address' => $request->en_address,
            'importer_vin' => $request->vin_hidden,
            'packer_id' => $request->packer_data,
            'packer_name' => $packer_name,
            'packer_address' => $packer_address,
            'from_country' => $request->from_country,
            'id_country' => $request->id_country,
            'for_country_bg' => $request->for_country_bg,
            'for_country_en' => $request->for_country_en,
            'observations' => $request->observations,
            'transport' => $request->transport,
            'customs_bg' => $request->customs_bg,
            'customs_en' => $request->customs_en,
            'place_bg' => $request->place_bg,
            'place_en' => $request->place_en,
            'date_issue' => $final_date,
            'valid_until' => $request->valid_until,
            'inspector_bg' => $user[0]['all_name'],
            'inspector_en' => $user[0]['all_name_en'],
            'stamp_number' => $index[0]['q_index'].'-'.$user[0]['stamp_number'],
            'authority_bg' => $index[0]['authority_bg'],
            'authority_en' => $index[0]['authority_en'],
            // 'sum' => round($request->sum, 2),
            'forwarder' => $request->forwarder,
            'forwarder_address' => $request->forwarder_address,
            'date_add' => date('d.m.Y', time()),
            'added_by' => Auth::user()->id,
        ];

        if ($request->packer_data == 999) {
            $data_packer = [
                'packer_name' => $packer_name,
                'packer_address' => $packer_address,
            ];
            Packer::create($data_packer);
        }

        QCertificate::create($data);

        $last_id = QCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();
        
        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-внос/'.$last_id[0]['id'] .'/завърши');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $type = 1;
        $index = $this->index;
        $certificate = QCertificate::findOrFail($id);
        $packers = Packer::select('id', 'packer_name', 'packer_address')->get()->toArray();
        $importers = Importer::select(['id', 'name_bg', 'name_en', 'address_en', 'vin', 'trade'])
            ->where('is_active', '=', 1)
            ->where('trade', '=', 0)
            ->orWhere('trade', '=', 2)
            ->get()->toArray();

        $countries = Country::select('id', 'name', 'name_en', 'EC')->where('EC', '=', 1)->orderBy('name', 'asc')->get()->toArray();
        $lock = $certificate->is_lock;

        return view('quality.certificates.import.import_edit_certificate', compact('type', 'certificate', 'importers', 'index', 'countries', 'lock', 'packers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|QCertificatesRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(QCertificatesRequest $request, $id)
    {
        $certificate = QCertificate::findOrFail($id);
        $data = [
            'type_crops' => $request->type_crops,
            'importer_id' => $request->importer_data,
            'importer_name' => $request->en_name,
            'importer_address' => $request->en_address,
            'importer_vin' => $request->vin_hidden,
            'packer_id' => $request->packer_data,
            'packer_name' => $request->name_of_packer,
            'packer_address' => $request->address_of_packer,
            'from_country' => $request->from_country,
            'id_country' => $request->id_country,
            'for_country_bg' => $request->for_country_bg,
            'for_country_en' => $request->for_country_en,
            'observations' => $request->observations,
            'transport' => $request->transport,
            'customs_bg' => $request->customs_bg,
            'customs_en' => $request->customs_en,
            'place_bg' => $request->place_bg,
            'place_en' => $request->place_en,
            'valid_until' => $request->valid_until,
            'forwarder' => $request->forwarder,
            'forwarder_address' => $request->forwarder_address,
            'date_update' => date('d.m.Y', time()),
            'updated_by' => Auth::user()->id,
        ];

        $certificate->fill($data);
        $certificate->save();

        // Промяна на Фирмата във ФАКТУРИТЕ
        $data_firm = [
            'importer_id' => $request->importer_data,
            'importer_name' => $request->en_name,
            'sum' => round($request->sum, 2),
            'date_update' => date('d.m.Y', time()),
            'updated_at' => Auth::user()->id,
        ];
        Invoice::where('certificate_id', $id)
            ->where('invoice_for', 1)
            ->where('certificate_number', $certificate->import)
            ->update($data_firm);

         // Промяна на Фирмата във СТОКИТЕ
         $stock_firm = [
            'firm_id' => $request->importer_data,
            'firm_name' => $request->en_name,
            'type_crops' => $request->type_crops,
            'date_update' => date('d.m.Y', time()),
            'updated_by' => Auth::user()->id,
        ];
        Stock::where('certificate_id', $id)->update($stock_firm);

        Session::flash('message', 'Сертификата е редактиран успешно!');
        return Redirect::to('/контрол/сертификат-внос/'.$id);
    }

    public function import_ending($id)
    {
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
        
        return view('quality.certificates.import.stock_import', compact('id', 'crops', 'certificate', 'stocks'));
       
    }

    public function import_finish(Request $request)
    {
        $certificate = QCertificate::findOrFail($request->certificate_id);
        $data = [
            'is_all' => 1,
        ];
        $certificate->fill($data);
        $certificate->save();
        
        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-внос/'.$request->certificate_id);
    }
    /** ВНОС КРАЙ//////////////// */

    /**
     * ПОКАЗВА СЕРТИФИКАТА
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $certificate = QCertificate::findOrFail($id);
        $stocks = $certificate->stocks->toArray();
        $firm = Importer::findOrFail($certificate->importer_id);
        $invoice = $certificate->invoice->toArray();

        $total_weight = 0;
        foreach ($stocks as $key => $value){
            $total_weight += array_sum((array)$value['weight']);
        }

        if($total_weight <= 20000) {
            $sum_import = 50;
            $sum_type = 25;
        }
        elseif($total_weight > 20000 && $total_weight <= 21000) {
            $sum_import = 51;
            $sum_type = 25.5;
        }
        elseif($total_weight > 21000 && $total_weight <= 22000) {
            $sum_import = 52;
            $sum_type = 26;
        }
        elseif($total_weight > 22000 && $total_weight <= 23000) {
            $sum_import = 53;
            $sum_type = 26.5;
        }
        elseif($total_weight > 23000 && $total_weight <= 24000) {
            $sum_import = 54;
            $sum_type = 27;
        }
        elseif($total_weight > 24000 && $total_weight <= 25000) {
            $sum_import = 55;
            $sum_type = 27.5;
        }
        elseif($total_weight > 25000 && $total_weight <= 26000) {
            $sum_import = 56;
            $sum_type = 28;
        }
        elseif($total_weight > 26000 && $total_weight <= 27000) {
            $sum_import = 57;
            $sum_type = 28.5;
        }
        elseif($total_weight > 27000 && $total_weight <= 28000) {
            $sum_import = 58;
            $sum_type = 29;
        }
        elseif($total_weight > 28000 && $total_weight <= 29000) {
            $sum_import = 59;
            $sum_type = 29.5;
        }
        elseif($total_weight > 29000 && $total_weight <= 30000) {
            $sum_import = 60;
            $sum_type = 30;
        }
        else {
            $sum_import = 0;
            $sum_type = 0;
        }

        if ($certificate->date_issue >= 17356896) {
            return view('quality.certificates.import.show_next', compact('certificate', 'stocks', 'firm', 'invoice', 'total_weight', 'sum_import', 'sum_type'));
        } else {
            return view('quality.certificates.import.show', compact('certificate', 'stocks', 'firm', 'invoice', 'total_weight', 'sum_import', 'sum_type'));
        }


    }

    /**
     * Избор на сертификат.
     *
     * @return Response
     */
    public function choose()
    {
        return view('quality.certificates.choose');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|QCertificatesRequest $request
     * @param  int $id
     * @return Response
     */
    public function import_lock(Request $request, $id)
    {
        $this->validate($request,
            ['is_sum' => 'required|numeric|min:1'],
            [
                'is_sum.required' => 'Преди да заключиш добави сумата!',
                'is_sum.numeric' => 'За сумата на Фактура използвай ТОЧКА или само цифри! ',
                'is_sum.min' => 'Преди да заключиш добави сумата!',
            ]);
        $this->validate($request,
            ['is_invoice' => 'required|not_in:0'],
            [
                'is_invoice.required' => 'Преди да заключиш добави номера и датата на фактурата!',
                'is_invoice.not_in' => 'Преди да заключиш добави номера и датата на фактурата!',
            ]);


        $certificate = QCertificate::findOrFail($id);
        $data = [
            'is_lock' => 1,
        ];
        $certificate->fill($data);
        $certificate->save();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|QCertificatesRequest $request
     * @param  int $id
     * @return Response
     */
    public function import_unlock(Request $request, $id)
    {
        $certificate = QCertificate::findOrFail($id);
        $data = [
            'is_lock' => 0,
        ];
        $certificate->fill($data);
        $certificate->save();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|QCertificatesRequest $request
     * @param  int $id
     * @return Response
     */
    public function import_add_sum(Request $request, $id)
    {
        $this->validate($request,
            ['sum' => 'required|numeric|min:1'],
            [
                'sum.required' => 'Преди да заключиш добави сумата!',
                'sum.numeric' => 'За сумата на Фактура използвай ТОЧКА или само цифри! ',
                'sum.min' => 'Преди да заключиш добави сумата!',
            ]);
        if($request->percent == 0){
            $final_sum =  $request->sum;
        }
        elseif($request->percent == 1){
            $final_sum = $request->sum + ($request->sum*42)/100;
        }
        elseif($request->percent == 2){
            $final_sum = $request->sum + ($request->sum*84)/100;
        }
        else{
            if($request->type == 1){
                $final_sum = 50;
            }
            elseif($request->type == 2){
                $final_sum = 25;
            }
            else {
                $final_sum = 50;
            }
        }
       
        $certificate = QCertificate::findOrFail($id);
        $data = [
            'base_sum' => $request->sum,
            'sum' => $final_sum,
            'percent' => $request->percent,
        ];

        $data_invoice = [
            'sum' => $final_sum,
        ];

        Invoice::where('certificate_id', $certificate->id)->where('certificate_number',$certificate->import)->update($data_invoice);

        $certificate->fill($data);
        $certificate->save();
        return redirect()->back()->withInput($request->all());
    }

    /** ЗА РЕДАКЦИЯ НА СУМИТЕ
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function my_edit_sum($id)
    {
        $certificate = QCertificate::findOrFail($id);
        $stocks = $certificate->stocks->toArray();
        
        $total_weight = 0;
        foreach ($stocks as $key => $value){
            $total_weight += array_sum((array)$value['weight']);
        }

        if($total_weight <= 20000) {
            $sum_import = 50;
            $sum_type = 25;
        }
        elseif($total_weight > 20000 && $total_weight <= 21000) {
            $sum_import = 51;
            $sum_type = 25.5;
        }
        elseif($total_weight > 21000 && $total_weight <= 22000) {
            $sum_import = 52;
            $sum_type = 26;
        }
        elseif($total_weight > 22000 && $total_weight <= 23000) {
            $sum_import = 53;
            $sum_type = 26.5;
        }
        elseif($total_weight > 23000 && $total_weight <= 24000) {
            $sum_import = 54;
            $sum_type = 27;
        }
        elseif($total_weight > 24000 && $total_weight <= 25000) {
            $sum_import = 55;
            $sum_type = 27.5;
        }
        elseif($total_weight > 25000 && $total_weight <= 26000) {
            $sum_import = 56;
            $sum_type = 28;
        }
        elseif($total_weight > 26000 && $total_weight <= 27000) {
            $sum_import = 57;
            $sum_type = 28.5;
        }
        elseif($total_weight > 27000 && $total_weight <= 28000) {
            $sum_import = 58;
            $sum_type = 29;
        }
        elseif($total_weight > 28000 && $total_weight <= 29000) {
            $sum_import = 59;
            $sum_type = 29.5;
        }
        elseif($total_weight > 29000 && $total_weight <= 30000) {
            $sum_import = 60;
            $sum_type = 30;
        }
        else {
            $sum_import = 0;
            $sum_type = 0;
        }

        return view('quality.certificates.sum.index', compact('certificate', 'stocks', 'total_weight', 'sum_import', 'sum_type'));
    }

    /** ЗА РЕДАКЦИЯ НА СУМИТЕ
     * Update the specified resource in storage.
     *
     * @param Request|QCertificatesRequest $request
     * @param  int $id
     * @return Response
     */
    public function my_update_sum(Request $request, $id)
    {
        $this->validate($request,
            [
                'sum' => 'required|numeric|min:1',
                'percent' => 'required',
            ],
            [
                'sum.required' => 'Преди да заключиш добави сумата!',
                'sum.numeric' => 'За сумата на Фактура използвай ТОЧКА или само цифри! ',
                'sum.min' => 'Преди да заключиш добави сумата!',
                'percent.required' => 'Избери процента!!',
            ]);
       
        $certificate = QCertificate::findOrFail($id);
        $data = [
            'base_sum' => $request->sum,
            'percent' => $request->percent,
        ];
        $certificate->fill($data);
        $certificate->save();
        return redirect()->back()->withInput($request->all());
    }


}
