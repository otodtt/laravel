<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Firm extends Model
{
    /**
     * Използваме Soft Deletes
     */
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'firms';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['type_firm', 'name', 'postal_code', 'areas_id', 'district_id', 'type_location', 'location', 'alphabet',
                        'address', 'sex', 'owner', 'egn', 'bulstat', 'phone', 'mobil', 'email',
                        'date_create', 'date_update', 'created_by', 'updated_by', 'updated_for'];


    /**
     * Фирмата има много аптеки
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pharmacies(){
        return $this->hasMany('odbh\Pharmacy');
    }

    /**
         * Фирмата има много складове
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
    public function repositories(){
            return $this->hasMany('odbh\Repository');
    }

    /**
     * Фирмата има много цехове
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workshops(){
        return $this->hasMany('odbh\Workshop');
    }

    /**
     * Фирмата има много костативни протоколи
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function protocols(){
        return $this->hasMany('odbh\Protocol', 'id_from_firm')->orderBy('date_protocol','asc');
    }

    public function reports(){
        return $this->hasMany('odbh\Report', 'id_from_firm')->orderBy('date_protocol','asc');
    }
}
