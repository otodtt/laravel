<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'qarticles';

    public $timestamps = false;

    protected $fillable = ['compliance_id', 'product_id', 'product', 'country', 'class', 'quantity',
                            'date_update', 'updated_by', 'date_add', 'added_by'];
}
