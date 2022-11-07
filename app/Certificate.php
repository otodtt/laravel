<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'certificates';
    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'index_cert', 'number', 'date', 'name', 'document', 'series', 'number_diploma', 'date_diploma', 'sex', 'pin',
        'from_institute', 'specialty', 'to_date', 'limit_certificate', 'alphabet', 'date_add', 'date_update',
        'added_by', 'updated_by', 'user_pic', 'index_invoice', 'invoice', 'date_invoice', 'index_petition', 
        'petition', 'date_petition', 'address', 'phone', 'email', 'inspector_id', 'inspector_name', 'short_name'
    ];
}