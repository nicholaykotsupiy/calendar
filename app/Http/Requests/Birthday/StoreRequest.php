<?php

namespace App\Http\Requests\Birthday;

use Illuminate\Contracts\Validation\Validator;
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
            'birthday.name' => 'required|string|max:255|unique:birthdays,name',
            'birthday.description' => 'required|string|max:255',
            'birthday.date' => 'required|date',
            'birthday.time' => 'required|date_multi_format:"H:i","H:i:s"',
            'birthday.allDay' => 'boolean',
            'birthday.everyYear' => 'boolean',
        ];
    }

    /**
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'birthday.time.date_multi_format'  => 'Поле birthday.time не является временем',
        ];
    }
}
