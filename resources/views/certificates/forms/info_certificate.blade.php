<?php
if(strlen($certificate->index_invoice)== 0){
    $index_invoice = '';
}
else{
    $index_invoice = $certificate->index_invoice .' - ';
}
?>
<p class="bold">Сертификат издаден въз основа на:</p>
<hr class="my_hr_in"/>
<p >Документ: <span class="bold">{!! $certificate->document !!} {!! $certificate->series !!} с № {!! $certificate->number_diploma !!}
    от {!! $certificate->date_diploma !!} г.</span></p>
<p >Издаден от: <span class="bold">{!! $certificate->from_institute !!}</span></p>
<p >Специалност: <span class="bold">{!! $certificate->specialty !!}</span></p>
<p >Входящ № на Заявление: <span class="bold">{!! $certificate->index_petition !!} - {!! $certificate->petition !!} / {!! date('d.m.Y', $certificate->date_petition) !!}</span></p>
<p >Фактура №: <span class="bold">{!! $index_invoice !!}{!! $certificate->invoice !!} / {!! date('d.m.Y', $certificate->date_invoice) !!}</span></p>
<p >Документите са обработени от: <span class="bold">{!! $certificate->inspector_name !!}</span></p>