<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConversationRequest extends FormRequest
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
            'id' => 'required',
            'text' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => trans('user.empty'),
            'text.required' => trans('user.required'),
            'text.string' => trans('user.string'),
        ];
    }
}
