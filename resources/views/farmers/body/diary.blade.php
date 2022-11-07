<fieldset class="new_opinions">
    <legend class="legend_apt">ЗАВЕРЕНИ ДНЕВНИЦИ</legend>
    @foreach($diaries as $diary)
        <div class="row" style="border-bottom: 1px solid #d1d1d1">
            <div class="col-md-4">
                <p class=""> Заверка направена на <strong>{{ date('d.m.Y', $diary->date_diary) }} г.</strong></p>
            </div>
            <div class="col-md-6">
                <a class="fa fa-book btn btn-info my_btn" href="/дневник/редактирай/{{ $diary->id }}" style="margin: 3px 0"> Реадактирай</a>
            </div>
        </div>
    @endforeach
</fieldset>