<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "code" => "required|string",
            "title" => "required|string",
            "description" => "required|string",
            "type_id" => 'required|numeric|exists:types,id',
            "city" => 'required|numeric',
            "location" => 'required|string',
            "start" => 'required|date_format:Y-m-d\\TH:i',
            "end" => 'required|date_format:Y-m-d\\TH:i',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator); // TODO: Change the autogenerated stub
    }

}
