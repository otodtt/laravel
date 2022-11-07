<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Packer extends Model
{
    public $timestamps = false;

    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'packers';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['packer_name', 'packer_address', 'created_by', 'updated_by', 'date_create', 'date_update'];
}
