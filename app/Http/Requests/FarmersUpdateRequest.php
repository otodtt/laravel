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
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'type_firm.required' => 'Маркирай вида на фирмата!',

            'name.required' => 'Попълни името на Земеделския производител!',
            'name.min' => 'Минимален брой символи за име Земеделски производител  - 3!',
            'name.max' => 'Минимален брой символи за име Земеделския производител - 50!',
            'name.cyrillic_names' => 'За име на Фирма пиши само на кирилица без символи! Позволени символи: (тире - ) и цифри!',
            'name.only_cyrillic' => 'За име на Земеделския производител пиши само на кирилица без символи!',

            'areasID.not_in'=> 'Избери областта където е регистриран Земеделския производител!',
            'areasID.required'=> 'Избери общината където е регистриран Земеделския производител!',
            'list_name.required' => 'Избери населено място от списъка!',

            'address.required' => 'Попълни адреса на Земеделския производител!',
            'address.min' => 'Минимален брой символи за адрес - 3!',
            'address.max' => 'Максимален брой символи за адрес - 50!',
            'address.cyrillic_with' => 'Пиши само на кирилица!!',

            'district_object.not_in'=> 'Избери общината където се намира стопанството!',
            'district_object.required'=> 'Избери общината където се намира стопанството!',

            'location_farm.min' => 'Минимален брой символи за Населено място\места  - 3!',
            'location_farm.max' => 'Минимален брой символи за Населено място\места - 250!',
            'location_farm.cyrillic_names_objects' => 'За Населено място\места пиши само на кирилица без символи! Позволени символи: точка-(.), запетая-(,), точка и запетая-(;)!',

            'pin.required' => 'Попълни ЕГН!',
            'pin.pin_validate_name' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
            'pin.digits_between' => 'ЕГН-то е само цифри!',

            'gender.required' => 'Маркирай дали е мъж или жена!',

            'bulstat.required' => 'Булстата е задължителен!',
            'bulstat.digits_between' => 'Булстата е само с цифри! Минимален брой символи - 9',
            'bulstat.unique' => 'Булстата трябва да е уникален! Намерена е фирма с този БУЛСТАТ',
            'bulstat.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',

            'owner.required' => 'Попълни името на Управителя/Представителя!',
            'owner.min' => 'Минимален брой символи за име Управител - 3!',
            'owner.max' => 'Минимален брой символи за име Управител - 50!',
            'owner.only_cyrillic' => 'За име Управител пиши само на кирилица!',

            'gender_owner.required' => 'Маркирай дали е мъж, жена или Без ЕГН!',

            'pin_owner.required' => 'Попълни ЕГН!',
            'pin_owner.pin_validate_owner' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
            'pin_owner.digits_between' => 'ЕГН-то е само цифри!',

            'phone.phone_validate' => 'Некоректен формат на изписване на телефон.',
            'mobil.mobile_validate' => 'Некоректен формат на изписване на мобилен телефон.',

            'email.email' => 'Некоректен формат на електроната поща! Махни празните полета',
            'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',
        ];
    }
}
