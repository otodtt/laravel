<table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px" style="margin-top: 50px">
    <thead>
        <tr>
            <th>N</th>
            <th>Delete</th>
            <th>Име на Фирмата</th>
            <th>Адрес</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 1; ?>
    @foreach($packers as $packer)
        <tr>
            <td class="center"><?= $n++ ?></td>
            <td class="center">
                <form action="{{ url('/контрол/опаковчик/'.$packer->id.'/destroy') }}" method="post" style="display: inline-block; margin-top: 5px" onsubmit="return confirm('Наистина ли искате да изтриете тази фирма?');">
                    <div class="col-md-6 " >
                        {!! Form::submit('Изтрий!', ['class'=>'fa fa-edit btn btn-danger my_btn', 'id'=>'submit']) !!}
                    </div>
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                </form>
            </td>
            <td>
                {{mb_strtoupper($packer->packer_name), 'UTF-8'}}
            </td>
            <td class="">
                {{$packer->packer_address}}
            </td>
            <td class="center last-column">
                <a href="{!!URL::to('/контрол/опаковчик/'.$packer->id.'/edit')!!}" class="fa fa-edit btn btn-primary my_btn"></a>
            </td> 
        </tr>
    @endforeach
    </tbody>
</table>