<div class="form-group">
    <label class="col-md-4 control-label">Избери Вида на Документа</label>
    <div class="col-md-6">
{{--        {!! Form::label('place', 'Инспектор:', ['class'=>'my_labels']) !!}--}}
        <select name="document_type" id="document_type" class="localsID form-control" style=" margin: 5px 0; width: 200px; display: inline-block">
            <option value="0">-- Избери --</option>
            <option value="1" {{(old('document_type') == 1 || $document->document_type == 1)? 'selected':''}}>Регламент / Директива</option>
            <option value="2" {{(old('document_type') == 2 || $document->document_type == 2)? 'selected':''}}>Закон</option>
            <option value="3" {{(old('document_type') == 3 || $document->document_type == 3)? 'selected':''}}>Наредба</option>
            <option value="4" {{(old('document_type') == 4 || $document->document_type == 4)? 'selected':''}}>Заявления</option>
            <option value="5" {{(old('document_type') == 5 || $document->document_type == 5)? 'selected':''}}>Декларации</option>
            <option value="6" {{(old('document_type') == 6 || $document->document_type == 6)? 'selected':''}}>Въздушни</option>
            <option value="7" {{(old('document_type') == 7 || $document->document_type == 7)? 'selected':''}}>Процедури</option>
            <option value="8" {{(old('document_type') == 8 || $document->document_type == 8)? 'selected':''}}>Други</option>
        </select>
    </div>
    <br/>
</div>
<br/>
<div class="form-group">
    <label class="col-md-4 control-label">Цялото име на документа</label>
    <div class="col-md-6">
        {!! Form::text('document_name', null, ['class'=>'form-control', 'placeholder'=>'Цялото име']) !!}
    </div>
    <br/>
</div>
<br/>
<div class="form-group">
    <label class="col-md-4 control-label">Кратко име</label>
    <div class="col-md-6">
        {!! Form::text('document_short', null, ['class'=>'form-control', 'placeholder'=>'Кратко име']) !!}
    </div>
    <br/>
</div>
<hr/>
<div class="radio_buttons">
    <table class="radio_table">
        <tbody>
            <tr>
                <td class="buttons_radio"><label class="col-md-4 control-label my_label">Всички</label></td>
                <td>&nbsp;&nbsp;{!! Form::radio('document_for', 0, false) !!} </td>
            </tr>
            <tr>
                <td class="buttons_radio"><label class="col-md-4 control-label my_label">Контрол</label></td>
                <td>&nbsp;&nbsp;{!! Form::radio('document_for', 1, false) !!}</td>
            </tr>
            <tr>
                <td class="buttons_radio"><label class="col-md-4 control-label my_label">ФСК</label></td>
                <td>&nbsp;&nbsp;{!! Form::radio('document_for', 2, false) !!}</td>
            </tr>
            <tr>
                <td class="buttons_radio"><label class="col-md-4 control-label my_label">КППЗ</label></td>
                <td>&nbsp;&nbsp;{!! Form::radio('document_for', 3, false) !!}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="radio_description">
    <p class="bold">Задължително избери една от следните възможности!</p>
    <p>В кой отдел ще се ползва документа</p>
</div>
<hr/>
<div class="form-group">
    <br/>
    {!! Form::label('new', 'Действаш ли е документа?', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <label><span>&nbsp;&nbsp;Да: </span>
            {!! Form::radio('is_active', 1, true) !!}
        </label>
        <label><span>&nbsp;&nbsp;Не: </span>
            {!! Form::radio('is_active', 0, false) !!}
        </label>
    </div>
</div>
<hr/>