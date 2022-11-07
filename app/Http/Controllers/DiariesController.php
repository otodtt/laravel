<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
use odbh\Diary;
use odbh\Farmer;
use odbh\Http\Requests;
use odbh\Http\Requests\DiaryRequest;
use odbh\Location;
use odbh\Set;
use odbh\User;
use Redirect;
use Session;

//use odbh\Http\Controllers\Controller;

class DiariesController extends Controller
{
    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_rz_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        /** За Всички които са добавяли Протоколи + Активните*/
        $inspectors_active = $this->inspectors_active_rz_list->toArray();
        $inspectors_db = Diary::lists('inspector_name', 'inspector')->toArray();
        $this->inspectors_edit_db = $inspectors_active + $inspectors_db;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $abc = null;
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

        $protocols = Diary::get();
        foreach($protocols as $protocol){
            $array[date('Y', $protocol->date_diary)] = date('Y', $protocol->date_diary);
        }
        $years = array_filter(array_unique($array));

        $diaries = Diary::where('date_diary','>',$time_start)->where('date_diary','<',$time_end)->get();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $alphabet = Diary::select('alphabet')->where('date_diary','>',$time_start)
            ->where('date_diary','<',$time_end)->lists('alphabet')->toArray();

//        $diaries = Diary::get();

        return view('diaries.index', compact('diaries', 'alphabet','abc', 'years', 'year_now', 'inspectors'));
    }

    /**
     * Сортиране на Дневниците
     *
     * @param  int $abc_list
     * @param  int $year
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $abc_list = null, $year = null)
    {
        $abc = null;
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

        $protocols = Diary::get();
        foreach($protocols as $protocol){
            $array[date('Y', $protocol->date_diary)] = date('Y', $protocol->date_diary);
        }
        $years = array_filter(array_unique($array));

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $alphabet = Diary::select('alphabet')->where('date_diary','>',$time_start)
            ->where('date_diary','<',$time_end)->lists('alphabet')->toArray();

        //////////////
        if (Input::has('abc')) {
            $abc = Input::get('abc');
        } else {
            $abc = $abc_list;
        }
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $diaries = DB::select("SELECT * FROM diaries WHERE date_diary >$time_start AND  date_diary <$time_end $abc_sql  ");

        return view('diaries.index', compact('diaries', 'alphabet','abc', 'years', 'year_now', 'inspectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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

        return view('diaries.create', compact('inspectors', 'regions', 'selected', 'district_list', 'locations',
                    'districts_farm', 'firm', 'name', 'pin', 'gender', 'name_firm', 'eik' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\DiaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiaryRequest $request)
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
        $position_short = $inspector_name_sql1[0]['position_short'];

        $data = [
            'type_firm'=>$request['firm'],
            'name'=>$name,
            'date_diary'=>strtotime($request['date_diary']),
            'act'=>$request['act'],
            'inspector'=>$request['inspector'],
            'inspector_name'=>$inspector_name,
            'position_short'=>$position_short,
            'alphabet'=>$in,
            'pin'=>$pin
        ];
        $diary = new Diary($data);
        $farmer_inserted->diaries()->save($diary);

        Session::flash('message', 'Дневника и Земеделския Стопанин са добавени успешно!');
        return Redirect::to('/дневници');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diaries = Diary::findOrFail($id);
        $farmer = Farmer::findOrFail($diaries->farmer_id);

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = '';
        $inspectors = array_sort_recursive($inspectors);

        return view('diaries.edit', compact('farmer', 'diaries', 'inspectors'));
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
        $this->validate($request, ['date_diary' => 'required|date_format:d.m.Y']);
        $this->validate($request, ['inspector' => 'required']);
        $this->validate($request, ['act' => 'required']);

        $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql1[0]['short_name'];
        $position_short = $inspector_name_sql1[0]['position_short'];

        $data = [
            'date_diary'=>strtotime($request['date_diary']),
            'act'=>$request['act'],
            'inspector'=>$request['inspector'],
            'inspector_name'=>$inspector_name,
            'position_short'=>$position_short,
        ];

        $diaries = Diary::findOrFail($id);
        $diaries->fill($data);
        $diaries->save();

        Session::flash('message', 'Заверката е редактирана успешно!');
        return Redirect::to('/стопанин/'.$diaries->farmer_id);
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

        return view('diaries.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers'));
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
                        <div style='width: 50%; display: inline-block'><span><a href='/стопанин/$farmer->id' class='fa fa-user btn btn-success my_btn'> КЪМ ДАННИТЕ НА ЗЕМЕДЕЛСКИЯ СТОПАНИН!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/стопанин/$farmer->id' class='fa fa-user btn btn-success my_btn'> КЪМ ДАННИТЕ НА ТОЗИ ЗЕМЕДЕЛСКИ СТОПАНИН!</a></span></div>
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
