<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Area;
use odbh\Http\Requests;
use odbh\Http\Requests\OtherObjectRequest;
use odbh\Location;
use odbh\OtherProtocol;
use odbh\Set;
use odbh\User;
use Redirect;
use Session;

class OthersProtocolsController extends Controller
{
    private $logo = null;

    private $ph_area_sort = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * OthersProtocolsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control');

        $this->logo = Set::all()->toArray();

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_rz_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        /** За Всички които са добавяли Протоколи + Активните*/
        $inspectors_active = $this->inspectors_active_rz_list->toArray();
        $inspectors_db = array();
        $inspectors_db_two = array();
        $inspectors_db_three = array();
        $inspectors_db_all = OtherProtocol::select('inspector_name', 'inspector', 'inspector_two_name', 'inspector_two', 'inspector_three_name', 'inspector_three')
            ->where('inspector','!=',0)->where('inspector_two','!=',0)->where('inspector_three','!=',0)->get()->toArray();
        foreach($inspectors_db_all as $value){
            $inspectors_db[$value['inspector']] = $value['inspector_name'];
            $inspectors_db_two[$value['inspector_two']] = $value['inspector_two_name'];
            $inspectors_db_three[$value['inspector_three']] = $value['inspector_three_name'];
        }
        $this->inspectors_edit_db = array_sort_recursive($inspectors_active) + array_sort_recursive($inspectors_db)
            + array_sort_recursive($inspectors_db_two) + array_sort_recursive($inspectors_db_three);

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abc = null;
        $alphabet = OtherProtocol::lists('alphabet')->toArray();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $protocols = OtherProtocol::all()->sortBy('date_protocol');

