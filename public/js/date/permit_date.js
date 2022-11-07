jQuery.datetimepicker.setLocale('bg');
var currentYear = (new Date).getFullYear();
var currentMonth = (new Date).getMonth() + 1;
var currentDay = (new Date).getDate();

jQuery('#date_permit').datetimepicker({
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
    yearStart: currentYear,
    yearEnd: 2030,
    dayOfWeekStart:1,
    minDate:'2014/01/01',
    maxDate:'+1970/01/03'
});

jQuery('#date_petition').datetimepicker({
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
    yearStart: currentYear,
    yearEnd: 2030,
    dayOfWeekStart:1,
    minDate:'2014/01/01',

    maxDate: Date(currentYear, currentMonth, currentDay)
});


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
    yearStart: currentYear,
    yearEnd: 2030,
    dayOfWeekStart:1,
    minDate:'+1970/01/03',
    maxDate:'2030/01/01'
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
    yearStart: currentYear,
    yearEnd: 2030,
    dayOfWeekStart:1,
    minDate:'+1970/01/06',
    maxDate:'2030/01/01'
});

jQuery('#date_invoice').datetimepicker({
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
    yearStart: 2000,
    yearEnd: currentYear,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
});