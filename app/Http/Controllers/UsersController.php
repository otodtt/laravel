<?php

namespace odbh\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use odbh\Http\Requests;
use odbh\Http\Requests\UserCreateRequest;
use odbh\Http\Requests\UserUpdateRequest;
use odbh\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = $this->district_full;
        $users = User::all();
        return view('admin.inspectors.index', compact('users','districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = $this->district_full;
        return view('admin.inspectors.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\UserCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        if($request['dlaznost'] == 1){
            $dlaznost_full = 'Началник отдел';
            $dlaznost_short = 'Н-к отдел';
        }
        if($request['dlaznost'] == 2){
            $dlaznost_full = 'Главен инспектор';
            $dlaznost_short = 'Гл. инспектор';
        }
        if($request['dlaznost'] == 3){
            $dlaznost_full = 'Старши инспектор';
            $dlaznost_short = 'Ст. инспектор';
        }
        if($request['dlaznost'] == 4){
            $dlaznost_full = 'Инспектор';
            $dlaznost_short = 'Инспектор';
        }
        if($request['dlaznost'] == 5){
            $dlaznost_full = 'Главен експерт';
            $dlaznost_short = 'Гл. експерт';
        }
        if($request['dlaznost'] == 6){
            $dlaznost_full = 'Старши експерт';
            $dlaznost_short = 'Ст. експерт';
        }
        if($request['dlaznost'] == 7){
            $dlaznost_full = 'Експерт';
            $dlaznost_short = 'Експерт';
        }
        /////////
        if(!isset($request['rz'])){
            $rz = 0;
        }
        else{
            $rz = $request['rz'];
        }
        ///
        if(!isset($request['orz'])){
            $orz = 0;
        }
        else{
            $orz = $request['orz'];
        }
        ///
        if(!isset($request['fsk'])){
            $fsk = 0;
        }
        else{
            $fsk = $request['fsk'];
        }
        ///
        if(!isset($request['ppz'])){
            $ppz = 0;
        }
        else{
            $ppz = $request['ppz'];
        }
        ///
        if(!isset($request['lab'])){
            $lab = 0;
        }
        else{
            $lab = $request['lab'];
        }

        $data = ([
            'active'=> $request['active'],
            'dlaznost'=> $request['dlaznost'],
            'all_name'=> mb_convert_case  ($request['all_name'], MB_CASE_TITLE, "UTF-8"),
            'karta'=> $request['karta'],
            'short_name'=> mb_convert_case ($request['short_name'], MB_CASE_TITLE, "UTF-8"),
            'name'=> $request['name'],
            'password'=> $request['password'],
            'admin'=> $request['admin'],
            'full_all_name'=> $dlaznost_full.' '.mb_convert_case  ($request['all_name'], MB_CASE_TITLE, "UTF-8"),
            'full_short_name'=> $dlaznost_short.' '.mb_convert_case ($request['short_name'], MB_CASE_TITLE, "UTF-8"),
            'position'=>$dlaznost_full,
            'position_short'=>$dlaznost_short,
            'rz'=> $rz,
            'orz'=> $orz,
            'fsk'=> $fsk,
            'ppz'=> $ppz,
            'lab'=> $lab,
        ]);
        User::create($data);
        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/admin/users');
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
        $user = User::findOrFail($id);
        return view('admin.inspectors.edit', compact('user', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\UserUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if($request['dlaznost'] == 1){
            $dlaznost_full = 'Началник отдел';
            $dlaznost_short = 'Н-к отдел';
        }
        if($request['dlaznost'] == 2){
            $dlaznost_full = 'Главен инспектор';
            $dlaznost_short = 'Гл. инспектор';
        }
        if($request['dlaznost'] == 3){
            $dlaznost_full = 'Старши инспектор';
            $dlaznost_short = 'Ст. инспектор';
        }
        if($request['dlaznost'] == 4){
            $dlaznost_full = 'Инспектор';
            $dlaznost_short = 'Инспектор';
        }
        if($request['dlaznost'] == 5){
            $dlaznost_full = 'Главен експерт';
            $dlaznost_short = 'Гл. експерт';
        }
        if($request['dlaznost'] == 6){
            $dlaznost_full = 'Старши експерт';
            $dlaznost_short = 'Ст. експерт';
        }
        if($request['dlaznost'] == 7){
            $dlaznost_full = 'Експерт';
            $dlaznost_short = 'Експерт';
        }

        /////////
        if(!isset($request['rz'])){
            $rz = 0;
        }
        else{
            $rz = $request['rz'];
        }
        ///
        if(!isset($request['orz'])){
            $orz = 0;
        }
        else{
            $orz = $request['orz'];
        }
        ///
        if(!isset($request['fsk'])){
            $fsk = 0;
        }
        else{
            $fsk = $request['fsk'];
        }
        ///
        if(!isset($request['ppz'])){
            $ppz = 0;
        }
        else{
            $ppz = $request['ppz'];
        }
        ///
        if(!isset($request['lab'])){
            $lab = 0;
        }
        else{
            $lab = $request['lab'];
        }
        $user = User::findOrFail($id);
        $data = ([
            'active'=> $request['active'],
            'dlaznost'=> $request['dlaznost'],
            'all_name'=> mb_convert_case  ($request['all_name'], MB_CASE_TITLE, "UTF-8"),
            'karta'=> $request['karta'],
            'short_name'=> mb_convert_case ($request['short_name'], MB_CASE_TITLE, "UTF-8"),
            'name'=> $request['name'],
            'admin'=> $request['admin'],
            'password'=> $request['password'],
            'full_all_name'=> $dlaznost_full.' '.mb_convert_case  ($request['all_name'], MB_CASE_TITLE, "UTF-8"),
            'full_short_name'=> $dlaznost_short.' '.mb_convert_case ($request['short_name'], MB_CASE_TITLE, "UTF-8"),
            'position'=>$dlaznost_full,
            'position_short'=>$dlaznost_short,
            'rz'=> $rz,
            'orz'=> $orz,
            'fsk'=> $fsk,
            'ppz'=> $ppz,
            'lab'=> $lab,
        ]);
        $user->fill($data);
        $user->save();

        Session::flash('message', 'Инспектора е редактиран успешно!');
        return Redirect::to('/admin/users');
    }
}
