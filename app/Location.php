<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'locations';
    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'ekatte', 'tvm', 't_v_m', 'name', 'area', 'areas_id', 'district_id', '	type_district', 'add_new', 'postal_code'
    ];
}
