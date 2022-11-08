<?php

namespace odbh\Http\Controllers;

use Auth;
use odbh\Factory;
use odbh\FactoryProtocol;
use odbh\Http\Requests;
use odbh\Http\Requests\FactoryRequest;
use odbh\Location;
use odbh\Set;
use Redirect;
use Session;

class FactoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = $this->district_full;
        $firms = Factory::orderBy('alphabet', 'asc')->get();

        return view('admin.factories.index', compact('districts', 'firms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = $this->district_full;

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

        return view('admin.factories.create', compact('districts', 'selected', 'regions', 'district_list', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\FactoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FactoryRequest $request)
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
        if(strlen($request['gender']) == 2){
            $sex = 0;
        }
        $data = [
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
        ];

        Factory::create($data);

        Session::flash('message', 'Фирмата е добавена успешно!');
        return Redirect::to('/админ/производители');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $districts = $this->district_full;
        $firm = Factory::findOrFail($id);

        $areas = $this->areas_all;

        $areas_show = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        return view('admin.factories.show', compact('districts', 'firm', 'areas_show', 'areas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts = $this->district_full;
        $firm = Factory::findOrFail($id);

        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$firm->areas_id)){
            $selected = $get_session['hidden'];
        }
        else{
            $selected = $firm->areas_id;
        }
        /////////////////  За Общините
        $get_session_area = Session::get('_old_input', 'district_id');
        if(isset($get_session_area['district_id'])){
            $selected_district = $get_session_area['district_id'];
        }
        else{
            $selected_district = $firm->district_id;
        }

        $regions = $this->areas_all_list;

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

        return view('admin.factories.edit', compact('districts', 'firm', 'district_list', 'regions', 'locations', 'selected',
                    'selected_district', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\FactoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FactoryRequest $request, $id)
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
        if(strlen($request['gender']) == 2){
            $sex = 0;
        }
        $firm = Factory::findOrFail($id);
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

        $protocols = FactoryProtocol::where('firm_id','=',$firm->id);
        $data_protocols = ([
            'firm'=> $request['type_firm'],
            'name'=> $request['name'],
            'bulstat'=> trim($request['bulstat']),
            'owner'=>  mb_convert_case  ($request['owner'], MB_CASE_TITLE, "UTF-8"),
            'pin_owner'=> $request['pin'],
            'sex_owner'=> $sex,
            'areas_id'=> $request['areasID'],
            'district_id'=> $request['district_id'],
            'city_village'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'address'=> $request['address'],
            'alphabet'=> $in,
        ]);
        $protocols->where('firm_id','=',$firm->id)->update($data_protocols);

        Session::flash('message', 'Фирмата е редактирана успешно!');
        return Redirect::to('/админ/производители');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firm = Factory::findOrFail($id);
        FactoryProtocol::where('firm_id','=',$firm->id)->delete();

        $firm->delete();

        Session::flash('message', 'Фирмата е изтрита успешно!');
        return Redirect::to('/админ/производители');
    }
}
