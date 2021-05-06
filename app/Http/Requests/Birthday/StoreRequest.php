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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:"H:i"',
            'allDay' => 'boolean',
            'everyYear' => 'boolean',
        ];
    }
//
//    protected function formatErrors(Validator $validator)
//    {
//        return $validator->errors()->all();
//    }

    /**
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
//    public function messages()
//    {
//        return [
//            'name.required' => 'Необходимо указать название мероприятия',
//            'name.max:255' => 'Максимальная длинна названия мероприятия - 255 символов',
//            'description.required' => 'Необходимо указать описание мероприятия',
//            'description.max:255' => 'Максимальная длинна описания мероприятия - 255 символов',
//            'date.required' => 'Необходимо указать дату',
//            'date.date'  => 'Неправильный формат даты',
//            'time.required' => 'Необходимо указать время',
//            'time.date_format:"H:i"'  => 'Неправильный формат времени',
//            'allDay.boolean'  => 'Неправильный формат данных для поля "Весь день"',
//            'everyYear.boolean'  => 'Неправильный формат данных для поля "Каждый год"',
//        ];
//    }
}
