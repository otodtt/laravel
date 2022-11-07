<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class OtherProtocol extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'others_protocols';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['ot', 'type_check', 'number', 'date_protocol', 'inspector', 'inspector_two', 'inspector_three',
        'inspector_another', 'inspector_from', 'firm', 'name', 'bulstat', 'owner', 'pin_owner', 'sex_owner', 'areas_id',
        'district_id', 'city_village', 'location', 'address', 'violation', 'ascertainment', 'taken', 'order_protocol', 'act',
        'assay_prz', 'assay_more', 'area_object', 'district_object', 'cv_object', 'location_object', 'address_object', 'inspector_name', 'position', 'position_short' ,
        'inspector_two_name', 'position_two', 'position_short_two', 'inspector_three_name', 'position_three', 'position_short_three',
        'date_add', 'added_by', 'updated_by', 'date_update', 'alphabet', 'id_location'];
}
