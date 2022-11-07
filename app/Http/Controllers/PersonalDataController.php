<?php

namespace odbh\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;

use odbh\Http\Requests\ChangePasswordRequest;
use odbh\User;
use Redirect;
use Session;

class PersonalDataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
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
        $districts = $this->district_full;
        $user = User::findOrFail($id);

        if ((int)$id === Auth::user()->id ) {
            return view('personal.index');
        } else {
            return redirect('/logout');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChangePasswordRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = ([
            'password'=> $request['pass'],
        ]);
        if ((int)$id === Auth::user()->id ) {
            $user->fill($data);
            $user->save();
            Session::flash('message', 'Паролата е сменена успешно!');
            return Redirect::to('/начало');
        } else {
            return redirect('/logout');
        }
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
