<div class="form-group">
    <label class="col-md-4 control-label">Цялото име</label>
    <div class="col-md-6">
        {!! Form::text('full_name', null, ['class'=>'form-control', 'placeholder'=>'Проверка на Земеделски Стопанин']) !!}
    </div>
    <br/>
</div>
<br/>
<div class="form-group">
    <label class="col-md-4 control-label">Кратко име</label>
    <div class="col-md-6">
        {!! Form::text('short_name', null, ['class'=>'form-control', 'placeholder'=>'Проверка на ЗС']) !!}
    </div>
    <br/>
</div>
<hr/>
<div class="radio_buttons">
    <table class="radio_table">
        <tbody>
            <tr>
                <td class="buttons_radio"><label class="col-md-4 control-label my_label">Проверки с ДФЗ:</label></td>
                <td>&nbsp;&nbsp;{!! Form::radio('type_check', 2, false) !!} </td>
            </tr>
            <tr>
                <td class="buttons_radio"><label class="col-md-4 control-label my_label">Държавни помощи:</label></td>
                <td>&nbsp;&nbsp;{!! Form::radio('type_check', 3, false) !!}</td>
            </tr>
            <tr>
                <td class="buttons_radio"><label class="col-md-4 control-label my_label">Друго:</label></td>
                <td>&nbsp;&nbsp;{!! Form::radio('type_check', 1, false) !!}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="radio_description">
    <p class="bold">Задължително избери една от следните възможности!</p>
    <p>1. Маркирай когато проверките са заедно с ДФЗ!</p>
    <p>2. Маркирай когато проверките са по държавни плащания!</p>
</div>

<div class="form-group">
    <br/>
    {!! Form::label('new', 'Да се показва?', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <label><span>&nbsp;&nbsp;Да: </span>
            {!! Form::radio('show_check', 1, false) !!}
        </label>
        <label><span>&nbsp;&nbsp;Не: </span>
            {!! Form::radio('show_check', 0, false) !!}
        </label>
    </div>
</div>