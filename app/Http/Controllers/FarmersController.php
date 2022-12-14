<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use Input;
//use odbh\Air;
use odbh\Certificate;
use odbh\Diary;
use odbh\Farmer;
use odbh\Http\Requests;
use odbh\Http\Requests\FarmersUpdateRequest;
use odbh\Location;
use odbh\User;
use Redirect;
use Session;


class FarmersController extends Controller
{
    ///// За Инспекторите
    private $inspectors_add = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_rz_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abc = null;
        $alphabet = Farmer::lists('alphabet')->toArray();
        $farmers = Farmer::select('id', 'type_firm', 'pin', 'name', 'address', 'district_object', 'location')->get();

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';

        $districts_list = array_sort_recursive($districts_list);

        return view('farmers.index', compact('farmers', 'districts_list', 'districts_farm', 'alphabet','abc'));
    }

    /**
     * Сортиране по азбучен ред
     * @param null $abc_list
     * @param null $sort
     * @param null $sort_firm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort($abc_list = null, $sort = null, $sort_firm = null)
    {
        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();

        $districts_list = $districts->toArray();
        $districts_list[0] = 'Сортирай по община';

        $districts_list = array_sort_recursive($districts_list);

        $alphabet = Farmer::lists('alphabet')->toArray();

        //////////////
        $abc = null;
        if (Input::has('sort') || Input::has('abc') || Input::has('sort_firm')) {
            $abc = Input::get('abc');
            $sort_district = Input::get('sort');
            $firm_sort = Input::get('sort_firm');
        } else {
            $abc = $abc_list;
            $sort_district = $sort;
            $firm_sort = $sort_firm;
        }

        if (isset($sort_district) && (int)$sort_district > 0){
            $district_sql = ' AND district_object = '.$sort_district;
        }
        else{
            $district_sql = '';
        }
        //////
        if (isset($firm_sort) && (int)$firm_sort > 0){
            $firm_sql = ' AND type_firm = '.$firm_sort;
        }
        else{
            $firm_sql = '';
        }
        //////
        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $farmers = DB::select("SELECT `id`, `type_firm`, `pin`, `name`, `address`, `district_object`, `location` FROM farmers WHERE
        id >0 $district_sql $abc_sql $firm_sql ");

        return view('farmers.index', [ 'districts_list'=>$districts_list, 'alphabet'=>$alphabet, 'abc'=>$abc,
            'farmers'=>$farmers, 'sort'=>$sort, 'districts_farm'=>$districts_farm, 'sort_firm'=>$sort_firm,]);
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
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $farmer = Farmer::findOrFail($id);

        if ((int)$request['search'] == 1) {
            $this->validate($request, ['date_diary' => 'required|date_format:d.m.Y']);
            $this->validate($request, ['inspector' => 'required']);
            $this->validate($request, ['act' => 'required']);

            $inspector_name_sql1 = User::where('id', '=', $request['inspector'])->get()->toArray();
            $inspector_name = $inspector_name_sql1[0]['short_name'];
            $position_short = $inspector_name_sql1[0]['position_short'];

            $data = [
                'type_firm'=>$farmer->type_firm,
                'name'=>$farmer->name,
                'pin'=>$farmer->pin,
                'alphabet'=>$farmer->alphabet,
                'date_diary'=>strtotime($request['date_diary']),
                'act'=>$request['act'],
                'inspector'=>$request['inspector'],
                'inspector_name'=>$inspector_name,
                'position_short'=>$position_short,
            ];
            $diary = new Diary($data);
            $farmer->diaries()->save($diary);

            Session::flash('message', 'Заверката е направена успешно!');
            return Redirect::to('/стопанин/'.$farmer->id);
        };

        $opinions = $farmer->opinions;
        $old_opinions = $farmer->old_opinions;

        $protocols = $farmer->protocols;
        $old_protocols = $farmer->old_protocols;

        $permits = $farmer->permits;
        $diaries = $farmer->diaries;
        $qcertificates = $farmer->qincertificates;
        $qprotocols = $farmer->qprotocols;
        $compliance = $farmer->compliance;

        $inspectors = $this->inspectors_add;

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $certificate = Certificate::select('id')->where('pin','=',$farmer->pin)->orWhere('pin','=',$farmer->pin_owner)->get()->toArray();

        return view('farmers.show', compact('farmer', 'districts', 'districts_farm', 'regions', 'old_opinions', 'opinions',
                                    'certificate', 'protocols', 'old_protocols', 'old_protocols', 'permits',
                                    'inspectors', 'diaries', 'qcertificates', 'qprotocols', 'compliance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farmer = Farmer::findOrFail($id);
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

        $districts = $this->districts_list;
        $districts_farm = $districts->toArray();
        $districts_farm[0] = 'Сортирай по община';
        $districts_farm = array_sort_recursive($districts_farm);

        return view('farmers.edit', compact('farmer', 'district_list', 'regions', 'locations', 'selected',
                            'selected_district', 'name_location', 'districts_farm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\FarmersUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FarmersUpdateRequest $request, $id)
    {
        $farmer = Farmer::findOrFail($id);
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
        elseif(strlen($request['gender']) == 6){
            $sex = 2;
        }
        else{
            $sex = $farmer->sex;;
        }
        ///////
        if(strlen($request['gender_owner']) == 4){
            $sex_owner = 1;
        }
        elseif(strlen($request['gender_owner']) == 6){
            $sex_owner = 2;
        }
        elseif(strlen($request['gender_owner']) == 1){
            $sex_owner = 0;
        }
        else{
            $sex_owner = $farmer->sex_owner;;
        }
        if(isset($request['type_firm']) && ($request['type_firm'] == 2 || $request['type_firm'] == 3 || $request['type_firm'] == 4
                || $request['type_firm'] == 5 || $request['type_firm'] == 6 || $request['type_firm'] == 7)){
            $type_firm = $request['type_firm'];
            $pins = $request['bulstat'];
            $bulstats = $request['bulstat'];
            $owner = $request['owner'];
            $pin_owner = $request['pin_owner'];
            $egn_eik = 2;
        }
        elseif(!isset($request['type_firm']) || $request['type_firm']==1){
            $type_firm = $farmer->type_firm;
            $pins = $request['pin'];
            $bulstats = '';
            $owner = '';
            $pin_owner = '';
            $egn_eik = 1;
        }
        else{
            $type_firm = $farmer->type_firm;
            $pins = $farmer->pin;
            $bulstats = $farmer->bulstat;
            $owner = $farmer->owner;
            $pin_owner = $farmer->pin_owner;
            $egn_eik = 1;
        }

        $data = ([
            'type_firm'=>$type_firm,
            'name'=>$request['name'],
            'sex'=>$sex,
            'pin'=>$pins,
            'bulstat'=>$bulstats,
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
            'alphabet'=>$in,
            'date_update'=>time(),
            'updated_by'=> Auth::user()->id,
            'phone'=>$request['phone'],
            'mobil'=>$request['mobil'],
            'email'=>$request['email'],
        ]);
        $farmer->fill($data);
        $farmer->save();

        $opinions_data = ([
            'type_firm'=>$type_firm,
            'name'=>$request['name'],
            'sex'=>$sex,
            'pin'=>$pins,
            'eik'=>$bulstats,
            'egn_eik'=>$egn_eik,
            'alphabet'=>$in,
            'district_object'=>$request['district_object'],
            'object_name'=>$request['location_farm'],
        ]);
        $farmer->opinions()->where('farmer_id','=',$id)->update($opinions_data);

        Session::flash('message', 'Земеделския стопанин е редактирана успешно!');
        return Redirect::to('/стопанин/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

}
