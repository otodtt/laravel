<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <p class="bold">При Вхдящи номера.</p>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('index_in', 'Индех преди номера') !!}
                    {!! Form::text('index_in', null, ['class'=>'form-control my_input_index', 'maxlength'=>5]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('in_second', 'След номера') !!}
                    {!! Form::text('in_second', null, ['class'=>'form-control my_input_index',  'maxlength'=>5]) !!}
                </div>
                <div class="col-md-5">
                    <p class="deskript my_alert alert alert-success alert-dismissible">
                        <span class="red">Задължително</span> се изписва Индекс преди номра!
                        <br/>Индекса след номера е опционален</p>
                </div>
            </div>
        </div>
    </div>
<hr/>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <p class="bold">При Изходящи номера.</p>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('index_out', 'Индех преди номера') !!}
                    {!! Form::text('index_out', null, ['class'=>'form-control my_input_index', 'maxlength'=>5]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('out_second', 'След номера') !!}
                    {!! Form::text('out_second', null, ['class'=>'form-control my_input_index',  'maxlength'=>5]) !!}
                </div>
                <div class="col-md-5">
                    <p class="deskript my_alert alert alert-success alert-dismissible">
                        <span class="red">Задължително</span> се изписва Индекс преди номра!
                        <br/>Индекса след номера е опционален</p>
                </div>
            </div>
        </div>
    </div>
    <hr/>
</div>
