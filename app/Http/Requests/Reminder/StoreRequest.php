<?php

namespace App\Http\Requests\Reminder;

use App\Models\Reminder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'toRepeat' => Rule::in([Reminder::DAILY, Reminder::WEEKLY, Reminder::YEARLY, Reminder::DONOTREPEAT, Reminder::ALLDAY]),
        ];
    }
}
