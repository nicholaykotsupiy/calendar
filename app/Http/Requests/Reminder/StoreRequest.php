<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:"H:i"',
//            'repeat' => 'string',
//            'repeat' => 'string|in ["ежедневно", "еженедельно", "каждый год", "не повторять", "весь день"]',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
