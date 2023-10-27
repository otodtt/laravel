/**
 * Created by dtenev on 23.10.2023 г..
 */
$(document).ready(function(){
    $("#unchecked_pest").click(function(){
        $("INPUT[name=rotation]").prop("checked", false);
        $("INPUT[name=appropriate]").prop("checked", false);
        $("INPUT[name=standard]").prop("checked", false);
        $("INPUT[name=balanced]").prop("checked", false);
        
        $("INPUT[name=sanitary]").prop("checked", false);
        $("INPUT[name=cultivated]").prop("checked", false);
        $("INPUT[name=observations]").prop("checked", false);
        $("INPUT[name=depending]").prop("checked", false);
        $("INPUT[name=chemical]").prop("checked", false);

        $("INPUT[name=selective]").prop("checked", false);
        $("INPUT[name=limiting]").prop("checked", false);
        $("INPUT[name=mechanism]").prop("checked", false);
        $("INPUT[name=effectiveness]").prop("checked", false);
    });
});
$(document).ready(function(){
    $("#check_all_pest").click(function() {
        jQuery('input:radio[name="rotation"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="appropriate"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="standard"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="balanced"]').filter('[value="1"]').prop('checked', true);
        
        jQuery('input:radio[name="sanitary"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="cultivated"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="observations"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="depending"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="chemical"]').filter('[value="1"]').prop('checked', true);
        
        jQuery('input:radio[name="selective"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="limiting"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="mechanism"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="effectiveness"]').filter('[value="1"]').prop('checked', true);
    });
});

$(document).ready(function(){
    $("#check_none_pest").click(function() {
        jQuery('input:radio[name="rotation"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="appropriate"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="standard"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="balanced"]').filter('[value="3"]').prop('checked', true);
        
        jQuery('input:radio[name="sanitary"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="cultivated"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="observations"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="depending"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="chemical"]').filter('[value="3"]').prop('checked', true);

        jQuery('input:radio[name="selective"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="limiting"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="mechanism"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="effectiveness"]').filter('[value="3"]').prop('checked', true);
    });

});