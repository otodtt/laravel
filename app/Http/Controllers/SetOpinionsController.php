<?php

namespace odbh\Http\Controllers;


use odbh\Http\Requests;

use odbh\SetOpinion;
use odbh\Http\Requests\SetOpinionsRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SetOpinionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = $this->district_full;
        $rates = SetOpinion::all();
        return view('admin.opinions.index', compact('rates','districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = $this->district_full;
        return view('admin.opinions.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\SetOpinionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SetOpinionsRequest $request)
    {
        SetOpinion::create($request->all());

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/админ/мярки');
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
        $rate = SetOpinion::findOrFail($id);
        return view('admin.opinions.edit', compact('rate', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\SetOpinionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SetOpinionsRequest $request, $id)
    {
        $rate = SetOpinion::findOrFail($id);
        $rate->fill($request->all());
        $rate->save();

        Session::flash('message', 'Записа е редактиран успешно!');
        return Redirect::to('/админ/мярки');
    }
}
