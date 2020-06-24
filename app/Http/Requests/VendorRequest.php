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
            'logo' => 'required|mimes:jpg,jpeg,png',
            'category_id' => 'required',
            'address' => 'required',
            'mobile' => 'required',
//            'direction' => 'required|in:rtl,ltr',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.string' => 'اسم اللغة لابد ان يكون احرف',
//            'abbr.max' => 'هذا الحقل لابد الا يزيد عن 10 احرف ',
//            'abbr.string' => 'هذا الحقل لابد ان يكون احرف ',
            'name.max' => 'اسم اللغة لابد الا يزيد عن 100 احرف ',
            'logo.mimes'=>'يجب انت تكون صورة',
        ];
    }
}
