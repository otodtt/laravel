<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'market_assay';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['number_sample', 'date_number', 'from_firm', 'name', 'active_subs', 'maker', 'inspector', 'results', 'eo',
                            'number_mail', 'date_mail', 'type_assay', 'firm_id', 'from_object', 'number_mail', 'date_mail',
                            'tc_sample', 'type', 'type_formula', 'lot_number', 'volume', 'type_volume', 'volume_pac', 'type_pac',
                            'packaged', 'state', 'date_lot', 'volume_lot'];
}
