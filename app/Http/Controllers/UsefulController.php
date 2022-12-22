<?php

namespace odbh\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use Input;
use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Useful;
use Redirect;
use Session;

class UsefulController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regulations()
    {
        $regulations = Useful::select()->where('document_type','=', 1)->where('is_active','=', 1)->get();
//        dd($regulations);
//        return view('services.useful.regulations', compact('permits', 'alphabet','abc', 'inspectors', 'year_now', 'years'));
        return view('useful.regulations', compact( 'regulations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('useful.create.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'blade' => 'required',
                'document_type' => 'required|not_in:0',
                'document_name' => 'required|min:3|max:500',
                'document_short' => 'min:3|max:300',
                'document_for' => 'required',
                'is_active' => 'required',
            ],
            [
                'blade.required' => 'Избери файл!',
                'document_type.required'=>'Задължително избери вида на документа!',
                'document_type.not_in'=>'Задължително избери вида на документа!',

                'document_name.required' => 'Попълни името на документа!',
                'document_name.min' => 'Минимален брой символи за името - 3!',
                'document_name.max' => 'Максимален брой символи за името - 500!',

                'document_short.min' => 'Минимален брой символи за краткото име - 3!',
                'document_short.max' => 'Максимален брой символи за краткото име - 300!',

                'document_for.required'=>'Задължително избери за кого се отнася документа!',
            ]);

        $destinationPath = base_path('public'.DIRECTORY_SEPARATOR.'documents'.DIRECTORY_SEPARATOR); // upload path

        $file = Input::file('blade');
        $filename = $file->getClientOriginalName();

        $data = [
            'document_type' => $request->document_type,
            'document_name' => $request->document_name,
            'document_short' => $request->document_short,
            'document_path' => $destinationPath,
            'document_for' => $request->document_for,
            'is_active' => $request->is_active,
            'date_create' => date('d.m.Y', time()),
            'created_by' => Auth::user()->id,
        ];

        Useful::create($data);

        Input::file('blade')->move($destinationPath, $filename); // uploading file to given path

        Session::flash('message', 'Записа е успешен!');
        if($request->document_type == 1) {
            return Redirect::to('/полезно/регламенти');
        }
        elseif($request->document_type == 2){
            return Redirect::to('/полезно/закони');
        }
        elseif($request->document_type == 3){
            return Redirect::to('/полезно/наредби');
        }
        elseif($request->document_type == 4){
            return Redirect::to('/полезно/бланки');
        }
        else {
            return Redirect::to('/полезно/регламенти');
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
