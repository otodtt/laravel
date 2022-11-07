<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Протокола от който е взета пробата</legend>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('number_sample', 'Протокол №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_sample', $samples->number_sample, ['class'=>'form-control form-control-my',
                    'size'=>2, 'maxlength'=>6, 'id'=>'number_sample' ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_number', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_number', date('d.m.Y', $samples->date_number), ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_number', 'size'=>15, 'maxlength'=>10 ]) !!}
                </div>
                <div class="col-md-8 col-md-6_my"  >
                    <p id="change_no" class="description "><span class="bold red"><i class="fa fa-warning"></i> ВНИМАНИЕ!</span>
                        Не променяй ако не е необходимо! Променя се само ако е сгрешен Протокола и с него не е взета проба.
                    </p>
                    <p id="change_yes" class="description hidden"><span class="bold red"><i class="fa fa-warning"></i> ВНИМАНИЕ!
                        ПРОМЕНЯТЕ ПРОТОКОЛА. НАИСТИНА ЛИ Е СГРЕШЕН?</span>
                    </p>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr"/>