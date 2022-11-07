<fieldset class="apt_all_field">
    <legend class="apt_all_legend">С Т А Н О В И Щ А</legend>
    @if(!empty($old_opinions->toArray()))
        <fieldset class="old_opinions">
            <legend class="legend_apt">СТАНОВИЩА - Стари Становища издадени за изминали години.</legend>
            <?php $n=1; ?>
            <table>
                <tbody>
                    @foreach($old_opinions as $old_opinion)
                        <tr style="border-bottom: 1px solid white;">
                            <td >{!! $n++ !!}. Становище с № <span class="bold">{!! $old_opinion->index_opinion !!} - {!! $old_opinion->number_opinion !!} / {!! date('d.m.Y', $old_opinion->date_opinion) !!} г.</span></td>
                            <td >&nbsp;&nbsp; По мярка: <span class="bold">{!! $old_opinion->opinion !!}</span></td>
                            <td >
                                &nbsp;&nbsp; <a class="fa fa-eye btn btn-success my_btn" href="{!! URL::to('/становище-старо/'.$old_opinion->id )!!}" style="margin: 3px 0"> ВИЖ Становището</a>
                            </td>
                            @if(($old_opinion->number_protocol == 0 || $old_opinion->date_protocol == 0) || $old_opinion->double_protocol >= 4)
                                <td>&nbsp;&nbsp; Няма Констативен протокол за Становището</td>
                            @else
                                <td>&nbsp;&nbsp; С Констативен П-л № <span class="bold">{!! $old_opinion->number_protocol !!}/{!! date('d.m.Y', $old_opinion->date_protocol) !!} г.</span></td>
                                <td >
                                    &nbsp;&nbsp; <a class="fa fa-eye btn btn-primary my_btn" href="{!!URL::to('/стари-протокол-зс/'.$old_opinion->number_protocol.'/'.$old_opinion->date_protocol)!!}" style="margin: 3px 0"> ВИЖ Протокола</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </fieldset>
    @endif
    @if(!empty($opinions->toArray()))
        <fieldset class="new_opinions">
            <legend class="legend_apt">СТАНОВИЩА - Становища издадени на Земеделския Стопанин</legend>
            <?php $n=1; ?>
            <table>
                <tbody>
                @foreach($opinions as $opinion)
                    <tr style="border-bottom: 1px solid white;">
                        <td >{!! $n++ !!}.
                            @if($opinion->number_opinion == 0 || $opinion->date_opinion == 0)
                                <span class="red bold">Не е въведн номера</span>
                            @else
                                Становище с № <span class="bold">{!! $opinion->index_opinion !!} - {!! $opinion->number_opinion !!} / {!! date('d.m.Y', $opinion->date_opinion) !!} г.</span>
                            @endif
                        </td>
                        <td >
                            &nbsp;&nbsp; По мярка: <span class="bold">{!! $opinion->opinion_name_short !!}</span>
                        </td>
                        <td >
                            &nbsp;&nbsp; <a class="fa fa-eye btn btn-success my_btn" href="{!!URL::to('/становище/'.$opinion->id)!!}" style="margin: 3px 0"> ВИЖ Становището</a>
                        </td>
                        @if($opinion->number_protocol == 0 || $opinion->date_protocol == 0)
                            <td>&nbsp;&nbsp; Няма Констативен протокол за Становището</td>
                        @else
                            <td>&nbsp;&nbsp; С Констативен П-л № <span class="bold">{!! $opinion->number_protocol !!}/{!! date('d.m.Y', $opinion->date_protocol) !!} г.</span></td>
                            <td >
                                &nbsp;&nbsp; <a class="fa fa-eye btn btn-primary my_btn" href="{!!URL::to('/протокол-зс/'.$opinion->id.'/'.$opinion->number_protocol)!!}" style="margin: 3px 0"> ВИЖ Протокола</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </fieldset>
    @endif
</fieldset>