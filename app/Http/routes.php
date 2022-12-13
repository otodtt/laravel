<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('/', 'LogController');
Route::post('log/store', 'LogController@store');
Route::get('/logout', 'LogController@logout');

///// Front Controller
//Route::get('/', 'FrontController@index');
//За Админ страницата
Route::get('начало', 'FrontController@index');
Route::get('админ', 'FrontController@admin');

Route::group(['middleware' => ['auth', 'admin']], function () {
    //За Настройки
    Route::resource('admin/settings', 'SettingsController');
    Route::resource('админ/настройки', 'SettingsController');
    Route::get('админ/настройки/редактирай/{id}', 'SettingsController@edit');
    
    //За Редактиране на индексите
    Route::get('админ/настройки/индекси/{id}', 'SettingsController@edit_index');
    Route::post('admin/settings/add-index/{id}', 'SettingsController@add_index');
    // КРАЙ - За Редактиране на индексите


    //За заключване и отключване на разрешителните
    Route::post('admin/settings/lock-permits/{id}', 'SettingsController@lock_permits');
    Route::post('admin/settings/unlock-permits/{id}', 'SettingsController@unlock_permits');
    // КРАЙ - За заключване на разрешителните

    //За инспекторите
    Route::resource('admin/users', 'UsersController');

    //За Населените места
    Route::resource('admin/locations', 'LocationsController');
    //КРАЙ - За Населените места

    //НОВО ЗА ПЕЧАТА И КППЗ /////////////////////////////////////////////////////
    Route::get('админ/настройки/сертификат/{id}', 'SettingsController@stamp_index');
    Route::post('admin/settings/add_stamp/{id}', 'SettingsController@add_stamp');

    //НОВО За Държавите
    Route::resource('admin/countries', 'CountriesController');
    Route::get('admin/countries', 'CountriesController@index');
    Route::get('admin/country/{id}/edit', 'CountriesController@edit');
    //КРАЙ - За Държавите

    
    //За Директорите
    Route::resource('admin/directors', 'DirectorsController');
    //За Мярките
    Route::resource('admin/miarki', 'SetOpinionsController');
    Route::resource('админ/мярки', 'SetOpinionsController');
    Route::get('админ/мярки/редактирай/{id}', 'SetOpinionsController@edit');
    //За Протоколите
    Route::resource('admin/verifications', 'VerificationController');
    Route::resource('админ/проверки', 'VerificationController');
    Route::get('админ/проверки/редактирай/{id}', 'VerificationController@edit');
    
    //За заключване и отключване на разрешителните
    Route::post('admin/settings/lock-permits/{id}', 'SettingsController@lock_permits');
    Route::post('admin/settings/unlock-permits/{id}', 'SettingsController@unlock_permits');
    // КРАЙ - За заключване на разрешителните

    //За Шаблони Удостоверения и Промяна в обстоятелствата
    Route::get('админ/шаблон-лого', 'TemplatesController@templates_logo');
    Route::post('admin/templates-logo-create', 'TemplatesController@upload_templates_logo');

    Route::get('админ/шаблон-удостоверение', 'TemplatesController@templates_documents');
    Route::post('admin/templates-documents-create', 'TemplatesController@upload_templates_document');

    Route::get('админ/шаблон-издание', 'TemplatesController@templates_editions');
    Route::post('admin/templates-editions-create', 'TemplatesController@upload_templates_editions');

    Route::get('админ/шаблон-сертификат', 'TemplatesController@templates_certificate');
    Route::post('admin/templates-certificate-create', 'TemplatesController@upload_certificate_document');

    Route::get('админ/шаблон-становище', 'TemplatesController@templates_opinion');
    Route::post('admin/templates-opinion-create', 'TemplatesController@upload_templates_opinion');
    // КРАЙ - За Шаблони Удостоверения и Промяна в обстоятелствата

    //За Населените места
    Route::resource('admin/locations', 'LocationsController');
    Route::get('admin/locations-added/', 'LocationsController@added');
    //КРАЙ - За Населените места

    //За Производители на ПРЗ
    Route::resource('админ/производители', 'FactoriesController');
    Route::get('админ/производители/{id}/edit', 'FactoriesController@edit');
    Route::post('админ/производители/{id}/update', 'FactoriesController@update');
    Route::delete('админ/производители/{id}/destroy', 'FactoriesController@destroy');
    Route::get('админ/производители/{id}', 'FactoriesController@show');

    /////////////////////////////
    ////  КРАЙ АДМИНИСТРАТОР
});


