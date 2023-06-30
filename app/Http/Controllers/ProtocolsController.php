<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Firm;
use odbh\Http\Requests;

use odbh\Http\Requests\ProtocolsRequest;
use odbh\Http\Requests\ProtocolsUpdateRequest;
use odbh\Location;
use odbh\Pharmacy;
use odbh\Protocol;
use odbh\Repository;
use odbh\Sample;
use odbh\Set;
use odbh\User;
use odbh\Workshop;
use Redirect;
use Session;

class ProtocolsController extends Controller
{
    private $logo = null;

    private $ph_area_sort = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * ProtocolsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control');

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
        $inspectors_db_all = Protocol::select('inspector_name', 'inspector', 'inspector_two_name', 'inspector_two', 'inspector_three_name', 'inspector_three')
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
        $alphabet = Protocol::lists('alphabet')->toArray();

        $areas = $this->ph_area_sort;

        $protocols = Protocol::where('ot','>=', 1)->where('ot','<=', 3)->orderBy('date_protocol', 'desc')->orderBy('number', 'desc')->get();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('protocols.market.index', compact('alphabet', 'protocols', 'abc', 'inspectors', 'areas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_old()
    {
        $abc = null;
        $alphabet = Protocol::lists('alphabet')->toArray();

        $areas = $this->ph_area_sort;

        $protocols = Protocol::where('ot','>=', 1)->where('ot','<=', 3)->orderBy('date_protocol', 'desc')->orderBy('number', 'desc')->get();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('control.old_protocols.home', compact('alphabet', 'protocols', 'abc', 'inspectors', 'areas'));
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
            $protocols = Protocol::where('number', '=', $request['search_protocols'])->get();
        };

        $areas = $this->ph_area_sort;

        $abc = null;
        $alphabet = Protocol::lists('alphabet')->toArray();

        return view('protocols.market.index', compact('protocols', 'alphabet', 'abc', 'inspectors', 'areas'));
    }

    /**
     * Сортиране на Протоколите
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

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $alphabet = Protocol::lists('alphabet')->toArray();
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
        } else {
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
        /** Сортиране по вид на обект **/
        if (isset($sort_object) && (int)$sort_object > 0) {
            $object_sql = ' AND ot='. $sort_object;
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
            $inspector_sql = ' AND inspector= ' . $sort_inspector;
        } else {
            $inspector_sql = '';
        }
        /** Сортиране по взета проба и нарушения **/
        if (isset($sort_assay) && (int)$sort_assay == 1) {
            $assay_sql = ' AND assay_prz> 0';
        }
        elseif (isset($sort_assay) && (int)$sort_assay == 2) {
            $assay_sql = ' AND assay_tor> 0';
        }
        elseif (isset($sort_assay) && (int)$sort_assay == 3) {
            $assay_sql = ' AND violation> 0';
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

        $protocols = DB::select("SELECT * FROM objects_protocols WHERE id>0  $years_sql $object_sql $areas_sql
         $inspector_sql $assay_sql $abc_sql ORDER BY `date_protocol` DESC, `number` DESC");

        return view('protocols.market.index', compact('protocols', 'alphabet', 'abc', 'years_start_sort', 'years_end_sort',
            'inspectors', 'sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id ИД на обекта за който се добавя протокола
     * @param  int $type Вида (Аптека, Склад, Цех) на обекта за който се добавя протокола
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $type)
    {
        if((int)$type == 1){
           $object = Pharmacy::findOrFail($id);
        }
        if((int)$type == 2){
            $object = Repository::findOrFail($id);
        }
        if((int)$type == 3){
            $object = Workshop::findOrFail($id);
        }

        $inspectors = $this->inspectors_add;

        return view('protocols.market.create', compact('object', 'type', 'inspectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $object_id  ИД на обекта за който се добавя протокола
     * @param int $type  Вида на обекта за който се добавя протокола
     *
     * @param  \odbh\Http\Requests\ProtocolsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProtocolsRequest $request, $object_id, $type)
    {
        $unique_number = Protocol::where('number','=',$request['number'])->where('date_protocol','=',strtotime(stripslashes($request['date_protocol'])))->get();
        if(count($unique_number)>0){
            $this->validate($request, [
                'number' => 'not_in:'.$request['number'],
            ]);

        }

        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        if($request['inspector_two'] > 0){
            $inspector_name_sql2 = User::where('id', '=', $request['inspector_two'])->get()->toArray();
            $inspector_two_name = $inspector_name_sql2[0]['short_name'];
            $position_two = $inspector_name_sql2[0]['position'];
            $position_short_two = $inspector_name_sql2[0]['position_short'];
        } else {
            $inspector_two_name = '';
            $position_two = '';
            $position_short_two = '';
        }

        if($request['inspector_three']> 0){
            $inspector_name_sql3 = User::where('id', '=', $request['inspector_three'])->get()->toArray();
            $inspector_three_name = $inspector_name_sql3[0]['short_name'];
            $position_three = $inspector_name_sql3[0]['position'];
            $position_short_three = $inspector_name_sql3[0]['position_short'];
        } else {
            $inspector_three_name = '';
            $position_three = '';
            $position_short_three = '';
        }

        if($type == 1){
            $object = Pharmacy::findOrFail($object_id);
        }
        if($type == 2){
            $object = Repository::findOrFail($object_id);
        }
        if($type == 3){
            $object = Workshop::findOrFail($object_id);
        }
        $assay_prz = null;
        $assay_more = null;
        if($request['assay_prz'] == 1) {
            if ($request['more'] == 1) {
                $assay_prz = 0;
                $assay_more = 1;
            }
            if ($request['more'] == 0) {
                $assay_prz = 1;
                $assay_more = 0;
            }
        }
        if($request['assay_prz'] == 0){
            $assay_prz = 0;
            $assay_more = 0;
        }

        $data = ([
            'id_from_object'=>$object->id,
            'number'=>$request['number'],
            'date_protocol'=>strtotime(stripslashes($request['date_protocol'])),
            'inspector'=>$request['inspector'],
            'inspector_two'=>$request['inspector_two'],
            'inspector_three'=>$request['inspector_three'],
            'inspector_another'=>$request['inspector_another'],
            'inspector_from'=>$request['inspector_from'],
            'ot'=>$type,
            'firm'=>$object->type_firm,
            'name'=>$object->name,
            'city_id'=>$object->tvm_id,
            'city_village'=>$object->type_location,
            'place'=>$object->location,
            'address'=>$object->address,
            'district_object'=>$object->district_object,
            'ascertainment'=>$request['ascertainment'],
            'taken'=>$request['taken'],
            'order_protocol'=>$request['order_protocol'],

            'date_add'=>time(),
            'added_by'=> Auth::user()->id,
            'alphabet'=>$object->alphabet,
            'assay_prz'=>$assay_prz,
            'assay_more'=>$assay_more,
            'assay_tor'=>$request['assay_tor'],
            'type_check'=>$request['type_check'],
            'act'=>$request['act'],
            'violation'=>$request['violation'],
            'inspector_name'=>$inspector_name,
            'inspector_two_name'=>$inspector_two_name,
            'inspector_three_name'=>$inspector_three_name,
            'position'=>$position,
            'position_short'=>$position_short,
            'position_two'=>$position_two,
            'position_short_two'=>$position_short_two,
            'position_three'=>$position_three,
            'position_short_three'=>$position_short_three,
        ]);

        $firm = Firm::findOrfail($object->firm_id);
        $protocols = new Protocol($data);
        $firm->protocols()->save($protocols);

        if ($object->type_firm == 1) {
            $et = 'ET';
            $ood = '';
        } elseif ($object->type_firm == 2) {
            $et = '';
            $ood = 'ООД';
        } elseif ($object->type_firm == 3) {
            $et = '';
            $ood = 'ЕООД';
        } elseif ($object->type_firm == 4) {
            $et = '';
            $ood = 'АД';
        } else {
            $et = '';
            $ood = '';
        }

        if($request['assay_prz']==1){
            $assay_more = null;
            if($request['more'] == 0){
                $assay_more = 1;
            }
            if($request['more'] == 1){
                $assay_more = 100;
            }
            $data_assay_prz = ([
                'number_sample'=>$request['number'],
                'date_number'=>strtotime(stripslashes($request['date_protocol'])),
                'firm_id'=>$object->firm_id,
                'from_firm'=>$et.' "'.$object->name.'" '.$ood,
                'from_object'=>$type,
                'name'=>$request['prz_name'],
                'active_subs'=>$request['prz_av'],
                'inspector'=>$inspector_name,
                'type_assay'=>$assay_more,
            ]);
            Sample::create($data_assay_prz);
        }
        if($request['assay_tor']==1){
            $data_assay_tor = ([
                'number_sample'=>$request['number'],
                'date_number'=>strtotime(stripslashes($request['date_protocol'])),
                'firm_id'=>$object->firm_id,
                'from_firm'=>$et.' "'.$object->name.'" '.$ood,
                'from_object'=>$type,
                'name'=>$request['tor_name'],
                'active_subs'=>$request['tor_av'],
                'eo'=>$request['eo_tor'],
                'inspector'=>$inspector_name,
                'type_assay'=>2,
            ]);
            Sample::create($data_assay_tor);
        }
        if($request['assay_prz']==1 || $request['assay_tor']==1){
            Session::flash('message', 'Протокола и взетите проби са добавени успешно!');
            return Redirect::to('/фирма/'.$firm->id);
        }
        else{
            Session::flash('message', 'Протокола е добавен успешно!');
            return Redirect::to('/фирма/'.$firm->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logo = $this->logo;
        $protocol = Protocol::findOrFail($id);
        $inspectors = User::get();
        $city = Set::first();
        $firm = Firm::findOrFail($protocol->id_from_firm);

        $areas = $this->areas_all;
        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $city->area_id)
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
        if($protocol->assay_tor == 1){
            $tor = Sample::where('number_sample','=',$protocol->number)
                ->where('date_number','=',$protocol->date_protocol)
                ->where('type_assay','=',2)
                ->get();
        }
        return view('protocols.market.show', compact('logo', 'protocol', 'inspectors', 'city', 'firm', 'areas',
                    'districts_firm', 'districts_object', 'prz', 'more'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocols = Protocol::findOrFail($id);
        $object = $protocols;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = '';
        $inspectors = array_sort_recursive($inspectors);

        return view('protocols.market.edit', compact('object', 'protocols', 'inspectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\ProtocolsUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProtocolsUpdateRequest $request, $id)
    {
        $unique_number = Protocol::where('number','=',$request['number'])
                                    ->where('date_protocol','=',strtotime(stripslashes($request['date_protocol'])))
                                    ->where('id','!=',$id)->get();
        if(count($unique_number)>0){
            $this->validate($request, [
                'number' => 'not_in:'.$request['number'],
            ]);
        }

        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        if($request['inspector_two'] > 0){
            $inspector_name_sql2 = User::where('id', '=', $request['inspector_two'])->get()->toArray();
            $inspector_two_name = $inspector_name_sql2[0]['short_name'];
            $position_two = $inspector_name_sql2[0]['position'];
            $position_short_two = $inspector_name_sql2[0]['position_short'];
        } else {
            $inspector_two_name = '';
            $position_two = '';
            $position_short_two = '';
        }

        if($request['inspector_three']> 0){
            $inspector_name_sql3 = User::where('id', '=', $request['inspector_three'])->get()->toArray();
            $inspector_three_name = $inspector_name_sql3[0]['short_name'];
            $position_three = $inspector_name_sql3[0]['position'];
            $position_short_three = $inspector_name_sql3[0]['position_short'];
        } else {
            $inspector_three_name = '';
            $position_three = '';
            $position_short_three = '';
        }

        $protocol = Protocol::findOrFail($id);
        $data = ([
            'number'=>$request['number'],
            'date_protocol'=>strtotime(stripslashes($request['date_protocol'])),
            'inspector'=>$request['inspector'],
            'inspector_two'=>$request['inspector_two'],
            'inspector_three'=>$request['inspector_three'],
            'inspector_another'=>$request['inspector_another'],
            'inspector_from'=>$request['inspector_from'],
            'ascertainment'=>$request['ascertainment'],
            'taken'=>$request['taken'],
            'order_protocol'=>$request['order_protocol'],

            'date_update'=>time(),
            'updated_by'=> Auth::user()->id,

            'assay_prz'=>$request['assay_prz'],
            'assay_tor'=>$request['assay_tor'],
            'type_check'=>$request['type_check'],
            'act'=>$request['act'],
            'violation'=>$request['violation'],
            'inspector_name'=>$inspector_name,
            'inspector_two_name'=>$inspector_two_name,
            'inspector_three_name'=>$inspector_three_name,
            'position'=>$position,
            'position_short'=>$position_short,
            'position_two'=>$position_two,
            'position_short_two'=>$position_short_two,
            'position_three'=>$position_three,
            'position_short_three'=>$position_short_three,
        ]);
        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Протокола е редактиран успешно!');
        return Redirect::to('/протокол/'.$protocol->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

    /**
     * Всички Протоколи издадени на фирмата
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function protocols_show($id)
    {
        $array = array();
        $firm = Firm::findOrFail($id);

        $protocols = $firm->protocols;
        $pharmacies = $firm->pharmacies;
        $repositories = $firm->repositories;
        $workshops = $firm->workshops;

        foreach($protocols as $protocol){
            $array[date('Y', $protocol->date_protocol)] = date('Y', $protocol->date_protocol);
        }

        $years=array_filter(array_unique($array));

        return view('protocols.market.firm_protocols',  compact('firm', 'protocols', 'pharmacies', 'repositories', 'workshops',
                    'years'));
    }

    /**
     * Сортиране на Протоколите издадени на фирма
     *
     * @param  int $id
     * @param  int $id_object
     * @param  int $type
     * @param  int $years_sort
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function protocols_sort($id = null, $id_object = null, $type = null, $years_sort = null)
    {
        $array = array();
        $firm = Firm::findOrFail($id);

        $protocols_year = $firm->protocols;
        $pharmacies = $firm->pharmacies;
        $repositories = $firm->repositories;
        $workshops = $firm->workshops;

        foreach($protocols_year as $protocol){
            $array[date('Y', $protocol->date_protocol)] = date('Y', $protocol->date_protocol);
        }

        $years=array_filter(array_unique($array));

        if (Input::has('id_object') || Input::has('type') || Input::has('years_sort')) {
            $sort_object = Input::get('id_object');
            $sort_type = Input::get('type');
            $sort_years = Input::get('years_sort');
        } else {
            $sort_object = $id_object;
            $sort_type = $type;
            $sort_years = $years_sort;
        }
        /** Сортиране по дата **/
        if (isset($sort_years)) {
            $start_year = '01.01.' . $sort_years;
            $time_start = strtotime(stripslashes($start_year));
            $end_year = '31.12.' . $sort_years;
            $time_end = strtotime(stripslashes($end_year));

            $years_sql = ' AND date_protocol > ' . $time_start . ' AND date_protocol < ' . $time_end ;
        }
        else{
            $years_sql = '';
        }

        if (isset($sort_object) && strlen($sort_object) != 0) {
            $object_sql = ' AND id_from_object = '.$sort_object.' AND ot = '.$sort_type;
        }
        else{
            $object_sql = '';
        }

        $protocols = DB::select("SELECT * FROM objects_protocols WHERE id_from_firm =$id  $years_sql $object_sql
        ORDER BY date_protocol ASC ");

        return view('protocols.market.firm_protocols',  compact('firm', 'protocols', 'pharmacies', 'repositories', 'workshops',
            'years', 'sort_object', 'sort_type', 'sort_years'));
    }

    /**
     * Добавя проби от ПРЗ.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add_prz(Request $request, $id)
    {
        $assay_prz = null;
        $data_update_protocol = null;

        $this->validate($request, [
            'prz_name' => 'required:',
            'prz_av' => 'required:',
        ]);
        $protocol = Protocol::findOrFail($id);
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
        if($request['assay_prz'] == 0){
            $assay_prz = 0;
        }
        if($request['assay_prz'] == 1){
            if($request['more'] == 0){
                $assay_prz = 1;
                $data_update_protocol = (['assay_prz'=>1]);
            }
            if($request['more'] == 1){
                $assay_prz = 100;
                $data_update_protocol = (['assay_more'=>1]);
            }
        }
        $data_assay_prz = ([
            'number_sample'=>$protocol->number,
            'date_number'=>$protocol->date_protocol,
            'firm_id'=>$protocol->id_from_firm,
            'from_firm'=>$et.' "'.$protocol->name.'" '.$ood,
            'from_object'=>$protocol->ot,
            'name'=>$request['prz_name'],
            'active_subs'=>$request['prz_av'],
            'inspector'=>$protocol->inspector_name,
            'type_assay'=>$assay_prz,
        ]);

        Sample::create($data_assay_prz);

        $protocol->fill($data_update_protocol);
        $protocol->save();

        Session::flash('message', 'Пробата от ПРЗ е добавена успешно!');
        return Redirect::to('/протокол/'.$id);
    }

    /**
     * Добавя проби от ТОР.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add_tor(Request $request, $id)
    {
        $this->validate($request, [
            'tor_name' => 'required:',
            'tor_av' => 'required:',
            'eo_tor' => 'required:',
        ]);
        $protocol = Protocol::findOrFail($id);
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
            'firm_id'=>$protocol->id_from_firm,
            'from_firm'=>$et.' "'.$protocol->name.'" '.$ood,
            'from_object'=>$protocol->ot,
            'name'=>$request['tor_name'],
            'active_subs'=>$request['tor_av'],
            'eo'=>$request['eo_tor'],
            'inspector'=>$protocol->inspector_name,
            'type_assay'=>2,
        ]);

        Sample::create($data_assay_tor);

        $data = (['assay_tor'=>1]);
        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Пробата от ПРЗ е добавена успешно!');
        return Redirect::to('/протокол/'.$id);
    }

}