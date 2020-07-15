<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:100',
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'category_id' => 'required',
            'address' => 'required',
            'mobile' => 'required|unique:vendors,mobile,'.$this->id,
            'email' => 'required|unique:vendors,email,'.$this->id,
            'password' => 'required_without:id',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.string' => 'اسم اللغة لابد ان يكون احرف',
            'email.unique' => 'البريد الالكترونى مستخدم من قبل',
            'mobile.unique' => 'رقم الهاتف مستخدم من قبل',
            'name.max' => 'اسم اللغة لابد الا يزيد عن 100 احرف ',
            'logo.mimes'=>'يجب انت تكون صورة',
        ];
    }
}
