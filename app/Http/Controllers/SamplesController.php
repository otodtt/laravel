<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Requests\SampleRequest;
use odbh\Http\Requests\SampleTorRequest;
use odbh\Protocol;
use odbh\Sample;
use Redirect;
use Session;

class SamplesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control');
    }

    /**
     * Взети проби от ПРЗ от фирми
     * @param Request $request
     *
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

        $samples_prz = Sample::where('type_assay','=',1)
            ->where('date_number','>',$time_start)
            ->where('date_number','<',$time_end)
            ->orWhere('type_assay','=',100)
            ->where('date_number','>',$time_start)
            ->where('date_number','<',$time_end)
            ->get();

        $samples = Sample::where('type_assay','=',1)->orWhere('type_assay','=',100)->orderBy('date_number', 'desc')->get();
        foreach($samples as $sample){
            $array[date('Y', $sample->date_number)] = date('Y', $sample->date_number);
        }
        $years = array_filter(array_unique($array));

        return view('samples.market.index', compact('samples_prz', 'years', 'year_now'));
    }

    /**
     * Взети проби от ТОР от фирми.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index_tor(Request $request)
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

        $samples_tor = Sample::where('type_assay','=',2)
            ->where('date_number','>',$time_start)
            ->where('date_number','<',$time_end)
            ->get();

        $samples = Sample::where('type_assay','=',2)->orderBy('date_number', 'desc')->get();
        foreach($samples as $sample){
            $array[date('Y', $sample->date_number)] = date('Y', $sample->date_number);
        }
        $years =array_filter(array_unique($array));

        return view('samples.market.index_tor', compact('samples_tor', 'years', 'year_now'));
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
        $samples = Sample::findOrFail($id);

        return view('samples.market.edit', compact('samples'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\SampleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SampleRequest $request, $id)
    {
        $sample = Sample::findOrFail($id);
        if(($sample->number_sample == $request['number_sample']) && ($sample->date_number == strtotime($request['date_number']) ||
        $sample->date_number == strtotime($request['date_number']. 'Europe/Paris'))){
            $data = ([
                'number_sample' => $request['number_sample'],
                'date_number' => strtotime($request['date_number']),
                'number_mail' => $request['number_mail'],
                'date_mail' => $request['date_mail'],
                'maker' => $request['maker'],
                'tc_sample' => $request['tc_sample'],
                'name' => $request['name'],
                'active_subs' => $request['active_subs'],
                'type' => $request['type'],
                'type_formula' => $request['type_formula'],
                'lot_number' => $request['lot_number'],
                'volume' => $request['volume'],
                'type_volume' => $request['type_volume'],
                'volume_pac' => $request['volume_pac'],
                'type_pac' => $request['type_pac'],
                'results' => $request['results'],
            ]);
            $sample->fill($data);
            $sample->save();

            Session::flash('message', 'Пробата от ПРЗ е редактирана успешно!');
            return Redirect::to('/проби');
        }
        else{
            $protocols = Protocol::where('number','=',$request['number_sample'])
                ->where('date_protocol','=',strtotime($request['date_number']))
                ->get();

            foreach($protocols as $protocol){
                $pro = $protocol;
            }
            if ($pro->firm == 1) {
                $et = 'ET';
                $ood = '';
            } elseif ($pro->firm == 2) {
                $et = '';
                $ood = 'ООД';
            } elseif ($pro->firm == 3) {
                $et = '';
                $ood = 'ЕООД';
            } elseif ($pro->firm == 4) {
                $et = '';
                $ood = 'АД';
            } else {
                $et = '';
                $ood = '';
            }

            $data = ([
                'firm_id' => $pro->id_from_firm,
                'from_firm'=>$et.' "'.$pro->name.'" '.$ood,
                'number_sample' => $request['number_sample'],
                'date_number' => strtotime($request['date_number']),
                'number_mail' => $request['number_mail'],
                'date_mail' => $request['date_mail'],
                'maker' => $request['maker'],
                'tc_sample' => $request['tc_sample'],
                'name' => $request['name'],
                'active_subs' => $request['active_subs'],
                'type' => $request['type'],
                'type_formula' => $request['type_formula'],
                'lot_number' => $request['lot_number'],
                'volume' => $request['volume'],
                'type_volume' => $request['type_volume'],
                'volume_pac' => $request['volume_pac'],
                'type_pac' => $request['type_pac'],
                'results' => $request['results'],
            ]);
            $sample->fill($data);
            $sample->save();

            Session::flash('message', 'Пробата от ПРЗ е редактирана успешно! Променен е и Протокола.');
            return Redirect::to('/проби');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_tor($id)
    {
        $samples = Sample::findOrFail($id);

        return view('samples.market.edit_tor', compact('samples'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\SampleTorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_tor(SampleTorRequest $request, $id)
    {
        $sample = Sample::findOrFail($id);
        if(($sample->number_sample == $request['number_sample']) && ($sample->date_number == strtotime($request['date_number']) ||
                $sample->date_number == strtotime($request['date_number']. 'Europe/Paris')))
        {
            $data = ([
                'number_sample' => $request['number_sample'],
                'date_number' => strtotime($request['date_number']),
                'state' => $request['state'],
                'maker' => $request['maker'],
                'packaged' => $request['packaged'],
                'eo' => $request['eo'],
                'name' => $request['name'],
                'active_subs' => $request['active_subs'],
                'date_lot' => $request['date_lot'],
                'lot_number' => $request['lot_number'],
                'volume' => $request['volume'],
                'volume_lot' => $request['volume_lot'],
                'results' => $request['results'],
            ]);
            $sample->fill($data);
            $sample->save();

            Session::flash('message', 'Пробата от ТОР е редактирана успешно!');
            return Redirect::to('/проби-тор');
        }
        else{
            $protocols = Protocol::where('number','=',$request['number_sample'])
                ->where('date_protocol','=',strtotime($request['date_number']))
                ->get();
            foreach($protocols as $protocol){
                $pro = $protocol;
            }
            if ($pro->firm == 1) {
                $et = 'ET';
                $ood = '';
            } elseif ($pro->firm == 2) {
                $et = '';
                $ood = 'ООД';
            } elseif ($pro->firm == 3) {
                $et = '';
                $ood = 'ЕООД';
            } elseif ($pro->firm == 4) {
                $et = '';
                $ood = 'АД';
            } else {
                $et = '';
                $ood = '';
            }

            $data = ([
                'firm_id' => $pro->id_from_firm,
                'from_firm'=>$et.' "'.$pro->name.'" '.$ood,
                'number_sample' => $request['number_sample'],
                'date_number' => strtotime($request['date_number']),
                'state' => $request['state'],
                'maker' => $request['maker'],
                'packaged' => $request['packaged'],
                'eo' => $request['eo'],
                'name' => $request['name'],
                'active_subs' => $request['active_subs'],
                'date_lot' => $request['date_lot'],
                'lot_number' => $request['lot_number'],
                'volume' => $request['volume'],
                'volume_lot' => $request['volume_lot'],
                'results' => $request['results'],
            ]);
            $sample->fill($data);
            $sample->save();

            Session::flash('message', 'Пробата от ТОР е редактирана успешно! Променен е и Протокола.');
            return Redirect::to('/проби-тор');
        }
    }
}
