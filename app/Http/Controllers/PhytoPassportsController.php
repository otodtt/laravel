<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

use odbh\Farmer;
use odbh\Http\Requests;
use odbh\Http\Requests\PhytoPassportRequests;
use odbh\PhytoPassport;
use odbh\Set;
use Auth;
use Session;
use Redirect;
use odbh\PhitoOperator;

class PhytoPassportsController extends Controller
{
    private $index = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    /**
     * CertificatesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('sanitary', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_fsk_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second', 'operator_index_not', 'operator_index_bg', 'city')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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

        $passports_years = PhytoPassport::get();
        foreach($passports_years as $passports){
            $array[date('Y', $passports->date_permit)] = date('Y', $passports->date_permit);
        }
        $years = array_filter(array_unique($array));

        $index = $this->index;

        $passports = PhytoPassport::where('date_permit','>',$time_start)->where('date_permit','<',$time_end)->get();

        return view('phytosanitary.passports.index', compact('passports', 'year_now', 'years', 'index'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search_value_return = $request['search_value'];

        $this->validate($request, ['search_value' => 'required|digits_between:1,7']);



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

        $passports_years = PhytoPassport::get();
        foreach($passports_years as $passports){
            $array[date('Y', $passports->date_permit)] = date('Y', $passports->date_permit);
        }
        $years = array_filter(array_unique($array));

        $index = $this->index;

        $passports = PhytoPassport::where('passport','=',$request['search_value'])->get();

        return view('phytosanitary.passports.index', compact('passports', 'year_now', 'years', 'index', 'search_value_return'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index = $this->index;

        $last_number = PhytoPassport::select('passport')
            ->orderBy('id', 'desc')
            ->limit(1)->get()->toArray();

        return view('phytosanitary.passports.crud.create', compact( 'index', 'last_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|PhytoPassportRequests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PhytoPassportRequests $request )
    {
        $data = ([
            'passport' =>  $request['passport'],
            'date_permit' =>  strtotime($request['date_permit']),
            'invoice' =>  $request['invoice'],
            'date_invoice' =>  strtotime($request['date_invoice']),
            'number_petition' =>  $request['number_petition'],
            'date_petition' =>  strtotime($request['date_petition']),
            'is_farmer' =>  $request['is_farmer'],
            'is_operator' =>  $request['is_operator'],
            'manufacturer' => $request['manufacturer'],
            'city' => $request['city'],
            'address' => $request['address'],
            'pin' => $request['pin'],
            'quantity' => $request['quantity'],
            'quantity_type' =>  $request['quantity_type'],
            'botanical' => $request['botanical'],
            'direction' => $request['direction'],
            'full_direction' => $request['full_direction'],
            'protected' => $request['protected'],

            'date_create' => date('d.m.Y H:i', time()),
            'created_by' => Auth::user()->id,
        ]);
        PhytoPassport::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/паспорти');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $passport = PhytoPassport::findOrFail($id);
        $index = $this->index;

        $inspectors = array_sort_recursive($this->inspectors_add);

        return view('phytosanitary.passports.show', compact('passport', 'index', 'inspectors'));
    }


    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    * @param Request $request
    *
    */
    public function operator_id_edit(Request $request, $id)
    {
        $this->validate($request,
            ['is_operator' => 'required|numeric|digits_between:1,10'],
            [
                'is_operator.required' => 'Номера е задължителен!',
                'is_operator.numeric' => 'За Номер използвай само цифри!',
                'is_operator.digits_between' => 'За Номера използвай между 1 и 10 броя цифри',
            ]);

        $passport = PhytoPassport::findOrFail($id);

        $is_operator = PhitoOperator::select('id')->where('id', '=', $request['is_operator'])->get();

        if(count($is_operator) >=1 ||  $request['is_operator']  == 0){
            $data_operator = ([
                'is_operator' => $request['is_operator'],
            ]);
            $passport->fill($data_operator);
            $passport->save();

            Session::flash('message', 'Записа е успешен!');
            return Redirect::to('/фито/паспорт/покажи/'.$passport->id);
        }
        else{
            Session::flash('message', 'Не е намерен Оператор с такъв номер! Оптай с друг номер!');
            return Redirect::to('/фито/паспорт/покажи/'.$passport->id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param Request $request
     */
    public function farmer_id_edit(Request $request, $id)
    {
        $this->validate($request,
            ['is_farmer' => 'required|numeric|digits_between:1,10'],
            [
                'is_farmer.required' => 'Номера е задължителен!',
                'is_farmer.numeric' => 'За Номер използвай само цифри!',
                'is_farmer.digits_between' => 'За Номера използвай между 1 и 10 броя цифри',
            ]);

        $passport = PhytoPassport::findOrFail($id);

        $is_farmer = Farmer::select('id')->where('id', '=', $request['is_farmer'])->get();

        if(count($is_farmer) >=1 ||  $request['is_farmer']  == 0){
            $data_operator = ([
                'is_farmer' => $request['is_farmer'],
            ]);
            $passport->fill($data_operator);
            $passport->save();

            Session::flash('message', 'Записа е успешен!');
            return Redirect::to('/фито/паспорт/покажи/'.$passport->id);
        }
        else{
            Session::flash('message', 'Не е намерен Земеделец с такъв номер! Оптай с друг номер!');
            return Redirect::to('/фито/паспорт/покажи/'.$passport->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lock($id){
        $operator = PhytoPassport::findOrFail($id);

        $data = [
            'is_lock' => 1,
        ];
        $operator->fill($data);
        $operator->save();

//        Session::flash('message', 'Документа е заключен!');
        return Redirect::to('/фито/паспорт/покажи/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlock($id){
        $passport = PhytoPassport::findOrFail($id);

        $data = [
            'is_lock' => 0,
        ];
        $passport->fill($data);
        $passport->save();

        return Redirect::to('/фито/паспорт/покажи/'.$id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $passport = PhytoPassport::findOrFail($id);
        $index = $this->index;

        $last_number = PhytoPassport::select('passport')
            ->orderBy('id', 'desc')
            ->limit(1)->get()->toArray();

        return view('phytosanitary.passports.crud.edit', compact('passport', 'index', 'last_number'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|PhytoPassportRequests $request
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhytoPassportRequests $request, $id)
    {
        $passport = PhytoPassport::findOrFail($id);
        $data = ([
            'date_permit' =>  strtotime($request['date_permit']),
            'invoice' =>  $request['invoice'],
            'date_invoice' =>  strtotime($request['date_invoice']),
            'number_petition' =>  $request['number_petition'],
            'date_petition' =>  strtotime($request['date_petition']),
            'manufacturer' => $request['manufacturer'],
            'city' => $request['city'],
            'address' => $request['address'],
            'pin' => $request['pin'],
            'quantity' => $request['quantity'],
            'quantity_type' =>  $request['quantity_type'],
            'botanical' => $request['botanical'],
            'direction' => $request['direction'],
            'full_direction' => $request['full_direction'],
            'protected' => $request['protected'],

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,
        ]);

        $passport->fill($data);
        $passport->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/паспорт/покажи/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
