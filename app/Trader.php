<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    public $timestamps = false;

    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'traders';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['trader_name', 'trader_address', 'trader_vin', 'created_by', 'updated_by', 'date_create', 'date_update'];

    public function qincertificate(){
        return $this->hasMany('odbh\QINCertificate', 'trader_id');
    }

    /**
     * Търговеца има много QProtocols
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qprotocols(){
        return $this->hasMany('odbh\QProtocol');
    }

    /**
     * Търговеца има много QCompliance
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function compliance(){
        return $this->hasMany('odbh\QCompliance');
    }
}
