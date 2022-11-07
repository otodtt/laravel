<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Http\Requests\CountriesRequest;
use odbh\Country;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_area_id = $this->area_get_id;
        $districts = $this->district_full;
        $countries = Country::select()->get();
        
        return view('admin.countries.index', compact('countries', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $districts = $this->district_full;
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountriesRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $data = ([
            'EC'=> $request['EC'],
            'name_en'=> $request['name_en'],
        ]);
        
        $country->fill($data);
        $country->save();
        

        Session::flash('message', 'Държавата е редактирана успешно!');
        return Redirect::to('/admin/countries');
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
