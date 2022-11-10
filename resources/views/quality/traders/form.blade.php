<fieldset style="border: 3px solid black; padding: 10px; margin: 10px 5px 20px 5px">
    <legend style="width: 350px; text-align: center; border-bottom: none ;">Данни на фирмата на английски:</legend>
    <div class="row">
        <div class="col-md-8" >
            <p class="description" >Изписва името на фирмата с латински символи! Минимален брой символи - 4.<br/>
            {!! Form::label('packer_name', ' Име на фирмата на латиница:', ['class'=>'my_labels']) !!}
                <br>
            {!! Form::text('packer_name', null, ['class'=>'form-control form-control-my', 'size'=>100, 'maxlength'=>500 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('packer_name'))
                    {{ $errors->first('packer_name') }}<br/>
                @endif
            </span>
        </div>
    </div>
    <hr class="my_hr_in"/>
    <div class="row">
        <div class="col-md-8" >
            {!! Form::label('packer_address', 'Адрес на фирмата на латиница:', ['class'=>'my_labels']) !!}
            <br>
            {!! Form::text('packer_address', null, ['class'=>'form-control form-control-my', 'size'=>100, 'maxlength'=>500 ]) !!}
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('packer_address'))
                    {{ $errors->first('packer_address') }}<br/>
                @endif
            </span>
        </div>
    </div>

</fieldset>

<hr class="my_hr_in"/>

