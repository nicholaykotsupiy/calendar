<?php

namespace App\Http\Requests\Event;

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
        return false;
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
            'guests' => 'string|max:255',
            'location' => 'string|max:255',
            'description' => 'required|string|max:255',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'time_start' => 'required|date_format:"H:i"',
            'time_end' => 'required|date_format:"H:i"',
//            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
