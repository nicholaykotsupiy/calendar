<?php

namespace App\Http\Resources\Birthday;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'type' => 'birthday',
            'name' => $this->name,
            'description' => $this->description,
            'dateStart' => $this->date,
            'timeStart' => $this->time,
            'allDay' => boolval($this->all_day),
            'everyYear' => boolval($this->every_year),
            'user_id' => $this->user_id,
            'end' => 1,
            'longsDate' => [$this->date],
            'main_color' => $this->main_color,
            'bg_color' => $this->bg_color,
        ];
    }
}
