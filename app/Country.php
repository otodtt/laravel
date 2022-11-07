<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public $timestamps = false;

    protected $fillable = ['name', 'official_name', 'name_en', 'capital', 'EC', ];
}
