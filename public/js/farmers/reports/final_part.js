/**
 * Created by dtenev on 23.10.2023 г..
 */
$(document).ready(function(){
    $("#unchecked_air").click(function(){
        $("INPUT[name=layout]").prop("checked", false);
        $("INPUT[name=inhabited]").prop("checked", false);
        $("INPUT[name=logbook]").prop("checked", false);
        $("INPUT[name=publication]").prop("checked", false);
        
        $("INPUT[name=training]").prop("checked", false);
        $("INPUT[name=protocol]").prop("checked", false);
        $("INPUT[name=sign]").prop("checked", false);
        $("INPUT[name=agronomist]").prop("checked", false);
        $("INPUT[name=documents]").prop("checked", false);

        $("INPUT[name=equipment]").prop("checked", false);
        $("INPUT[name=residential]").prop("checked", false);
        $("INPUT[name=specialized]").prop("checked", false);
        $("INPUT[name=technique]").prop("checked", false);
        $("INPUT[name=protective]").prop("checked", false);
        $("INPUT[name=controls]").prop("checked", false);
        $("INPUT[name=access]").prop("checked", false);
    });
});
$(document).ready(function(){
    $("#check_all_air").click(function() {
        jQuery('input:radio[name="layout"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="inhabited"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="logbook"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="publication"]').filter('[value="1"]').prop('checked', true);
        
        jQuery('input:radio[name="training"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="protocol"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="sign"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="agronomist"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="documents"]').filter('[value="1"]').prop('checked', true);
        
        jQuery('input:radio[name="equipment"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="residential"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="specialized"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="technique"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="protective"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="controls"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="access"]').filter('[value="1"]').prop('checked', true);
    });
});

$(document).ready(function(){
    $("#check_none_air").click(function() {
        jQuery('input:radio[name="layout"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="inhabited"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="logbook"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="publication"]').filter('[value="3"]').prop('checked', true);
        
        jQuery('input:radio[name="training"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="protocol"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="sign"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="agronomist"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="documents"]').filter('[value="3"]').prop('checked', true);

        jQuery('input:radio[name="equipment"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="residential"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="specialized"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="technique"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="protective"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="controls"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="access"]').filter('[value="3"]').prop('checked', true);
    });

});