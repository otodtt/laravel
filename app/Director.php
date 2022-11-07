<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

use odbh\Http\Requests\DirectorsCreateRequest;
use odbh\Http\Requests\DirectorsUpdateRequest;
use DB;

class Director extends Model
{
    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'directors';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['name', 'surname', 'family', 'degree', 'type_dir', 'start_date', 'end_date'];

    /**
     * Запис на данните при добавяне на нов Директор
     * @param DirectorsCreateRequest $request
     */
    public function DirectorCreate(DirectorsCreateRequest $request){
        $end_date = '01.01.2030';
        $request->replace(array(
            'name'=> mb_convert_case ($request['name'], MB_CASE_TITLE, "UTF-8"),
            'surname'=> mb_convert_case  ($request['surname'], MB_CASE_TITLE, "UTF-8"),
            'family'=> mb_convert_case  ($request['family'], MB_CASE_TITLE, "UTF-8"),
            'degree'=> $request['degree'],
            'type_dir'=> $request['type_dir'],
            'start_date'=> strtotime($request['start_date']),
            'end_date'=> strtotime($end_date)
        ));
        Director::create($request->all());

        if(DB::getPdo()->lastInsertId() >1){
            $prev_id = (DB::getPdo()->lastInsertId() -1);
            DB::update('UPDATE directors SET end_date=? WHERE id=?',[$request->start_date, $prev_id]);
        }
    }

    /**
     * Запис на данните при Редактиране на Директор
     * @param DirectorsUpdateRequest $request
     * @param $id
     */
    public function DirectorUpdate(DirectorsUpdateRequest $request, $id){
        $end_date = '01.01.2030';
        $request->replace (array(
            'name'=> mb_convert_case ($request['name'], MB_CASE_TITLE, "UTF-8"),
            'surname'=> mb_convert_case  ($request['surname'], MB_CASE_TITLE, "UTF-8"),
            'family'=> mb_convert_case  ($request['family'], MB_CASE_TITLE, "UTF-8"),
            'degree'=> $request['degree'],
            'type_dir'=> $request['type_dir'],
            'start_date'=> strtotime($request['start_date']),
            'end_date'=> strtotime($end_date),
        ));

        Director::update($request->all());
        DB::update('UPDATE directors SET end_date=? WHERE id=?',[$request->start_date, $id-1]);
    }
}

