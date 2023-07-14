<?php
if(!isset($protocols)){
    $return_inspector = null;
    $return_two = null;
    $return_three = null;
    $return_another = null;
    $return_from = null;
}
else{
    $return_inspector = $protocols->inspector;
    $return_two = $protocols->inspector_two;
    $return_three = $protocols->inspector_three;
    $return_another = $protocols->inspector_another;
    $return_from = $protocols->inspector_from;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Инспектори</legend>
                <div class="col-md-7 col-md-6_my inspectors_divs border_divs" >
                    {!! Form::label('inspector', 'Водещ:', ['class'=>'my_labels']) !!}
                    {!! Form::select('inspector', $inspectors, $return_inspector, ['id' =>'id_user1',
                            'class' =>'inspector form-control form-control_my_insp' ]) !!}

                    {!! Form::label('inspector_two', 'Инспектор 2:', ['class'=>'my_labels']) !!}
                    {!! Form::select('inspector_two', $inspectors, $return_two, ['id' =>'id_user2',
                            'class' =>'inspector form-control form-control_my_insp' ]) !!}

                    {!! Form::label('inspector_three', 'Инспектор 3:', ['class'=>'my_labels']) !!}
                    {!! Form::select('inspector_three', $inspectors, $return_three, ['id' =>'id_user3',
                            'class' =>'inspector form-control form-control_my_insp' ]) !!}
                </div>
                <div class="col-md-5 col-md-6_my inspectors_divs">
                    <p class="description" >Задължително се избира водещ инспектор! Останалите са опционални!</p>

                </div>

                <div class="col-md-8 col-md-6_my" >
                    {!! Form::label('inspector_another', 'Инспектор от друга служба:', ['class'=>'my_labels']) !!}
                    {!! Form::text('inspector_another', $return_another, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>250 ]) !!}

                    {!! Form::label('inspector_from', ' От служба:', ['class'=>'my_labels']) !!}
                    {!! Form::text('inspector_from', $return_from, ['class'=>'form-control form-control-my', 'size'=>20, 'maxlength'=>50 ]) !!}

                </div>

                <div class="col-md-4 col-md-6_my" >
                    <p class="error description">{{ $errors->first('inspector') }}</p>
                    <p class="error description">{{ $errors->first('inspector_two') }}</p>
                    <p class="error description">{{ $errors->first('inspector_three') }}</p>
                    <p class="error description">{{ $errors->first('inspector_another') }}</p>
                    <p class="error description">{{ $errors->first('inspector_from') }}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>