<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    /**
     * Защитена таблица
     *
     * @var string
     */
    protected $table = 'farmers';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = ['type_firm', 'name', 'sex', 'pin', 'bulstat', 'areas_id', 'district_id', 'tvm', 'city_id',
                            'location', 'address', 'owner', 'pin_owner', 'sex_owner', 'district_object', 'location_farm',
                            'alphabet', 'date_add', 'added_by', 'date_update', 'updated_by', 'phone', 'mobil', 'email'];


    /**
     * ЗП има много стари Становища
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function old_opinions(){
        return $this->hasMany('odbh\OldOpinion')->orderBy('date_opinion', 'asc');
    }

    /**
     * ЗП има много стари Становища
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opinions(){
        return $this->hasMany('odbh\Opinion');
    }

    /**
     * ЗП има много въздушни Разрешителни
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permits(){
        return $this->hasMany('odbh\Air');
    }

    /**
     * ЗП има много костативни протоколи
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function protocols(){
        return $this->hasMany('odbh\FarmerProtocol')->orderBy('date_protocol','asc');
    }

    /**
     * ЗП има много костативни протоколи
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function old_protocols(){
        return $this->hasMany('odbh\OldProtocol')->orderBy('date_protocol','asc');
    }

    /**
     * ЗП има много Дневници
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diaries(){
        return $this->hasMany('odbh\Diary');
    }

    /**
     * ЗП има много QINCertificate
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qincertificates(){
        return $this->hasMany('odbh\QINCertificate');
    }

    /**
     * ЗП има много QProtocols
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qprotocols(){
        return $this->hasMany('odbh\QProtocol');
    }

    /**
     * ЗП има много QCompliance
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function compliance(){
        return $this->hasMany('odbh\QCompliance');
    }

    /**
     * ЗП има много костативни DOKLADI
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports(){
        return $this->hasMany('odbh\FarmerReport')->orderBy('date_report','asc');
    }
}
