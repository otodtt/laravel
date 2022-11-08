<?php

namespace odbh\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Redirect;

use odbh\Area;
use odbh\Firm;
use odbh\Http\Requests;

use odbh\Http\Requests\ChangeFirmsRequest;
use odbh\Http\Requests\ChangePharmaciesRequest;
use odbh\Http\Requests\ChangeRepositoriesRequest;
use odbh\Http\Requests\ChangeWorkshopsRequest;
use odbh\Location;
use odbh\Pharmacy;
use odbh\Repository;
use odbh\Set;
use odbh\User;
use odbh\Workshop;
use Session;


class ChangeObjectsController extends Controller
{
    /**  Лист на общините които са зададени от настройките */
    private $objects_districts_select = null;

    private $index = null;

    ///// За Инспекторите
    private $inspectors = null;

    private $only_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('control');

        $areas = $this->districts_list->toArray();
        $areas[''] = 'Избери община';
        $areas = array_sort_recursive($areas);
        $this->objects_districts_select = $areas;

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();

        $inspectors = $this->inspectors_active_rz_list->toArray();
        $inspectors[''] = '--Избери!--';
        $this->inspectors = array_sort_recursive($inspectors);

        $only_id = Area::select('id')->lists('id', 'id')->toArray();
        $only_id[''] = '--';
        $this->only_id = array_sort_recursive($only_id);
    }

    /**
     * За промяна в обстоятелствата при промени във фирмта
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function change_firm($id)
    {
        $index = $this->index;

        $firm = Firm::findOrFail($id);

        $get_session = Session::get('_old_input', 'hidden');
        if(isset($get_session['hidden']) && ((int)$get_session != (int)$firm->id_region)){
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

        $regions = Area::lists('areas_name', 'id');

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'desc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

        $locations = Location::select()
            ->where('areas_id', '=', $selected)
            ->where('district_id', '=', $selected_district)
            ->where('tvm', '!=', 0)
            ->orderBy('tvm', 'asc')
            ->orderBy('type_district', 'desc')
            ->orderBy('name', 'asc')
            ->get()->toArray();

        $name_location = $firm->location;
        $inspectors = $this->inspectors;

        $max_date_licence[] = Pharmacy::where('firm_id','=',$firm->id)->max('date_licence');
        $max_date_licence[] = Repository::where('firm_id','=',$firm->id)->max('date_licence');
        $max_date_licence[] = Workshop::where('firm_id','=',$firm->id)->max('date_licence');
        $max_date_licence[] = Pharmacy::where('firm_id','=',$firm->id)->max('date_edition');
        $max_date_licence[] = Repository::where('firm_id','=',$firm->id)->max('date_edition');
        $max_date_licence[] = Workshop::where('firm_id','=',$firm->id)->max('date_edition');
        $date_licence_max = date('d.m.Y', max($max_date_licence));

        return view('objects.change.change_firm', compact('firm', 'index', 'regions', 'district_list','locations',
                    'selected', 'selected_district', 'name_location', 'inspectors', 'id', 'date_licence_max'));
    }

    /**
     * Запазва промените във фирмата при промяна в обстоятелствата
     *
     * @param  int  $id
     *
     * @param  \odbh\Http\Requests\ChangeFirmsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store_firm(ChangeFirmsRequest $request, $id)
    {
        $sex = null;
        $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['user_change'])->get()->toArray();
        $inspector_name = $inspector_name_sql[0]['full_short_name'];
        $list_change = $inspector_name_sql[0]['short_name'];

        if(strlen($request['gender']) == 4){
            $sex = 1;
        }
        if(strlen($request['gender']) == 6){
            $sex = 2;
        }

        $firm = Firm::findOrFail($id);
        $data_firm =([
            'postal_code'=> $request['postal_code'],
            'areas_id'=> $request['areasID'],
            'district_id'=> $request['district_id'],
            'type_location'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'address'=> $request['address'],
            'sex'=> $sex,
            'owner'=> mb_convert_case  ($request['owner'], MB_CASE_TITLE, "UTF-8"),
            'egn'=> $request['pin'],
            'phone'=> $request['phone'],
            'mobil'=> $request['mobil'],
            'email'=> $request['email'],
            'date_update'=> time(),
            'updated_by'=> Auth::user()->id,
            'updated_for'=> 2,
        ]);

        $data_update = (['date_edition'=>strtotime($request['date_edition']), 'active'=>$request['active'],
                        'number_change'=> $request['number_change'], 'date_change'=>strtotime($request['date_change']),
                        'user_change'=>$inspector_name, 'id_user_change'=>$request['user_change'],
                        'list_change'=>$list_change, 'locks'=> 0
                        ]);

        $firm->pharmacies()->where('firm_id','=',$id)->update($data_update);
        $firm->pharmacies()->where('firm_id','=',$id)->increment('edition', 1);
        /////////
        $firm->repositories()->where('firm_id','=',$id)->update($data_update);
        $firm->repositories()->where('firm_id','=',$id)->increment('edition', 1);
        /////////
        $firm->workshops()->where('firm_id','=',$id)->update($data_update);
        $firm->workshops()->where('firm_id','=',$id)->increment('edition', 1);


        $firm->fill($data_firm);
        $firm->save();

        Session::flash('message', 'Промените са запазени!');
        return Redirect::to('/фирма/'.$id);
    }

    /**
     * За промяна в обстоятелствата при промени във фирмта
     *
     *  @param  int  $id_obj
     *  @param  int  $type_obj
     *  @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function change_firm__object($id, $id_obj, $type_obj)
    {
        $index = $this->index;

        $firm = Firm::findOrFail($id);

        $get_session = Session::get('_old_input', 'hidden');

        if(isset($get_session['hidden']) && ((int)$get_session != (int)$firm->id_region)){
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
        $regions = Area::lists('areas_name', 'id');

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'desc')
            ->lists('name', 'district_id')->toArray();
        $district_list[0] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

        $locations = Location::select()
            ->where('areas_id', '=', $selected)
            ->where('district_id', '=', $selected_district)
            ->where('tvm', '!=', 0)
            ->orderBy('tvm', 'asc')
            ->orderBy('type_district', 'desc')
            ->orderBy('name', 'asc')
            ->get()->toArray();

        $name_location = $firm->location;
        $inspectors = $this->inspectors;

        return view('objects.change.change_firm_object', compact('firm', 'index', 'district_list', 'regions', 'areas','locations',
            'selected', 'selected_district', 'name_location', 'inspectors', 'id', 'id_obj', 'type_obj'));
    }

    /**
     * Запазва промените във фирмата при промяна в обстоятелствата на обект
     *
     * @param  int  $id_obj
     * @param  int  $type_obj optional
     * @param  int  $id
     *
     * @param  \odbh\Http\Requests\ChangeFirmsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store_firm_object(ChangeFirmsRequest $request, $id, $id_obj, $type_obj)
    {
        $sex = null;
        if(strlen($request['gender']) == 4){
            $sex = 1;
        }
        if(strlen($request['gender']) == 6){
            $sex = 2;
        }

        $firm = Firm::findOrFail($id);
        $data_firm =([
            'postal_code'=> $request['postal_code'],
            'areas_id'=> $request['areasID'],
            'district_id'=> $request['district_id'],
            'type_location'=> $request['data_tmv'],
            'location'=> $request['list_name'],
            'address'=> $request['address'],
            'sex'=> $sex,
            'owner'=> mb_convert_case  ($request['owner'], MB_CASE_TITLE, "UTF-8"),
            'egn'=> $request['pin'],
            'phone'=> $request['phone'],
            'mobil'=> $request['mobil'],
            'email'=> $request['email'],
            'date_update'=> time(),
            'updated_by'=> Auth::user()->id,
            'updated_for'=> 2,
        ]);

        if($id_obj > 0 && $type_obj == 1) {
            $changed_object = Pharmacy::select('edition', 'date_edition', 'number_change', 'date_change', 'user_change', 'id_user_change', 'active', 'list_change')
                ->where('firm_id', '=', $id)->where('id', '=', $id_obj)->get()->toArray();
            $data_update = (['date_edition'=>$changed_object[0]['date_edition'], 'active'=>$changed_object[0]['active'],
                'number_change'=> $changed_object[0]['number_change'], 'date_change'=>$changed_object[0]['date_change'],
                'user_change'=>$changed_object[0]['user_change'], 'id_user_change'=>$changed_object[0]['id_user_change'],
                'list_change'=>$changed_object[0]['list_change'],'locks'=> 0
            ]);
            $firm->pharmacies()->where('firm_id','=',$id)->where('id','!=',$id_obj)->update($data_update);
            $firm->pharmacies()->where('firm_id','=',$id)->where('id','!=',$id_obj)->increment('edition', 1);
            $firm->repositories()->where('firm_id','=',$id)->update($data_update);
            $firm->repositories()->where('firm_id','=',$id)->increment('edition', 1);
            $firm->workshops()->where('firm_id','=',$id)->update($data_update);
            $firm->workshops()->where('firm_id','=',$id)->increment('edition', 1);
        }
        if($id_obj > 0 && $type_obj == 2){
            $changed_object = Repository::select('edition', 'date_edition', 'number_change', 'date_change', 'user_change', 'id_user_change', 'active', 'list_change')
                ->where('firm_id', '=', $id)->where('id', '=', $id_obj)->get()->toArray();
            $data_update = (['date_edition'=>$changed_object[0]['date_edition'], 'active'=>$changed_object[0]['active'],
                'number_change'=> $changed_object[0]['number_change'], 'date_change'=>$changed_object[0]['date_change'],
                'user_change'=>$changed_object[0]['user_change'], 'id_user_change'=>$changed_object[0]['id_user_change'],
                'list_change'=>$changed_object[0]['list_change'], 'locks'=> 0
            ]);
            $firm->pharmacies()->where('firm_id','=',$id)->update($data_update);
            $firm->pharmacies()->where('firm_id','=',$id)->increment('edition', 1);
            $firm->repositories()->where('firm_id','=',$id)->where('id','!=',$id_obj)->update($data_update);
            $firm->repositories()->where('firm_id','=',$id)->where('id','!=',$id_obj)->increment('edition', 1);
            $firm->workshops()->where('firm_id','=',$id)->update($data_update);
            $firm->workshops()->where('firm_id','=',$id)->increment('edition', 1);
        }
        if($id_obj > 0 && $type_obj == 3){
            $changed_object = Workshop::select('edition', 'date_edition', 'number_change', 'date_change', 'user_change', 'id_user_change', 'active', 'list_change')
                ->where('firm_id', '=', $id)->where('id', '=', $id_obj)->get()->toArray();
            $data_update = (['date_edition'=>$changed_object[0]['date_edition'], 'active'=>$changed_object[0]['active'],
                'number_change'=> $changed_object[0]['number_change'], 'date_change'=>$changed_object[0]['date_change'],
                'user_change'=>$changed_object[0]['user_change'], 'id_user_change'=>$changed_object[0]['id_user_change'],
                'list_change'=>$changed_object[0]['list_change'], 'locks'=> 0
            ]);
            $firm->pharmacies()->where('firm_id','=',$id)->update($data_update);
            $firm->pharmacies()->where('firm_id','=',$id)->increment('edition', 1);
            $firm->repositories()->where('firm_id','=',$id)->update($data_update);
            $firm->repositories()->where('firm_id','=',$id)->increment('edition', 1);
            $firm->workshops()->where('firm_id','=',$id)->where('id','!=',$id_obj)->update($data_update);
            $firm->workshops()->where('firm_id','=',$id)->where('id','!=',$id_obj)->increment('edition', 1);

        }

        $firm->fill($data_firm);
        $firm->save();

        Session::flash('message', 'Промените са запазени!');
        return Redirect::to('/фирма/'.$id);
    }

    /**
    * Показва лист с Регистрираните обекти на Фирмата
    *
    * @param  int  $id
    * @param  int  $id_obj
    * @param  int  $type_obj
    * @return \Illuminate\Http\Response
    */
    public function select($id, $id_obj, $type_obj)
    {
        return view('objects.change.select', compact('id', 'id_obj', 'type_obj') );
    }

    /**
     * За промяна в обстоятелствата при аптека.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_pharmacy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);

        $index = $this->index;
        $inspectors = $this->inspectors;

        $districts = $this->objects_districts_select;

        $only_id = $this->only_id;

        $get_session = Session::get('_old_input', 'localsID');
        if (!empty($get_session['localsID'])) {
            $selected_area = $get_session['localsID'];
        } else {
            $selected_area = $pharmacy->district_object;
        }

        $locations = Location::select()
            ->where('areas_id', '=', $this->area_get_id)
            ->where('district_id', '=', $selected_area)
            ->where('tvm', '!=', 0)
            ->orderBy('tvm', 'asc')
            ->orderBy('district_id', 'asc')
            ->get()->toArray();
        $name_location = $pharmacy->location;

        return view('objects.change.change_pharmacy', compact('pharmacy',  'districts', 'locations',
            'only_id', 'inspectors', 'index', 'selected_area', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\ChangePharmaciesRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function store_pharmacy(ChangePharmaciesRequest $request, $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);

        $this->validate($request, [
            'date_edition' => 'after:'.date('d.m.Y', $pharmacy->date_licence),
        ]);
        $data = array();
        if ($pharmacy->raz_udost == 1){
            $data = ([
                'number_change' => (int)$request['number_change'],
                'date_change' => strtotime($request['date_change']),
                'district_object' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'edition' => $pharmacy->edition+1,
                'date_edition' => strtotime($request['date_edition']),
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
                'active' => (int)$request['active'],
                'locks' => 0,
            ]);
        }
        elseif ($pharmacy->raz_udost == 2){
            $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['user_change'])->get()->toArray();
            $inspector_name = $inspector_name_sql[0]['full_short_name'];
            $list_change = $inspector_name_sql[0]['short_name'];
            $data = ([
                'number_change' => (int)$request['number_change'],
                'date_change' => strtotime($request['date_change']),
                'district_object' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'seller' => mb_convert_case($request['seller'], MB_CASE_TITLE, "UTF-8"),
                'certificate' => (int)$request['certificate'],
                'index_certificate' => $request['index_certificate'],
                'date_certificate' => $request['date_certificate'],
                'edition' => $pharmacy->edition+1,
                'date_edition' => strtotime($request['date_edition']),
                'user_change' => $inspector_name,
                'id_user_change' =>  $request['user_change'],
                'list_change' =>  $list_change,
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
                'active' => (int)$request['active'],
                'locks' => 0,
            ]);
        }
        $pharmacy->fill($data);
        $pharmacy->save();

        Session::flash('message', 'Промяната на Аптеката e направена успешно!');
        return Redirect::to('/фирма/'.$pharmacy->firm_id.'/избери/'.$pharmacy->id.'/1' );
    }

    /**
     * За промяна в обстоятелствата при СКЛАД.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_repository($id)
    {
        $repository = Repository::findOrFail($id);

        $index = $this->index;
        $inspectors = $this->inspectors;

        $districts = $this->objects_districts_select;

        $only_id = $this->only_id;

        $get_session = Session::get('_old_input', 'localsID');
        if (!empty($get_session['localsID'])) {
            $selected_area = $get_session['localsID'];
        } else {
            $selected_area = $repository->district_object;
        }

        $locations = Location::select()
            ->where('areas_id', '=', $this->area_get_id)
            ->where('district_id', '=', $selected_area)
            ->where('tvm', '!=', 0)
            ->orderBy('tvm', 'asc')
            ->orderBy('district_id', 'asc')
            ->get()->toArray();
        $name_location = $repository->location;

        return view('objects.change.change_repository', compact('repository',  'districts', 'locations',
            'only_id', 'inspectors', 'index','selected_area', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\ChangeRepositoriesRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function store_repository(ChangeRepositoriesRequest $request, $id)
    {
        $repository = Repository::findOrFail($id);
        $data = array();
        if ($repository->raz_udost == 1){
            $data = ([
                'number_change' => (int)$request['number_change'],
                'date_change' => strtotime($request['date_change']),
                'district_object' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'edition' => $repository->edition+1,
                'date_edition' => strtotime($request['date_edition']),
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
                'active' => (int)$request['active'],
                'locks' => 0,
            ]);
        }
        elseif ($repository->raz_udost == 2){
            $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['user_change'])->get()->toArray();
            $inspector_name = $inspector_name_sql[0]['full_short_name'];
            $list_change = $inspector_name_sql[0]['short_name'];
            $data = ([
                'number_change' => (int)$request['number_change'],
                'date_change' => strtotime($request['date_change']),
                'id_area' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'seller' => mb_convert_case($request['seller'], MB_CASE_TITLE, "UTF-8"),
                'certificate' => (int)$request['certificate'],
                'index_certificate' => $request['index_certificate'],
                'date_certificate' => $request['date_certificate'],
                'edition' => $repository->edition+1,
                'date_edition' => strtotime($request['date_edition']),
                'user_change' => $inspector_name,
                'id_user_change' =>  $request['user_change'],
                'list_change' =>  $list_change,
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
                'active' => (int)$request['active'],
                'locks' => 0,
            ]);
        }

        $repository->fill($data);
        $repository->save();

        Session::flash('message', 'Промяната на Склада e направена успешно!');
        return Redirect::to('/фирма/'.$repository->firm_id.'/избери/'.$repository->id.'/2' );
    }

    /**
     * За промяна в обстоятелствата при ЦЕХ.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_workshop($id)
    {
        $workshop = Workshop::findOrFail($id);

        $index = $this->index;
        $inspectors = $this->inspectors;

        $districts = $this->objects_districts_select;

        $only_id = $this->only_id;

        $get_session = Session::get('_old_input', 'localsID');
        if (!empty($get_session['localsID'])) {
            $selected_area = $get_session['localsID'];
        } else {
            $selected_area = $workshop->district_object;
        }

        $locations = Location::select()
            ->where('areas_id', '=', $this->area_get_id)
            ->where('district_id', '=', $selected_area)
            ->where('tvm', '!=', 0)
            ->orderBy('tvm', 'asc')
            ->orderBy('district_id', 'asc')
            ->get()->toArray();

        $name_location = $workshop->location;

        return view('objects.change.change_workshop', compact('workshop',  'districts', 'locations',
            'only_id', 'inspectors', 'index', 'selected_area', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\ChangeWorkshopsRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function store_workshop(ChangeWorkshopsRequest $request, $id)
    {
        $workshop = Workshop::findOrFail($id);
        $data = array();
        if ($workshop->raz_udost == 1){
            $data = ([
                'number_change' => (int)$request['number_change'],
                'date_change' => strtotime($request['date_change']),
                'district_object' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'edition' => $workshop->edition+1,
                'date_edition' => strtotime($request['date_edition']),
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
                'active' => (int)$request['active'],
                'locks' => 0,
            ]);
        }
        elseif ($workshop->raz_udost == 2){
            $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['user_change'])->get()->toArray();
            $inspector_name = $inspector_name_sql[0]['full_short_name'];
            $list_change = $inspector_name_sql[0]['short_name'];
            $data = ([
                'number_change' => (int)$request['number_change'],
                'date_change' => strtotime($request['date_change']),
                'id_area' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'seller' => mb_convert_case($request['seller'], MB_CASE_TITLE, "UTF-8"),
                'certificate' => (int)$request['certificate'],
                'index_certificate' => $request['index_certificate'],
                'date_certificate' => $request['date_certificate'],
                'edition' => $workshop->edition+1,
                'date_edition' => strtotime($request['date_edition']),
                'user_change' => $inspector_name,
                'id_user_change' =>  $request['user_change'],
                'list_change' =>  $list_change,
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
                'active' => (int)$request['active'],
                'locks' => 0,
            ]);
        }
        $workshop->fill($data);
        $workshop->save();

        Session::flash('message', 'Промяната на Цеха e направена успешно!');
        return Redirect::to('/фирма/'.$workshop->firm_id.'/избери/'.$workshop->id.'/3' );
    }
}
