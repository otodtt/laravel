<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'opinions';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['index_opinion', 'number_opinion', 'date_opinion', 'index_petition', 'number_petition', 'date_petition',
                            'invoice', 'invoice_date', 'type_opinion', 'opinion_name', 'opinion_name_short','type_firm', 'name',
                            'sex', 'pin', 'eik', 'egn_eik', 'owner', 'areas_id', 'district_id', 'tvm', 'city_id', 'location', 'address',
                            'district_object', 'object_name', 'number_protocol', 'date_protocol', 'user_protocol', 'inspector_id',
                            'alphabet', 'date_add', 'date_update', 'added_by', 'updated_by', 'period', 'yes', 'type_check',
                            'inspector_name','position', 'position_short', 'assay_no'];


    /**
     * Това Становище принадлежи на ЗП
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer(){
        return $this->belongsTo('odbh\Farmer');
    }
}
