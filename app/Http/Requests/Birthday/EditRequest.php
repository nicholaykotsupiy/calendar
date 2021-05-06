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
}
