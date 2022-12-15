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
        'unregulated_id', 'unregulated_name', 'unregulated_address',
        'notes', 'number_protocol', 'date_protocol', 'inspector_id', 'inspector_name', 'is_all',
        'date_update', 'updated_by', 'date_add', 'added_by'
    ];

    /**
     * Формуляра има много стоки към него
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(){
        return $this->hasMany('odbh\Article', 'compliance_id');
    }
}
