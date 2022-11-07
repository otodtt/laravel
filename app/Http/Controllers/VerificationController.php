<?php

namespace odbh\Http\Controllers;

use odbh\Http\Requests;
use odbh\Verifications;

use odbh\Http\Requests\VerificationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = $this->district_full;
        $records = Verifications::all();
        return view('admin.verifications.index', compact('records', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = $this->district_full;
        return view('admin.verifications.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\VerificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VerificationRequest $request)
    {
        Verifications::create($request->all());

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/админ/проверки');
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
        $record = Verifications::findOrFail($id);
        return view('admin.verifications.edit', compact('record', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\VerificationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VerificationRequest $request, $id)
    {
        $record = Verifications::findOrFail($id);
        $record->fill($request->all());
        $record->save();

        Session::flash('message', 'Записа е редактиран успешно!');
        return Redirect::to('/админ/проверки');
    }
}
