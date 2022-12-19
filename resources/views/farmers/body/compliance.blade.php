<fieldset class="new_opinions">
    <legend class="legend_apt">ФОРМУЛЯРИ - Фуормуляри за съответствие издадени на Земеделския Стопанин</legend>
    @foreach($compliance as $protocol)
        <div class="col-md-6" >
            <p class="">
                ФОРМУЛЯР с дата &#8470; <span class="bold">{{date('d.m.Y', $protocol->date_compliance)}}</span>
                издаен на <span class="bold">{{$protocol->object_control }}</span>
            </p>
        </div>
        <div class="col-md-5" >
            <a class="fa fa-binoculars btn btn-info my_btn" href="/контрол/формуляр/{{$protocol->id}}" style="margin: 3px 0"> Виж Формуляра!</a>
        </div>
    @endforeach
</fieldset>