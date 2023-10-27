/**
 * Created by dtenev on 23.10.2023 г..
 */
$(document).ready(function(){
    $("#unchecked").click(function(){
        $("INPUT[name=diary]").prop("checked", false);
        $("INPUT[name=primaryR]").prop("checked", false);
        $("INPUT[name=seeds]").prop("checked", false);
        $("INPUT[name=certificate]").prop("checked", false);
        $("INPUT[name=testing]").prop("checked", false);
        $("INPUT[name=contract]").prop("checked", false);
        $("INPUT[name=permit]").prop("checked", false);
        $("INPUT[name=disclosure]").prop("checked", false);
        $("INPUT[name=spraying]").prop("checked", false);
    });
});
$(document).ready(function(){
    $("#check_all").click(function() {
        jQuery('input:radio[name="diary"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="primaryR"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="seeds"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="certificate"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="testing"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="contract"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="permit"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="disclosure"]').filter('[value="1"]').prop('checked', true);
        jQuery('input:radio[name="spraying"]').filter('[value="1"]').prop('checked', true);
    });
});

$(document).ready(function(){
    $("#check_none").click(function() {
        jQuery('input:radio[name="diary"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="primaryR"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="seeds"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="certificate"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="testing"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="contract"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="permit"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="disclosure"]').filter('[value="3"]').prop('checked', true);
        jQuery('input:radio[name="spraying"]').filter('[value="3"]').prop('checked', true);
    });

});