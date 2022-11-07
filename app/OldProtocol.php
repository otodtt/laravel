<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class OldProtocol extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'old_farmers_protocols';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['areas_id', 'district_id', 'city_id', 'tvm', 'location', 'address'];
}
