/**
 * Created by dtenev on 23.10.2023 г..
 */
$(document).ready(function(){
    $("#unchecked_storage").click(function(){
        $("INPUT[name=original]").prop("checked", false);
        $("INPUT[name=unauthorized]").prop("checked", false);
        $("INPUT[name=expiry]").prop("checked", false);
        $("INPUT[name=allocation]").prop("checked", false);
        $("INPUT[name=metal]").prop("checked", false);
        $("INPUT[name=empty]").prop("checked", false);
    });
});
$(document).ready(function(){
    $("#check_all_storage").click(function() {
        jQuery('input:radio[name="original"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="unauthorized"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="expiry"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="allocation"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="metal"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="empty"]').filter('[value="1"]').prop('checked', true);
    });
});

$(document).ready(function(){
    $("#check_none_storage").click(function() {
        jQuery('input:radio[name="original"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="unauthorized"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="expiry"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="allocation"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="metal"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="empty"]').filter('[value="3"]').prop('checked', true);

    });

});