jQuery.datetimepicker.setLocale('bg');

jQuery('#start_date').datetimepicker({
    i18n:{
        bg:{
        months:[
            'Януари','Февруари','Март','Април',
            'Май','Юни','Юли','Август',
            'Септември','Октомври','Ноември','Декември'
        ],
        dayOfWeek:[
            "По.", "Вт", "Ср", "Чт", 
            "Пе", "Съ", "Не."
        ]
    }
},
    scrollInput: false,

    timepicker:false,
    format:'d.m.Y',
    lang:'bg',
    yearStart: 2007,
    yearEnd: 2020,
    dayOfWeekStart:1
});

jQuery('#end_date').datetimepicker({
    i18n:{
        bg:{
        months:[
            'Януари','Февруари','Март','Април',
            'Май','Юни','Юли','Август',
            'Септември','Октомври','Ноември','Декември'
        ],
        dayOfWeek:[
            "По.", "Вт", "Ср", "Чт", 
            "Пе", "Съ", "Не."
        ]
    }
},

    scrollInput: false,

    timepicker:false,
    format:'d.m.Y',
    lang:'bg',
    yearStart: 2007,
    yearEnd: 2020,
    dayOfWeekStart:1
});

