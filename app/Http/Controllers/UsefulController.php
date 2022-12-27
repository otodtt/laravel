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
    public function __construct()
    {
        parent::__construct();

        $this->path = '/documents/';
    }

    /** РЕГЛАМЕНТИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regulations()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 1)->where('is_active','=', 1)->get();

        return view('useful.regulations', compact( 'regulations', 'path'));
    }

    /** ЗАКОНИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laws()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 2)->where('is_active','=', 1)->get();

        return view('useful.laws', compact( 'regulations', 'path'));
    }

    /** НАРЕДБИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordinances()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 3)->where('document_for','=', 0)->where('is_active','=', 1)->get();
        $controls = Useful::select()->where('document_type','=', 3)->where('document_for','=', 1)->where('is_active','=', 1)->get();
        $fsc = Useful::select()->where('document_type','=', 3)->where('document_for','=', 2)->where('is_active','=', 1)->get();
        $quality = Useful::select()->where('document_type','=', 3)->where('document_for','=', 3)->where('is_active','=', 1)->get();

        return view('useful.ordinances', compact( 'regulations', 'controls', 'fsc', 'quality', 'path'));
    }

    /** ЗАЯВЛЕНИЯ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applications()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 4)->where('document_for','=', 0)->where('is_active','=', 1)->get();
        $controls = Useful::select()->where('document_type','=', 4)->where('document_for','=', 1)->where('is_active','=', 1)->get();
        $fsc = Useful::select()->where('document_type','=', 4)->where('document_for','=', 2)->where('is_active','=', 1)->get();
        $quality = Useful::select()->where('document_type','=', 4)->where('document_for','=', 3)->where('is_active','=', 1)->get();

        return view('useful.applications', compact( 'regulations', 'controls', 'fsc', 'quality', 'path'));
    }

    /** ДЕКЛАРАЦИИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function declarations()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 5)->where('document_for','=', 0)->where('is_active','=', 1)->get();
        $controls = Useful::select()->where('document_type','=', 5)->where('document_for','=', 1)->where('is_active','=', 1)->get();
        $fsc = Useful::select()->where('document_type','=', 5)->where('document_for','=', 2)->where('is_active','=', 1)->get();
        $quality = Useful::select()->where('document_type','=', 5)->where('document_for','=', 3)->where('is_active','=', 1)->get();

        return view('useful.declarations', compact( 'regulations', 'controls', 'fsc', 'quality', 'path'));
    }

    /** ВЪЗДУШНИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aerial()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 6)->where('is_active','=', 1)->get();

        return view('useful.aerial', compact( 'regulations', 'path'));
    }

    /** ПРОЦЕДУРИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function procedures()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 7)->where('document_for','=', 0)->where('is_active','=', 1)->get();
        $controls = Useful::select()->where('document_type','=', 7)->where('document_for','=', 1)->where('is_active','=', 1)->get();
        $fsc = Useful::select()->where('document_type','=', 7)->where('document_for','=', 2)->where('is_active','=', 1)->get();
        $quality = Useful::select()->where('document_type','=', 7)->where('document_for','=', 3)->where('is_active','=', 1)->get();

        return view('useful.procedures', compact( 'regulations', 'controls', 'fsc', 'quality', 'path'));
    }

    /** ДРУГИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function others()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','=', 8)->where('is_active','=', 1)->get();

        return view('useful.others', compact( 'regulations', 'path'));
    }
    

    /** НЕ АКТИВНИ
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function not_active()
    {
        $path =  $this->path;
        $regulations = Useful::select()->where('document_type','>', 0)->where('is_active','=', 0)->get();



        return view('useful.active', compact( 'regulations', 'path'));
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
            'filename' => $filename,
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
            return Redirect::to('/полезно/заявления');
        }
        elseif($request->document_type == 5){
            return Redirect::to('/полезно/декларации');
        }
        elseif($request->document_type == 6){
            return Redirect::to('/полезно/въздушни');
        }
        elseif($request->document_type == 7){
            return Redirect::to('/полезно/процедури');
        }
        elseif($request->document_type == 8){
            return Redirect::to('/полезно/други');
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
        $document = Useful::FindOrFail($id);
        return view('useful.edit.edit', compact( 'document'));
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
        $this->validate($request,
            [
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

        $document = Useful::findOrFail($id);
        $message_del = '';

        $destinationPath = base_path('public'.DIRECTORY_SEPARATOR.'documents'.DIRECTORY_SEPARATOR); // upload path

        if(Input::file('blade') != null ) {
            $file = Input::file('blade');
            $filename = $file->getClientOriginalName();

            $location_with_name = $destinationPath.$document->filename;

            if(file_exists($location_with_name)){
                $delete  = unlink($location_with_name);
                if($delete){
                    $message_del = 'Изтрит е стария файл!';
                }else{
                    $message_del = 'Стария файл не можа да се изтрие!';
                }
            }

            Input::file('blade')->move($destinationPath, $filename); // uploading file to given path

            $data = [
                'document_type' => $request->document_type,
                'document_name' => $request->document_name,
                'document_short' => $request->document_short,
                'document_path' => $destinationPath,
                'filename' => $filename,
                'document_for' => $request->document_for,
                'is_active' => $request->is_active,
                'date_update' => date('d.m.Y', time()),
                'updated_by' => Auth::user()->id,
            ];
        }
        else {
            $data = [
                'document_type' => $request->document_type,
                'document_name' => $request->document_name,
                'document_short' => $request->document_short,
                'document_for' => $request->document_for,
                'is_active' => $request->is_active,
                'date_update' => date('d.m.Y', time()),
                'updated_by' => Auth::user()->id,
            ];
        }

        $document->fill($data);
        $document->save();

        Session::flash('message', 'Записа е успешен!');
        Session::put('message_del', $message_del);
        
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
            return Redirect::to('/полезно/заявления');
        }
        elseif($request->document_type == 5){
            return Redirect::to('/полезно/декларации');
        }
        elseif($request->document_type == 6){
            return Redirect::to('/полезно/въздушни');
        }
        elseif($request->document_type == 7){
            return Redirect::to('/полезно/процедури');
        }
        elseif($request->document_type == 8){
            return Redirect::to('/полезно/други');
        }
        else {
            return Redirect::to('/полезно/регламенти');
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
        $document = Useful::FindOrFail($id);
        $destinationPath = base_path('public'.DIRECTORY_SEPARATOR.'documents'.DIRECTORY_SEPARATOR); // upload path

        $location_with_name = $destinationPath.$document->filename;

        if(file_exists($location_with_name)){
            unlink($location_with_name);
        }
        
        $document->delete();

        Session::flash('message', 'Документът е изтрит успешно!');
        return Redirect::to('/полезно/неактивни');
    }
}
