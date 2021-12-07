<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStateRequest extends FormRequest
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
            'serialNumber' => "required|unique:states,serialNumber|numeric|min:1|max:20" . $this->state,
            'type' => "required|numeric|min:1|max:2",
            'user_id' => "required|numeric|min:1|max:20|exists:users,userIdNumber"
        ];
    }
}
