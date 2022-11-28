$(document).ready(function() {
    $('#example').DataTable( {
        "columns": [
            null,
            null,
            { "orderable": false },
            { "orderable": false },
            null,
            { "orderable": false },
            { "orderable": false },
        ],
        "pagingType": "full_numbers",
        searching: true,

        "lengthMenu": [[-1, 10, 20, 30], ["Всички", 10, 20, 30]],
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
});

$(document).ready(function() {
    $('#example_firm').DataTable( {
        //footerCallback: function (row, data, start, end, display) {
        //    var api = this.api();
        //
        //    // Remove the formatting to get integer data for summation
        //    var intVal = function (i) {
        //        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        //    };
        //
        //    // Total over all pages
        //    total = api
        //        .column(3)
        //        .data()
        //        .reduce(function (a, b) {
        //            return intVal(a) + intVal(b);
        //        }, 0);
        //    $(api.column(3).footer()).html(total + ' лв.');
        //
        //    //console.log(api.columns(3).data());
        //},
        "columns": [
            null,
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
        ],
        "pagingType": "full_numbers",
        searching: true,

        "lengthMenu": [[-1, 10, 20, 30], ["Всички", 10, 20, 30]],
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

    $('#example_firm tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
} );

$(document).ready(function() {
    $('#example_export').DataTable( {
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over all pages
            total = api
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            $(api.column(3).footer()).html(total + ' лв.');

            //console.log(api.columns(3).data());
        },
        "columns": [
            null,
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false },
        ],
        "pagingType": "full_numbers",
        searching: true,

        "lengthMenu": [[-1, 10, 20, 30], ["Всички", 10, 20, 30]],
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
    var table = $('#example_export').DataTable();

    $('#example_export tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
} );


