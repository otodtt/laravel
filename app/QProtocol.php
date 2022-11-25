<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class QProtocol extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'qprotocols';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'farmer_id', 'farmer_name', 'farmer_address', 'farmer_phone', 'farmer_vin',
        'trader_id', 'trader_name', 'trader_address', 'trader_phone', 'trader_vin',
        'unregulated_id', 'unregulated_name', 'unregulated_address', 'unregulated_phone', 'unregulated_vin',
        'number_protocol', 'date_protocol', 'crops', 'crops_name', 'origin', 'quality_class', 'quality_naw', 'tara', 'different',
        'number', 'type_package', 'variety', 'documents', 'marking', 'cleanliness', 'coloring', 'dimensions', 'appearance',
        'maturity', 'damage', 'shape', 'defects', 'diseases', 'mark', 'repackaging', 'processing', 'low', 'relabeling',
        'fodder', 'resort', 'destruction', 'actions', 'name_trader', 'place',
        'inspectors', 'inspector_name', 'date_update', 'updated_by', 'date_add', 'added_by',
    ];

}
