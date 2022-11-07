<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class QXCertificate extends Model
{
    public $timestamps = false;

    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'qxcertificates';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'export', 'is_all', 'what_7', 'type_crops', 'importer_id', 'importer_name', 'importer_address',
        'importer_vin', 'packer_id', 'packer_name', 'packer_address', 'stamp_number', 'authority_bg', 'authority_en',
        'for_country_bg', 'for_country_en', 'id_country', 'observations', 'transport', 'from_country', 'customs_bg', 'customs_en',
        'place_bg', 'place_en', 'date_issue', 'valid_until', 'inspector_bg', 'inspector_en', 'invoice_id',  'invoice_number',
        'invoice_date', 'sum', 'date_update', 'updated_by', 'date_add', 'added_by', 'is_lock'
    ];

    /**
     * Сертификата има много стоки към него
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function export_stocks(){
        return $this->hasMany('odbh\StockExport', 'certificate_id');
    }

    /**
     * Сертификата има фактура към него
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function export_invoice(){
        return $this->hasMany('odbh\Invoice', 'certificate_id')->where('invoice_for', 2);
    }
}
