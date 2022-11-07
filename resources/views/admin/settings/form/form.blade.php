<div class="form-group">
    <table class="table">
        <tbody>
        <tr>
            <td>{!! Form::label('area_id', 'Избери област!') !!}</td>
            <td>{!!Form::select('area_id',$areas_list, $area->area_id, ['id'=>'areas_name'])!!}</td>
            <td>
                <p class="description_alert my_alert alert alert-success alert-dismissible"><span class="red">Задължително</span>
                    се избира област!
                    <br/>Веднъж избрана не е желателно да се променя повече!</p>
            </td>
        </tr>
        <tr>
            <td>{!! Form::label('address', 'Адрес на управление') !!}</td>
            <td>{!! Form::text('address', null, ['class'=>'form-control', 'size'=>40]) !!}</td>
            <td>
                <p class="description_alert my_alert alert alert-success alert-dismissible"><span class="red">Задължително</span>
                    се изписва адреса!
                    <br/>Адреса се изписва на кирилца! Позволени символи - N № ' " ,</p>
            </td>
        </tr>
        <tr>
            <td>{!! Form::label('mail', 'Електронна поща') !!}</td>
            <td>{!! Form::text('mail', null, ['class'=>'form-control', 'size'=>40]) !!}
            </td>
            <td>
                <p class="description_alert my_alert alert alert-success alert-dismissible"><span class="red">Задължително</span>
                    се изписва електронна поща!</p>
            </td>
        </tr>
        <tr>
            <td>{!! Form::label('phone', 'Телефон') !!}</td>
            <td>{!! Form::text('phone', null, ['class'=>'form-control']) !!}</td>
            <td>
                <p class="description_alert my_alert alert alert-success alert-dismissible"><span class="red">Задължително</span>
                    се изписва телефон!
                    <br/>Желателен формат 00/00 00 00 Без 0 пред кода!</p>
            </td>
        </tr>
        <tr>
            <td>{!! Form::label('fax', 'Факс') !!}</td>
            <td>{!! Form::text('fax', null, ['class'=>'form-control']) !!}</td>
            <td>
                <p class="description_alert my_alert alert alert-success alert-dismissible">Факса е опционален.<br/></p>
            </td>
        </tr>
        </tbody>
    </table>
    <br/>
</div>
<br/>