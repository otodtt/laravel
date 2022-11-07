<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factory extends Model
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
    protected $table = 'factories';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['type_firm', 'name', 'postal_code', 'areas_id', 'district_id', 'type_location', 'location', 'alphabet',
        'address', 'sex', 'owner', 'egn', 'bulstat', 'phone', 'mobil', 'email',
        'date_create', 'date_update', 'created_by', 'updated_by', 'updated_for'];


    /**
     * Фирмата има много костативни протоколи
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function protocols(){
        return $this->hasMany('odbh\FactoryProtocol', 'firm_id')->orderBy('date_protocol','asc');
    }
}
