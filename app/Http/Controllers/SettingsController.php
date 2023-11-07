<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

use odbh\Area;
use odbh\Http\Requests;

use odbh\Set;
use odbh\Http\Requests\SetStampRequest;
use odbh\Http\Requests\SetCodeRequest;

use odbh\Http\Requests\SetRequest;
use odbh\Http\Requests\SetIndexRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = $this->district_full;
        $settings = Set::all()->toArray();

        return view('admin.settings.index', compact('settings','districts'));
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
     * @return \Illuminate\Http\Response
     */
    public function show($id){}

    /**
     * Промяна на индексите.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_index($id)
    {
        $districts = $this->district_full;
        $area = Set::findOrFail($id);
        return view('admin.settings.edit_index', compact('area', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\SetIndexRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_index(SetIndexRequest $request, $id)
    {
        $set = Set::findOrFail($id);

        $data = ([
            'index_in'=> $request['index_in'],
            'in_second'=> $request['in_second'],
            'index_out'=> $request['index_out'],
            'out_second'=> $request['out_second'],
        ]);
        $set->fill($data);
        $set->save();

        Session::flash('message', 'Настройките са добавени успешно!');
        return Redirect::to('/админ/настройки');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas_list = Area::lists('areas_name', 'id')->toArray();
        $areas_list[''] = 'Избери област';
        $areas_list = array_sort_recursive($areas_list);

        $districts = $this->district_full;
        $area = Set::findOrFail($id);
        return view('admin.settings.edit', compact('area','districts', 'areas_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\SetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SetRequest $request, $id)
    {
        $set = Set::findOrFail($id);
        $area = Area::findOrFail($request['area_id'])->toArray();

        $data = ([
            'area'=> $area['areas_name'],
            'area_id'=> $area['id'],
            'odbh_city'=> $area['odbh_name'],
            'city'=> $area['city'],
            'postal_code'=> $area['postal_code'],
            'address'=> $request['address'],
            'mail'=> $request['mail'],
            'phone'=> $request['phone'],
            'fax'=> $request['fax'],
        ]);
        $set->fill($data);
        $set->save();

        Session::flash('message', 'Настройките са добавени успешно!');
        return Redirect::to('/админ/настройки');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

    /**
     * Заключване на разрешителните.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lock_permits($id)
    {
        $locks = Set::findOrFail($id);
        $data = (['lock_permit' => 1,]);

        $locks->fill($data);
        $locks->save();

        return Redirect::to('/админ/настройки' );
    }

    /**
     * Отключване на разрешителните.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlock_permits($id)
    {
        $locks = Set::findOrFail($id);
        $data = (['lock_permit' => 0,]);

        $locks->fill($data);
        $locks->save();

        return Redirect::to('/админ/настройки' );
    }

    //////////// НОВО ///////////////////
    /**
     * Промяна на индексите.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stamp_index($id)
    {
        $districts = $this->district_full;
        $area = Set::findOrFail($id);
        return view('admin.settings.edit_stamp_index', compact('area', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SetIndexRequest|SetStampRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function add_stamp(SetStampRequest $request, $id)
    {
        $set = Set::findOrFail($id);

        $data = ([
            'q_index'=> $request['q_index'],
            'authority_bg'=> $request['authority_bg'],
            'authority_en'=> $request['authority_en'],
        ]);
        $set->fill($data);
        $set->save();

        Session::flash('message', 'Настройките са добавени успешно!');
        return Redirect::to('/админ/настройки');
    }

    //////////// НОВО ///////////////////
    /**
     * Промяна на индексите ЗА ОПЕРАТОРИ.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function operator_index($id)
    {
        $districts = $this->district_full;
        $area = Set::findOrFail($id);
        return view('admin.settings.operator_index', compact('area', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SetIndexRequest|SetStampRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function add_operator_index(SetCodeRequest $request, $id)
    {
        $set = Set::findOrFail($id);

        $data = ([
            'operator_index_not'=> strtoupper($request['operator_index_not']),
            'operator_index_bg'=> 'BG '.strtoupper($request['operator_index_not']),
        ]);
        $set->fill($data);
        $set->save();

        Session::flash('message', 'Настройките са добавени успешно!');
        return Redirect::to('/админ/настройки');
    }
}
