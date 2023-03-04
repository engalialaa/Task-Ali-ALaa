<?php

namespace Modules\TaskModule\Http\Requests;

use App\Rules\ValidEmail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
                'company_id' => ['required', "numeric", Rule::exists('companies', 'id')],
                'name'=>'required|string|min:3',
                'email'=> 'required|email|unique:employees,email',
                'password' =>'required|min:6',
                'image' =>  'required|file|mimes:jpg,jpeg,png,gif|max:1024',
            ];
        }

        return [
            'company_id' => ['required', "numeric", Rule::exists('companies', 'id')],
            'name'=>'required|string|min:3',
            'email'=> 'required|email|unique:employees,email,'.$this->id,
            'image' =>  'nullable|file|mimes:jpg,jpeg,png,gif|max:1024',
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
