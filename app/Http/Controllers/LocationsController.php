<?php

namespace odbh\Http\Controllers;


use odbh\Http\Requests;
use odbh\Location;

use odbh\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use odbh\Set;

class LocationsController extends Controller
{
    /**
     * NoneProtocolsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $get_area_id = $this->area_get_id;
        $districts = $this->district_full;

        $locations = Location::select()
            ->where('areas_id', '=', $get_area_id)
            ->where('district_id', '=', $id)
            ->where('tvm', '!=', 0)
            ->orderBy('type_district', 'desc')
            ->get();
        $areas = Location::select()
            ->where('areas_id', '=', $get_area_id)
            ->where('district_id', '=', $id)
            ->where('type_district', '=', 1)
            ->get()->toArray();
        return view('admin.locations.index', compact('locations','districts','areas'));
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function locations_codes()
    {
        $districts = $this->district_full;

        return view('admin.locations.codes', compact( 'districts' ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = $this->district_full;

        $selected = Set::select('area_id')->get()->toArray();

        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();
        $district_list[''] = 'Избери община';
        $district_list = array_sort_recursive($district_list);

        return view('admin.locations.create', compact('districts', 'district_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\LocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $selected = Set::select('area_id')->get()->toArray();
        $t_v_m = null;
        if((int)$request['tvm'] == 1){
            $t_v_m = 'гр.';
        }
        if((int)$request['tvm'] == 2){
            $t_v_m = 'с.';
        }
        if((int)$request['tvm'] == 3){
            $t_v_m = 'ман.';
        }

        Location::create([
            'ekatte'=> $request['ekatte'],
            'tvm'=> $request['tvm'],
            't_v_m'=> $t_v_m,
            'name'=> $request['name'],

            'areas_id'=> $selected[0]['area_id'],
            'district_id'=> (int)$request['district_id'],
            'type_district'=> 0,
            'add_new'=> 1,
            'postal_code'=> $request['postal_code'],
        ]);
        Session::flash('message', 'Населеното място е добавено успешно!');
        return Redirect::to('/admin/locations/'.$request['district_id']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selected = Set::select('area_id')->get()->toArray();
        $district_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $selected)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id')->toArray();

        $districts = $this->district_full;
        $location = Location::findOrFail($id);
        return view('admin.locations.edit', ['location'=>$location, 'districts'=>$districts, 'district_list'=>$district_list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\LocationRequest   $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->fill($request->all());
        $location->save();

        Session::flash('message', 'Населеното място е редактирано успешно!');
        return Redirect::to('/admin/locations-added');
    }

    /**
     * Показва добавените населени места
     *
     * @return \Illuminate\Http\Response
     */
    public function added(){
        $districts = $this->district_full;

        $set_id = $this->area_get_id;

        $new_locations = Location::select()
            ->where('areas_id', '=', $set_id)
            ->where('add_new', '=', 1)
            ->orderBy('type_district', 'desc')
            ->get();
        return view('admin.locations.added', compact( 'new_locations', 'districts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::destroy($id);
        Session::flash('message', 'Населеното място е изтрито успешно!');
        return Redirect::to('/admin/locations-added');
    }
}
