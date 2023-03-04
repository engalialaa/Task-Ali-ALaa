<?php

namespace Modules\TaskModule\Http\Requests;

use App\Rules\ValidEmail;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if($this->method() == 'POST')
        {
            return [
                'name'=>'required|string|min:3',
                'address'=>'required|string|min:3',
                'image' =>  'required|file|mimes:jpg,jpeg,png,gif|max:1024',
            ];
        }

        return [
            'name'=>'required|string|min:3',
            'address'=>'required|string|min:3',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:1024',
        ];

    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
