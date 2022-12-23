<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Useful extends Model
{
    public $timestamps = false;

    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['document_type', 'document_name', 'document_path', 'document_for', 'document_short',
                           'filename', 'is_active',  'created_by', 'updated_by', 'date_create', 'date_update'];

}
