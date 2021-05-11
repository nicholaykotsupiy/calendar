<?php

namespace App\Http\Resources\Reminder;

use Illuminate\Http\Resources\Json\JsonResource;

class ReminderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'reminder',
            'name' => $this->name,
            'dateStart' => $this->date,
            'timeStart' => $this->time,
            'repeat' => $this->repeat,
            'user_id' => $this->user_id,
            'end' => 1,
            'longsDate' => [$this->date],
            'main_color' => $this->main_color,
            'bg_color' => $this->bg_color,
        ];
    }
}
