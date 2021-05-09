<?php

namespace App\Http\Resources\Event;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $t1 = Carbon::parse("{$this->date_start} {$this->time_start}");
        $t2 = Carbon::parse("{$this->date_end} {$this->time_end}");
        $diff = $t1->diff($t2);

        $longsDate = [];

        $longsDate[] = $t1->toDateString();;


        for($i = 1; $i <= $diff->d ;$i++)
        {
            $currentDate = $longsDate[$i - 1];
            $longsDate[] = Carbon::make($currentDate)->addDay()->toDateString();
        }
        $end = $diff->h;
        if($diff->i > 0)
        {
            $end++;
        }


        $arrayMail = [];
        $guests = $this->guests()->get();
        foreach ($guests as $guest) {
            $arrayMail[] = $guest->mail;
        }
        $guestsMail = implode(', ', $arrayMail);

        return [
            'id' => $this->id,
            'type' => 'event',
            'name' => $this->name,
            'location' => $this->location,
            'description' => $this->description,
            'longsDate' => $longsDate,
            'dateStart' => $this->date_start,
            'timeStart' => $this->time_start,
            'timeEnd' => $this->time_end,
            'dateEnd' => $this->date_end,
            'user_id' => $this->user_id,
            'end' => $end,
            'guests' => $guestsMail
        ];
    }
}
