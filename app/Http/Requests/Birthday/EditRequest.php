<?php

namespace App\Http\Requests\Birthday;

use Illuminate\Foundation\Http\FormRequest;

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

    protected function prepareForValidation()
    {
        $this->merge([
            'birthday.allDay' => (bool) $this->birthday['allDay'],
            'birthday.everyYear' => (bool) $this->birthday['everyYear'],
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthday.name' => 'required|string|max:255',
            'birthday.description' => 'required|string|max:255',
            'birthday.date' => 'required|date',
            'birthday.time' => 'required|date_multi_format:"H:i","H:i:s"',
            'birthday.allDay' => 'boolean',
            'birthday.everyYear' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'birthday.time.date_multi_format'  => 'Поле birthday.time не является временем',
        ];
    }

}
