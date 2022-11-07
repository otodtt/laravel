<?php

namespace odbh\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Requests\LoginRequest;
use Redirect;
use Session;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() == false){
            return view('auth.login');
        }
        return view('home');
    }

    /**
     * Display след влизане в системата.
     *
     * @return \Illuminate\Http\Response
     */
//    public function home()
//    {
//        return view('home');
////       http://odbh/
//
//    }

    /**
     * Излизане от системата.
     */
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
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
     * @param  \odbh\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        if(Auth::attempt(['name'=>$request['name'], 'password'=>$request['password'], 'active'=>1 ])){
            return Redirect::to('/начало');
        }
        Session::flash('log-message', 'Логин името и паролата не съвпадат! Опитай отново!');
        return Redirect::to('/');
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
    public function edit($id){}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}
}
