<?php
if ($certificate->number <= 9) {
    $certificate_number = '000' . $certificate->number;
} elseif ($certificate->number <= 99) {
    $certificate_number = '00' . $certificate->number;
} elseif ($certificate->number <= 999) {
    $certificate_number = '0' . $certificate->number;
} else {
    $certificate_number = $certificate->number;
}

$date_certificate = date('d.m.Y', $certificate->date);
$date_petition = date('d.m.Y', $certificate->date_petition);
$date_invoice = date('d.m.Y', $certificate->date_invoice);
if($certificate->to_date > 0){
    $date_end = date('d.m.Y', $certificate->to_date);
}
else{
    $date_end = '';
}


if($certificate->sex == 1){
    $male = true;
    $female = false;
    $no_pin = false;
}
if($certificate->sex == 2){
    $male = false;
    $female = true;
    $no_pin = false;
}
if($certificate->sex == 0){
    $male = false;
    $female = false;
    $no_pin = true;
}

if($certificate->limit_certificate == 1){
    $limit_no = true;
    $limit = false;
}
if($certificate->limit_certificate == 2){
    $limit_no = false;
    $limit = true;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Номер и дата на Сертификат</legend>
                <div class="col-md-6 col-md-6_my" >
                    <p class="bold " id="certificate_number_edit">Сертификат № {{$index[0]['area_id']}} - {!! $certificate_number !!}</p>
                </div>
                <div class="col-md-6" >
                    {!! Form::label('date', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date', $date_certificate, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <p class="description">
                <br/>
                <span class="fa fa-warning red" aria-hidden="true"> ВНИМАНИЕ! </span> Номера на сертификата повече не може да се променя!
            </p>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Номер и дата на заявление</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('petition', 'Заявление №', ['class'=>'my_labels']) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold"> {{$index[0]['index_in']}} - </span>
                    {!! Form::text('petition',  $certificate->petition, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    <span> {{$index[0]['in_second']}} </span>
                </div>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('date_petition', 'Дата заявление:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_petition', $date_petition, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_petition_certificate', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-6 ">
            <fieldset class="small_field"><legend class="small_legend">Номер и дата на Фактура</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('invoice', 'Фактура №', ['class'=>'my_labels']) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::text('invoice', $certificate->invoice, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>10 ]) !!}
                </div>
                <div class="col-md-6 " >
                    {!! Form::label('date_invoice', 'Дата Фактура:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_invoice', $date_invoice, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_invoice', 'size'=>13, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни на заявителя</legend>
                <fieldset class="small_field_in">
                    <div class="col-md-6 col-md-6_my" >
                        {!! Form::label('owner', 'Трите имена:', ['class'=>'my_labels']) !!}
                        {!! Form::text('owner', $certificate->name, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>250 ]) !!}
                    </div>
                    <div class="col-md-6 col-md-6_my" >
                        <label class="labels"><span>Мъж: </span>
                            {!! Form::radio('gender', 'male', $male) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
                            {!! Form::radio('gender', 'female',$female) !!}
                        </label>&nbsp;&nbsp;|
                        {!! Form::label('pin', 'ЕГН:', ['class'=>'labels']) !!}
                        {!! Form::text('pin', $certificate->pin, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin' ]) !!}
                        <label class="labels"><span>&nbsp;&nbsp;Без ЕГН: </span>
                            {!! Form::radio('gender', 'n', $no_pin) !!}
                        </label>
                    </div>
                </fieldset>
                <hr class="hr_in"/>
                <fieldset class="small_field_in">
                    <div class="col-md-6 col-md-6_my" >
                        {!! Form::label('address', 'Точен адрес:', ['class'=>'my_labels']) !!}&nbsp;
                        {!! Form::text('address', $certificate->address, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>250 ]) !!}
                    </div>
                    <div class="col-md-3 col-md-6_my" >
                        {!! Form::label('phone', 'Телефон:', ['class'=>'my_labels']) !!}
                        {!! Form::text('phone', $certificate->phone, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>15, 'placeholder'=>'0888/ 000 000' ]) !!}
                    </div>
                    <div class="col-md-3 col-md-6_my" >
                        {!! Form::label('email', 'Email:', ['class'=>'my_labels']) !!}
                        {!! Form::text('email', $certificate->email, ['class'=>'form-control form-control-my', 'size'=>18, 'maxlength'=>100 ]) !!}
                    </div>
                </fieldset>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни на документа</legend>
                <div class="col-md-4 col-md-6_my" >
                    <fieldset class="small_field_in">
                        <p class="description">Въведете дали е диплома, удостоверение, сертификат и т.н.</p><hr class="hr_in"/>
                        {!! Form::label('document', 'Диплома или друг документ:', ['class'=>'my_labels']) !!}
                        {!! Form::text('document', $certificate->document, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>50 ]) !!}
                    </fieldset>
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <fieldset class="small_field_in">
                        <p class="description">Ако има сериен номер го изпишете. Пример "Серия 0А".</p><hr class="hr_in"/>
                        {!! Form::label('series', 'Сериен номер на документа:', ['class'=>'my_labels']) !!}
                        {!! Form::text('series', $certificate->series, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>50 ]) !!}
                    </fieldset>
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <fieldset class="small_field_in">
                        {!! Form::label('number_diploma', 'Номер на дипломата (документа):', ['class'=>'my_labels']) !!}<br>
                        {!! Form::text('number_diploma', $certificate->number_diploma, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>20 ]) !!}
                        {!! Form::label('date_diploma', 'от дата:', ['class'=>'my_labels']) !!}
                        {!! Form::text('date_diploma', $certificate->date_diploma, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>50 ]) !!}
                    </fieldset>
                </div>

                <div class="col-md-6 col-md-6_my institute_margin" >
                    <fieldset class="small_field_in">
                        <p class="description">Институцията издала дипломата заедно с града. Пример "ВСИ „Васил Коларов” - гр. Пловдив"</p><hr class="hr_in"/>
                        {!! Form::label('from_institute', 'От къде е издадена дипломата:', ['class'=>'my_labels']) !!}
                        {!! Form::text('from_institute', $certificate->from_institute, ['class'=>'form-control form-control-my', 'size'=>45, 'maxlength'=>250 ]) !!}
                    </fieldset>
                </div>
                <div class="col-md-6 col-md-6_my institute_margin" >
                    <fieldset class="small_field_in">
                        <p class="description">Въведете специалността или програмата!</p><hr class="hr_in"/>
                        {!! Form::label('specialty', 'Специалност', ['class'=>'my_labels']) !!}
                        {!! Form::text('specialty', $certificate->specialty, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>150 ]) !!}
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field" ><legend class="small_legend">Данни на документа</legend>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in">
                        <p class="description">
                            Срока на валидност ще се попълни автоматично в зависимост от датата на издаване.
                        </p>
                        <hr class="hr_in"/>
                        <label class="labels_limit"><span>БЕЗСРОЧЕН: </span>
                            {!! Form::radio('limit_certificate', 1, $limit_no) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="labels_limit"><span>&nbsp;&nbsp;С ОГРАНИЧЕН СРОК: </span>
                            {!! Form::radio('limit_certificate', 2, $limit) !!}
                        </label>
                        &nbsp; | &nbsp;
                        {!! Form::label('date_end', 'До Дата:', ['class'=>'my_labels hidden', 'id' =>'date_end_label']) !!}
                        {!! Form::text('date_end', $date_end, ['class'=>'form-control form-control-my date_end hidden',
                        'id'=>'date_end', 'size'=>13, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                    </fieldset>
                </div>
                <div class="col-md-6 col-md-6_my in_table" >
                    <fieldset class="small_field_in">
                        <p class="description"><span class="fa fa-warning red" aria-hidden="true"> ВНИМАНИЕ! </span>
                            Снимката трябва да е не по-голяма от 2 МВ и формат jpg или jpeg.</p><hr class="hr_in"/>
                        {!! Form::label('file', 'Избери снимка:', ['class'=>'my_labels']) !!}
                        {!! Form::file('file',['id'=>'filename']) !!}
                    </fieldset>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Име на инспектора обработил документите</legend>
                {!! Form::label('inspector', 'Кой е обработил документите:', ['class'=>'my_labels']) !!}
                {!! Form::select('inspector', $inspectors, $certificate->inspector_id, ['id' =>'id_user',
                        'class' =>'inspector form-control form-control_my_insp' ]) !!}
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <br/>
            <p  >Задължително се избира инспектора обработил документите!</p>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>