Route::group(['middleware' => ['auth']], function () {

    Route::get('/test', 'QCertificatesController@test');
    /////////////////////////////
    //СМЯНА НА ПАРОЛА
    Route::get('парола/{id}', 'PersonalDataController@show');
    Route::post('password/change/{id}', 'PersonalDataController@update');

    /////////////////////////////
    //ФИРМИ търговци
    Route::resource('контрол/вносители', 'ImportersController');
    Route::get('/контрол/вносители/добави', 'ImportersController@create');
    Route::get('/контрол/вносители/{id}/edit', 'ImportersController@edit');
    Route::post('/контрол/вносители/{id}/update', 'ImportersController@update');
    Route::post('/контрол/вносители/сортирай/{sort?}', 'ImportersController@sort');
    Route::get('/контрол/вносители/{id}/show', 'ImportersController@show');

    Route::resource('контрол/опаковчици', 'PackersController');
    Route::get('/контрол/опаковчик/добави', 'PackersController@create');
    Route::get('/контрол/опаковчик/{id}/edit', 'PackersController@edit');
    Route::get('/контрол/опаковчик/{id}/show', 'PackersController@show');
    Route::post('/контрол/опаковчик/{id}/update', 'PackersController@update');
    Route::post('/контрол/опаковчик/{id}/destroy', 'PackersController@destroy');

    Route::resource('контрол/търговци', 'TradersController');
    Route::get('/контрол/търговци/добави', 'TradersController@create');
    Route::get('/контрол/търговци/{id}/edit', 'TradersController@edit');
    Route::get('/контрол/търговци/{id}/show', 'TradersController@show');
    Route::post('/контрол/търговци/{id}/update', 'TradersController@update');
    Route::post('/контрол/търговци/{id}/destroy', 'TradersController@destroy');


    /////////////////////////////
    //КУЛТУРИ
    Route::resource('контрол/култури', 'CropsController');
    Route::get('crops/edit/{id}', 'CropsController@edit');
    Route::any('crops/show/{id}', 'CropsController@show');
    Route::post('crops/delete/{id}', 'CropsController@destroy');
    Route::post('/контрол/култури/{id}/update', 'CropsController@update');
    Route::any('контрол/култури/внос', 'CropsController@crops_import');
    Route::any('контрол/култури/износ', 'CropsController@crops_export');
    Route::any('контрол/култури/вътрешни', 'CropsController@crops_domestic');

    // /////// СЕРТИФИКАТИ
    Route::get('/контрол/сертификат-избери', 'QCertificatesController@choose');

    // /////// Q-СЕРТИФИКАТИ
    Route::resource('контрол/сертификати-внос', 'QCertificatesController');
    Route::resource('контрол/сертификати-внос', 'QCertificatesController@index');
    Route::post('контрол/сертификати-внос', 'QCertificatesController@search');
    Route::post('контрол/сертификати-внос/сортирай', 'QCertificatesController@sort');
    
    ///// внос
    Route::get('/контрол/сертификати-внос/добави', 'QCertificatesController@create');
    Route::post('/контрол/сертификати-внос/store', 'QCertificatesController@store');
    Route::get('контрол/сертификат-внос/{id}/edit', 'QCertificatesController@edit');
    Route::post('контрол/сертификат-внос/{id}/update', 'QCertificatesController@update');

    Route::get('контрол/сертификат-внос/{id}/завърши', 'QCertificatesController@import_ending');
    Route::post('/import-finish/store', 'QCertificatesController@import_finish');
    ///// внос покажи
    Route::get('контрол/сертификат-внос/{id}', 'QCertificatesController@show');

    ///// LOCK UNLOCK
    Route::post('lock-import-certificate/{id}', 'QCertificatesController@import_lock');
    Route::post('unlock-import-certificate/{id}', 'QCertificatesController@import_unlock');
    Route::post('lock-export-certificate/{id}', 'QXCertificatesController@export_lock');
    Route::post('unlock-export-certificate/{id}', 'QXCertificatesController@export_unlock');
    Route::post('lock-internal-certificate/{id}', 'QINCertificatesController@domestic_lock');
    Route::post('unlock-internal-certificate/{id}', 'QINCertificatesController@domestic_unlock');

    // /////// СТОКИ
    Route::get('/контрол/стоки/внос', 'StocksController@import_index');
    Route::post('/import/add-stock/store', 'StocksController@import_stock_store');
    Route::post('/import/edit-stock/update/{id}', 'StocksController@import_stock_update');
    Route::get('/import/stock/{id}/{sid?}/edit', 'StocksController@import_stocks_edit');
    Route::post('/import/stock/{id}/delete', 'StocksController@import_destroy');
    Route::post('/контрол/стоки/внос/{type}', 'StocksController@import_search');
    Route::post('/стоки/внос/сортирай/{start_year?}/{end_year?}/{crop_sort?}/{inspector_sort?}', 'StocksController@import_sort');
    // /////// СТОКИ ИЗНОС
    Route::any('/контрол/стоки/износ', 'StocksController@export_index');
    Route::post('/export/add-stock/store', 'StocksController@export_stock_store');
    Route::get('/export/stock/{id}/{sid?}/edit', 'StocksController@export_stocks_edit');
    Route::post('/export/edit-stock/update/{id}', 'StocksController@export_stock_update');
    Route::post('/export/stock/{id}/delete', 'StocksController@export_destroy');
    Route::post('/стоки/износ/сортирай/{start_year?}/{end_year?}/{crop_sort?}/{inspector_sort?}', 'StocksController@export_sort');

    // /////// СТОКИ ВЪТРЕШНИ
    Route::any('/контрол/стоки/вътрешни', 'StocksController@domestic_index');
    Route::post('/internal/add-stock/store', 'StocksController@domestic_stock_store');
    Route::post('/стоки/вътрешни/сортирай/{start_year?}/{end_year?}/{crop_sort?}/{inspector_sort?}', 'StocksController@domestic_sort');
    Route::get('/internal/stock/{id}/{sid?}/edit', 'StocksController@domestic_stocks_edit');
    Route::post('/internal/stock/{id}/delete', 'StocksController@domestic_destroy');
//    Route::get('/internal/stock/{id}/{sid?}/edit', 'StocksController@export_stocks_edit');
    Route::post('/internal/edit-stock/update/{id}', 'StocksController@domestic_stock_update');


    // /////// СТОКИ КОНСУМАЦИЯ ПРЕРАБОТКА
    Route::get('/контрол/стоки/консумация-преработка', 'StocksController@consume');
    Route::post('/контрол/стоки/консумация-преработка', 'StocksController@consume');
    Route::post('/контрол/стоки/консумация-преработка/сортирай', 'StocksController@consume_sort');

    // /////// ФАКТУРИ
    Route::resource('контрол/фактури', 'InvoicesController');
    Route::post('контрол/фактури', 'InvoicesController@index');
    Route::post('контрол/фактури/сортирай', 'InvoicesController@sort');
    Route::get('контрол/фактури-внос/{id}', 'InvoicesController@import_create');
    Route::post('контрол/фактури-внос/{id}/store', 'InvoicesController@import_store');
    Route::get('контрол/фактури-внос/{id}/edit', 'InvoicesController@import_edit');
    Route::post('контрол/фактури-внос/{id}/update', 'InvoicesController@import_update');

    Route::get('контрол/фактури-износ/{id}', 'InvoicesController@export_create');
    Route::post('контрол/фактури-износ/{id}/store', 'InvoicesController@export_store');
    Route::get('контрол/фактури-износ/{id}/edit', 'InvoicesController@export_edit');
    Route::post('контрол/фактури-износ/{id}/update', 'InvoicesController@export_update');

    Route::get('контрол/фактури-вътрешни/{id}', 'InvoicesController@domestic_create');
    Route::post('контрол/фактури-вътрешни/{id}/store', 'InvoicesController@domestic_store');
    Route::get('контрол/фактури-вътрешни/{id}/edit', 'InvoicesController@domestic_edit');
    Route::post('контрол/фактури-вътрешни/{id}/update', 'InvoicesController@domestic_update');


     ///// ИЗНОС
    Route::resource('/контрол/сертификати-износ', 'QXCertificatesController');
    Route::resource('контрол/сертификати-износ', 'QXCertificatesController@index');
    Route::get('контрол/сертификати-износ/create', 'QXCertificatesController@create');
    Route::post('контрол/сертификати-износ', 'QXCertificatesController@search');
    Route::post('контрол/сертификати-износ/сортирай', 'QXCertificatesController@sort');

    Route::post('/контрол/сертификати-износ/store', 'QXCertificatesController@store');
    Route::get('контрол/сертификат-износ/{id}/завърши', 'QXCertificatesController@export_ending');
    Route::post('/export-finish/store', 'QXCertificatesController@export_finish');
    Route::get('контрол/сертификат-износ/{id}/edit', 'QXCertificatesController@edit');
    Route::post('контрол/сертификат-износ/{id}/update', 'QXCertificatesController@update');

    ///// ИЗНОС покажи
    Route::get('контрол/сертификат-износ/{id}', 'QXCertificatesController@show');

    ///// ВЪТРЕШНИ
    Route::resource('/контрол/сертификати-вътрешен', 'QINCertificatesController');
    Route::resource('/контрол/сертификати-вътрешен', 'QINCertificatesController@index');
    Route::post('контрол/сертификати-вътрешни/сортирай', 'QINCertificatesController@sort');

    Route::any('/контрол/сертификати-вътрешен/{id}', 'QINCertificatesController@show');
    Route::any('/контрол/сертификати-вътрешен/фермер/store', 'QINCertificatesController@store_old');
    Route::get('/контрол/търси-земеделец', 'QINCertificatesController@farmer_request');
    Route::post('/контрол/търси-земеделец', 'QINCertificatesController@farmer_request');

    Route::get('контрол/сертификат-вътрешен/{id}/завърши', 'QINCertificatesController@internal_ending');

    Route::any('quality/certificate/pin', 'QINCertificatesController@get_pin');
    Route::any('quality/certificate/names', 'QINCertificatesController@get_name');
    Route::any('quality/certificate/firms', 'QINCertificatesController@get_firm');

    Route::get('/контрол/сертификати-вътрешен/добави/{id}', 'QINCertificatesController@create');
    Route::get('/контрол/сертификати-вътрешен/фермер/нов', 'QINCertificatesController@create_farmer');
    Route::post('/контрол/сертификати-вътрешен/фермер/store_farmer', 'QINCertificatesController@store_farmer');

    Route::any('/контрол/сертификати-вътрешен/фермер/нова-фирма', 'QINCertificatesController@create_firm');
    Route::post('/контрол/сертификати-вътрешен/фермер/store_firm', 'QINCertificatesController@store_firm');

    Route::any('/контрол/сертификати-вътрешен/нов/търговец', 'QINCertificatesController@create_trader');
    Route::post('/контрол/сертификати-вътрешен/фермер/store_trader', 'QINCertificatesController@store_trader');
    Route::get('/контрол/сертификати-вътрешен/търговец/добави/{id}', 'QINCertificatesController@create_exist');
    Route::post('/контрол/сертификати-вътрешен/търговец/store', 'QINCertificatesController@store_exist');

    Route::get('контрол/сертификат-вътрешен/{id}/edit', 'QINCertificatesController@edit');
    Route::post('контрол/сертификати-вътрешен/{id}/update', 'QINCertificatesController@update');

    Route::post('/domestic-finish/store', 'QINCertificatesController@domestic_finish');
    //////////////////////////////////////////////////////////


    //////////////////////////////////////////////////////////
    /////////Q ПРОТОЛОЛИ ////////////////////////////////////
    Route::get('/контрол/протоколи', 'QProtocolsController@index');
    Route::get('/контрол/протоколи/търси-търговец', 'QProtocolsController@farmer_request');
    Route::post('/контрол/протоколи/търси-търговец', 'QProtocolsController@farmer_request');

    //////////////СЪЩЕСТВУВАЩ ЗС//////////////////////
    Route::get('/контрол/протоколи/добави/{id}', 'QProtocolsController@create');
    Route::post('/контрол/протоколи/фермер/{id}', 'QProtocolsController@store');

    Route::get('/контрол/протоколи/фермер/нов', 'QProtocolsController@create_farmer');
    Route::post('/контрол/протоколи/farmer/store', 'QProtocolsController@store_farmer');

    Route::get('/контрол/протоколи/търговец/{id}', 'QProtocolsController@create_trader');
    Route::post('/контрол/протоколи/търговец/{id}', 'QProtocolsController@store_trader');
    Route::get('/контрол/протоколи/търговци/нов', 'QProtocolsController@new_trader');
    Route::post('/контрол/протоколи/търговци/store', 'QProtocolsController@store_new_trader');

    Route::get('/контрол/протоколи/нерегламентиран', 'QProtocolsController@unregulated');
    Route::post('/контрол/протоколи/нерегламентиран/store', 'QProtocolsController@store_unregulated');

    ///// ПРОТОЛОЛИ покажи
    Route::get('контрол/протоколи/{id}/show', 'QProtocolsController@show');

    ///// ПРОТОЛОЛИ ЕДИТ
    Route::get('/контрол/протоколи/нерегламентиран/edit/{id}', 'QProtocolsController@unregulated_edit');
    Route::post('/контрол/протоколи/нерегламентиран/update/{id}', 'QProtocolsController@unregulated_update');

    Route::get('/контрол/протоколи/търговец/edit/{id}', 'QProtocolsController@trader_edit');
    Route::post('/контрол/протоколи/търговец/update/{id}', 'QProtocolsController@trader_update');

    Route::get('/контрол/протоколи/фермер/edit/{id}', 'QProtocolsController@edit');
    Route::post('/контрол/протоколи/фермер/update/{id}', 'QProtocolsController@update');

    Route::any('quality/protocol/pin', 'QProtocolsController@get_pin');
    Route::any('quality/protocol/names', 'QProtocolsController@get_name');
    Route::any('quality/protocol/firms', 'QProtocolsController@get_firm');
    //////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////
    /////////////////////////////























    //За ВСИЧКИ Фирми таблицата и сортирането
    Route::resource('firms', 'FirmsController');
    Route::resource('фирми', 'FirmsController');
    Route::get('фирма/{id}', 'FirmsController@show');
    Route::any('firms/locations', 'FirmsController@locations');
    Route::any('фирми/сортирай/{abc?}/{sort?}','FirmsController@sort');
    //КРАЙ - За ВСИЧКИ Фирми таблицата и сортирането
    //За Промяна в обстоятелствата на фирма
    Route::get('фирма/{id}/промяна-обстоятелства', 'ChangeObjectsController@change_firm');
    Route::get('фирма/{id}/промяна-обстоятелства-фирма/{id_obj}/{type_obj}', 'ChangeObjectsController@change_firm__object');
    Route::post('firms/change-firm-add/{id}', 'ChangeObjectsController@store_firm');
    Route::post('firms/change-firm-object-add/{id}/{id_obj}/{type_obj}', 'ChangeObjectsController@store_firm_object');
    //КРАЙ - За Промяна в обстоятелствата на фирма

    ////////////
    //За Аптеките
    Route::resource('pharmacies', 'PharmaciesController');
    Route::resource('аптеки', 'PharmaciesController');
    Route::any('аптеки/сортирай/{abc_list?}/{areas_list?}/{years_list?}/{licence_list?}','PharmaciesController@sort');
    Route::get('изтекъл-срок', 'PharmaciesController@expired');
    //Route::any('изтекъл-срок/сортирай/{abc_list?}','PharmaciesController@sort');

    // Добавяне на Разрешително
    Route::get('аптека/{id}/разрешително-аптека', 'PharmaciesController@create_permits');
    Route::post('pharmacies/permit-store/{id}', 'PharmaciesController@store_permit');
    // КРАЙ - Добавяне на Разрешително
    // Добавяне на Удостоверение
    Route::get('аптека/{id}/ново-удостоверение', 'PharmaciesController@create');
    Route::get('аптека/{firm_id}/удостоверение/{id}', 'PharmaciesController@add');
    Route::put('pharmacies/store-add/{id}', 'PharmaciesController@store_add');
    //КРАЙ - Добавяне на Удостоверение
    // Редактиране на аптека
    Route::get('аптека/{firm_id}/редактирай/{id}/{admin?}', 'PharmaciesController@edit');
    //КРАЙ - Редактиране на аптека

    ////////////////////////////
    Route::get('фирма/{id}/избери/{id_obj}/{type_obj}', 'ChangeObjectsController@select');
    //За Обекти Промяна в обстоятелствата
    Route::get('аптека/{id}/промяна-обстоятелства', 'ChangeObjectsController@change_pharmacy');
    Route::post('pharmacies/change-pharmacy-add/{id}', 'ChangeObjectsController@store_pharmacy');
    //КРАЙ-За Обекти Промяна в обстоятелствата
    // AJAX Заявката
    Route::any('firms/locations-change', 'ChangeObjectsController@locations_change');
    Route::any('pharmacies/locations-change', 'ChangeObjectsController@locations_change');
    Route::any('pharmacies/locations', 'PharmaciesController@locations');
    //КРАЙ -  AJAX Заявката
    ////////////////////////////
    // За преглед на Удостоверението
    Route::get('аптека-удостоверение/{id}/{id_obj}', 'DocumentsController@index_pharmacy');
    Route::get('склад-удостоверение/{id}/{id_obj}', 'DocumentsController@index_repository');
    Route::get('цех-удостоверение/{id}/{id_obj}', 'DocumentsController@index_workshop');
    Route::get('аптека-удостоверение/{id}/{id_obj}/{edition?}', 'DocumentsController@edition_pharmacy');
    Route::get('склад-удостоверение/{id}/{id_obj}/{edition?}', 'DocumentsController@edition_repository');
    Route::get('цех-удостоверение/{id}/{id_obj}/{edition?}', 'DocumentsController@edition_workshop');
    //КРАЙ - За преглед на Удостоверението
    //// Заключване на Документа
    Route::post('locks-pharmacy/{id}', 'DocumentsController@locks_pharmacy');
    Route::post('unlocks-pharmacy/{id}', 'DocumentsController@unlocks_pharmacy');
    Route::post('locks-repository/{id}', 'DocumentsController@locks_repository');
    Route::post('unlocks-repository/{id}', 'DocumentsController@unlocks_repository');
    Route::post('locks-workshop/{id}', 'DocumentsController@locks_workshop');
    Route::post('unlocks-workshop/{id}', 'DocumentsController@unlocks_workshop');
    ////КРАЙ - Заключване на Документа
    // За редактиране на Удостоверението
    Route::get('редактиране-издание/{id}/{id_obj}', 'DocumentsController@edit_pharmacy_edition');
    Route::post('update-pharmacy-edition/{id}/{id_obj}', 'DocumentsController@update_pharmacy_edition');

    Route::get('склад/редактиране-издание/{id}/{id_obj}', 'DocumentsController@edit_repository_edition');
    Route::post('update-repository-edition/{id}/{id_obj}', 'DocumentsController@update_repository_edition');

    Route::get('цех/редактиране-издание/{id}/{id_obj}', 'DocumentsController@edit_workshop_edition');
    Route::any('update-workshop-edition/{id}/{id_obj}', 'DocumentsController@update_workshop_edition');
    //КРАЙ - За редактиране на Удостоверението

    Route::any('складове/сортирай/{abc_list?}/{areas_list?}/{years_list?}/{licence_list?}','RepositoriesController@sort');
    Route::any('цехове/sort/{abc_list?}/{areas_list?}/{years_list?}/{licence_list?}','WorkshopsController@sort');

    /////// СКЛАДОВЕ
    Route::resource('repositories', 'RepositoriesController');
    Route::resource('складове', 'RepositoriesController');
    // Добавяне на Разрешително
    Route::get('склад/{id}/разрешително-склад', 'RepositoriesController@create_permits');
    Route::post('repositories/permit-store/{id}', 'RepositoriesController@store_permit');
    // КРАЙ - Добавяне на Разрешително
    // Добавяне на Удостоверение
    Route::get('склад/{id}/ново-удостоверение', 'RepositoriesController@create');
    Route::get('склад/{firm_id}/удостоверение/{id}', 'RepositoriesController@add');
    Route::put('repositories/store-add/{id}', 'RepositoriesController@store_add');
    //КРАЙ - Добавяне на Удостоверение
    // Редактиране на Склада
    Route::get('склад/{firm_id}/редактирай/{id}/{admin?}', 'RepositoriesController@edit');
    //КРАЙ - Редактиране на Склада
    // Склад промяна в обстоятелства
    Route::get('склад/{id}/промяна-обстоятелства', 'ChangeObjectsController@change_repository');
    Route::post('repositories/change-pharmacy-add/{id}', 'ChangeObjectsController@store_repository');
    // КРАЙ Склад промяна в обстоятелства


    /////// ЦЕХОВЕ
    Route::resource('workshops', 'WorkshopsController');
    Route::resource('цехове', 'WorkshopsController');
    // Добавяне на Разрешително
    Route::get('цех/{id}/разрешително-цех', 'WorkshopsController@create_permits');
    Route::post('workshops/permit-store/{id}', 'WorkshopsController@store_permit');
    // КРАЙ - Добавяне на Разрешително
    // Добавяне на Удостоверение
    Route::get('цех/{id}/ново-удостоверение', 'WorkshopsController@create');
    Route::get('цех/{firm_id}/удостоверение/{id}', 'WorkshopsController@add');
    Route::put('workshops/store-add/{id}', 'WorkshopsController@store_add');
    //КРАЙ - Добавяне на Удостоверение
    // Редактиране на Цеха
    Route::get('цех/{firm_id}/редактирай/{id}/{admin?}', 'WorkshopsController@edit');
    //КРАЙ - Редактиране на Цеха
    // Цех промяна в обстоятелства
    Route::get('цех/{id}/промяна-обстоятелства', 'ChangeObjectsController@change_workshop');
    Route::post('workshops/change-workshop-add/{id}', 'ChangeObjectsController@store_workshop');
    // КРАЙ Цех промяна в обстоятелства

    /////// СЕРТИФИКАТИ
    Route::resource('сертификати', 'CertificatesController');
    Route::post('сертификати', 'CertificatesController@search');
    Route::get('сертификат/{id}', 'CertificatesController@show');
    // Сортиране на Сертификати
    Route::any('сертификати/сортирай/{abc_list?}/{start_year?}/{end_year?}/{limit_sort?}/{inspector_sort?}', 'CertificatesController@sort');
    // КРАЙ Сортиране на Сертификати
    // Добавяне и Редакция на Сертификати
    Route::get('сертификати/добави', 'CertificatesController@create');
    Route::post('сертификати/store', 'CertificatesController@store');

    Route::get('сертификат/{id}/редактирай', 'CertificatesController@edit');
    Route::post('сертификати/update/{id}', 'CertificatesController@update');
    // КРАЙ Добавяне и Редакция на Сертификати

    /////// ПРОТОКОЛИ Аптеки Складове Цехове
    Route::resource('протоколи', 'ProtocolsController');
    Route::post('протоколи', 'ProtocolsController@search');
    // Сортиране на Протоколи
    Route::any('протоколи/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'ProtocolsController@sort');
    // Добавяне и редактиране на Протоколи
    Route::get('протокол/{id}/добави/{type}', 'ProtocolsController@create');
    Route::post('протоколи/store/{object_id}/{type}', 'ProtocolsController@store');
    Route::get('протокол/{id}/редактирай', 'ProtocolsController@edit');
    Route::post('протоколи/{id}/update', 'ProtocolsController@update');
    // Край Добавяне и редактиране на Протоколи

    Route::get('протокол/{id}', 'ProtocolsController@show');
    Route::get('протоколи-фирма/{id}', 'ProtocolsController@protocols_show');
    Route::any('протоколи-фирма/{id}/сортирай/{id_object?}/{type?}/{years?}', 'ProtocolsController@protocols_sort');
    // Добавяне на взети проби от ПРЗ и ТОР
    Route::post('assay-prz/add/{id}', 'ProtocolsController@add_prz');
    Route::post('assay-tor/add/{id}', 'ProtocolsController@add_tor');

    /////// ПРОБИ Взети проби при контрол на пазара
    //Route::resource('проби', 'SamplesController');
    Route::any('проби', 'SamplesController@index');
    Route::any('проби-тор', 'SamplesController@index_tor');
    // Сортиране на Протоколи
    Route::any('проби/сортирай', 'SamplesController@sort');
    Route::any('проби-тор/сортирай', 'SamplesController@sort_tor');
    // Редактиране на Проба
    Route::get('проба/{id}/редактиране', 'SamplesController@edit');
    Route::post('проба/update/{id}', 'SamplesController@update');
    Route::get('проба-тор/{id}/редактиране', 'SamplesController@edit_tor');
    Route::post('проба-тор/update/{id}', 'SamplesController@update_tor');

    ///// РЕГИСТРИ
    Route::any('регистър-фирми', 'RegistersController@index_firms');
    Route::any('регистър-протоколи', 'RegistersController@index_protocols');
    Route::any('месечни-справки', 'RegistersController@index_reference');
    Route::any('регистър-сертификати', 'RegistersController@index_certificates');

    Route::any('месечни-справки-зс', 'RegistersController@index_farmers_reference');
    Route::any('месечни-справки-становища', 'RegistersController@index_opinions');
    Route::any('месечни-справки-контрол', 'RegistersController@index_control');
    Route::any('месечни-справки-дфз', 'RegistersController@index_fond');
    Route::any('протоколи-регистър', 'RegistersController@index_farmers_protocols');

    Route::any('регистър-въздушни', 'RegistersController@index_air');
    /////КРАЙ РЕГИСТРИ

    /////// НЕРЕГИСТРИРАНИ обекти
    Route::any('протоколи-обекти', 'NoneProtocolsController@index');
    //Route::resource('протоколи-обекти', 'NoneProtocolsController');
    Route::get('протокол-обект/{id}', 'NoneProtocolsController@show');
    Route::post('протоколи-обекти', 'NoneProtocolsController@search');
    Route::any('протоколи-обекти/сортирай/{abc_list?}/{start_year?}/{end_year?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'NoneProtocolsController@sort');

    Route::get('обект-протокол/добави', 'NoneProtocolsController@create');
    Route::post('обект-протокол/store', 'NoneProtocolsController@store');
    Route::any('protocols/locations', 'NoneProtocolsController@locations');

    Route::get('обект-протокол/{id}/редактирай', 'NoneProtocolsController@edit');
    Route::post('обект-протокол/{id}/update', 'NoneProtocolsController@update');
    Route::post('assay-tor-none/add/{id}', 'NoneProtocolsController@add_tor_none');
    ///////КРАЙ НЕРЕГИСТРИРАНИ обекти

    /////// ПРОТОКОЛИ ПРИОЗВОДИТЕЛИ
    /// Констативни Протоколи Производители
    Route::resource('производители', 'FactoriesProtocolsController');
    Route::post('производители', 'FactoriesProtocolsController@search');
    Route::any('производители/сортирай/{abc_list?}/{start_year?}/{end_year?}/{inspector_sort?}/{assay_sort?}', 'FactoriesProtocolsController@sort');
    Route::get('производители/{id}', 'FactoriesProtocolsController@show');
    Route::post('assay-prz-factory/add/{id}', 'FactoriesProtocolsController@assay_prz_factory');

    Route::get('производител/добави-протокол', 'FactoriesProtocolsController@create');
    Route::get('производител/{id}/редактирай', 'FactoriesProtocolsController@edit');
    Route::post('производител/добави-протокол/store', 'FactoriesProtocolsController@store');
    Route::post('производител/{id}/update', 'FactoriesProtocolsController@update');
    Route::post('factory/factory', 'FactoriesProtocolsController@factory_select');
    //// КРАЙ Констативни Протоколи Производители
    //КРАЙ - За Производители на ПРЗ

    /////// ПРОТОКОЛИ ПРОВЕРКИ В ДРУГИ ОБЛАСТИ
    /// Констативни Протоколи проверки в други области
    Route::resource('други-обекти', 'OthersProtocolsController');
    Route::any('others/locations', 'OthersProtocolsController@locations');
    Route::post('други-обекти', 'OthersProtocolsController@search');
    Route::any('други-обекти/сортирай/{abc_list?}/{start_year?}/{end_year?}/{inspector_sort?}/{assay_sort?}/{object_sort?}', 'OthersProtocolsController@sort');
    Route::get('друг-обект-протокол/{id}', 'OthersProtocolsController@show');
    //Route::post('assay-prz-factory/add/{id}', 'FactoriesProtocolsController@assay_prz_factory');
    //
    Route::get('друг-обект/добави', 'OthersProtocolsController@create');
    Route::get('друг-обект/{id}/редактирай', 'OthersProtocolsController@edit');
    Route::post('друг-обект/добави/store', 'OthersProtocolsController@store');
    Route::post('друг-обект/{id}/update', 'OthersProtocolsController@update');
    //Route::post('factory/factory', 'FactoriesProtocolsController@factory_select');
    //// КРАЙ Констативни Протоколи Производители
    //КРАЙ - За Производители на ПРЗ




    ////// ЗЕМЕДЕЛСКИ ПРОИЗВОДИТЕЛИ
    Route::resource('земеделци', 'FarmersController');
    Route::post('земеделци', 'FarmersController@index');
    Route::any('земеделци/сортирай/{abc_list?}/{sort?}/{sort_firm?}', 'FarmersController@sort');
    Route::any('стопанин/{id}', 'FarmersController@show');
    Route::get('стопанин/{id}/редактирай', 'FarmersController@edit');
    Route::put('стопанин/{id}/update', 'FarmersController@update');

    ///// СТАНОВИЩА
    ////// Стари Становищя
    Route::resource('становища-стари', 'OldOpinionsController');
    Route::post('становища-стари', 'OldOpinionsController@search');
    Route::any('становища-стари/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'OldOpinionsController@sort');
    Route::get('становище-старо/{id}', 'OldOpinionsController@show');
    ////// КРАЙ Стари Становищя

    ////// Нови Становищя
    Route::resource('становища', 'OpinionsController');
    Route::post('становища', 'OpinionsController@search');
    Route::any('становища/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'OpinionsController@sort');
    Route::get('становище/{id}', 'OpinionsController@show');
    /// При търсене на ЗП
    Route::get('търси-становище', 'OpinionsController@search_farmer');
    Route::post('търси-становище', 'OpinionsController@farmer_request');
    Route::any('farmers/pin', 'OpinionsController@get_pin');
    Route::any('farmers/names', 'OpinionsController@get_name');
    Route::any('farmers/firms', 'OpinionsController@get_firm');
    /// КРАЙ При търсене на ЗП
    Route::get('ново/становище', 'OpinionsController@new_create');
    Route::post('ново/store/становище', 'OpinionsController@new_store');

    Route::get('добави/становище/{id}/{type?}', 'OpinionsController@create');
    Route::post('добави/становище/{id}/store', 'OpinionsController@store');

    Route::get('редактирай/становище/{id}', 'OpinionsController@edit');
    Route::post('редактирай/становище/{id}/update', 'OpinionsController@update');

    Route::get('администратор-редактирай/становище/{id}', 'OpinionsController@edit_admin');
    Route::post('администратор-редактирай/становище/{id}/update', 'OpinionsController@update_admin');
    ///// Добавяне на Номер и Дата на Становището
    Route::post('add/opinion/{id}', 'OpinionsController@add_number');
    ///// Край Добавяне на Номер и Дата на Становището
    ///// Добавяне на Констативен Протокол на Становището
    Route::post('add/protocol/{id}', 'FarmersProtocolsController@add_number');
    ///// Край Добавяне на Номер и Дата на Становището
    ////// КРАЙ Нови Становищя

    /////ПРОТОКОЛИ ЗП
    /// Всички Протоколи
    Route::get('протоколи-всички', 'FarmersProtocolsController@index');
    Route::post('протоколи-всички', 'FarmersProtocolsController@search');
    Route::any('протоколи-всички/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'FarmersProtocolsController@sort');
    /// Протоколи проверка на ЗП
    Route::get('протоколи-стопани', 'FarmersProtocolsController@index_farmers');
    Route::post('протоколи-стопани', 'FarmersProtocolsController@search_farmers');
    Route::any('протоколи-стопани/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'FarmersProtocolsController@sort_farmers');
    /// Протоколи проверка с ДФЗ
    Route::get('протоколи-дфз', 'FarmersProtocolsController@index_fond');
    Route::post('протоколи-дфз', 'FarmersProtocolsController@search_fond');
    Route::any('протоколи-дфз/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'FarmersProtocolsController@sort_fond');
    /// Протоколи проверка за Становища
    Route::get('протоколи-становища', 'FarmersProtocolsController@index_opinions');
    Route::post('протоколи-становища', 'FarmersProtocolsController@search_opinions');
    Route::any('протоколи-становища/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'FarmersProtocolsController@sort_opinions');
    /// Протоколи проверка за Други плащания
    Route::get('протоколи-други', 'FarmersProtocolsController@index_others');
    Route::post('протоколи-други', 'FarmersProtocolsController@search_others');
    Route::any('протоколи-други/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'FarmersProtocolsController@sort_others');

    /// Протоколи с нарушения
    Route::get('протоколи-нарушения', 'FarmersProtocolsController@index_violation');
    Route::post('протоколи-нарушения', 'FarmersProtocolsController@search_violation');
    Route::any('протоколи-нарушения/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{inspector_sort?}', 'FarmersProtocolsController@sort_violation');

    /// Протоколи с взети проби
    Route::get('протоколи-проби', 'FarmersProtocolsController@index_assay');
    Route::post('протоколи-проби', 'FarmersProtocolsController@search_assay');
    Route::any('протоколи-проби/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{inspector_sort?}', 'FarmersProtocolsController@sort_assay');

    Route::get('протокол-зс/{id}/{opinion_id?}', 'FarmersProtocolsController@show');

    //// Редактиране на Протокол
    Route::get('протокол-редактирай/{id}', 'FarmersProtocolsController@edit');
    Route::post('протокол-редактирай/update/{id}', 'FarmersProtocolsController@update');
    //// Край Редактиране на Протокол

    //////// Съществуващ ЗС
    Route::get('протокол-добави/{id}', 'FarmersProtocolsController@create');
    Route::post('протокол-зс/store/{id}', 'FarmersProtocolsController@store');
    Route::get('нов/протокол-зс', 'FarmersProtocolsController@create_new');
    Route::post('протокол-нов/store', 'FarmersProtocolsController@store_new');
    /////// Търси ЗС за Протокол
    Route::get('търси-протокол', 'FarmersProtocolsController@farmer_request');
    Route::post('търси-протокол', 'FarmersProtocolsController@farmer_request');
    Route::any('protocol/pin', 'FarmersProtocolsController@get_pin');
    Route::any('protocol/names', 'FarmersProtocolsController@get_name');
    Route::any('protocol/firms', 'FarmersProtocolsController@get_firm');
    /////КРАЙ ПРОТОКОЛИ ЗП

    /////СТАРИ ПРОТОКОЛИ ЗП
    /// Всички СТАРИ Протоколи
    Route::get('стари-протоколи-всички', 'OldProtocolsController@index');
    Route::post('стари-протоколи-всички', 'OldProtocolsController@search');
    Route::any('стари-протоколи-всички/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'OldProtocolsController@sort');
    ///СТАРИ  Протоколи проверка на ЗП
    Route::get('стари-протоколи-стопани', 'OldProtocolsController@index_farmers');
    Route::post('стари-протоколи-стопани', 'OldProtocolsController@search_farmers');
    Route::any('стари-протоколи-стопани/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'OldProtocolsController@sort_farmers');
    ///СТАРИ  Протоколи проверка с ДФЗ
    Route::get('стари-протоколи-дфз', 'OldProtocolsController@index_fond');
    Route::post('стари-протоколи-дфз', 'OldProtocolsController@search_fond');
    Route::any('стари-протоколи-дфз/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'OldProtocolsController@sort_fond');
    ///СТАРИ  Протоколи проверка за Становища
    Route::get('стари-протоколи-становища', 'OldProtocolsController@index_opinions');
    Route::post('стари-протоколи-становища', 'OldProtocolsController@search_opinions');
    Route::any('стари-протоколи-становища/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'OldProtocolsController@sort_opinions');
    ///СТАРИ  Протоколи проверка за Други плащания
    Route::get('стари-протоколи-други', 'OldProtocolsController@index_others');
    Route::post('стари-протоколи-други', 'OldProtocolsController@search_others');
    Route::any('стари-протоколи-други/сортирай/{abc_list?}/{start_year?}/{end_year?}/{object_sort?}/{areas_sort?}/{inspector_sort?}/{assay_sort?}', 'OldProtocolsController@sort_others');

    Route::get('стари-протокол-зс/{id}/{date?}', 'OldProtocolsController@show');
    /////КРАЙ ПРОТОКОЛИ ЗП

    /////// ДНЕВНИЦИ
    Route::get('дневници', 'DiariesController@index');
    Route::post('дневници', 'DiariesController@index');
    Route::any('дневници/сортирай/{abc_list?}/{years?}', 'DiariesController@sort');

    Route::get('нов/дневник', 'DiariesController@create');
    Route::post('нов/дневник/store', 'DiariesController@store');

    Route::get('дневник/редактирай/{id}', 'DiariesController@edit');
    Route::post('дневник/update/{id}', 'DiariesController@update');
    /////// Търси ЗС за дневник
    Route::get('търси-дневник', 'DiariesController@farmer_request');
    Route::post('търси-дневник', 'DiariesController@farmer_request');
    Route::any('diary/pin', 'DiariesController@get_pin');
    Route::any('diary/names', 'DiariesController@get_name');
    Route::any('diary/firms', 'DiariesController@get_firm');
    /////// КРАЙ ДНЕВНИЦИ
    ////// КРАЙ ЗЕМЕДЕЛСКИ ПРОИЗВОДИТЕЛИ



    /////// ВЪЗДУШНИ
    Route::resource('въздушни', 'AirPermitsController');
    Route::post('въздушни', 'AirPermitsController@index');
    Route::post('въздушни-търси', 'AirPermitsController@search');
    Route::get('въздушни/{id}', 'AirPermitsController@show');
    //// Сортиране на Разрешитлни
    Route::any('въздушни/сортирай/{abc_list?}/{inspector_sort?}/{year?}', 'AirPermitsController@sort');
    //// КРАЙ Сортиране на Разрешитлни

    //// Добавяне и Редакция на Разрешитлни
    Route::get('въздушни/добави/{id}', 'AirPermitsController@create');
    Route::post('въздушни/store/{id}', 'AirPermitsController@store');

    //// Добавяне и Редакция на НОВО Разрешитлни
    Route::get('въздушно-нов/добави', 'AirPermitsController@create_new');
    Route::post('въздушно-нов/store', 'AirPermitsController@store_new');

    Route::get('въздушни/{id}/редактирай', 'AirPermitsController@edit');
    Route::post('въздушни/update/{id}', 'AirPermitsController@update');
    //// КРАЙ Добавяне и Редакция на Разрешитлни
    /////// Търси ЗС за разрешително
    Route::get('търси-въздушно', 'AirPermitsController@farmer_request');
    Route::post('търси-въздушно', 'AirPermitsController@farmer_request');
    Route::any('permit/pin', 'AirPermitsController@get_pin');
    Route::any('permit/names', 'AirPermitsController@get_name');
    Route::any('permit/firms', 'AirPermitsController@get_firm');
    ///////КРАЙ ВЪЗДУШНИ
});



