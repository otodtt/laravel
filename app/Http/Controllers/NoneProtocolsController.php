<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Area;
use odbh\Http\Requests;
use odbh\Http\Requests\NoneObjectRequest;
use odbh\Http\Requests\NoneObjectUpdateRequest;
use odbh\Location;
use odbh\NoneProtocol;
use odbh\Sample;
use odbh\Set;
use odbh\User;
use Redirect;
use Session;

class NoneProtocolsController extends Controller
{
    private $logo = null;

    private $ph_area_sort = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * NoneProtocolsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control');

        $areas = $this->districts_list->toArray();
        $areas[''] = 'Избери община';
        $areas = array_sort_recursive($areas);
        $this->ph_area_list = $areas;

        $this->logo = Set::all()->toArray();

        $areas_sort = $this->districts_list->toArray();
        $areas_sort[0] = 'Сортирай по община';
        $areas_sort = array_sort_recursive($areas_sort);
        $this->ph_area_sort = $areas_sort;

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
        $inspectors_db_all = NoneProtocol::select('inspector_name', 'inspector', 'inspector_two_name', 'inspector_two', 'inspector_three_name', 'inspector_three')
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
        $alphabet = NoneProtocol::lists('alphabet')->toArray();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $areas = $this->ph_area_sort;

        $protocols = NoneProtocol::all()->sortBy('date_protocol');

