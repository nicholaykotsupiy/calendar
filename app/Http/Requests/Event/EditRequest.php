<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

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
        if ($this->event['guests']) {
            $this->merge([
                'arrayGuests' => explode(', ', $this->event['guests']),
            ]);
        } else {
            $this->arrayGuests = null;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event.name' => 'required|string|max:255|',
            'event.location' => 'nullable|string|max:255',
            'event.description' => 'required|string|max:255',
            'event.dateStart' => 'required|date',
            'event.dateEnd' => 'required|date',
            'event.timeStart' => 'required|date_multi_format:"H:i","H:i:s"',
            'event.timeEnd' => 'required|date_multi_format:"H:i","H:i:s"',
            'arrayGuests.*' => 'nullable|email|distinct',
            'event.guests' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'event.timeStart.date_multi_format'  => 'Поле event.time не является временем',
            'event.timeEnd.date_multi_format'  => 'Поле event.time не является временем',
        ];
    }

}
