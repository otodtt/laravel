<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

//use odbh\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Input;
use Illuminate\Validation;


class TemplatesController extends Controller
{
    /**
     * Шаблон за Лого.
     *
     * @return \Illuminate\Http\Response
     */
    public function templates_logo()
    {
        $districts = $this->district_full;

        return view('admin.templates.logo', compact('areas','districts'));
    }

    /**
     * Запазва шаблона.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_templates_logo(Request $request)
    {
        $this->validate($request, [
            'blade' => 'required|max:10000|logo_blade|logo_blade_length',
        ]);

        $destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR); // upload path

        $file = Input::file('blade');
        $filename = $file->getClientOriginalName();

        Input::file('blade')->move($destinationPath, $filename); // uploading file to given path

        Session::flash('message', 'Записа е успешен!');

        return Redirect::to('/админ/настройки');
    }
    ///////////////////
    /**
     * Шаблон за Удостоверение.
     *
     * @return \Illuminate\Http\Response
     */
    public function templates_documents()
    {
        $districts = $this->district_full;

        return view('admin.templates.add_document', compact('areas','districts'));
    }

    /**
     * Запазва шаблона.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_templates_document(Request $request)
    {
        $this->validate($request, [
            'blade' => 'required|max:10000|doc_blade|doc_blade_length',
        ]);

        $destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'objects'.DIRECTORY_SEPARATOR.'documents_all'.DIRECTORY_SEPARATOR.'doc'.DIRECTORY_SEPARATOR); // upload path

        $file = Input::file('blade');
        $filename = $file->getClientOriginalName();

        Input::file('blade')->move($destinationPath, $filename); // uploading file to given path

        Session::flash('message', 'Записа е успешен!');

        return Redirect::to('/админ/настройки');
    }
    //////////////
    /**
     * Шаблон за Промяна в обстоятелствата на Удостоверение..
     *
     * @return \Illuminate\Http\Response
     */
    public function templates_editions()
    {
        $districts = $this->district_full;

        return view('admin.templates.add_edition', compact('areas','districts'));
    }

    /**
     * Запазва шаблона.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_templates_editions(Request $request)
    {
        $this->validate($request, [
            'blade' => 'required|max:10000|edition_blade|edition_blade_length',
        ]);

        $destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'objects'.DIRECTORY_SEPARATOR.'documents_all'.DIRECTORY_SEPARATOR.'doc_editions'.DIRECTORY_SEPARATOR); // upload path

        $file = Input::file('blade');
        $filename = $file->getClientOriginalName();

        Input::file('blade')->move($destinationPath, $filename); // uploading file to given path

        Session::flash('message', 'Записа е успешен!');

        return Redirect::to('/админ/настройки');
    }
    /////////////////
    /**
     * Шаблон за Сертификат.
     *
     * @return \Illuminate\Http\Response
     */
    public function templates_certificate()
    {
        $districts = $this->district_full;

        return view('admin.templates.add_certificate', compact('areas','districts'));
    }

    /**
     * Запазва шаблона.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_certificate_document(Request $request)
    {
        $this->validate($request, [
            'blade' => 'required|max:10000|certificate_blade|certificate_blade_length',
        ]);

        $destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'certificates'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR); // upload path

        $file = Input::file('blade');
        $filename = $file->getClientOriginalName();

        Input::file('blade')->move($destinationPath, $filename); // uploading file to given path

        Session::flash('message', 'Записа е успешен!');

        return Redirect::to('/админ/настройки');
    }
    ////////////////
    /**
     * Шаблон за Становище.
     *
     * @return \Illuminate\Http\Response
     */
    public function templates_opinion()
    {
        $districts = $this->district_full;

        return view('admin.templates.add_opinion', compact('districts'));
    }

    /**
     * Запазва шаблона.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_templates_opinion(Request $request)
    {
        $this->validate($request, [
            'blade' => 'required|max:10000|opinion_blade|opinion_blade_length',
        ]);

        $destinationPath = base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'opinions'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR); // upload path
        $file = Input::file('blade');
        $filename = $file->getClientOriginalName();

        Input::file('blade')->move($destinationPath, $filename); // uploading file to given path

        Session::flash('message', 'Записа е успешен!');

        return Redirect::to('/админ/настройки');
    }
}
