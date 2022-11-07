<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'accepted' => 'Трябва да приемете :attribute.',
    'active_url' => 'Полето :attribute не е валиден URL адрес.',
    'after' => 'Полето :attribute трябва да бъде дата след :date.',
    'alpha' => 'Полето :attribute трябва да съдържа само букви.',
    'alpha_dash' => 'Полето :attribute трябва да съдържа само букви, цифри, долна черта и тире.',
    'alpha_num' => 'Полето :attribute трябва да съдържа само букви и цифри.',
    'array' => 'Полето :attribute трябва да бъде масив.',
    'before' => 'Полето :attribute трябва да бъде дата преди :date.',
    'between' => [
        'numeric' => 'Полето :attribute трябва да бъде между :min и :max.',
        'file' => 'Полето :attribute трябва да бъде между :min и :max килобайта.',
        'string' => 'Полето :attribute трябва да бъде между :min и :max знака.',
        'array' => 'Полето :attribute трябва да има между :min - :max елемента.',
    ],
    'boolean' => 'Полето :attribute трябва да съдържа Да или Не',
    'confirmed' => 'Полето :attribute не е потвърдено.',
    'date' => 'Полето :attribute не е валидна дата.',
    'date_format' => 'Полето :attribute не е във формат :format.',
    'different' => 'Полетата :attribute и :other трябва да са различни.',
    'digits' => 'Полето :attribute трябва да има :digits цифри.',
    'digits_between' => 'Полето :attribute трябва да има между :min и :max цифри.',
    'email' => 'Полето :attribute е в невалиден формат.',
    'exists' => 'Избранато поле :attribute вече съществува.',
    'filled' => 'Полето :attribute е задължително.',
    'image' => 'Полето :attribute трябва да бъде изображение.',
    'in' => 'Избраното поле :attribute е невалидно.',
    'integer' => 'Полето :attribute трябва да бъде цяло число.',
    'ip' => 'Полето :attribute трябва да бъде IP адрес.',
    'json' => 'Полето :attribute трябва да бъде JSON низ.',
    'max' => [
        'numeric' => 'Полето :attribute трябва да бъде по-малко от :max.',
        'file' => 'Полето :attribute трябва да бъде по-малко от :max килобайта.',
        'string' => 'Полето :attribute трябва да бъде по-малко от :max знака.',
        'array' => 'Полето :attribute трябва да има по-малко от :max елемента.',
    ],
    'mimes' => 'Полето :attribute трябва да бъде файл от тип: :values.',
    'min' => [
        'numeric' => 'Полето :attribute трябва да бъде минимум :min.',
        'file' => 'Полето :attribute трябва да бъде минимум :min килобайта.',
        'string' => 'Полето :attribute трябва да бъде минимум :min знака.',
        'array' => 'Полето :attribute трябва има минимум :min елемента.',
    ],
    'not_in' => 'Избраното поле :attribute е невалидно.',
    'numeric' => 'Полето :attribute трябва да бъде число.',
    'regex' => 'Полето :attribute е в невалиден формат.',
    'required' => 'Полето :attribute е задължително.',
    'required_if' => 'Полето :attribute се изисква, когато :other е :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :value.',
    'required_with' => 'Полето :attribute се изисква, когато :values има стойност.',
    'required_with_all' => 'Полето :attribute е задължително, когато :values имат стойност.',
    'required_without' => 'Полето :attribute се изисква, когато :values няма стойност.',
    'required_without_all' => 'Полето :attribute се изисква, когато никое от полетата :values няма стойност.',
    'same' => 'Полетата :attribute и :other трябва да съвпадат.',
    'size' => [
        'numeric' => 'Полето :attribute трябва да бъде :size.',
        'file' => 'Полето :attribute трябва да бъде :size килобайта.',
        'string' => 'Полето :attribute трябва да бъде :size знака.',
        'array' => 'Полето :attribute трябва да има :size елемента.',
    ],
    'string' => 'Полето :attribute трябва да бъде знаков низ.',
    'timezone' => 'Полето :attribute трябва да съдържа валидна часова зона.',
    'unique' => 'Полето :attribute вече съществува.',
    'url' => 'Полето :attribute е в невалиден формат.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'all_name' => [
            'cyrillic' => 'Пиши на кирилица!',
        ],
        'short_name' => [
            'cyrillic_with' => 'Пиши на кирилица!',
        ],
        'name' => [
            'latin' => 'Пиши на латиница! Позволени символи -, _ и . ',
        ],

        'search' => [
            'not_in' => 'Избери критерий за търсене!',
        ],
        'search_value' => [
            'required' => 'Попълни полето!',
            'min' => 'Минимален брой символи - :min!',
            'max' => 'Максимален брой символи - :max!',
            'only_cyrillic' => 'Пиши на кирилица!',
            'digits_between' => 'Полето трябва да има само цифри! При търсене по ЕГН трябва да са 10',
        ],

        'search_protocols' => [
            'required' => 'Попълни полето!',
            'digits_between' => 'Полето трябва да има само цифри, до 6 символа!',
        ],

        'start_year' => [
            'date_format' => 'Непозволен формат на дата!',
        ],
        'end_year' => [
            'date_format' => 'Непозволен формат на дата!',
        ],


        'degree' => [
            'cyrillic' => 'Пиши на кирилица!',
        ],
        'type_dir' => [
            'cyrillic' => 'Пиши на кирилица!',
        ],
        'surname' => [
            'cyrillic' => 'Пиши на кирилица!',
        ],
        'family' => [
            'cyrillic' => 'Пиши на кирилица!',
        ],

        'blade' => [
            'required' => 'Избери файл!',
            'max' => 'Твърде голям файл!',
            'doc_blade' => 'Виж дали правилно е избран файла!',
            'doc_blade_length' => 'Не променяй името на файла!',

            'edition_blade' => 'Виж дали правилно е избран файла!',
            'edition_blade_length' => 'Не променяй името на файла!',

            'certificate_blade' => 'Виж дали правилно е избран файла!',
            'certificate_blade_length' => 'Не променяй името на файла!',

            'opinion_blade' => 'Виж дали правилно е избран файла!',
            'opinion_blade_length' => 'Не променяй името на файла!',

            'logo_blade' => 'Виж дали правилно е избран файла!',
            'logo_blade_length' => 'Не променяй името на файла!',
        ],

        'number' => [
            'not_in' => 'Не може да има два Констативни Протокола с един същ номер на една дата! Провери номера или смени датата на протокола!!',
        ],

        'prz_name' => [
            'required' => 'Името на Продукта е задължително!',
        ],
        'prz_av' => [
            'required' => 'Попълни Активното Вещество на Продукта!',
        ],

        'tor_name' => [
            'required' => 'Името на Тора е задължително!',
        ],
        'tor_av' => [
            'required' => 'Попълни Съдържанието на тора!',
        ],
        'eo_tor' => [
            'required' => 'Маркирай дали има маркировка ЕО ТОР!',
        ],

        //////  ЗА ТЪРСЕНЕ НА ЗЕМЕДЕЛСКИ СТОПАНИ
        'firm_search' => [
            'required' => 'Маркирай вида на фирмата или ЧЗС!',
        ],

        'name_farmer' => [
            'required' => 'Попълни името на Земеделския стопанин!',
            'min' => 'Минимален брой символи за името - 3!',
            'max' => 'Максимален брой символи за името - 50!',
            'only_cyrillic' => 'За име използвай само на кирилица!',
        ],

        'gender_farmer' => [
            'required' => 'Маркирай дали е мъж или жена!',
        ],

        'pin_farmer' => [
            'required' => 'Попълни ЕГН!',
            'digits_between' => 'ЕГН-то е само цифри с 10 знака!',
            'pin_farmer' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
        ],

        'firm_name_search' => [
            'required' => 'Попълни името на Фирмата!',
            'min' => 'Минимален брой символи за името - 3!',
            'max' => 'Максимален брой символи за името - 50!',
            'cyrillic_names' => 'За име на фирмата пиши само на кирилица без символи! Позволени символи: (тире - ) и цифри!',
        ],

        'eik_search' => [
            'required' => ' Попълни ЕИК/Булстат!',
            'is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',
        ],
        //////  ЗА ТЪРСЕНЕ НА ЗЕМЕДЕЛСКИ СТОПАНИ

        ///// ДОБАВЯНЕ НА НОМЕР И ДАТА НА СТАНОВИЩЕ
        'number_opinion' => [
            'required' => ' Попълни Изходящия номер!',
            'digits_between' => 'За Изходящ номер се използват само цифри!',
            'not_in' => 'Изходящия номер не може да е нула - 0!',
        ],
        'date_opinion' => [
            'required' => ' Попълни Дата на Изходящия номер!',
            'date_format' => 'Непозволен формат за дата на Изходящ номер!',
            'after' => 'Датата на Изходящия номер на Становището трябва да бъде след датата на Заявление! :date',
        ],
        ///// ДОБАВЯНЕ НА КОНСТАТИВЕН ПРОТОКОЛ НА СТАНОВИЩЕ
        'number_protocol' => [
            'required' => ' Попълни номера на Протокола!',
            'digits_between' => 'За номера на Протокола се използват само цифри!',
            'not_in' => 'Номера на Протокола не може да е нула - 0!',
        ],
        'date_protocol' => [
            'required' => ' Попълни Дата на Протокола!',
            'date_format' => 'Непозволен формат за дата на Протокол!',
        ],
        'inspectors_protocol' => [
            'required' => 'Избери инспектора написал Протокола!',
            'not_in' => 'Избери инспектора написал Протокола!',
        ],
        'type_check' => [
            'required' => 'Избери вида на проверката!',
        ],

        ///// ДОБАВЯНЕ НА ЗАВЕРКА НА ДНЕВНИК
        'date_diary' => [
            'required' => ' Попълни Дата на Заврка!',
            'date_format' => 'Непозволен формат за дата на Заврка!',
        ],
        'inspector' => [
            'required' => 'Избери инспектора направил Заверката!',
        ],
        'act' => [
            'required' => 'Маркирай дали има Направени предписания!',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
            'name' => 'Име',
            'username' => 'Потребител',
            'email' => 'E-mail',
            'first_name' => 'Име',
            'last_name' => 'Фамилия',
            'password' => 'Парола',
            'city' => 'Град',
            'country' => 'Държава',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'mobile' => 'GSM',
            'age' => 'Възраст',
            'sex' => 'Пол',
            'gender' => 'Пол',
            'day' => 'Ден',
            'month' => 'Месец',
            'year' => 'Година',
            'hour' => 'Час',
            'minute' => 'Минута',
            'second' => 'Секунда',
            'title' => 'Заглавие',
            'content' => 'Съдържание',
            'description' => 'Описание',
            'excerpt' => 'Откъс',
            'date' => 'Дата',
            'time' => 'Време',
            'available' => 'Достъпен',
            'size' => 'Размер',
            'recaptcha_response_field' => 'Рекапча',
            'subject' => 'Заглавие',
            'message' => 'Съобщение',

            'aktiv'=>'Действащ',
            'password2' => 'Повтори Паролата',
            'all_name'=>'Име на инспектора',
            'surname'=>'Презиме',
            'family'=>'Фамилия',
            'start_date'=>'Начална дата',
            'degree' =>'Титла'
    ],
];