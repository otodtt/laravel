$(document).ready(function()
{
    $('table thead th').each(function(i)
    {
        calculateColumn(i);
    });

    $('#data thead th').each(function(i)
    {
        calculateColumnOpinion(i);
    });
});

function calculateColumn(index)
{
    var total = 0;
    $('table tr ').each(function()
    {
        var value = parseInt($('.rowDataOp', this).eq(index).text());
        if (!isNaN(value))
        {
            total += value;
        }
    });

    $('table tfoot .foot_op').eq(index).text(total);
}



function calculateColumnOpinion(index)
{
    var total = 0;
    $('#data tr ').each(function()
    {
        var value = parseInt($('.rowDataSd', this).eq(index).text());
        if (!isNaN(value))
        {
            total += value;
        }
    });

    $('#data tfoot .foot').eq(index).text(total);
}
