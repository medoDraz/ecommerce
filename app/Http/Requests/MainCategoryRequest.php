<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'photo' => 'mimes:jpg,jpeg,png',
            'category' => 'required|array|min:1',
            'category.*.name' => 'required|min:1',
            // 'category.*.active' => 'required',
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
