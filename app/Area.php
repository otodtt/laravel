<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'areas';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [];
}
