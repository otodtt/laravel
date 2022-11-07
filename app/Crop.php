<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $table = 'crops';

    public $timestamps = false;

    protected $fillable = ['name', 'group_id', 'name_en', 'latin', 'latin_name', 'cropDescription',
                            'date_create', 'date_update', 'created_by', 'updated_by'];
}
