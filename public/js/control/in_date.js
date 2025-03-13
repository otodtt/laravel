jQuery.datetimepicker.setLocale('bg');
var currentYear = (new Date).getFullYear();
var currentMonth = (new Date).getMonth() + 1;
var currentDay = (new Date).getDate();

jQuery('#protocol_date').datetimepicker({
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

jQuery('#date_opinion').datetimepicker({
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

jQuery('#date_protocol').datetimepicker({
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
    yearStart: 2000,
    yearEnd: currentYear,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
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

jQuery('#date_certificate').datetimepicker({

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
    yearStart: 2014,
    yearEnd: currentYear ,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
});

jQuery('#date_change').datetimepicker({
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

jQuery('#date_edition').datetimepicker({
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

jQuery('#start_year').datetimepicker({

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
    yearStart: 2014,
    yearEnd: currentYear ,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
});

jQuery('#end_year').datetimepicker({

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
    yearStart: 2014,
    yearEnd: currentYear ,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
});

jQuery('.date_certificate').datetimepicker({

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
    yearEnd: currentYear ,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
});

jQuery('#start_year_protocols').datetimepicker({

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
    yearEnd: currentYear ,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
});

jQuery('#end_year_protocols').datetimepicker({

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
    yearEnd: currentYear ,
    dayOfWeekStart:1,

    maxDate: Date(currentYear, currentMonth, currentDay)
});

jQuery('#date_diary').datetimepicker({
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