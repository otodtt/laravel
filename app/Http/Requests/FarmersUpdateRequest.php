<?php

namespace odbh\Http\Requests;


class FarmersUpdateRequest extends Request
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
        $id = $this->segment(2);
        $request = Request::all();

        if(isset($request['type_firm']) && $request['type_firm'] >= 2){
            if(strlen($request['gender_owner']) == 1){
                $pin_owner = 'pin_validate_owner|digits_between:9,10';
            }
            else{
                $pin_owner = 'required|pin_validate_owner|digits_between:9,10';
            }
            $data = ([
                'type_firm'=> 'required',
                'name'=> 'required|min:3|max:50|cyrillic_names',
                'bulstat'=> 'required|is_valid|digits_between:9,13|unique:farmers,bulstat,'.$id,

                'owner'=> 'required|min:3|max:50|cyrillic',
                'gender_owner'=> 'required',
                'pin_owner'=> $pin_owner,

                'localsID'=> 'required|not_in:0',
                'list_name'=> 'required',
                'address'=> 'required|min:3|max:50|cyrillic_with',

                'phone'=> 'phone_validate',
                'mobil'=> 'mobile_validate',
                'email'=> 'email',

                'district_object' =>'required|not_in:0',
                'location_farm' => 'min:3|max:250|cyrillic_names_objects',

                'error'=>'in:0'
            ]);
        }
        else{
            $data = ([
                'name'=> 'required|min:3|max:50|cyrillic',
                'gender'=> 'required',
                'pin'=> 'required|pin_validate_name|digits_between:9,10',

                'areasID'=> 'required|not_in:0',
                'list_name'=> 'required',
                'address'=> 'required|min:3|max:50|cyrillic_with',

                'phone'=> 'phone_validate',
                'mobil'=> 'mobile_validate',
                'email'=> 'email',

                'district_object' =>'required|not_in:0',
                'location_farm' => 'min:3|max:250|cyrillic_names_objects',

                'error'=>'in:0'
            ]);
        }
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
            'type_firm.required' => '???????????????? ???????? ???? ??????????????!',

            'name.required' => '?????????????? ?????????? ???? ?????????????????????? ????????????????????????!',
            'name.min' => '?????????????????? ???????? ?????????????? ???? ?????? ???????????????????? ????????????????????????  - 3!',
            'name.max' => '?????????????????? ???????? ?????????????? ???? ?????? ?????????????????????? ???????????????????????? - 50!',
            'name.cyrillic_names' => '???? ?????? ???? ?????????? ???????? ???????? ???? ???????????????? ?????? ??????????????! ?????????????????? ??????????????: (???????? - ) ?? ??????????!',
            'name.only_cyrillic' => '???? ?????? ???? ?????????????????????? ???????????????????????? ???????? ???????? ???? ???????????????? ?????? ??????????????!',

            'areasID.not_in'=> '???????????? ???????????????? ???????????? ?? ?????????????????????? ?????????????????????? ????????????????????????!',
            'areasID.required'=> '???????????? ???????????????? ???????????? ?? ?????????????????????? ?????????????????????? ????????????????????????!',
            'list_name.required' => '???????????? ???????????????? ?????????? ???? ??????????????!',

            'address.required' => '?????????????? ???????????? ???? ?????????????????????? ????????????????????????!',
            'address.min' => '?????????????????? ???????? ?????????????? ???? ?????????? - 3!',
            'address.max' => '???????????????????? ???????? ?????????????? ???? ?????????? - 50!',
            'address.cyrillic_with' => '???????? ???????? ???? ????????????????!!',

            'district_object.not_in'=> '???????????? ???????????????? ???????????? ???? ???????????? ????????????????????????!',
            'district_object.required'=> '???????????? ???????????????? ???????????? ???? ???????????? ????????????????????????!',

            'location_farm.min' => '?????????????????? ???????? ?????????????? ???? ???????????????? ??????????\??????????  - 3!',
            'location_farm.max' => '?????????????????? ???????? ?????????????? ???? ???????????????? ??????????\?????????? - 250!',
            'location_farm.cyrillic_names_objects' => '???? ???????????????? ??????????\?????????? ???????? ???????? ???? ???????????????? ?????? ??????????????! ?????????????????? ??????????????: ??????????-(.), ??????????????-(,), ?????????? ?? ??????????????-(;)!',

            'pin.required' => '?????????????? ??????!',
            'pin.pin_validate_name' => '??????-???? ???? ????????????????! ?????? ???????? ???????????????? ???? ?????????????????? ??????????????!',
            'pin.digits_between' => '??????-???? ?? ???????? ??????????!',

            'gender.required' => '???????????????? ???????? ?? ?????? ?????? ????????!',

            'bulstat.required' => '???????????????? ?? ????????????????????????!',
            'bulstat.digits_between' => '???????????????? ?? ???????? ?? ??????????! ?????????????????? ???????? ?????????????? - 9',
            'bulstat.unique' => '???????????????? ???????????? ???? ?? ????????????????! ???????????????? ?? ?????????? ?? ???????? ??????????????',
            'bulstat.is_valid' => '?????????????????? ??????????????! ?????? ???????? ???????????????? ?? ????????????????!',

            'owner.required' => '?????????????? ?????????? ???? ????????????????????/??????????????????????????!',
            'owner.min' => '?????????????????? ???????? ?????????????? ???? ?????? ?????????????????? - 3!',
            'owner.max' => '?????????????????? ???????? ?????????????? ???? ?????? ?????????????????? - 50!',
            'owner.only_cyrillic' => '???? ?????? ?????????????????? ???????? ???????? ???? ????????????????!',

            'gender_owner.required' => '???????????????? ???????? ?? ??????, ???????? ?????? ?????? ??????!',

            'pin_owner.required' => '?????????????? ??????!',
            'pin_owner.pin_validate_owner' => '??????-???? ???? ????????????????! ?????? ???????? ???????????????? ???? ?????????????????? ??????????????!',
            'pin_owner.digits_between' => '??????-???? ?? ???????? ??????????!',

            'phone.phone_validate' => '???????????????????? ???????????? ???? ?????????????????? ???? ??????????????.',
            'mobil.mobile_validate' => '???????????????????? ???????????? ???? ?????????????????? ???? ?????????????? ??????????????.',

            'email.email' => '???????????????????? ???????????? ???? ?????????????????????? ????????! ?????????? ???????????????? ????????????',
            'error.in' => '???????????? ???????????????? ?????????? ???? ??????????????! ?????? ???? ???? ?? ?????????????? ?????????? ????????????!',
        ];
    }
}
