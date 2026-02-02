<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;

use Auth;
use DB;
//use Illuminate\Http\Request;

use Input;
use odbh\Firm;
//use odbh\Http\Requests;

use odbh\Http\Requests\ProtocolsRequest;
use odbh\Http\Requests\ProtocolsUpdateRequest;
use odbh\Location;
use odbh\Pharmacy;
use odbh\Protocol;
use odbh\ReportPharmacy;
use odbh\ReportProtocol;
use odbh\Repository;
use odbh\Sample;
use odbh\Set;
use odbh\User;
use odbh\Workshop;
use Redirect;
use Session;

class ReportProtocolsController extends Controller
{
    private $logo = null;

    private $ph_area_sort = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * ProtocolsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control');

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
        $inspectors_active = $this->inspectors_active_rz_list->toArray();
        $inspectors_db = array();
        $inspectors_db_two = array();
        $inspectors_db_three = array();
        $inspectors_db_all = Protocol::select('inspector_name', 'inspector', 'inspector_two_name', 'inspector_two', 'inspector_three_name', 'inspector_three')
            ->where('inspector','!=',0)->where('inspector_two','!=',0)->where('inspector_three','!=',0)->get()->toArray();
        foreach($inspectors_db_all as $value){
            $inspectors_db[$value['inspector']] = $value['inspector_name'];
            $inspectors_db_two[$value['inspector_two']] = $value['inspector_two_name'];
            $inspectors_db_three[$value['inspector_three']] = $value['inspector_three_name'];
        }
        $this->inspectors_edit_db = array_sort_recursive($inspectors_active) + array_sort_recursive($inspectors_db)
            + array_sort_recursive($inspectors_db_two) + array_sort_recursive($inspectors_db_three);

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abc = null;
        $alphabet = ReportProtocol::lists('alphabet')->toArray();

        $areas = $this->ph_area_sort;

        $protocols = ReportProtocol::where('ot','>=', 0)->where('ot','<=', 3)->orderBy('date_protocol', 'desc')->orderBy('number', 'desc')->get();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[0] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);
