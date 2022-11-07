<?php

namespace odbh\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Farmer;
use odbh\Http\Requests;
//use odbh\Http\Controllers\Controller;
use odbh\Location;
use odbh\OldProtocol;
use odbh\Set;
use odbh\SetOpinion;
use odbh\User;
use odbh\Verifications;

class OldProtocolsController extends Controller
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
//        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);
//        $this->middleware('admin', ['only'=>['edit', 'update', 'destroy']]);

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
        $inspectors_db = array();
        $inspectors_db_all = OldProtocol::select('inspector_name', 'inspector')->where('inspector','!=',0)->get()->toArray();
        foreach($inspectors_db_all as $value){
            $inspectors_db[$value['inspector']] = $value['inspector_name'];
        }
        $this->inspectors_edit_db = array_sort_recursive($inspectors_db);

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
        $alphabet = OldProtocol::lists('alphabet')->toArray();
        $protocols = OldProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
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


        return view('records_old.index', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
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
            $protocols = OldProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = OldProtocol::lists('alphabet')->toArray();

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

        return view('records_old.index', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
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
        $alphabet = OldProtocol::lists('alphabet')->toArray();

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

        $protocols = DB::select("SELECT * FROM old_farmers_protocols WHERE id>0
          $years_sql $object_sql $areas_sql $inspector_sql $assay_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records_old.index', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
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
        $alphabet = OldProtocol::where('check_type','=',1)->lists('alphabet')->toArray();
        $protocols = OldProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
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

        return view('records_old.index_farmers', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas', 'inspectors'));
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
            $protocols = OldProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = OldProtocol::where('check_type','=',1)->lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $areas = $this->ph_area_sort;

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        return view('records_old.index_farmers', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas', 'inspectors'));
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
        $alphabet = OldProtocol::where('check_type','=',1)->lists('alphabet')->toArray();

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

        $protocols = DB::select("SELECT * FROM old_farmers_protocols WHERE check_type=1
          $years_sql $areas_sql $inspector_sql $assay_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records_old.index_farmers', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas',
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
        $alphabet = OldProtocol::where('check_type','=',2)->lists('alphabet')->toArray();
        $protocols = OldProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
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

        return view('records_old.index_fond', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
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
            $protocols = OldProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = OldProtocol::where('check_type','=',2)->lists('alphabet')->toArray();

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

        return view('records_old.index_fond', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
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
        $assay_sql = null;
        $abc = null;
        $alphabet = OldProtocol::where('check_type','=',2)->lists('alphabet')->toArray();

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

        $protocols = DB::select("SELECT * FROM old_farmers_protocols WHERE $assay_sql
          $years_sql $areas_sql $inspector_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records_old.index_fond', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'areas', 'type_check',
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
        $alphabet = OldProtocol::where('opinions','>',0)->lists('alphabet')->toArray();
        $protocols = OldProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
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

        return view('records_old.index_opinion', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
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
            $protocols = OldProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = OldProtocol::where('opinions','>',0)->lists('alphabet')->toArray();

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

        return view('records_old.index_opinion', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
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
        $assay_sql = null;
        $abc = null;
        $alphabet = OldProtocol::where('opinions','>',0)->lists('alphabet')->toArray();

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

        $protocols = DB::select("SELECT * FROM old_farmers_protocols WHERE $assay_sql
          $years_sql $areas_sql $inspector_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records_old.index_opinion', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_opinion',
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
        $alphabet = OldProtocol::where('check_type','=',3)->lists('alphabet')->toArray();
        $protocols = OldProtocol::select('id', 'number_protocol', 'date_protocol', 'name', 'pin', 'district_object',
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

        return view('records_old.index_others', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
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
            $protocols = OldProtocol::where('number_protocol', '=', $request['search_protocols'])->get();
        };

        $abc = null;
        $alphabet = OldProtocol::where('check_type','=',3)->lists('alphabet')->toArray();

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

        return view('records_old.index_others', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc',
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
        $assay_sql = null;
        $abc = null;
        $alphabet = OldProtocol::where('check_type','=',3)->lists('alphabet')->toArray();

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

        $protocols = DB::select("SELECT * FROM old_farmers_protocols WHERE $assay_sql
          $years_sql $areas_sql $inspector_sql $abc_sql
          ORDER BY `date_protocol` DESC, `number_protocol` ASC" );

        return view('records_old.index_others', compact('protocols', 'districts_list', 'districts_farm', 'alphabet','abc', 'type_check',
            'areas', 'inspectors','sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $date
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $date = null)
    {
        if(isset($date) && $date >0){
            $date_string = date('d.m.Y', $date);
            $date_sofia = strtotime($date_string. 'Europe/Sofia');

            $protocol = OldProtocol::where('number_protocol','=',$id)
                ->where('date_protocol','=',$date)->orWhere('date_protocol','=',$date_sofia)->first();
        }
        else{
            $protocol = OldProtocol::findOrFail($id);
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

        return view('records_old.show', compact('logo', 'protocol', 'inspectors', 'city', 'farmer', 'areas',
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
        //
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
    public function destroy($id){}
}
