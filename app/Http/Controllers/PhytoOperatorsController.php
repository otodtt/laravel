<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use odbh\Certificate;

use odbh\Http\Requests;
use Illuminate\Validation;
use odbh\PhitoTraders;
use odbh\Set;
use odbh\User;
use Redirect;
use Input;
use odbh\Http\Requests\PhitoOperatorsRequests;
use odbh\Http\Requests\PhitoNewFarmerRequest;
use Session;
use odbh\Farmer;
use odbh\Location;
use odbh\PhitoOperator;

class PhytoOperatorsController extends Controller
{
    private $logo = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * CertificatesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('sanitary', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        $this->logo = Set::all()->toArray();

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_fsk_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        /** За Всички които са добавяли Протоколи + Активните*/
        $inspectors_active = $this->inspectors_active_fsk_list->toArray();
        $inspectors_db = Certificate::lists('short_name', 'inspector_id')->toArray();
        $this->inspectors_edit_db = $inspectors_active + $inspectors_db;

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second', 'operator_index_not', 'operator_index_bg')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = PhitoOperator::get();

        $operator_index = $this->index;

        return view('phytosanitary.index', compact('operators', 'operator_index'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search_value_return = $request['search_value'];

        $this->validate($request, ['search_value' => 'required|digits_between:1,7']);

        if($request['search_value'] != 0){
            $this->validate($request, ['search_value' => 'required|digits_between:1,7']);
            $operators = PhitoOperator::where('registration_number','=',$request['search_value'])->get();
        };

        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);
        $operator_index = $this->index;

        return view('phytosanitary.index', compact('operators', 'inspectors', 'operator_index', 'search_value_return'));
    }

    /**
     * Сортиране на Сертификатите
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $deletion_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $start_year = null, $end_year = null, $deletion_sort = null)
    {
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('deletion')) {
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $deletion_limit = Input::get('deletion');
        } else {
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $deletion_limit = $deletion_sort;
        }
        if (isset($years_start_sort) || isset($years_end_sort)) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');
            if($start > 0 && $end == false){
                $years_sql = ' AND registration_date='.$start.' OR registration_date='.$timezone_paris_start;
            }
            if($end > 0 && $start == false){
                $years_sql = ' AND registration_date='.$end.' OR registration_date='.$timezone_paris_end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                $years_sql = ' AND registration_date='.$start.' OR registration_date='.$timezone_paris_start;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)){
                $years_sql = ' AND registration_date>='.$start.' AND registration_date<='.$end.'';
            }
            if(($start > 0 && $end > 0) && ($start > $end)){
                $years_sql = ' AND registration_date>='.$end.' AND registration_date<='.$start.'';
            }
        }
        else{
            $years_sql = ' ';
        }

        if (isset($deletion_limit) && (int)$deletion_limit == 1){
            $limit_sql = ' AND deletion = 0';
        }
        elseif (isset($deletion_limit) && (int)$deletion_limit == 2){
            $limit_sql = ' AND deletion>= 1';
        }
        elseif (isset($deletion_limit) && (int)$deletion_limit == 3){
            $limit_sql = ' AND farmer_id >= 1';
        }
        elseif (isset($deletion_limit) && (int)$deletion_limit == 4){
            $limit_sql = ' AND trader_id >= 1';
        }
        elseif (isset($deletion_limit) && (int)$deletion_limit == 5){
            $limit_sql = ' AND update_date >= 1';
        }
        elseif (isset($deletion_limit) && (int)$deletion_limit == 6){
            $limit_sql = ' AND update_date  = 0';
        }
        elseif (isset($deletion_limit) && (int)$deletion_limit == 7){
            $limit_sql = ' AND farmer_id  = 0 AND trader_id  = 0';
        }
        else{
            $limit_sql = ' ';
        }

        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);
        $operator_index = $this->index;

        $operators = DB::select("SELECT * FROM operators WHERE id >0 $years_sql $limit_sql ");
//        dd($operators);
//        dd(DB::select("SELECT * FROM operators WHERE id >0 $years_sql $limit_sql "));

        return view('phytosanitary.index', compact('operators', 'years_start_sort', 'years_end_sort', 'inspectors', 'operator_index'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operator = PhitoOperator::findOrFail($id);
        $index = Set::get();

        $farmer_db = Farmer::select('id')->where('id', '=', $operator->farmer_id)->get()->toArray();

        $trader_db = PhitoTraders::where('id', '=', $operator->trader_id)->get();
//        $trader_db = DB::select("SELECT id FROM traders_phito WHERE id = $operator->trader_id ");

        $operator_index = $this->index;

        if(count($farmer_db) >= 1 ){
            $farmer = Farmer::findOrFail($operator->farmer_id);
        } else {
            $farmer = 0;
        }

        if(count($trader_db) >= 1){
            $trader = PhitoTraders::findOrFail($operator->trader_id);
        } else {
            $trader = 0;
        }

        return view('phytosanitary.show.show', compact('operator', 'farmer', 'trader', 'index', 'operator_index'));
    }

    //////////////////////////////////////
    /**
     * ДОБАВЯНЕ НА НОВ ЗС
     * Display the specified resource.
     * @param Request $request
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create_new(Request $request)
    {
        $firm = $request['firm'];
        $name = $request['name'];
        $pin = $request['pin'];
        $gender = $request['gender'];

        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';

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

        return view('phytosanitary.crud.new_farmer', compact('firm', 'name', 'pin', 'gender',
                    'regions', 'selected', 'district_list', 'locations', 'districts_farm' ));

    }

    //////////////////////////////////////
    /**
     * ДОБАВЯНЕ НА НОВ ЗС
     * Display the specified resource.
     * @param Request $request
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function firm_new(Request $request)
    {
        $firm = $request['firm'];
        $name_firm = $request['name_firm'];
        $eik = $request['eik'];
        $gender = 0;

        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';

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

        return view('phytosanitary.crud.new_firm', compact('firm', 'name_firm', 'eik', 'gender',
            'regions', 'selected', 'district_list', 'locations', 'districts_farm' ));

    }

    /**
     * ЗАПИС НА НОВИТЕ ЗС
     *
     * Store a newly created resource in storage.
     *
     * @param Request|PhitoNewFarmerRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store_new(PhitoNewFarmerRequest $request)
    {
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $pin_owner = null;
        $sex_owner = null;
        $in = null;
        $name = null;

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

        $region = '';
        $dist = '';

        if($request['data_tmv'] == 1){
            $tvm = 'гр. ';
        }
        elseif($request['data_tmv'] == 2 ){
            $tvm = 'с. ';
        }
        else{
            $tvm = 'гр./с. ';
        }
        $regions = $this->areas_all_list;
        foreach ($regions as $k=>$items) {
            if ($k == $request['areas_id']) {
                $region = $items;
            }
        }

        /** Генерира списък с общините */
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $request['areas_id'])
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id');

