<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $timestamps = false;

    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [ 'number_invoice', 'date_invoice', 'sum', 'certificate_id',  'certificate_number', 'importer_id',
                            'farmer_id', 'trader_id', 'importer_name', 'identifier', 'invoice_for', 'date_create',
                            'date_update', 'created_by', 'updated_at'];

    /**
     * Търговеца има много сертификати
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificate(){
        return $this->hasMany('odbh\Stock', 'certificate_id');
    }

    /**
     * Търговеца има много фактура към него
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoice(){
        return $this->hasMany('odbh\Invoice', 'certificate_id');
    }
}
