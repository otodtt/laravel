<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class FarmerProtocol extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'farmers_protocols';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'opinion_id', 'number_protocol', 'date_protocol', 'inspector', 'inspector_two', 'inspector_three', 'inspector_another',
        'inspector_from', 'opinions', 'check_id', 'check_type', 'description', 'firm', 'name', 'sex', 'pin', 'bulstat', 'egn_eik',
        'owner', 'areas_id', 'district_id', 'city_id', 'tvm', 'location', 'address', 'district_object', 'location_farm', 'violation',
        'ascertainment', 'taken', 'order_protocol', 'act', 'assay_more', 'assay_prz', 'assay_tor', 'assay_metal', 'assay_micro',
        'assay_other', 'type_check', 'inspector_name', 'position', 'position_short', 'inspector_two_name', 'position_two',
        'position_short_two', 'inspector_three_name', 'position_three', 'position_short_three', 'alphabet' , 'date_add',
        'added_by', 'date_update', 'updated_by', 'assay_more_name', 'assay_prz_name', 'assay_tor_name', 'assay_metal_name',
        'assay_micro_name', 'assay_other_name'
    ];

}
