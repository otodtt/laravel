<fieldset class="new_opinions">
    <legend class="legend_apt">СЕРТИФИКАТИ - Сертификати по качество на ППЗ издадени на Земеделския Стопанин</legend>
    @foreach($qcertificates as $qcertificate)
        <div class="col-md-6" >
            <p class="">
                Сертификат с &#8470; <span class="bold">{{$qcertificate->internal}}</span>
                издаен на <span class="bold">{{date('d.m.Y', $qcertificate->date_issue)}}</span> г.
            </p>
        </div>
        <div class="col-md-5" >
            <a class="fa fa-binoculars btn btn-info my_btn" href="/" style="margin: 3px 0"> Виж повече!</a>
        </div>
    @endforeach
</fieldset>