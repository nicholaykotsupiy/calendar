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
//            'guests' => 'string|max:255|regex:/(.+@.+\..+\s*,?\s*)*/i',//доработаю
            'location' => 'string|max:255',
            'description' => 'required|string|max:255',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
            'timeStart' => 'required|date_format:"H:i"',
            'timeEnd' => 'required|date_format:"H:i"',
        ];
    }
}
