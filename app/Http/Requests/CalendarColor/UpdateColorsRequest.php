<?php

namespace App\Http\Requests\CalendarColor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateColorsRequest extends FormRequest
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
            'type' => [Rule::in(['task', 'reminder', 'event', 'birthday']), 'required'],
            'bg_color' => 'required|regex:/^#[A-Fa-f0-9]{6}$/',
            'main_color' => 'required|regex:/^#[A-Fa-f0-9]{6}$/',
        ];
    }
}
