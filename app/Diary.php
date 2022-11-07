<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'diaries';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['type_firm', 'name', 'date_diary', 'act', 'inspector', 'inspector_name', 'position_short',
                        'alphabet', 'pin'];
}
