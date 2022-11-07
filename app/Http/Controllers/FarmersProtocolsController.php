<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Farmer;
use odbh\FarmerProtocol;
use odbh\Http\Requests;
use odbh\Http\Requests\FarmerEditProtocolRequest;
use odbh\Http\Requests\FarmerNewProtocolRequest;
use odbh\Http\Requests\FarmerProtocolRequest;
use odbh\Location;
use odbh\Opinion;
use odbh\Set;
use odbh\SetOpinion;
use odbh\User;
use odbh\Verifications;
use Redirect;
use Session;

class FarmersProtocolsController extends Controller
{
    private $logo = null;

    private $ph_area_sort = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    ////За мярките
    private $opinions_all = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

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
        $inspectors_db_all = FarmerProtocol::select('inspector_name', 'inspector')->where('inspector','!=',0)->get()->toArray();
        foreach($inspectors_db_all as $value){
            $inspectors_db[$value['inspector']] = $value['inspector_name'];
        }
        $this->inspectors_edit_db = array_sort_recursive($inspectors_active) + array_sort_recursive($inspectors_db);

        //////// ЗА МЕРКИТЕ
        /** Вички мерки  */
        $this->opinions_all = SetOpinion::lists('short_name', 'id')->toArray();
    }

    /** ВСИЧКИ ПРОТОКОЛИ*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abc = null;
        $alphabet = FarmerProtocol::lists('alphabet')->toArray();
        $protocols = FarmerProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
            'location', 'description', 'inspector', 'inspector_name', 'type_check')->orderBy('date_protocol', 'desc')->get();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $type_check = Verifications::lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
            'type_check', 'areas', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FarmerProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FarmerProtocol::lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $type_check = Verifications::lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
            'type_check', 'areas', 'inspectors'));
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
        $abc = null;
        $alphabet = FarmerProtocol::lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $type_check = Verifications::lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

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
            $object_sql = ' AND opinions='. $sort_object;
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
        if (isset($sort_assay) && (int)$sort_assay > 0) {
            $assay_sql = ' AND check_id= '.$sort_assay;
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

        $protocols = DB::select("SELECT * FROM farmers_protocols WHERE id>0
          $years_sql $object_sql $areas_sql $inspector_sql $assay_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records.index', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
            'type_check', 'areas', 'inspectors','sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay',
            'years_start_sort', 'years_end_sort'));
    }

    /** ПРОТОКОЛИ ПРИ ПРОВЕРКИ НА ЗЕМЕДЛСКИ СТОПАНИ*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_farmers()
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',1)->lists('alphabet')->toArray();
        $protocols = FarmerProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
            'location', 'description', 'inspector', 'inspector_name', 'type_check')
            ->where('check_type','=',1)->orderBy('date_protocol', 'desc')->get();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_farmers', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search_farmers(Request $request)
    {
        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FarmerProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',1)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_farmers', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas', 'inspectors'));
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
    public function sort_farmers(Request $request, $abc_list = null, $start_year = null, $end_year = null,
                         $areas_sort = null, $inspector_sort = null, $assay_sort = null)
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',1)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('areas_sort') || Input::has('inspector_sort') || Input::has('abc') || Input::has('assay_sort'))
        {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_areas = Input::get('areas_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
        }
        else {
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
        if (isset($sort_assay) && (int)$sort_assay > 0) {
            $assay_sql = ' AND type_check= '.$sort_assay;
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

        $protocols = DB::select("SELECT * FROM farmers_protocols WHERE check_type=1
          $years_sql $areas_sql $inspector_sql $assay_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records.index_farmers', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas',
            'inspectors','sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }

    /** ПРОТОКОЛИ СЪВМВЕСТНО С ДФЗ*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_fond()
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',2)->lists('alphabet')->toArray();
        $protocols = FarmerProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
            'location', 'description', 'inspector', 'inspector_name', 'type_check')
            ->where('check_type','=',2)->orderBy('date_protocol', 'desc')->get();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $type_check = Verifications::where('type_check','=',2)->lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        return view('records.index_fond', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
            'areas', 'inspectors', 'type_check'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search_fond(Request $request)
    {
        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FarmerProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',2)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $type_check = Verifications::where('type_check','=',2)->lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_fond', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
            'areas', 'inspectors', 'type_check'));
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
    public function sort_fond(Request $request, $abc_list = null, $start_year = null, $end_year = null,
                                 $areas_sort = null, $inspector_sort = null, $assay_sort = null)
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',2)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_check = Verifications::where('type_check','=',2)->lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('areas_sort') || Input::has('inspector_sort') || Input::has('abc') || Input::has('assay_sort'))
        {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_areas = Input::get('areas_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
        }
        else {
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
        if (isset($sort_assay)) {
            if( (int)$sort_assay > 0){
                $assay_sql = ' check_id= '.$sort_assay;
            }
            if( (int)$sort_assay == 0){
                $assay_sql = 'check_type=2';
            }
        }
        else {
            $assay_sql = 'check_type=2';
        }
        /** Сортиране по азбучен ред **/
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $protocols = DB::select("SELECT * FROM farmers_protocols WHERE $assay_sql
          $years_sql $areas_sql $inspector_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records.index_fond', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas', 'type_check',
            'inspectors','sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }

    /** ПРОТОКОЛИ ИЗДАДЕНИ ЗА СТАНОВИЩА*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_opinions()
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('opinions','>',0)->lists('alphabet')->toArray();
        $protocols = FarmerProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
            'location', 'description', 'inspector', 'inspector_name', 'type_check')
            ->where('opinions','>',0)->orderBy('date_protocol', 'desc')->get();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_opinion', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
            'type_opinion', 'areas', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search_opinions(Request $request)
    {
        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FarmerProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FarmerProtocol::where('opinions','>',0)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_opinion', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
            'type_opinion', 'areas', 'inspectors'));
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
    public function sort_opinions(Request $request, $abc_list = null, $start_year = null, $end_year = null,
                              $areas_sort = null, $inspector_sort = null, $assay_sort = null)
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('opinions','>',0)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_opinion = $this->opinions_all;
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('areas_sort') || Input::has('inspector_sort') || Input::has('abc') || Input::has('assay_sort'))
        {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_areas = Input::get('areas_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
        }
        else {
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
        if (isset($sort_assay)) {
            if( (int)$sort_assay > 0){
                $assay_sql = ' opinions = '.$sort_assay;
            }
            if( (int)$sort_assay == 0){
                $assay_sql = ' opinions>0';
            }
        }
        else {
            $assay_sql = ' opinions>0';
        }
        /** Сортиране по азбучен ред **/
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $protocols = DB::select("SELECT * FROM farmers_protocols WHERE $assay_sql
          $years_sql $areas_sql $inspector_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records.index_opinion', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
            'areas', 'inspectors','sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }

    /** ПРОТОКОЛИ ЗА ДРУГИ ПЛАЩАНИЯ*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_others()
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',3)->lists('alphabet')->toArray();
        $protocols = FarmerProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
            'location', 'description', 'inspector', 'inspector_name', 'type_check')
            ->where('check_type','=',3)->orderBy('date_protocol', 'desc')->get();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_check = Verifications::where('type_check','=',3)->lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_others', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
            'type_check', 'areas', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search_others(Request $request)
    {
        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FarmerProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',3)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_check = Verifications::where('type_check','=',3)->lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_others', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
            'type_check', 'areas', 'inspectors'));
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
    public function sort_others(Request $request, $abc_list = null, $start_year = null, $end_year = null,
                                  $areas_sort = null, $inspector_sort = null, $assay_sort = null)
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('check_type','=',3)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $type_check = Verifications::where('type_check','=',3)->lists('short_name', 'id')->toArray();
        $type_check[0] = 'по проверка';
        $type_check = array_sort_recursive($type_check);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('areas_sort') || Input::has('inspector_sort') || Input::has('abc') || Input::has('assay_sort'))
        {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_areas = Input::get('areas_sort');
            $sort_inspector = Input::get('inspector_sort');
            $sort_assay = Input::get('assay_sort');
        }
        else {
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
        if (isset($sort_assay)) {
            if( (int)$sort_assay > 0){
                $assay_sql = ' check_id='.$sort_assay;
            }
            if( (int)$sort_assay == 0){
                $assay_sql = ' check_type=3';
            }
        }
        else {
            $assay_sql = ' check_type=3';
        }
        /** Сортиране по азбучен ред **/
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $protocols = DB::select("SELECT * FROM farmers_protocols WHERE $assay_sql
          $years_sql $areas_sql $inspector_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records.index_others', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_check',
            'areas', 'inspectors','sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }

    //** ПРОТОКОЛИ С НАРУШЕНИЯ, ПРЕДПИСАНИЯ И АКТОВЕ*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_violation()
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('violation','=',1)->orWhere('taken','>',1)->orWhere('order_protocol','>',1)
            ->lists('alphabet')->toArray();

        $protocols = FarmerProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'order_protocol',
            'location', 'description', 'inspector', 'inspector_name', 'violation', 'act')
            ->where('violation','=',1)->orWhere('taken','>',1)->orWhere('order_protocol','>',1)
            ->orderBy('date_protocol', 'desc')->get();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_violation', compact('protocols', 'alphabet', 'abc', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search_violation(Request $request)
    {
        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FarmerProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FarmerProtocol::where('violation','=',1)->orWhere('taken','>',1)->orWhere('order_protocol','>',1)
            ->lists('alphabet')->toArray();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_violation', compact('protocols', 'alphabet', 'abc', 'inspectors'));
    }

    /**
     * Сортиране на Протоколите
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $object_sort
     * @param  int $inspector_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort_violation(Request $request, $abc_list = null, $start_year = null, $end_year = null,
                                   $object_sort = null, $inspector_sort = null)
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('violation','=',1)->orWhere('taken','>',1)->orWhere('order_protocol','>',1)
            ->lists('alphabet')->toArray();


        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('ot_object')
            || Input::has('inspector_sort') || Input::has('abc')) {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_object = Input::get('ot_object');
            $sort_inspector = Input::get('inspector_sort');
        }
        else {
            $abc = $abc_list;
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_object = $object_sort;
            $sort_inspector = $inspector_sort;
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
            if($sort_object == 1){
                $object_sql = ' AND violation = 1';
            }
            elseif($sort_object == 2){
                $object_sql = ' AND order_protocol !="" ';
            }
            elseif($sort_object == 3){
                $object_sql = ' AND act =1';
            }
            else{
                $object_sql = ' ';
            }
        } else {
            $object_sql = ' ';
        }
        /** Сортиране по Инспектори **/
        if (isset($sort_inspector) && (int)$sort_inspector > 0) {
            $inspector_sql = ' AND inspector= ' . $sort_inspector;
        } else {
            $inspector_sql = '';
        }

        /** Сортиране по азбучен ред **/
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $protocols = DB::select("SELECT * FROM farmers_protocols WHERE (violation=1 OR order_protocol !='' )
          $years_sql $object_sql $inspector_sql $abc_sql

          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records.index_violation', compact('protocols', 'alphabet','abc', 'inspectors','sort_object',
                    'sort_inspector', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }


    //** ПРОТОКОЛИ С НАРУШЕНИЯ, ПРЕДПИСАНИЯ И АКТОВЕ*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_assay()
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('assay_more','=',1)->orWhere('assay_prz','=',1)->orWhere('assay_tor','=',1)
            ->where('assay_metal','=',1)->orWhere('assay_micro','=',1)->orWhere('assay_other','=',1)
            ->lists('alphabet')->toArray();

        $protocols = FarmerProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'location', 'inspector',
            'inspector_name', 'assay_more', 'assay_prz', 'assay_tor', 'assay_metal', 'assay_micro', 'assay_other',
            'assay_more_name', 'assay_prz_name', 'assay_tor_name', 'assay_metal_name', 'assay_micro_name', 'assay_other_name')
            ->where('assay_more','=',1)->orWhere('assay_prz','=',1)->orWhere('assay_tor','=',1)
            ->where('assay_metal','=',1)->orWhere('assay_micro','=',1)->orWhere('assay_other','=',1)
            ->orderBy('date_protocol', 'desc')->get();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_assay', compact('protocols', 'alphabet', 'abc', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search_assay(Request $request)
    {
        if ((int)$request['search'] == 1) {
            $this->validate($request, ['search_protocols' => 'required|digits_between:1,6']);
            $protocols = FarmerProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = FarmerProtocol::where('violation','=',1)->orWhere('taken','>',1)->orWhere('order_protocol','>',1)
            ->lists('alphabet')->toArray();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records.index_assay', compact('protocols', 'alphabet', 'abc', 'inspectors'));
    }

    /**
     * Сортиране на Протоколите
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $object_sort
     * @param  int $inspector_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort_assay(Request $request, $abc_list = null, $start_year = null, $end_year = null,
                                   $object_sort = null, $inspector_sort = null)
    {
        $abc = null;
        $alphabet = FarmerProtocol::where('assay_more','=',1)->orWhere('assay_prz','=',1)->orWhere('assay_tor','=',1)
            ->where('assay_metal','=',1)->orWhere('assay_micro','=',1)->orWhere('assay_other','=',1)
            ->lists('alphabet')->toArray();


        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('ot_object')
            || Input::has('inspector_sort') || Input::has('abc')) {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_object = Input::get('ot_object');
            $sort_inspector = Input::get('inspector_sort');
        }
        else {
            $abc = $abc_list;
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_object = $object_sort;
            $sort_inspector = $inspector_sort;
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
            if($sort_object == 1){
                $object_sql = ' AND assay_more = 1';
            }
            elseif($sort_object == 2){
                $object_sql = ' AND assay_prz =1 ';
            }
            elseif($sort_object == 3){
                $object_sql = ' AND assay_tor =1';
            }
            elseif($sort_object == 4){
                $object_sql = ' AND assay_metal =1';
            }
            elseif($sort_object == 5){
                $object_sql = ' AND assay_micro =1';
            }
            elseif($sort_object == 6){
                $object_sql = ' AND assay_other =1';
            }
            else{
                $object_sql = ' ';
            }
        } else {
            $object_sql = ' ';
        }
        /** Сортиране по Инспектори **/
        if (isset($sort_inspector) && (int)$sort_inspector > 0) {
            $inspector_sql = ' AND inspector= ' . $sort_inspector;
        } else {
            $inspector_sql = '';
        }

        /** Сортиране по азбучен ред **/
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $protocols = DB::select("SELECT * FROM farmers_protocols WHERE (assay_more=1 OR assay_prz =1 OR assay_tor=1
        OR assay_metal=1 OR assay_micro=1 OR assay_other=1) $years_sql $object_sql $inspector_sql $abc_sql
        ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records.index_assay', compact('protocols', 'alphabet','abc', 'inspectors','sort_object',
            'sort_inspector', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }


    /**
     * Добавя протокол на Съществуващ ЗС
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $farmer = Farmer::findOrFail($id);

        $inspectors = $this->inspectors_add;
        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $checks = Verifications::where('show_check','=',1)->lists('short_name', 'id')->toArray();
        $checks[0] = 'избери проверка';
        $checks = array_sort_recursive($checks);

        return view('records.create', compact('farmer', 'inspectors', 'regions', 'districts_farm', 'districts', 'checks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \odbh\Http\Requests\FarmerProtocolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FarmerProtocolRequest $request, $id)
    {
        $assay_more = null;
        $assay_more_name = null;
        $assay_prz = null;
        $assay_prz_name = null;
        $assay_tor = null;
        $assay_tor_name = null;
        $assay_metal = null;
        $assay_metal_name = null;
        $assay_micro = null;
        $assay_micro_name = null;
        $assay_other = null;
        $assay_other_name = null;
        $egn_eik = null;

        $farmer = Farmer::findOrFail($id);
        $verification = Verifications::findOrFail($request['check_id']);

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
        if($request['sex'] == 1){
            $egn_eik = 1;
        }
        if($request['sex'] == 0){
            $egn_eik = 2;
        }
        //////  ЗА ПРОБИТЕ
        ////остатъци
        if(isset($request['assay_more']) && $request['assay_more'] == 1){
            $assay_more = 1;
            $assay_more_name = $request['assay_more_name'];
        }
        else{
            $assay_more = 0;
            $assay_more_name = '';
        }
        ////Идентификация
        if(isset($request['assay_prz']) && $request['assay_prz'] == 1){
            $assay_prz = 1;
            $assay_prz_name = $request['assay_prz_name'];
        }
        else{
            $assay_prz = 0;
            $assay_prz_name = '';
        }
        ////Нитрати
        if(isset($request['assay_tor']) && $request['assay_tor'] == 1){
            $assay_tor = 1;
            $assay_tor_name = $request['assay_tor_name'];
        }
        else{
            $assay_tor = 0;
            $assay_tor_name = '';
        }
        ////Метали
        if(isset($request['assay_metal']) && $request['assay_metal'] == 1){
            $assay_metal = 1;
            $assay_metal_name = $request['assay_metal_name'];
        }
        else{
            $assay_metal = 0;
            $assay_metal_name = '';
        }
        //// ЗАМЪРСИТЕЛИ
        if(isset($request['assay_micro']) && $request['assay_micro'] == 1){
            $assay_micro = 1;
            $assay_micro_name = $request['assay_micro_name'];
        }
        else{
            $assay_micro = 0;
            $assay_micro_name = '';
        }
        //// ДРУГИ
        if(isset($request['assay_other']) && $request['assay_other'] == 1){
            $assay_other = 1;
            $assay_other_name = $request['assay_other_name'];
        }
        else{
            $assay_other = 0;
            $assay_other_name = '';
        }

        $data = [
            'number_protocol'=>$request['number_protocol'],
            'date_protocol'=>strtotime($request['date_protocol']),
            'inspector'=>$request['inspector'],
            'inspector_two'=>$request['inspector_two'],
            'inspector_three'=>$request['inspector_three'],
            'inspector_another'=>$request['inspector_another'],
            'inspector_from'=>$request['inspector_from'],
            'opinions'=>0,
            'check_id'=>$request['check_id'],
            'check_type'=>$verification->type_check,
            'description'=>$verification->short_name,
            'firm'=>$farmer->type_firm,
            'name'=>$farmer->name,
            'sex'=>$farmer->sex,
            'pin'=>$farmer->pin,
            'bulstat'=>$farmer->bulstat,
            'egn_eik'=>$egn_eik,
            'owner'=>$farmer->owner,
            'areas_id'=>$farmer->areas_id,
            'district_id'=>$farmer->district_id,
            'city_id'=>$farmer->city_id,
            'tvm'=>$farmer->tvm,
            'location'=>$farmer->location,
            'address'=>$farmer->address,
            'district_object'=>$farmer->district_object,
            'location_farm'=>$farmer->location_farm,

            'violation'=>$request['violation'],
            'ascertainment'=>$request['ascertainment'],
            'taken'=>$request['taken'],
            'order_protocol'=>$request['order_protocol'],
            'act'=>$request['act'],

            'assay_more'=>$assay_more,
            'assay_more_name'=>$assay_more_name,
            'assay_prz'=>$assay_prz,
            'assay_prz_name'=>$assay_prz_name,
            'assay_tor'=>$assay_tor,
            'assay_tor_name'=>$assay_tor_name,
            'assay_metal'=>$assay_metal,
            'assay_metal_name'=>$assay_metal_name,
            'assay_micro'=>$assay_micro,
            'assay_micro_name'=>$assay_micro_name,
            'assay_other'=>$assay_other,
            'assay_other_name'=>$assay_other_name,
            'type_check'=>$request['type_check'],

            'inspector_name'=>$inspector_name,
            'inspector_two_name'=>$inspector_two_name,
            'inspector_three_name'=>$inspector_three_name,
            'position'=>$position,
            'position_short'=>$position_short,
            'position_two'=>$position_two,
            'position_short_two'=>$position_short_two,
            'position_three'=>$position_three,
            'position_short_three'=>$position_short_three,

            'alphabet'=>$farmer->alphabet,
            'date_add'=> time(),
            'added_by'=> Auth::user()->id
        ];
        $protocol = new FarmerProtocol($data);
        $farmer->protocols()->save($protocol);

        Session::flash('message', 'Протокола е добавен успешно!');
        return Redirect::to('/протокол-зс/'.$protocol->id);
    }

    /**
     * Добавя протокол на НОВ ЗС
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

        $checks = Verifications::where('show_check','=',1)->lists('short_name', 'id')->toArray();
        $checks[0] = 'избери проверка';
        $checks = array_sort_recursive($checks);

        return view('records.create_new', compact('inspectors', 'regions', 'selected', 'district_list', 'locations', 'checks',
                    'districts_farm', 'firm', 'name', 'pin', 'gender', 'name_firm', 'eik' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\FarmerNewProtocolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_new(FarmerNewProtocolRequest $request)
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
        $farmer_inserted = Farmer::findOrFail($insertedId);

        $assay_more = null;
        $assay_more_name = null;
        $assay_prz = null;
        $assay_prz_name = null;
        $assay_tor = null;
        $assay_tor_name = null;
        $assay_metal = null;
        $assay_metal_name = null;
        $assay_micro = null;
        $assay_micro_name = null;
        $assay_other = null;
        $assay_other_name = null;

        $verification = Verifications::findOrFail($request['check_id']);

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
        //////  ЗА ПРОБИТЕ
        ////остатъци
        if(isset($request['assay_more']) && $request['assay_more'] == 1){
            $assay_more = 1;
            $assay_more_name = $request['assay_more_name'];
        }
        else{
            $assay_more = 0;
            $assay_more_name = '';
        }
        ////Идентификация
        if(isset($request['assay_prz']) && $request['assay_prz'] == 1){
            $assay_prz = 1;
            $assay_prz_name = $request['assay_prz_name'];
        }
        else{
            $assay_prz = 0;
            $assay_prz_name = '';
        }
        ////Нитрати
        if(isset($request['assay_tor']) && $request['assay_tor'] == 1){
            $assay_tor = 1;
            $assay_tor_name = $request['assay_tor_name'];
        }
        else{
            $assay_tor = 0;
            $assay_tor_name = '';
        }
        ////Метали
        if(isset($request['assay_metal']) && $request['assay_metal'] == 1){
            $assay_metal = 1;
            $assay_metal_name = $request['assay_metal_name'];
        }
        else{
            $assay_metal = 0;
            $assay_metal_name = '';
        }
        //// ЗАМЪРСИТЕЛИ
        if(isset($request['assay_micro']) && $request['assay_micro'] == 1){
            $assay_micro = 1;
            $assay_micro_name = $request['assay_micro_name'];
        }
        else{
            $assay_micro = 0;
            $assay_micro_name = '';
        }
        //// ДРУГИ
        if(isset($request['assay_other']) && $request['assay_other'] == 1){
            $assay_other = 1;
            $assay_other_name = $request['assay_other_name'];
        }
        else{
            $assay_other = 0;
            $assay_other_name = '';
        }

        $data = [
            'number_protocol'=>$request['number_protocol'],
            'date_protocol'=>strtotime($request['date_protocol']),
            'inspector'=>$request['inspector'],
            'inspector_two'=>$request['inspector_two'],
            'inspector_three'=>$request['inspector_three'],
            'inspector_another'=>$request['inspector_another'],
            'inspector_from'=>$request['inspector_from'],
            'opinions'=>0,
            'check_id'=>$request['check_id'],

            'check_type'=>$verification->type_check,
            'description'=>$verification->short_name,

            'firm'=>$request['firm'],
            'name'=>$name,
            'sex'=>$sex,
            'pin'=>$pin,
            'bulstat'=>$eik,
            'egn_eik'=>$egn_eik,
            'owner'=>$owner,

            'areas_id'=>$request['areasID'],
            'district_id'=>$request['district_id'],
            'tvm'=>$request['data_tmv'],
            'city_id'=>$request['data_id'],
            'location'=>$request['list_name'],
            'address'=>$request['address'],
            'district_object'=>$request['district_object'],
            'location_farm'=>$request['location_farm'],

            'violation'=>$request['violation'],
            'ascertainment'=>$request['ascertainment'],
            'taken'=>$request['taken'],
            'order_protocol'=>$request['order_protocol'],
            'act'=>$request['act'],

            'assay_more'=>$assay_more,
            'assay_more_name'=>$assay_more_name,
            'assay_prz'=>$assay_prz,
            'assay_prz_name'=>$assay_prz_name,
            'assay_tor'=>$assay_tor,
            'assay_tor_name'=>$assay_tor_name,
            'assay_metal'=>$assay_metal,
            'assay_metal_name'=>$assay_metal_name,
            'assay_micro'=>$assay_micro,
            'assay_micro_name'=>$assay_micro_name,
            'assay_other'=>$assay_other,
            'assay_other_name'=>$assay_other_name,
            'type_check'=>$request['type_check'],

            'inspector_name'=>$inspector_name,
            'inspector_two_name'=>$inspector_two_name,
            'inspector_three_name'=>$inspector_three_name,
            'position'=>$position,
            'position_short'=>$position_short,
            'position_two'=>$position_two,
            'position_short_two'=>$position_short_two,
            'position_three'=>$position_three,
            'position_short_three'=>$position_short_three,

            'alphabet'=>$in,
            'date_add'=> time(),
            'added_by'=> Auth::user()->id
        ];

        $protocol = new FarmerProtocol($data);
        $farmer_inserted->protocols()->save($protocol);

        Session::flash('message', 'Протокола е добавен успешно!');
        return Redirect::to('/протокол-зс/'.$protocol->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $opinion_id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $opinion_id = null)
    {
        if(isset($opinion_id) && $opinion_id >0){
            $protocol = FarmerProtocol::where('opinion_id','=',$id)->where('number_protocol','=',$opinion_id)->first();
        }
        else{
            $protocol = FarmerProtocol::findOrFail($id);
        }
        $logo = $this->logo;

        $inspectors = User::get();
        $city = Set::first();
        $farmer = Farmer::findOrFail($protocol->farmer_id);

        $areas = $this->areas_all;
        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $city->area_id)
            ->where('type_district', '=', 1)
            ->get();

        return view('records.show', compact('logo', 'protocol', 'inspectors', 'city', 'farmer', 'areas',
            'districts_firm', 'districts_object', 'prz', 'tor', 'more'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocol = FarmerProtocol::findOrFail($id);

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = '';
        $inspectors = array_sort_recursive($inspectors);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $protocol->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $checks = Verifications::where('show_check','=',1)->lists('short_name', 'id')->toArray();
        $checks[0] = 'избери проверка';
        $checks = array_sort_recursive($checks);

        $opinions = SetOpinion::where('show_rate','=',1)->lists('short_name', 'id')->toArray();
        $opinions[0] = 'избери мярка';
        $opinions = array_sort_recursive($opinions);

        return view('records.edit', compact('protocol', 'inspectors', 'regions', 'districts_farm', 'districts', 'checks', 'opinions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\FarmerEditProtocolRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FarmerEditProtocolRequest $request, $id)
    {
        $assay_more = null;
        $assay_more_name = null;
        $assay_prz = null;
        $assay_prz_name = null;
        $assay_tor = null;
        $assay_tor_name = null;
        $assay_metal = null;
        $assay_metal_name = null;
        $assay_micro = null;
        $assay_micro_name = null;
        $assay_other = null;
        $assay_other_name = null;
        $data = array();

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

        //////  ЗА ПРОБИТЕ
        ////остатъци
        if(isset($request['assay_more']) && $request['assay_more'] == 1){
            $assay_more = 1;
            $assay_more_name = $request['assay_more_name'];
        }
        else{
            $assay_more = 0;
            $assay_more_name = '';
        }
        ////Идентификация
        if(isset($request['assay_prz']) && $request['assay_prz'] == 1){
            $assay_prz = 1;
            $assay_prz_name = $request['assay_prz_name'];
        }
        else{
            $assay_prz = 0;
            $assay_prz_name = '';
        }
        ////Нитрати
        if(isset($request['assay_tor']) && $request['assay_tor'] == 1){
            $assay_tor = 1;
            $assay_tor_name = $request['assay_tor_name'];
        }
        else{
            $assay_tor = 0;
            $assay_tor_name = '';
        }
        ////Метали
        if(isset($request['assay_metal']) && $request['assay_metal'] == 1){
            $assay_metal = 1;
            $assay_metal_name = $request['assay_metal_name'];
        }
        else{
            $assay_metal = 0;
            $assay_metal_name = '';
        }
        //// ЗАМЪРСИТЕЛИ
        if(isset($request['assay_micro']) && $request['assay_micro'] == 1){
            $assay_micro = 1;
            $assay_micro_name = $request['assay_micro_name'];
        }
        else{
            $assay_micro = 0;
            $assay_micro_name = '';
        }
        //// ДРУГИ
        if(isset($request['assay_other']) && $request['assay_other'] == 1){
            $assay_other = 1;
            $assay_other_name = $request['assay_other_name'];
        }
        else{
            $assay_other = 0;
            $assay_other_name = '';
        }

        $protocol = FarmerProtocol::findOrFail($id);
        if(!isset($request['check_id'])){
            $data = [
                'number_protocol'=>$request['number_protocol'],
                'date_protocol'=>strtotime($request['date_protocol']),
                'inspector'=>$request['inspector'],
                'inspector_two'=>$request['inspector_two'],
                'inspector_three'=>$request['inspector_three'],
                'inspector_another'=>$request['inspector_another'],
                'inspector_from'=>$request['inspector_from'],

                'violation'=>$request['violation'],
                'ascertainment'=>$request['ascertainment'],
                'taken'=>$request['taken'],
                'order_protocol'=>$request['order_protocol'],
                'act'=>$request['act'],

                'assay_more'=>$assay_more,
                'assay_more_name'=>$assay_more_name,
                'assay_prz'=>$assay_prz,
                'assay_prz_name'=>$assay_prz_name,
                'assay_tor'=>$assay_tor,
                'assay_tor_name'=>$assay_tor_name,
                'assay_metal'=>$assay_metal,
                'assay_metal_name'=>$assay_metal_name,
                'assay_micro'=>$assay_micro,
                'assay_micro_name'=>$assay_micro_name,
                'assay_other'=>$assay_other,
                'assay_other_name'=>$assay_other_name,
                'type_check'=>$request['type_check'],

                'inspector_name'=>$inspector_name,
                'inspector_two_name'=>$inspector_two_name,
                'inspector_three_name'=>$inspector_three_name,
                'position'=>$position,
                'position_short'=>$position_short,
                'position_two'=>$position_two,
                'position_short_two'=>$position_short_two,
                'position_three'=>$position_three,
                'position_short_three'=>$position_short_three,

                'date_update'=> time(),
                'updated_by'=> Auth::user()->id
            ];

            $data_opinion = [
                'number_protocol'=>$request['number_protocol'],
                'date_protocol'=>strtotime($request['date_protocol']),
                'user_protocol'=>$request['inspector'],
            ];
            $opinion = Opinion::findOrFail($protocol->opinion_id);
            $opinion->fill($data_opinion);
            $opinion->save();
        }
        if(isset($request['check_id'])){
            $verification = Verifications::findOrFail($request['check_id']);
            $data = [
                'number_protocol'=>$request['number_protocol'],
                'date_protocol'=>strtotime($request['date_protocol']),
                'inspector'=>$request['inspector'],
                'inspector_two'=>$request['inspector_two'],
                'inspector_three'=>$request['inspector_three'],
                'inspector_another'=>$request['inspector_another'],
                'inspector_from'=>$request['inspector_from'],

                'check_id'=>$request['check_id'],
                'check_type'=>$verification->type_check,
                'description'=>$verification->short_name,

                'violation'=>$request['violation'],
                'ascertainment'=>$request['ascertainment'],
                'taken'=>$request['taken'],
                'order_protocol'=>$request['order_protocol'],
                'act'=>$request['act'],

                'assay_more'=>$assay_more,
                'assay_more_name'=>$assay_more_name,
                'assay_prz'=>$assay_prz,
                'assay_prz_name'=>$assay_prz_name,
                'assay_tor'=>$assay_tor,
                'assay_tor_name'=>$assay_tor_name,
                'assay_metal'=>$assay_metal,
                'assay_metal_name'=>$assay_metal_name,
                'assay_micro'=>$assay_micro,
                'assay_micro_name'=>$assay_micro_name,
                'assay_other'=>$assay_other,
                'assay_other_name'=>$assay_other_name,
                'type_check'=>$request['type_check'],

                'inspector_name'=>$inspector_name,
                'inspector_two_name'=>$inspector_two_name,
                'inspector_three_name'=>$inspector_three_name,
                'position'=>$position,
                'position_short'=>$position_short,
                'position_two'=>$position_two,
                'position_short_two'=>$position_short_two,
                'position_three'=>$position_three,
                'position_short_three'=>$position_short_three,

                'date_update'=> time(),
                'updated_by'=> Auth::user()->id
            ];
        }

        $protocol->fill($data);
        $protocol->save();

        Session::flash('message', 'Протокола е редактиран успешно!');
        return Redirect::to('/протокол-зс/'.$protocol->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

    /**
     * Добавя констативен протокол на Становището
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_number(Request $request, $id){
        $opinion = Opinion::findOrFail($id);
        $inspector_name_sql1 = User::where('id', '=', $request['inspectors_protocol'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position = $inspector_name_sql1[0]['position'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        if ((int)$request['protocol_submit'] == 1) {
            $this->validate($request, ['number_protocol' => 'required|digits_between:1,6|not_in:0']);
            $this->validate($request, ['date_protocol' => 'required|date_format:d.m.Y']);
            $this->validate($request, ['inspectors_protocol' => 'required|not_in:0']);
            $this->validate($request, ['type_check' => 'required']);
        };
        $farmer = Farmer::findOrFail($opinion->farmer_id);

        $data_protocol = ([
            'opinion_id'=>$opinion->id,
            'number_protocol' => $request['number_protocol'],
            'date_protocol'=> strtotime($request['date_protocol']),
            'inspector'=> $request['inspectors_protocol'],
            'inspector_name'=>$inspector_name,
            'position'=>$position,
            'position_short'=>$position_short,

            'type_check'=> $request['type_check'],

            'opinions'=>$opinion->type_opinion,
            'description'=>$opinion->opinion_name_short,
            'firm'=>$opinion->type_firm,
            'name'=>$opinion->name,
            'sex'=>$opinion->sex,
            'pin'=>$opinion->pin,
            'bulstat'=>$opinion->eik,
            'egn_eik'=>$opinion->egn_eik,
            'owner'=>$opinion->owner,
            'areas_id'=>$opinion->areas_id,
            'district_id'=>$opinion->district_id,
            'city_id'=>$opinion->city_id,
            'tvm'=>$opinion->tvm,
            'location'=>$opinion->location,
            'address'=>$opinion->address,
            'district_object'=>$opinion->district_object,
            'location_farm'=>$opinion->object_name,

            'alphabet'=>$opinion->alphabet,
            'date_add'=>time(),
            'added_by'=>Auth::user()->id,
        ]);

        $protocol_save = new FarmerProtocol($data_protocol);
        $farmer->protocols()->save($protocol_save);

        $data = ([
            'number_protocol' => $request['number_protocol'],
            'date_protocol' => strtotime($request['date_protocol']),
            'user_protocol' => $request['inspectors_protocol'],
        ]);

        $opinion->fill($data);
        $opinion->save();

        return Redirect::to('/становище/'.$opinion->id);
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

        return view('records.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers'));
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
                        <div style='width: 50%; display: inline-block'><span><a href='/протокол-добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ КОНСТАТИВЕН ПРОТОКОЛ ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/протокол-добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ КОНСТАТИВЕН ПРОТОКОЛ ЗА ТОЗИ ЗС!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/протокол-добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ КОНСТАТИВЕН ПРОТОКОЛ ЗА ТОЗИ ЗС!</a></span></div>
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
