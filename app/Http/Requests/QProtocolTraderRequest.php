<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QProtocolTraderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = Request::all();
        $trader_name = '';
        $trader_address = '';
        $trader_vin = '';
        $mobile = '';

        if($request['trader_or_not'] == 1) {
            $trader_name = 'required|cyrillic_with|min:3|max:100';
            $trader_address = 'required|cyrillic_with|min:3|max:500';
            $trader_vin = 'required|is_valid|digits_between:9,13';
            $mobile = 'mobile_validate';
        }

        if($request['trader_or_not'] == 0) {
            $trader_name = 'required|cyrillic_with|min:3|max:100';
            $trader_address = 'cyrillic_with|min:3|max:500';
            $trader_vin = 'digits_between:9,13';
            $mobile = 'mobile_validate';
        }

        if(isset($request['type_package']) && $request['type_package'] == 999 ) {
            $different = 'required|min:3|max:100|cyrillic';
        }
        else {
            $different  = '';
        }

        return [
            'trader_name' => $trader_name,
            'trader_address' => $trader_address,
            'trader_vin' => $trader_vin,
            'mobile' => $mobile,
            
            'number_protocol'=>'required|numeric|not_in:0',
            'date_protocol' => 'required|date_format:d.m.Y',

            'crops' => 'required|not_in:0',
            'origin'=>'required|cyrillic_with|min:3|max:300',
            'tara'=>'required|my_numeric',
            'different' => $different,
            'variety'=>'cyrillic_with|min:3|max:1000',
            'documents'=>'cyrillic_with|min:3|max:1000',

            'actions'=>'cyrillic_with|min:3|max:1000',
            'name_trader'=>'required|cyrillic_with|min:3|max:500',

            'place'=>'required|cyrillic_with|min:3|max:100',
            'inspectors' => 'required|not_in:0',
        ];
    }

    /**
     * ?????? ?????????????????? ???? ????????????.
     *
     * @return array
     */
    public function messages() {
        $data = [
            'trader_name.required' => '?????????????? ?????????? ???? ??????????????????!',
            'trader_name.cyrillic_with' => '???? ?????????? ???? ?????????????????? ?????????????????? ???????????????? ?????? ?????????????????? ( )!',
            'trader_name.min' => '???? ?????????? ???? ?????????????????? - ?????????????????? ???????? ?????????????? - 3!',
            'trader_name.max' => '???? ?????????? ???? ?????????????????? - ???????????????????? ???????? ?????????????? - 100!',

            'trader_address.required' => '?????????????? ???????????? ???? ??????????????????!',
            'trader_address.cyrillic_with' => '???? ???????????? ???? ?????????????????? ?????????????????? ???????????????? ?????? ?????????????????? ( )!',
            'trader_address.min' => '???? ???????????? ???? ?????????????????? - ?????????????????? ???????? ?????????????? - 3!',
            'trader_address.max' => '???? ???????????? ???? ?????????????????? - ???????????????????? ???????? ?????????????? - 500!',

            'trader_vin.required' => '?????????????? ??????/?????????????? ???? ??????????????????!',
            'trader_vin.is_valid' => '?????????????????? ??????/?????????????? ???? ??????????????????!',
            'trader_vin.digits_between' => '?????????????????? ??????/?????????????? ???? ??????????????????!',

            'mobile.mobile_validate' => '?????????????????? ???????????? ???? ?????????????? ??????????????!',

            'number_protocol.required' => '???????????? ???? ?????????????????? ?? ??????????????????????!',
            'number_protocol.numeric' => '???? ?????????? ???? ?????????????????? ?????????????????? ???????? ??????????!',
            'number_protocol.not_in' => '???????????? ???? ?????????????????? ???? ???????? ???? ???????? - 0!',

            'date_protocol.required' => '???????????? ???? ?????????????????? ?? ??????????????????????!',
            'date_protocol.date_format' => '???????????????????? ???????????? ???? ???????? ???? ????????????????!',

            'crops.required' => '???????????? ??????????????!',
            'crops.not_in' => '???????????? ??????????????!',

            'origin.required' => '?????????????? ???????? 2. ???????????? ???? ????????????????!',
            'origin.cyrillic_with' => '???? ???????????? ???? ???????????????? ?????????????????? ????????????????!',
            'origin.min' => '???? ???????????? ???? ???????????????? ?????????????????? ???????? ?????????????? - 3!',
            'origin.max' => '???? ???????????? ???? ???????????????? ???????????????????? ???????? ?????????????? - 300!',

            //'quality_class.required' => '???????????? 3. ?????????????? ???????? ???? ????????????????!',
            //'quality_class.not_in' => '???????????? 3. ?????????????? ???????? ???? ????????????????!',

            //'quality_naw.required' => '???????????? 4. ???????? ???? ???????????????? ?? ??????????????!',
            //'quality_naw.not_in' => '???????????? 4. ???????? ???? ???????????????? ?? ??????????????!',

            //'number.required' => '?????????????? ???????? 6. ????????!',
            //'number.my_numeric' => '???? ???????? 6. ???????? - ?????????????????? ???????? ??????????!',

            'tara.required' => '?????????????? ???????? 5. ?????????? ??????????/????????(????):!',
            'tara.my_numeric' => '???? ???????? 5. ?????????? ??????????/????????(????): - ?????????????????? ???????? ??????????!',

            //'type_package.required' => '???????????? ???????? ???? ????????????????????!',
            //'type_package.not_in' => '???????????? ???????? ???? ????????????????????!',

            'different.required' => '???? ???????? ???? ???????????????????? ?? ?????????????? - ??????????! ?????????????? ???????? ???? ????????????????????',
            'different.cyrillic' => '???? ???????? ???? ???????????????????? ?????????????????? ????????????????!',
            'different.min' => '???? ???????? ???? ???????????????????? ?????????????????? ???????? ?????????????? - 3!',
            'different.max' => '???? ???????? ???? ???????????????????? ???????????????????? ???????? ?????????????? - 100!',

            'variety.cyrillic_with' => '???? 7. ?????????? ???????????????????????????????? ???????????? ?????????????????? ???????????????? ?????? ?????????????????? ( )!',
            'variety.min' => '???? 7. ?????????? ???????????????????????????????? ???????????? - ?????????????????? ???????? ?????????????? - 3!',
            'variety.max' => '???? 7. ?????????? ???????????????????????????????? ???????????? - ???????????????????? ???????? ?????????????? - 1000!',

            'documents.cyrillic_with' => '???? 8. ???????????????????????? ?????????????? ?????????????????? ?????????????????? ???????????????? ?????? ?????????????????? ( )!',
            'documents.min' => '???? 8. ???????????????????????? ?????????????? ?????????????????? - ?????????????????? ???????? ?????????????? - 3!',
            'documents.max' => '???? 8. ???????????????????????? ?????????????? ?????????????????? - ???????????????????? ???????? ?????????????? - 1000!',

            'actions.cyrillic_with' => '???? ???????????????? ???? ?????????????????? ?????????????????? ???????????????? ?????? ?????????????????? ( )!',
            'actions.min' => '???? ???????????????? ???? ?????????????????? - ?????????????????? ???????? ?????????????? - 3!',
            'actions.max' => '???? ???????????????? ???? ?????????????????? - ???????????????????? ???????? ?????????????? - 1000!',

            'name_trader.required' => '?????????????? ?????????? ?????????? ???? ?????????????????? ?????? ???? ?????????? ????????????????????????!',
            'name_trader.cyrillic_with' => '???? ?????????? ?????????? ???? ?????????????????? ?????? ???? ?????????? ???????????????????????? ?????????????????? ???????????????? ?????? ?????????????????? ( )!',
            'name_trader.min' => '???? ?????????? ?????????? ???? ?????????????????? ?????? ???? ?????????? ?????????????????????????? - ?????????????????? ???????? ?????????????? - 3!',
            'name_trader.max' => '???? ?????????? ?????????? ???? ?????????????????? ?????? ???? ?????????? ???????????????????????? - ???????????????????? ???????? ?????????????? - 500!',

            'place.required' => '?????????????? ?????????? ???? ????????????????!',
            'place.cyrillic_with' => '???? ?????????? ???? ???????????????? ?????????????????? ???????????????? ?????? ?????????????????? ( )!',
            'place.min' => '???? ?????????? ???? ???????????????? - ?????????????????? ???????? ?????????????? - 3!',
            'place.max' => '???? ?????????? ???? ???????????????? - ???????????????????? ???????? ?????????????? - 100!',

            'inspectors.required' => '???????????? ???????????????????? ???????????????? ????????????????????!',
            'inspectors.not_in' => '???????????? ???????????????????? ???????????????? ????????????????????!',
        ];
        return $data;
    }
}
