$(function(){
    $("#example tr").hover(
        function(){
            $(this).toggleClass("highlight");
        },
        function(){
            $(this).toggleClass("highlight");
        }
    );
});


