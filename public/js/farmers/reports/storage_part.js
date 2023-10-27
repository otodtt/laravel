/**
 * Created by dtenev on 23.10.2023 г..
 */
$(document).ready(function(){
    $("#unchecked").click(function(){
        $("INPUT[name=diary]").prop("checked", false);
        $("INPUT[name=primary]").prop("checked", false);
        $("INPUT[name=seeds]").prop("checked", false);
        $("INPUT[name=certificate]").prop("checked", false);
        $("INPUT[name=testing]").prop("checked", false);
        $("INPUT[name=contract]").prop("checked", false);
        $("INPUT[name=permit]").prop("checked", false);
        $("INPUT[name=disclosure]").prop("checked", false);
        $("INPUT[name=spraying]").prop("checked", false);

//                $("INPUT[name=expired]").prop("checked", false);
//                $("INPUT[name=compliance]").prop("checked", false);
//                $("INPUT[name=leaflet]").prop("checked", false);
//                $("INPUT[name=larger]").prop("checked", false);
//                $("INPUT[name=purpose]").prop("checked", false);
//                $("INPUT[name=storage]").prop("checked", false);
//                $("INPUT[name=warehouse]").prop("checked", false);
//
//                $("INPUT[name=separated]").prop("checked", false);
//                $("INPUT[name=access]").prop("checked", false);
//                $("INPUT[name=flooring]").prop("checked", false);
//                $("INPUT[name=combustible]").prop("checked", false);
//
//                $("INPUT[name=contract]").prop("checked", false);
    });
});
$(document).ready(function(){
    $("#check_all").click(function() {
        jQuery('input:radio[name="diary"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="primary"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="seeds"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="certificate"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="testing"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="contract"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="permit"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="disclosure"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="spraying"]').filter('[value="1"]').prop('checked', true);
//
//                jQuery('input:radio[name="expired"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="compliance"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="leaflet"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="larger"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="purpose"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="storage"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="warehouse"]').filter('[value="1"]').prop('checked', true);
//
//                jQuery('input:radio[name="separated"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="access"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="flooring"]').filter('[value="1"]').prop('checked', true);
//                jQuery('input:radio[name="combustible"]').filter('[value="1"]').prop('checked', true);
//
//                jQuery('input:radio[name="contract"]').filter('[value="1"]').prop('checked', true);
    });
});

$(document).ready(function(){
    $("#check_none").click(function() {
        jQuery('input:radio[name="diary"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="primary"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="seeds"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="certificate"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="testing"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="contract"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="permit"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="disclosure"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="spraying"]').filter('[value="3"]').prop('checked', true);

//                jQuery('input:radio[name="expired"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="compliance"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="leaflet"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="larger"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="purpose"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="storage"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="warehouse"]').filter('[value="3"]').prop('checked', true);
//
//                jQuery('input:radio[name="separated"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="access"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="flooring"]').filter('[value="3"]').prop('checked', true);
//                jQuery('input:radio[name="combustible"]').filter('[value="3"]').prop('checked', true);
//
//                jQuery('input:radio[name="contract"]').filter('[value="3"]').prop('checked', true);
    });

});