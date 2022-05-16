<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageCompanyRequest extends FormRequest
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
        dd($this->request);
        return [
            'name' => 'required|min:3|max:100',
            'email' => 'regex:/(.*)@(.*)\.(.*)/i|max:200|email|unique:companies,email',
            'logo' => 'mimes:jpg,png,jpeg,gif|dimensions:min_width=100,min_height=100',
            'cover_image' => 'mimes:jpg,png,jpeg,gif',
            'telephone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'address' => 'nullable|string|max:200|min:3',
            'website' => 'nullable|url|string|max:200|min:3'
        ];
    }
}
