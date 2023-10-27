/**
 * Created by dtenev on 23.10.2023 г..
 */
$(document).ready(function(){
    $("#unchecked_app").click(function(){
        $("INPUT[name=permission]").prop("checked", false);
        $("INPUT[name=relevant]").prop("checked", false);
        $("INPUT[name=concentration]").prop("checked", false);
        $("INPUT[name=phenophase]").prop("checked", false);
        $("INPUT[name=distances]").prop("checked", false);
        $("INPUT[name=buildings]").prop("checked", false);
        $("INPUT[name=watersheds]").prop("checked", false);
        $("INPUT[name=irrigation]").prop("checked", false);
        $("INPUT[name=protected]").prop("checked", false);
        $("INPUT[name=cleaning]").prop("checked", false);
        $("INPUT[name=evidence]").prop("checked", false);
    });
});
$(document).ready(function(){
    $("#check_all_app").click(function() {
        jQuery('input:radio[name="permission"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="relevant"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="concentration"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="phenophase"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="distances"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="buildings"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="watersheds"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="irrigation"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="protected"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="cleaning"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="evidence"]').filter('[value="1"]').prop('checked', true);
    });
});

$(document).ready(function(){
    $("#check_none_app").click(function() {
        jQuery('input:radio[name="permission"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="relevant"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="concentration"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="phenophase"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="distances"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="buildings"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="watersheds"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="irrigation"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="protected"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="cleaning"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="evidence"]').filter('[value="3"]').prop('checked', true);
    });

});