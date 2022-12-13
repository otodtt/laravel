<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;
use odbh\Farmer;
use odbh\Http\Requests\QINNewCertificateRequest;
use odbh\Http\Requests\QINNewTraderCertificateRequest;
use odbh\Http\Requests\QINCertificateRequest;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Http\Requests\QINUpdateCertificateRequest;
use odbh\Invoice;
use odbh\Location;
use odbh\QINCertificate;
use odbh\Set;
use odbh\StockInternal;
use odbh\Trader;
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
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'choose',
            'create_farmer', 'store_farmer', 'create_firm', 'store_firm', 'create_trader',
            'store_trader', 'create_exist', 'store_exist', 'internal_ending', 'domestic_finish'
        ]]);


        $this->index = Set::select('q_index', 'authority_bg', 'authority_en')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
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
        $firms = Trader::where('id', '>', 0)->lists('trader_name', 'id')->toArray();

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
            $certificates = QINCertificate::where('internal','=',$request['search_value'])->get();
        };
        if((int)$request['search'] == 2){
            $this->validate($request,
                ['search_value' => 'required|digits_between:3,10'],
                [
                    'search_value.required' => 'Попълни номера на фактурата!',
                    'search_value.digits_between' => 'Номера трябва да е между 3 и 10 цифри!',
                ]);
            $certificates = QINCertificate::where('invoice_number','=',$request['search_value'])->get();
        };

        
        return view('quality.certificates.domestic.index', compact('certificates', 'years', 'year_now', 'inspectors', 'firms'));
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
        $firms = Trader::where('id', '>', 0)->lists('trader_name', 'id')->toArray();

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

        $certs = QINCertificate::get();
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
        if (isset($sort_firm) && $sort_firm != 0) {

            if($sort_firm < 9999){
                $firm_sql = ' AND trader_id='.$sort_firm;
            }
            if($sort_firm == 9999){
                $firm_sql = ' AND farmer_id >0';
            }
            if($sort_firm == 8888){
                $firm_sql = ' AND trader_id >0';
            }
        }
        else{
            $firm_sql = ' ';
        }

        $certificates = DB::select("SELECT * FROM qincertificates WHERE internal >0 $years_sql $inspector_sql $firm_sql ORDER BY id DESC");

        return view('quality.certificates.domestic.index', compact('certificates', 'firms', 'inspectors', 'years',
            'years_start_sort', 'years_end_sort', 'sort_inspector', 'sort_firm', 'year_now'));
    }


    ///////////////////////////////////////
    ///////////////////////////////////////
    /**
     * СЪЩЕСТВУВАЩ ЗС
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $type = 3;
        $index = $this->index;

        $farmer = Farmer::findOrFail($id);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

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

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();

        if(!empty($last_internal)) {
            $last_number = $last_internal;
        } else {
            $last_number[0]['internal'] = '3001';
        }

        return view('quality.certificates.domestic.domestic_create_certificate', compact('farmer', 'index',
                    'countries', 'crops', 'user', 'last_number', 'type', 'regions', 'districts_farm', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|QINCertificateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store_old(QINCertificateRequest $request)
    {
        $region = '';
        $dist = '';
        $farmer_id = $request->farmer_id;
        $farmer = Farmer::findOrFail($farmer_id);

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

        if($farmer->tvm == 1){
            $tvm = 'гр. ';
        }
        elseif($farmer->tvm == 2 ){
            $tvm = 'с. ';
        }
        else{
            $tvm = 'гр./с. ';
        }
        $regions = $this->areas_all_list;
        foreach ($regions as $k=>$items) {
            if ($k == $farmer->areas_id) {
                $region = $items;
            }
        }

        /** Генерира списък с общините */
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id');

        foreach ($districts as $k=>$items) {
            if ($k == $farmer->district_id) {
                $dist = $items;
            }
        }

        $address =$farmer->address.', '.$tvm.''.$farmer->location.', общ. '.$dist.', обл. '.$region;
        $data = [
            'internal' => $internal,
            'what_7' => 1,
            'type_crops' => $request->type_crops,
            'farmer_id' => $farmer->id,
            'type_firm' => $farmer->type_firm,
            'trader_id' => 0,
            'trader_name' => $farmer->name,
            'trader_address' => $address,
            'trader_vin' => $farmer->pin,
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

        QINCertificate::create($data);

        $last_id = QINCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-вътрешен/'.$last_id[0]['id'] .'/завърши');
    }

    /**
     * НОВ ЗС
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create_farmer(Request $request)
    {
        $firm = $request['firm'];
        $name = $request['name'];
        $pin = $request['pin'];
        $gender = $request['gender'];

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
            $last_number[0]['internal'] = '3001';
        }
        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';
        $districts_farm = array_sort_recursive($districts_farm);

        $selected_array = Set::select('area_id')->get()->toArray();
        $selected_session = $selected_array[0]['area_id'];
        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$selected_session)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $selected_array[0]['area_id'];
        }
        $regions = $this->areas_all_list;
        //// Списъка с общините
        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);
        //// Списъка с населените места
        $get_district = Session::get('_old_input', 'localsID');
        if(!isset($get_district['localsID']) || $get_district['localsID']==0){
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }
        else {
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('district_id', '=', $get_district['localsID'])
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';
        $districts_farm = array_sort_recursive($districts_farm);

        return view('quality.certificates.domestic.domestic_new_farmer_certificate',
            compact('index', 'importers', 'countries', 'crops', 'user', 'last_number', 'type',
                    'firm', 'name', 'pin', 'gender', 'regions', 'selected', 'district_list', 'locations', 'districts_farm' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|QINNewCertificateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store_farmer(QINNewCertificateRequest $request)
    {
        $region = '';
        $dist = '';
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $pin_owner = null;
        $sex_owner = null;
        $in = null;
        $name = null;

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

        if($request->data_tmv == 1){
            $tvm = 'гр. ';
        }
        elseif($request->data_tmv == 2 ){
            $tvm = 'с. ';
        }
        else{
            $tvm = 'гр./с. ';
        }
        $regions = $this->areas_all_list;
        foreach ($regions as $k=>$items) {
            if ($k == $request->areas_id) {
                $region = $items;
            }
        }

        /** Генерира списък с общините */
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $request->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id');

        foreach ($districts as $k=>$items) {
            if ($k == $request->district_id) {
                $dist = $items;
            }
        }

        $address =$request->address.', '.$tvm.''.$request->list_name.', общ. '.$dist.', обл. '.$region;

        $data = [
            'internal' => $internal,
            'what_7' => 1,
            'type_crops' => $request->type_crops,
            //'farmer_id' => $farmer->id,
            'type_firm' => $request->firm,
            'trader_id' => 0,
            'trader_name' => $request->name,
            'trader_address' => $address,
            'trader_vin' => $request->pin,
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
        QINCertificate::create($data);

        $last_id = QINCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();


        // ЗАПИС В ЗЕМ СТОПАНИН
        $cyrillic= array(0=>'', 1=>'А', 2=>'Б', 3=>'В', 4=>'Г', 5=>'Д', 6=>'Е', 7=>'Ж', 8=>'З', 9=>'И', 10=>'Й',
            11=>'К', 12=>'Л', 13=>'М', 14=>'Н', 15=>'О', 16=>'П', 17=>'Р', 18=>'С',	19=>'Т', 20=>'У',
            21=>'Ф', 22=>'Х', 23=>'Ц', 24=>'Ч', 25=>'Ш', 26=>'Щ', 27=>'Ъ',	28=>'Ь', 29=>'Ю', 30=>'Я');

        if($request['firm'] == 1){
            $sex = null;
            if(strlen($request['gender']) == 4){
                $sex = 1;
            }
            if(strlen($request['gender']) == 6){
                $sex = 2;
            }

            $pin = $request['pin'];
            $eik = '';
            $egn_eik = 1;
            $owner = '';
            $pin_owner = '';
            $sex_owner = 0;
            $name = $request['name'];
        }
        if($request['firm'] > 1){
            $sex_owner = null;
            if(strlen($request['gender_owner']) == 4){
                $sex_owner = 1;
            }
            if(strlen($request['gender_owner']) == 6){
                $sex_owner = 2;
            }
            if(strlen($request['gender_owner']) == 1){
                $sex_owner = 0;
            }

            $sex = 0;
            $pin = $request['bulstat'];
            $eik = $request['bulstat'];
            $egn_eik = 2;
            $owner = $request['owner'];
            $pin_owner = $request['pin_owner'];
            $name = $request['name_firm'];
        }

        $abc= trim(preg_replace("/[0-9]/", "", $name));
        $abc1= trim(preg_replace("/-/", "", $abc));
        $abc2= trim(preg_replace("/.]/", "", $abc1));
        $abc3 = mb_substr($abc2, 0, 1);
        foreach ($cyrillic as $k=>$v){
            if(preg_match("/$abc3/iu", "$v")){
                $in=$k;
            }
        }

        $data_farmer = ([
            'type_firm'=>$request['firm'],
            'name'=>$name,
            'sex'=>$sex,
            'pin'=>$pin,
            'bulstat'=>$eik,

            'areas_id'=>$request['areasID'],
            'district_id'=>$request['district_id'],
            'tvm'=>$request['data_tmv'],
            'city_id'=>$request['data_id'],
            'location'=>$request['list_name'],
            'address'=>$request['address'],

            'owner'=>$owner,
            'pin_owner'=>$pin_owner,
            'sex_owner'=>$sex_owner,

            'district_object'=>$request['district_object'],
            'location_farm'=>$request['location_farm'],

            'phone'=>$request['phone'],
            'mobil'=>$request['mobil'],
            'email'=>$request['email'],

            'date_add'=>time(),
            'added_by'=> Auth::user()->id,

            'alphabet'=>$in,
        ]);

        $farmer = Farmer::create($data_farmer);
        $insertedId = $farmer->id;

        $certificate = QINCertificate::findOrFail($last_id[0]['id']);
        $data_add_farmer = [
            'farmer_id' => $insertedId,
        ];
        $certificate->fill($data_add_farmer);
        $certificate->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-вътрешен/'.$last_id[0]['id'] .'/завърши');
    }

    /**
     * НОВА ФИРМА ЗС
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create_firm(Request $request)
    {
        $firm = $request['firm'];
        $name = $request['name'];
        $name_firm = $request['name_firm'];
        $pin = $request['pin'];
        $gender = $request['gender'];
        $eik = $request['eik'];

        $type = 3;
        $index = $this->index;

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
            $last_number[0]['internal'] = '3001';
        }
        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';
        $districts_farm = array_sort_recursive($districts_farm);

        $selected_array = Set::select('area_id')->get()->toArray();
        $selected_session = $selected_array[0]['area_id'];
        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$selected_session)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $selected_array[0]['area_id'];
        }
        $regions = $this->areas_all_list;
        //// Списъка с общините
        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);
        //// Списъка с населените места
        $get_district = Session::get('_old_input', 'localsID');
        if(!isset($get_district['localsID']) || $get_district['localsID']==0){
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }
        else {
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('district_id', '=', $get_district['localsID'])
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';
        $districts_farm = array_sort_recursive($districts_farm);

        return view('quality.certificates.domestic.domestic_new_firm_certificate',
            compact('index',  'countries', 'crops', 'user', 'last_number', 'type', 'eik', 'name_firm',
                'firm', 'name', 'pin', 'gender', 'regions', 'selected', 'district_list', 'locations', 'districts_farm' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|QINNewCertificateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store_firm(QINNewCertificateRequest $request)
    {
        $region = '';
        $dist = '';
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $pin_owner = null;
        $sex_owner = null;
        $in = null;
        $name = null;

        // ЗАПИС В ЗЕМ СТОПАНИН
        $cyrillic= array(0=>'', 1=>'А', 2=>'Б', 3=>'В', 4=>'Г', 5=>'Д', 6=>'Е', 7=>'Ж', 8=>'З', 9=>'И', 10=>'Й',
            11=>'К', 12=>'Л', 13=>'М', 14=>'Н', 15=>'О', 16=>'П', 17=>'Р', 18=>'С',	19=>'Т', 20=>'У',
            21=>'Ф', 22=>'Х', 23=>'Ц', 24=>'Ч', 25=>'Ш', 26=>'Щ', 27=>'Ъ',	28=>'Ь', 29=>'Ю', 30=>'Я');

        if($request['firm'] == 1){
            $sex = null;
            if(strlen($request['gender']) == 4){
                $sex = 1;
            }
            if(strlen($request['gender']) == 6){
                $sex = 2;
            }

            $pin = $request['pin'];
            $eik = '';
            $egn_eik = 1;
            $owner = '';
            $pin_owner = '';
            $sex_owner = 0;
            $name = $request['name'];
        }
        if($request['firm'] > 1){
            $sex_owner = null;
            if(strlen($request['gender_owner']) == 4){
                $sex_owner = 1;
            }
            if(strlen($request['gender_owner']) == 6){
                $sex_owner = 2;
            }
            if(strlen($request['gender_owner']) == 1){
                $sex_owner = 0;
            }

            $sex = 0;
            $pin = $request['bulstat'];
            $eik = $request['bulstat'];
            $egn_eik = 2;
            $owner = $request['owner'];
            $pin_owner = $request['pin_owner'];
            $name = $request['name_firm'];
        }

        $abc= trim(preg_replace("/[0-9]/", "", $name));
        $abc1= trim(preg_replace("/-/", "", $abc));
        $abc2= trim(preg_replace("/.]/", "", $abc1));
        $abc3 = mb_substr($abc2, 0, 1);
        foreach ($cyrillic as $k=>$v){
            if(preg_match("/$abc3/iu", "$v")){
                $in=$k;
            }
        }

        $data_farmer = ([
            'type_firm'=>$request['firm'],
            'name'=>$name,
            'sex'=>$sex,
            'pin'=>$pin,
            'bulstat'=>$eik,

            'areas_id'=>$request['areasID'],
            'district_id'=>$request['district_id'],
            'tvm'=>$request['data_tmv'],
            'city_id'=>$request['data_id'],
            'location'=>$request['list_name'],
            'address'=>$request['address'],

            'owner'=>$owner,
            'pin_owner'=>$pin_owner,
            'sex_owner'=>$sex_owner,

            'district_object'=>$request['district_object'],
            'location_farm'=>$request['location_farm'],

            'phone'=>$request['phone'],
            'mobil'=>$request['mobil'],
            'email'=>$request['email'],

            'date_add'=>time(),
            'added_by'=> Auth::user()->id,

            'alphabet'=>$in,
        ]);

        $farmer = Farmer::create($data_farmer);
        $insertedId = $farmer->id;

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

        if($request->data_tmv == 1){
            $tvm = 'гр. ';
        }
        elseif($request->data_tmv == 2 ){
            $tvm = 'с. ';
        }
        else{
            $tvm = 'гр./с. ';
        }
        $regions = $this->areas_all_list;
        foreach ($regions as $k=>$items) {
            if ($k == $request->areas_id) {
                $region = $items;
            }
        }

        /** Генерира списък с общините */
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $request->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id');

        foreach ($districts as $k=>$items) {
            if ($k == $request->district_id) {
                $dist = $items;
            }
        }

        $address =$request->address.', '.$tvm.''.$request->list_name.', общ. '.$dist.', обл. '.$region;

        $data = [
            'internal' => $internal,
            'what_7' => 1,
            'type_crops' => $request->type_crops,
            'farmer_id' => $insertedId,
            'type_firm' => $request->firm,
            'trader_id' => 0,
            'trader_name' => $request->name_firm,
            'trader_address' => $address,
            'trader_vin' => $request->bulstat,
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

        QINCertificate::create($data);

        $last_id = QINCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-вътрешен/'.$last_id[0]['id'] .'/завърши');
    }

    ///////////////////////////////////////
    ///////////////////////////////////////
    /**
     * НОВА ФИРМА ТЪРГОВЕЦ
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create_trader(Request $request)
    {
        $type_firm = $request['firm'];
        $trader_name = $request['name_firm'];
        $trader_vin = $request['eik'];

        $type = 3;
        $index = $this->index;

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
            $last_number[0]['internal'] = '3001';
        }
        return view('quality.certificates.domestic.domestic_create_trader_certificate',
            compact('index', 'countries', 'crops', 'user', 'last_number', 'type', 'type_firm',
                    'trader_name', 'trader_vin' ));
    }

    public function store_trader(QINNewTraderCertificateRequest $request)
    {
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
            'farmer_id' => 0,
            'type_firm' => 0,
            'trader_name' => $request->trader_name,
            'trader_address' => $request->trader_address,
            'trader_vin' =>  $request->trader_vin,
            'packer_name_one' => $request->packer_name_one,
            'packer_name_two' => $request->packer_name_two,
            'packer_name_three' =>  $request->packer_name_three,
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

        QINCertificate::create($data);

        $last_id = QINCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();

        $data_trader = [
            'trader_name'=> $request->trader_name,
            'trader_address'=> $request->trader_address,
            'trader_vin'=> $request->trader_vin,
            'created_by'=> Auth::user()->id,
            'date_create' => date('d.m.Y H:i:s', time()) ,
        ];

        $trader = Trader::create($data_trader);
        $insertedId = $trader->id;

        $certificate = QINCertificate::findOrFail($last_id[0]['id']);
        $data_add_trader = [
            'trader_id' => $insertedId,
        ];
        $certificate->fill($data_add_trader);
        $certificate->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-вътрешен/'.$last_id[0]['id'] .'/завърши');
    }

    ///////////////////////////////////////
    ///////////////////////////////////////
    /**
     * СЪЩЕСТВУВАЩА ФИРМА ТЪРГОВЕЦ
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create_exist(Request $request, $id)
    {
        $trader = Trader::findOrFail($id);

        $type = 3;
        $index = $this->index;

        $countries= Country::select('id', 'name', 'name_en', 'EC')->where('EC', '=', 1)->orderBy('name', 'asc')->get()->toArray();

        $crops= Crop::select('id', 'name', 'name_en', 'group_id')
            ->where('group_id', '=', 4)
            ->orWhere('group_id', '=', 5)
            ->orWhere('group_id', '=', 6)
            ->orWhere('group_id', '=', 7)
            ->orWhere('group_id', '=', 8)
            ->orWhere('group_id', '=', 9)
            ->orWhere('group_id', '=', 10)
            ->orderBy('group_id', 'asc')->get()->toArray();

        $last_internal = QINCertificate::select('internal')->orderBy('internal', 'desc')->limit(1)->get()->toArray();

        $id = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $id)->get()->toArray();

        if(!empty($last_internal)) {
            $last_number = $last_internal;
        } else {
            $last_number[0]['internal'] = '3001';
        }

        return view('quality.certificates.domestic.domestic_exist_trader_certificate',
            compact('index', 'trader', 'countries', 'crops', 'user', 'last_number', 'type' ));
    }

    public function store_exist(QINNewTraderCertificateRequest $request)
    {
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

        $trader = Trader::findOrFail($request->trader_id);

        $data = [
            'internal' => $internal,
            'what_7' => 1,
            'type_crops' => $request->type_crops,
            'farmer_id' => 0,
            'type_firm' => 0,
            'trader_id' => $trader->id,
            'trader_name' => $trader->trader_name,
            'trader_address' => $trader->trader_address,
            'trader_vin' =>  $trader->trader_vin,
            'packer_name_one' => $request->packer_name_one,
            'packer_name_two' => $request->packer_name_two,
            'packer_name_three' =>  $request->packer_name_three,
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

        QINCertificate::create($data);

        $last_id = QINCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-вътрешен/'.$last_id[0]['id'] .'/завърши');
    }

    public function internal_ending($id)
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

        $certificate = QINCertificate::findOrFail($id);
        $stocks = $certificate->internal_stocks->toArray();

        return view('quality.certificates.domestic.stock.stock_domestic', compact('id', 'crops', 'certificate', 'stocks'));

    }

    public function domestic_finish(Request $request)
    {
        $certificate = QINCertificate::findOrFail($request->certificate_id);
        $data = [
            'is_all' => 1,
        ];
        $certificate->fill($data);
        $certificate->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификати-вътрешен/'.$request->certificate_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificate = QINCertificate::findOrFail($id);
        $stocks = $certificate->internal_stocks;
        $type_firm = $certificate->type_firm;
        if($certificate->farmer_id > 0 &&$certificate->trader_id == 0){
            $firm = Farmer::findOrFail($certificate->farmer_id);
        }
        elseif($certificate->farmer_id == 0 &&$certificate->trader_id > 0) {
            $firm = Trader::findOrFail($certificate->trader_id);
        }
        
        $invoice = $certificate->internal_invoice->toArray();

        return view('quality.certificates.domestic.show.show', compact('certificate', 'stocks', 'firm', 'invoice', 'type_firm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 0;
        $index = $this->index;
        $certificate = QINCertificate::findOrFail($id);
        $packers = Packer::select('id', 'packer_name', 'packer_address')->get()->toArray();
        $importers = Trader::select(['id', 'trader_name', 'trader_address', 'trader_vin'])->get()->toArray();

        $countries = Country::select('id', 'name', 'name_en', 'EC')->where('EC', '=', 1)->orderBy('name', 'asc')->get()->toArray();
        $lock = $certificate->is_lock;

        return view('quality.certificates.domestic.edit.domestic_edit_certificate', compact('type', 'certificate', 'importers', 'index', 'countries', 'lock', 'packers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|QINUpdateCertificateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QINUpdateCertificateRequest $request, $id)
    {
        $certificate = QINCertificate::findOrFail($id);
        $index = $this->index;
        $user = User::select('id', 'all_name', 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', Auth::user()->id)->get()->toArray();

        if( isset($request->importer_data) && $request->importer_data > 0 ){
            $data = [
                'trader_name' => $request->name,
                'trader_address' => $request->address,
                'trader_vin' =>  $request->vin,
                'packer_name_one' => $request->packer_name_one,
                'packer_name_two' => $request->packer_name_two,
                'packer_name_three' =>  $request->packer_name_three,
                'from_country' => $request->from_country,
                'id_country' => $request->id_country,
                'for_country_bg' => $request->for_country_bg,
                'observations' => $request->observations,
                'place_bg' => $request->place_bg,
                'valid_until' => $request->valid_until,
                'date_update' => date('d.m.Y', time()),
                'updated_by' => Auth::user()->id,
            ];
        }
        else {
            $data = [
                'from_country' => $request->from_country,
                'id_country' => $request->id_country,
                'for_country_bg' => $request->for_country_bg,
                'observations' => $request->observations,
                'place_bg' => $request->place_bg,
                'valid_until' => $request->valid_until,
                'date_update' => date('d.m.Y', time()),
                'updated_by' => Auth::user()->id,
            ];
        }
        $certificate->fill($data);
        $certificate->save();

        if( isset($request->importer_data) && $request->importer_data > 0 ) {
            // Промяна на Фирмата във ФАКТУРИТЕ
            $data_firm = [
                'importer_id' => $request->importer_data,
                'importer_name' => $request->name,
                'date_update' => date('d.m.Y', time()),
                'updated_at' => Auth::user()->id,
            ];

            Invoice::where('certificate_id', $id)
                ->where('invoice_for', 3)
                ->where('certificate_number', $certificate->internal)
                ->update($data_firm);
            // Промяна на Фирмата във СТОКИТЕ
            $stock_firm = [
                'trader_id' => $request->importer_data,
                'firm_name' => $request->name,
                'date_update' => date('d.m.Y', time()),
                'updated_by' => Auth::user()->id,
            ];
            StockInternal::where('certificate_id', $id)->update($stock_firm);
        }


        Session::flash('message', 'Сертификата е редактиран успешно!');
        return Redirect::to('/контрол/сертификати-вътрешен/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo ('OK');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|QCertificatesRequest $request
     * @param  int $id
     * @return Response
     */
    public function domestic_lock(Request $request, $id)
    {
        $certificate = QINCertificate::findOrFail($id);
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
    public function domestic_unlock(Request $request, $id)
    {
        $certificate = QINCertificate::findOrFail($id);
        $data = [
            'is_lock' => 0,
        ];
        $certificate->fill($data);
        $certificate->save();
        return back();
    }

    /**
     * Търси в Земеделските производители.
     *
     * @param  \Illuminate\Http\Request $request $request
     * @return \Illuminate\Http\Response
     */
    public function farmer_request(Request $request)
    {
        if ((int)$request['search_hidden'] == 1) {
            if (isset($request['firm_search'])) {
                if ($request['firm_search'] == 1) {
                    $this->validate($request, [
                        'name_farmer' => 'required|min:3|max:150|only_cyrillic',
                        'gender_farmer' => 'required',
                        'pin_farmer' => 'required|pin_farmer|digits_between:9,10',
                    ]);
                }
                if ($request['firm_search'] > 1) {
                    $this->validate($request, [
                        'firm_name_search'=> 'required|min:3|max:150|cyrillic_names',
                        'eik_search'=> 'required|is_valid',
                    ]);
                }
            } else {
                $this->validate($request, ['firm_search' => 'required']);
            }
        }

        $firm = $request['firm_search'];
        $name = $request['name_farmer'];
        $name_firm = $request['firm_name_search'];
        $eik = $request['eik_search'];
        $gender = $request['gender_farmer'];
        $pin = $request['pin_farmer'];

        $trader = Trader::select()->where('trader_vin','=',$eik)->get()->toArray();

        $farmers = null;
        if(isset($request['firm_search']) && $request['firm_search'] == 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->get();
        }
        if(isset($request['firm_search']) && $request['firm_search'] > 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->orWhere('bulstat','=',$eik)->get();
        }

        return view('quality.certificates.domestic.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers', 'trader'));
    }

    /**
     * Json Търси ЗП по ЕГН
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_pin(){
        $date = null;
        $return_farmer = array();
        $pin = filter_input(INPUT_POST, 'val1');

        if(strlen($pin)>6 || strlen($pin)<=10){
            $all_pin = trim($pin);
            $date = mb_substr($all_pin, 0, 6);
        }
        elseif(strlen($pin)==6){
            $date = $pin;
        }
        $farmers = Farmer::select('name', 'pin', 'id')->where('pin', 'like', '%' .$date. '%')->get();

        if(count($farmers)>0){
            foreach($farmers as $farmer) {
                $return_farmer[] = "
                <ul>
                    <li>
                        <div style='width: 40%; display: inline-block'><span class='bold' style='font-size: 1em;'>$farmer->name с ЕГН: $farmer->pin</span></div>
                        <div style='width: 50%; display: inline-block'><span><a href='/контрол/сертификати-вътрешен/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ВЪТРЕШЕН СЕРТИФИКАТ ЗА ТОЗИ ЗС!</a></span></div>
                    </li>
                    <hr/>
                </ul>";
            }
        }
        else{
            $return_farmer[] = "<span class='bold red' style='font-size: 1em;'>Няма открит ЗС с това ЕГН! Провери по име.</span>";
        }
        return response()->json([ $return_farmer]);
    }

    /**
     * Json Търси ЗП по Име
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_name(){
        $date = null;
        $return_farmer = array();
        $name_input = filter_input(INPUT_POST, 'val1');
        $name = trim($name_input);

        $farmers = Farmer::select('name', 'pin', 'id')->where('name', 'like', '%' .$name. '%')->get();

        if(count($farmers)>0){
            foreach($farmers as $farmer) {
                $return_farmer[] = "
                <ul>
                    <li>
                        <div style='width: 40%; display: inline-block'><span class='bold' style='font-size: 1em;'>$farmer->name с ЕГН: $farmer->pin</span></div>
                        <div style='width: 50%; display: inline-block'><span><a href='/контрол/сертификати-вътрешен/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ВЪТРЕШЕН СЕРТИФИКАТ ЗА ТОЗИ ЗС!</a></span></div>
                    </li>
                    <hr/>
                </ul>";
            }
        }
        else{
            $return_farmer[] = "<span class='bold red' style='font-size: 1em;'>Няма открит ЗС с това Име! Провери по ЕГН.</span>";
        }
        return response()->json([ $return_farmer]);
    }

    /**
     * Json Търси Фирма по име
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_firm(){
        $date = null;
        $return_farmer = array();
        $name_input = filter_input(INPUT_POST, 'val1');
        $name = trim($name_input);

        $farmers = Farmer::select('name', 'pin', 'id')->where('name', 'like', '%' .$name. '%')->get();

        if(count($farmers)>0){
            foreach($farmers as $farmer) {
                $return_farmer[] = "
                <ul>
                    <li>
                        <div style='width: 40%; display: inline-block'>Фирма <span class='bold' style='font-size: 1em;'>$farmer->name с Булстат: $farmer->pin</span></div>
                        <div style='width: 50%; display: inline-block'><span><a href='/контрол/сертификати-вътрешен/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ВЪТРЕШЕН СЕРТИФИКАТ ЗА ТОЗИ ЗС!</a></span></div>
                    </li>
                    <hr/>
                </ul>";
            }
        }
        else{
            $return_farmer[] = "<span class='bold red' style='font-size: 1em;'>Няма открита Фирма с това име!</span>";
        }
        return response()->json([ $return_farmer]);
    }
}
