<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class PhytoPassport extends Model
{
    public $timestamps = false;

    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'passports';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['passport', 'date_permit', 'number_petition', 'date_petition', 'quantity', 'quantity_type',
                            'manufacturer', 'is_farmer', 'is_operator', 'botanical', 'direction', 'full_direction',
                            'address', 'pin', 'city', 'protected', 'invoice', 'date_invoice', 'created_by', 'updated_by',
                            'date_create', 'date_update', 'is_lock'];

    public function passport(){
        return $this->hasMany('odbh\Farmer', 'is_farmer');
    }
}
