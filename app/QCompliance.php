<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class QCompliance extends Model
{
    public $timestamps = false;

    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'qcompliances';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'date_compliance', 'farmer_id', 'farmer_name', 'farmer_address', 'object_control',
        'trader_id', 'trader_name', 'trader_address', 'name_trader',
        'notes', 'number_protocol', 'date_protocol', 'inspector_id', 'inspector_name', 'is_all',
        'date_update', 'updated_by', 'date_add', 'added_by'
    ];

}
