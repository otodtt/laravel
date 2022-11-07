<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;
use odbh\Http\Requests\QINCertificateRequest;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\QINCertificate;
use odbh\Set;
use odbh\User;
use odbh\Importer;
use Auth;
use Redirect;
use Session;
use DB;
use Input;
use odbh\Country;
use odbh\Packer;
use odbh\Crop;

class QINCertificatesController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $firms = Importer::where('is_active', '=', 1)->where('trade', '=', 1)->orWhere('trade', '=', 2)->lists('name_en', 'id')->toArray();

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

        $certs = QINCertificate::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));

        $certificates = QINCertificate::where('date_issue','>=',$time_start)->where('date_issue','<=',$time_end)->orderBy('is_all', 'asc')->orderBy('id', 'desc')->get();
        
        return view('quality.certificates.domestic.index', compact('certificates', 'years', 'year_now', 'inspectors', 'firms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 3;
        $index = $this->index;

        $importers = Importer::select(['id', 'name_bg', 'name_en', 'address_en', 'vin', 'trade'])
            ->where('is_active', '=', 1)
            ->where('trade', '=', 1)
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

        $last_internal = QINCertificate::select('internal')->orderBy('internal', 'desc')->limit(1)->get()->toArray();

        $id = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $id)->get()->toArray();

        if(!empty($last_internal)) {
            $last_number = $last_internal;
        } else {
            $last_number[0]['internal'] = '2001';
        }

        return view('quality.certificates.domestic.domestic_create_certificate',
            compact('index', 'importers', 'countries', 'crops', 'user', 'last_number', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QINCertificateRequest $request)
    {
        // dd($request->all());
        $index = $this->index;
        $user = User::select('id', 'all_name', 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', Auth::user()->id)->get()->toArray();

        $last_internal = QINCertificate::select('internal')->orderBy('internal', 'desc')->limit(1)->get()->toArray();

        if(!empty($last_internal)) {
            $internal = $last_internal[0]['internal'] + 1;
        } else {
            $internal = '3001';
        }

        $date_now = time();
        $convert_date = date('d.m.Y', $date_now);
        $final_date = strtotime($convert_date);
        
        $data = [
            'internal' => $internal,
            'what_7' => 1,
            'type_crops' => $request->type_crops,
            'importer_id' => 0,
            'importer_name' => $request->importer_name,
            'importer_address' => $request->importer_address,
            'importer_vin' => $request->importer_vin,
            'packer_name' => $request->packer_name,
            'packer_address' => $request->packer_address,
            'packer_vin' => $request->packer_vin,
            'from_country' => $request->from_country,
            'id_country' => $request->id_country,
            'for_country_bg' => $request->for_country_bg,
            'for_country_en' => $request->for_country_en,
            'observations' => $request->observations,
            'place_bg' => $request->place_bg,
            'date_issue' => $final_date,
            'valid_until' => $request->valid_until,
            'inspector_bg' => $user[0]['all_name'],
            'inspector_en' => $user[0]['all_name_en'],
            'stamp_number' => $index[0]['q_index'].'-'.$user[0]['stamp_number'],
            'authority_bg' => $index[0]['authority_bg'],
            'authority_en' => $index[0]['authority_en'],
            'date_add' => date('d.m.Y', time()),
            'added_by' => Auth::user()->id,
        ];
        dd($data);

        // if ($request->packer_data == 999) {
        //     $data_packer = [
        //         'packer_name' => $packer_name,
        //         'packer_address' => $packer_address,
        //     ];
        //     Packer::create($data_packer);
        // }

        QINCertificate::create($data);

        $last_id = QINCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-вътрешен/'.$last_id[0]['id'] .'/завърши');
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
        // echo ('OK');
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
