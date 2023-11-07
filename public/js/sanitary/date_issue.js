jQuery.datetimepicker.setLocale('bg');
var currentYear = (new Date).getFullYear();
var currentMonth = (new Date).getMonth() + 3;
var currentDay = (new Date).getDate();

jQuery('#date_issue').datetimepicker({
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
    minDate:'+1970/01/01',
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

jQuery('#date_edit').datetimepicker({
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
    // minDate:'+1970/01/01',
    // maxDate:'2030/01/01'
});
