<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Air extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'air';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['farmer_id', 'number_permit', 'date_permit', 'index_petition', 'number_petition', 'date_petition', 'invoice',
                            'date_invoice', 'type_firm', 'name', 'urn', 'owner', 'sex', 'pin_owner', 'areas_id', 'district_id',
                            'type_location', 'location_id', 'location', 'address', 'phone', 'email', 'ground', 'cultivation',
                            'pest', 'start_date', 'end_date', 'prz', 'dose', 'quarantine', 'agronomist', 'certificate', 'inspector',
                            'inspector_name', 'position', 'position_short', 'alphabet', 'date_add', 'date_update', 'added_by',
                            'updated_by', 'acres'];

    /**
     * Това Разрешително принадлежи на ЗПроизводител
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer(){
        return $this->belongsTo('odbh\Farmer');
    }
}
