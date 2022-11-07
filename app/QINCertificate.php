<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class QINCertificate extends Model
{
    public $timestamps = false;

    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'qincertificates';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'internal', 'is_all', 'what_7', 'type_crops', 'importer_id', 'importer_name', 'importer_address',
        'importer_vin', 'packer_name', 'packer_address', 'packer_vin', 'stamp_number', 'authority_bg', 'authority_en',
        'for_country_bg', 'for_country_en', 'id_country', 'observations', 'from_country', 'customs_bg', 'place_bg',
        'date_issue', 'valid_until', 'inspector_bg', 'inspector_en', 'invoice_id',  'invoice_number',
        'invoice_date', 'sum', 'date_update', 'updated_by', 'date_add', 'added_by', 'is_lock'
    ];

    /**
     * Сертификата има много стоки към него
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function internal_stocks(){
        return $this->hasMany('odbh\StockInternal', 'certificate_id');
    }

    /**
     * Сертификата има фактура към него
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function internal_invoice(){
        return $this->hasMany('odbh\Invoice', 'certificate_id')->where('invoice_for', 2);
    }
}