        return view('protocols.others.index', compact('alphabet', 'protocols', 'abc', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = OtherProtocol::where('number', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = OtherProtocol::lists('alphabet')->toArray();

        return view('protocols.others.index', compact('alphabet', 'protocols', 'abc', 'inspectors', 'areas'));
    }

    /**
     * Сортиране на Протоколите
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $assay_sort
     * @param  int $inspector_sort
     * @param  int $object_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $abc_list = null, $start_year = null, $end_year = null, $inspector_sort = null, $assay_sort = null, $object_sort = null)
    {
        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $alphabet = OtherProtocol::lists('alphabet')->toArray();
        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('areas_sort') || Input::has('inspector_sort')
            || Input::has('abc') || Input::has('assay_sort') || Input::has('object_sort')) {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
            $sort_object = Input::get('object_sort');
        } else {
            $abc = $abc_list;
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_inspector = $inspector_sort;
            $sort_assay = $assay_sort;
            $sort_object = $object_sort;
        }

        /** Сортиране по дата **/
        if (isset($years_start_sort) || isset($years_end_sort)) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort . 'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort . 'Europe/Paris');
            if ($start > 0 && $end == false) {
                $years_sql = ' AND date_protocol=' . $start . ' OR date_protocol=' . $timezone_paris_start;
            }
            if ($end > 0 && $start == false) {
                $years_sql = ' AND date_protocol=' . $end . ' OR date_protocol=' . $timezone_paris_end;
            }
            if (((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)) {
                $years_sql = ' AND date_protocol=' . $start . ' OR date_protocol=' . $timezone_paris_start;
            }
            if (((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)) {
                $years_sql = ' AND date_protocol>=' . $start . ' AND date_protocol<=' . $end . '';
            }
            if (($start > 0 && $end > 0) && ($start > $end)) {
                $years_sql = ' AND date_protocol>=' . $end . ' AND date_protocol<=' . $start . '';
            }
        } else {
            $years_sql = ' ';
        }

        /** Сортиране по обект **/
        if (isset($sort_object) && (int)$sort_object > 0) {
            $object_sql = ' AND ot=' . $sort_object;
        } else {
            $object_sql = ' ';
        }
        /** Сортиране по Инспектори **/
        if (isset($sort_inspector) && (int)$sort_inspector > 0) {
            $inspector_sql = ' AND inspector= ' . $sort_inspector;
        } else {
            $inspector_sql = '';
        }
        /** Сортиране по взета проба и нарушения **/
        if (isset($sort_assay) && (int)$sort_assay == 1) {
            $assay_sql = ' AND violation > 0';
        } else {
            $assay_sql = '';
        }
        /** Сортиране по азбучен ред **/
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $protocols = DB::select("SELECT * FROM others_protocols WHERE id>0  $years_sql $object_sql $inspector_sql
                                $assay_sql $abc_sql ORDER BY date_protocol ASC ");

        return view('protocols.others.index', compact('protocols', 'alphabet', 'abc', 'years_start_sort', 'years_end_sort',
            'inspectors', 'sort_object', 'sort_inspector', 'areas', 'sort_assay'));
    }

    /**
     * Показва всички области, общини и населени места
     * използва се пр jQuery и Ajax заявките
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function locations(Request $request)
    {
        $id_obst = filter_input(INPUT_POST, 'val1');
        $hidden = filter_input(INPUT_POST, 'val2');
        $areasID = filter_input(INPUT_POST, 'areasIDObject');

        $return_district = null;
        $id_ret = null;
        $return_locals = null;

        $return_district = null;
        $return = null;

        if(isset($areasID)){
            $region_js = Area::select('id')->where('id', '=', $areasID)->get()->toArray();
            $id_ret = $region_js[0]['id'];

            $areas_js = Location::select()
                ->where('areas_id', '=', $areasID)
                ->where('type_district', '=', 1)
                ->orderBy('district_id', 'asc')
                ->get();
            $return_district[0] = '<option value="0">Избери община</option>';
            foreach($areas_js as $area) {
                $return_district[] = '<option value="'.$area->district_id.'">' .$area->name. '</option>';
            }
            $locations_js = Location::select()
                ->where('areas_id', '=', $areasID)
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get();

            foreach($locations_js as $local) {
                $return_locals[] = '<option value="'.$local->name.'" district_id2="'.$local->district_id.'" tmv="'.$local->tvm.'" >' .$local->name. '</option>';
            }

            if ($request->ajax()) {
                return response()->json([
                    $return_district,$id_ret,$return_locals
                ]);
            }
        }

        if (isset($id_obst) && isset($hidden)) {
            if((int)$id_obst>0){
                $locals_js = Location::select()
                    ->where('areas_id', '=', $hidden)
                    ->where('district_id', '=', $id_obst)
                    ->where('tvm', '!=', 0)
                    ->orderBy('type_district', 'desc')
                    ->orderBy('district_id', 'asc')
                    ->get();
            }
            else{
                $locals_js = Location::select()
                    ->where('areas_id', '=', $hidden)
                    ->where('tvm', '!=', 0)
                    ->orderBy('type_district', 'desc')
                    ->orderBy('type_district', 'desc')
                    ->orderBy('district_id', 'asc')
                    ->get();
            }

            foreach($locals_js as $local) {
                $return[] = '<option value="'.$local->name.'" district_id2="'.$local->district_id.'" tmv="'.$local->tvm.'" >' .$local->name. '</option>';
            }

            //////////////
            $areas_js = Location::select()
                ->where('areas_id', '=', $hidden)
                ->where('type_district', '=', 1)
                ->orderBy('district_id', 'asc')
                ->get();
            $return_district[0] = '<option value="0">Избери община</option>';
            foreach($areas_js as $area) {
                $return_district[] = '<option value="'.$area->district_id.'">' .$area->name. '</option>';
            }
            if ($request->ajax()) {
                return response()->json([
                    $return, $return_district
                ]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inspectors = $this->inspectors_add;

        $selected_array = Set::select('area_id')->get()->toArray();
        $selected_session = $selected_array[0]['area_id'];
        /////////// Областта на Фирмата
        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$selected_session)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $selected_array[0]['area_id'];
        }
        $regions = Area::lists('areas_name', 'id');
        /////////// Общината на Фирмата
        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);
        /////////// Локация на Фирмата
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
        /////////////////////////
        /////////// Областта на обекта
        $get_session_dis = Session::get('_old_input', 'hidden2');
        if(isset($get_session_dis['hidden2']) && ((int)$get_session_dis != (int)$selected_session)){
            $selected_objects = $get_session_dis['hidden2'];
        }
        else{
            $selected_objects = $selected_array[0]['area_id'];
        }
        $regions_objects = Area::lists('areas_name', 'id');
        /////////// Общината на обекта
        $district_list_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected_objects)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list_object[0] = 'Избери община';
        $district_list_object = array_sort_recursive($district_list_object);
        /////////// Локация на обекта
        $get_district_obj = Session::get('_old_input', 'localsIDObject');
        if(!isset($get_district_obj['localsIDObject']) || $get_district_obj['localsIDObject']==0){
            $locations_objects = Location::select()
                ->where('areas_id', '=', $selected_objects)
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }
        else {
            $locations_objects = Location::select()
                ->where('areas_id', '=', $selected_objects)
                ->where('district_id', '=', $get_district_obj['localsIDObject'])
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        return view('protocols.others.create', compact('inspectors', 'selected', 'regions', 'district_list', 'locations',
                    'regions_objects', 'selected_objects','district_list_object', 'locations_objects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\OtherObjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OtherObjectRequest $request)
    {
        $sex_owner = null;
        $in = null;
        ///// SEX OWNER
        if(strlen($request['gender_owner']) == 4){
            $sex_owner = 1;
        }
        elseif(strlen($request['gender_owner']) == 6){
            $sex_owner = 2;
        }
        elseif(strlen($request['gender_owner']) == 2){
            $sex_owner = 0;
        }
        else{
            $sex_owner = 0;
        }

        ///////
        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        if($request['inspector_two'] > 0){
            $inspector_name_sql2 = User::where('id', '=', $request['inspector_two'])->get()->toArray();
            $inspector_two_name = $inspector_name_sql2[0]['short_name'];
            $position_two = $inspector_name_sql2[0]['position'];
            $position_short_two = $inspector_name_sql2[0]['position_short'];
        }
        else {
            $inspector_two_name = '';
            $position_two = '';
            $position_short_two = '';
        }

        if($request['inspector_three']> 0){
            $inspector_name_sql3 = User::where('id', '=', $request['inspector_three'])->get()->toArray();
            $inspector_three_name = $inspector_name_sql3[0]['short_name'];
            $position_three = $inspector_name_sql3[0]['position'];
            $position_short_three = $inspector_name_sql3[0]['position_short'];
        }
        else {
            $inspector_three_name = '';
            $position_three = '';
            $position_short_three = '';
        }
        ////
        $cyrillic= array(0=>'', 1=>'А', 2=>'Б', 3=>'В', 4=>'Г', 5=>'Д', 6=>'Е', 7=>'Ж', 8=>'З', 9=>'И', 10=>'Й',
            11=>'К', 12=>'Л', 13=>'М', 14=>'Н', 15=>'О', 16=>'П', 17=>'Р', 18=>'С',	19=>'Т', 20=>'У',
            21=>'Ф', 22=>'Х', 23=>'Ц', 24=>'Ч', 25=>'Ш', 26=>'Щ', 27=>'Ъ',	28=>'Ь', 29=>'Ю', 30=>'Я');

        $abc= trim(preg_replace("/[0-9]/", "", $request['name']));
        $abc1= trim(preg_replace("/-/", "", $abc));
        $abc2= trim(preg_replace("/.]/", "", $abc1));
        $abc3 = mb_substr($abc2, 0, 1);
        foreach ($cyrillic as $k=>$v){
            if(preg_match("/$abc3/iu", "$v")){
                $in=$k;
            }
        }
        $data = ([
            'type_check'=> 1,
            'ot'=> $request['ot'],
            'number'=> $request['number'],
            'date_protocol'=> strtotime($request['date_protocol']),
            'inspector'=> $request['inspector'],
            'inspector_two'=> $request['inspector_two'],
            'inspector_three'=> $request['inspector_three'],
            'inspector_another'=> $request['inspector_another'],
            'inspector_from'=> $request['inspector_from'],
            'firm'=> $request['firm'],
            'name'=> $request['name'],

            'bulstat'=> $request['bulstat'],
            'owner'=> $request['owner'],
            'pin_owner'=> $request['pin_owner'],
            'sex_owner'=> $sex_owner,

            'areas_id'=> $request['areasID'],
            'district_id'=> $request['localsID'],
            'id_location'=> $request['data_id'],
            'city_village'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'address'=> $request['address'],

            'violation'=> $request['violation'],
            'ascertainment'=> $request['ascertainment'],
            'taken'=> $request['taken'],
            'order_protocol'=> $request['order_protocol'],
            'act'=> $request['act'],

            'area_object'=> $request['areasIDObject'],
            'district_object'=> $request['localsIDObject'],
            'cv_object'=> $request['tmv'],
            'address_object'=> $request['address_object'],
            'location_object'=> $request['list_name_object'],

            'inspector_name'=> $inspector_name,
            'position'=> $position,
            'position_short'=> $position_short,
            'inspector_two_name'=> $inspector_two_name,
            'position_two'=> $position_two,
            'position_short_two'=> $position_short_two,
            'inspector_three_name'=> $inspector_three_name,
            'position_three'=> $position_three,
            'position_short_three'=> $position_short_three,
            'date_add'=> time(),
            'added_by'=> Auth::user()->id,
            'alphabet'=> $in,
        ]);

        OtherProtocol::create($data);

        Session::flash('message', 'Протокола е добавен успешно!');
        return Redirect::to('/други-обекти');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logo = $this->logo;
        $protocol = OtherProtocol::findOrFail($id);
        $inspectors = User::get();
        $city = Set::first();

        $areas_firm = $this->areas_all;
        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $protocol->areas_id)
            ->where('district_id', '=', $protocol->district_id)
            ->where('type_district', '=', 1)
            ->get();
        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $protocol->area_object)
            ->where('district_id', '=', $protocol->district_object)
            ->where('type_district', '=', 1)
            ->get();

        return view('protocols.others.show', compact('logo', 'protocol', 'inspectors', 'city', 'areas_firm',
                    'districts_firm', 'districts_object'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocols = OtherProtocol::findOrFail($id);

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = '';
        $inspectors = array_sort_recursive($inspectors);

        $selected_array = Set::select('area_id')->get()->toArray();
        $selected_session = $selected_array[0]['area_id'];

        /////////// Областта на Фирмата
        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$selected_session)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $protocols->areas_id;
        }
        $regions = Area::lists('areas_name', 'id');
        /////////// Общината на Фирмата
        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);
        /////////// Локация на Фирмата
        $get_district = Session::get('_old_input', 'localsID');
        if(!isset($get_district['localsID']) || $get_district['localsID']==0){
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('district_id', '=', $protocols->district_id)
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }
        else {
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('district_id', '=', $protocols->district_id)
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        /////////// Областта на обекта
        $get_session_dis = Session::get('_old_input', 'hidden2');
        if(isset($get_session_dis['hidden2']) && ((int)$get_session_dis != (int)$selected_session)){
            $selected_objects = $get_session_dis['hidden2'];
        }
        else{
            $selected_objects = $protocols->area_object;
        }
        $regions_objects = Area::lists('areas_name', 'id');
        /////////// Общината на обекта
        $district_list_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected_objects)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list_object[0] = 'Избери община';
        $district_list_object = array_sort_recursive($district_list_object);
        /////////// Локация на обекта
        $get_district_obj = Session::get('_old_input', 'localsIDObject');
        if(!isset($get_district_obj['localsIDObject']) || $get_district_obj['localsIDObject']==0){
            $locations_objects = Location::select()
                ->where('areas_id', '=', $selected_objects)
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }
        else {
            $locations_objects = Location::select()
                ->where('areas_id', '=', $selected_objects)
                ->where('district_id', '=', $get_district_obj['localsIDObject'])
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        return view('protocols.others.edit', compact('inspectors', 'selected', 'regions', 'district_list', 'locations',
            'regions_objects', 'selected_objects','district_list_object', 'locations_objects', 'protocols'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\OtherObjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OtherObjectRequest $request, $id)
    {
        $protocol = OtherProtocol::findOrFail($id);
        $sex_owner = null;
        $in = null;
        ///// SEX OWNER
        if(strlen($request['gender_owner']) == 4){
            $sex_owner = 1;
        }
        elseif(strlen($request['gender_owner']) == 6){
            $sex_owner = 2;
        }
        elseif(strlen($request['gender_owner']) == 2){
            $sex_owner = 0;
        }
        else{
            $sex_owner = 0;
        }

        ///////
        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        if($request['inspector_two'] > 0){
            $inspector_name_sql2 = User::where('id', '=', $request['inspector_two'])->get()->toArray();
            $inspector_two_name = $inspector_name_sql2[0]['short_name'];
            $position_two = $inspector_name_sql2[0]['position'];
            $position_short_two = $inspector_name_sql2[0]['position_short'];
        }
        else {
            $inspector_two_name = '';
            $position_two = '';
            $position_short_two = '';
        }

        if($request['inspector_three']> 0){
            $inspector_name_sql3 = User::where('id', '=', $request['inspector_three'])->get()->toArray();
            $inspector_three_name = $inspector_name_sql3[0]['short_name'];
            $position_three = $inspector_name_sql3[0]['position'];
            $position_short_three = $inspector_name_sql3[0]['position_short'];
        }
        else {
            $inspector_three_name = '';
            $position_three = '';
            $position_short_three = '';
        }
        ////
        $cyrillic= array(0=>'', 1=>'А', 2=>'Б', 3=>'В', 4=>'Г', 5=>'Д', 6=>'Е', 7=>'Ж', 8=>'З', 9=>'И', 10=>'Й',
            11=>'К', 12=>'Л', 13=>'М', 14=>'Н', 15=>'О', 16=>'П', 17=>'Р', 18=>'С',	19=>'Т', 20=>'У',
            21=>'Ф', 22=>'Х', 23=>'Ц', 24=>'Ч', 25=>'Ш', 26=>'Щ', 27=>'Ъ',	28=>'Ь', 29=>'Ю', 30=>'Я');

        $abc= trim(preg_replace("/[0-9]/", "", $request['name']));
        $abc1= trim(preg_replace("/-/", "", $abc));
        $abc2= trim(preg_replace("/.]/", "", $abc1));
        $abc3 = mb_substr($abc2, 0, 1);
        foreach ($cyrillic as $k=>$v){
            if(preg_match("/$abc3/iu", "$v")){
                $in=$k;
            }
        }
        $data = ([
            'type_check'=> 1,
            'ot'=> $request['ot'],
            'number'=> $request['number'],
            'date_protocol'=> strtotime($request['date_protocol']),
            'inspector'=> $request['inspector'],
            'inspector_two'=> $request['inspector_two'],
            'inspector_three'=> $request['inspector_three'],
            'inspector_another'=> $request['inspector_another'],
            'inspector_from'=> $request['inspector_from'],
            'firm'=> $request['firm'],
            'name'=> $request['name'],

            'bulstat'=> $request['bulstat'],
            'owner'=> $request['owner'],
            'pin_owner'=> $request['pin_owner'],
            'sex_owner'=> $sex_owner,

            'areas_id'=> $request['areasID'],
            'district_id'=> $request['localsID'],
            'id_location'=> $request['data_id'],
            'city_village'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'address'=> $request['address'],

            'violation'=> $request['violation'],
            'ascertainment'=> $request['ascertainment'],
            'taken'=> $request['taken'],
            'order_protocol'=> $request['order_protocol'],
            'act'=> $request['act'],

            'area_object'=> $request['areasIDObject'],
            'district_object'=> $request['localsIDObject'],
            'cv_object'=> $request['tmv'],
            'address_object'=> $request['address_object'],
            'location_object'=> $request['list_name_object'],

            'inspector_name'=> $inspector_name,
            'position'=> $position,
            'position_short'=> $position_short,
            'inspector_two_name'=> $inspector_two_name,
            'position_two'=> $position_two,
            'position_short_two'=> $position_short_two,
            'inspector_three_name'=> $inspector_three_name,
            'position_three'=> $position_three,
            'position_short_three'=> $position_short_three,
            'date_update'=> time(),
            'updated_by'=> Auth::user()->id,
            'alphabet'=> $in,
        ]);
        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Протокола е добавен успешно!');
        return Redirect::to('/друг-обект-протокол/'.$protocol->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}
}
