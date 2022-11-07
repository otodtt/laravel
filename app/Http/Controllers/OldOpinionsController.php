<?php

namespace odbh\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Http\Requests;
use odbh\OldOpinion;

class OldOpinionsController extends Controller
{
    private $ph_area_sort = null;

    public function __construct()
    {
        parent::__construct();

        $areas_sort = $this->districts_list->toArray();
        $areas_sort[0] = 'Сортирай по община';
        $areas_sort = array_sort_recursive($areas_sort);
        $this->ph_area_sort = $areas_sort;
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
        $alphabet = OldOpinion::lists('alphabet')->toArray();
        $opinions = OldOpinion::select('id', 'index_opinion', 'number_opinion', 'date_opinion', 'pin', 'name', 'alphabet',
            'opinion', 'opinion_id', 'location', 'address', 'district_object', 'inspector_id', 'inspector_name', 'double_protocol',
            'number_protocol', 'date_protocol')->orderBy('date_opinion', 'asc')->get();

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = OldOpinion::lists('inspector_name', 'inspector_id')->toArray();
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $type_opinion = OldOpinion::lists('opinion', 'opinion_id')->toArray();
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        return view('opinions.old.index', compact('opinions', 'districts_list', 'alphabet', 'abc', 'areas', 'inspectors', 'type_opinion'));
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
                $opinions = OldOpinion::where('number_opinion', '=', $request['search_protocols'])->get();
            }
            if($request['search'] == 2){
                $opinions = OldOpinion::where('number_protocol', '=', $request['search_protocols'])->get();
            }
        };

        $areas = $this->ph_area_sort;

        $abc = null;
        $alphabet = OldOpinion::lists('alphabet')->toArray();

        $districts = $this->districts_list;
        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';
        $districts_list = array_sort_recursive($districts_list);

        $inspectors = OldOpinion::lists('inspector_name', 'inspector_id')->toArray();
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $type_opinion = OldOpinion::lists('opinion', 'opinion_id')->toArray();
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        return view('opinions.old.index', compact('opinions', 'districts_list', 'alphabet', 'abc', 'areas', 'inspectors', 'type_opinion'));
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

        $inspectors = OldOpinion::lists('inspector_name', 'inspector_id')->toArray();
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $type_opinion = OldOpinion::lists('opinion', 'opinion_id')->toArray();
        $type_opinion[0] = 'по мярка';
        $type_opinion = array_sort_recursive($type_opinion);

        $alphabet = OldOpinion::lists('alphabet')->toArray();
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
            $object_sql = ' AND opinion_id='. $sort_object;
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
            $assay_sql = ' AND double_protocol < 4';
        }
        elseif (isset($sort_assay) && (int)$sort_assay == 2) {
            $assay_sql = ' AND double_protocol >= 4';
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

        $opinions = DB::select("SELECT * FROM old_opinions WHERE id>0
          $years_sql $object_sql $areas_sql $inspector_sql $assay_sql $abc_sql
          ORDER BY `date_opinion` ASC, `number_opinion` ASC" );

        return view('opinions.old.index', compact('opinions', 'districts_list', 'alphabet', 'abc', 'areas', 'inspectors',
            'type_opinion', 'sort_object', 'sort_areas', 'sort_inspector', 'areas', 'sort_assay', 'years_start_sort', 'years_end_sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opinion = OldOpinion::findOrFail($id);
        return view('opinions.old.show', compact('opinion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}
}
