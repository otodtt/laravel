<fieldset class="works_all_field">
    <legend class="apt_all_legend" align="center">КОНСТАТИВНИ ПРОТОКОЛИ</legend>
    @if(!empty($old_protocols))
        <fieldset class="old_opinions">
            <legend class="legend_apt">СТАРИ КОНСТАТИВНИ ПРОТОКОЛИ - съвместо с ДФЗ</legend>
            <?php $n=1; ?>
            <table>
                <tbody>
                @foreach($old_protocols as $old_protocol)
                    <tr style="border-bottom: 1px solid white;">
                        @if($old_protocol->check_type == 2)
                            <td >{!! $n++ !!}.
                                Констативен Протокол с № <span class="bold">{!! $old_protocol->number_protocol.' / '.date('d.m.Y',$old_protocol->date_protocol) !!}</span>
                            </td>
                            <td >
                                &nbsp;&nbsp; Издаден за проверка с ДФЗ по: <span class="bold">{!! $old_protocol->description !!}</span>
                            </td>
                            <td >
                                &nbsp;&nbsp; <a class="fa fa-eye btn btn-success my_btn" href="{!!URL::to('/стари-протокол-зс/'.$old_protocol->id)!!}" style="margin: 3px 0"> ВИЖ Протокола</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </fieldset>
    @endif
    @if(!empty($protocols->toArray()))
        <fieldset class="new_opinions">
            <legend class="legend_apt">КОНСТАТИВНИ ПРОТОКОЛИ - съвместо с ДФЗ</legend>
            <?php $n=1; ?>
            <table>
                <tbody>
                @foreach($protocols as $protocol)
                    <tr style="border-bottom: 1px solid white;">
                        @if($protocol->check_type == 2)
                            <td >{!! $n++ !!}.
                                Констативен Протокол с № <span class="bold">{!! $protocol->number_protocol.' / '.date('d.m.Y',$protocol->date_protocol) !!}</span>
                            </td>
                            <td >
                                &nbsp;&nbsp; Издаден за проверка с ДФЗ по: <span class="bold">{!! $protocol->description !!}</span>
                            </td>
                            <td >
                                &nbsp;&nbsp; <a class="fa fa-eye btn btn-success my_btn" href="{!!URL::to('/протокол-зс/'.$protocol->id)!!}" style="margin: 3px 0"> ВИЖ Протокола</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </fieldset>
    @endif
</fieldset>