{!! Form::label('search_protocols', ' Тъпси по № на Протокол:', ['class'=>'labels']) !!}
{!! Form::text('search_protocols', null, ['class'=>'form-control form-control-my-search search_top','size'=>4, 'maxlength'=>6]) !!}
{!! Form::hidden('search', 1) !!}
{!! Form::submit(' ТЪРСИ', array('class' => 'fa fa-search btn btn-primary my_btn')) !!}