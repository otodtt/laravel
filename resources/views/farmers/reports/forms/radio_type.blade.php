<div class="row" >
    <div class="col-md-3 col-md-6_my" >
        @if(isset($report) && !empty($report))
            @if($report->opinions == 0)
                {!! Form::label('check_id', 'ВИД НА ПРОВЕРКАТА:', ['class'=>'my_labels check_span']) !!}
                {!! Form::select('check_id', $checks, null, ['id' =>'check_id',
                        'class' =>'inspector form-control form-control_my_insp' ]) !!}
            @else
                <p style="margin-left: 20px" class="bold">Протокол издаден за Становище по мярка {{ $protocol->description }}</p>
            @endif
        @else
            {!! Form::label('check_id', 'ВИД НА ПРОВЕРКАТА:', ['class'=>'my_labels check_span']) !!}
            {!! Form::select('check_id', $checks, null, ['id' =>'check_id',
                    'class' =>'inspector form-control form-control_my_insp' ]) !!}
        @endif
    </div>
    <div class="col-md-6 col-md-6_my" >
        <span class="bold">ПРОВЕРКАТА Е:</span>&nbsp;&nbsp;
        <label class="where_check"><span>&nbsp;&nbsp;ДОКУМЕНТАЛНА В ОДБХ: </span>
            {!! Form::radio('where_check', 1, false) !!} |
        </label>
        <label class="where_check"><span>&nbsp;&nbsp;ДОКУМЕНТАЛНА В СТОПАНСТВОТО: </span>
            {!! Form::radio('where_check', 2, false) !!}
        </label>
    </div>
    <div class="col-md-3 col-md-6_my" >
        {!! Form::label('place', 'МЯСТО НА ПРОВЕРКАТА:', ['class'=>'my_labels']) !!}
        {!! Form::text('place', null, ['class'=>'form-control form-control-my', 'size'=>13, 'maxlength'=>100 ]) !!}
    </div>
</div>