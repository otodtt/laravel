<?php

namespace odbh\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use odbh\Area;
use odbh\Location;
use odbh\Set;
use odbh\User;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //////////////
    protected $areas_all = null;

    protected $areas_all_list = null;

    protected $districts_list = null;

    protected $district_full = null;

    protected $area_get_id = null;

    ///// За Инспекторите
    protected $inspectors_all_rz_list = null;

    protected $inspectors_active_rz_list = null;

    public function __construct()
    {
        /** Взема номера на областта от БД */
        $get_area_id = $this->area_get_id = Set::select('area_id')->get()->toArray();

        /** Генерира списък с общините */
        $this->districts_list = Location::select('name', 'district_id')
            ->where('areas_id', '=', $get_area_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->lists('name', 'district_id');

        /** Всички наслени места в общината */
        $this->district_full = Location::select()
            ->where('areas_id', '=', $get_area_id)
            ->where('type_district', '=', 1)
            ->orderBy('district_id', 'asc')
            ->get();

        /** Генерира всички области */
        $this->areas_all = Area::select('areas_name', 'id')->get('areas_name', 'id');

        /** Генерира списък с области */
        $this->areas_all_list =Area::lists('areas_name', 'id');


        //////////// ИНСПЕКТОРИ
        /** Генерира списък с всички инспектори от КОНТРОЛ*/
        $this->inspectors_all_rz_list = User::select('id', 'short_name')
                                        ->where('rz','=',1)
                                        ->lists('short_name', 'id');

        /** Генерира списък с активните инспектори от КОНТРОЛ*/
        $this->inspectors_active_rz_list = User::select('id', 'short_name')
                                        ->where('active', '=', 1)
                                        ->where('rz','=',1)
                                        ->lists('short_name', 'id');


        //////////// ИНСПЕКТОРИ
        /** Генерира списък с всички инспектори от FITO*/
        $this->inspectors_all_fsk_list = User::select('id', 'short_name')
                                        ->where('fsk','=',1)
                                        ->lists('short_name', 'id');

        /** Генерира списък с активните инспектори от FITO*/
        $this->inspectors_active_fsk_list = User::select('id', 'short_name')
                                        ->where('active', '=', 1)
                                        ->where('fsk','=',1)
                                        ->lists('short_name', 'id');
    }
}
