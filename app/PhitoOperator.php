<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class PhitoOperator extends Model
{
    public $timestamps = false;

    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'operators';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'number_petition', 'date_petition', 'update_number', 'update_date', 'entry', 'declaration', 'farmer_id', 'trader_id',
        'name_operator', 'address_operator', 'city', 'municipality', 'area', 'alphabet', 'description_objects', 'description_places',
        'production', 'processing', 'import', 'export', 'trade', 'storage', 'treatment', 'others', 'plants', 'europa', 'bulgaria',
        'own','origin_from', 'passports', 'marking', 'contact', 'contact_address', 'contact_city', 'contact_phone', 'place', 'date_place',
        'documents', 'documents_note', 'registration', 'registration_note', 'disposition', 'disposition_note', 'property',
        'property_note', 'plants_origin', 'plants_note', 'others_inspector', 'accepted', 'accepted_name', 'free_text', 'checked',
        'checked_name', 'date_operator', 'date_add', 'date_update', 'added_by', 'updated_by',
    ];
}
