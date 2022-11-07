<?php

namespace odbh\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Http\Requests\PackersRequest;
use odbh\Packer;
use Auth;
use Session;
use Input;

class PackersController extends Controller
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
        $packers = Packer::orderBy('id', 'asc')->get();

        return view('quality.packers.index', compact( 'packers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quality.packers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|PackersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackersRequest $request)
    {
        Packer::create ([
            'packer_name'=> $request['packer_name'],
            'packer_address'=> $request['packer_address'],
            'created_by'=> Auth::user()->id,
            'date_create' => date('d.m.Y H:i:s', time()) ,
        ]);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/опаковчици');
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
        $packers = Packer::findOrFail($id);
        return view('quality.packers.edit', compact('packers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackersRequest $request, $id)
    {
        $packers = Packer::findOrFail($id);
        $data =([
            'packer_name'=> $request['packer_name'],
            'packer_address'=> $request['packer_address'],
            'updated_by'=> Auth::user()->id,
            'date_update' => date('d.m.Y H:i:s', time()) ,
        ]);

        $packers->fill($data);
        $packers->save();

        Session::flash('message', 'Фирмата е редактирана успешно!');
        return Redirect::to('/контрол/опаковчици');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Packer::find($id);
        $stock->delete();
        return back();
    }
}
