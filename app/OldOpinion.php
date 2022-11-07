<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class OldOpinion extends Model
{
    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'old_opinions';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['index_opinion', 'number_opinion', 'date_opinion', 'egneik', 'pin', 'name', 'sex', 'alphabet',
                            'opinion', 'opinion_id', 'pieces', 'areas_id', 'district_id', 'tvm', 'city_id', 'location',
                            'address', 'district_object', 'district_name', 'inspector_id', 'inspector_name', 'position',
                            'position_short', 'number_protocol', 'date_protocol', 'double_protocol', 'date_add',
                            'date_update', 'added_by'];

    /**
     * Това Становище принадлежи на ЗП
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer(){
        return $this->belongsTo('odbh\Farmer');
    }
}
