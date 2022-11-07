{!! Form::label('search_protocols', ' Тъпси по:', ['class'=>'labels']) !!}

{!! Form::select('search', [1=>'№ на Становище', 2=>'№ на Протокол'], null , ['id'=>'search', 'class'=>'form-control form-control-my-search']) !!}

{!! Form::text('search_protocols', null, ['class'=>'form-control form-control-my-search search_top',
'size'=>1, 'maxlength'=>6, 'id'=>'search_field']) !!}
{!! Form::hidden('search_hidden', 1) !!}
{!! Form::submit(' ТЪРСИ', array('class' => 'fa fa-search btn btn-primary my_btn')) !!}