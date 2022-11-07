<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Verifications extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'verifications';
    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['full_name', 'short_name', 'type_check', 'show_check'];
}
