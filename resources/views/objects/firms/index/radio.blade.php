<p class="description">Задължително! Избери една от следните възможности!</p>
{!! Form::label('type_firm', ' Вид на фирмата:', ['class'=>'labels']) !!}
&nbsp;<label >ЕТ
    {!! Form::radio('type_firm', 1, false) !!}
</label>&nbsp; | &nbsp;

&nbsp;<label >ООД
    {!! Form::radio('type_firm', 2, false) !!}
</label>&nbsp; | &nbsp;

&nbsp;<label >ЕООД
    {!! Form::radio('type_firm', 3, false) !!}
</label>&nbsp; | &nbsp;

&nbsp;<label >АД
    {!! Form::radio('type_firm', 4, false) !!}
</label>&nbsp; | &nbsp;

&nbsp;<label >Друго
    {!! Form::radio('type_firm', 5, false) !!}
</label>&nbsp;
