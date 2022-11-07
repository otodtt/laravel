<?php
namespace odbh\Http\Controllers;

use Auth;
use odbh\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use odbh\Http\Requests\ChangePharmaciesRequest;
use odbh\Http\Requests\ChangeRepositoriesRequest;
use odbh\Http\Requests\ChangeWorkshopsRequest;
//use odbh\Http\Controllers\Controller;
use odbh\Pharmacy;
use odbh\Firm;
use odbh\Location;
use odbh\Repository;
use odbh\Set;
use odbh\Director;
use odbh\User;
use odbh\Workshop;
use Session;
use odbh\Area;

class DocumentsController extends Controller
{
    private $logo = null;

    private $objects_districts_select = null;

    private $index = null;

    ////// За Инспекторите
    private $inspectors_add = null;

    private $only_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['edit_pharmacy_edition', 'update_pharmacy_edition',
                                                'edit_repository_edition', 'update_repository_edition',
                                                'edit_workshop_edition', 'update_workshop_edition',
                                                'unlocks_pharmacy', 'unlocks_repository', 'unlocks_workshop',
                                                'locks_pharmacy', 'locks_repository', 'locks_workshop']]);
        $this->middleware('admin', ['only'=>['unlocks_pharmacy', 'unlocks_repository', 'unlocks_workshop']]);

        $this->logo = Set::all()->toArray();

        $districts_select = $this->districts_list->toArray();
        $districts_select[''] = 'Избери община';
        $districts_select = array_sort_recursive($districts_select);
        $this->objects_districts_select = $districts_select;

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_rz_list->toArray();
        $inspectors_add[''] = '--Избери!--';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        $only_id = Area::select('id')->lists('id', 'id')->toArray();
        $only_id[''] = '--';
        $this->only_id = array_sort_recursive($only_id);
    }

    /** **************** АПТЕКИ ************ */
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @return \Illuminate\Http\Response
     */
    public function index_pharmacy($id, $id_obj)
    {
        $firm = Firm::findOrFail($id);
        $pharmacy = Pharmacy::findOrFail($id_obj);
        $areas = $this->areas_all;
        $index = $this->index;
        $logo = $this->logo;

        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $index[0]['area_id'])
            ->where('district_id', '=', $pharmacy->district_object)
            ->where('type_district', '=', 1)
            ->get();
        foreach($districts_object as $value){
            $districts_name_object = $value->name;
        }

        $area_name = Set::select('area')->get()->toArray();

        $director = Director::select('name', 'family', 'degree', 'type_dir')
                    ->where('start_date','<=',$pharmacy->date_licence)
                    ->where('end_date','>=',$pharmacy->date_licence)
                    ->get()->toArray();

        $object_type = 1;

        return view('objects.documents_all.documents_pharmacy.index', compact('firm', 'pharmacy', 'areas', 'districts_firm',
        'index', 'logo', 'area_name', 'object_type', 'director', 'districts_name_object'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @param  int  $edition опционален при показване на  изданието
     * @return \Illuminate\Http\Response
     */
    public function edition_pharmacy($id, $id_obj, $edition = null)
    {
        $firm = Firm::findOrFail($id);
        $pharmacy = Pharmacy::findOrFail($id_obj);
        $areas = $this->areas_all;
        $index = $this->index;
        $logo = $this->logo;

        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $area_name = Set::select('area')->get()->toArray();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $index[0]['area_id'])
            ->where('district_id', '=', $pharmacy->district_object)
            ->where('type_district', '=', 1)
            ->get();
        foreach($districts_object as $value){
            $districts_name_object = $value->name;
        }

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$pharmacy->date_edition)
            ->where('end_date','>=',$pharmacy->date_edition)
            ->get()->toArray();

        $object_type = 1;

        return view('objects.documents_all.documents_pharmacy.index', compact('firm', 'pharmacy', 'areas', 'districts_firm',
            'index', 'id','id_obj', 'logo', 'area_name', 'object_type', 'director', 'edition', 'districts_name_object'));
    }

    /**
     * Отклюва удостоверението за Аптеки.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlocks_pharmacy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $data = (['locks' => 0,]);
        $firm = $pharmacy->firm_id;
        $pharmacy->fill($data);
        $pharmacy->save();

        return Redirect::to('/аптека-удостоверение/'.$firm.'/'.$pharmacy->id);
    }

    /**
     * Заключва удостоверението за Аптеки.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function locks_pharmacy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $data = (['locks' => 1,]);
        $firm = $pharmacy->firm_id;
        $pharmacy->fill($data);
        $pharmacy->save();

        return Redirect::to('/аптека-удостоверение/'.$firm.'/'.$pharmacy->id);
    }

    /**
     * Редакция на Удостоверението.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @return \Illuminate\Http\Response
     */
    public function edit_pharmacy_edition($id, $id_obj){

        $pharmacy = Pharmacy::findOrFail($id_obj);

        $index = $this->index;
        $inspectors_active = $this->inspectors_add;
        $inspectors_db = Pharmacy::where('id_user_change','!=',0)->lists('list_change', 'id_user_change')->toArray();
        $inspectors = $inspectors_active + $inspectors_db;

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

        return view('objects.documents_all.edit_documents.edit_pharmacy_edition', compact('pharmacy',  'districts', 'locations',
            'only_id', 'inspectors', 'index',  'selected_area', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\ChangePharmaciesRequest $request
     *
     * @param  int  $id_obj
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_pharmacy_edition(ChangePharmaciesRequest $request, $id, $id_obj)
    {
        $pharmacy = Pharmacy::findOrFail($id_obj);
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
            'date_edition' => strtotime($request['date_edition']),
            'user_change' => $inspector_name,
            'id_user_change' =>  $request['user_change'],
            'list_change' =>  $list_change,
            'updated_by_user' => Auth::user()->id,
            'date_update' => time(),
            'active' => (int)$request['active'],
            'locks' => 0,
        ]);
        $pharmacy->fill($data);
        $pharmacy->save();

        Session::flash('message', 'Удостоверението на Аптеката e редактирано успешно!');
        return Redirect::to('/аптека-удостоверение/'.$pharmacy->firm_id.'/'.$pharmacy->id.'/'.$pharmacy->edition);
    }
    /** **************** КРАЙ АПТЕКИ ************ */

    /** **************** СКЛАДОВЕ ************ */
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @return \Illuminate\Http\Response
     */
    public function index_repository($id, $id_obj)
    {
        $firm = Firm::findOrFail($id);
        $repository = Repository::findOrFail($id_obj);
        $areas = $this->areas_all;
        $index = $this->index;
        $logo = $this->logo;

        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $index[0]['area_id'])
            ->where('district_id', '=', $repository->district_object)
            ->where('type_district', '=', 1)
            ->get();
        foreach($districts_object as $value){
            $districts_name_object = $value->name;
        }

        $area_name = Set::select('area')->get()->toArray();

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$repository->date_licence)
            ->where('end_date','>=',$repository->date_licence)
            ->get()->toArray();

        $object_type = 2;

        return view('objects.documents_all.documents_repository.index', compact('firm', 'repository', 'areas', 'districts_firm',
            'index', 'logo', 'area_name', 'object_type', 'director', 'districts_name_object'));
    }

    /**
     * Отклюва удостоверението за Складове.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlocks_repository($id)
    {
        $repository = Repository::findOrFail($id);
        $data = (['locks' => 0,]);
        $firm = $repository->firm_id;
        $repository->fill($data);
        $repository->save();

        return Redirect::to('/склад-удостоверение/'.$firm.'/'.$repository->id);
    }

    /**
     * Заключва удостоверението за Складове.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function locks_repository($id)
    {
        $repository = Repository::findOrFail($id);
        $data = (['locks' => 1,]);
        $firm = $repository->firm_id;
        $repository->fill($data);
        $repository->save();

        return Redirect::to('/склад-удостоверение/'.$firm.'/'.$repository->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @param  int  $edition опционален при показване на  изданието
     * @return \Illuminate\Http\Response
     */
    public function edition_repository($id, $id_obj, $edition = null)
    {
        $firm = Firm::findOrFail($id);
        $repository = Repository::findOrFail($id_obj);
        $areas = $this->areas_all;
        $index = $this->index;
        $logo = $this->logo;

        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $area_name = Set::select('area')->get()->toArray();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $index[0]['area_id'])
            ->where('district_id', '=', $repository->district_object)
            ->where('type_district', '=', 1)
            ->get();
        foreach($districts_object as $value){
            $districts_name_object = $value->name;
        }

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$repository->date_edition)
            ->where('end_date','>=',$repository->date_edition)
            ->get()->toArray();

        $object_type = 2;

        return view('objects.documents_all.documents_repository.index', compact('firm', 'repository', 'areas', 'districts_firm',
            'index', 'id','id_obj', 'logo', 'area_name', 'object_type', 'director', 'edition', 'districts_name_object'));
    }

    /**
     * Редакция на Удостоверението.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @return \Illuminate\Http\Response
     */
    public function edit_repository_edition($id, $id_obj){

        $repository = Repository::findOrFail($id_obj);

        $index = $this->index;
        $inspectors_active = $this->inspectors_add;
        $inspectors_db = Repository::where('id_user_change','!=',0)->lists('list_change', 'id_user_change')->toArray();
        $inspectors = $inspectors_active + $inspectors_db;

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

        return view('objects.documents_all.edit_documents.edit_repository_edition', compact('repository',  'districts', 'locations',
            'only_id', 'inspectors', 'index',  'selected_area', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\ChangePharmaciesRequest $request
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @return \Illuminate\Http\Response
     */
    public function update_repository_edition(ChangeRepositoriesRequest $request, $id, $id_obj)
    {
        $repository = Repository::findOrFail($id_obj);
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
            'date_edition' => strtotime($request['date_edition']),
            'user_change' => $inspector_name,
            'id_user_change' =>  $request['user_change'],
            'list_change' =>  $list_change,
            'updated_by_user' => Auth::user()->id,
            'date_update' => time(),
            'active' => (int)$request['active'],
            'locks' => 0,
        ]);
        $repository->fill($data);
        $repository->save();

        Session::flash('message', 'Удостоверението на Склада e редактирано успешно!');
        return Redirect::to('/склад-удостоверение/'.$repository->firm_id.'/'.$repository->id.'/'.$repository->edition);
    }
    /** **************** КРАЙ СКЛАДОВЕ ************ */

    /** **************** ЦЕХОВЕ ************ */
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @return \Illuminate\Http\Response
     */
    public function index_workshop($id, $id_obj)
    {
        $firm = Firm::findOrFail($id);
        $workshop = Workshop::findOrFail($id_obj);
        $areas = $this->areas_all;
        $index = $this->index;
        $logo = $this->logo;

        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $index[0]['area_id'])
            ->where('district_id', '=', $workshop->district_object)
            ->where('type_district', '=', 1)
            ->get();
        foreach($districts_object as $value){
            $districts_name_object = $value->name;
        }

        $area_name = Set::select('area')->get()->toArray();

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$workshop->date_licence)
            ->where('end_date','>=',$workshop->date_licence)
            ->get()->toArray();

        $object_type = 3;

        return view('objects.documents_all.documents_workshop.index', compact('firm', 'workshop', 'areas', 'districts_firm',
            'index', 'logo', 'area_name', 'object_type', 'director', 'districts_name_object'));
    }

    /**
     * Отклюва удостоверението за Складове.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlocks_workshop($id)
    {
        $workshop = Workshop::findOrFail($id);
        $data = (['locks' => 0,]);
        $firm = $workshop->firm_id;
        $workshop->fill($data);
        $workshop->save();

        return Redirect::to('/цех-удостоверение/'.$firm.'/'.$workshop->id);
    }

    /**
     * Заключва удостоверението за Складове.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function locks_workshop($id)
    {
        $workshop = Workshop::findOrFail($id);
        $data = (['locks' => 1,]);
        $firm = $workshop->firm_id;
        $workshop->fill($data);
        $workshop->save();

        return Redirect::to('/цех-удостоверение/'.$firm.'/'.$workshop->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @param  int  $edition опционален при показване на  изданието
     * @return \Illuminate\Http\Response
     */
    public function edition_workshop($id, $id_obj, $edition = null)
    {
        $firm = Firm::findOrFail($id);
        $workshop = Workshop::findOrFail($id_obj);
        $areas = $this->areas_all;
        $index = $this->index;
        $logo = $this->logo;

        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $area_name = Set::select('area')->get()->toArray();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $index[0]['area_id'])
            ->where('district_id', '=', $workshop->district_object)
            ->where('type_district', '=', 1)
            ->get();
        foreach($districts_object as $value){
            $districts_name_object = $value->name;
        }

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$workshop->date_edition)
            ->where('end_date','>=',$workshop->date_edition)
            ->get()->toArray();

        $object_type = 3;

        return view('objects.documents_all.documents_workshop.index', compact('firm', 'workshop', 'areas', 'districts_firm',
            'index', 'id','id_obj', 'logo', 'area_name', 'object_type', 'director', 'edition', 'districts_name_object'));
    }

    /**
     * Редакция на Удостоверението.
     *
     * @param  int  $id
     * @param  int  $id_obj
     * @return \Illuminate\Http\Response
     */
    public function edit_workshop_edition($id, $id_obj)
    {
        $workshop = Workshop::findOrFail($id_obj);

        $index = $this->index;
        $inspectors_active = $this->inspectors_add;
        $inspectors_db = Workshop::where('id_user_change','!=',0)->lists('list_change', 'id_user_change')->toArray();
        $inspectors = $inspectors_active + $inspectors_db;

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

        return view('objects.documents_all.edit_documents.edit_workshop_edition', compact('workshop',  'districts', 'locations',
            'only_id', 'inspectors', 'index',  'selected_area', 'name_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\ChangeWorkshopsRequest $request
     *
     * @param  int  $id_obj
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_workshop_edition(ChangeWorkshopsRequest $request, $id, $id_obj)
    {
        $workshop = Workshop::findOrFail($id_obj);
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
            'date_edition' => strtotime($request['date_edition']),
            'user_change' => $inspector_name,
            'id_user_change' =>  $request['user_change'],
            'list_change' =>  $list_change,
            'updated_by_user' => Auth::user()->id,
            'date_update' => time(),
            'active' => (int)$request['active'],
            'locks' => 0,
        ]);
        $workshop->fill($data);
        $workshop->save();

        Session::flash('message', 'Удостоверението на Цеха e редактирано успешно!');
        return Redirect::to('/цех-удостоверение/'.$workshop->firm_id.'/'.$workshop->id.'/'.$workshop->edition);
    }
    /** **************** КРАЙ СКЛАДОВЕ ************ */
}