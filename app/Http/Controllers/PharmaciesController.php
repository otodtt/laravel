<?php
namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use odbh\Area;
use odbh\Firm;
use odbh\Http\Requests;
use odbh\Http\Requests\PermitRequest;
use odbh\Http\Requests\PharmaciesRequest;
use odbh\Http\Requests\PharmaciesUpdateRequest;
use odbh\Location;
use odbh\Pharmacy;
use odbh\Repository;
use odbh\Set;
use odbh\User;
use odbh\Workshop;
use Session;

class PharmaciesController extends Controller
{
    /**  Лист на общините които са зададени от настройките */
    private $objects_districts_select = null;

    private $objects_districts_list = null;

    private $index = null;

    ////// За Инспекторите
    private $inspectors_add = null;

    private $only_id = null;

    /**
     * PharmaciesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy', 'create_permits', 'store_permit', 'add', 'store_add']]);

        $districts_select = $this->districts_list->toArray();
        $districts_select[''] = 'Избери община';
        $districts_select = array_sort_recursive($districts_select);
        $this->objects_districts_select = $districts_select;

        $districts_sort = $this->districts_list->toArray();
        $districts_sort[0] = 'Сортирай по община';
        $districts_sort = array_sort_recursive($districts_sort);
        $this->objects_districts_list = $districts_sort;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abc = null;
        $alphabet = Pharmacy::where('end_date','>',time())->where('active','=',0)->lists('alphabet')->toArray();

        $districts = $this->objects_districts_list;

        $pharmacies = Pharmacy::where('end_date','>',time())->where('active','=',0)->orderBy('alphabet', 'asc')->get();
        return view('objects.pharmacies.index', compact('pharmacies', 'alphabet', 'districts', 'abc'));
    }

    /**
     * Сортиране на Аптеките
     *
     * @param  int $abc_list
     * @param  int $areas_list
     * @param  int $years_list
     * @param  int $licence_list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort($abc_list = null, $areas_list = null, $years_list = null, $licence_list = null)
    {
//        $pharmacies_all = Pharmacy::where('end_date','>',time())->where('active','=',0)->orderBy('alphabet', 'asc')->get();

        $alphabet = Pharmacy::where('end_date','>',time())->where('active','=',0)->lists('alphabet')->toArray();

        $districts = $this->objects_districts_list;

        if (Input::has('areas_sort') || Input::has('years_sort') || Input::has('licence_sort') || Input::has('abc')) {
            $abc = Input::get('abc');
            $areas_sort = Input::get('areas_sort');
            $years_sort = Input::get('years_sort');
            $licence_sort = Input::get('licence_sort');
        }
        else {
            $abc = $abc_list;
            $areas_sort = $areas_list;
            $years_sort = $years_list;
            $licence_sort = $licence_list;
        }
//        dd($licence_sort);
        if ((!array_key_exists($areas_sort, $districts) || $years_sort >= 6 || $licence_sort >= 3)
            && (!in_array((int)$abc, $alphabet) && (int)$abc != 0)) {
            //TODO Ако някой промени селект менюто
        }
        else {
            $areas_sql = null;
            $years_sql = null;
            $licence_sql = null;
            $abc_sql = null;
            if ($abc == 0) {
                $abc_sql = 'AND alphabet>0';
            } else {
                $abc_sql = 'AND alphabet=' . (int)$abc;
            }
            /// За избор на Общината
            if ((int)$areas_sort > 0) {
                $areas_sql = 'AND district_object=' . (int)$areas_sort;
            }
            if ((int)$areas_sort == 0) {
                $areas_sql = '';
            }
            ///// За избор на година
            $time_start = null;
            $time_end = null;
            if ((int)$years_sort > 0) {
                $start_year = '01.01.'.$years_sort;
                $time_start = strtotime(stripslashes($start_year));
                $end_year = '31.12.'.$years_sort;
                $time_end = strtotime(stripslashes($end_year));
            }
            if ((int)$years_sort > 0) {
                $years_sql = ' AND end_date > ' . $time_start . ' AND end_date < ' . $time_end;
            }
            if ((int)$years_sort == 0) {
                $years_sql = '';
            }
            ///// За избор ВИДА на Лиценза
            $active = 0;
            if ((int)$licence_sort == 1) {
//                $licence_sql = 'AND raz_udost= 2  AND end_date < '.time();
                $licence_sql = ' ';
                $active = 1;
            }
            if ((int)$licence_sort == 2) {
                $licence_sql = 'AND end_date < '.time();
            }
            if ((int)$licence_sort == 0) {
                $licence_sql = '';
            }

            $pharmacies = DB::select("SELECT * FROM `pharmacies` WHERE end_date > '.time().' AND active = $active $areas_sql $years_sql $licence_sql $abc_sql ");
//            dd("SELECT * FROM `pharmacies` WHERE end_date > '.time().' AND active = $active $areas_sql $years_sql $licence_sql $abc_sql ");
        }
        return view('objects.pharmacies.index', compact('pharmacies', 'districts', 'alphabet', 'abc', 'areas_sort', 'years_sort', 'licence_sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $districts = $this->objects_districts_select;
        $index = $this->index;
        $inspectors = $this->inspectors_add;
        $firm = Firm::findOrFail($id);

        $districts_firm_show = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $areas_firm = $this->areas_all;

        $get_session = Session::get('_old_input', 'localsID');
        if (!empty($get_session['localsID'])) {
            $selected = $get_session['localsID'];

            $locations = Location::select()
                ->where('areas_id', '=', $this->area_get_id)
                ->where('district_id', '=', $selected)
                ->where('tvm', '!=', 0)
                ->orderBy('tvm', 'asc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();

        } else {
            $locations = Location::select()
                ->where('areas_id', '=', $this->area_get_id)
                ->where('tvm', '!=', 0)
                ->orderBy('tvm', 'asc')
                ->orderBy('district_id', 'asc')
                ->get()->toArray();
        }

        $only_id = $this->only_id;

        $firm_id = $firm->id;

        $last_number = Pharmacy::select('number_licence')
            ->where('raz_udost', '=', 2)
            ->orderBy('number_licence', 'desc')
            ->limit(1)->get()->toArray();

        return view('objects.pharmacies.create_pharmacy', compact('firm', 'districts', 'districts_firm_show', 'areas_firm', 'locations',
            'only_id', 'inspectors', 'index', 'firm_id', 'last_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\PharmaciesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmaciesRequest $request)
    {
        $firm = Firm::select()->where('id', '=', $request['hidden'])->get()->toArray();
        $index_in = Set::select('index_in')->get()->toArray();
        $index_ur = Set::select('area_id')->get();
        $end_date = strtotime('+10 years', strtotime($request['date_licence']));
        $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql[0]['full_short_name'];
        $list_name = $inspector_name_sql[0]['short_name'];

        $data = ([
            'index_licence' => (int)$index_ur[0]['area_id'] . '1',
            'number_licence' => (int)$request['number_licence'],
            'date_licence' => strtotime(stripslashes($request['date_licence'])),
            'raz_udost' => 2,
            'index_petition' => $index_in[0]['index_in'],
            'number_petition' => (int)$request['number_petition'],
            'date_petition' => strtotime(stripslashes($request['date_petition'])),
            'type_firm' => $firm[0]['type_firm'],
            'name' => $firm[0]['name'],
            'district_object' => $request['localsID'],
            'tvm_id' => $request['data_id'],
            'type_location' => $request['data_tmv'],
            'location' => $request['list_name'],
            'alphabet' => $firm[0]['alphabet'],
            'address' => $request['address'],
            'end_date' => $end_date,
            'seller' => mb_convert_case($request['seller'], MB_CASE_TITLE, "UTF-8"),
            'certificate' => (int)$request['certificate'],
            'index_certificate' => $request['index_certificate'],
            'date_certificate' => $request['date_certificate'],
            'inspector' => (int)$request['inspector'],
            'inspector_name' => $inspector_name,
            'list_name' => $list_name,
            'added_by_user' => Auth::user()->id,
            'date_added' => time(),
        ]);
        /** @var Object $firm_many */
        $firm_many = Firm::findOrfail($request['hidden']);

