<?php

namespace App\Http\Requests\Task;

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
            'task.allDay' => (bool) $this->task['allDay'],
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
            'task.name' => 'required|string|max:255',
            'task.description' => 'nullable|string|max:255',
            'task.allDay' => 'boolean',
            'task.dateStart' => 'required|date',
            'task.dateEnd' => 'required|date',
            'task.timeStart' => 'required|date_multi_format:"H:i","H:i:s"',
            'task.timeEnd' => 'required|date_multi_format:"H:i","H:i:s"',
        ];
    }

    public function messages()
    {
        return [
            'task.timeStart.date_multi_format'  => 'Поле task.time не является временем',
            'task.timeEnd.date_multi_format'  => 'Поле task.time не является временем',
        ];
    }
}
