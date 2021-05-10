<?php

namespace App\Http\Resources\Task;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use function Sodium\add;

class TaskResource extends JsonResource
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
//        if($diff->d > 0) {
//            $end = 24 - $t1->hour;
//        }

        return [
            'id' => $this->id,
            'type' => 'task',
            'name' => $this->name,
            'description' => $this->description,
            'dateStart' => $this->date_start,
            'timeStart' => $this->time_start,
            'longsDate' => $longsDate,
            'timeEnd' => $this->time_end,
            'dateEnd' => $this->date_end,
            'allDay' => boolval($this->all_day),
            'user_id' => $this->user_id,
            'end' => $end,
        ];
    }
}
