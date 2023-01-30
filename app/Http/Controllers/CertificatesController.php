<?php

namespace odbh\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use odbh\Certificate;
use odbh\Director;
use odbh\Http\Requests;
use Illuminate\Validation;
use odbh\Set;
use odbh\User;
use Redirect;
use Input;
use odbh\Http\Requests\CertificatesCreateRequest;
use odbh\Http\Requests\CertificatesUpdateRequest;
use Session;

class CertificatesController extends Controller
{
    private $logo = null;

    ///// За Инспекторите
    private $inspectors_add = null;

    private $inspectors_edit_db = null;

    private $index = null;

    /**
     * CertificatesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('control', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        $this->logo = Set::all()->toArray();

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_rz_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        /** За Всички които са добавяли Протоколи + Активните*/
        $inspectors_active = $this->inspectors_active_rz_list->toArray();
        $inspectors_db = Certificate::lists('short_name', 'inspector_id')->toArray();
        $this->inspectors_edit_db = $inspectors_active + $inspectors_db;


        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::get();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $abc = null;
        $alphabet = Certificate::lists('alphabet')->toArray();

        return view('certificates.index', compact('certificates', 'alphabet','abc', 'inspectors'));
    }

    /**
     * Търси по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search_return = $request['search'];
        $search_value_return = $request['search_value'];

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        if((int)$request['search'] == 0){
            $this->validate($request, ['search' => 'not_in:0']);
            $certificates = Certificate::get();
        };
        if((int)$request['search'] == 1){
            $this->validate($request, ['search_value' => 'required|digits_between:1,7']);
            $certificates = Certificate::where('number','=',$request['search_value'])->get();
        };
        if((int)$request['search'] == 2){
            $this->validate($request, ['search_value' => 'required|digits_between:9,10']);
            $certificates = Certificate::where('pin','=',$request['search_value'])->get();
        };

        $abc = null;
        $alphabet = Certificate::lists('alphabet')->toArray();

        return view('certificates.index', compact('certificates', 'alphabet','abc', 'inspectors', 'search_return', 'search_value_return'));
    }

    /**
     * Сортиране на Сертификатите
     *
     * @param  int $abc_list
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $limit_sort
     * @param  int $inspector_sort
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request, $abc_list = null, $start_year = null, $end_year = null, $limit_sort = null, $inspector_sort = null)
    {
        //dd($request->all());
        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = 'по инспектор';
        $inspectors = array_sort_recursive($inspectors);

        $alphabet = Certificate::lists('alphabet')->toArray();
        $abc = null;
        $years_sql = '';

        if (Input::has('start_year') || Input::has('end_year') || Input::has('limit_sort') || Input::has('inspector_sort') || Input::has('abc')) {

            $abc = Input::get('abc');
            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_limit = Input::get('limit_sort');
            $sort_inspector = Input::get('inspector_sort');
        } else {
            $abc = $abc_list;
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_limit = $limit_sort;
            $sort_inspector = $inspector_sort;
        }
        if (isset($years_start_sort) || isset($years_end_sort)) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');
            if($start > 0 && $end == false){
                $years_sql = ' AND date='.$start.' OR date='.$timezone_paris_start;
            }
            if($end > 0 && $start == false){
                $years_sql = ' AND date='.$end.' OR date='.$timezone_paris_end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                $years_sql = ' AND date='.$start.' OR date='.$timezone_paris_start;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)){
                $years_sql = ' AND date>='.$start.' AND date<='.$end.'';
            }
            if(($start > 0 && $end > 0) && ($start > $end)){
                $years_sql = ' AND date>='.$end.' AND date<='.$start.'';
            }
        }
        else{
            $years_sql = ' ';
        }

        if (isset($sort_limit) && (int)$sort_limit == 1){
            $limit_sql = ' AND limit_certificate= 1';
        }
        elseif (isset($sort_limit) && (int)$sort_limit == 2){
            $limit_sql = ' AND limit_certificate= 2';
        }
        elseif (isset($sort_limit) && (int)$sort_limit == 3){
            $date_now = time();
            $limit_sql = ' AND to_date < '.$date_now .' AND to_date!=1 AND limit_certificate!=1';
        }
        else{
            $limit_sql = ' ';
        }

        if (isset($sort_inspector) && (int)$sort_inspector > 0){
            $inspector_sql = ' AND inspector_id= '.$sort_inspector;
        }
        else{
            $inspector_sql = '';
        }

        if (isset($abc) && $abc == 0) {
            $abc_sql = ' AND alphabet>0';
        } elseif (isset($abc) && $abc > 0) {
            $abc_sql = ' AND alphabet=' . (int)$abc;
        } else {
            $abc_sql = ' ';
        }

        $certificates = DB::select("SELECT * FROM certificates WHERE id >0 $years_sql $limit_sql $inspector_sql $abc_sql");

        return view('certificates.index', compact('certificates', 'alphabet','abc', 'years_start_sort', 'years_end_sort',
                     'inspectors', 'sort_limit', 'sort_inspector'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index = $this->index;

        $last_number = Certificate::select('number')
            ->orderBy('number', 'desc')
            ->limit(1)->get()->toArray();

        $inspectors = $this->inspectors_add;

        return view('certificates.create_certificate', compact('index', 'last_number', 'inspectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \odbh\Http\Requests\CertificatesCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificatesCreateRequest $request)
    {
        $in = null;
        $pic_name = null;
        $end_date = null;
        $sex = null;

        $cyrillic = array(0 => '', 1 => 'А', 2 => 'Б', 3 => 'В', 4 => 'Г', 5 => 'Д', 6 => 'Е', 7 => 'Ж', 8 => 'З', 9 => 'И', 10 => 'Й',
            11 => 'К', 12 => 'Л', 13 => 'М', 14 => 'Н', 15 => 'О', 16 => 'П', 17 => 'Р', 18 => 'С', 19 => 'Т', 20 => 'У',
            21 => 'Ф', 22 => 'Х', 23 => 'Ц', 24 => 'Ч', 25 => 'Ш', 26 => 'Щ', 27 => 'Ъ', 28 => 'Ь', 29 => 'Ю', 30 => 'Я');

        $abc = trim(preg_replace("/[0-9]/", "", $request['owner']));
        $abc1 = mb_substr($abc, 0, 1);
        foreach ($cyrillic as $k => $v) {
            if (preg_match("/$abc1/iu", "$v")) {
                $in = $k;
            }
        }

        if (strlen($request['gender']) == 4) {
            $sex = 1;
        }
        if (strlen($request['gender']) == 6) {
            $sex = 2;
        }
        if (strlen($request['gender']) == 1) {
            $sex = 0;
        }
        $index_in = Set::select('index_in')->get()->toArray();
        $index_ur = Set::select('area_id')->get();

        if($request['limit_certificate'] == 1){
            $end_date = '';
        }
        if($request['limit_certificate'] == 2){
            $end_date = strtotime('+10 years', strtotime($request['date']));
        }

        $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql[0]['full_short_name'];
        $short_name = $inspector_name_sql[0]['short_name'];

        ///// За снимката ///////
        if ($file = $request->file('file')) {
            $index_name_pic = $index_ur[0]['area_id'] . '_';
            if ($request['number'] <= 9) {
                $certificate_number = '000' . $request['number'];
            } elseif ($request['number'] <= 99) {
                $certificate_number = '00' . $request['number'];
            } elseif ($request['number'] <= 999) {
                $certificate_number = '0' . $request['number'];
            } else {
                $certificate_number = $request['number'];
            }


            $pic_extension = $file->guessClientExtension();
            $pic_name = $index_name_pic . $certificate_number . '.' . $pic_extension;
            $pic_folder = $index_name_pic . $certificate_number;

            $destinationPath = base_path('public'.DIRECTORY_SEPARATOR.'certificates_pic'.DIRECTORY_SEPARATOR.$pic_folder.DIRECTORY_SEPARATOR); // upload path
            $file->move($destinationPath, $pic_name); // uploading file to given path
        }

        $data = [
            'index_cert'  =>(int)$index_ur[0]['area_id'],
            'number' => $request['number'],
            'date' => strtotime($request['date']),
            'index_petition'  =>$index_in[0]['index_in'],
            'petition' => $request['petition'],
            'date_petition' => strtotime($request['date_petition']),
            'index_invoice'  =>'',
            'invoice' => $request['invoice'],
            'date_invoice' => strtotime($request['date_invoice']),
            'name' => $request['owner'],
            'sex' => $sex,
            'pin' => $request['pin'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => trim($request['email']),
            'document' => $request['document'],
            'series' => $request['series'],
            'number_diploma' => $request['number_diploma'],
            'date_diploma' => $request['date_diploma'],
            'from_institute' => $request['from_institute'],
            'specialty' => $request['specialty'],
            'limit_certificate' => $request['limit_certificate'],
            'to_date'  =>$end_date,
            'inspector_name' => $inspector_name,
            'inspector_id'  =>$request['inspector'],
            'short_name'  =>$short_name,
            'alphabet' =>$in,
            'date_add' =>time(),
            'added_by' => Auth::user()->id,
            'user_pic' =>$pic_name,
        ];
        Certificate::create($data);

        Session::flash('message', 'Сертификата е добавен успешно!');
        return Redirect::to('/сертификати');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificate = null;
        $logo = $this->logo;

        $certificate = Certificate::where('number','=',$id)->first();

        $director = Director::select('name', 'family', 'degree', 'type_dir')
            ->where('start_date','<=',$certificate->date)
            ->where('end_date','>=',$certificate->date)
            ->get()->toArray();

        return view('certificates.show', compact('certificate', 'logo', 'director'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index = $this->index;

        $last_number = Certificate::select('number')
            ->orderBy('number', 'desc')
            ->limit(1)->get()->toArray();

        $inspectors = $this->inspectors_edit_db;
        $inspectors[''] = '';
        $inspectors = array_sort_recursive($inspectors);

        $certificate = Certificate::findOrFail($id);

        return view('certificates.edit_certificate', compact('certificate', 'index', 'last_number', 'inspectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \odbh\Http\Requests\CertificatesUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CertificatesUpdateRequest $request, $id)
    {
        $certificate = Certificate::findOrFail($id);
        $in = null;
        $pic_name = null;
        $end_date = null;
        $sex = null;

        $cyrillic = array(0 => '', 1 => 'А', 2 => 'Б', 3 => 'В', 4 => 'Г', 5 => 'Д', 6 => 'Е', 7 => 'Ж', 8 => 'З', 9 => 'И', 10 => 'Й',
            11 => 'К', 12 => 'Л', 13 => 'М', 14 => 'Н', 15 => 'О', 16 => 'П', 17 => 'Р', 18 => 'С', 19 => 'Т', 20 => 'У',
            21 => 'Ф', 22 => 'Х', 23 => 'Ц', 24 => 'Ч', 25 => 'Ш', 26 => 'Щ', 27 => 'Ъ', 28 => 'Ь', 29 => 'Ю', 30 => 'Я');

        $abc = trim(preg_replace("/[0-9]/", "", $request['owner']));
        $abc1 = mb_substr($abc, 0, 1);
        foreach ($cyrillic as $k => $v) {
            if (preg_match("/$abc1/iu", "$v")) {
                $in = $k;
            }
        }

        if (strlen($request['gender']) == 4) {
            $sex = 1;
        }
        if (strlen($request['gender']) == 6) {
            $sex = 2;
        }
        if (strlen($request['gender']) == 1) {
            $sex = 0;
        }
        $index_in = Set::select('index_in')->get()->toArray();
        $index_ur = Set::select('area_id')->get();

        if($request['limit_certificate'] == 1){
            $end_date = '';
        }
        if($request['limit_certificate'] == 2){
            $end_date = strtotime('+10 years', strtotime($request['date']));
        }

        $inspector_name_sql = User::select('full_short_name', 'short_name')->where('id', '=', $request['inspector'])->get()->toArray();
        $inspector_name = $inspector_name_sql[0]['full_short_name'];
        $short_name = $inspector_name_sql[0]['short_name'];

        ///// За снимката ///////
        if ($file = $request->file('file')) {
            $index_name_pic = $index_ur[0]['area_id'] . '_';
            if ($certificate->number <= 9) {
                $certificate_number = '000' . $certificate->number;
            } elseif ($certificate->number<= 99) {
                $certificate_number = '00' . $certificate->number;
            } elseif ($certificate->number <= 999) {
                $certificate_number = '0' . $certificate->number;
            } else {
                $certificate_number = $certificate->number;
            }

            $pic_extension = $file->guessClientExtension();
            $pic_name = $index_name_pic . $certificate_number . '.' . $pic_extension;
            $pic_folder = $index_name_pic . $certificate_number;

            $destinationPath = base_path('public' . DIRECTORY_SEPARATOR . 'certificates_pic' . DIRECTORY_SEPARATOR . $pic_folder . DIRECTORY_SEPARATOR); // upload path
            $file->move($destinationPath, $pic_name); // uploading file to given path

            $data = [
                'date' => strtotime($request['date']),
                'index_petition' => $index_in[0]['index_in'],
                'petition' => $request['petition'],
                'date_petition' => strtotime($request['date_petition']),
                'index_invoice' => '',
                'invoice' => $request['invoice'],
                'date_invoice' => strtotime($request['date_invoice']),
                'name' => $request['owner'],
                'sex' => $sex,
                'pin' => $request['pin'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'email' => trim($request['email']),
                'document' => $request['document'],
                'series' => $request['series'],
                'number_diploma' => $request['number_diploma'],
                'date_diploma' => $request['date_diploma'],
                'from_institute' => $request['from_institute'],
                'specialty' => $request['specialty'],
                'limit_certificate' => $request['limit_certificate'],
                'to_date' => $end_date,
                'inspector_name' => $inspector_name,
                'inspector_id' => $request['inspector'],
                'short_name'  =>$short_name,
                'alphabet' => $in,
                'date_update' => time(),
                'updated_by' => Auth::user()->id,
                'user_pic' => $pic_name,
            ];
        }
        else {
            $data = [
                'date' => strtotime($request['date']),
                'index_petition' => $index_in[0]['index_in'],
                'petition' => $request['petition'],
                'date_petition' => strtotime($request['date_petition']),
                'index_invoice' => '',
                'invoice' => $request['invoice'],
                'date_invoice' => strtotime($request['date_invoice']),
                'name' => $request['owner'],
                'sex' => $sex,
                'pin' => $request['pin'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'email' => trim($request['email']),
                'document' => $request['document'],
                'series' => $request['series'],
                'number_diploma' => $request['number_diploma'],
                'date_diploma' => $request['date_diploma'],
                'from_institute' => $request['from_institute'],
                'specialty' => $request['specialty'],
                'limit_certificate' => $request['limit_certificate'],
                'to_date' => $end_date,
                'inspector_name' => $inspector_name,
                'inspector_id' => $request['inspector'],
                'short_name'  =>$short_name,
                'alphabet' => $in,
                'date_update' => time(),
                'updated_by' =>  Auth::user()->id,
            ];
        }

        $certificate->fill($data) ;
        $certificate->save($data) ;

        Session::flash('message', 'Сертификата е редактиран успешно!');
        return Redirect::to('/сертификат/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}
}