//        dd($protocols);
        return view('control.protocols.market.index', compact('alphabet', 'protocols', 'abc', 'inspectors', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id ИД на обекта за който се добавя протокола
     * @param  int $firm ИД на фирмата за който се добавя протокола
     * @param  int $type Вида (Аптека, Склад, Цех) на обекта за който се добавя протокола
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $firm, $type)
    {
        $report = ReportPharmacy::findOrFail($id);

        if((int)$type == 1){
            $object = Pharmacy::findOrFail($firm);
        }
        if((int)$type == 2){
            $object = Repository::findOrFail($firm);
        }
        if((int)$type == 3){
            $object = Workshop::findOrFail($firm);
        }

        $inspectors = $this->inspectors_add;

        return view('control.protocols.market.create', compact('report', 'object', 'type', 'inspectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $report_id ИД на доклада
     * @param  int $type от къде
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $report_id, $type)
    {
        $unique_number = ReportProtocol::where('number','=',$request['number'])->where('date_protocol','=',strtotime(stripslashes($request['date_protocol'])))->get();
        if(count($unique_number)>0){
            $this->validate($request, [
                'number' => 'not_in:'.$request['number'],
            ]);

        }

        if((int)$type == 1){
            $report = ReportPharmacy::findOrFail($report_id);
        }
        if((int)$type == 2){
//            $object = Repository::findOrFail($object_id);
        }
        if((int)$type == 3){
//            $object = Workshop::findOrFail($object_id);
        }

        $data = ([
            'number'=>$report->protocol_number,
            'date_protocol'=>$report->protocol_date,

            'id_from_report'=>$report->id,
            'number_report'=>$report->number,
            'date_report'=>$report->date_report,
            'inspector'=>$report->inspector,
            'inspector_name'=>$report->inspector_name,
            'ot'=>$type,
            'act'=>$request['act'],
            'violation'=>$request['violation'],
            'ascertainment'=>$request['ascertainment'],
            'taken'=>$request['taken'],
            'order_protocol'=>$request['order_protocol'],

            'date_add'=>time(),
            'added_by'=> Auth::user()->id,
            'alphabet'=>$report->alphabet,

            'firm'=>$report->firm,
            'name'=>$report->name,
            'place'=>$report->place,

//            'id_from_object'=>$report->id_from_object,
//            'id_from_firm'=>$report->id_from_firm,
//            'inspector_two'=>$request['inspector_two'],
//            'inspector_three'=>$request['inspector_three'],
//            'inspector_another'=>$request['inspector_another'],
//            'inspector_from'=>$request['inspector_from'],
//            'city_id'=>$object->tvm_id,
//            'city_village'=>$object->type_location,
//            'address'=>$object->address,
//            'district_object'=>$object->district_object,
//            'assay_prz'=>$assay_prz,
//            'assay_more'=>$assay_more,
//            'assay_tor'=>$request['assay_tor'],
//            'type_check'=>$request['type_check'],
//            'inspector_name'=>$inspector_name,
//            'inspector_two_name'=>$inspector_two_name,
//            'inspector_three_name'=>$inspector_three_name,
//            'position'=>$position,
//            'position_short'=>$position_short,
//            'position_two'=>$position_two,
//            'position_short_two'=>$position_short_two,
//            'position_three'=>$position_three,
//            'position_short_three'=>$position_short_three,
        ]);

        $protocols = new ReportProtocol($data);
        $report->report_protocol()->save($protocols);
        $protocols->id;

        $report->fill([
            'is_protocol' => 1,
            'id_protocol' => $protocols->id
        ]);
        $report->save();


        if($type == 1){
            Session::flash('message', 'Протокола е добавен успешно!');
            return Redirect::to('/доклад-аптека/'.$report->id);
        }
        if($type == 2){
            Session::flash('message', 'Протокола е добавен успешно!');
            return Redirect::to('/доклад-склад/'.$report->id);
        }
        if($type == 3){
            Session::flash('message', 'Протокола е добавен успешно!');
            return Redirect::to('/доклад-цех/'.$report->id);
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
        $logo = $this->logo;
        $protocol = ReportProtocol::findOrFail($id);

        $inspectors = User::get();
        $city = Set::first();

        if($protocol->ot == 1) {
            $report = ReportPharmacy::where('id',$protocol->id_from_report)->get()->toArray();
            $firm = Firm::findOrFail($report[0]['id_from_firm']);
            $object = Pharmacy::findOrFail($report[0]['id_from_object']);
        }
        if($protocol->ot == 2) {
            //$report = ReportSKLLL::findOrFail($protocol->id_from_firm);
        }
        if($protocol->ot == 3) {
            //$report = ReportSKLLL::findOrFail($protocol->id_from_firm);
        }
//        dd($protocol);

        $areas = $this->areas_all;
        $districts_firm = Location::select('name', 'district_id')
            ->where('areas_id', '=', $firm->areas_id)
            ->where('type_district', '=', 1)
            ->get();

        $districts_object = Location::select('name', 'district_id')
            ->where('areas_id', '=', $city->area_id)
            ->where('type_district', '=', 1)
            ->get();

        if($protocol->assay_prz == 1){
            $prz = Sample::where('number_sample','=',$protocol->number)
                ->where('date_number','=',$protocol->date_protocol)
                ->where('type_assay','=',1)
                ->get();
        }
        else{
            $prz = array();
        }
        if($protocol->assay_more == 1){
            $more = Sample::where('number_sample','=',$protocol->number)
                ->where('date_number','=',$protocol->date_protocol)
                ->where('type_assay','=',100)
                ->get();
        }
        else{
            $more = array();
        }
        if($protocol->assay_tor == 1){
            $tor = Sample::where('number_sample','=',$protocol->number)
                ->where('date_number','=',$protocol->date_protocol)
                ->where('type_assay','=',2)
                ->get();
        }
        else{
            $tor = array();
        }

        return view('control.protocols.market.show', compact('logo', 'protocol', 'report', 'inspectors', 'city', 'firm',
            'object', 'areas', 'districts_firm', 'districts_object', 'prz', 'more', 'tor'));
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
     * Choose Report firm or Delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function choose($id){
        $protocol = ReportProtocol::findOrFail($id);
        $find = 0;
        $pharmacy_report = array();
//        dd($id);
        return view('control.protocols.market.choose.choose', compact('protocol', 'id', 'find', 'pharmacy_report'));
//        return view('control.protocols.market.choose');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report_search(Request $request, $id)
    {
        $this->validate($request,
            ['search_report' => 'required|numeric|min:1'],
            [
                'search_report.required' => 'Напиши номера на ДОКЛАДА от Проверка!',
                'search_report.numeric' => 'За Номер използвай само цифри! ',
                'search_report.min' => 'Номера не може да е НУЛА!',
            ]);

        $protocol = ReportProtocol::findOrFail($id);
        $number = $request['search_report'];

        $pharmacy = ReportPharmacy::where('number', '=', $request['search_report'])->get();

        //ToDo Da dobawia za skladowete i cehowete
        if(count($pharmacy) == 0){
            $find = 1;
            $pharmacy_report = array();
        }
        else {
            $find = 2;
            $pharmacy_report = $pharmacy;
        }

//        dd($number);
//        dd(count($pharmacy_report));

        return view('control.protocols.market.choose.choose', compact('protocol', 'id', 'find', 'pharmacy_report', 'number'));
    }

    /**
     * join_to Report or firm.
     *
     * @param  int  $id
     * @param  int  $from
     * @param  int  $protocol
     * @return \Illuminate\Http\Response
     */
    public function join_to($id, $from, $protocol){
//        dd($id);
        if($from == 1){
            $report = ReportPharmacy::findOrFail($id);
        }
        if($from == 2){
            $report = ReportPharmacy::findOrFail($id);
        }
        if($from == 3){
            $report = ReportPharmacy::findOrFail($id);
        }
        $protocol = ReportProtocol::findOrFail($protocol);


        $date_to_protocol =([
            'id_from_report' => $report->id,
            'number_report' => $report->number,
            'date_report' => $report->date_report,
            'id_from_object' => $report->id_from_object,
            'id_from_firm' => $report->id_from_firm,
            'inspector' => $report->inspector,
            'inspector_two' => $report->inspector_two,
            'inspector_three' => $report->inspector_three,
            'inspector_another' => $report->inspector_another,
            'inspector_from' => $report->inspector_from,
            'ot' => $report->ot,
            'firm' => $report->ot,
            'name' => $report->firm,
            'city_village' => $report->city_village,
            'place' => $report->place,
            'address' => $report->address,
            'district_object' =>$report->district_object,
            'alphabet' => $report->alphabet,
            'inspector_name' =>$report->inspector_name,
            'position_short' => $report->position_short,
            'inspector_two_name' => $report->inspector_two_name,
            'position_short_two' => $report->position_short_two,
            'inspector_three_name' => $report->inspector_three_name,
            'position_short_three' => $report->position_short_three,

            'date_update' => time(),
            'updated_by' =>  Auth::user()->id,
        ]);

        $date_to_report =([
            'id_protocol' => $protocol->id,
            'protocol' => 1,
            'is_protocol' => 1,
            'protocol_number' => $protocol->number,
            'protocol_date' => $protocol->date_protocol,

            'date_update' => time(),
            'updated_by' =>  Auth::user()->id,
        ]);

//        dd($protocol);

        dd($date_to_report);
        $find = 0;
        $pharmacy_report = array();
//        dd($id);
//        return view('control.protocols.market.choose.choose', compact('protocol', 'id', 'find', 'pharmacy_report'));
//        return view('control.protocols.market.choose');
    }
}
