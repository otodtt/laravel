<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Factory;
use odbh\FactoryProtocol;
use odbh\Http\Requests;
//use odbh\Http\Controllers\Controller;
use odbh\Http\Requests\FactoryProtocolRequest;
use odbh\Http\Requests\FactoryProtocolUpdateRequest;
use odbh\Location;
use odbh\Sample;
use odbh\Set;
use odbh\User;
use Redirect;
use Session;

class FactoriesProtocolsController extends Controller
{
    private $logo = null;

    private $ph_area_sort = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * FactoriesProtocolsController constructor.
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
        $inspectors_db_all = FactoryProtocol::select('inspector_name', 'inspector', 'inspector_two_name', 'inspector_two', 'inspector_three_name', 'inspector_three')
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
        $alphabet = FactoryProtocol::lists('alphabet')->toArray();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $protocols = FactoryProtocol::all()->sortBy('date_protocol');

        return view('protocols.factories.index', compact('alphabet', 'protocols', 'abc', 'inspectors'));
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
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FactoryProtocol::where('number', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FactoryProtocol::lists('alphabet')->toArray();

        return view('protocols.factories.index', compact('alphabet', 'protocols', 'abc', 'inspectors'));
    }

    /**
     * Сортиране на Протоколите
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $assay_sort
     * @param  int $inspector_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $abc_list = null, $start_year = null, $end_year = null, $inspector_sort = null, $assay_sort = null)
    {
        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $alphabet = FactoryProtocol::lists('alphabet')->toArray();
        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year')|| Input::has('inspector_sort')
            || Input::has('abc') || Input::has('assay_sort')) {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
        } else {
            $abc = $abc_list;
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
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

        /** Сортиране по Инспектори **/
        if (isset($sort_inspector) && (int)$sort_inspector > 0) {
            $inspector_sql = ' AND inspector= ' . $sort_inspector;
        } else {
            $inspector_sql = '';
        }
        /** Сортиране по взета проба и нарушения **/
        if (isset($sort_assay) && (int)$sort_assay == 1) {
            $assay_sql = ' AND (assay_prz > 0 OR assay_more > 0) ';
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

        $protocols = DB::select("SELECT * FROM factories_protocols WHERE id>0  $years_sql $inspector_sql $assay_sql $abc_sql
                                 ORDER BY date_protocol ASC ");

        return view('protocols.factories.index', compact('protocols', 'alphabet', 'abc', 'years_start_sort', 'years_end_sort',
            'inspectors', 'sort_object', 'sort_inspector', 'areas', 'sort_assay'));
    }

    /**
     * JSON Избор на фирми производители
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function factory_select(Request $request){
        $tvm = null;
        $id = filter_input(INPUT_POST, 'id');

        $firm = Factory::findOrFail($id);

        $area_name = null;
        $district_name = null;
        $areas = $this->areas_all;
        foreach($areas as $area) {
            if ($firm->areas_id == $area->id) {
                $area_name = $area->areas_name;
            }
        }
        $districts = Location::select('district_id', 'areas_id', 'name', 'type_district')
                    ->where('areas_id','=',$firm->areas_id)
                    ->where('district_id','=',$firm->district_id)
                    ->where('type_district','=',1)
                    ->get();
        foreach($districts as $district) {
            if ($firm->district_id == $district->district_id) {
                $district_name = $district->name;
            }
        }
        if($firm->type_location == 1){
            $tvm = 'гр. ';
        }
        if($firm->type_location == 2){
            $tvm = 'с. ';
        }
        $firm_name = $tvm.$firm->location;

        if(strlen($firm->owner) > 0){
            $owner = '
            <div class="col-md-4 select_cols">
                <p class="bold">Управител/Представител на фирмата:</p>
                <p>Трите имена: <span class="bold">'.$firm->owner.'</span></p>
                <p>ЕГН: <span class="bold">'.$firm->egn.'</span></p>
            </div>
            ';
        }
        else{
            $owner ='';
        }

        $data[] = '
                    <div class="col-md-8 select_cols" >
                        <p>Име на Фирмата: <span class="bold">'.mb_strtoupper($firm->name, "utf-8").'</span> с ЕИК/Булстат: <span class="bold">'.$firm->bulstat.'</span></p>
                        <p>
                            <span class="bold">'.$firm_name.'</span>, п.к. <span class="bold">'.$firm->postal_code.'</span>, общ. <span class="bold">'.$district_name.'</span>, обл. <span class="bold">'.$area_name.'</span>
                        </p>
                        <p>
                            С адрес: <span class="bold">'.$firm->address.'</span>
                        </p>
                        <p>Телефон: <span class="bold">'.$firm->phone.'</span> Мобилен: <span class="bold">'.$firm->mobil.'</span> E-mail: <span class="bold">'.$firm->email.'</span></p>
                    </div>
                    '.$owner.'
                    <input type="hidden" value="'.$firm->id.'" name="id_factory" id="id_factory">
                 ';

        if ($request->ajax()) {
            return response()->json([
                $data
            ]);
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
        $get_session = Session::get('_old_input', 'hidden');


        if(isset($get_session['hidden']) && ((int)$get_session != (int)$selected_session)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $selected_array[0]['area_id'];
        }

        $areas_all = $this->areas_all_list;
        $regions_return =  $this->areas_all->toArray();

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

        $firms = Factory::lists('name', 'id')->toArray();
        $firms[0] = 'Избери фирма';
        $firms = array_sort_recursive($firms);

        $get_session_id = Session::get('_old_input', 'id_factory');
        if(isset($get_session_id['id_factory']) && $get_session_id['id_factory']>0 ){
            $factory = Factory::findOrFail($get_session_id['id_factory'])->toArray();
            $districts = Location::select('areas_id', 'district_id', 'name', 'type_district')
                ->where('areas_id','=',$factory['areas_id'])
                ->where('district_id','=',$factory['district_id'])
                ->where('type_district','=',1)
                ->get();
            foreach($districts as $district) {
                if ($factory['district_id'] == $district->district_id) {
                    $district_name = $district->name;
                }
            }
        }
        else{
            $factory = null;
        }


        return view('protocols.factories.create', compact('inspectors', 'selected', 'areas_all', 'district_list', 'locations', 'firms',
                    'factory', 'regions_return', 'district_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\FactoryProtocolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FactoryProtocolRequest $request)
    {
        $factory = Factory::findOrFail($request['id_factory']);
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
        $assay_prz = null;
        $assay_more = null;
        if($request['assay_prz'] == 1) {
            if ($request['assay_more'] == 1) {
                $assay_prz = 0;
                $assay_more = 1;
            }
            if ($request['assay_more'] == 0) {
                $assay_prz = 1;
                $assay_more = 0;
            }
        }
        if($request['assay_prz'] == 0) {
            $assay_prz = 0;
            $assay_more = 0;
        }
        $data = ([
            'type_check'=>$request['type_check'],
            'number'=>$request['number'],
            'date_protocol'=>strtotime($request['date_protocol']),
            'inspector'=>$request['inspector'],
            'inspector_two'=>$request['inspector_two'],
            'inspector_three'=>$request['inspector_three'],
            'inspector_another'=>$request['inspector_another'],
            'inspector_from'=>$request['inspector_from'],

            'firm'=>$factory->type_firm,
            'name'=>$factory->name,
            'bulstat'=>$factory->bulstat,
            'owner'=>$factory->owner,
            'pin_owner'=>$factory->egn,
            'sex_owner'=>$factory->sex,

            'areas_id'=>$factory->areas_id,
            'district_id'=>$factory->district_id,
            'city_village'=>$factory->type_location,
            'location'=>$factory->location,
            'address'=>$factory->address,

            'violation'=>$request['violation'],
            'ascertainment'=>$request['ascertainment'],
            'taken'=>$request['taken'],
            'order_protocol'=>$request['order_protocol'],
            'act'=>$request['act'],

            'assay_prz'=>$assay_prz,
            'assay_more'=>$assay_more,

            'area_object'=>$request['areasID'],
            'district_object'=>$request['localsID'],
            'cv_object'=>$request['data_tmv'],
            'location_object'=>$request['list_name'],
            'address_object'=>$request['address_object'],

            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,

            'inspector_two_name'=>$inspector_two_name,
            'position_two'=>$position_two,
            'position_short_two'=>$position_short_two,

            'inspector_three_name'=>$inspector_three_name,
            'position_three'=>$position_three,
            'position_short_three'=>$position_short_three,

            'date_add'=>time(),
            'added_by'=> Auth::user()->id,

            'alphabet'=>$factory->alphabet,
        ]);

        $protocols = new FactoryProtocol($data);
        $factory->protocols()->save($protocols);


        if ($factory->type_firm == 1) {
            $et = 'ET';
            $ood = '';
        } elseif ($factory->type_firm == 2) {
            $et = '';
            $ood = 'ООД';
        } elseif ($factory->type_firm == 3) {
            $et = '';
            $ood = 'ЕООД';
        } elseif ($factory->type_firm == 4) {
            $et = '';
            $ood = 'АД';
        } else {
            $et = '';
            $ood = '';
        }

        if($request['assay_prz']==1){
            $assay_more = null;
            if($request['assay_more'] == 0){
                $assay_more = 1;
            }
            if($request['assay_more'] == 1){
                $assay_more = 100;
            }
            $data_assay_prz = ([
                'number_sample'=>$request['number'],
                'date_number'=>strtotime(stripslashes($request['date_protocol'])),
                'firm_id'=>$factory->id,
                'from_firm'=>$et.' "'.$factory->name.'" '.$ood,
                'from_object'=>200,
                'name'=>$request['prz_name'],
                'active_subs'=>$request['prz_av'],
                'inspector'=>$inspector_name,
                'type_assay'=>$assay_more,
            ]);
            Sample::create($data_assay_prz);
        }

        if($request['assay_prz']==1){
            Session::flash('message', 'Протокола и взетите проби са добавени успешно!');
            return Redirect::to('/производители');
        }
        else{
            Session::flash('message', 'Протокола е добавен успешно!');
            return Redirect::to('/производители');
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
        $protocol = FactoryProtocol::findOrFail($id);
        $inspectors = User::get();
        $city = Set::first();

        $areas_all = $this->areas_all;

        $areas_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $protocol->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        ///// ЗА ОБЕКТИТЕ
        $areas_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $protocol->area_object)
            ->where('type_district', '=', 1)
            ->get();

        if($protocol->assay_prz == 1){
            $prz = Sample::where('number_sample','=',$protocol->number)
                ->where('date_number','=',$protocol->date_protocol)
                ->where('type_assay','=',1)
                ->get();
        }
        else{
            $prz = array();
        }
        if($protocol->assay_more == 1){
            $more = Sample::where('number_sample','=',$protocol->number)
                ->where('date_number','=',$protocol->date_protocol)
                ->where('type_assay','=',100)
                ->get();
        }
        else{
            $more = array();
        }

        return view('protocols.factories.show', compact('logo', 'protocol', 'inspectors', 'city', 'areas_all',
            'areas_firm', 'areas_object', 'prz', 'more'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocol = FactoryProtocol::findOrFail($id);

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
            $selected = $protocol->area_object;
        }

        $areas_all = $this->areas_all_list;

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);
        /////////////////  За Общините
        $get_session_area = Session::get('_old_input', 'district_id');
        if(isset($get_session_area['district_id'])){
            $selected_district = $get_session_area['district_id'];
        }
        else{
            $selected_district = $protocol->district_object;
        }

        $get_district = Session::get('_old_input', 'localsID');
        if(!isset($get_district['localsID']) || $get_district['localsID']==0){
            $locations = Location::select()
                ->where('areas_id', '=', $selected)
                ->where('district_id', '=', $protocol->district_object)
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

        $firms = Factory::lists('name', 'id')->toArray();
        $firms[0] = 'Избери фирма';
        $firms = array_sort_recursive($firms);

        $regions_return =  $this->areas_all->toArray();
        $factory = Factory::findOrFail($protocol->firm_id)->toArray();

        $districts = Location::select('district_id', 'areas_id', 'name', 'type_district')
            ->where('areas_id','=',$factory['areas_id'])
            ->where('district_id','=',$factory['district_id'])
            ->where('type_district','=',1)
            ->get();
        foreach($districts as $district) {
            if ($factory['district_id'] == $district->district_id) {
                $district_name = $district->name;
            }
        }
        $edit = 1;
        return view('protocols.factories.edit', compact('inspectors', 'selected', 'areas_all', 'district_list', 'locations',
            'selected_district', 'object_areas', 'protocol', 'firms', 'factory', 'regions_return', 'district_name', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\FactoryProtocolUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FactoryProtocolUpdateRequest $request, $id)
    {
        $protocol = FactoryProtocol::findOrFail($id);
        $factory = Factory::findOrFail($request['id_factory']);
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
        $assay_prz = null;
        $assay_more = null;
        if($request['assay_prz'] == 1) {
            if ($request['assay_more'] == 1) {
                $assay_prz = 0;
                $assay_more = 1;
            }
            if ($request['assay_more'] == 0) {
                $assay_prz = 1;
                $assay_more = 0;
            }
        }
        if($request['assay_prz'] == 0) {
            $assay_prz = 0;
            $assay_more = 0;
        }
        $data = ([
            'type_check'=>$request['type_check'],
            'number'=>$request['number'],
            'date_protocol'=>strtotime($request['date_protocol']),
            'inspector'=>$request['inspector'],
            'inspector_two'=>$request['inspector_two'],
            'inspector_three'=>$request['inspector_three'],
            'inspector_another'=>$request['inspector_another'],
            'inspector_from'=>$request['inspector_from'],

            'firm'=>$factory->type_firm,
            'name'=>$factory->name,
            'bulstat'=>$factory->bulstat,
            'owner'=>$factory->owner,
            'pin_owner'=>$factory->egn,
            'sex_owner'=>$factory->sex,

            'areas_id'=>$factory->areas_id,
            'district_id'=>$factory->district_id,
            'city_village'=>$factory->type_location,
            'location'=>$factory->location,
            'address'=>$factory->address,

            'violation'=>$request['violation'],
            'ascertainment'=>$request['ascertainment'],
            'taken'=>$request['taken'],
            'order_protocol'=>$request['order_protocol'],
            'act'=>$request['act'],

            'assay_prz'=>$assay_prz,
            'assay_more'=>$assay_more,

            'area_object'=>$request['areasID'],
            'district_object'=>$request['localsID'],
            'cv_object'=>$request['data_tmv'],
            'location_object'=>$request['list_name'],
            'address_object'=>$request['address_object'],

            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,

            'inspector_two_name'=>$inspector_two_name,
            'position_two'=>$position_two,
            'position_short_two'=>$position_short_two,

            'inspector_three_name'=>$inspector_three_name,
            'position_three'=>$position_three,
            'position_short_three'=>$position_short_three,

            'date_update'=>time(),
            'updated_by'=> Auth::user()->id,

            'alphabet'=>$factory->alphabet,
        ]);
        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Протокола е редактиран успешно!');
        return Redirect::to('/производители/'.$protocol->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

    /**
     * Добавя проби от ПРЗ.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function assay_prz_factory(Request $request, $id)
    {
        $this->validate($request, [
            'prz_name' => 'required:',
            'prz_av' => 'required:',
        ]);
        $protocol = FactoryProtocol::findOrFail($id);
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
        $assay_prz = null;
        if($request['more'] == 0){
            $assay_prz = 1;
        }
        if($request['more'] == 1){
            $assay_prz = 100;
        }
        $data_assay_prz = ([
            'number_sample'=>$protocol->number,
            'date_number'=>$protocol->date_protocol,
            'firm_id'=>$protocol->firm_id,
            'from_firm'=>$et.' "'.$protocol->name.'" '.$ood,
            'from_object'=>$protocol->ot,
            'name'=>$request['prz_name'],
            'active_subs'=>$request['prz_av'],
            'inspector'=>$protocol->inspector_name,
            'type_assay'=>$assay_prz,
        ]);
        Sample::create($data_assay_prz);

        $data_update_protocol = null;
        if($request['more'] == 0){
            $data_update_protocol = (['assay_prz'=>1]);
        }
        if($request['more'] == 1){
            $data_update_protocol = (['assay_more'=>1]);
        }

        $protocol->fill($data_update_protocol);
        $protocol->save();

        Session::flash('message', 'Пробата от ПРЗ е добавена успешно!');
        return Redirect::to('/производители/'.$id);
    }
}
