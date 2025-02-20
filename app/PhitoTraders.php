<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class PhitoTraders extends Model
{
    public $timestamps = false;

    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'traders_phito';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['trader_name', 'trader_address', 'trader_vin', 'phone', 'registration_number', 'is_add',
                            'city', 'created_by', 'updated_by', 'date_create', 'date_update'];

    public function operator(){
        return $this->hasMany('odbh\PhitoOperator', 'trader_id');
    }
}
