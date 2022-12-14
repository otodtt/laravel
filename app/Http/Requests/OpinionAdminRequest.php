<?php

namespace odbh\Http\Requests;



class OpinionAdminRequest extends Request
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
        $owner = null;
        $gender_owner = null;
        $pin_owner = null;
        $assay_error = null;
        $number_protocol = null;
        $date_protocol = null;
        $request = Request::all();

        ///
        if(isset($request['type_firm']) && $request['type_firm'] == 1){
            $owner = '';
            $gender_owner = '';
            $pin_owner = '';
        }
        elseif(isset($request['type_firm']) && $request['type_firm'] > 1){
            $owner = 'min:3|max:100|cyrillic';
            $gender_owner = 'required';

            if(!isset($request['gender_owner']) || strlen($request['gender_owner']) == 1){
                $pin_owner = '';
            } else {
                $pin_owner = 'required|pin_validate_owner|digits_between:9,10';
            }
        }
        else{
            $owner = '';
            $gender_owner = '';
            $pin_owner = '';
        }
        if(strlen($request['date_opinion']) == 0){
            $date_petition = 'required|date_format:d.m.Y';
        }
        else{
            $date_petition = 'required|date_format:d.m.Y|before:'.$request['date_opinion'];
        }
        $data = ([
            'number_opinion' => 'numeric|required',
            'date_opinion' => 'date_format:d.m.Y',

            'number_petition' => 'required|numeric|not_in:0',
            'date_petition' => $date_petition,

            'invoice' => 'required|numeric|not_in:0',
            'invoice_date' => 'required|date_format:d.m.Y',
            'opinion' => 'required|not_in:0',
            'yes' => 'required',

            'owner'=> $owner,
            'gender_owner'=> $gender_owner,
            'pin_owner'=> $pin_owner,

            'list_name'=> 'required',
            'address'=> 'required|min:3|max:50|cyrillic_with',

            'phone'=> 'phone_validate',
            'mobil'=> 'mobile_validate',
            'email'=> 'email',

            'district_object' => 'required|not_in:0',
            'object_name' => 'min:3|max:50|cyrillic_names_objects',

            'inspectors' => 'required|not_in:0',

            'type_check' => 'required',

            'error'=>'in:0'
        ]);
        return $data;
    }

    /**
     * ?????? ?????????????????? ???? ????????????.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'number_opinion.numeric' => '?????????????????? ?????????? ???? ?????????????????????? ?? ???????? ?? ??????????!',
            'number_opinion.required' => '?????????????????? ?????????? ???? ?????????????????????? e ????????????????????????! ?????? ?? ???????????????????? ?????????? ???????? - 0',
            'date_opinion.date_format' => '???????????????????? ???????????? ???? ???????? ???? ?????????????? ?????????? ???? ??????????????????!',

            'number_petition.required' => '???????????? ???? ?????????????????????? ?? ????????????????????????!',
            'number_petition.numeric' => '???????????? ???? ?????????????????????? ?? ???????? ?? ??????????!',
            'number_petition.not_in' => '???????????? ???? ?????????????????????? ???????????? ???? ?? ???????????????? ???? ???????? - 0!',

            'date_petition.required' => '???????????? ???? ?????????????????????? ?? ????????????????????????!',
            'date_petition.date_format' => '???????????????????? ???????????? ???? ???????? ???? ??????????????????!',
            'date_petition.before' => '???????????? ???? ?????????????????? ?????????? ???? ???????? ???? ?? ?????????? ???????????? ???? ??????????????????????!',

            'invoice.required' => '???????????? ???? ?????????????????? ?? ????????????????????????!',
            'invoice.numeric' => '???????????? ???? ?????????????????? ?? ???????? ?? ??????????!',
            'invoice.not_in' => '???????????? ???? ?????????????????? ???????????? ???? ?? ???????????????? ???? ???????? - 0!',
            'invoice_date.required' => '???????????? ???? ?????????????????? ?? ????????????????????????!',
            'invoice_date.date_format' => '???????????????????? ???????????? ???? ???????? ???? ??????????????!',

            'opinion.required' => '???????????? ?????????????? ???? ?????????? ???? ???? ???????????? ??????????????????????!',
            'opinion.not_in' => '???????????? ?????????????? ???? ?????????? ???? ???? ???????????? ??????????????????????!',

            'yes.required' => '???????????????? ???????? ???????????????????????? ???????????????????? ???????????????? ???? ???????????????????????? ???? ??????!',

            'list_name.required' => '???????????? ???????????????? ?????????? ???? ??????????????!',
            'address.required' => '???????????? ?? ????????????????????????!',
            'address.min' => '?????????????????? ???????? ?????????????? ???? ?????????? - 3!',
            'address.max' => '???????????????????? ???????? ?????????????? ???? ?????????? - 50!',
            'address.cyrillic_with' => '???? ?????????? - ???????? ???????? ???? ????????????????!!',

            'phone.phone_validate' => '???????????????????? ???????????? ???? ?????????????????? ???? ??????????????.',
            'mobil.mobile_validate' => '???????????????????? ???????????? ???? ?????????????????? ???? ?????????????? ??????????????.',
            'email.email' => '???????????????????? ???????????? ???? ?????????????????????? ????????! ?????????? ???????????????? ????????????',

            'district_object.required' => '???????????????????????? ???????????? ???????????????? ???????????? ???? ???????????? ???????????????????????? ???? ??????????????????!',
            'district_object.not_in' => '???????????????????????? ???????????? ???????????????? ???????????? ???? ???????????? ???????????????????????? ???? ??????????????????!',

            'object_name.min' => '?????????????????? ???????? ?????????????? ???? ???????????????? ??????????\?????????? - 3!',
            'object_name.max' => '?????????????????? ???????? ?????????????? ???? ???????????????? ??????????\?????????? - 50!',
            'object_name.cyrillic_names_objects' => '???? ???????????????? ??????????\?????????? ???????? ???? ???????????????? ?????? ??????????????! ?????????????????? ?????????????? (??????????, ??????????????, ?????????? ?? ??????????????) - . , ;',

            'inspectors.required' => '???????????????????????? ???????????? ???????????????????? ?????????????????? ?????????????????????? ???? ??????????????????????!',
            'inspectors.not_in' => '???????????????????????? ???????????? ???????????????????? ?????????????????? ?????????????????????? ???? ??????????????????????!',

            'inspectors_protocol.required_if' => '?????????????????? ??, ???? ?????? ?????????????????????? ???????????????? - ???????????? ???????????????????? ?????????????? ??????????????????!',
            'inspectors_protocol.not_in' => '?????????????????? ??, ???? ?????? ?????????????????????? ???????????????? - ???????????? ???????????????????? ?????????????? ??????????????????!',

            'type_check.required' => '???????????????????????? ???????????????? ???????? ???? ????????????????????!',

            'owner.min' => '?????????????????? ???????? ?????????????? ???? ?????? ???? ?????????????????? - 3!',
            'owner.max' => '???????????????????? ???????? ?????????????? ???? ?????? ???? ?????????????????? - 100!',
            'owner.cyrillic' => '???? ?????? ???? ?????????????????? - ???????? ???????? ???? ???????????????? ?????? ??????????????!',

            'gender_owner.required' => '????????????????  ???????? ?? ?????? ?????? ????????! ?????? ???? ???? ???????? ??????-????, ???????????????? - "?????? ??????" ',

            'pin_owner.required' => '?????????????? ?????? ???? ???????????????????? ?????? ???????????????? - "?????? ??????"!',
            'pin_owner.pin_validate_owner' => '??????-???? ???? ???????????????????? ???? ????????????????! ?????? ???????? ???????????????? ???? ?????????????????? ??????????????!',
            'pin_owner.digits_between' => '??????-???? ?? ???????? ??????????!',

            'error.in' => '???????????? ???????????????? ?????????? ???? ??????????????! ?????? ???? ???? ?? ?????????????? ?????????? ????????????!',
        ];
    }
}