        $repository = new Pharmacy($data);

        $firm_many->pharmacies()->save($repository);

        Session::flash('message', 'Аптеката и Удостоверението са добавени успешно!');
        return Redirect::to('/фирма/' . $firm[0]['id']);
    }

    /**
     * Показва всички области, общини и населени места
     * използва се пр jQuery и Ajax заявките
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @return \Illuminate\Http\JsonResponse
     */
    public function locations(Request $request)
    {
        $id_district = filter_input(INPUT_POST, 'val1');

        $selected_array = Set::select('area_id')->get()->toArray();
        $selected = $selected_array[0]['area_id'];

        $return_locals = null;

        $locations_js = Location::select()
            ->where('areas_id', '=', $selected)
            ->where('district_id', '=', $id_district)
            ->where('tvm', '!=', 0)
            ->orderBy('tvm', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        foreach ($locations_js as $local) {
            $return_locals[] = '<option value="' . $local->name . '" data_id="' . $local->id . '" data_ekatte="' . $local->ekatte . '"
                data_tmv="' . $local->tvm . '" data_pc="' . $local->postal_code . '" areas_id="' . $local->areas_id . '"
                district_id="' . $local->district_id . '" >' . $local->name . '</option>';
        }

        if ($request->ajax()) {
            return response()->json([
                $return_locals
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $firm_id
     * @param  int $id
     * @param  int $admin
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($firm_id, $id, $admin = null)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $firm = Firm::findOrFail($firm_id);

        $districts = $this->districts_list;
        $index = $this->index;

        $inspectors_active = $this->inspectors_add;
        $inspectors_db = Pharmacy::where('inspector','!=',0)->lists('list_name', 'inspector')->toArray();
        $inspectors = $inspectors_active + $inspectors_db;

        $districts_firm_show = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $areas_firm = $this->areas_all;

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
            ->orderBy('type_district', 'asc')
            ->get()->toArray();

        $name_location = $pharmacy->location;

        $last_number = Pharmacy::select('number_licence')
            ->where('raz_udost', '=', 2)
            ->orderBy('number_licence', 'desc')
            ->limit(1)->get()->toArray();

        return view('objects.pharmacies.edit_pharmacy', compact('pharmacy', 'firm', 'districts', 'districts_firm_show', 'areas_firm',
            'locations', 'only_id', 'inspectors', 'index', 'firm_id', 'selected_area', 'name_location', 'last_number', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\PharmaciesUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PharmaciesUpdateRequest $request, $id)
    {
        $data = null;
        $pharmacy = Pharmacy::findOrFail($id);
        if ($pharmacy->raz_udost == 1){
            $end_date = strtotime('+5 years', strtotime($request['date_licence']));
            $data = ([
                'active' => (int)$request['active'],
                'number_licence' => (int)$request['number_licence'],
                'date_licence' => strtotime(stripslashes($request['date_licence'])),
                'district_object' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'end_date' => $end_date,
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
            ]);
        }
        if ($pharmacy->raz_udost == 2){
            $end_date = strtotime('+10 years', strtotime(stripslashes($request['date_licence'])));
            $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['inspector'])->get()->toArray();
            $inspector_name = $inspector_name_sql[0]['full_short_name'];
            $list_name = $inspector_name_sql[0]['short_name'];

            $data = ([
                'active' => (int)$request['active'],
                'number_licence' => (int)$request['number_licence'],
                'date_licence' => strtotime(stripslashes($request['date_licence'])),
                'number_petition' => (int)$request['number_petition'],
                'date_petition' => strtotime(stripslashes($request['date_petition'])),
                'district_object' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'address' => $request['address'],
                'end_date' => $end_date,
                'seller' => mb_convert_case($request['seller'], MB_CASE_TITLE, "UTF-8"),
                'certificate' => (int)$request['certificate'],
                'index_certificate' => $request['index_certificate'],
                'date_certificate' => $request['date_certificate'],
                'inspector' => (int)$request['inspector'],
                'inspector_name' => $inspector_name,
                'list_name' => $list_name,
                'updated_by_user' => Auth::user()->id,
                'date_update' => time(),
            ]);
        }

        $pharmacy->fill($data);
        $pharmacy->save();

        if($request['admin'] == 1){
            Session::flash('message', 'Аптеката e редактирана успешно!');
            return Redirect::to('/фирма/'.$pharmacy->firm_id);
        }
        if($request['admin'] == 0){
            Session::flash('message', 'Удостоверението на Аптеката e редактирано успешно!');
            return Redirect::to('/аптека-удостоверение/'.$pharmacy->firm_id.'/'.$pharmacy->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create_permits($id)
    {
        $lock_permit = Set::select('lock_permit')->get()->toArray();
        if($lock_permit[0]['lock_permit'] == 0) {
            $districts = $this->objects_districts_select;
            $firm = Firm::findOrFail($id);

            $districts_firm_show = Location::select('name', 'district_id')
                ->where('areas_id', '=', $firm->areas_id)
                ->where('type_district', '=', 1)
                ->get();

            $areas_firm = $this->areas_all;

            $get_session = Session::get('_old_input', 'localsID');

            if (!empty($get_session['localsID'])) {
                $selected = $get_session['localsID'];

                $locations = Location::select()
                    ->where('areas_id', '=', $this->area_get_id)
                    ->where('district_id', '=', $selected)
                    ->where('tvm', '!=', 0)
                    ->orderBy('tvm', 'asc')
                    ->orderBy('type_district', 'asc')
                    ->get()->toArray();

            }
            else {
                $locations = Location::select()
                    ->where('areas_id', '=', $this->area_get_id)
                    ->where('tvm', '!=', 0)
                    ->orderBy('tvm', 'asc')
                    ->orderBy('type_district', 'asc')
                    ->get()->toArray();
            }

            $firm_id = $firm->id;

            return view('objects.pharmacies.create_permit', compact('firm', 'districts', 'districts_firm_show', 'areas_firm', 'locations',
                'index', 'firm_id'));
        }
        else{
            return Redirect::to('/фирма/' . $id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @param  \odbh\Http\Requests\PermitRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store_permit(PermitRequest $request, $id)
    {
        $lock_permit = Set::select('lock_permit')->get()->toArray();
        if($lock_permit[0]['lock_permit'] == 0) {
            $firm = Firm::select()->where('id', '=', $id)->get()->toArray();

            $end_date = strtotime('+5 years', strtotime($request['date_licence']));

            $data = ([
                'index_licence' => 0,
                'number_licence' => (int)$request['number_licence'],
                'date_licence' => strtotime(stripslashes($request['date_licence'])),
                'raz_udost' => 1,
                'type_firm' => $firm[0]['type_firm'],
                'name' => $firm[0]['name'],
                'district_object' => $request['localsID'],
                'tvm_id' => $request['data_id'],
                'type_location' => $request['data_tmv'],
                'location' => $request['list_name'],
                'alphabet' => $firm[0]['alphabet'],
                'address' => $request['address'],
                'end_date' => $end_date,
                'added_by_user' => Auth::user()->id,
                'date_added' => time(),
            ]);
            /** @var Object $firm_many */
            $firm_many = Firm::findOrfail($id);

            $pharmacy = new Pharmacy($data);

            $firm_many->pharmacies()->save($pharmacy);

            Session::flash('message', 'Аптеката и Разрешителното са добавени успешно!');
            return Redirect::to('/фирма/' . $id);
        }
        else{
            return Redirect::to('/фирма/' . $id);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @param  int $firm_id
     * @return \Illuminate\Http\Response
     */
    public function add($firm_id, $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $firm = Firm::findOrFail($firm_id);

        $districts = $this->objects_districts_select;
        $index = $this->index;
        $inspectors = $this->inspectors_add;

        $districts_firm_show = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $areas_firm = $this->areas_all;

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

        $last_number = Pharmacy::select('number_licence')
            ->where('raz_udost', '=', 2)
            ->orderBy('number_licence', 'desc')
            ->limit(1)->get()->toArray();

        return view('objects.pharmacies.add', compact('pharmacy', 'firm', 'districts', 'districts_firm_show', 'areas_firm',
            'locations', 'only_id', 'inspectors', 'index', 'firm_id', 'selected_area', 'name_location', 'last_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @param  \odbh\Http\Requests\PharmaciesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store_add(PharmaciesRequest $request, $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $end_date = strtotime('+10 years', strtotime(stripslashes($request['date_licence'])));
        $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql[0]['full_short_name'];
        $list_name = $inspector_name_sql[0]['short_name'];

        $index_in = Set::select('index_in')->get()->toArray();
        $index_ur = Set::select('area_id')->get();

        $data = ([
            'raz_udost'=>2,
            'index_licence'=> (int)$index_ur[0]['area_id'] . '1',
            'index_petition' => $index_in[0]['index_in'],
            'number_licence' => (int)$request['number_licence'],
            'date_licence' => strtotime(stripslashes($request['date_licence'])),
            'number_petition' => (int)$request['number_petition'],
            'date_petition' => strtotime(stripslashes($request['date_petition'])),
            'district_object' => $request['localsID'],
            'tvm_id' => $request['data_id'],
            'type_location' => $request['data_tmv'],
            'location' => $request['list_name'],
            'address' => $request['address'],
            'end_date' => $end_date,
            'seller' => mb_convert_case($request['seller'], MB_CASE_TITLE, "UTF-8"),
            'certificate' => (int)$request['certificate'],
            'index_certificate' => $request['index_certificate'],
            'date_certificate' => $request['date_certificate'],
            'inspector' => (int)$request['inspector'],
            'inspector_name' => $inspector_name,
            'list_name' => $list_name,
            'updated_by_user' => Auth::user()->id,
            'date_update' => time(),
            'active' => 0,
            'edition' => 0,
            'date_edition' => 0,
            'number_change' => 0,
            'date_change' => 0,
            'user_change' => 0,
            'locks' => 0,
        ]);

        $pharmacy->fill($data);
        $pharmacy->save();

        Session::flash('message', 'Удостоверението е добавено успешно!');
        return Redirect::to('/фирма/'.$pharmacy->firm_id);
    }

    /**
     * Display обекти с изтекъл срок.
     *
     * @return \Illuminate\Http\Response
     */
    public function expired(){
        $pharmacies = Pharmacy::where('end_date','<',time())->orWhere('active','=',1)->orderBy('alphabet', 'asc')->get()->toArray();
        $repositories = Repository::where('end_date','<',time())->orWhere('active','=',1)->orderBy('alphabet', 'asc')->get()->toArray();
        $workshops = Workshop::where('end_date','<',time())->orWhere('active','=',1)->orderBy('alphabet', 'asc')->get()->toArray();

        return view('objects.expired.index', compact('pharmacies', 'repositories', 'workshops'));
    }
}