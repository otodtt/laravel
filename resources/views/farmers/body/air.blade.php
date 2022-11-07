<fieldset class="new_opinions">
    <legend class="legend_apt">РАЗРЕШИТЕЛНИ</legend>
    @foreach($permits as $permit)
        <div class="row" style="border-bottom: 1px solid #d1d1d1">
            <div class="col-md-4">
                <p class="">Разрешително № <strong>{{ $permit->number_permit }}/ {{ date('d.m.Y', $permit->date_permit) }} г.</strong></p>
            </div>
            <div class="col-md-6">
                <a class="fa fa-plane btn btn-info my_btn" href="/въздушни/{{ $permit->id }}" style="margin: 3px 0"> ВИЖ Разрешителното</a>
            </div>
        </div>
    @endforeach
</fieldset>