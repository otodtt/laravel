<?php

namespace odbh\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Trader;
use Auth;
use Session;

class TradersController extends Controller
{
    private $index = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traders = Trader::orderBy('id', 'asc')->get();

        return view('quality.traders.index', compact( 'traders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quality.traders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'trader_name' => 'required|min:3|max:100|cyrillic_with',
            'trader_address' => 'required|min:3|max:500|cyrillic_with',
            'trader_vin' => 'required|is_valid|digits_between:9,13',
        ], [
            'trader_name.required' => 'Името е задължително!',
            'trader_name.cyrillic_with' => 'За Име на фирмата използвай само кирилица!',
            'trader_name.min' => 'Минимален брой символи за името - 3!',
            'trader_name.max' => 'Максимален брой символи за името - 100!',

            'trader_address.required' => 'Адреса на фирмата е задължителен',
            'trader_address.cyrillic_with' => 'За Адрес на фирмата използвай само кирилица!',
            'trader_address.min' => 'Минимален брой символи зa Адреса на фирмата - 3',
            'trader_address.max' => 'Максимален брой символи зa Адреса на фирмата - 3',

            'trader_vin.required' => 'ЕИК/Булстат на фирмата е задължителен',
            'trader_vin.is_valid' => 'ЕИК/Булстат не е верен! Провери отново!',
            'trader_vin.digits_between' => 'ЕИК/Булстат се изписва с цифри. Между 9 - 13 символа!',
        ]);

        Trader::create ([
            'trader_name'=> $request['trader_name'],
            'trader_address'=> $request['trader_address'],
            'trader_vin'=> $request['trader_vin'],
            'created_by'=> Auth::user()->id,
            'date_create' => date('d.m.Y H:i:s', time()) ,
        ]);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/търговци');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trader = Trader::findOrFail($id);
        $certificates = $trader->qincertificate;
        $trader_certificates = $trader->qincertificate;

        foreach($certificates as $certificate){
            $internal_stocks[] = $certificate->internal_stocks->toArray();
        }
        if(!isset($internal_stocks)) {
            $internal_stocks = array();
        }
        
        return view('quality.traders.show', compact( 'trader', 'certificates', 'internal_stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $from = null)
    {
        $trader = Trader::findOrFail($id);

        return view('quality.traders.edit', compact('trader'));
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
        $this->validate($request, [
            'trader_name' => 'required|min:3|max:100|cyrillic_with',
            'trader_address' => 'required|min:3|max:500|cyrillic_with',
            'trader_vin' => 'required|is_valid|digits_between:9,13',
        ], [
            'trader_name.required' => 'Името е задължително!',
            'trader_name.cyrillic_with' => 'За Име на фирмата използвай само кирилица!',
            'trader_name.min' => 'Минимален брой символи за името - 3!',
            'trader_name.max' => 'Максимален брой символи за името - 100!',

            'trader_address.required' => 'Адреса на фирмата е задължителен',
            'trader_address.cyrillic_with' => 'За Адрес на фирмата използвай само кирилица!',
            'trader_address.min' => 'Минимален брой символи зa Адреса на фирмата - 3',
            'trader_address.max' => 'Максимален брой символи зa Адреса на фирмата - 3',

            'trader_vin.required' => 'ЕИК/Булстат на фирмата е задължителен',
            'trader_vin.is_valid' => 'ЕИК/Булстат не е верен! Провери отново!',
            'trader_vin.digits_between' => 'ЕИК/Булстат се изписва с цифри. Между 9 - 13 символа!',
        ]);
        $trader = Trader::findOrFail($id);
        $data =([
            'trader_name'=> $request['trader_name'],
            'trader_address'=> $request['trader_address'],
            'trader_vin'=> $request['trader_vin'],
            'updated_by'=> Auth::user()->id,
            'date_update' => date('d.m.Y H:i:s', time()) ,
        ]);

        $trader->fill($data);
        $trader->save();

        Session::flash('message', 'Фирмата е редактирана успешно!');
//        return back();
        return Redirect::to('/контрол/търговци/'.$trader->id.'/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trader = Trader::find($id);
        $trader->delete();
        return back();
    }
}
