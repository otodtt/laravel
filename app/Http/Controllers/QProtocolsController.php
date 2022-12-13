<?php

namespace odbh\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use odbh\Area;
use odbh\Country;
use odbh\Crop;
use odbh\Farmer;
use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Http\Requests\QNewProtocolsRequest;
use odbh\Http\Requests\QProtocolsRequest;
use odbh\Http\Requests\QProtocolTraderRequest;
use odbh\Importer;
use odbh\Location;
use odbh\QCertificate;
use odbh\QProtocol;
use odbh\Set;
use odbh\Trader;
use odbh\User;
use Redirect;
use Session;

class QProtocolsController extends Controller
{
    private $index = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'choose']]);


        $this->index = Set::select('q_index', 'authority_bg', 'authority_en')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
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

        $certs = QProtocol::get();
        foreach($certs as $cert){
            $array[date('Y', $cert->date_issue)] = date('Y', $cert->date_issue);
        }
        $years = array_filter(array_unique($array));

        $protocols = QProtocol::where('date_protocol','>=',$time_start)->where('date_protocol','<=',$time_end)->orderBy('id', 'asc')->get();

        return view('quality.protocols.index', compact('protocols', 'years', 'year_now', 'inspectors', 'firms'));
    }

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
        $index = $this->index;

        $farmer = Farmer::findOrFail($id);
        $qualitys = ['1' => 'I клас/I class', '2' => 'II клас/II class', '3' => 'OПС/GPS'];
        $packages = ['4' => 'Торби/ Bags', '3' => 'Кашони/ C. boxes', '2' => 'Палети/ Cages', '1' => 'Каси/ Pl. cases', '999' => 'ДРУГО'];

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

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

        $inspectors = User::select('id', 'short_name')
                            ->where('active', '=', 1)
                            ->where('ppz','=',1)
                            ->where('stamp_number','!=',5001)
                            ->lists('short_name', 'id')
                            ->toArray();
        return view('quality.protocols.create.exist_create_protocol', compact('farmer', 'index', 'crops', 'inspectors',
                    'qualitys', 'regions', 'districts', 'districts_farm', 'packages' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QProtocolsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $QProtocolsRequest
     */
    public function store(QProtocolsRequest $request, $id)
    {
        $farmer = Farmer::findOrFail($id);

        if(isset($request->matches) && $request->matches > 0) {
            $matches = $request->matches;
        }
        else {
            $matches = 0;
        }
        //// ЗА ИМЕТО
        if ($farmer->type_firm == 1) {
            $front = '';
            $after = '';
        }
        elseif ($farmer->type_firm == 2) {
            $front = 'ET ';
            $after = '';
        }
        elseif ($farmer->type_firm == 3) {
            $front = '';
            $after = ' ООД';
        }
        elseif ($farmer->type_firm == 4) {
            $front = '';
            $after = ' ЕООД';
        }
        elseif ($farmer->type_firm == 5) {
            $front = '';
            $after = ' АД';
        }
        elseif ($farmer->type_firm == 6) {
            $front = '';
            $after = '';
        }
        else {
            $front = '';
            $after = '';
        }
        $full_name = $front.''.$farmer->name.''.$after;

        $areas = Area::findOrFail($farmer->areas_id);
        $district = Location::select('name')->where('areas_id', $farmer->areas_id )->where('district_id', $farmer->district_id)
                                            ->where('type_district', 1)->get()->toArray();
        if($farmer->tvm == 1 ) {
            $tvm = 'гр. ';
        }
        elseif($farmer->tvm == 2 ) {
            $tvm = 'с. ';
        }
        else {
            $tvm = '';
        }
        $area_name = 'обл. '.$areas->areas_name;
        $district_name = 'общ. '.$district[0]['name'];
        $city = Location::select('name')->where('id','=',$farmer->city_id)->get()->toArray();

        $full_address = $area_name.', '.$district_name.', '.$tvm.$city[0]['name'].', '.$farmer->address ;

        $data = [
            'farmer_id'=> $farmer->id,
            'farmer_name'=>$full_name,
            'farmer_address'=> $full_address,
            'farmer_vin'=>$farmer->pin,
            'farmer_phone'=>$farmer->phone,
            'number_protocol'=> $request->number_protocol,
            'date_protocol'=> strtotime($request->date_protocol),
            'crops'=> $request->crops,
            'crops_name'=> $request->crops_name,
            'origin'=> $request->origin,
            'quality_class'=> $request->quality_class,
            'quality_naw'=> $request->quality_naw,
            'tara'=> $request->tara,
            'number'=> $request->number,
            'type_package'=> $request->type_package,
            'different'=> $request->different,
            'variety'=> $request->variety,
            'documents'=> $request->documents,
            'marking'=> $request->marking,
            'cleanliness'=> $request->cleanliness,
            'coloring'=> $request->coloring,
            'dimensions'=> $request->dimensions,
            'appearance'=> $request->appearance,
            'maturity'=> $request->maturity,
            'damage'=> $request->damage,
            'shape'=> $request->shape,
            'defects'=> $request->defects,
            'diseases'=> $request->diseases,
            'matches'=> $matches,
            'mark'=> $request->mark,
            'repackaging'=> $request->repackaging,
            'processing'=> $request->processing,
            'low'=> $request->low,
            'relabeling'=> $request->relabeling,
            'fodder'=> $request->fodder,
            'resort'=> $request->resort,
            'destruction'=> $request->destruction,
            'actions'=> $request->actions,
            'name_trader'=> $request->name_trader,
            'place'=> $request->place,
            'inspectors'=> $request->inspectors,
            'inspector_name'=> $request->inspector_name,
            'date_add' => date('d.m.Y', time()),
            'added_by' => Auth::user()->id,
        ];

        QProtocol::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/протоколи');
    }

    ///////////////////////////////////////
    /**
     * СЪЩЕСТВУВАЩ ТЪРГОВЕЦ
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_trader($id)
    {
        $index = $this->index;

        $trader = Trader::findOrFail($id);
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

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=',1)
            ->where('stamp_number','!=',5001)
            ->lists('short_name', 'id')
            ->toArray();

        return view('quality.protocols.create.exist_trader_protocol', compact('trader', 'index', 'crops', 'inspectors',
            'qualitys', 'packages' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QProtocolsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $QProtocolsRequest
     */
    public function store_trader(QProtocolsRequest $request, $id)
    {
        $trader = Trader::findOrFail($id);

        if(isset($request->matches) && $request->matches > 0) {
            $matches = $request->matches;
        }
        else {
            $matches = 0;
        }

        $data = [
            'trader_id'=> $trader->id,
            'trader_name'=>$trader->trader_name,
            'trader_address'=> $trader->trader_address,
            'trader_vin'=>$trader->trader_vin,
            'trader_phone'=>$trader->phone,
            'number_protocol'=> $request->number_protocol,
            'date_protocol'=> strtotime($request->date_protocol),
            'crops'=> $request->crops,
            'crops_name'=> $request->crops_name,
            'origin'=> $request->origin,
            'quality_class'=> $request->quality_class,
            'quality_naw'=> $request->quality_naw,
            'tara'=> $request->tara,
            'number'=> $request->number,
            'type_package'=> $request->type_package,
            'different'=> $request->different,
            'variety'=> $request->variety,
            'documents'=> $request->documents,
            'marking'=> $request->marking,
            'cleanliness'=> $request->cleanliness,
            'coloring'=> $request->coloring,
            'dimensions'=> $request->dimensions,
            'appearance'=> $request->appearance,
            'maturity'=> $request->maturity,
            'damage'=> $request->damage,
            'shape'=> $request->shape,
            'defects'=> $request->defects,
            'diseases'=> $request->diseases,
            'matches'=> $matches,
            'mark'=> $request->mark,
            'repackaging'=> $request->repackaging,
            'processing'=> $request->processing,
            'low'=> $request->low,
            'relabeling'=> $request->relabeling,
            'fodder'=> $request->fodder,
            'resort'=> $request->resort,
            'destruction'=> $request->destruction,
            'actions'=> $request->actions,
            'name_trader'=> $request->name_trader,
            'place'=> $request->place,
            'inspectors'=> $request->inspectors,
            'inspector_name'=> $request->inspector_name,
            'date_add' => date('d.m.Y', time()),
            'added_by' => Auth::user()->id,
        ];

//        dd($data);
        QProtocol::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/протоколи');
    }

    ///////////////////////////////////////
    /**
     * ДОБАВЯНЕ НА НОВ ЗС
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function create_farmer(Request $request)
    {
        $firm = $request['firm'];
        $name = $request['name'];
        $pin = $request['pin'];
        $gender = $request['gender'];
        $name_firm = $request['name_firm'];
        $eik = $request['eik'];

        $index = $this->index;

        $qualitys = ['1' => 'I клас/I class', '2' => 'II клас/II class', '3' => 'OПС/GPS'];
        $packages = ['4' => 'Торби/ Bags', '3' => 'Кашони/ C. boxes', '2' => 'Палети/ Cages', '1' => 'Каси/ Pl. cases', '999' => 'ДРУГО'];


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

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=',1)
            ->where('stamp_number','!=',5001)
            ->lists('short_name', 'id')
            ->toArray();

        return view('quality.protocols.create.new_create_protocol', compact('index', 'crops', 'inspectors',
            'regions', 'selected', 'district_list', 'locations', 'qualitys', 'packages',
            'districts_farm', 'firm', 'name', 'pin', 'gender', 'name_firm', 'eik' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QNewProtocolsRequest|QProtocolsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $QProtocolsRequest
     */
    public function store_farmer(QNewProtocolsRequest $request)
    {
        //// ДОБАВЯ ЗС ///
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $pin_owner = null;
        $sex_owner = null;
        $in = null;
        $name = null;
        $inspector_name_protocol = null;
        $position_protocol = null;
        $position_short_protocol = null;

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

        //// ДОБАВЯ ПРОТОКОЛИТЕ ///
        if(isset($request->matches) && $request->matches > 0) {
            $matches = $request->matches;
        }
        else {
            $matches = 0;
        }
        //// ЗА ИМЕТО
        if ($request->firm == 1) {
            $front = '';
            $after = '';
            $name = $request->name;
            $vin = $request->pin;
        }
        elseif ($request->firm == 2) {
            $front = 'ET ';
            $after = '';
            $name = $request->name_firm;
            $vin = $request->bulstat;
        }
        elseif ($request->firm == 3) {
            $front = '';
            $after = ' ООД';
            $name = $request->name_firm;
            $vin = $request->bulstat;
        }
        elseif ($request->firm == 4) {
            $front = '';
            $after = ' ЕООД';
            $name = $request->name_firm;
            $vin = $request->bulstat;
        }
        elseif ($request->firm == 5) {
            $front = '';
            $after = ' АД';
            $name = $request->name_firm;
            $vin = $request->bulstat;
        }
        elseif ($request->firm == 6) {
            $front = '';
            $after = '';
            $name = $request->name_firm;
            $vin = $request->bulstat;
        }
        else {
            $front = '';
            $after = '';
            $name = '';
            $vin = '';
        }
        $full_name = $front.''.$name.''.$after;

        $areas = Area::findOrFail($request->areasID);
        $district = Location::select('name')->where('areas_id', $request->areasID )->where('district_id', $request->district_id)
            ->where('type_district', 1)->get()->toArray();
        if($request->data_tmv == 1 ) {
            $tvm = 'гр. ';
        }
        elseif($request->data_tmv == 2 ) {
            $tvm = 'с. ';
        }
        else {
            $tvm = '';
        }
        $area_name = 'обл. '.$areas->areas_name;
        $district_name = 'общ. '.$district[0]['name'];
        $city = Location::select('name')->where('id','=',$request->data_id)->get()->toArray();

        $full_address = $area_name.', '.$district_name.', '.$tvm.$city[0]['name'].', '.$request->address ;

        $data = [
            'farmer_id'=> $insertedId,
            'farmer_name'=>$full_name,
            'farmer_address'=> $full_address,
            'farmer_vin'=>$vin,
            'farmer_phone'=>$request->mobil,
            'number_protocol'=> $request->number_protocol,
            'date_protocol'=> strtotime($request->date_protocol),
            'crops'=> $request->crops,
            'crops_name'=> $request->crops_name,
            'origin'=> $request->origin,
            'quality_class'=> $request->quality_class,
            'quality_naw'=> $request->quality_naw,
            'tara'=> $request->tara,
            'number'=> $request->number,
            'type_package'=> $request->type_package,
            'different'=> $request->different,
            'variety'=> $request->variety,
            'documents'=> $request->documents,
            'marking'=> $request->marking,
            'cleanliness'=> $request->cleanliness,
            'coloring'=> $request->coloring,
            'dimensions'=> $request->dimensions,
            'appearance'=> $request->appearance,
            'maturity'=> $request->maturity,
            'damage'=> $request->damage,
            'shape'=> $request->shape,
            'defects'=> $request->defects,
            'diseases'=> $request->diseases,
            'matches'=> $matches,
            'mark'=> $request->mark,
            'repackaging'=> $request->repackaging,
            'processing'=> $request->processing,
            'low'=> $request->low,
            'relabeling'=> $request->relabeling,
            'fodder'=> $request->fodder,
            'resort'=> $request->resort,
            'destruction'=> $request->destruction,
            'actions'=> $request->actions,
            'name_trader'=> $request->name_trader,
            'place'=> $request->place,
            'inspectors'=> $request->inspectors,
            'inspector_name'=> $request->inspector_name,
            'date_add' => date('d.m.Y', time()),
            'added_by' => Auth::user()->id,
        ];

        QProtocol::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/протоколи');
    }

    ///////////////////////////////////////
    /**
     * НОВ ТЪРГОВЕЦ
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function new_trader(Request $request)
    {
        $type_firm = $request['firm'];
        $trader_name = $request['name_firm'];
        $trader_vin = $request['eik'];

        $index = $this->index;

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

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=',1)
            ->where('stamp_number','!=',5001)
            ->lists('short_name', 'id')
            ->toArray();

        return view('quality.protocols.create.new_trader_protocol', compact('index', 'crops', 'inspectors',
            'qualitys', 'packages', 'type_firm', 'trader_name', 'trader_vin' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QProtocolsRequest|QProtocolTraderRequest $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     * @internal param Request $QProtocolsRequest
     */
    public function store_new_trader(QProtocolTraderRequest $request)
    {
        $data_trader = [
            'trader_name'=> $request->trader_name,
            'trader_address'=> $request->trader_address,
            'trader_vin'=> $request->trader_vin,
            'created_by'=> Auth::user()->id,
            'date_create' => date('d.m.Y H:i:s', time()) ,
        ];
        $trader = Trader::create($data_trader);
        $insertedId = $trader->id;

        if(isset($request->matches) && $request->matches > 0) {
            $matches = $request->matches;
        }
        else {
            $matches = 0;
        }

        $data = [
            'trader_id'=> $insertedId,
            'trader_name'=>$request->trader_name,
            'trader_address'=> $request->trader_address,
            'trader_vin'=>$request->trader_vin,
            'trader_phone'=>$request->mobile,
            'number_protocol'=> $request->number_protocol,
            'date_protocol'=> strtotime($request->date_protocol),
            'crops'=> $request->crops,
            'crops_name'=> $request->crops_name,
            'origin'=> $request->origin,
            'quality_class'=> $request->quality_class,
            'quality_naw'=> $request->quality_naw,
            'tara'=> $request->tara,
            'number'=> $request->number,
            'type_package'=> $request->type_package,
            'different'=> $request->different,
            'variety'=> $request->variety,
            'documents'=> $request->documents,
            'marking'=> $request->marking,
            'cleanliness'=> $request->cleanliness,
            'coloring'=> $request->coloring,
            'dimensions'=> $request->dimensions,
            'appearance'=> $request->appearance,
            'maturity'=> $request->maturity,
            'damage'=> $request->damage,
            'shape'=> $request->shape,
            'defects'=> $request->defects,
            'diseases'=> $request->diseases,
            'matches'=> $matches,
            'mark'=> $request->mark,
            'repackaging'=> $request->repackaging,
            'processing'=> $request->processing,
            'low'=> $request->low,
            'relabeling'=> $request->relabeling,
            'fodder'=> $request->fodder,
            'resort'=> $request->resort,
            'destruction'=> $request->destruction,
            'actions'=> $request->actions,
            'name_trader'=> $request->name_trader,
            'place'=> $request->place,
            'inspectors'=> $request->inspectors,
            'inspector_name'=> $request->inspector_name,
            'date_add' => date('d.m.Y', time()),
            'added_by' => Auth::user()->id,
        ];

        //dd($data);
        QProtocol::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/протоколи');
    }

///////////////////////////////////////
    /**
     * НЕРЕГЛАМЕНТИРАН
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function unregulated(Request $request)
    {
        $index = $this->index;

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

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=',1)
            ->where('stamp_number','!=',5001)
            ->lists('short_name', 'id')
            ->toArray();

        return view('quality.protocols.create.unregulated_protocol', compact('index', 'crops', 'inspectors',
            'qualitys', 'packages' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QProtocolsRequest|QProtocolTraderRequest $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     * @internal param Request $QProtocolsRequest
     */
    public function store_unregulated(QProtocolTraderRequest $request)
    {
        if(isset($request->matches) && $request->matches > 0) {
            $matches = $request->matches;
        }
        else {
            $matches = 0;
        }

        $data = [
            'unregulated_id'=> 1,
            'unregulated_name'=>$request->trader_name,
            'unregulated_address'=> $request->trader_address,
            'unregulated_vin'=>$request->trader_vin,
            'unregulated_phone'=>$request->mobile,
            'number_protocol'=> $request->number_protocol,
            'date_protocol'=> strtotime($request->date_protocol),
            'crops'=> $request->crops,
            'crops_name'=> $request->crops_name,
            'origin'=> $request->origin,
            'quality_class'=> $request->quality_class,
            'quality_naw'=> $request->quality_naw,
            'tara'=> $request->tara,
            'number'=> $request->number,
            'type_package'=> $request->type_package,
            'different'=> $request->different,
            'variety'=> $request->variety,
            'documents'=> $request->documents,
            'marking'=> $request->marking,
            'cleanliness'=> $request->cleanliness,
            'coloring'=> $request->coloring,
            'dimensions'=> $request->dimensions,
            'appearance'=> $request->appearance,
            'maturity'=> $request->maturity,
            'damage'=> $request->damage,
            'shape'=> $request->shape,
            'defects'=> $request->defects,
            'diseases'=> $request->diseases,
            'matches'=> $matches,
            'mark'=> $request->mark,
            'repackaging'=> $request->repackaging,
            'processing'=> $request->processing,
            'low'=> $request->low,
            'relabeling'=> $request->relabeling,
            'fodder'=> $request->fodder,
            'resort'=> $request->resort,
            'destruction'=> $request->destruction,
            'actions'=> $request->actions,
            'name_trader'=> $request->name_trader,
            'place'=> $request->place,
            'inspectors'=> $request->inspectors,
            'inspector_name'=> $request->inspector_name,
            'date_add' => date('d.m.Y', time()),
            'added_by' => Auth::user()->id,
        ];

        QProtocol::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/протоколи');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $index = $this->index;
        $protocol = QProtocol::findOrFail($id);

        return view('quality.protocols.show', compact('protocol', 'index'));
    }

    /** //// РЕДАКТИРАНЕ /////// */
    /**
     * НЕРЕГЛАМЕНТИРАН
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function unregulated_edit($id)
    {
        $index = $this->index;

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

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=',1)
            ->where('stamp_number','!=',5001)
            ->lists('short_name', 'id')
            ->toArray();

        $protocol = QProtocol::findOrFail($id);

        return view('quality.protocols.edit.unregulated_protocol', compact( 'protocol', 'index', 'crops', 'inspectors', 'qualitys', 'packages' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QProtocolsRequest|QProtocolTraderRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Request $QProtocolsRequest
     */
    public function unregulated_update(QProtocolTraderRequest $request, $id)
    {
        $protocol = QProtocol::findOrFail($id);

        if(isset($request->matches) && $request->matches > 0) {
            $matches = $request->matches;
        }
        else {
            $matches = 0;
        }

        $data = [
            'unregulated_name'=>$request->trader_name,
            'unregulated_address'=> $request->trader_address,
            'unregulated_vin'=>$request->trader_vin,
            'unregulated_phone'=>$request->mobile,
            'number_protocol'=> $request->number_protocol,
            'date_protocol'=> strtotime($request->date_protocol),
            'crops'=> $request->crops,
            'crops_name'=> $request->crops_name,
            'origin'=> $request->origin,
            'quality_class'=> $request->quality_class,
            'quality_naw'=> $request->quality_naw,
            'tara'=> $request->tara,
            'number'=> $request->number,
            'type_package'=> $request->type_package,
            'different'=> $request->different,
            'variety'=> $request->variety,
            'documents'=> $request->documents,
            'marking'=> $request->marking,
            'cleanliness'=> $request->cleanliness,
            'coloring'=> $request->coloring,
            'dimensions'=> $request->dimensions,
            'appearance'=> $request->appearance,
            'maturity'=> $request->maturity,
            'damage'=> $request->damage,
            'shape'=> $request->shape,
            'defects'=> $request->defects,
            'diseases'=> $request->diseases,
            'matches'=> $matches,
            'mark'=> $request->mark,
            'repackaging'=> $request->repackaging,
            'processing'=> $request->processing,
            'low'=> $request->low,
            'relabeling'=> $request->relabeling,
            'fodder'=> $request->fodder,
            'resort'=> $request->resort,
            'destruction'=> $request->destruction,
            'actions'=> $request->actions,
            'name_trader'=> $request->name_trader,
            'place'=> $request->place,
            'inspectors'=> $request->inspectors,
            'inspector_name'=> $request->inspector_name,
            'date_update' => date('d.m.Y', time()),
            'updated_by' => Auth::user()->id,
        ];

        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/протоколи/'.$id.'/show');
    }

    /**
     * ТЪРГОВЕЦ
     * Display the specified resource.
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trader_edit($id)
    {

        $protocol = QProtocol::findOrFail($id);

        $index = $this->index;

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

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=',1)
            ->where('stamp_number','!=',5001)
            ->lists('short_name', 'id')
            ->toArray();

        $importers = Trader::select(['id', 'trader_name', 'trader_address', 'trader_vin'])->get()->toArray();

        return view('quality.protocols.edit.trader_protocol', compact('index', 'crops', 'inspectors',
            'qualitys', 'packages', 'protocol', 'importers' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QProtocolsRequest|QProtocolTraderRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Request $QProtocolsRequest
     */
    public function trader_update(QProtocolsRequest $request, $id)
    {
        $protocol = QProtocol::findOrFail($id);

        if(isset($request->matches) && $request->matches > 0) {
            $matches = $request->matches;
        }
        else {
            $matches = 0;
        }

        $data = [
            'trader_id'=> $request->importer_data,
            'trader_name'=>$request->name,
            'trader_address'=> $request->address,
            'trader_vin'=>$request->vin,
            'trader_phone'=>$request->mobile,
            'number_protocol'=> $request->number_protocol,
            'date_protocol'=> strtotime($request->date_protocol),
            'crops'=> $request->crops,
            'crops_name'=> $request->crops_name,
            'origin'=> $request->origin,
            'quality_class'=> $request->quality_class,
            'quality_naw'=> $request->quality_naw,
            'tara'=> $request->tara,
            'number'=> $request->number,
            'type_package'=> $request->type_package,
            'different'=> $request->different,
            'variety'=> $request->variety,
            'documents'=> $request->documents,
            'marking'=> $request->marking,
            'cleanliness'=> $request->cleanliness,
            'coloring'=> $request->coloring,
            'dimensions'=> $request->dimensions,
            'appearance'=> $request->appearance,
            'maturity'=> $request->maturity,
            'damage'=> $request->damage,
            'shape'=> $request->shape,
            'defects'=> $request->defects,
            'diseases'=> $request->diseases,
            'matches'=> $matches,
            'mark'=> $request->mark,
            'repackaging'=> $request->repackaging,
            'processing'=> $request->processing,
            'low'=> $request->low,
            'relabeling'=> $request->relabeling,
            'fodder'=> $request->fodder,
            'resort'=> $request->resort,
            'destruction'=> $request->destruction,
            'actions'=> $request->actions,
            'name_trader'=> $request->name_trader,
            'place'=> $request->place,
            'inspectors'=> $request->inspectors,
            'inspector_name'=> $request->inspector_name,
            'date_update' => date('d.m.Y', time()),
            'updated_by' => Auth::user()->id,
        ];

        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/протоколи/'.$id.'/show');
    }

    /**
     * ФЕРМЕР
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocol = QProtocol::findOrFail($id);

        $index = $this->index;

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

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('ppz','=',1)
            ->where('stamp_number','!=',5001)
            ->lists('short_name', 'id')
            ->toArray();

        $importers = Trader::select(['id', 'trader_name', 'trader_address', 'trader_vin'])->get()->toArray();

        return view('quality.protocols.edit.farmer_protocol', compact('index', 'crops', 'inspectors',
            'qualitys', 'packages', 'protocol', 'importers' ));
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


    ////// ТЪРСИ ЗЕМЕДЕЛЦИ И ТЪРГОВЦИ
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

        return view('quality.protocols.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers', 'trader'));
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
//        dd($farmers);

        if(count($farmers)>0){
            foreach($farmers as $farmer) {
                $return_farmer[] = "
                <ul>
                    <li>
                        <div style='width: 40%; display: inline-block'><span class='bold' style='font-size: 1em;'>$farmer->name с ЕГН: $farmer->pin</span></div>
                        <div style='width: 50%; display: inline-block'><span><a href='/контрол/протоколи/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ КОНСТАТИВЕН ПРОТОКОЛ ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/контрол/протоколи/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ КОНСТАТИВЕН ПРОТОКОЛ ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/контрол/протоколи/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ КОНСТАТИВЕН ПРОТОКОЛ ЗА ТОЗИ ЗСDDS!</a></span></div>
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
