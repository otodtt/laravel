<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

use odbh\Http\Requests;
use odbh\Http\Controllers\Controller;
use odbh\Http\Requests\InvoicesRequest;
use odbh\Importer;
use odbh\Invoice;
use odbh\QCertificate;
use odbh\QINCertificate;
use odbh\QXCertificate;
use odbh\User;
use Auth;
use Redirect;
use Session;
use Input;
use DB;
use odbh\Set;

class InvoicesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('quality', ['only'=>['create', 'store', 'edit', 'update', 'choose',
                    'import_create', 'import_store', 'import_update', 'import_edit',
                    'export_create', 'export_store', 'export_edit', 'export_update',
                    'domestic_create', 'domestic_store', 'domestic_edit', 'domestic_update']]);


        $this->index = Set::select('q_index', 'authority_bg', 'authority_en')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request|InvoicesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $firms = Importer::where('is_active', '=', 1)->where('trade', '>=', 0)->lists('name_en', 'id')->toArray();

        $search_return = $request['search'];
        $search_value_return = $request['search_value'];

        if((int)$request['search'] == 0){
            $this->validate($request, ['search' => 'not_in:0']);
        };
        if((int)$request['search'] == 1){
            $this->validate($request,
                ['search_value' => 'required|digits_between:1,5'],
                [
                    'search_value.required' => 'Попълни търсения номер!',
                    'search_value.digits_between' => 'Номера трябва да е между една и пет цифри!',
                ]);
            $invoices = Invoice::orderBy('date_invoice', 'desc')->where('certificate_number','=',$request['search_value'])->get();
        }
        elseif((int)$request['search'] == 2){
            $this->validate($request,
                ['search_value' => 'required|digits_between:3,10'],
                [
                    'search_value.required' => 'Попълни номера на фактурата!',
                    'search_value.digits_between' => 'Номера трябва да е между 3 и 10 цифри!',
                ]);
            $invoices = Invoice::orderBy('date_invoice', 'desc')->where('number_invoice','=',$request['search_value'])->get();
        }
        else {
            $invoices = Invoice::orderBy('date_invoice', 'desc')->get();
        };

        $for_sort = array(''=>'издаден за', 1=>'Сетификат за внос', 2=>'Сетификат за износ', 3=>'Вътрешен Сетификат');

        return view('quality.invoices.invoices', compact('invoices', 'firms', 'search_return', 'search_value_return', 'for_sort'));
    }

    /**
     * Сортира по задедени критерии.
     *
     * @param  \Illuminate\Http\Request $request
     * @param null $for_sort
     * @param  int $start_year
     * @param  int $end_year
     * @param  int $firm_sort
     *
     * @return \Illuminate\Http\Response
     * @internal param Crop $int
     */
    public function sort(Request $request, $start_year = null, $end_year = null, $for_sort = null, $firm_sort = null )
    {
        if (Input::has('start_year') || Input::has('end_year') || Input::has('for_sort') || Input::has('firm_sort')) {

            $years_start_sort = Input::get('start_year');
            $years_end_sort = Input::get('end_year');
            $sort_for = Input::get('for_sort');
            $sort_firm = Input::get('firm_sort');
        } else {
            $years_start_sort = $start_year;
            $years_end_sort = $end_year;
            $sort_for = $for_sort;
            $sort_firm = $firm_sort;
        }

        if ((isset($years_start_sort) && $years_start_sort != '') || (isset($years_end_sort) && $years_end_sort != '')) {
            $this->validate($request, ['start_year' => 'date_format:d.m.Y']);
            $this->validate($request, ['end_year' => 'date_format:d.m.Y']);

            $start = strtotime($years_start_sort);
            $timezone_paris_start = strtotime($years_start_sort.'Europe/Paris');

            $end = strtotime($years_end_sort);
            $timezone_paris_end = strtotime($years_end_sort.'Europe/Paris');
            if($start > 0 && $end == false){
                // $years_sql = ' AND date_invoice='.$start.' OR date_invoice='.$timezone_paris_start;
                $years_sql = ' AND date_invoice='.$start;
            }
            if($end > 0 && $start == false){
                // $years_sql = ' AND date_invoice='.$end.' OR date_invoice='.$timezone_paris_end;
                $years_sql = ' AND date_invoice='.$end;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start == (int)$end)){
                // $years_sql = ' AND date_invoice='.$start.' OR date_invoice='.$timezone_paris_start;
                $years_sql = ' AND date_invoice='.$start;
            }
            if(((int)$start > 0 && (int)$end > 0) && ((int)$start < (int)$end)){
                $years_sql = ' AND date_invoice>='.$start.' AND date_invoice<='.$end.'';
            }
            if(($start > 0 && $end > 0) && ($start > $end)){
                $years_sql = ' AND date_invoice>='.$end.' AND date_invoice<='.$start.'';
            }
        }
        else{
            $years_sql = ' ';
        }

        // Сортиране по вид
        if (isset($sort_for) && (int)$sort_for > 0){
            $for_sql = ' AND invoice_for='.$sort_for;
        }
        else{
            $for_sql = '';
        }
        // Сортиране по фирма
        if (isset($sort_firm) && (int)$sort_firm != 0) {
            $firm_sql = ' AND importer_id='.$sort_firm;
        }
        else{
            $firm_sql = ' ';
        }

        $for_sort = array(''=>'издаден за', 1=>'Сетификат за внос', 2=>'Сетификат за износ', 3=>'Вътрешен Сетификат');
        $firms = Importer::where('is_active', '=', 1)->where('trade', '>=', 0)->lists('name_en', 'id')->toArray();

        $invoices = DB::select("SELECT * FROM invoices WHERE id >0 $years_sql  $firm_sql $for_sql");

        return view('quality.invoices.invoices', compact('invoices', 'for_sort', 'firms',
            'years_start_sort', 'years_end_sort', 'sort_for',  'sort_firm'));
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

    /** ФАКТУРИ ВНОС  */
    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function import_create($id)
    {
        $certificate = QCertificate::findOrFail($id);

        return view('quality.invoices.form.create', compact('certificate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|InvoicesRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function import_store(InvoicesRequest $request, $id)
    {
        $certificate = QCertificate::findOrFail($id);

        $data = [
            'invoice_for' => 1,
            'number_invoice' => $request->invoice,
            'date_invoice' =>strtotime(stripslashes($request->date_invoice)),
            'sum' => $certificate->sum,
            'certificate_id' => $certificate->id,
            'certificate_number' => $certificate->import,
            'importer_id' => $certificate->importer_id,
            'importer_name' => $certificate->importer_name,
            'identifier' => $certificate->stamp_number.'/'.$certificate->import,
            'date_create' => date('d.m.Y', time()),
            'created_by' => Auth::user()->id,
        ];

        $invoice = Invoice::create($data);
        $invoice_id = $invoice->id;

        // Добавяне данни към сертификата
        $invoice_data = [
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice,
            'invoice_date' => strtotime(stripslashes($request->date_invoice)),
            //'sum' => round($request->sum, 2),
        ];

        $certificate->fill($invoice_data);
        $certificate->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-внос/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function import_edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $certificate = QCertificate::where('id', $invoice->certificate_id)->get();

        return view('quality.invoices.form.edit', compact('invoice', 'certificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\InvoicesRequest|InvoicesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function import_update(InvoicesRequest $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = [
            'number_invoice' => $request->invoice,
            'date_invoice' =>strtotime(stripslashes($request->date_invoice)),
            'date_update' => date('d.m.Y', time()),
            'updated_at' => Auth::user()->id,
        ];
        $invoice->fill($data);
        $invoice->save();

        // Редактиране данни към сертификата
        $certificate = QCertificate::where('invoice_id', $invoice->id)->firstOrFail();
        $invoice_data = [
            'invoice_number' => $request->invoice,
            'invoice_date' => strtotime(stripslashes($request->date_invoice)),
        ];

        $certificate->fill($invoice_data);
        $certificate->save();
        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-внос/'.$certificate->id);
    }

    /** ФАКТУРИ ВНОС  */
    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function export_create($id)
    {
        $certificate = QXCertificate::findOrFail($id);

        return view('quality.invoices.export.form.create', compact('certificate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|InvoicesRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function export_store(InvoicesRequest $request, $id)
    {
        $certificate = QXCertificate::findOrFail($id);

        $data = [
            'invoice_for' => 2,
            'number_invoice' => $request->invoice,
            'date_invoice' =>strtotime(stripslashes($request->date_invoice)),
            'sum' => $certificate->sum,
            'certificate_id' => $certificate->id,
            'certificate_number' => $certificate->export,
            'importer_id' => $certificate->importer_id,
            'importer_name' => $certificate->importer_name,
            'identifier' => $certificate->stamp_number.'/'.$certificate->export,
            'date_create' => date('d.m.Y', time()),
            'created_by' => Auth::user()->id,
        ];
        $invoice = Invoice::create($data);
        $invoice_id = $invoice->id;

        // Добавяне данни към сертификата
        $invoice_data = [
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice,
            'invoice_date' => strtotime(stripslashes($request->date_invoice)),
            //'sum' => round($request->sum, 2),
        ];

        $certificate->fill($invoice_data);
        $certificate->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-износ/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $certificate = QXCertificate::where('id', $invoice->certificate_id)->get();

        return view('quality.invoices.export.form.edit', compact('invoice', 'certificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\InvoicesRequest|InvoicesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function export_update(InvoicesRequest $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = [
            'number_invoice' => $request->invoice,
            'date_invoice' =>strtotime(stripslashes($request->date_invoice)),
            'date_update' => date('d.m.Y', time()),
            'updated_at' => Auth::user()->id,
        ];
        $invoice->fill($data);
        $invoice->save();

        // Редактиране данни към сертификата
        $certificate = QXCertificate::where('invoice_id', $invoice->id)->firstOrFail();
        $invoice_data = [
            'invoice_number' => $request->invoice,
            'invoice_date' => strtotime(stripslashes($request->date_invoice)),
        ];

        $certificate->fill($invoice_data);
        $certificate->save();
        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификат-износ/'.$certificate->id);
    }

    /** ФАКТУРИ ВЪТРЕШНИ  */
    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function domestic_create($id)
    {
        $certificate = QINCertificate::findOrFail($id);

        return view('quality.invoices.domestic.form.create', compact('certificate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|InvoicesRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function domestic_store(InvoicesRequest $request, $id)
    {
        $farmer_id = null;
        $trader_id = null;
        $certificate = QINCertificate::findOrFail($id);
        if($certificate->type_firm > 0 && $certificate->farmer_id > 0) {
            $farmer_id = $certificate->farmer_id;
            $trader_id = 0;
        }
        if(($certificate->type_firm == 0 && $certificate->farmer_id == 0) && $certificate->trader_id > 0) {
            $farmer_id = 0;
            $trader_id = $certificate->trader_id;
        }

        $data = [
            'invoice_for' => 3,
            'number_invoice' => $request->invoice,
            'date_invoice' =>strtotime(stripslashes($request->date_invoice)),
            'sum' => round($request->sum, 2),
            'certificate_id' => $certificate->id,
            'certificate_number' => $certificate->internal,
            'importer_id' => 0,
            'farmer_id' =>  $farmer_id,
            'trader_id' =>  $trader_id,
            'importer_name' => $certificate->trader_name,
            'identifier' => $certificate->stamp_number.'/'.$certificate->internal,
            'date_create' => date('d.m.Y', time()),
            'created_by' => Auth::user()->id,
        ];

        $invoice = Invoice::create($data);
        $invoice_id = $invoice->id;

        // Добавяне данни към сертификата
        $invoice_data = [
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice,
            'invoice_date' => strtotime(stripslashes($request->date_invoice)),
            'sum' => round($request->sum, 2),
        ];

        $certificate->fill($invoice_data);
        $certificate->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификати-вътрешен/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function domestic_edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $certificate = QINCertificate::where('id', $invoice->certificate_id)->get();

        return view('quality.invoices.domestic.form.edit', compact('invoice', 'certificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\InvoicesRequest|InvoicesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function domestic_update(InvoicesRequest $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = [
            'number_invoice' => $request->invoice,
            'date_invoice' =>strtotime(stripslashes($request->date_invoice)),
            'sum' => round($request->sum, 2),
            'date_update' => date('d.m.Y', time()),
            'updated_at' => Auth::user()->id,
        ];
        $invoice->fill($data);
        $invoice->save();

        // Редактиране данни към сертификата
        $certificate = QINCertificate::where('invoice_id', $invoice->id)->firstOrFail();
        $invoice_data = [
            'invoice_number' => $request->invoice,
            'invoice_date' => strtotime(stripslashes($request->date_invoice)),
            'sum' => round($request->sum, 2),
        ];

        $certificate->fill($invoice_data);
        $certificate->save();
        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/контрол/сертификати-вътрешен/'.$certificate->id);
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
