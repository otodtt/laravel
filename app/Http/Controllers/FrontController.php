<?php

namespace odbh\Http\Controllers;

use odbh\Http\Requests;

class FrontController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('admin', ['only'=>'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function admin()
    {
        $districts = $this->district_full;
        return view('admin.index', compact('districts'));
    }
}
