<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Area;
use odbh\Director;
use odbh\Farmer;
use odbh\FarmerProtocol;
use odbh\Http\Requests;
use odbh\Http\Requests\OpinionAdminRequest;
use odbh\Http\Requests\OpinionEditRequest;
use odbh\Http\Requests\OpinionExistRequest;
use odbh\Http\Requests\OpinionNewRequest;
use odbh\Location;
use odbh\Opinion;
use odbh\Set;
use odbh\SetOpinion;
use odbh\User;
use Redirect;
use Session;

class OpinionsController extends Controller
{
    private $logo = null;

    private $index = null;

    private $ph_area_sort = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    ////За мярките
    private $opinions_all = null;

    private $opinions_show = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy', 'new_create', 'new_store',
                                        'search_farmer', 'farmer_request']]);
        $this->middleware('admin', ['only'=>['edit_admin', 'update_admin', 'destroy']]);

        $this->logo = Set::all()->toArray();

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();

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
        $inspectors_db_all = Opinion::select('inspector_name', 'inspector_id')->where('inspector_id','!=',0)->get()->toArray();
        foreach($inspectors_db_all as $value){
            $inspectors_db[$value['inspector_id']] = $value['inspector_name'];
        }
        $this->inspectors_edit_db = array_sort_recursive($inspectors_active) + array_sort_recursive($inspectors_db);

        //////// ЗА МЕРКИТЕ
        /** Вички мерки  */
        $this->opinions_all = SetOpinion::lists('short_name', 'id')->toArray();
        /** Само маркираните с ДА  */
        $this->opinions_show = SetOpinion::where('show_rate','=',1)->lists('short_name', 'id')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = $this->ph_area_sort;

        $abc = null;
        $alphabet = Opinion::lists('alphabet')->toArray();
        $opinions = Opinion::select('id', 'index_opinion', 'number_opinion', 'date_opinion', 'pin', 'name', 'alphabet',
            'opinion_name', 'type_opinion', 'location', 'address', 'district_object', 'inspector_id', 'inspector_name',
            'opinion_name_short', 'number_protocol', 'date_protocol')->orderBy('date_opinion', 'asc')->get();

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $districts_objects = $districts->toArray();

        return view('opinions.new.index', compact('opinions', 'districts_list', 'alphabet', 'abc', 'areas', 'inspectors', 'type_opinion', 'districts_objects'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ((int)$request['search_hidden'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            if($request['search'] == 1){
                $opinions = Opinion::where('number_opinion', '=', $request['search_protocols'])->get();
            }
            if($request['search'] == 2){
                $opinions = Opinion::where('number_protocol', '=', $request['search_protocols'])->get();
            }
        }

        $areas = $this->ph_area_sort;

        $abc = null;
        $alphabet = Opinion::lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $districts_objects = $districts->toArray();

        return view('opinions.new.index', compact('opinions', 'districts_list', 'alphabet', 'abc', 'areas', 'inspectors', 'type_opinion', 'districts_objects'));
    }

    /**
     * Сортиране на Становищата
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $object_sort
     * @param  int $areas_sort
     * @param  int $assay_sort
     * @param  int $inspector_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $abc_list = null, $start_year = null, $end_year = null, $object_sort = null,
                         $areas_sort = null, $inspector_sort = null, $assay_sort = null)
    {
        $areas = $this->ph_area_sort;

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $districts_objects = $districts->toArray();

        $alphabet = Opinion::lists('alphabet')->toArray();
        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('ot_object') || Input::has('areas_sort')
            || Input::has('inspector_sort') || Input::has('abc') || Input::has('assay_sort')
        ) {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_object = Input::get('ot_object');
            $sort_areas = Input::get('areas_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
        }
        else {
            $abc = $abc_list;
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_object = $object_sort;
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
                $years_sql = ' AND date_opinion=' . $start . ' OR date_opinion=' . $timezone_paris_start;
            }
            if ($end > 0 && $start == false) {
                $years_sql = ' AND date_opinion=' . $end . ' OR date_opinion=' . $timezone_paris_end;
            }
            if (((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)) {
                $years_sql = ' AND date_opinion=' . $start . ' OR date_opinion=' . $timezone_paris_start;
            }
            if (((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)) {
                $years_sql = ' AND date_opinion>=' . $start . ' AND date_opinion<=' . $end . '';
            }
            if (($start > 0 && $end > 0) && ($start > $end)) {
                $years_sql = ' AND date_opinion>=' . $end . ' AND date_opinion<=' . $start . '';
            }
        } else {
            $years_sql = ' ';
        }
        /** Сортиране по вид на обект **/
        if (isset($sort_object) && (int)$sort_object > 0) {
            $object_sql = ' AND type_opinion='. $sort_object;
        } else {
            $object_sql = ' ';
        }
        /** Сортиране по община **/
        if (isset($sort_areas) && (int)$sort_areas > 0) {
            $areas_sql = ' AND district_object=' . $sort_areas;
        } else {
            $areas_sql = ' ';
        }
        /** Сортиране по Инспектори **/
        if (isset($sort_inspector) && (int)$sort_inspector > 0) {
            $inspector_sql = ' AND inspector_id= ' . $sort_inspector;
        } else {
            $inspector_sql = '';
        }
        /** Сортиране по взета проба и нарушения **/
        if (isset($sort_assay) && (int)$sort_assay == 1) {
            $assay_sql = ' AND number_protocol > 0';
        }
        elseif (isset($sort_assay) && (int)$sort_assay == 2) {
            $assay_sql = ' AND number_protocol = 0';
        }

        else {
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

        $opinions = DB::select("SELECT * FROM opinions WHERE id>0
          $years_sql $object_sql $areas_sql $inspector_sql $assay_sql $abc_sql
          ORDER BY `date_opinion` ASC, `number_opinion` ASC" );

        return view('opinions.new.index', compact('opinions', 'districts_list', 'alphabet', 'abc', 'areas', 'inspectors', 'districts_objects',
            'type_opinion', 'sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @param  int  $type
     * @return \Illuminate\Http\Response
     */
    public function create($id, $type = null)
    {
        $opinions = $this->opinions_show;
        $opinions[0] = '-- мярка --';
        $opinions = array_sort_recursive($opinions);

        $farmer = Farmer::findOrFail($id);

        $areas_name = Area::select('areas_name')->where('id','=',$farmer->areas_id)->get()->toArray();
        $district_name = Location::select('name')->where('areas_id','=',$farmer->areas_id)
                                                ->where('district_id','=',$farmer->district_id)
                                                ->where('type_district','=',1)
                                                ->get()->toArray();

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Избери община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = $this->inspectors_active_rz_list->toArray();
        $inspectors[0] = 'инспектор';
        $inspectors = array_sort_recursive($inspectors);
        //////////////////////////////////////////////////////////
        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$farmer->areas_id)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $farmer->areas_id;
        }
        $regions = $this->areas_all_list;
        /////////////////  За Общините
        $get_session_area = Session::get('_old_input', 'district_id');
        if(isset($get_session_area['district_id'])){
            $selected_district = $get_session_area['district_id'];
        }
        else{
            $selected_district = $farmer->district_id;
        }

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

        $locations = Location::select()
            ->where('areas_id', '=', $selected)
            ->where('district_id', '=', $selected_district)
            ->where('tvm', '!=', 0)
            ->orderBy('type_district', 'desc')
            ->orderBy('district_id', 'asc')
            ->get()->toArray();

        $name_location = $farmer->location;

        return view('opinions.new.create_exist', compact('opinions', 'farmer', 'areas_name', 'district_name', 'districts_list',
                    'inspectors', 'type', 'regions', 'selected', 'district_list', 'locations', 'name_location', 'selected_district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \odbh\Http\Requests\OpinionExistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpinionExistRequest $request, $id)
    {
        $number_protocol = null;
        $date_protocol = null;
        $user_protocol = null;
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $inspector_name_protocol = null;
        $position_protocol = null;
        $position_short_protocol = null;

        $farmer = Farmer::findOrFail($id);

        $index_in = Set::select('index_in')->get()->toArray();

        $inspector_name_sql1 = User::where('id', '=', $request['inspectors'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        $opinions = SetOpinion::where('id','=',$request['opinion'])->get()->toArray();
        $opinion_name = $opinions[0]['full_name'];
        $opinion_name_short = $opinions[0]['short_name'];
        $period = $opinions[0]['period'];

        if($request['type_firm'] == 1){
            $data_farmer = ([
                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'tvm'=>$request['data_tmv'],
                'city_id'=>$request['data_id'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],

                'phone'=>$request['phone'],
                'mobil'=>$request['mobil'],
                'email'=>$request['email'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'date_update'=>time(),
                'updated_by'=> Auth::user()->id,
            ]);
            $farmer->fill($data_farmer);
            $farmer->save();

            $sex = $farmer->sex;
            $pin = $farmer->pin;
            $eik = 0;
            $egn_eik = 1;
            $owner = '';
        }
        if($request['type_firm'] > 1){
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
            $data_firm = ([
                'owner'=>$request['owner'],
                'pin_owner'=>$request['pin_owner'],
                'sex_owner'=>$sex_owner,

                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'tvm'=>$request['data_tmv'],
                'city_id'=>$request['data_id'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],

                'phone'=>$request['phone'],
                'mobil'=>$request['mobil'],
                'email'=>$request['email'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'date_update'=>time(),
                'updated_by'=> Auth::user()->id,
            ]);
            $farmer->fill($data_firm);
            $farmer->save();

            $sex = 0;
            $pin = $farmer->pin;
            $eik = $farmer->bulstat;
            $egn_eik = 2;
            $owner = $request['owner'];
        }

        if($request['has_protocol'] == 0){
            $number_protocol = 0;
            $date_protocol = 0;
            $user_protocol = 0;
        }
        if($request['has_protocol'] == 1){
            $number_protocol = $request['number_protocol'];
            $date_protocol = strtotime($request['date_protocol']);
            $user_protocol = $request['inspectors_protocol'];

            $inspector_name_protocol_sql = User::where('id', '=', $request['inspectors_protocol'])->get()->toArray();
            $inspector_name_protocol = $inspector_name_protocol_sql[0]['short_name'];
            $position_protocol = $inspector_name_protocol_sql[0]['position'];
            $position_short_protocol = $inspector_name_protocol_sql[0]['position_short'];
        }
        if(isset($request['assay_no']) && $request['assay_no'] == 0){
            $assay = 0;
            $assay_more = 0;
            $assay_prz = 0;
            $assay_tor = 0;
            $assay_metal = 0;
            $assay_micro = 0;
            $assay_other = 0;
        }
        else{
            $assay = 1;
            ///// assay_more
            if(isset($request['assay_more'])){
                $assay_more = $request['assay_more'];
            }
            else{
                $assay_more = 0;
            }
            ///// assay_prz
            if(isset($request['assay_prz'])){
                $assay_prz = $request['assay_prz'];
            }
            else{
                $assay_prz = 0;
            }
            ///// assay_tor
            if(isset($request['assay_tor'])){
                $assay_tor = $request['assay_tor'];
            }
            else{
                $assay_tor = 0;
            }
            ///// assay_metal
            if(isset($request['assay_metal'])){
                $assay_metal = $request['assay_metal'];
            }
            else{
                $assay_metal = 0;
            }
            ///// assay_micro
            if(isset($request['assay_micro'])){
                $assay_micro = $request['assay_micro'];
            }
            else{
                $assay_micro = 0;
            }
            ///// assay_other
            if(isset($request['assay_other'])){
                $assay_other = $request['assay_other'];
            }
            else{
                $assay_other = 0;
            }
        }


        $data = ([
            'index_petition'=>$index_in[0]['index_in'],
            'number_petition'=>$request['number_petition'],
            'date_petition'=>strtotime($request['date_petition']),
            'invoice'=>$request['invoice'],
            'invoice_date'=>strtotime($request['invoice_date']),

            'type_opinion'=>$request['opinion'],
            'period'=>$period,
            'opinion_name'=>$opinion_name,
            'opinion_name_short'=>$opinion_name_short,

            'type_firm'=>$farmer->type_firm,
            'name'=>$farmer->name,
            'sex'=>$sex,
            'pin'=>$pin,
            'eik'=>$eik,
            'egn_eik'=>$egn_eik,
            'owner'=>$owner,

            'areas_id'=>$request['areasID'],
            'district_id'=>$request['district_id'],
            'tvm'=>$request['data_tmv'],
            'city_id'=>$request['data_id'],
            'location'=>$request['list_name'],
            'address'=>$request['address'],

            'district_object'=>$request['district_object'],
            'object_name'=>$request['object_name'],
            'number_protocol'=>$number_protocol,
            'date_protocol'=>$date_protocol,
            'user_protocol'=>$user_protocol,
            'inspector_id'=>$request['inspectors'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,
            'alphabet'=>$farmer->alphabet,
            'date_add'=>time(),
            'added_by'=>Auth::user()->id,
            'assay_no'=>$assay,
            'yes'=>$request['yes'],
            'type_check'=>$request['type_check'],
        ]);

        $opinion_save = new Opinion($data);
        $farmer->opinions()->save($opinion_save);
        $last_opinion_id = $opinion_save->id;

        if($request['has_protocol'] == 1){
            $data_protocol = ([
                'opinion_id'=>$last_opinion_id,
                'number_protocol'=>$number_protocol,
                'date_protocol'=>$date_protocol,
                'inspector'=>$user_protocol,
                'inspector_two'=>0,
                'inspector_three'=>0,
                'opinions'=>$request['opinion'],
                'description'=>$opinion_name_short,
                'firm'=>$farmer->type_firm,
                'name'=>$farmer->name,
                'sex'=>$sex,
                'pin'=>$pin,
                'bulstat'=>$eik,
                'egn_eik'=>$egn_eik,
                'owner'=>$owner,
                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'city_id'=>$request['data_id'],
                'tvm'=>$request['data_tmv'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'assay_more'=>$assay_more,
                'assay_prz'=>$assay_prz,
                'assay_tor'=>$assay_tor,
                'assay_metal'=>$assay_metal,
                'assay_micro'=>$assay_micro,
                'assay_other'=>$assay_other,

                'type_check'=>$request['type_check'],
                'inspector_name'=>$inspector_name_protocol,
                'position'=>$position_protocol,
                'position_short'=>$position_short_protocol,

                'alphabet'=>$farmer->alphabet,
                'date_add'=>time(),
                'added_by'=>Auth::user()->id,
            ]);
            $protocol_save = new FarmerProtocol($data_protocol);
            $farmer->protocols()->save($protocol_save);
        }

        Session::flash('message', 'Становището е добавено успешно!');
        return Redirect::to('/становище/'.$last_opinion_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function new_create(Request $request)
    {
        $firm = $request['firm'];
        $name = $request['name'];
        $pin = $request['pin'];
        $gender = $request['gender'];
        $name_firm = $request['name_firm'];
        $eik = $request['eik'];

        $opinions = $this->opinions_show;
        $opinions[0] = '-- мярка --';
        $opinions = array_sort_recursive($opinions);

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Избери община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = $this->inspectors_active_rz_list->toArray();
        $inspectors[0] = 'инспектор';
        $inspectors = array_sort_recursive($inspectors);
        //////////////////////////////////////////////////////////
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

        /////////////////  За Общините
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
        } else {
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('district_id', '=', $get_district['localsID'])
                ->where('tvm', '!=', 0)
                ->orderBy('type_district', 'desc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        return view('opinions.new.create_new', compact('opinions', 'farmer', 'areas_name', 'district_name', 'districts_list', 'eik',
            'inspectors', 'type', 'regions', 'selected', 'district_list', 'locations', 'firm', 'name', 'pin', 'gender', 'name_firm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param  \odbh\Http\Requests\OpinionNewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function new_store(OpinionNewRequest $request)
    {
        $number_protocol = null;
        $date_protocol = null;
        $user_protocol = null;
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;
        $pin_owner = null;
        $sex_owner = null;
        $in = null;
        $inspector_name_protocol = null;
        $position_protocol = null;
        $position_short_protocol = null;

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

        $index_in = Set::select('index_in')->get()->toArray();

        $inspector_name_sql1 = User::where('id', '=', $request['inspectors'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        $opinions = SetOpinion::where('id','=',$request['opinion'])->get()->toArray();
        $opinion_name = $opinions[0]['full_name'];
        $opinion_name_short = $opinions[0]['short_name'];
        $period = $opinions[0]['period'];

        if($request['type_firm'] == 1){
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
        }
        if($request['type_firm'] > 1){
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
        }

        $data_firm = ([
            'type_firm'=>$request['type_firm'],
            'name'=>$request['name'],
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
            'location_farm'=>$request['object_name'],

            'phone'=>$request['phone'],
            'mobil'=>$request['mobil'],
            'email'=>$request['email'],

            'date_add'=>time(),
            'added_by'=> Auth::user()->id,

            'alphabet'=>$in,
        ]);

        $farmer = Farmer::create($data_firm);
        $insertedId = $farmer->id;

        $new_farmer = Farmer::findOrFail($insertedId);

        if($request['has_protocol'] == 0){
            $number_protocol = 0;
            $date_protocol = 0;
            $user_protocol = 0;
        }
        if($request['has_protocol'] == 1){
            $number_protocol = $request['number_protocol'];
            $date_protocol = strtotime($request['date_protocol']);
            $user_protocol = $request['inspectors_protocol'];

            $inspector_name_protocol_sql = User::where('id', '=', $request['inspectors_protocol'])->get()->toArray();
            $inspector_name_protocol = $inspector_name_protocol_sql[0]['short_name'];
            $position_protocol = $inspector_name_protocol_sql[0]['position'];
            $position_short_protocol = $inspector_name_protocol_sql[0]['position_short'];
        }

        if(isset($request['assay_no']) && $request['assay_no'] == 0){
            $assay = 0;
            $assay_more = 0;
            $assay_prz = 0;
            $assay_tor = 0;
            $assay_metal = 0;
            $assay_micro = 0;
            $assay_other = 0;
        }
        else{
            $assay = 1;
            ///// assay_more
            if(isset($request['assay_more'])){
                $assay_more = $request['assay_more'];
            }
            else{
                $assay_more = 0;
            }
            ///// assay_prz
            if(isset($request['assay_prz'])){
                $assay_prz = $request['assay_prz'];
            }
            else{
                $assay_prz = 0;
            }
            ///// assay_tor
            if(isset($request['assay_tor'])){
                $assay_tor = $request['assay_tor'];
            }
            else{
                $assay_tor = 0;
            }
            ///// assay_metal
            if(isset($request['assay_metal'])){
                $assay_metal = $request['assay_metal'];
            }
            else{
                $assay_metal = 0;
            }
            ///// assay_micro
            if(isset($request['assay_micro'])){
                $assay_micro = $request['assay_micro'];
            }
            else{
                $assay_micro = 0;
            }
            ///// assay_other
            if(isset($request['assay_other'])){
                $assay_other = $request['assay_other'];
            }
            else{
                $assay_other = 0;
            }
        }

        $data = ([
            'index_petition'=>$index_in[0]['index_in'],
            'number_petition'=>$request['number_petition'],
            'date_petition'=>strtotime($request['date_petition']),
            'invoice'=>$request['invoice'],
            'invoice_date'=>strtotime($request['invoice_date']),

            'type_opinion'=>$request['opinion'],
            'period'=>$period,
            'opinion_name'=>$opinion_name,
            'opinion_name_short'=>$opinion_name_short,

            'type_firm'=>$request['type_firm'],
            'name'=>$request['name'],
            'sex'=>$sex,
            'pin'=>$pin,
            'eik'=>$eik,
            'egn_eik'=>$egn_eik,
            'owner'=>$owner,

            'areas_id'=>$request['areasID'],
            'district_id'=>$request['district_id'],
            'tvm'=>$request['data_tmv'],
            'city_id'=>$request['data_id'],
            'location'=>$request['list_name'],
            'address'=>$request['address'],

            'district_object'=>$request['district_object'],
            'object_name'=>$request['object_name'],
            'number_protocol'=>$number_protocol,
            'date_protocol'=>$date_protocol,
            'user_protocol'=>$user_protocol,

            'inspector_id'=>$request['inspectors'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,

            'alphabet'=>$in,
            'date_add'=>time(),
            'added_by'=> Auth::user()->id,
            'assay_no'=>$assay,
            'yes'=>$request['yes'],
            'type_check'=>$request['type_check'],
        ]);

        $opinion_save = new Opinion($data);
        $new_farmer->opinions()->save($opinion_save);
        $last_opinion_id = $opinion_save->id;

        if($request['has_protocol'] == 1){
            $data_protocol = ([
                'opinion_id'=>$last_opinion_id,

                'number_protocol'=>$number_protocol,
                'date_protocol'=>$date_protocol,
                'inspector'=>$user_protocol,
                'inspector_two'=>0,
                'inspector_three'=>0,
                'opinions'=>$request['opinion'],
                'description'=>$opinion_name_short,

                'firm'=>$request['type_firm'],
                'name'=>$request['name'],
                'sex'=>$sex,
                'pin'=>$pin,
                'bulstat'=>$eik,
                'egn_eik'=>$egn_eik,
                'owner'=>$owner,
                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'city_id'=>$request['data_id'],
                'tvm'=>$request['data_tmv'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'assay_more'=>$assay_more,
                'assay_prz'=>$assay_prz,
                'assay_tor'=>$assay_tor,
                'assay_metal'=>$assay_metal,
                'assay_micro'=>$assay_micro,
                'assay_other'=>$assay_other,

                'type_check'=>$request['type_check'],
                'inspector_name'=>$inspector_name_protocol,
                'position'=>$position_protocol,
                'position_short'=>$position_short_protocol,

                'alphabet'=>$in,
                'date_add'=>time(),
                'added_by'=>Auth::user()->id,
            ]);
            $protocol_save = new FarmerProtocol($data_protocol);
            $new_farmer->protocols()->save($protocol_save);
        }

        Session::flash('message', 'Становището е добавено успешно!');
        return Redirect::to('/становище/'.$last_opinion_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opinion = Opinion::findOrFail($id);
        $farmer = Farmer::findOrFail($opinion->farmer_id);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $inspectors = $this->inspectors_active_rz_list->toArray();
        $inspectors[0] = 'инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $logo = $this->logo;
        $index = $this->index;

        $area = Area::select('areas_name', 'odbh_name', 'city')->where('id','=',$opinion->areas_id)->get()->toArray();
        $district = Location::select('name')->where('areas_id','=',$opinion->areas_id)
            ->where('district_id','=',$opinion->district_id)
            ->where('type_district','=',1)
            ->where('tvm', '!=', 0)
            ->get()->toArray();

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$opinion->date_petition)
            ->where('end_date','>=',$opinion->date_petition)
            ->get()->toArray();

        return view('opinions.new.show', compact('opinion', 'farmer', 'districts_farm', 'regions', 'districts', 'inspectors', 'logo',
            'index', 'area', 'district', 'director'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opinion = Opinion::findOrFail($id);

        $opinions = $this->opinions_all;
        $opinions[0] = '-- мярка --';
        $opinions = array_sort_recursive($opinions);

        $farmer = Farmer::findOrFail($opinion->farmer_id);

        $areas_name = Area::select('areas_name')->where('id','=',$farmer->areas_id)->get()->toArray();
        $district_name = Location::select('name')->where('areas_id','=',$farmer->areas_id)
            ->where('district_id','=',$farmer->district_id)
            ->where('type_district','=',1)
            ->get()->toArray();

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Избери община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = $this->inspectors_active_rz_list->toArray();
        $inspectors[0] = 'инспектор';
        $inspectors = array_sort_recursive($inspectors);
        //////////////////////////////////////////////////////////
        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$farmer->areas_id)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $farmer->areas_id;
        }
        $regions = $this->areas_all_list;
        /////////////////  За Общините
        $get_session_area = Session::get('_old_input', 'district_id');
        if(isset($get_session_area['district_id'])){
            $selected_district = $get_session_area['district_id'];
        }
        else{
            $selected_district = $farmer->district_id;
        }

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

        $locations = Location::select()
            ->where('areas_id', '=', $selected)
            ->where('district_id', '=', $selected_district)
            ->where('tvm', '!=', 0)
            ->orderBy('type_district', 'desc')
            ->orderBy('district_id', 'asc')
            ->get()->toArray();

        $name_location = $farmer->location;

        return view('opinions.new.edit', compact('opinions', 'opinion', 'farmer', 'areas_name', 'district_name', 'districts_list',
            'inspectors', 'admin', 'regions', 'selected', 'district_list', 'locations', 'name_location', 'selected_district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\OpinionEditRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OpinionEditRequest $request, $id)
    {
        $number_protocol = null;
        $date_protocol = null;
        $user_protocol = null;
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;

        $opinion_update = Opinion::findOrFail($id);
        $farmer = Farmer::findOrFail($opinion_update->farmer_id);

        $index_in = Set::select('index_in')->get()->toArray();

        $inspector_name_sql1 = User::where('id', '=', $request['inspectors'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        $opinions = SetOpinion::where('id','=',$request['opinion'])->get()->toArray();
        $opinion_name = $opinions[0]['full_name'];
        $opinion_name_short = $opinions[0]['short_name'];
        $period = $opinions[0]['period'];

        if($request['type_firm'] == 1){
            $data_farmer = ([
                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'tvm'=>$request['data_tmv'],
                'city_id'=>$request['data_id'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],

                'phone'=>$request['phone'],
                'mobil'=>$request['mobil'],
                'email'=>$request['email'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'date_update'=>time(),
                'updated_by'=> Auth::user()->id,
            ]);
            $farmer->fill($data_farmer);
            $farmer->save();

            $sex = $farmer->sex;
            $pin = $farmer->pin;
            $eik = 0;
            $egn_eik = 1;
            $owner = '';
        }

        if($request['type_firm'] > 1){
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
            $data_firm = ([
                'owner'=>$request['owner'],
                'pin_owner'=>$request['pin_owner'],
                'sex_owner'=>$sex_owner,

                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'tvm'=>$request['data_tmv'],
                'city_id'=>$request['data_id'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],

                'phone'=>$request['phone'],
                'mobil'=>$request['mobil'],
                'email'=>$request['email'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'date_update'=>time(),
                'updated_by'=> Auth::user()->id,
            ]);
            $farmer->fill($data_firm);
            $farmer->save();

            $sex = 0;
            $pin = $farmer->pin;
            $eik = $farmer->bulstat;
            $egn_eik = 2;
            $owner = $request['owner'];
        }

        $data = ([
            'index_petition'=>$index_in[0]['index_in'],
            'number_petition'=>$request['number_petition'],
            'date_petition'=>strtotime($request['date_petition']),
            'invoice'=>$request['invoice'],
            'invoice_date'=>strtotime($request['invoice_date']),

            'type_opinion'=>$request['opinion'],
            'period'=>$period,
            'opinion_name'=>$opinion_name,
            'opinion_name_short'=>$opinion_name_short,

            'type_firm'=>$farmer->type_firm,
            'name'=>$farmer->name,
            'sex'=>$sex,
            'pin'=>$pin,
            'eik'=>$eik,
            'egn_eik'=>$egn_eik,
            'owner'=>$owner,

            'areas_id'=>$request['areasID'],
            'district_id'=>$request['district_id'],
            'tvm'=>$request['data_tmv'],
            'city_id'=>$request['data_id'],
            'location'=>$request['list_name'],
            'address'=>$request['address'],

            'district_object'=>$request['district_object'],
            'object_name'=>$request['object_name'],

            'inspector_id'=>$request['inspectors'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,
            'alphabet'=>$farmer->alphabet,

            'date_update'=>time(),
            'updated_by'=> Auth::user()->id,

            'yes'=>$request['yes'],
            'type_check'=>$request['type_check'],
        ]);
        $opinion_update->fill($data);
        $opinion_update->save();

        if($opinion_update->number_protocol > 0 && $opinion_update->date_protocol >0){
            $data_protocol = ([
                'opinions'=>$request['opinion'],
                'description'=>$opinion_name_short,
                'firm'=>$farmer->type_firm,
                'name'=>$farmer->name,
                'sex'=>$sex,
                'pin'=>$pin,
                'bulstat'=>$eik,
                'egn_eik'=>$egn_eik,
                'owner'=>$owner,
                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'city_id'=>$request['data_id'],
                'tvm'=>$request['data_tmv'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'alphabet'=>$farmer->alphabet,
                'date_update'=>time(),
                'updated_by'=>Auth::user()->id,
            ]);
            FarmerProtocol::where('opinion_id','=',$opinion_update->id)
                ->where('number_protocol','=',$opinion_update->number_protocol)
                ->update($data_protocol);
        }

        Session::flash('message', 'Становището е редактирано успешно!');
        return Redirect::to('/становище/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_admin($id)
    {
        $opinion = Opinion::findOrFail($id);

        $opinions = $this->opinions_all;
        $opinions[0] = '-- мярка --';
        $opinions = array_sort_recursive($opinions);

        $farmer = Farmer::findOrFail($opinion->farmer_id);

        $areas_name = Area::select('areas_name')->where('id','=',$farmer->areas_id)->get()->toArray();
        $district_name = Location::select('name')->where('areas_id','=',$farmer->areas_id)
            ->where('district_id','=',$farmer->district_id)
            ->where('type_district','=',1)
            ->get()->toArray();

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Избери община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = $this->inspectors_active_rz_list->toArray();
        $inspectors[0] = 'инспектор';
        $inspectors = array_sort_recursive($inspectors);
        //////////////////////////////////////////////////////////
        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$farmer->areas_id)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $farmer->areas_id;
        }
        $regions = $this->areas_all_list;
        /////////////////  За Общините
        $get_session_area = Session::get('_old_input', 'district_id');
        if(isset($get_session_area['district_id'])){
            $selected_district = $get_session_area['district_id'];
        }
        else{
            $selected_district = $farmer->district_id;
        }

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

        $locations = Location::select()
            ->where('areas_id', '=', $selected)
            ->where('district_id', '=', $selected_district)
            ->where('tvm', '!=', 0)
            ->orderBy('type_district', 'desc')
            ->orderBy('district_id', 'asc')
            ->get()->toArray();

        $name_location = $farmer->location;

        return view('opinions.new.edit_admin', compact('opinions', 'opinion', 'farmer', 'areas_name', 'district_name', 'districts_list',
            'inspectors', 'admin', 'regions', 'selected', 'district_list', 'locations', 'name_location', 'selected_district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\OpinionAdminRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_admin(OpinionAdminRequest $request, $id)
    {
        $number_protocol = null;
        $date_protocol = null;
        $user_protocol = null;
        $sex = null;
        $pin = null;
        $eik = null;
        $egn_eik = null;
        $owner = null;

        $opinion_update = Opinion::findOrFail($id);
        $farmer = Farmer::findOrFail($opinion_update->farmer_id);

        $index_in = Set::select('index_in')->get()->toArray();

        $inspector_name_sql1 = User::where('id', '=', $request['inspectors'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        $opinions = SetOpinion::where('id','=',$request['opinion'])->get()->toArray();
        $opinion_name = $opinions[0]['full_name'];
        $opinion_name_short = $opinions[0]['short_name'];
        $period = $opinions[0]['period'];

        if($request['type_firm'] == 1){
            $data_farmer = ([
                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'tvm'=>$request['data_tmv'],
                'city_id'=>$request['data_id'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],

                'phone'=>$request['phone'],
                'mobil'=>$request['mobil'],
                'email'=>$request['email'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'date_update'=>time(),
                'updated_by'=> Auth::user()->id,
            ]);
            $farmer->fill($data_farmer);
            $farmer->save();

            $sex = $farmer->sex;
            $pin = $farmer->pin;
            $eik = 0;
            $egn_eik = 1;
            $owner = '';
        }
        if($request['type_firm'] > 1){
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
            $data_firm = ([
                'owner'=>$request['owner'],
                'pin_owner'=>$request['pin_owner'],
                'sex_owner'=>$sex_owner,

                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'tvm'=>$request['data_tmv'],
                'city_id'=>$request['data_id'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],

                'phone'=>$request['phone'],
                'mobil'=>$request['mobil'],
                'email'=>$request['email'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'date_update'=>time(),
                'updated_by'=> Auth::user()->id,
            ]);
            $farmer->fill($data_firm);
            $farmer->save();

            $sex = 0;
            $pin = $farmer->pin;
            $eik = $farmer->bulstat;
            $egn_eik = 2;
            $owner = $request['owner'];
        }
        ////////
        if(strlen($request['date_opinion']) == 0){
            $date_opinion = 0;
        }
        else{
            $date_opinion = strtotime($request['date_opinion']);
        }
        $data = ([
            'number_opinion'=>$request['number_opinion'],
            'date_opinion'=>$date_opinion,

            'index_petition'=>$index_in[0]['index_in'],
            'number_petition'=>$request['number_petition'],
            'date_petition'=>strtotime($request['date_petition']),
            'invoice'=>$request['invoice'],
            'invoice_date'=>strtotime($request['invoice_date']),

            'type_opinion'=>$request['opinion'],
            'period'=>$period,
            'opinion_name'=>$opinion_name,
            'opinion_name_short'=>$opinion_name_short,

            'type_firm'=>$farmer->type_firm,
            'name'=>$farmer->name,
            'sex'=>$sex,
            'pin'=>$pin,
            'eik'=>$eik,
            'egn_eik'=>$egn_eik,
            'owner'=>$owner,

            'areas_id'=>$request['areasID'],
            'district_id'=>$request['district_id'],
            'tvm'=>$request['data_tmv'],
            'city_id'=>$request['data_id'],
            'location'=>$request['list_name'],
            'address'=>$request['address'],

            'district_object'=>$request['district_object'],
            'object_name'=>$request['object_name'],

            'inspector_id'=>$request['inspectors'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,
            'alphabet'=>$farmer->alphabet,

            'date_update'=>time(),
            'updated_by'=> Auth::user()->id,

            'yes'=>$request['yes'],
            'type_check'=>$request['type_check'],
        ]);
        $opinion_update->fill($data);
        $opinion_update->save();

        if($opinion_update->number_protocol > 0 && $opinion_update->date_protocol >0){
            $data_protocol = ([
                'opinions'=>$request['opinion'],
                'description'=>$opinion_name_short,
                'firm'=>$farmer->type_firm,
                'name'=>$farmer->name,
                'sex'=>$sex,
                'pin'=>$pin,
                'bulstat'=>$eik,
                'egn_eik'=>$egn_eik,
                'owner'=>$owner,
                'areas_id'=>$request['areasID'],
                'district_id'=>$request['district_id'],
                'city_id'=>$request['data_id'],
                'tvm'=>$request['data_tmv'],
                'location'=>$request['list_name'],
                'address'=>$request['address'],
                'district_object'=>$request['district_object'],
                'location_farm'=>$request['object_name'],

                'alphabet'=>$farmer->alphabet,
                'date_update'=>time(),
                'updated_by'=>Auth::user()->id,
            ]);
            FarmerProtocol::where('opinion_id','=',$opinion_update->id)
                ->where('number_protocol','=',$opinion_update->number_protocol)
                ->update($data_protocol);
        }

        Session::flash('message', 'Становището е редактирано успешно!');
        return Redirect::to('/становище/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

    /**
     * Търси в Земеделските производители
     *
     * @return \Illuminate\Http\Response
     */
    public function search_farmer()
    {
        return view('opinions.new.search');
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

        $farmers = null;
        if(isset($request['firm_search']) && $request['firm_search'] == 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->get();
        }
        if(isset($request['firm_search']) && $request['firm_search'] > 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->orWhere('bulstat','=',$eik)->get();
        }

        return view('opinions.new.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers'));
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
                        <div style='width: 50%; display: inline-block'><span><a href='/добави/становище/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ СТАНОВИЩЕ ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/добави/становище/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ СТАНОВИЩЕ ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/добави/становище/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ СТАНОВИЩЕ ЗА ТОЗИ ЗС!</a></span></div>
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
     * Добавя Изходящ Номер и дата на Становището
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_number(Request $request, $id){
        $opinion = Opinion::findOrFail($id);
        $date_petition = date('d.m.Y', $opinion->date_petition);

        if ((int)$request['opinion_submit'] == 1) {
            $this->validate($request, ['number_opinion' => 'required|digits_between:1,6|not_in:0']);
            $this->validate($request, ['date_opinion' => 'required|date_format:d.m.Y|after:'.$date_petition]);
        };

        $index_out = Set::select('index_out')->get()->toArray();

        $data = ([
            'index_opinion' => $index_out[0]['index_out'],
            'number_opinion' => $request['number_opinion'],
            'date_opinion' => strtotime($request['date_opinion']),
        ]);

        $opinion->fill($data);
        $opinion->save();

        return Redirect::to('/становище/'.$opinion->id);
    }
}
