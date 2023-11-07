<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use odbh\Certificate;

use odbh\Http\Requests;
use Illuminate\Validation;
use odbh\Set;
use odbh\User;
use Redirect;
use Input;
use odbh\Http\Requests\PhitoOperatorsRequests;
//use odbh\Http\Requests\CertificatesUpdateRequest;
use Session;
use odbh\Trader;
use odbh\Farmer;
use odbh\Location;
use odbh\Country;
use odbh\PhitoOperator;
//use odbh\Crop;

class PhytoOperatorsController extends Controller
{
    private $logo = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * CertificatesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('sanitary', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        $this->logo = Set::all()->toArray();

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_fsk_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        /** За Всички които са добавяли Протоколи + Активните*/
        $inspectors_active = $this->inspectors_active_fsk_list->toArray();
        $inspectors_db = Certificate::lists('short_name', 'inspector_id')->toArray();
        $this->inspectors_edit_db = $inspectors_active + $inspectors_db;

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second', 'operator_index_not', 'operator_index_bg')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::get();

//        $inspectors = $this->inspectors_edit_db;
        $inspectors = $this->inspectors_add;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);
//        dd($inspectors);

        $abc = null;
        $alphabet = Certificate::lists('alphabet')->toArray();

        return view('phytosanitary.index', compact('certificates', 'alphabet','abc', 'inspectors'));
    }

    /**
     * СЪЩЕСТВУВАЩ ЗС
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $index = $this->index;

        $farmer = Farmer::findOrFail($id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
//        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $districts_farm = $this->districts_list;
        $regions = $this->areas_all_list;
        $districts = Location::select('name', 'district_id')
            ->where('areas_id', '=', $farmer->areas_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

//        $countries= Country::select('id', 'name', 'name_en', 'EC')->where('EC', '=', 1)->orderBy('name', 'asc')->get()->toArray();

//        $crops= Crop::select('id', 'name', 'name_en', 'group_id')
//            ->where('group_id', '=', 4)
//            ->orWhere('group_id', '=', 5)
//            ->orWhere('group_id', '=', 6)
//            ->orWhere('group_id', '=', 7)
//            ->orWhere('group_id', '=', 8)
//            ->orWhere('group_id', '=', 9)
//            ->orWhere('group_id', '=', 10)
//            ->orWhere('group_id', '=', 11)
//            ->orWhere('group_id', '=', 15)
//            ->orWhere('group_id', '=', 16)
//            ->orderBy('group_id', 'asc')->get()->toArray();

        $last_operator = PhitoOperator::select('number_petition')->orderBy('number_petition', 'desc')->limit(1)->get()->toArray();

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();

        if(!empty($last_operator)) {
            $last_number = $last_operator;
        } else {
            $last_number[0]['number_petition'] = '1';
        }
//        dd($last_number);

        return view('phytosanitary.crud.add_farmer', compact('farmer', 'index', 'user', 'districts', 'districts_farm',
                    'regions', 'inspectors', 'last_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|QINCertificateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store_old(PhitoOperatorsRequests $request, $id)
    {
        dd($request->all());
        $region = '';
        $dist = '';

        $farmer = Farmer::findOrFail($id);

        $index = $this->index;
        $user = User::select('id', 'all_name', 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', Auth::user()->id)->get()->toArray();

//        $last_internal = QINCertificate::select('internal')->orderBy('internal', 'desc')->limit(1)->get()->toArray();

        dd($request->all());
//        $one = 3;
//        $hundred = 1000;
//        $thousand = 10000;
//        if(!empty($last_internal)) {
//            if($last_internal[0]['internal'] < 3999 ){
//                $internal = $last_internal[0]['internal'] + 1;
//            }
//            if($last_internal[0]['internal'] == 3999 ){
//                $internal = $one.$hundred ;
//            }
//            if($last_internal[0]['internal'] >= 31000 ){
//                $internal = $last_internal[0]['internal'] + 1;
//            }
//            if($last_internal[0]['internal'] == 39999 ){
//                $internal = $one.$thousand ;
//            }
//            if($last_internal[0]['internal'] >= 310000 ){
//                $internal = $last_internal[0]['internal'] + 1;
//            }
//        } else {
//            $internal = '3001';
//        }
//
//        $date_now = time();
//        $convert_date = date('d.m.Y', $date_now);
//        $final_date = strtotime($convert_date);
//
//        if($farmer->tvm == 1){
//            $tvm = 'гр. ';
//        }
//        elseif($farmer->tvm == 2 ){
//            $tvm = 'с. ';
//        }
//        else{
//            $tvm = 'гр./с. ';
//        }
//        $regions = $this->areas_all_list;
//        foreach ($regions as $k=>$items) {
//            if ($k == $farmer->areas_id) {
//                $region = $items;
//            }
//        }
//
//        /** Генерира списък с общините */
//        $districts = Location::select('name', 'district_id')
//            ->where('areas_id', '=', $farmer->areas_id)
//            ->where('type_district', '=', 1)
//            ->orderBy('district_id', 'asc')
//            ->lists('name', 'district_id');
//
//        foreach ($districts as $k=>$items) {
//            if ($k == $farmer->district_id) {
//                $dist = $items;
//            }
//        }
//
//        $address =$farmer->address.', '.$tvm.''.$farmer->location.', общ. '.$dist.', обл. '.$region;
//        $data = [
//            'internal' => $internal,
//            'what_7' => 1,
//            'type_crops' => $request->type_crops,
//            'farmer_id' => $farmer->id,
//            'type_firm' => $farmer->type_firm,
//            'trader_id' => 0,
//            'trader_name' => $farmer->name,
//            'trader_address' => $address,
//            'trader_vin' => $farmer->pin,
//            'from_country' => $request->from_country,
//            'id_country' => $request->id_country,
//            'for_country_bg' => $request->for_country_bg,
//            'for_country_en' => $request->for_country_en,
//            'observations' => $request->observations,
//            'place_bg' => $request->place_bg,
//            'date_issue' => $final_date,
//            'valid_until' => $request->valid_until,
//            'inspector_bg' => $user[0]['all_name'],
//            'inspector_en' => $user[0]['all_name_en'],
//            'stamp_number' => $index[0]['q_index'].'-'.$user[0]['stamp_number'],
//            'authority_bg' => $index[0]['authority_bg'],
//            'authority_en' => $index[0]['authority_en'],
//            'date_add' => date('d.m.Y', time()),
//            'added_by' => Auth::user()->id,
//        ];
//
//        QINCertificate::create($data);
//
//        $last_id = QINCertificate::select('id')->orderBy('id', 'desc')->limit(1)->get()->toArray();
//
//        Session::flash('message', 'Записа е успешен!');
//        return Redirect::to('/контрол/сертификат-вътрешен/'.$last_id[0]['id'] .'/завърши');
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $trader = Trader::select()->where('trader_vin','=',$eik)->get()->toArray();

        $farmers = null;
        if(isset($request['firm_search']) && $request['firm_search'] == 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->get();
        }
        if(isset($request['firm_search']) && $request['firm_search'] > 1){
            $farmers = Farmer::select()->where('pin','=',$pin)->orWhere('bulstat','=',$eik)->get();
        }

        return view('phytosanitary.search.search', compact('firm', 'name', 'eik', 'gender', 'pin', 'name_firm', 'farmers', 'trader'));
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
                        <div style='width: 50%; display: inline-block'><span><a href='/фито/оператор/земеделец/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ТОЗИ ЗС КАТО ОПЕРАТОР!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/фито/оператор/земеделец/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ТОЗИ ЗС КАТО ОПЕРАТОР!</a></span></div>
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
                        <div style='width: 50%; display: inline-block'><span><a href='/фито/оператор/земеделец/добави/$farmer->id' class='fa fa-address-card-o btn btn-warning my_btn'> ДОБАВИ ТОЗИ ЗС КАТО ОПЕРАТОР!</a></span></div>
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