        return view('protocols.none.index', compact('alphabet', 'protocols', 'abc', 'inspectors', 'areas'));
    }

    /**
     * Показва всички области, общини и населени места
     * използва се пр jQuery и Ajax заявките
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @return \Illuminate\Http\JsonResponse
     */
    public function locations(Request $request)
    {
        $id_district = filter_input(INPUT_POST, 'val1');

        $selected_array = Set::select('area_id')->get()->toArray();
        $selected = $selected_array[0]['area_id'];

        $locations_js = Location::select()
            ->where('areas_id', '=', $selected)
            ->where('district_id', '=', $id_district)
            ->where('tvm', '!=', 0)
            ->orderBy('tvm', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        foreach ($locations_js as $local) {
            $return_locals[] = '<option value="' . $local->name . '" data_id1="' . $local->id . '" data_ekatte1="' . $local->ekatte . '"
                data_tmv1="' . $local->tvm . '" data_pc1="' . $local->postal_code . '" areas_id2="' . $local->areas_id . '"
                district_id2="' . $local->district_id . '" >' . $local->name . '</option>';
        }

        if ($request->ajax()) {
            return response()->json([
                $return_locals
            ]);
        }
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
            $protocols = NoneProtocol::where('number', '=', $request['search_protocols'])->get();
        };

        $areas = $this->ph_area_sort;

        $abc = null;
        $alphabet = NoneProtocol::lists('alphabet')->toArray();

        return view('protocols.none.index', compact('alphabet', 'protocols', 'abc', 'inspectors', 'areas'));
    }

    /**
     * Сортиране на Протоколите
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $areas_sort
     * @param  int $assay_sort
     * @param  int $inspector_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $abc_list = null, $start_year = null, $end_year = null, $areas_sort = null,
                         $inspector_sort = null, $assay_sort = null)
    {
        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $alphabet = NoneProtocol::lists('alphabet')->toArray();
        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('areas_sort')
            || Input::has('inspector_sort') || Input::has('abc') || Input::has('assay_sort')
        ) {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_areas = Input::get('areas_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
        } else {
            $abc = $abc_list;
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_areas = $areas_sort;
            $sort_inspector = $inspector_sort;
            $sort_assay = $assay_sort;
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

        /** Сортиране по община **/
        if (isset($sort_areas) && (int)$sort_areas > 0) {
            $areas_sql = ' AND district_object=' . $sort_areas;
        } else {
            $areas_sql = ' ';
        }
        /** Сортиране по Инспектори **/
        if (isset($sort_inspector) && (int)$sort_inspector > 0) {
            $inspector_sql = ' AND inspector= ' . $sort_inspector;
        } else {
            $inspector_sql = '';
        }
        /** Сортиране по взета проба и нарушения **/
        if (isset($sort_assay) && (int)$sort_assay == 1) {
            $assay_sql = ' AND assay > 0';
        }

        elseif (isset($sort_assay) && (int)$sort_assay == 2) {
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

        $protocols = DB::select("SELECT * FROM none_objects WHERE id>0  $years_sql $areas_sql $inspector_sql
                                $assay_sql $abc_sql ORDER BY date_protocol ASC ");

        return view('protocols.none.index', compact('protocols', 'alphabet', 'abc', 'years_start_sort', 'years_end_sort',
            'inspectors', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay'));
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


        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$selected_session)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $selected_array[0]['area_id'];
        }

        $regions = Area::lists('areas_name', 'id');

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

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

        $object_district = $this->ph_area_list;

        $get_object_location = Session::get('_old_input', 'localsObject');
        if (!empty($get_object_location['localsObject'])) {
            $selected = $get_object_location['localsObject'];

            $object_locations = Location::select()
                ->where('areas_id', '=', $this->area_get_id)
                ->where('district_id', '=', $selected)
                ->where('tvm', '!=', 0)
                ->orderBy('tvm', 'asc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();

        }
        else {
            $object_locations = Location::select()
                ->where('areas_id', '=', $this->area_get_id)
                ->where('tvm', '!=', 0)
                ->orderBy('tvm', 'asc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        return view('protocols.none.create', compact('inspectors', 'selected', 'regions', 'district_list', 'locations',
            'object_locations', 'object_district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\NoneObjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NoneObjectRequest $request)
    {
        $sex = null;
        $sex_owner = null;
        $in = null;
        if($request['firm'] == 1){
            $name = $request['name'];
        }
        else{
            $name = $request['name_firm'];
        }
        ///// SEX
        if(strlen($request['gender']) == 4){
            $sex = 1;
        }
        elseif(strlen($request['gender']) == 6){
            $sex = 2;
        }
        else{
            $sex = 0;
        }
        ///// SEX OWNER
        if(strlen($request['gender_owner']) == 4){
            $sex_owner = 1;
        }
        elseif(strlen($request['gender_owner']) == 6){
            $sex_owner = 2;
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

        $abc= trim(preg_replace("/[0-9]/", "", $name));
        $abc1= trim(preg_replace("/-/", "", $abc));
        $abc2= trim(preg_replace("/.]/", "", $abc1));
        $abc3 = mb_substr($abc2, 0, 1);
        foreach ($cyrillic as $k=>$v){
            if(preg_match("/$abc3/iu", "$v")){
                $in=$k;
            }
        }
        $data = ([
            'type_check'=> $request['type_check'],
            'number'=> $request['number'],
            'date_protocol'=> strtotime($request['date_protocol']),
            'inspector'=> $request['inspector'],
            'inspector_two'=> $request['inspector_two'],
            'inspector_three'=> $request['inspector_three'],
            'inspector_another'=> $request['inspector_another'],
            'inspector_from'=> $request['inspector_from'],
            'firm'=> $request['firm'],
            'name'=> $name,
            'sex'=> $sex,
            'pin'=> $request['pin'],
            'bulstat'=> $request['bulstat'],
            'owner'=> $request['owner'],
            'pin_owner'=> $request['pin_owner'],
            'sex_owner'=> $sex_owner,
            'id_region'=> $request['areasID'],
            'district'=> $request['localsID'],
            'id_location'=> $request['data_id'],
            'city_village'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'address'=> $request['address'],
            'violation'=> $request['violation'],
            'ascertainment'=> $request['ascertainment'],
            'taken'=> $request['taken'],
            'order_protocol'=> $request['order_protocol'],
            'act'=> $request['act'],
            'assay'=> $request['assay_tor'],
            'district_object'=> $request['localsObject'],
            'cv_object'=> $request['data_tmv1'],
            'address_object'=> $request['address_object'],
            'location_object'=> $request['list_name_ob'],
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

        NoneProtocol::create($data);

        if ($request['firm'] == 1) {
            $et = 'ФЛ';
            $ood = '';
        }
        elseif ($request['firm'] == 2) {
            $et = 'ET';
            $ood = '';
        }
        elseif ($request['firm'] == 3) {
            $et = '';
            $ood = 'ООД';
        }
        elseif ($request['firm'] == 4) {
            $et = '';
            $ood = 'ЕООД';
        }
        elseif ($request['firm'] == 5) {
            $et = '';
            $ood = 'АД';
        }
        else {
            $et = '';
            $ood = '';
        }

        if($request['assay_tor']==1){
            $data_assay_tor = ([
                'number_sample'=>$request['number'],
                'date_number'=>strtotime(stripslashes($request['date_protocol'])),
                'from_firm'=>$et.' "'.$name.'" '.$ood,
                'from_object'=>100,
                'name'=>$request['tor_name'],
                'active_subs'=>$request['tor_av'],
                'eo'=>$request['eo_tor'],
                'inspector'=>$inspector_name,
                'type_assay'=>2,
            ]);
            Sample::create($data_assay_tor);
        }

        if($request['assay_tor']==1){
            Session::flash('message', 'Протокола и взетите проби са добавени успешно!');
            return Redirect::to('/протоколи-обекти');
        }
        else{
            Session::flash('message', 'Протокола е добавен успешно!');
            return Redirect::to('/протоколи-обекти');
        }
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
        $protocol = NoneProtocol::findOrFail($id);
        $inspectors = User::get();
        $city = Set::first();

        $areas = $this->areas_all;
        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $protocol->id_region)
            ->where('type_district', '=', 1)
            ->get();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $city->area_id)
            ->where('type_district', '=', 1)
            ->get();


        if($protocol->assay == 1){
            $tor = Sample::where('number_sample','=',$protocol->number)
                ->where('date_number','=',$protocol->date_protocol)
                ->where('type_assay','=',2)
                ->get();
        }

        return view('protocols.none.show', compact('logo', 'protocol', 'inspectors', 'city', 'areas', 'districts_firm', 'districts_object'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocols = NoneProtocol::findOrFail($id);

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = '';
        $inspectors = array_sort_recursive($inspectors);

        $selected_array = Set::select('area_id')->get()->toArray();
        $selected_session = $selected_array[0]['area_id'];


        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$selected_session)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $protocols->id_region;
        }

        $regions = Area::lists('areas_name', 'id');

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

        $selected_district = $protocols->district;

        $get_district = Session::get('_old_input', 'localsID');
        if(!isset($get_district['localsID']) || $get_district['localsID']==0){
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('district_id', '=', $protocols->district)
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
        $firm_location = $protocols->location;

        /// За обектите
        $object_district = $this->ph_area_list;

        $get_object_location = Session::get('_old_input', 'localsObject');
        if (!empty($get_object_location['localsObject'])) {
            $selected = $get_object_location['localsObject'];

            $object_locations = Location::select()
                ->where('areas_id', '=', $this->area_get_id)
                ->where('district_id', '=', $selected)
                ->where('tvm', '!=', 0)
                ->orderBy('tvm', 'asc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();

        }
        else {
            $object_locations = Location::select()
                ->where('areas_id', '=', $this->area_get_id)
                ->where('district_id', '=', $protocols->district_object)
                ->where('tvm', '!=', 0)
                ->orderBy('tvm', 'asc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        return view('protocols.none.edit', compact('inspectors', 'selected', 'regions', 'district_list', 'locations',
            'object_locations', 'object_district', 'protocols', 'selected_district', 'firm_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\NoneObjectUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoneObjectUpdateRequest $request, $id)
    {
        $protocol = NoneProtocol::findOrFail($id);
        if($request['firm'] == 1){
            $name = $request['name'];
        }
        else{
            $name = $request['name_firm'];
        }
        ///// SEX
        if(strlen($request['gender']) == 4){
            $sex = 1;
        }
        elseif(strlen($request['gender']) == 6){
            $sex = 2;
        }
        else{
            $sex = 0;
        }
        ///// SEX OWNER
        if(strlen($request['gender_owner']) == 4){
            $sex_owner = 1;
        }
        elseif(strlen($request['gender_owner']) == 6){
            $sex_owner = 2;
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

        $abc= trim(preg_replace("/[0-9]/", "", $name));
        $abc1= trim(preg_replace("/-/", "", $abc));
        $abc2= trim(preg_replace("/.]/", "", $abc1));
        $abc3 = mb_substr($abc2, 0, 1);
        $in = null;
        foreach ($cyrillic as $k=>$v){
            if(preg_match("/$abc3/iu", "$v")){
                $in=$k;
            }
        }
        $data = ([
            'type_check'=> $request['type_check'],
            'number'=> $request['number'],
            'date_protocol'=> strtotime($request['date_protocol']),
            'inspector'=> $request['inspector'],
            'inspector_two'=> $request['inspector_two'],
            'inspector_three'=> $request['inspector_three'],
            'inspector_another'=> $request['inspector_another'],
            'inspector_from'=> $request['inspector_from'],
            'firm'=> $request['firm'],
            'name'=> $name,
            'sex'=> $sex,
            'pin'=> $request['pin'],
            'bulstat'=> $request['bulstat'],
            'owner'=> $request['owner'],
            'pin_owner'=> $request['pin_owner'],
            'sex_owner'=> $sex_owner,

            'id_region'=> $request['areasID'],
            'district'=> $request['localsID'],
            'id_location'=> $request['data_id'],
            'city_village'=> $request['data_tmv'],
            'location'=> $request['list_name'],

            'address'=> $request['address'],
            'violation'=> $request['violation'],
            'ascertainment'=> $request['ascertainment'],
            'taken'=> $request['taken'],
            'order_protocol'=> $request['order_protocol'],
            'act'=> $request['act'],
            'assay'=> $request['assay_tor'],
            'district_object'=> $request['localsObject'],
            'cv_object'=> $request['data_tmv1'],
            'address_object'=> $request['address_object'],
            'location_object'=> $request['list_name_ob'],
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

        Session::flash('message', 'Протокола е редактиран успешно!');
        return Redirect::to('/протокол-обект/'.$id);
    }

    /**
     * Добавя проби от ТОР.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add_tor_none(Request $request, $id)
    {
        $this->validate($request, [
            'tor_name' => 'required:',
            'tor_av' => 'required:',
            'eo_tor' => 'required:',
        ]);
        $protocol = NoneProtocol::findOrFail($id);
        if ($protocol->firm == 1) {
            $et = 'ET';
            $ood = '';
        } elseif ($protocol->firm == 2) {
            $et = '';
            $ood = 'ООД';
        } elseif ($protocol->firm == 3) {
            $et = '';
            $ood = 'ЕООД';
        } elseif ($protocol->firm == 4) {
            $et = '';
            $ood = 'АД';
        } else {
            $et = '';
            $ood = '';
        }
        $data_assay_tor = ([
            'number_sample'=>$protocol->number,
            'date_number'=>$protocol->date_protocol,
            'from_firm'=>$et.' "'.$protocol->name.'" '.$ood,
            'from_object'=>$protocol->ot,
            'name'=>$request['tor_name'],
            'active_subs'=>$request['tor_av'],
            'eo'=>$request['eo_tor'],
            'inspector'=>$protocol->inspector_name,
            'type_assay'=>2,
        ]);

        Sample::create($data_assay_tor);

        $data = (['assay'=>1]);
        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Пробата от ПРЗ е добавена успешно!');
        return Redirect::to('/протокол-обект/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}
}
