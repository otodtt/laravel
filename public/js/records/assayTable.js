$(document).ready(function() {
    $('#example').DataTable( {
        "columns": [
            null,
            null,
            { "type": "de_date" },
            null,
            null,
            null,
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false }
        ],
        "pagingType": "full_numbers",
        searching: true,

        "lengthMenu": [[-1, 100, 300, 500], ["Всички", 100, 300, 500]],
        "language": {
            "sProcessing":   "Обработка на резултатите...",
            "sLengthMenu":   "Колко резултата да се покажат?  _MENU_ ",
            "sZeroRecords":  "Няма намерени резултати",
            "sInfo":         "Показване на резултати от _START_ до _END_ от общо _TOTAL_",
            "sInfoEmpty":    "Показване на резултати от 0 до 0 от общо 0",
            "sInfoFiltered": "(филтрирани от общо _MAX_ резултата)",
            "sInfoPostFix":  "",
            "sSearch":       "Търсене във всички колони:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    " < ",
                "sPrevious": " <<< ",
                "sNext":     " >>> ",
                "sLast":     " > "
            }
        },
        "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
    } );
    var table = $('#example').DataTable();

    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
} );
