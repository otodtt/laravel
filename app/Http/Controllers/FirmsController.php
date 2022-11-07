<?php

namespace odbh\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use odbh\Area;
use odbh\Certificate;
use odbh\Firm;
use odbh\Http\Requests;
use odbh\Http\Requests\FirmsRequest;
use odbh\Location;
use odbh\Sample;
use odbh\Set;
use Session;

class FirmsController extends Controller
{
    private $index = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('admin', ['only'=>['edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts_list = $this->districts_list;
        $districts_list[0] = 'Друга област';

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();

        $abc = null;
        $alphabet = Firm::lists('alphabet')->toArray();
        $firms = Firm::orderBy('alphabet', 'asc')->get();
        return view('objects.firms.index', compact('firms', 'districts_list', 'alphabet','abc'));
    }

    /**
     * Сортиране по азбучен ред
     * @param null $abc
     * @param null $sort
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort($abc = null, $sort = null)
    {
        $get_area = $this->area_get_id;
        $districts_list = $this->districts_list->toArray();
        $districts_list[0] = 'Друга област';
        $alphabet = Firm::lists('alphabet', 'id')->toArray();

        //////// При Избиране на Буква
        if($abc !== null && $sort == null){
            if($abc == 0){
                $firms = Firm::all();
            }
            else{
                $firms = Firm::select()
                    ->where('alphabet', '=', $abc)
                    ->get();
            }
        }


        if($abc !== null && $sort !== null){
            if($abc == 0){
                if($sort == 0){
                    $firms = Firm::select()
                        ->where('district_id', '>', $sort)
                        ->where('areas_id', '!=', $get_area)
                        ->get();
                }
                else{
                    $firms = Firm::select()
                        ->where('district_id', '=', $sort)
                        ->where('areas_id', '=', $get_area)
                        ->get();
                }
            }
            else{
                if($sort == 0){
                    $firms = Firm::select()
                        ->where('alphabet', '=', $abc)
                        ->where('district_id', '>', $sort)
                        ->where('areas_id', '!=', $get_area)
                        ->get();
                }
                else{
                    $firms = Firm::select()
                        ->where('alphabet', '=', $abc)
                        ->where('district_id', '=', $sort)
                        ->where('areas_id', '=', $get_area)
                        ->get();
                }
            }
        }
        $input_sort = Input::get('sort');
        $input_abc = Input::get('abc');

        //////// При Инпут на Формата gotowo
        if($input_sort != null  && $input_abc == null){
            if(array_key_exists($input_sort, $districts_list) && $input_sort !=0) {
                $firms = Firm::select()
                    ->where('district_id', '=', $input_sort)
                    ->where('areas_id', '=', $get_area)
                    ->get();
            }
            else{
                //TODO Ако някой промени селект менюто
            }
            if(array_key_exists($input_sort, $districts_list) && $input_sort ==0) {
                $firms = Firm::select()
                    ->where('district_id', '>', $input_sort)
                    ->where('areas_id', '!=', $get_area)
                    ->get();
            }
            else{
                //TODO Ако някой промени селект менюто
            }
        }
        if($input_sort != null  && $input_abc != null){
            if(array_key_exists($input_sort, $districts_list) && (array_key_exists($input_abc, $alphabet) || $input_abc == 0) ) {
                if($input_abc == 0){
                    if($input_sort == 0){
                        $firms = Firm::select()
                            ->where('district_id', '>', $input_sort)
                            ->where('areas_id', '!=', $get_area)
                            ->get();
                    }
                    else{
                        $firms = Firm::select()
                            ->where('district_id', '=', $input_sort)
                            ->where('areas_id', '=', $get_area)
                            ->get();
                    }
                }
                else{
                    if($input_sort == 0){
                        $firms = Firm::select()
                            ->where('district_id', '>', $input_sort)
                            ->where('areas_id', '!=', $get_area)
                            ->where('alphabet', '=', $input_abc)
                            ->get();
                    }
                    else{
                        $firms = Firm::select()
                            ->where('district_id', '=', $input_sort)
                            ->where('areas_id', '=', $get_area)
                            ->where('alphabet', '=', $input_abc)
                            ->get();
                    }
                }
            }
            else{
                //TODO Ако някой промени селект менюто
            }

        }
        return view('objects.firms.index', [ 'districts_list'=>$districts_list, 'alphabet'=>$alphabet, 'abc'=>$abc, 'firms'=>$firms, 'sort'=>$sort]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
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

        return view('objects.firms.create', compact('selected', 'regions', 'district_list', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\FirmsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FirmsRequest $request)
    {
        $in = null;
        $sex = null;
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
        if(strlen($request['gender']) == 4){
            $sex = 1;
        }
        if(strlen($request['gender']) == 6){
            $sex = 2;
        }
        Firm::create([
            'type_firm'=> $request['type_firm'],
            'name'=> $request['name'],
            'postal_code'=> $request['postal_code'],
            'areas_id'=> $request['areasID'],
            'district_id'=> $request['district_id'],
            'type_location'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'alphabet'=> $in,
            'address'=> $request['address'],
            'sex'=> $sex,
            'owner'=> mb_convert_case  ($request['owner'], MB_CASE_TITLE, "UTF-8"),
            'egn'=> $request['pin'],
            'bulstat'=> trim($request['bulstat']),
            'phone'=> $request['phone'],
            'mobil'=> $request['mobil'],
            'email'=> trim($request['email']),
            'date_create'=> time(),
            'created_by'=> Auth::user()->id,
        ]);

        Session::flash('message', 'Фирмата е добавена успешно!');
        return Redirect::to('/фирми');
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
        $areasID = filter_input(INPUT_POST, 'areasID');

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
                $return_locals[] = '<option value="'.$local->name.'" data_id="'.$local->id.'" data_ekatte="'.$local->ekatte.'"
                data_tmv="'.$local->tvm.'" data_pc="'.$local->postal_code.'" areas_id="'.$local->areas_id.'"
                district_id="'.$local->district_id.'" >' .$local->name. '</option>';
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
                $return[] = '<option value="'.$local->name.'" data_id="'.$local->id.'" data_ekatte="'.$local->ekatte.'"
                data_tmv="'.$local->tvm.'" data_pc="'.$local->postal_code.'" areas_id="'.$local->areas_id.'"
                district_id="'.$local->district_id.'" >' .$local->name. '</option>';
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $firm = Firm::findOrFail($id);
        $areas = $this->areas_all;

        $pharmacies = $firm->pharmacies;
        $repositories = $firm->repositories;
        $workshops = $firm->workshops;

        $districts = Location::select()
            ->where('areas_id', '=', $firm->areas_id)
            ->where('district_id', '=', $firm->district_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->get();

        $districts_show = $this->districts_list;

        $index = Set::select('area_id')->get()->toArray();
        $lock_permit = Set::select('lock_permit')->get()->toArray();

        $certificates = Certificate::lists('number', 'id')->toArray();

        return view('objects.firms.show', compact('firm', 'areas', 'pharmacies', 'repositories', 'workshops',
                    'districts', 'districts_show', 'index', 'lock_permit', 'last_number', 'certificates' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $firm = Firm::findOrFail($id);

        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$firm->areas_id)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $firm->areas_id;
        }
        $regions = $this->areas_all_list;
        /////////////////  За Общините
        $get_session_area = Session::get('_old_input', 'district_id');
        if(isset($get_session_area['district_id'])){
            $selected_district = $get_session_area['district_id'];
        }
        else{
            $selected_district = $firm->district_id;
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

        $name_location = $firm->location;

        return view('objects.firms.edit', compact('firm', 'district_list', 'regions', 'areas', 'locations', 'selected', 'selected_district', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\FirmsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FirmsRequest $request, $id)
    {
        $in = null;
        $sex = null;

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
        if(strlen($request['gender']) == 4){
            $sex = 1;
        }
        if(strlen($request['gender']) == 6){
            $sex = 2;
        }
        $firm = Firm::findOrFail($id);
        $data =([
            'type_firm'=> $request['type_firm'],
            'name'=> $request['name'],
            'postal_code'=> $request['postal_code'],
            'areas_id'=> $request['areasID'],
            'district_id'=> $request['district_id'],
            'type_location'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'alphabet'=> $in,
            'address'=> $request['address'],
            'sex'=> $sex,
            'owner'=> mb_convert_case  ($request['owner'], MB_CASE_TITLE, "UTF-8"),
            'egn'=> $request['pin'],
            'bulstat'=> trim($request['bulstat']),
            'phone'=> $request['phone'],
            'mobil'=> $request['mobil'],
            'email'=> trim($request['email']),
            'date_update'=> time(),
            'updated_by'=> Auth::user()->id,
            'updated_for'=> 1,
        ]);

        $firm->fill($data);
        $firm->save();

        $data_update = ['alphabet'=>$in, 'type_firm'=>$request['type_firm'], 'name'=>$request['name']];

        $firm->pharmacies()->where('firm_id','=',$id)->update($data_update);
        $firm->repositories()->where('firm_id','=',$id)->update($data_update);
        $firm->workshops()->where('firm_id','=',$id)->update($data_update);

        $data_protocols = ['alphabet'=>$in, 'firm'=>$request['type_firm'], 'name'=>$request['name']];
        $firm->protocols()->where('id_from_firm','=',$id)->update($data_protocols);

        $sample = Sample::where('firm_id','=',$firm->id);
        if ($firm->type_firm == 1) {
            $et = 'ET';
            $ood = '';
        } elseif ($firm->type_firm == 2) {
            $et = '';
            $ood = 'ООД';
        } elseif ($firm->type_firm == 3) {
            $et = '';
            $ood = 'ЕООД';
        } elseif ($firm->type_firm == 4) {
            $et = '';
            $ood = 'АД';
        } else {
            $et = '';
            $ood = '';
        }
        $data_assay = ([
            'firm_id'=>$firm->id,
            'from_firm'=>$et.' "'.$firm->name.'" '.$ood,
        ]);
        $sample->where('firm_id','=',$firm->id)->update($data_assay);

        Session::flash('message', 'Фирмата е редактирана успешно!');
        return Redirect::to('/фирма/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}
}
