<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class StockExport extends Model
{
    public $timestamps = false;

    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'stocks_export';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'certificate_id', 'certificate_number', 'firm_id', 'firm_name', 'export', 'type_crops',
        'type_pack', 'number_packages', 'different', 'crop_id', 'crops_name', 'crop_en', 'variety', 'quality_class',
        'weight', 'date_issue', 'inspector_name', 'date_update', 'updated_by', 'date_add', 'added_by'
    ];
}
