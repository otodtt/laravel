<fieldset class="new_opinions">
    <legend class="legend_apt">ПРОТОКОЛИ - Констативни Протоколи по качество на ППЗ издадени на Земеделския Стопанин</legend>
    @foreach($qprotocols as $qprotocol)
        <div class="col-md-6" >
            <p class="">
                ПРОТОКОЛ с &#8470; <span class="bold">{{$qprotocol->number_protocol}}</span>
                издаен на <span class="bold">{{date('d.m.Y', $qprotocol->date_protocol)}}</span> г.
            </p>
        </div>
        <div class="col-md-5" >
            <a class="fa fa-binoculars btn btn-info my_btn" href="/контрол/протоколи/{{$qprotocol->id}}" style="margin: 3px 0"> Виж Протокола!</a>
        </div>
    @endforeach
</fieldset>