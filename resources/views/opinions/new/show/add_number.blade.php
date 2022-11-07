<div class="col-md-12 col-md-6_my">
    @if($opinion->number_opinion == 0 || $opinion->date_opinion == 0)
        <span class="add_span">Добави Изходящ номер на Становището!</span>
        {!! Form::open(['url'=>'add/opinion/'.$opinion->id , 'method'=>'POST', 'id'=>'form_opinion', 'files'=>true]) !!}
            {!! Form::label('number_opinion', 'Изх. №', ['class'=>'my_labels']) !!}
            {!! Form::text('number_opinion', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'number_opinion' ]) !!}
            {!! Form::label('date_opinion', 'Дата:', ['class'=>'my_labels']) !!}
            {!! Form::text('date_opinion', null, ['class'=>'form-control form-control-my', 'id'=>'date_opinion', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
            {!! Form::submit(' Добави Изходящ номер!', ['class'=>'fa fa-plus btn btn-success my_btn btn_opinion', 'id'=>'submit_opinion']) !!}
            <input type="hidden" name="opinion_submit" value="1">
        {!! Form::close() !!}
    @else
        <div class="look_protocol">
            <span>Становище с изходящ № <span class="bold">{!! $opinion->number_opinion !!}
                    / {!! date('d.m.Y', $opinion->date_opinion) !!}</span></span>
            <br/>
            <span>Мярка: <span class="bold">{!! $opinion->opinion_name !!}</span></span>
        </div>
    @endif

    <hr class="my_hr"/>
    @if($opinion->number_opinion == 0 || $opinion->date_opinion == 0)
        @if($opinion->number_protocol == 0 || $opinion->date_protocol == 0)
            <span class="add_span">Добави Констативен Протокол!</span>
            {!! Form::open(['url'=>'add/protocol/'.$opinion->id , 'method'=>'POST', 'id'=>'form_protocol', 'files'=>true]) !!}
                {!! Form::label('number_protocol', 'Протокол №', ['class'=>'my_labels']) !!}
                {!! Form::text('number_protocol', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'number_protocol' ]) !!}
                {!! Form::label('date_protocol', 'Дата:', ['class'=>'my_labels']) !!}
                {!! Form::text('date_protocol', null, ['class'=>'form-control form-control-my', 'id'=>'date_protocol', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}

                {!! Form::label('inspectors_protocol', 'Инспектор:', ['class'=>'my_labels']) !!}
                {!! Form::select('inspectors_protocol', $inspectors, null, ['id' =>'inspectors_protocol', 'class' =>'inspector form-control form-control_my_opinion' ]) !!}

                <hr class="my_hr_in"/>
                <p class="bold description">
                    <span class="red"><i class="fa fa-warning"></i> Внимание!</span><br/>
                    Ако към протокола има взети проби, добави Протокола и след това го редактирай!
                </p>
                <hr class="my_hr_in"/>

                <span class="bold">Проверката е: </span>
                <label class="labels"><span>Документална : </span>
                    {!! Form::radio('type_check', 1, true) !!}
                </label> |
                <label class="labels"><span>&nbsp;На терен: </span>
                    {!! Form::radio('type_check', 2, false) !!}
                </label>
                {!! Form::submit(' Добави Протокол!', ['class'=>'fa fa-plus btn btn-primary my_btn btn_protocol', 'id'=>'submit_protocol']) !!}
                <input type="hidden" name="protocol_submit" value="1">
            {!! Form::close() !!}
        @else
            <div class="look_protocol">
                <span>Има издаден Констативен Протокол с № <span class="bold">{!! $opinion->number_protocol !!}
                        / {!! date('d.m.Y', $opinion->date_protocol) !!}</span></span>
                &nbsp;&nbsp;&nbsp;
                <a href="{!! URL::to('/протокол-зс/'.$opinion->id.'/'.$opinion->number_protocol)!!}" class="fa btn btn-primary my_btn my_float_right">
                    <i class="fa fa-binoculars"></i> Виж Протокола
                </a>
            </div>
        @endif
    @else
        @if($opinion->number_protocol == 0 || $opinion->date_protocol == 0)
            <div class="look_protocol">
                <span>Становището няма издаден Констативен Протокол</span>
            </div>
        @else
            <span>Има издаден Констативен Протокол с № <span class="bold">{!! $opinion->number_protocol !!}
                    / {!! date('d.m.Y', $opinion->date_protocol) !!}</span></span>
            &nbsp;&nbsp;&nbsp;
            <a href="{!! URL::to('/протокол-зс/'.$opinion->id.'/'.$opinion->number_protocol)!!}" class="fa btn btn-primary my_btn my_float_right">
                <i class="fa fa-binoculars"></i> Виж Протокола</a>
        @endif
    @endif
</div>