        foreach ($districts as $k=>$items) {
            if ($k == $request['district_id']) {
                $dist = $items;
            }
        }
        $address = $request['address'].', '.$tvm.''.$request['list_name'].', общ. '.$dist.', обл. '.$region;

        $data = [
            'farmer_id' => $insertedId,
            'type_firm' => $request['firm'],
            'pin' => $pin,
            'trader_id' => 0,
            'name_operator' => $name,
            'address_operator' => $request['address'],
            'address' => $address,
            'tvm' => $tvm,
            'city' => $request['list_name'],
            'municipality' => $dist,
            'area' => $region,
            'alphabet'=>$in,

            'date_add' => date('d.m.Y H:i', time()),
            'added_by' => Auth::user()->id,
            'is_completed' => 0
        ];

        PhitoOperator::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-оператори');
    }

    ///////////////////////////////////////
    /**
     * СЪЩЕСТВУВАЩ ЗС
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_old($id)
    {
        $index = $this->index;

        $farmer = Farmer::findOrFail($id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        ;
        $is_farmer = PhitoOperator::select('id', 'name_operator', 'farmer_id', 'pin', 'type_firm')->where('farmer_id', '=', $farmer->id)->limit(1)->get()->toArray();

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();


        return view('phytosanitary.crud.add_farmer', compact('farmer', 'index', 'user', 'districts', 'districts_farm',
            'regions', 'inspectors', 'is_farmer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|PhitoOperatorsRequests $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store_old(PhitoOperatorsRequests $request, $id)
    {
        $region = '';
        $dist = '';

        $farmer = Farmer::findOrFail($id);

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

        $address = $farmer->address.', '.$tvm.''.$farmer->location.', общ. '.$dist.', обл. '.$region;
        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }

        $data = [
            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $request->inspector_name,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $request->inspector_checked,
            'date_operator' => $request->date_operator,

            'date_add' => date('d.m.Y H:i', time()),
            'added_by' => Auth::user()->id,

            'farmer_id' => $farmer->id,
            'type_firm' => $farmer->type_firm,
            'pin' => $farmer->pin,
            'trader_id' => 0,
            'name_operator' => $farmer->name,
            'address_operator' => $farmer->address,
            'address' => $address,
            'tvm' => $tvm,
            'city' => $farmer->location,
            'municipality' => $dist,
            'area' => $region,
            'alphabet' => $farmer->alphabet,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action
        ];
        PhitoOperator::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-оператори');
    }


    //////////////////////////////////////
    /**
     * ДОБАВЯНЕ НА НОВ ТЪРГОВЕЦ
     * Display the specified resource.
     * @param Request $request
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function trader_new(Request $request)
    {
        $name_firm = $request['name_firm'];
        $eik = $request['eik'];

        $index = $this->index;

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        return view('phytosanitary.traders.crud.add_trader', compact('name_firm', 'eik', 'index', 'inspectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|PhitoOperatorsRequests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store_trader(PhitoOperatorsRequests $request)
    {

        $this->validate($request,
            ['trader_name' => 'required|min:3|max:100|cyrillic_with'],
            [
                'trader_name.required' => 'Попълни името на фирмата!',
                'trader_name.min' => 'Минимален брой символи за името - 3!',
                'trader_name.max' => 'Минимален брой символи за името - 100!',
                'trader_name.cyrillic_with' => 'За име на фирмата пиши на кирилица!',

            ]);
        $this->validate($request,
            ['trader_vin' => 'is_valid|digits_between:9,13|unique:traders_phito,trader_vin,'.$request->trader_vin],
            [
                'trader_vin.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',
                'trader_vin.digits_between' => 'Булстата е само с цифри! Минимален брой символи - 9',
                'trader_vin.unique' => 'Булстата трябва да е уникален! Намерена е фирма с този БУЛСТАТ',
            ]);
        $this->validate($request,
            ['city' => 'required|min:3|max:100|cyrillic_with'],
            [
                'city.required' => 'Попълни "Населено място гр./с."!',
                'city.min' => 'ЗА Населено място гр./с. Минимален брой символи - 3',
                'city.max' => 'ЗА Населено място гр./с. Максимален брой символи - 100',
                'city.cyrillic_with' => 'ЗА Населено място гр./с. пиши на кирилица!',
            ]);
        $this->validate($request,
            ['trader_address' => 'min:3|max:100|cyrillic_with'],
            [
                'trader_address.min' => 'За адреса на фирмата Минимален брой символи - 3!',
                'trader_address.max' => 'За адреса на фирмата Максимален брой символи - 3!',
                'trader_address.cyrillic_with' => 'ЗА адреса на фирмата пиши на кирилица!',
            ]);
        $this->validate($request,
            ['phone' => 'numeric|digits_between:5,10'],
            [
                'phone.numeric' => 'За телефон използвай само цифри!',
                'phone.digits_between' => 'За телефон използвай между 5 и 10 броя цифри',
            ]);

//        dd($request->all());
        $data_trader = [
            'trader_name' => $request->trader_name,
            'city' => $request->city,
            'trader_address' => $request->trader_address,
            'trader_vin' => $request->trader_vin,
            'phone' => $request->phone,
            'is_add' => 1,

            'date_create' => date('d.m.Y H:i', time()),
            'created_by' => Auth::user()->id,
         ];

        $trader = PhitoTraders::create($data_trader);
        $insertedId = $trader->id;

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }

        $data = [
            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $request->inspector_name,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $request->inspector_checked,
            'date_operator' => $request->date_operator,

            'date_add' => date('d.m.Y H:i', time()),
            'added_by' => Auth::user()->id,

            'farmer_id' => 0,
            'pin' => $request->trader_vin,
            'trader_id' => $insertedId,
            'name_operator' => $request->trader_name,
            'address_operator' => $request->trader_address,
            'address' => $request->city,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action
        ];
//        dd($data);
        PhitoOperator::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-оператори');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finish($id)
    {
        $index = $this->index;

        $operator = PhitoOperator::findOrFail($id);
        $farmer = Farmer::findOrFail($operator->farmer_id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();


        $is_farmer = PhitoOperator::select('id', 'name_operator', 'farmer_id', 'pin', 'type_firm')->where('farmer_id', '=', $farmer->id)->limit(1)->get()->toArray();
        $is_trader = PhitoOperator::select('id', 'name_operator', 'farmer_id', 'pin', 'type_firm')->where('farmer_id', '=', $farmer->id)->limit(1)->get()->toArray();

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();


        return view('phytosanitary.crud.finish_farmer', compact('farmer', 'index', 'user', 'districts', 'districts_farm',
            'regions', 'inspectors', 'is_farmer', 'operator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PhitoOperatorsRequests $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request|PhitoOperatorsRequests $requestt
     */
    public function finish_store(PhitoOperatorsRequests $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }

        $data = [
            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $request->inspector_name,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $request->inspector_checked,
            'date_operator' => $request->date_operator,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action,
            'is_completed' => 1,

            'date_add' => date('d.m.Y H:i', time()),
            'added_by' => Auth::user()->id,
        ];

        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-оператори');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index = $this->index;

        $operator = PhitoOperator::findOrFail($id);
        $farmer = Farmer::findOrFail($operator->farmer_id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();


        $is_farmer = PhitoOperator::select('id', 'name_operator', 'farmer_id', 'pin', 'type_firm')->where('farmer_id', '=', $farmer->id)->limit(1)->get()->toArray();

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();


        return view('phytosanitary.crud.edit', compact('farmer', 'index', 'user', 'districts', 'districts_farm',
            'regions', 'inspectors', 'is_farmer', 'operator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\PhitoOperatorsRequests|PhitoOperatorsRequests $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhitoOperatorsRequests $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        foreach ($inspectors as $key => $inspector) {
            if ($key == $request->accepted) {
                $accepted = $inspector;
            }
            if ($key == $request->checked) {
                $checked = $inspector;
            }
        }

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }
        ///

        if($operator->update_number > 0 && $operator->update_date){
            $update_number = $request->update_number;
            $update_date = strtotime($request->update_date);
        } else {
            $update_number = 0;
            $update_date = 0;
        }

        $data = [
            'update_number' => $update_number,
            'update_date' => $update_date,

            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $accepted,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $checked,
            'date_operator' => $request->date_operator,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action,
            'is_completed' => 1,

            'date_update' => date('d.m.Y H.i', time()),
            'updated_by' => Auth::user()->id,
        ];
        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_data($id)
    {
        $index = $this->index;

        $operator = PhitoOperator::findOrFail($id);
        $farmer = Farmer::findOrFail($operator->farmer_id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();
        $is_update = 1;


        return view('phytosanitary.crud.edit_data', compact('farmer', 'index', 'user', 'districts', 'districts_farm',
            'regions', 'inspectors', 'is_update', 'operator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_data_trader($id)
    {
        $index = $this->index;

        $operator = PhitoOperator::findOrFail($id);
        $trader = PhitoTraders::findOrFail($operator->trader_id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();
        $is_update = 1;

        return view('phytosanitary.crud.edit_data_trader', compact('trader', 'index', 'user',  'inspectors', 'is_update', 'operator'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\PhitoOperatorsRequests|PhitoOperatorsRequests $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_data(PhitoOperatorsRequests $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }

        $data = [
            'update_number' => $request->update_number,
            'update_date' => strtotime($request->update_date),

            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $request->inspector_name,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $request->inspector_checked,
            'date_operator' => $request->date_operator,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action,
            'is_completed' => 1,

            'date_update' => date('d.m.Y H.i', time()),
            'updated_by' => Auth::user()->id,
        ];

        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @param  int $id
     */
    public function order (Request $request, $id) {
        $this->validate($request,
            ['registration_order' => 'required|numeric|not_in:0'],
            [
                'registration_order.required' => 'Номера на Заповедта е здължителен!',
                'registration_order.numeric' => 'За номер на Заповедта използвай само цифри!',
                'registration_order.not_in' => 'Номера на Заповедта не може да нула - 0!',

            ]);
        $this->validate($request,
            ['date_order' => 'required|date_format:d.m.Y'],
            [
                'date_order.required' => 'Дата на Заявлението е здължителна!',
                'date_order.date_format' => 'Непозволен формат за Дата на Заявление!',
            ]);

        $operator = PhitoOperator::findOrFail($id);

        $data = [
            'registration_order' => $request->registration_order ,
            'date_order' =>  strtotime($request->date_order),
            'registration_number' => $request->id ,
            'registration_date' =>  strtotime($request->date_order),
            'is_completed' => 1,
        ];
        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_order(Request $request, $id)
    {
        $this->validate($request,
            ['registration_order' => 'required|numeric|not_in:0'],
            [
                'registration_order.required' => 'Номера на Заповедта е здължителен!',
                'registration_order.numeric' => 'За номер на Заповедта използвай само цифри!',
                'registration_order.not_in' => 'Номера на Заповедта не може да нула - 0!',

            ]);
        $this->validate($request,
            ['date_order' => 'required|date_format:d.m.Y'],
            [
                'date_order.required' => 'Дата на Заявлението е здължителна!',
                'date_order.date_format' => 'Непозволен формат за Дата на Заявление!',
            ]);

        $operator = PhitoOperator::findOrFail($id);

        $data = [
            'registration_order' => $request->registration_order ,
            'date_order' =>  strtotime($request->date_order),
        ];
        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lock($id){
        $operator = PhitoOperator::findOrFail($id);

        $data = [
            'is_lock' => 1,
        ];
        $operator->fill($data);
        $operator->save();

//        Session::flash('message', 'Документа е заключен!');
        return Redirect::to('/фито/оператор/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlock($id){
        $operator = PhitoOperator::findOrFail($id);

        $data = [
            'is_lock' => 0,
        ];
        $operator->fill($data);
        $operator->save();

//        Session::flash('message', 'Документа е отключен!');
        return Redirect::to('/фито/оператор/'.$id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        $this->validate($request,
            ['deletion' => 'required|numeric|not_in:0'],
            [
                'deletion.required' => 'Попълни Номера на Заповедта за заличаване!',
                'deletion.numeric' => 'За Заповед за заличаване използвай само цифри!!',
                'deletion.not_in' => 'За Заповед за заличаване не може да нула - 0!',
            ]);
        $this->validate($request,
            ['deletion_date' => 'required|date_format:d.m.Y'],
            [
                'deletion_date.required' => 'Дата на Заповед за заличаване е здължителна!',
                'deletion_date.date_format' => 'Непозволен формат за Дата на Заповед за заличаване!!',
            ]);

        $operator = PhitoOperator::findOrFail($id);

        $data = [
            'deletion' => $request->deletion,
            'deletion_date' => strtotime($request->deletion_date),
        ];
        $operator->fill($data);
        $operator->save();

        return Redirect::to('/фито/оператор/'.$id);
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

        $trader = PhitoTraders::select()->where('trader_vin','=',$eik)->get()->toArray();

        $farmers = null;
        if(isset($request['firm_search']) && $request['firm_search'] == 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->get();
        }
        if(isset($request['firm_search']) && $request['firm_search'] > 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->orWhere('bulstat','=',$eik)->get();
        }

        return view('phytosanitary.search.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers', 'trader'));
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
                        <div style='width: 50%; display: inline-block'><span><a href='/фито/оператор/земеделец/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ТОЗИ ЗС КАТО ОПЕРАТОР!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/фито/оператор/земеделец/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ТОЗИ ЗС КАТО ОПЕРАТОР!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/фито/оператор/земеделец/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ТОЗИ ЗС КАТО ОПЕРАТОР!</a></span></div>
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


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\PhitoOperatorsRequests|PhitoOperatorsRequests $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function reg_update(PhitoOperatorsRequests $request, $id)
    {
        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        foreach ($inspectors as $key => $inspector) {
            if ($key == $request->accepted) {
                $accepted = $inspector;
            }
            if ($key == $request->checked) {
                $checked = $inspector;
            }
        }

        $operator = PhitoOperator::findOrFail($id);

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }
        ///

        if($operator->update_number > 0 && $operator->update_date){
            $update_number = $request->update_number;
            $update_date = strtotime($request->update_date);
        } else {
            $update_number = 0;
            $update_date = 0;
        }

        $data = [
            'update_number' => $update_number,
            'update_date' => $update_date,

            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $accepted,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $checked,
            'date_operator' => $request->date_operator,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action,
            'is_completed' => 1,

            'date_update' => date('d.m.Y H.i', time()),
            'updated_by' => Auth::user()->id,
        ];

        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }


    //// БЕЗ ИД
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_unspecified($id)
    {
        $index = $this->index;

        $operator = PhitoOperator::findOrFail($id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();
        $is_update = 0;

        return view('phytosanitary.unspecified.edit_unspecified', compact('index', 'user',  'inspectors', 'is_update', 'operator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_unspecified($id)
    {
        $index = $this->index;

        $operator = PhitoOperator::findOrFail($id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();
        $is_update = 1;

        return view('phytosanitary.unspecified.update.update_unspecified', compact('index', 'user',  'inspectors', 'is_update', 'operator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|PhitoOperatorsRequests $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store_unspecified(PhitoOperatorsRequests $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }
        if($request->is_update == 0){
            $data = [
            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $request->inspector_name,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $request->inspector_checked,
            'date_operator' => $request->date_operator,

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action
        ];
        }
        if($request->is_update == 1){
            $data = [
                'number_petition' => $request->number_petition,
                'date_petition' => strtotime($request->date_petition),

                'update_number' => $request->update_number,
                'update_date' => strtotime($request->update_date),

                'description_objects_one' => $request->description_objects_one,
                'description_places_one' => $request->description_places_one,
                'description_objects_two' => $request->description_objects_two,
                'description_places_two' => $request->description_places_two,
                'production' => $production,
                'processing' =>  $processing,
                'import' => $import,
                'export' => $export,
                'trade' => $trade,
                'storage' => $storage,
                'treatment' => $treatment,
                'others' => $request->others,
                'plants' => $request->plants,
                'europa' => $europa,
                'bulgaria' => $bulgaria,
                'own' => $own,
                'origin_from' => $request->origin_from,
                'passports' => $request->passports,
                'passports_list' => $request->passports_list,
                'marking' => $request->marking,
                'marking_list' => $request->marking_list,
                'contact' => $request->contact,
                'contact_phone' => $request->contact_phone,
                'contact_address' => $request->contact_address,
                'contact_city' => $request->contact_city,
                'date_place' => $request->date_place,
                'place' => $request->place,
                'registration' => $request->registration,
                'registration_note' => $request->registration_note,
                'disposition' => $request->disposition,
                'disposition_note' => $request->disposition_note,
                'property' => $request->property,
                'property_note' => $request->property_note,
                'plants_origin' => $request->plants_origin,
                'plants_note' => $request->plants_note,
                'others_note' => $request->others_note,
                'accepted' => $request->accepted,
                'accepted_name' => $request->inspector_name,
                'free_text' => $request->free_text,
                'checked' => $request->checked,
                'checked_name' => $request->inspector_checked,
                'date_operator' => $request->date_operator,

                'date_update' => date('d.m.Y H:i', time()),
                'updated_by' => Auth::user()->id,

                'activity' => $request->activity,
                'products' => $request->products,
                'derivation' => $request->derivation,
                'purpose' => $request->purpose,
                'room' => $request->room,
                'action' => $request->action
            ];
        }
        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }

    /**
     * Търси в Земеделските производители.
     * @param  int  $id
     * @param  \Illuminate\Http\Request $request $request
     * @return \Illuminate\Http\Response
     */
    public function search_unspecified(Request $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);
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

        $trader = PhitoTraders::select()->where('trader_vin','=',$eik)->get()->toArray();

        $farmers = null;
        if(isset($request['firm_search']) && $request['firm_search'] == 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->get();
        }
        if(isset($request['firm_search']) && $request['firm_search'] > 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->orWhere('bulstat','=',$eik)->get();
        }

        return view('phytosanitary.unspecified.search.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers', 'operator'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $oid
     * @return \Illuminate\Http\Response
     */
    public function add_id($id, $oid){
        $operator = PhitoOperator::findOrFail($oid);

        $data = [
            'farmer_id' => $id,
        ];
        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$oid);
    }

    /**
     * ДОБАВЯНЕ НА НОВ ЗС
     * Display the specified resource.
     * @param Request $request
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_unspecified(Request $request, $id)
    {
        $firm = $request['firm'];
        $name = $request['name'];
        $pin = $request['pin'];
        $gender = $request['gender'];

        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';

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

        return view('phytosanitary.unspecified.new_farmer', compact('firm', 'name', 'pin', 'gender',
            'regions', 'selected', 'district_list', 'locations', 'districts_farm', 'id' ));

    }

    /**
     * ЗАПИС НА НОВИТЕ ЗС
     *
     * Store a newly created resource in storage.
     * @param  int  $id
     * @param Request|PhitoNewFarmerRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function add_unspecified(PhitoNewFarmerRequest $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);

        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $pin_owner = null;
        $sex_owner = null;
        $in = null;
        $name = null;

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

        $region = '';
        $dist = '';

        if($request['data_tmv'] == 1){
            $tvm = 'гр. ';
        }
        elseif($request['data_tmv'] == 2 ){
            $tvm = 'с. ';
        }
        else{
            $tvm = 'гр./с. ';
        }
        $regions = $this->areas_all_list;
        foreach ($regions as $k=>$items) {
            if ($k == $request['areas_id']) {
                $region = $items;
            }
        }

        /** Генерира списък с общините */
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $request['areas_id'])
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id');

        foreach ($districts as $k=>$items) {
            if ($k == $request['district_id']) {
                $dist = $items;
            }
        }
        $address = $request['address'].', '.$tvm.''.$request['list_name'].', общ. '.$dist.', обл. '.$region;

        $data = [
            'farmer_id' => $insertedId,
            'type_firm' => $request['firm'],
            'pin' => $pin,
            'trader_id' => 0,
            'name_operator' => $name,
            'address_operator' => $request['address'],
            'address' => $address,
            'tvm' => $tvm,
            'city' => $request['list_name'],
            'municipality' => $dist,
            'area' => $region,
            'alphabet'=>$in,

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,
            'is_completed' => 1
        ];

        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }

    /**
     * ДОБАВЯНЕ НА НОВ ЗС
     * Display the specified resource.
     * @param Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function firm_unspecified(Request $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);

        $firm = $request['firm'];
        $name_firm = $request['name_firm'];
        $eik = $request['eik'];
        $gender = 0;

        $districts_farm = $this->districts_list->toArray();
        $districts_farm[0] = 'Избери община';

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

        return view('phytosanitary.unspecified.new_firm_unspecified', compact('firm', 'name_firm', 'eik', 'gender',
            'regions', 'selected', 'district_list', 'locations', 'districts_farm', 'operator' ));

    }

    /**
     * ЗАПИС НА НОВИТЕ ЗС
     *
     * Store a newly created resource in storage.
     *
     * @param Request|PhitoNewFarmerRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function store_new_unspecified(PhitoNewFarmerRequest $request, $id)
    {
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $pin_owner = null;
        $sex_owner = null;
        $in = null;
        $name = null;

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

        $region = '';
        $dist = '';

        if($request['data_tmv'] == 1){
            $tvm = 'гр. ';
        }
        elseif($request['data_tmv'] == 2 ){
            $tvm = 'с. ';
        }
        else{
            $tvm = 'гр./с. ';
        }
        $regions = $this->areas_all_list;
        foreach ($regions as $k=>$items) {
            if ($k == $request['areas_id']) {
                $region = $items;
            }
        }

        /** Генерира списък с общините */
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $request['areas_id'])
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id');

        foreach ($districts as $k=>$items) {
            if ($k == $request['district_id']) {
                $dist = $items;
            }
        }
        $address = $request['address'].', '.$tvm.''.$request['list_name'].', общ. '.$dist.', обл. '.$region;

        $operator = PhitoOperator::findOrFail($id);
        $data = [
            'farmer_id' => $insertedId,
            'type_firm' => $request['firm'],
            'pin' => $pin,
            'trader_id' => 0,
            'name_operator' => $name,
            'address_operator' => $request['address'],
            'address' => $address,
            'tvm' => $tvm,
            'city' => $request['list_name'],
            'municipality' => $dist,
            'area' => $region,
            'alphabet'=>$in,

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,
            'is_completed' => 1
        ];

        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }


}
