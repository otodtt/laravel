<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'objects_protocols';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [ 'id_from_object', 'number', 'date_protocol', 'inspector', 'inspector_two',
                            'inspector_three', 'inspector_another', 'inspector_from', 'ot', 'firm', 'name', 'city_id', 'city_village',
                            'place', 'address', 'district_object', 'ascertainment', 'taken', 'order_protocol', 'date_add', 'added_by',
                            'date_update', 'updated_by', 'alphabet', 'assay_prz', 'assay_tor', 'type_check', 'act', 'violation',
                            'inspector_name', 'inspector_two_name', 'inspector_three_name', 'position', 'position_short', 'position_two',
                            'position_short_two', 'position_three', 'position_short_three', 'assay_more'];

    /**
     * Този протокол принадлежи на фирма
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firm(){
        return $this->belongsTo('odbh\Firm');
    }

    public function report_pharmacy(){
        return $this->belongsTo('odbh\ReportPharmacy');
    }
}
