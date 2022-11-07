<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Input;
use odbh\Air;
use odbh\Farmer;
use odbh\Http\Requests;
use odbh\Http\Requests\AirNewRequest;
use odbh\Http\Requests\AirRequest;
use odbh\Http\Requests\AirUpdateRequest;
use odbh\Location;
use odbh\Set;
use odbh\Director;
use odbh\User;
use Redirect;
use Session;

class AirPermitsController extends Controller
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
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        $this->logo = Set::all()->toArray();

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_rz_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        /** За Всички които са добавяли Протоколи + Активните*/
        $inspectors_active = $this->inspectors_active_rz_list->toArray();
        $inspectors_db = Air::lists('inspector_name', 'inspector')->toArray();
        $this->inspectors_edit_db = $inspectors_active + $inspectors_db;

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();
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

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $alphabet = Air::select('alphabet')->where('date_permit','>',$time_start)
                        ->where('date_permit','<',$time_end)->lists('alphabet')->toArray();

        return view('services.air.index', compact('permits', 'alphabet','abc', 'inspectors', 'year_now', 'years'));
    }

    /**
     * Сортиране на Сертификатите
     *
     * @param  int $abc_list
     * @param  int $inspector_sort
     * @param  int $year
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $abc_list = null, $inspector_sort = null, $year = null)
    {
        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $array = array();
        $year_now = null;
        if(isset($request['years'])){
            $year_now = $request['years'];
        }
        elseif(isset($request['year'])){
            $year_now = $request['year'];
        }
        elseif(isset($year)){
            $year_now = $year;
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

        $alphabet = Air::select('alphabet')->where('date_permit','>',$time_start)
            ->where('date_permit','<',$time_end)->lists('alphabet')->toArray();

        //////////////
        $abc = null;
        if (Input::has('inspector_sort') || Input::has('abc')) {
            $abc = Input::get('abc');
            $sort_inspector = Input::get('inspector_sort');
        } else {
            $abc = $abc_list;
            $sort_inspector = $inspector_sort;
        }

        if (isset($sort_inspector) && (int)$sort_inspector > 0){
            $inspector_sql = ' AND inspector= '.$sort_inspector;
        }
        else{
            $inspector_sql = '';
        }
        //////
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $permits = DB::select("SELECT * FROM air WHERE date_permit >$time_start AND  date_permit <$time_end $inspector_sql $abc_sql  ");

        return view('services.air.index', compact('permits', 'alphabet','abc', 'inspectors', 'sort_inspector', 'years', 'year_now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $farmer = Farmer::findOrFail($id);

        $index = $this->index;

        $inspectors = $this->inspectors_add;

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;

        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $last_number = Air::select('number_permit')
            ->orderBy('id', 'desc')
            ->limit(1)->get()->toArray();

        return view('services.air.create', compact('farmer', 'inspectors', 'regions', 'districts_farm',
            'districts', 'last_number', 'index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @param  \odbh\Http\Requests\AirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AirRequest $request, $id)
    {
        $farmer = Farmer::findOrFail($id);

        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        $index_in = Set::select('index_in')->get()->toArray();

        if($farmer->type_firm == 1){
            $owner = $farmer->name;
            $pin_owner = $farmer->pin;
        }
        else{
            $owner = $farmer->owner;
            $pin_owner = $farmer->pin_owner;
        }

        $data = [
            'number_permit'=> $request['number_permit'],
            'date_permit' =>strtotime(stripslashes($request['date_permit'])),

            'index_petition' => $index_in[0]['index_in'],
            'number_petition' => $request['number_petition'],
            'date_petition' =>strtotime(stripslashes($request['date_petition'])),
            'invoice' => $request['invoice'],
            'date_invoice' =>strtotime(stripslashes($request['date_invoice'])),

            'type_firm' => $farmer->type_firm,
            'name' => $farmer->name,
            'urn' => $farmer->pin,
            'owner' => $owner,
            'sex' => $farmer->sex,
            'pin_owner' => $pin_owner,
            'areas_id' => $farmer->areas_id,
            'district_id' => $farmer->district_id,
            'type_location' => $farmer->tvm,
            'location_id' => $farmer->city_id,
            'location' => $farmer->location,
            'address' => $farmer->address,
            'phone' => $farmer->mobil,
            'email' => $farmer->email,

            'ground' => $request['ground'],
            'acres' => $request['acres'],

            'cultivation' => $request['cultivation'],
            'pest' => $request['pest'],
            'start_date' =>strtotime(stripslashes($request['start_date'])),
            'end_date' =>strtotime(stripslashes($request['end_date'])),
            'prz' => $request['prz'],
            'dose' => $request['dose'],
            'quarantine' => $request['quarantine'],
            'agronomist' => $request['agronomist'],
            'certificate' => $request['certificate'],

            'inspector' => $request['inspector'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,

            'alphabet' => $farmer->alphabet,
            'date_add' =>time(),
            'added_by' => Auth::user()->id,
        ];

        $permit = new Air($data);
        $farmer->permits()->save($permit);

        Session::flash('message', 'Разрешителното е добавено успешно!');
        return Redirect::to('/въздушни/'.$permit->id);
    }

    /**
     * Разрешително за нов ЗС
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create_new(Request $request)
    {
        $firm = $request['firm'];
        $name = $request['name'];
        $pin = $request['pin'];
        $gender = $request['gender'];
        $name_firm = $request['name_firm'];
        $eik = $request['eik'];
//        $index = $this->index;

        $inspectors = $this->inspectors_add;

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

        $last_number = Air::select('number_permit')
            ->orderBy('id', 'desc')
            ->limit(1)->get()->toArray();

        return view('services.air.create_new', compact('inspectors', 'regions', 'selected', 'district_list', 'locations',
                'districts_farm', 'firm', 'name', 'pin', 'gender', 'name_firm', 'eik', 'last_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\FarmerNewProtocolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_new(AirNewRequest $request)
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
        $urn = null;
        $pin_owner_permit = null;

        $inspector_name_protocol = null;
        $position_protocol = null;
        $position_short_protocol = null;

        $index_in = Set::select('index_in')->get()->toArray();

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
        $farmer_inserted = Farmer::findOrFail($insertedId);


        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];


        if($request['firm'] == 1){
            $owner_name = $request['name'];
            $urn = $request['pin'];
            $pin_owner_permit = $request['pin'];
        }
        else{
            $owner_name = $request['owner'];
            $urn = $request['bulstat'];
            $pin_owner_permit = $request['pin_owner'];
        }
        $data = [
            'number_permit'=> $request['number_permit'],
            'date_permit' =>strtotime(stripslashes($request['date_permit'])),

            'index_petition' => $index_in[0]['index_in'],
            'number_petition' => $request['number_petition'],
            'date_petition' =>strtotime(stripslashes($request['date_petition'])),
            'invoice' => $request['invoice'],
            'date_invoice' =>strtotime(stripslashes($request['date_invoice'])),

            'type_firm' => $request['firm'],
            'name' => $name,
            'urn' => $urn,
            'owner' => $owner_name,
            'sex' => $sex,
            'pin_owner' => $pin_owner_permit,
            'areas_id' => $request['areasID'],
            'district_id' => $request['district_id'],
            'type_location' => $request['data_tmv'],
            'location_id' => $request['data_id'],
            'location' => $request['list_name'],
            'address' => $request['address'],
            'phone' => $request['mobil'],
            'email' => $request['email'],

            'ground' => $request['ground'],
            'acres' => $request['acres'],

            'cultivation' => $request['cultivation'],
            'pest' => $request['pest'],
            'start_date' =>strtotime(stripslashes($request['start_date'])),
            'end_date' =>strtotime(stripslashes($request['end_date'])),
            'prz' => $request['prz'],
            'dose' => $request['dose'],
            'quarantine' => $request['quarantine'],
            'agronomist' => $request['agronomist'],
            'certificate' => $request['certificate'],

            'inspector' => $request['inspector'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,

            'alphabet' => $in,
            'date_add' =>time(),
            'added_by' => Auth::user()->id,
        ];

        $permit = new Air($data);
        $farmer_inserted->permits()->save($permit);

        Session::flash('message', 'Разрешителното е добавено успешно!');
        return Redirect::to('/въздушни/'.$permit->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permit = null;
        $logo = $this->logo;

        $permit = Air::findOrFail($id);

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$permit->date_permit)
            ->where('end_date','>=',$permit->date_permit)
            ->get()->toArray();

        $areas = $this->areas_all;
        foreach($areas as $area){
            if($area->id == $permit->areas_id){
                $area_name = $area->areas_name;
            }
        }
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $permit->areas_id)
            ->where('district_id', '=', $permit->district_id)
            ->where('type_district', '=', 1)
            ->get();
        foreach($districts as $district){
            if($district->district_id == $permit->district_id){
                $district_name = $district->name;
            }
        }
        return view('services.air.show', compact('permit', 'logo', 'director', 'area_name', 'district_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permits = Air::findOrFail($id);

        $farmer = Farmer::findOrFail($permits->farmer_id);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;

        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $inspectors = $this->inspectors_add;

        return view('services.air.edit', compact('permits', 'inspectors', 'farmer', 'districts_farm', 'regions', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\AirUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AirUpdateRequest $request, $id)
    {
        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        $index_in = Set::select('index_in')->get()->toArray();

        $permit = Air::findOrFail($id);

        $data = [
            'index_petition' => $index_in[0]['index_in'],
            'number_petition' => $request['number_petition'],
            'date_petition' =>strtotime(stripslashes($request['date_petition'])),
            'invoice' => $request['invoice'],
            'date_invoice' =>strtotime(stripslashes($request['date_invoice'])),

            'ground' => $request['ground'],
            'acres' => $request['acres'],

            'cultivation' => $request['cultivation'],
            'pest' => $request['pest'],
            'start_date' =>strtotime(stripslashes($request['start_date'])),
            'end_date' =>strtotime(stripslashes($request['end_date'])),
            'prz' => $request['prz'],
            'dose' => $request['dose'],
            'quarantine' => $request['quarantine'],
            'agronomist' => $request['agronomist'],
            'certificate' => $request['certificate'],

            'inspector' => $request['inspector'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,

            'date_update' =>time(),
            'updated_by' => Auth::user()->id,
        ];

        $permit->fill($data);
        $permit->save();

        Session::flash('message', 'Разрешителното е редактирано успешно!');
        return Redirect::to('/въздушни/'.$permit->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

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

        $farmers = null;
        if(isset($request['firm_search']) && $request['firm_search'] == 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->get();
        }
        if(isset($request['firm_search']) && $request['firm_search'] > 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->orWhere('bulstat','=',$eik)->get();
        }

        return view('services.air.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers'));
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
                        <div style='width: 50%; display: inline-block'><span><a href='/въздушни/добави/$farmer->id' class='fa fa-plane btn btn-info my_btn'> ДОБАВИ АЗРЕШИТЕЛНО ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/въздушни/добави/$farmer->id' class='fa fa-plane btn btn-info my_btn'> ДОБАВИ АЗРЕШИТЕЛНО ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/въздушни/добави/$farmer->id' class='fa fa-plane btn btn-info my_btn'> ДОБАВИ АЗРЕШИТЕЛНО ЗА ТОЗИ ЗС!</a></span></div>
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
