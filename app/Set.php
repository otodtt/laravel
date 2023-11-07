<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['area', 'area_id', 'address', 'city', 'postal_code', 'odbh_city', 'mail', 'phone', 'fax',
                           'index_in', 'in_second', 'index_out', 'out_second', 'lock_permit', 'site',
                            'q_index', 'authority_bg', 'authority_en', 'operator_index_not', 'operator_index_bg' ];

}
