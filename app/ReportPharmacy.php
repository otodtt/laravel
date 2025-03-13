<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class ReportPharmacy extends Model
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
    protected $fillable = [ 'id_from_object', 'id_from_firm', 'number', 'date_report', 'inspector', 'inspector_two',
        'inspector_three', 'inspector_another', 'inspector_from', 'ot', 'firm', 'name', 'city_village',
        'place', 'district_object', 'alphabet', 'type_check', 'date_add', 'added_by', 'date_update', 'updated_by',
        'inspector_name', 'position_short',  'inspector_two_name', 'position_short_two', 'inspector_three_name',
        'position_short_three', 'created_at', 'updated_at', 'assay_prz', 'assay_tor', 'assay_more',

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
        'protocol',
        'protocol_number',
        'protocol_date',
        'is_violation'
    ];

    /**
     * Този доклад принадлежи на фирма
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firm(){
        return $this->belongsTo('odbh\Firm');
    }

    /**
     * Доклад има костативен протокол
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function protocols(){
        return $this->hasMany('odbh\Protocol', 'id_from_object');
    }
}
