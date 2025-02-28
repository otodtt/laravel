<?php

namespace odbh\Http\Controllers;

use Illuminate\Http\Request;

use odbh\Certificate;

use odbh\Farmer;
use odbh\Http\Requests;
use odbh\PhitoTraders;
use odbh\PhitoOperator;
use Session;
use Redirect;
use odbh\Set;
use Auth;
use odbh\User;
use odbh\Http\Requests\PhitoOperatorsRequests;

class PhitoTradersController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('sanitary', ['only'=>['create', 'store', 'edit', 'update', 'destroy']]);

        $this->logo = Set::all()->toArray();

        //////// ИНСПЕКТОРИ
        /** За Активните инспектори които могат да добавят */
        $inspectors_add = $this->inspectors_active_fsk_list->toArray();
        $inspectors_add[''] = '';
        $this->inspectors_add = array_sort_recursive($inspectors_add);

        /** За Всички които са добавяли Протоколи + Активните*/
        $inspectors_active = $this->inspectors_active_fsk_list->toArray();
        $inspectors_db = Certificate::lists('short_name', 'inspector_id')->toArray();
        $this->inspectors_edit_db = $inspectors_active + $inspectors_db;

        $this->index = Set::select('area_id', 'index_in', 'index_out', 'in_second', 'out_second', 'operator_index_not', 'operator_index_bg')->get()->toArray();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traders = PhitoTraders::get();

        return view('phytosanitary.traders.index', compact( 'traders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phytosanitary.traders.crud.create');
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
            ['trader_name' => 'required|min:3|max:100'],
            [
                'trader_name.required' => 'Попълни името на фирмата!',
                'trader_name.min' => 'Минимален брой символи за името - 3!',
                'trader_name.max' => 'Максимален брой символи за името - 100!',
            ]);
        $this->validate($request,
            ['trader_address' => 'min:3|max:150'],
            [
                'trader_address.required' => 'Попълни адреса на фирмата!',
                'trader_address.min' => 'Минимален брой символи за адреса - 3!',
                'trader_address.max' => 'Максимален брой символи за адреса - 150!',
            ]);
        $this->validate($request,
            ['city' => 'required|min:3|max:150'],
            [
                'city.required' => 'Попълни Града!',
                'city.min' => 'Минимален брой символи за Града - 3!',
                'city.max' => 'Максимален брой символи за Града - 150!',
            ]);
        $this->validate($request,
            ['trader_vin' => 'is_valid|digits_between:9,13|unique:traders_phito,trader_vin,'.$request->trader_vin ],
            [
                'trader_vin.required' => 'Булстата е задължителен!',
                'trader_vin.digits_between' => 'Булстата е само с цифри! Минимален брой символи - 9',
                'trader_vin.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',
                'trader_vin.unique' => 'Булстата трябва да е уникален! Намерена е фирма с този БУЛСТАТ',
            ]);
        $this->validate($request,
            ['phone' => 'numeric|digits_between:5,10'],
            [
                'phone.numeric' => 'За телефон използвай само цифри!',
                'phone.digits_between' => 'За телефон използвай между 5 и 10 броя цифри',
            ]);

        $data = ([
            'trader_name' => $request['trader_name'],
            'trader_address' => $request['trader_address'],
            'city' => $request['city'],
            'trader_vin' => $request['trader_vin'],
            'phone' => $request['phone'],

            'date_create' => date('d.m.Y H:i', time()),
            'created_by' => Auth::user()->id,
        ]);

        PhitoTraders::create($data);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-тъговци');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trader = PhitoTraders::findOrFail($id);
        $operators = $trader->operator;
        $operator_index = $this->index;

        return view('phytosanitary.traders.show', compact( 'trader', 'operators', 'operator_index'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trader = PhitoTraders::findOrFail($id);

        return view('phytosanitary.traders.crud.edit', compact( 'trader'));
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
        $trader = PhitoTraders::findOrFail($id);
        $this->validate($request,
            ['trader_name' => 'required|min:3|max:100'],
            [
                'trader_name.required' => 'Попълни името на фирмата!',
                'trader_name.min' => 'Минимален брой символи за името - 3!',
                'trader_name.max' => 'Максимален брой символи за името - 100!',
            ]);
        $this->validate($request,
            ['trader_address' => 'min:3|max:150'],
            [
                'trader_address.required' => 'Попълни адреса на фирмата!',
                'trader_address.min' => 'Минимален брой символи за адреса - 3!',
                'trader_address.max' => 'Максимален брой символи за адреса - 150!',
            ]);
        $this->validate($request,
            ['city' => 'required|min:3|max:150'],
            [
                'city.required' => 'Попълни Града!',
                'city.min' => 'Минимален брой символи за Града - 3!',
                'city.max' => 'Максимален брой символи за Града - 150!',
            ]);
        $this->validate($request,
            ['phone' => 'numeric|digits_between:5,10'],
            [
                'phone.numeric' => 'За телефон използвай само цифри!',
                'phone.digits_between' => 'За телефон използвай между 5 и 10 броя цифри',
            ]);

        $data = ([
            'trader_name' => $request['trader_name'],
            'trader_address' => $request['trader_address'],
            'city' => $request['city'],
            'phone' => $request['phone'],

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,
        ]);
        $trader->fill($data);
        $trader->save();

        $data_operator = ([
            'name_operator' => $request['trader_name'],
            'address_operator' => $request['trader_address'],
            'address' => $request['city'],
            'pin' => $trader->trader_vin,
        ]);

        $trader->operator()->where('trader_id','=',$trader->id)->update($data_operator);

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-тъговци');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reg_edit($id)
    {
        $index = $this->index;

        $operator = PhitoOperator::findOrFail($id);
        $trader = PhitoTraders::findOrFail($operator->trader_id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        $uid = Auth::user()->id;
        $user = User::select('id', 'all_name' , 'all_name_en', 'short_name', 'stamp_number')->where('id', '=', $uid)->get()->toArray();

        return view('phytosanitary.traders.crud.edit_reg', compact('trader', 'index', 'user', 'inspectors',  'operator'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\PhitoOperatorsRequests|PhitoOperatorsRequests $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function reg_update(PhitoOperatorsRequests $request, $id)
    {
        $operator = PhitoOperator::findOrFail($id);

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }
        ///

        if($operator->update_number > 0 && $operator->update_date){
            $update_number = $request->update_number;
            $update_date = strtotime($request->update_date);
        } else {
            $update_number = 0;
            $update_date = 0;
        }

        $data = [
            'update_number' => $update_number,
            'update_date' => $update_date,

            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $request->inspector_name,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $request->inspector_checked,
            'date_operator' => $request->date_operator,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action,
            'is_completed' => 1,

            'date_update' => date('d.m.Y H.i', time()),
            'updated_by' => Auth::user()->id,
        ];
        $operator->fill($data);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/оператор/'.$id);
    }

    /**
     * Show the form for creating a new resource.
     *  @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function from_trader($id)
    {
        $index = $this->index;

        $trader = PhitoTraders::findOrFail($id);

        $inspectors = User::select('id', 'short_name')
            ->where('active', '=', 1)
            ->where('fsk','=', 1)
            ->where('stamp_number','<', 5000)
            ->lists('short_name', 'id')->toArray();
        $inspectors = array_sort_recursive($inspectors);

        return view('phytosanitary.traders.crud.add_from_trader', compact('trader',  'inspectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|PhitoOperatorsRequests $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store_from(PhitoOperatorsRequests $request, $id)
    {
        $trader = PhitoTraders::findOrFail($id);

        // 1
        if(isset ($request->production)) {
            $production = $request->production;
        } else {
            $production = 0;
        }
        //2
        if(isset ($request->processing)) {
            $processing = $request->processing;
        } else {
            $processing = 0;
        }
        // 3
        if(isset ($request->import)) {
            $import = $request->import;
        } else {
            $import = 0;
        }
        // 4
        if(isset ($request->export)) {
            $export = $request->export;
        } else {
            $export = 0;
        }
        // 5
        if(isset ($request->trade)) {
            $trade = $request->trade;
        } else {
            $trade = 0;
        }
        // 6
        if(isset ($request->storage)) {
            $storage = $request->storage;
        } else {
            $storage = 0;
        }
        // 7
        if(isset ($request->treatment)) {
            $treatment = $request->treatment;
        } else {
            $treatment = 0;
        }

        // 222 europa
        if(isset ($request->europa)) {
            $europa = $request->europa;
        } else {
            $europa = 0;
        }
        // 222 bulgaria
        if(isset ($request->bulgaria)) {
            $bulgaria = $request->bulgaria;
        } else {
            $bulgaria = 0;
        }
        // 222 own
        if(isset ($request->own)) {
            $own = $request->own;
        } else {
            $own = 0;
        }

        $data = [
            'number_petition' => $request->number_petition,
            'date_petition' => strtotime($request->date_petition),

            'description_objects_one' => $request->description_objects_one,
            'description_places_one' => $request->description_places_one,
            'description_objects_two' => $request->description_objects_two,
            'description_places_two' => $request->description_places_two,
            'production' => $production,
            'processing' =>  $processing,
            'import' => $import,
            'export' => $export,
            'trade' => $trade,
            'storage' => $storage,
            'treatment' => $treatment,
            'others' => $request->others,
            'plants' => $request->plants,
            'europa' => $europa,
            'bulgaria' => $bulgaria,
            'own' => $own,
            'origin_from' => $request->origin_from,
            'passports' => $request->passports,
            'passports_list' => $request->passports_list,
            'marking' => $request->marking,
            'marking_list' => $request->marking_list,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_address' => $request->contact_address,
            'contact_city' => $request->contact_city,
            'date_place' => $request->date_place,
            'place' => $request->place,
            'registration' => $request->registration,
            'registration_note' => $request->registration_note,
            'disposition' => $request->disposition,
            'disposition_note' => $request->disposition_note,
            'property' => $request->property,
            'property_note' => $request->property_note,
            'plants_origin' => $request->plants_origin,
            'plants_note' => $request->plants_note,
            'others_note' => $request->others_note,
            'accepted' => $request->accepted,
            'accepted_name' => $request->inspector_name,
            'free_text' => $request->free_text,
            'checked' => $request->checked,
            'checked_name' => $request->inspector_checked,
            'date_operator' => $request->date_operator,

            'date_add' => date('d.m.Y H:i', time()),
            'added_by' => Auth::user()->id,

            'farmer_id' => 0,
            'pin' => $trader->trader_vin,
            'trader_id' => $trader->id,
            'name_operator' => $trader->trader_name,
            'address_operator' => $trader->trader_address,
            'address' => $trader->city,

            'activity' => $request->activity,
            'products' => $request->products,
            'derivation' => $request->derivation,
            'purpose' => $request->purpose,
            'room' => $request->room,
            'action' => $request->action
        ];
//        dd($data);
        PhitoOperator::create($data);

        $data_trader = [
            'is_add'=>''
        ];

        $trader->fill($data_trader);
        $trader->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-оператори');
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

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quick_add($id)
    {
        $trader = PhitoTraders::findOrFail($id);

        return view('phytosanitary.traders.quick.add_quick', compact( 'trader'));
    }

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $oid
     * @return \Illuminate\Http\Response
     */
    public function quick_store(Request $request, $id)
    {

        $trader = PhitoTraders::findOrFail($id);

        $this->validate($request,
            ['number_petition' => 'required|numeric|digits_between:1,10'],
            [
                'number_petition.required' => 'Номера на заявлението е задължителен!',
                'number_petition.numeric' => 'Номер на заявлението използвай само цифри!',
                'number_petition.digits_between' => 'Номера на заявлението използвай между 1 и 10 броя цифри',
            ]);
        $this->validate($request,
            ['date_petition' => 'required|date_format:d.m.Y'],
            [
                'date_petition.required' => 'Датата на заявлението е задължителна!',
                'date_petition.date_format' => 'Непозволен формата за дата на заявлението!',
            ]);
        $this->validate($request,
            ['update_date' => 'date_format:d.m.Y'],
            [
                'update_date.date_format' => 'Непозволен формата за дата на Актуализация!',
            ]);
        $this->validate($request,
            ['registration_date' => 'required|date_format:d.m.Y'],
            [
                'registration_date.required' => 'Датата на Регистрация е задължителна!',
                'registration_date.date_format' => 'Непозволен формата за дата на Регистрация!',
            ]);
        $this->validate($request,
            ['activity' => 'required|min:3|max:50|cyrillic_with'],
            [
                'activity.required' => 'Поле Дейност/и по чл. 65(1) е задължително!',
                'activity.min' => 'Минимален брой символи за Дейност - 3!',
                'activity.max' => 'Максимален брой символи за Дейност - 50!',
                'activity.cyrillic_with' => 'За Поле Дейност/и по чл. 65(1) пиши на кирилица!',
            ]);
        $this->validate($request,
            ['derivation' => 'required|min:3|max:50|cyrillic_with'],
            [
                'derivation.required' => 'Поле Произход е задължително!',
                'derivation.min' => 'Минимален брой символи за Произход - 3!',
                'derivation.max' => 'Максимален брой символи за Произход - 50!',
                'derivation.cyrillic_with' => 'За Произход пиши на кирилица!',
            ]);
        $this->validate($request,
            ['products' => 'required|min:3|max:50|cyrillic_with'],
            [
                'products.required' => 'Поле Естество е задължително!',
                'products.min' => 'Минимален брой символи за Естество  - 3!',
                'products.max' => 'Максимален брой символи за Естество  - 50!',
                'products.cyrillic_with' => 'За Естество пиши на кирилица!',
            ]);
        $this->validate($request,
            ['purpose' => 'required|min:3|max:50|cyrillic_with'],
            [
                'purpose.required' => 'Поле Предназначение е задължително!',
                'purpose.min' => 'Минимален брой символи за Предназначение  - 3!',
                'purpose.max' => 'Максимален брой символи за Предназначение  - 50!',
                'purpose.cyrillic_with' => 'За Предназначение пиши на кирилица!',
            ]);
        $this->validate($request,
            ['room' => 'min:3|max:50|cyrillic_with'],
            [
                'room.min' => 'Минимален брой символи за Адрес на помещенията  - 3!',
                'room.max' => 'Максимален брой символи за Адрес на помещенията  - 50!',
                'room.cyrillic_with' => 'За Адрес на помещенията пиши на кирилица!',
            ]);
        $this->validate($request,
            ['action' => 'min:3|max:50|cyrillic_with'],
            [
                'action.min' => 'Минимален брой символи за Дейност  - 3!',
                'action.max' => 'Максимален брой символи за Дейност  - 50!',
                'action.cyrillic_with' => 'За Дейност пиши на кирилица!',
            ]);

        $data = ([
            'number_petition' => $request['number_petition'],
            'date_petition' => strtotime($request['date_petition']),
            'update_date' => strtotime($request['update_date']),
            'registration_date' => strtotime($request['registration_date']),
            'activity' => $request['activity'],
            'derivation' => $request['derivation'],
            'products' => $request['products'],
            'purpose' => $request['purpose'],
            'room' => $request['room'],
            'action' => $request['action'],

            'trader_id' => $trader->id,
            'name_operator' => $trader->trader_name,
            'address' => $trader->trader_address,
            'pin' => $trader->trader_vin,
            'is_completed' => 2,

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,
        ]);

        $operator = PhitoOperator::create($data);
        $insertedId = $operator->id;

        $data_id = (['registration_number' => $insertedId]);
        $operator->fill($data_id);
        $operator->save();

        $is_add = (['is_add' => 1]);
        $trader->fill($is_add);
        $trader->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-тъговци');
    }

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table_add()
    {
        return view('phytosanitary.quick.add_quick');
    }

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function table_store(Request $request)
    {
        $this->validate($request,
            ['result' => 'required'],
            [
                'result.required' => 'Избери дали е Търговец или ЗС!',
            ]);
        if($request['result'] == 1 ){
            $this->validate($request,
                ['trader_name' => 'required|min:3|max:100|cyrillic_with'],
                [
                    'trader_name.required' => 'Попълни името на фирмата!',
                    'trader_name.min' => 'Минимален брой символи за името - 3!',
                    'trader_name.max' => 'Максимален брой символи за името - 100!',
                    'trader_name.cyrillic_with' => 'За името пиши на кирилица!',
                ]);
            $this->validate($request,
                ['trader_address' => 'min:3|max:150|cyrillic_with'],
                [
                    'trader_address.required' => 'Попълни адреса на фирмата!',
                    'trader_address.min' => 'Минимален брой символи за адреса - 3!',
                    'trader_address.max' => 'Максимален брой символи за адреса - 150!',
                    'trader_address.cyrillic_with' => 'За адреса пиши на кирилица!',
                ]);
            $this->validate($request,
                ['city' => 'required|min:3|max:150|cyrillic_with'],
                [
                    'city.required' => 'Попълни Град/Село!',
                    'city.min' => 'Минимален брой символи за Град/Село - 3!',
                    'city.max' => 'Максимален брой символи за Град/Село - 150!',
                    'city.cyrillic_with' => 'За Град/Село пиши на кирилица!',
                ]);
            $this->validate($request,
                ['trader_vin' => 'is_valid|digits_between:9,13|unique:traders_phito,trader_vin,'.$request['trader_vin']],
                [
                    'trader_vin.required' => 'Булстата е задължителен!',
                    'trader_vin.digits_between' => 'Булстата е само с цифри! Минимален брой символи - 9',
                    'trader_vin.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',
                    'trader_vin.unique' => 'Булстата трябва да е уникален! Намерена е фирма с този БУЛСТАТ',
                ]);
            $this->validate($request,
                ['phone' => 'numeric|digits_between:5,10'],
                [
                    'phone.numeric' => 'За телефон използвай само цифри!',
                    'phone.digits_between' => 'За телефон използвай между 5 и 10 броя цифри',
                ]);
        }
        elseif($request['result'] == 2){
            $this->validate($request,
                ['farmer_id' => 'numeric|digits_between:1,10|not_in:0'],
                [
                    'farmer_id.numeric' => 'За ID на ЗС използвай само цифри!',
                    'farmer_id.digits_between' => 'За ID на ЗС използвай само цифри!!',
                    'farmer_id.not_in' => 'За ID не може да е нула!!',
                ]);
            $this->validate($request,
                ['name_operator' => 'required|min:3|max:100|cyrillic_with'],
                [
                    'name_operator.required' => 'Попълни името на ЗС!',
                    'name_operator.min' => 'Минимален брой символи за името - 3!',
                    'name_operator.max' => 'Максимален брой символи за името - 100!',
                    'name_operator.cyrillic_with' => 'За името пиши на кирилица!',
                ]);
            $this->validate($request,
                ['address_operator' => 'min:3|max:150|cyrillic_with'],
                [
                    'address_operator.required' => 'Попълни адреса на ЗС!',
                    'address_operator.min' => 'Минимален брой символи за адреса - 3!',
                    'address_operator.max' => 'Максимален брой символи за адреса - 150!',
                    'address_operator.cyrillic_with' => 'За адреса пиши на кирилица!',
                ]);
            $this->validate($request,
                ['address' => 'required|min:3|max:150|cyrillic_with'],
                [
                    'address.required' => 'Попълни Град/Село!',
                    'address.min' => 'Минимален брой символи за Град/Село - 3!',
                    'address.max' => 'Максимален брой символи за Град/Село - 150!',
                    'address.cyrillic_with' => 'За Град/Село пиши на кирилица!',
                ]);
        }

        $this->validate($request,
            ['number_petition' => 'required|numeric|digits_between:1,10'],
            [
                'number_petition.required' => 'Номера на заявлението е задължителен!',
                'number_petition.numeric' => 'Номер на заявлението използвай само цифри!',
                'number_petition.digits_between' => 'Номера на заявлението използвай между 1 и 10 броя цифри',
            ]);
        $this->validate($request,
            ['date_petition' => 'required|date_format:d.m.Y'],
            [
                'date_petition.required' => 'Датата на заявлението е задължителна!',
                'date_petition.date_format' => 'Непозволен формата за дата на заявлението!',
            ]);
        $this->validate($request,
            ['update_date' => 'date_format:d.m.Y'],
            [
                'update_date.date_format' => 'Непозволен формата за дата на Актуализация!',
            ]);
        $this->validate($request,
            ['registration_date' => 'required|date_format:d.m.Y'],
            [
                'registration_date.required' => 'Датата на Регистрация е задължителна!',
                'registration_date.date_format' => 'Непозволен формата за дата на Регистрация!',
            ]);
        $this->validate($request,
            ['activity' => 'required|min:3|max:50|cyrillic_with'],
            [
                'activity.required' => 'Поле Дейност/и по чл. 65(1) е задължително!',
                'activity.min' => 'Минимален брой символи за Дейност - 3!',
                'activity.max' => 'Максимален брой символи за Дейност - 50!',
                'activity.cyrillic_with' => 'За Поле Дейност/и по чл. 65(1) пиши на кирилица!',
            ]);
        $this->validate($request,
            ['derivation' => 'required|min:3|max:50|cyrillic_with'],
            [
                'derivation.required' => 'Поле Произход е задължително!',
                'derivation.min' => 'Минимален брой символи за Произход - 3!',
                'derivation.max' => 'Максимален брой символи за Произход - 50!',
                'derivation.cyrillic_with' => 'За Произход пиши на кирилица!',
            ]);
        $this->validate($request,
            ['products' => 'required|min:3|max:50|cyrillic_with'],
            [
                'products.required' => 'Поле Естество е задължително!',
                'products.min' => 'Минимален брой символи за Естество  - 3!',
                'products.max' => 'Максимален брой символи за Естество  - 50!',
                'products.cyrillic_with' => 'За Естество пиши на кирилица!',
            ]);
        $this->validate($request,
            ['purpose' => 'required|min:3|max:50|cyrillic_with'],
            [
                'purpose.required' => 'Поле Предназначение е задължително!',
                'purpose.min' => 'Минимален брой символи за Предназначение  - 3!',
                'purpose.max' => 'Максимален брой символи за Предназначение  - 50!',
                'purpose.cyrillic_with' => 'За Предназначение пиши на кирилица!',
            ]);
        $this->validate($request,
            ['room' => 'min:3|max:50|cyrillic_with'],
            [
                'room.min' => 'Минимален брой символи за Адрес на помещенията  - 3!',
                'room.max' => 'Максимален брой символи за Адрес на помещенията  - 50!',
                'room.cyrillic_with' => 'За Адрес на помещенията пиши на кирилица!',
            ]);
        $this->validate($request,
            ['action' => 'min:3|max:50|cyrillic_with'],
            [
                'action.min' => 'Минимален брой символи за Дейност  - 3!',
                'action.max' => 'Максимален брой символи за Дейност  - 50!',
                'action.cyrillic_with' => 'За Дейност пиши на кирилица!',
            ]);

        if($request['result'] == 1) {
            $data_trader = ([
                'trader_name' => $request['trader_name'],
                'city' => $request['city'],
                'trader_address' => $request['trader_address'],
                'trader_vin' => $request['trader_vin'],
                'phone' => $request['trader_vin'],

                'date_create' => date('d.m.Y H:i', time()),
                'created_by' => Auth::user()->id,
            ]);

            $trader = PhitoTraders::create($data_trader);
            $insertedIdTrader = $trader->id;

            $data_operator = ([
                'number_petition' => $request['number_petition'],
                'date_petition' => strtotime($request['date_petition']),
                'update_date' => strtotime($request['update_date']),
                'registration_date' => strtotime($request['registration_date']),
                'activity' => $request['activity'],
                'derivation' => $request['derivation'],
                'products' => $request['products'],
                'purpose' => $request['purpose'],
                'room' => $request['room'],
                'action' => $request['action'],

                'trader_id' => $insertedIdTrader,
                'name_operator' => $request['trader_name'],
                'address_operator' => $request['trader_address'],
                'address' => $request['city'],
                'pin' => $request['trader_vin'],
                'is_completed' => 2,

                'date_create' => date('d.m.Y H:i', time()),
                'created_by' => Auth::user()->id,
            ]);

            $operator = PhitoOperator::create($data_operator);
            $insertedIdNumber = $operator->id;

            $data_id = (['registration_number' => $insertedIdNumber]);
            $operator->fill($data_id);
            $operator->save();

            $is_add = ([
                'is_add' => 1,
                'registration_number' => $insertedIdNumber,
            ]);
            $trader->fill($is_add);
            $trader->save();

            Session::flash('message', 'Записа е успешен!');
            return Redirect::to('/фито/регистър-тъговци');
        }


        //////
        if($request['result'] == 2) {
            $data_operator = ([
                'number_petition' => $request['number_petition'],
                'date_petition' => strtotime($request['date_petition']),
                'update_date' => strtotime($request['update_date']),
                'registration_date' => strtotime($request['registration_date']),
                'activity' => $request['activity'],
                'derivation' => $request['derivation'],
                'products' => $request['products'],
                'purpose' => $request['purpose'],
                'room' => $request['room'],
                'action' => $request['action'],

                'farmer_id' => $request['farmer_id'],
                'name_operator' => $request['name_operator'],
                'address_operator' => $request['address_operator'],
                'address' => $request['address'],
                'pin' => $request['pin'],
                'is_completed' => 2,

                'date_create' => date('d.m.Y H:i', time()),
                'created_by' => Auth::user()->id,
            ]);
//            dd($data_operator);
            $operator = PhitoOperator::create($data_operator);
            $insertedIdNumber = $operator->id;

            $data_id = (['registration_number' => $insertedIdNumber]);
            $operator->fill($data_id);
            $operator->save();

            Session::flash('message', 'Записа е успешен!');
            return Redirect::to('/фито/регистър-оператори');
        }
    }

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $oid
     * @return \Illuminate\Http\Response
     */
    public function table_farmer($id, $oid)
    {
        $operator = PhitoOperator::findOrFail($oid);
        $farmer = Farmer::findOrFail($id);
//        dd($operator->registration_date);
        return view('phytosanitary.quick.quick_farmer', compact('operator', 'farmer'));
    }

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $oid
     * @return \Illuminate\Http\Response
     */
    public function table_store_farmer(Request $request, $id, $oid)
    {
        $this->validate($request,
            ['number_petition' => 'required|numeric|digits_between:1,10'],
            [
                'number_petition.required' => 'Номера на заявлението е задължителен!',
                'number_petition.numeric' => 'Номер на заявлението използвай само цифри!',
                'number_petition.digits_between' => 'Номера на заявлението използвай между 1 и 10 броя цифри',
            ]);
        $this->validate($request,
            ['date_petition' => 'required|date_format:d.m.Y'],
            [
                'date_petition.required' => 'Датата на заявлението е задължителна!',
                'date_petition.date_format' => 'Непозволен формата за дата на заявлението!',
            ]);
        $this->validate($request,
            ['update_date' => 'date_format:d.m.Y'],
            [
                'update_date.date_format' => 'Непозволен формата за дата на Актуализация!',
            ]);
        $this->validate($request,
            ['registration_date' => 'required|date_format:d.m.Y'],
            [
                'registration_date.required' => 'Датата на Регистрация е задължителна!',
                'registration_date.date_format' => 'Непозволен формата за дата на Регистрация!',
            ]);
        $this->validate($request,
            ['activity' => 'required|min:3|max:50|cyrillic_with'],
            [
                'activity.required' => 'Поле Дейност/и по чл. 65(1) е задължително!',
                'activity.min' => 'Минимален брой символи за Дейност - 3!',
                'activity.max' => 'Максимален брой символи за Дейност - 50!',
                'activity.cyrillic_with' => 'За Поле Дейност/и по чл. 65(1) пиши на кирилица!',
            ]);
        $this->validate($request,
            ['derivation' => 'required|min:3|max:50|cyrillic_with'],
            [
                'derivation.required' => 'Поле Произход е задължително!',
                'derivation.min' => 'Минимален брой символи за Произход - 3!',
                'derivation.max' => 'Максимален брой символи за Произход - 50!',
                'derivation.cyrillic_with' => 'За Произход пиши на кирилица!',
            ]);
        $this->validate($request,
            ['products' => 'required|min:3|max:50|cyrillic_with'],
            [
                'products.required' => 'Поле Естество е задължително!',
                'products.min' => 'Минимален брой символи за Естество  - 3!',
                'products.max' => 'Максимален брой символи за Естество  - 50!',
                'products.cyrillic_with' => 'За Естество пиши на кирилица!',
            ]);
        $this->validate($request,
            ['purpose' => 'required|min:3|max:50|cyrillic_with'],
            [
                'purpose.required' => 'Поле Предназначение е задължително!',
                'purpose.min' => 'Минимален брой символи за Предназначение  - 3!',
                'purpose.max' => 'Максимален брой символи за Предназначение  - 50!',
                'purpose.cyrillic_with' => 'За Предназначение пиши на кирилица!',
            ]);
        $this->validate($request,
            ['room' => 'min:3|max:50|cyrillic_with'],
            [
                'room.min' => 'Минимален брой символи за Адрес на помещенията  - 3!',
                'room.max' => 'Максимален брой символи за Адрес на помещенията  - 50!',
                'room.cyrillic_with' => 'За Адрес на помещенията пиши на кирилица!',
            ]);
        $this->validate($request,
            ['action' => 'min:3|max:50|cyrillic_with'],
            [
                'action.min' => 'Минимален брой символи за Дейност  - 3!',
                'action.max' => 'Максимален брой символи за Дейност  - 50!',
                'action.cyrillic_with' => 'За Дейност пиши на кирилица!',
            ]);

        $operator = PhitoOperator::findOrFail($oid);

        $data_operator = ([
            'number_petition' => $request['number_petition'],
            'date_petition' => strtotime($request['date_petition']),
            'update_date' => strtotime($request['update_date']),
            'registration_number' => $oid,
            'registration_date' => strtotime($request['registration_date']),
            'activity' => $request['activity'],
            'derivation' => $request['derivation'],
            'products' => $request['products'],
            'purpose' => $request['purpose'],
            'room' => $request['room'],
            'action' => $request['action'],
            'is_completed' => 2,

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,
        ]);

        $operator->fill($data_operator);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-оператори');

    }

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function table_edit($id)
    {
        $operator = PhitoOperator::findOrFail($id);

        return view('phytosanitary.quick.quick_edit', compact('operator'));
    }

    /**
     * ВЕРОТНО ЩЕ СЕ МАХНЕ И НЯМА ДА СЕ ПОКАЗВА
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function table_edit_operator(Request $request, $id)
    {
        $this->validate($request,
            ['number_petition' => 'required|numeric|digits_between:1,10'],
            [
                'number_petition.required' => 'Номера на заявлението е задължителен!',
                'number_petition.numeric' => 'Номер на заявлението използвай само цифри!',
                'number_petition.digits_between' => 'Номера на заявлението използвай между 1 и 10 броя цифри',
            ]);
        $this->validate($request,
            ['date_petition' => 'required|date_format:d.m.Y'],
            [
                'date_petition.required' => 'Датата на заявлението е задължителна!',
                'date_petition.date_format' => 'Непозволен формата за дата на заявлението!',
            ]);
        $this->validate($request,
            ['update_date' => 'date_format:d.m.Y'],
            [
                'update_date.date_format' => 'Непозволен формата за дата на Актуализация!',
            ]);
        $this->validate($request,
            ['registration_date' => 'required|date_format:d.m.Y'],
            [
                'registration_date.required' => 'Датата на Регистрация е задължителна!',
                'registration_date.date_format' => 'Непозволен формата за дата на Регистрация!',
            ]);
        $this->validate($request,
            ['activity' => 'required|min:3|max:50|cyrillic_with'],
            [
                'activity.required' => 'Поле Дейност/и по чл. 65(1) е задължително!',
                'activity.min' => 'Минимален брой символи за Дейност - 3!',
                'activity.max' => 'Максимален брой символи за Дейност - 50!',
                'activity.cyrillic_with' => 'За Поле Дейност/и по чл. 65(1) пиши на кирилица!',
            ]);
        $this->validate($request,
            ['derivation' => 'required|min:3|max:50|cyrillic_with'],
            [
                'derivation.required' => 'Поле Произход е задължително!',
                'derivation.min' => 'Минимален брой символи за Произход - 3!',
                'derivation.max' => 'Максимален брой символи за Произход - 50!',
                'derivation.cyrillic_with' => 'За Произход пиши на кирилица!',
            ]);
        $this->validate($request,
            ['products' => 'required|min:3|max:50|cyrillic_with'],
            [
                'products.required' => 'Поле Естество е задължително!',
                'products.min' => 'Минимален брой символи за Естество  - 3!',
                'products.max' => 'Максимален брой символи за Естество  - 50!',
                'products.cyrillic_with' => 'За Естество пиши на кирилица!',
            ]);
        $this->validate($request,
            ['purpose' => 'required|min:3|max:50|cyrillic_with'],
            [
                'purpose.required' => 'Поле Предназначение е задължително!',
                'purpose.min' => 'Минимален брой символи за Предназначение  - 3!',
                'purpose.max' => 'Максимален брой символи за Предназначение  - 50!',
                'purpose.cyrillic_with' => 'За Предназначение пиши на кирилица!',
            ]);
        $this->validate($request,
            ['room' => 'min:3|max:50|cyrillic_with'],
            [
                'room.min' => 'Минимален брой символи за Адрес на помещенията  - 3!',
                'room.max' => 'Максимален брой символи за Адрес на помещенията  - 50!',
                'room.cyrillic_with' => 'За Адрес на помещенията пиши на кирилица!',
            ]);
        $this->validate($request,
            ['action' => 'min:3|max:50|cyrillic_with'],
            [
                'action.min' => 'Минимален брой символи за Дейност  - 3!',
                'action.max' => 'Максимален брой символи за Дейност  - 50!',
                'action.cyrillic_with' => 'За Дейност пиши на кирилица!',
            ]);

        $operator = PhitoOperator::findOrFail($id);

        $data_operator = ([
            'number_petition' => $request['number_petition'],
            'date_petition' => strtotime($request['date_petition']),
            'update_date' => strtotime($request['update_date']),
            'registration_date' => strtotime($request['registration_date']),
            'activity' => $request['activity'],
            'derivation' => $request['derivation'],
            'products' => $request['products'],
            'purpose' => $request['purpose'],
            'room' => $request['room'],
            'action' => $request['action'],
            'is_completed' => 2,

            'date_update' => date('d.m.Y H:i', time()),
            'updated_by' => Auth::user()->id,
        ]);

        $operator->fill($data_operator);
        $operator->save();

        Session::flash('message', 'Записа е успешен!');
        return Redirect::to('/фито/регистър-оператори');

    }

}
