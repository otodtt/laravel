<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
//    protected $table = 'objects_reports';
    protected $table = 'reports_pharmacy';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [ 'id_from_object', 'number', 'date_protocol', 'inspector', 'inspector_two',
        'inspector_three', 'inspector_another', 'inspector_from', 'ot', 'firm', 'name', 'city_id', 'city_village',
        'place', 'address', 'district_object', 'ascertainment', 'taken', 'order_protocol', 'date_add', 'added_by',
        'date_update', 'updated_by', 'alphabet', 'assay_prz', 'assay_tor', 'type_check',
        'protocol',

        'activity', 'activity_note',
        'certificate', 'certificate_note',
        'delivery', 'delivery_note',
        'sales', 'sales_note',
        'unauthorized', 'unauthorized_note',
        'first', 'first_note',
        'improperly', 'improperly_note',
        'repackaged', 'repackaged_note',
        'expired', 'expired_note',
        'compliance', 'compliance_note',
        'leaflet', 'leaflet_note',
        'larger', 'larger_note',
        'purpose', 'purpose_note',
        'storage', 'storage_note',
        'warehouse', 'warehouse_note',
        'separated', 'separated_note',
        'access', 'access_note',
        'flooring' , 'flooring_note',
        'combustible', 'combustible_note',
        'contract', 'contract_note',

        'inspector_name', 'inspector_two_name', 'inspector_three_name', 'position', 'position_short', 'position_two',
        'position_short_two', 'position_three', 'position_short_three', 'assay_more'];

    /**
     * Този доклад принадлежи на фирма
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firm(){
        return $this->belongsTo('odbh\Firm');
    }
}
