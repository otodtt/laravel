<?php

namespace odbh;

use Illuminate\Database\Eloquent\Model;

class FarmerReport extends Model
{
    /**
     * Таблицата която се използва от модела
     * @var string
     */
    protected $table = 'farmers_reports';

    /**
     * Защитени колони в таблицата
     * @var array
     */
    protected $fillable = [
        'number_report', 'starting_time', 'final_hour', 'date_report',
        'check_id', 'where_check', 'dimensions', 'crops', 'place', 'check_type',
        'first', 'second', 'third', 'fourth', 'fifth', 'sixth',

        'opinion_id', 'opinions', 'description',

        'firm', 'name', 'sex', 'pin', 'bulstat', 'egn_eik', 'owner', 'areas_id', 'district_id', 'city_id',
        'tvm', 'location', 'address', 'district_object', 'location_farm',

        'inspector', 'inspector_two', 'inspector_three', 'inspector_another', 'inspector_from',
        'inspector_name', 'position', 'position_short', 'inspector_two_name', 'position_two',
        'position_short_two', 'inspector_three_name', 'position_three', 'position_short_three',

        'alphabet', 'date_add', 'added_by', 'date_update', 'updated_by', 'is_all',


        'diary', 'diary_note', 'primaryR', 'primary_note', 'seeds', 'seeds_note', 'certificate', 'certificate_note',
        'testing', 'testing_note', 'contract', 'contract_note', 'permit', 'permit_note', 'disclosure', 'disclosure_note',
        'spraying', 'spraying_note',

        'original', 'original_note', 'unauthorized', 'unauthorized_note', 'expiry', 'expiry_note', 'allocation', 'allocation_note',
        'metal', 'metal_note', 'empty', 'empty_note',

        'permission', 'permission_note', 'relevant', 'relevant_note', 'concentration', 'concentration_note',
        'phenophase', 'phenophase_note', 'distances', 'distances_note', 'buildings', 'buildings_note',
        'watersheds', 'watersheds_note', 'irrigation', 'irrigation_note', 'protected', 'protected_note',
        'cleaning', 'cleaning_note', 'evidence', 'evidence_note',
//
//        'layout', 'layout_note', 'inhabited', 'inhabited_note', 'logbook', 'logbook_note', 'publication', 'publication_note',
//        'training', 'training_note', 'protocol', 'protocol_note', 'sign', 'sign_note', 'agronomist', 'agronomist_note',
//        'documents', 'documents_note', 'equipment', 'equipment_note', 'residential', 'residential_note',
//        'specialized', 'specialized_note', 'technique', 'technique_note', 'protective', 'protective_note',
//        'controls', 'controls_note', 'access', 'access_note',







//        'assay_more', 'assay_prz', 'assay_tor', 'assay_metal', 'assay_micro', 'assay_other',
//        'assay_more_name', 'assay_prz_name', 'assay_tor_name', 'assay_metal_name', 'assay_micro_name', 'assay_other_name',


    ];
}
