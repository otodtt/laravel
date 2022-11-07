<?php

namespace odbh\Http\Controllers;

use odbh\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use odbh\Director;

use odbh\Http\Requests\DirectorsCreateRequest;
use odbh\Http\Requests\DirectorsUpdateRequest;

class DirectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = $this->district_full;
        $directors = Director::all()->sortByDesc('created_at');
        return view('admin.directors.index', compact('directors','districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = $this->district_full;
        return view('admin.directors.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DirectorsCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectorsCreateRequest $request)
    {
        $directorCreate = new Director();
        $directorCreate->DirectorCreate($request);

        Session::flash('message', 'Записа е успешен!');

        return Redirect::to('/admin/directors');
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
        $director = Director::findOrFail($id);
        return view('admin.directors.edit', compact('director', 'districts'));
    }

    /**
     * pdate the specified resource in storage.
     *
     * @param DirectorsUpdateRequest $request
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DirectorsUpdateRequest $request, $id)
    {
        $director = Director::findOrFail($id);
        $director->DirectorUpdate($request,$id);


        Session::flash('message', 'Директора е редактиран успешно!');
        return Redirect::to('/admin/directors');
    }
}
