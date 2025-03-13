<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Pharmacy
 * @package odbh
 */
class Pharmacy extends Model
{
    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'pharmacies';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'index_licence', 'number_licence', 'date_licence', 'raz_udost', 'index_petition', 'number_petition',
        'date_petition', 'type_firm', 'name', 'district_object', 'tvm_id', 'type_location', 'location', 'alphabet',
        'address', 'end_date', 'seller', 'certificate', 'index_certificate', 'date_certificate', 'list_name', 'list_change',
        'inspector', 'inspector_name', 'added_by_user', 'date_added', 'updated_by_user', 'date_update', 'edition',
        'date_edition', 'date_change', 'number_change', 'user_change', 'id_user_change', 'locks', 'active'
    ];
    /**
     * Тази аптека принадлежи на фирма
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firm(){
        return $this->belongsTo('odbh\Firm');
    }

    /**
     * Аптеката има много костативни протоколи
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function protocols(){
        return $this->hasMany('odbh\Protocol', 'id_from_object');
    }
    /**
     * Аптеката има много костативни протоколи
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports(){
        return $this->hasMany('odbh\ReportPharmacy', 'id_from_object');
    }
}
