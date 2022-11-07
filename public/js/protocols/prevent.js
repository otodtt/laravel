$('#submit-prz').click(function() {
    $(this).attr('disabled','disabled');
    $('#submit-tor').attr('disabled','disabled');
});

$('#submit-tor').click(function() {
    $(this).attr('disabled','disabled');
    $('#submit-prz').attr('disabled','disabled');
});