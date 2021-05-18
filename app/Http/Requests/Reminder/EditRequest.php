<?php

namespace App\Http\Requests\Reminder;

use App\Models\Reminder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
            'reminder.name' => 'required|string|max:255',
            'reminder.date' => 'required|date',
            'reminder.time' => 'required|date_multi_format:"H:i","H:i:s"',
            'reminder.toRepeat' => Rule::in([Reminder::DAILY, Reminder::WEEKLY, Reminder::YEARLY, Reminder::DONOTREPEAT, Reminder::ALLDAY]),
        ];
    }

    public function messages()
    {
        return [
            'reminder.time.date_multi_format'  => 'Поле reminder.time не является временем',
        ];
    }
}
